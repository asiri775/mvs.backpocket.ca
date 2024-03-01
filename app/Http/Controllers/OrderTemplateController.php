<?php

namespace App\Http\Controllers;

use App\AccountManager;
use App\Order;
use App\OrderedProducts;
use App\OrderTemplate;
use App\OrderTemplateItem;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Illuminate\Support\Facades\DB;

class OrderTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['templateForm'])) {
            $query = "";
            if (isset($_GET['template']) && $_GET['template'] != "") {
                $query .= " and order_templates.name like '%" . $_GET['template'] . "%'";
            }

            if (isset($_GET['status']) && $_GET['status'] != "") {
                $query .= " and  order_templates.is_active='" . $_GET['status'] . "'";
            }

            if (isset($_GET['repeat']) && $_GET['repeat'] != "") {
                $query .= " and  order_templates.repeat='" . $_GET['repeat'] . "'";
            }
            if (isset($_GET['business']) && $_GET['business'] != "") {
                $query .= " and  clients.business_name like '%" . $_GET['business'] . "%'";
            }

            $orders = "SELECT order_templates.id AS template_id,order_templates.name AS template_name,clients.business_name,job_type.name AS job_type,order_templates.repeat,order_templates.schedule_from,order_templates.is_active
                       FROM order_templates
                       LEFT JOIN clients ON order_templates.client_id =clients.id
                       LEFT JOIN job_type ON job_type.id=order_templates.job_type_id
                       WHERE order_templates.vendor_id=" . Auth::user()->id . " " . $query;

            $orders = DB::select(DB::raw($orders));
        } else {

            $orders = OrderTemplate::select('order_templates.id AS template_id', 'order_templates.name AS template_name', 'clients.business_name', 'job_type.name As job_type', 'order_templates.repeat', 'order_templates.schedule_from', 'order_templates.is_active')->where('order_templates.vendor_id', Auth::user()->id)->orderBy('order_templates.id', 'desc')
                ->leftjoin('clients', 'order_templates.client_id', '=', 'clients.id')
                ->leftjoin('job_type', 'job_type.id', '=', 'order_templates.job_type_id')
                ->get();

        }
        return view('vendor.repeat-templates-list', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $accountManagers = DB::connection('mysql2')->table('EMPLOYEE')
            ->join('employee_company_details', 'EMPLOYEE.UID', '=', 'employee_company_details.employee_id')
            ->where('employee_company_details.department_id', 3)
            ->get();
        $vendor_id = Auth::user()->id;
        $job_type = DB::connection('mysql2')->table('JOB_TYPE')->get();
        return view('vendor.template-create-customer', compact('id', 'accountManagers', 'job_type', 'vendor_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = array(

            "name" => 'required',
            "job_type_id" => 'required',
            "repeat" => 'required',
            "days_allowed" => 'required',
            "schedule_from" => 'required',
            "avg_service_time" => 'numeric',
            "is_active" => 'required'

        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

            $input = $request->all();

        }
        $template = OrderTemplate::create($request->except('_token'));
        Session::flash('message', 'Template has been successfully created');
        return Redirect::route('order-template.show', ['order_template' => $template]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\OrderTemplate $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(OrderTemplate $orderTemplate)
    {
        $products = Product::where('vendorid', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->pluck('id', 'title');

        $job_type = DB::connection('mysql2')->table('JOB_TYPE')->where('UID', $orderTemplate->job_type_id)->first();
        $accountManager = DB::connection('mysql2')->table('EMPLOYEE')->where('UID', $orderTemplate->manager_id)->first();
        $orderTemplateItems = OrderTemplateItem::whereOrderTemplateId($orderTemplate->id)->get();
        return view('vendor.ordertemplate-show', compact('orderTemplate', 'products', 'orderTemplateItems', 'job_type', 'accountManager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\OrderTemplate $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderTemplate = OrderTemplate::findOrFail($id);
        $accountManagers = DB::connection('mysql2')->table('EMPLOYEE')
            ->join('employee_company_details', 'EMPLOYEE.UID', '=', 'employee_company_details.employee_id')
            ->where('employee_company_details.department_id', 3)
            ->get();

        $job_type = DB::connection('mysql2')->table('JOB_TYPE')->get();

        return view('vendor.template-edit-customer', compact('orderTemplate', 'id', 'accountManagers', 'job_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\OrderTemplate $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array(
            "name" => 'required',
            "job_type_id" => 'required',
            "repeat" => 'required',
            "days_allowed" => 'required',
            "schedule_from" => 'required',
            "avg_service_time" => 'numeric',
            "is_active" => 'required',
            "payment_method" => 'required'

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
            $input = $request->all();
        }
        if ($request->input('template_id')) {
            $template = OrderTemplate::where('id', $request->input('template_id'))->first();
            $template->name = $request->input('name');
            $template->job_type_id = $request->input('job_type_id');
            $template->repeat = $request->input('repeat');
            $template->days_apart = $request->input('days_apart');
            $template->weeks_apart = $request->input('weeks_apart');
            $template->months_apart = $request->input('months_apart');
            $template->days_allowed = $request->input('days_allowed');
            $template->schedule_from = $request->input('schedule_from');
            $template->avg_service_time = $request->input('avg_service_time');
            $template->schedule_from = $request->input('schedule_from');
            $template->is_active = $request->input('is_active');
            $template->special_notes = $request->input('special_notes');
            $template->manager_id = $request->input('manager_id');
            $template->name_for_sams = $request->input('name_for_sams');
            $template->payment_method = $request->input('payment_method');
            $template->update();
        }
        Session::flash('message', 'Template has been successfully updated');
        return Redirect::route('order-template.show', ['order_template' => $template]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\OrderTemplate $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function repeatTemplateDelete($id)
    {
        $template = OrderTemplate::findOrFail($id);
        $client_id = $template->client_id;
        $template->delete();
        return redirect('vendor/customer/' . $client_id . '/templates')->with('message', 'Template Delete Successfully.');
    }

    public function getTemplateAjax($client_id)
    {
        $templates = OrderTemplate::join('clients', 'order_templates.client_id', '=', 'clients.id')
            ->join('vendor_customers', 'vendor_customers.customer_id', '=', 'order_templates.client_id')
            ->join('job_type', 'order_templates.job_type_id', '=', 'job_type.id')
            ->select('order_templates.id', 'order_templates.name', 'job_type.name AS typeName', 'order_templates.repeat', 'order_templates.schedule_from')
            ->where('vendor_customers.vendor_id', Auth::user()->id)->where('order_templates.client_id', $client_id);

        return Datatables::of($templates)
            ->addColumn('action', function ($template) {
                return '<a href="/vendor/order-template/' . $template->id . '/edit" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</a>'
                    . '<a href="/vendor/order-template/' . $template->id . '" class="ml-2 btn btn-xs btn-info"><i class="glyphicon glyphicon-eye"></i>&nbsp;View</a>'
                    . '<a href="/vendor/repeat-template-delete/' . $template->id . '" class="ml-2 btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i>&nbsp;Delete</a>';
            })
            ->make(true);
    }

    public function getTemplateByVendor()
    {
        $templates = OrderTemplate::join('clients', 'order_templates.client_id', '=', 'clients.id')
            ->join('vendor_customers', 'vendor_customers.customer_id', '=', 'order_templates.client_id')
            ->join('job_type', 'order_templates.job_type_id', '=', 'job_type.id')
            ->select('order_templates.id', 'order_templates.name', 'job_type.name AS typeName', 'order_templates.repeat', 'order_templates.schedule_from')
            ->where('vendor_customers.vendor_id', Auth::user()->id);

        return Datatables::of($templates)
            ->addColumn('action', function ($template) {
                return '<a href="/vendor/order-template/' . $template->id . '/edit" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a>'
                    . '<a href="/vendor/order-template/' . $template->id . '" class="ml-2 btn btn-xs btn-info"><i class="glyphicon glyphicon-eye"></i> View</a>';
            })
            ->make(true);
    }

    public function getTemplateOrderAjax($client_id)
    {
        $orders = Order::select('orders.*', 'job_type.name as type')
            ->leftJoin('job_type', 'orders.job_type', '=', 'job_type.id')
            ->where('orders.customerid', $client_id)->where('orders.order_type', Order::REPEAT_ORDERS);

        if ($_GET['orderId']) {
            $orders->where('orders.id', $_GET['orderId']);
        }

        if ($_GET['quickdate']) {
            $all = false;
            switch ($_GET['quickdate']) {
                case 'today':
                    $start = date('Y-m-d');
                    $end = date('Y-m-d');
                    break;
                case 'yesterday':
                    $start = date('Y-m-d', strtotime('yesterday'));
                    $end = date('Y-m-d', strtotime('yesterday'));
                    break;
                case 'tomorrow':
                    $start = date('Y-m-d');
                    $end = date('Y-m-d', strtotime('tomorrow'));
                    break;
                case 'wholeweek':
                    $start = date('Y-m-d', strtotime('monday this week'));
                    $end = date('Y-m-d', strtotime('sunday this week'));
                    break;
                case 'weekday':
                    $start = date('Y-m-d', strtotime('monday this week'));
                    $end = date('Y-m-d', strtotime('friday this week'));
                    break;
                case 'nextweek':
                    $start = date('Y-m-d', strtotime('monday next week'));
                    $end = date('Y-m-d', strtotime('sunday next week'));
                    break;
                case 'thismonth':
                    $start = date('Y-m-d', strtotime('first day of this month'));
                    $end = date('Y-m-d', strtotime('last day of this month'));
                    break;
                case 'nextmonth':
                    $start = date('Y-m-d', strtotime('first day of next month'));
                    $end = date('Y-m-d', strtotime('last day of next month'));
                    break;
                case 'thisyear':
                    $start = date('Y-m-d', strtotime('first day of January'));
                    $end = date('Y-m-d', strtotime('last day of December'));
                    break;
                case 'yeartodate':
                    $start = date('Y-m-d', strtotime('first day of January'));
                    $end = date('Y-m-d');
                    break;
                default:
                    $all = true;
            }
            if (!$all) {
                $orders->whereBetween('orders.booking_date', [$start, $end]);
            }

        }
        if (($_GET['fromTime']) && $_GET['toTime']) {
            $orders->whereBetween('orders.booking_date', [date('Y-m-d', strtotime($_GET['fromTime'])), date('Y-m-d', strtotime($_GET['toTime']))]);
        }
        if ($_GET['status']) {
            $orders->where('orders.status', $_GET['status']);
        }
        if ($_GET['method']) {
            $orders->where('orders.method', $_GET['method']);
        }
        $type = str_replace('=', '', $_GET['type']);
        if ($type) {
            $orders->where('orders.job_type', $type);
        }
        return Datatables::of($orders)
            ->addColumn('action', function ($orders) {
                return '<a href="/vendor/order-template-order/' . $orders->id . '" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-eye"></i> View</a>'
                    . '<a href="/vendor/order-template-delete/' . $orders->id . '" class="ml-2 btn btn-xs btn-info"><i class="glyphicon glyphicon-remove"></i> Delete</a>';

            })
            ->make(true);
    }

    public function getOrderTemplateActivate(Request $request)
    {
        $input = $request->all();
        foreach ($input['isActive_arr'] AS $arr) {
            $orders = OrderTemplate::where('id', $arr);
            $orders->update(['is_active' => 1]);
        }
        return $input['isActive_arr'];
    }

    public function getTemplateOrderDelete(Request $request, $client_id)
    {
        $input = $request->all();
        foreach ($input['deleteids_arr'] AS $arr) {
            $this->OrderTemplateOrderDelete($arr);
        }
        return $input['deleteids_arr'];
    }

    public function makeRecurringOrder(Request $request)
    {
        $template = OrderTemplate::whereId($request->order_template_id)->first();
        $scheduleFrom=date('Y-m-d', strtotime($template->schedule_from));
        $today=date('Y-m-d',time());
        $items = OrderTemplateItem::whereOrderTemplateId($request->order_template_id)->get();
        if (count($items) > 0 AND ($scheduleFrom<=$today)) {
            $products = [];
            $quantities = [];
            $prices = [];
            $price = 0;
            $subtotal = 0;
            if (!empty($items)) {
                foreach ($items as $item) {
                    $products[] = $item->product_id;
                    $prices[] = $item->base_price;
                    $quantities[] = $item->qty;
                    $subtotal += $item->base_price;
                    $price += $item->base_price * $item->qty;
                }
            }
            $tax = $price * 0.13;
            $cost = $tax + $price;
            $products = implode(',', $products);
            $quantities = implode(',', $quantities);
            if ($request->order_template_type == OrderTemplate::NEXT_MONTH) {
                $start = date('Y-m-d', strtotime('first day of next month', time()));
                $end_date = date('Y-m-d', strtotime('last day of next month', time()));
                $start_date = Carbon::parse($start);
                $days_allowed = $template->days_allowed;
                $i = 0;
                $incrementData=$start_date;
                while ($incrementData <= $end_date) {
                    $incrementData = date('Y-m-d', strtotime("+" . $i . " day", strtotime($start)));
                    switch ($template->repeat) {
                        case 'Daily':
                            if ($template->days_apart != '') {
                                $dayList = $this->getDateRange($start, $end_date, $template->days_apart,$days_allowed);
                                if (in_array($incrementData, $dayList)) {
                                    $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                                }
                            }
                            break;
                        case 'Weekly':
                            if ($template->weeks_apart != '')
                            {
                                $weeks = $this->getWeeklyDateRange($start, $end_date, $template->weeks_apart,$days_allowed,1);
                                if (in_array($incrementData, $weeks)) {
                                    $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                                }
                            }
                            break;
                        case 'Monthly':
                            if ($template->months_apart != '') {
                                $monthList = $this->getMonthRange($start, $end_date, $template->months_apart, $days_allowed);
                                if (in_array($incrementData, $monthList)) {
                                    $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                                }
                            }
                            break;
                        case 'Quarterly':
                            $monthList = $this->getQuarterlyRange($start,$end_date, $days_allowed);
                            if (in_array($incrementData, $monthList)) {
                                $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                            }
                            break;

                        case 'Semi-Annual':
                            $monthList = $this->getSemiAnnualRange($start, $end_date, $days_allowed);
                            if (in_array($incrementData, $monthList)) {
                                $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                            }
                            break;

                        case 'Yearly':
                            $monthList = $this->getYearlyRange($start, $end_date, $days_allowed);
                            if (in_array($incrementData, $monthList)) {
                                $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                            }
                            break;
                    }
                    $i++;
                }
                Session::flash('message', 'Next calender orders has been successfully created');
                return Redirect('/vendor/customer/' . $template->client_id . '/orders?orderId=&quickdate=&fromTime=&toTime=&status=&method=&type=&orderForm=Search');
            }
            elseif ($request->order_template_type == OrderTemplate::RANGE) {
                $dates = explode('-', $request->dates);
                $start_date = date('Y-m-d', strtotime($dates[0]));
                $end_date = date('Y-m-d', strtotime($dates[1]));
                $days_allowed = $template->days_allowed;
                $i = 0;
                $incrementData=$start_date;
                while ($incrementData <= $end_date) {
                    $incrementData = date('Y-m-d', strtotime("+" . $i . " day", strtotime($start_date)));
                    switch ($template->repeat) {
                        case 'Daily':
                            if ($template->days_apart != '') {
                                $dayList = $this->getDateRange($start_date, $end_date, $template->days_apart,$days_allowed);
                                if (in_array($incrementData, $dayList)) {
                                    $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                                }
                            }
                            break;

                        case 'Weekly':

                            if ($template->weeks_apart != '') {
                                $Weeks = $this->getWeeklyDateRange($dates[0], $dates[1], $template->weeks_apart,$days_allowed);
                                if (in_array($incrementData, $Weeks)) {
                                    $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                                }
                            }
                            break;

                        case 'Monthly':
                            if ($template->months_apart != '') {
                                $monthList = $this->getMonthRange($dates[0], $dates[1], $template->months_apart,$days_allowed);
                                if (in_array($incrementData, $monthList)) {
                                    $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                                }
                            }

                            break;

                        case 'Quarterly':
                            $monthList = $this->getQuarterlyRange($dates[0], $dates[1], $days_allowed);
                            if (in_array($incrementData, $monthList)) {
                                $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                            }
                            break;

                        case 'Semi-Annual':
                            $monthList = $this->getSemiAnnualRange($dates[0], $dates[1], $days_allowed);
                            if (in_array($incrementData, $monthList)) {
                                $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                            }
                            break;

                        case 'Yearly':
                            $monthList = $this->getYearlyRange($dates[0], $dates[1], $days_allowed);
                            if (in_array($incrementData, $monthList)) {
                                $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                            }
                            break;
                    }

                    $i++;

                }
                Session::flash('message', 'Date range orders has been successfully created');
                return Redirect('/vendor/customer/' . $template->client_id . '/orders?orderId=&quickdate=&fromTime=&toTime=&status=&method=&type=&orderForm=Search');
            }
            elseif ($request->order_template_type == OrderTemplate::SINGlE_DATE) {
                if (empty($request->date)) {
                    Session::flash('error', 'There is no date selected to generate repeat orders, please select a date and retry');
                    return Redirect('/vendor/customer/' . $template->client_id);
                } else {
                    switch ($template->repeat) {
                        case 'On Call':
                            $date = date('Y-m-d', strtotime($request->date));
                            $days_allowed = $template->days_allowed;
                            $start_date = Carbon::parse($date);
                            $day = $start_date->dayOfWeek;
                            if (in_array($day, $days_allowed)) {
                                $this->generateRepeatOrders($template, $quantities, $products, $date, $cost, $prices);
                            }
                            break;
                    }
                    Session::flash('message', 'Single day order has been successfully created');
                    return Redirect('/vendor/customer/' . $template->client_id . '/orders?orderId=&quickdate=&fromTime=&toTime=&status=&method=&type=&orderForm=Search');
                }
            }
            else {
                Session::flash('message', 'Order creation failed.');
                return Redirect('/vendor/customer/' . $template->client_id . '/orders?orderId=&quickdate=&fromTime=&toTime=&status=&method=&type=&orderForm=Search');
            }
        } else {
            Session::flash('error', 'No products were assigned Or No active templates, Please assign products and retry this process.');
            return Redirect('/vendor/customer/' . $template->client_id . '/orders?orderId=&quickdate=&fromTime=&toTime=&status=&method=&type=&orderForm=Search');
        }

    }

    public function generateRepeatOrders($template, $quantities, $products, $dateIncrement, $cost, $prices)
    {
        $order = Order::create([
            'order_type' => Order::REPEAT_ORDERS,
            'template_id' => $template->id,
            'customerid' => $template->client_id,
            'quantities' => $quantities,
            'products' => $products,
            'payment_status' => "Pending",
            'customer_email' => $template->client->email,
            'customer_name' => $template->client->firstname . " " . $template->client->lastname,
            'customer_phone' => $template->client->phone,
            'customer_address' => $template->client->address,
            'customer_city' => $template->client->city,
            'customer_zip' => $template->client->zip,
            'shipping_email' => $template->email,
            'shipping_name' => $template->name,
            'shipping_phone' => $template->phone,
            'shipping_address' => $template->address,
            'shipping_city' => $template->city,
            'shipping_zip' => $template->zip,
            'job_type' => $template->job_type_id,
            'job_notes' => $template->special_notes,
            'job_status' => 'Scheduled',
            'job_name' => $template->name,
            'booking_date' => $dateIncrement,
            'status' => "scheduled",
            'job_service_time' => $template->avg_service_time,
            'po_number' => $template->po_cro_no,
            'method' => $template->payment_method,
            'pay_amount' => number_format((float)$cost, 2, '.', ''),
        ]);
        $productIds = explode(',', $products);
        $productQuantities = explode(',', $quantities);
        foreach ($productIds as $data => $product) {
            $orderProduct = new OrderedProducts();

            $product = Product::findOrFail($product);

            $orderProduct['orderid'] = $order->id;
            $orderProduct['owner'] = $product->owner;
            $orderProduct['vendorid'] = $product->vendorid;
            $orderProduct['productid'] = $productIds[$data];
            $orderProduct['quantity'] = $productQuantities[$data];
            $orderProduct['payment'] = "pending";
            $orderProduct['cost'] = $prices[$data] * $productQuantities[$data];
            $orderProduct->save();

            $stocks = $product->stock - $productQuantities[$data];
            if ($stocks < 0) {
                $stocks = 0;
            }
            $quant['stock'] = $stocks;
            $product->update($quant);
        }

    }

    public function OrderTemplateOrderView($id)
    {
        $order = Order::where('id', $id)->first();
        $products = OrderedProducts::where('orderid', $id)->get();
        return view('vendor.ordertemplate-order-show', compact('order', 'products'));
    }

    public function OrderTemplateOrderDelete($id)
    {
        $order = Order::where('id', $id)->first();
        $customerid = $order->customerid;
        $order->delete();
        $products = OrderedProducts::where('orderid', $id)->get();
        foreach ($products as $product) {
            $product->delete();
        }
        Session::flash('message', 'Order has been successfully Deleted');
        return Redirect('/vendor/customer/' . $customerid . '/orders?orderId=&quickdate=&fromTime=&toTime=&status=&method=&type=&orderForm=Search');
    }

    public function getMonthRange($start_date, $end_date, $months_apart,$days_allowed)
    {
        $startMonth = date('Y-m-d', strtotime($start_date));
        $startDate = Carbon::parse($startMonth);
        $startMonth = $startDate->month;
        $endMonth = date('Y-m-d', strtotime($end_date));
        $endDate = Carbon::parse($endMonth);
        $endMonth = $endDate->month;

        $i = 0;
        foreach (range($startMonth, $endMonth, $months_apart) as $number) {

            if ($i == 0) {
                $first_start = date('Y-m-d', strtotime($start_date));
                $first_end = date('Y-m-d', strtotime('last day of this month', strtotime($start_date)));
                $monthData = array('month' => $i, 'start' => $first_start, 'end' => $first_end);
            } else {
                $month = date('Y-m-d', strtotime("+" . $i . " month", strtotime($start_date)));
                $month_start = date('Y-m-d', strtotime('first day of this month', strtotime($month)));
                $month_end = date('Y-m-d', strtotime('last day of this month', strtotime($month)));
                $monthData = array('month' => $i, 'start' => $month_start, 'end' => $month_end);
            }
            $monthList[] = $monthData;

            $i = $number;
        }

        foreach ($monthList AS $value) {
            $finalOut[] = $this->getMonthRangeByNext($value['start'],$value['end']);
        }


        $finalList = $this->putOneList($finalOut);
        foreach ($finalList As $days)
        {
            $day = Carbon::parse($days);
            $allow=$day->dayOfWeek;
            if(in_array($allow,$days_allowed))
            {
                $list[]=$days;
            }
        }
        return $list;
    }

    public function getMonthRangeByNext($first,$last)
    {
        $i = 0;
        while (end($datesFirst) < $last) {
            $incrementDate = date('Y-m-d', strtotime($first . '+' . $i . ' days'));
            $datesFirst[] = $incrementDate;
            $i++;
        }
        return $datesFirst;
    }

    public function getDateRange($start_date, $end_date, $days_apart,$days_allowed)
    {
        $i = $days_apart;
        $dates = array($start_date);
        while (end($dates) < $end_date) {
            $incrementDate = date('Y-m-d', strtotime(end($dates) . ' +' . $i . ' days'));
            if ($incrementDate > $end_date) {
                break;
            }
            $dates[] = $incrementDate;
            $i = +$days_apart;
        }

        foreach ($dates As $days)
        {
            $day = Carbon::parse($days);
            $allow=$day->dayOfWeek;
            if(in_array($allow,$days_allowed))
            {
                $list[]=$days;
            }
        }
        return $list;
    }

    public function getDateRangeNonApart($start_date, $end_date)
    {
        $i = 0;
        $dates = array($start_date);
        while (end($dates) < $end_date) {
            $incrementDate = date('Y-m-d', strtotime(end($dates) . ' +' . $i . ' days'));
            if ($incrementDate > $end_date) {
                break;
            }
            $dates[] = $incrementDate;
            $i++;
        }

        return $dates;
    }

    public function getDatesFromRange($start, $end)
    {

        $dates = array($start);
        while (end($dates) < $end) {
            $dates[] = date('Y-m-d', strtotime(end($dates) . ' +1 day'));
        }

        return $dates;
    }

    public function putOneList($finalList)
    {
        foreach ($finalList AS $key => $val) {
            foreach ($val as $value) {
                $flat[] = $value;
            }
        }

        return $flat;

    }

    public function getWeeklyDateRange($start, $end, $weeks_apart,$days_allowed,$next=null)
    {
        $start = date('Y-m-d', strtotime($start));
        $end = date('Y-m-d', strtotime($end));
        $startDate = Carbon::parse($start);
        $dayWeek = $startDate->dayOfWeek;
        if($next)
        {
            $i = 0;
            while ($i < 7) {
                $incrementDate = date('Y-m-d', strtotime($start . '+' . $i . ' days'));
                $datesFirst[] = $incrementDate;
                $i++;
            }

        } else {
            $dif = 7 - $dayWeek;
            $i = 0;
            while ($i <= $dif) {
                $incrementDate = date('Y-m-d', strtotime(end($start) . '+' . $i . ' days'));
                $datesFirst[] = $incrementDate;
                $i++;
            }
        }


        $startNext = date('Y-m-d', strtotime(end($datesFirst) . '+1 days'));
        while ($incrementDate <= $end) {
            $incrementDate = date('Y-m-d', strtotime("$startNext +" . $weeks_apart . " week"));
            if ($incrementDate >= $end) {
                break;
            }
            $next = $this->getWeeklyDateRangeByNext($incrementDate);
            $datesRest[] = $next;
            $startNext = end($next);
        }

        if ($datesRest) {
            $lastList = array_merge($datesFirst, $this->putOneList($datesRest));
        } else {
            $lastList = $datesFirst;
        }

        foreach ($lastList As $days)
        {
            $day = Carbon::parse($days);
            $allow=$day->dayOfWeek;
            if(in_array($allow,$days_allowed))
            {
                $list[]=$days;
            }
        }
        return $list;
    }

    public function getWeeklyDateRangeByNext($next)
    {

        $i = 0;
        while ($i < 7) {
            $incrementDate = date('Y-m-d', strtotime($next . '+' . $i . ' days'));
            $datesFirst[] = $incrementDate;
            $i++;
        }
        return $datesFirst;
    }

    public function getQuarterlyRange($start_date, $end_date, $days_allowed)
    {
        $start_date = date('Y-m-d', strtotime($start_date));
        for ( $i = 0; $i < 60; $i++ ) {
            $incrementDate =  date('Y-m-d', strtotime(' +'.$i.' days', strtotime($start_date)));
            $day = Carbon::parse($incrementDate);
            $allow=$day->dayOfWeek;
            if(in_array($allow,$days_allowed) AND $incrementDate>$end_date)
            {
                $list[]=$incrementDate;
            }

        }
        return $list;
    }

    public function getSemiAnnualRange($start_date, $end_date, $days_allowed)
    {
        $start_date = date('Y-m-d', strtotime($start_date));
        for ( $i = 0; $i < 180; $i++ ) {
            $incrementDate =  date('Y-m-d', strtotime(' +'.$i.' days', strtotime($start_date)));
            $day = Carbon::parse($incrementDate);
            $allow=$day->dayOfWeek;
            if(in_array($allow,$days_allowed) AND $incrementDate>$end_date)
            {
                $list[]=$incrementDate;
            }
        }
        return $list;

    }

    public function getYearlyRange($start_date, $end_date, $days_allowed)
    {
        $start_date = date('Y-m-d', strtotime($start_date));
        for ( $i = 0; $i < 360; $i++ ) {
            $incrementDate =  date('Y-m-d', strtotime(' +'.$i.' days', strtotime($start_date)));
            $day = Carbon::parse($incrementDate);
            $allow=$day->dayOfWeek;
            if(in_array($allow,$days_allowed) AND $incrementDate>$end_date)
            {
                $list[]=$incrementDate;
            }
        }
        return $list;
    }

}
