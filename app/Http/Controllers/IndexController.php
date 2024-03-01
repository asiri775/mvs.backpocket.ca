<?php

namespace App\Http\Controllers;

use App\AddressMultiple;
use App\Clients;
use App\Mail\QuoteRequestMail;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function showHome()
    {
        return view('home.index');
    }

    public function showCustomersPage()
    {
        return view('home.customers');
    }

    public function showRequestQuote()
    {
        return view('home.quote_request.quote_request');
    }

    public function submitQuote(Request $request)
    {
        $data = array(
            'address' => $request->address,
            'street_no' => $request->street_no,
            'unit' => $request->unit,
            'state' => $request->state,
            'city' => $request->city,
            'zip' => $request->zip,
            'service_type' => $request->service_type,
            'qty' => $request->quantity,
            'container_type' => $request->container,
            'service_preference' => $request->service_preference,
            'notes' => $request->notes,
            'idealstart_date' => $request->idealstart_date,
            'specificpost_date' => $request->specificpost_date,
            'am_pm' => $request->am_pm,
            'company' => $request->company,
            'fname' => $request->firstname,
            'lname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'promocode' => $request->promocode
        );

        $user = Clients::create([
            'name' => $request->firstname." ".$request->lastname,
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'phone' => $request->phone,
            'balance' =>  0,
            'email' => $request->email,
            'password' => Hash::make("123"),
            'address' => $request->address,
            'city' => $request->city,
            'Province_State' => $request->state,
            'Country' => $request->country,
            'zip' => $request->zip,
            'longitude' => $request->lontude,
            'latitude' => $request->latude,
            'unit_no' => $request->unit,
            'is_activated' => 0,
            'status' => 1,
            'business_name' => $request->company,
            'special_notes' => $request->notes,
        ]);

        AddressMultiple::create([
            'user_id' => $user->id,
            'address_alias' => "Default",
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
            'province' => $request->state,
            'street' => $request->street_no,
            'longitude' => $request->lontude,
            'latitude' => $request->latude,
        ]);

        Order::create([
            'order_type' => 2,
            'customerid' => $user->id,
            'quantities' => $request->quantity,
            'payment_status' => "Pending",
            'customer_email' => $request->email,
            'customer_name' => $request->firstname." ".$request->lastname,
            'customer_phone' => $request->phone,
            'customer_address' => $request->address,
            'customer_city' => $request->city,
            'customer_zip' => $request->zip,
            'order_note' => $request->notes,
            'booking_date' => Carbon::now(),
            'status' => "scheduled"
        ]);

        $EmailSubject = EmailSubject::where('token', '2cLDTyj3')->first();
        $EmailTemplate = EmailTemplate::where('domain', 1)->where('subject_id', $EmailSubject['id'])->first();

        Mail::to("viranpravinda32@gmail.com")->queue(new QuoteRequestMail($data, $EmailSubject['subject'], $EmailTemplate));

        return view('home.quote_request.quote_welcome');
    }
}
