<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {

    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
//new-template
Route::resource('user-dashboard', 'UserDetailController');
Route::get('user/account-details', 'UserDetailController@accinfo')->name('user.account-details');
Route::post('user/account-update/{id}', 'UserDetailController@updateDetails')->name('user.update');
Route::post('user/add-multiple-address/{id}', 'UserDetailController@addMultipleAddress')->name('user.add-multiple-address');
Route::post('user/update-multiple-address/{id}', 'UserDetailController@updateMultipleAddress');
Route::post('user/password-change/{id}', 'UserDetailController@passChange')->name('user.password-change');
Route::post('user/add-product-favourite', 'UserDetailController@addFav')->name('add-product-favourite');
Route::get('user/product-favourite', 'UserDetailController@getFavProduct')->name('user.product-favourite');
Route::get('user/api/product-favourite', 'UserDetailController@getFavProductAPI')->name('api.user.product-favourite.get');
Route::delete('user/api/product-favourite/{id}', 'UserDetailController@removeFavProductAPI')->name('api.user.product-favourite.remove');
Route::get('user-orders', 'UserDetailController@getOrders')->name('user.myorders');
Route::get('user/product-favourite-remove/{id}', 'UserDetailController@productFavouriteRemove')->name('user.product-favourite-remove');
Route::get('user/multiple-address-remove/{id}', 'UserDetailController@multipleAddressRemove')->name('user.multiple-address-remove');
Route::get('user/multiple-address-edit/{id}', 'UserDetailController@multipleAddressEdit')->name('user.multiple-address-edit');
Route::get('user/refer-friend', 'UserDetailController@referFriend')->name('user.refer-friend');
Route::post('user/send-refer-mail', 'UserDetailController@sendReferMail')->name('user.send-refer-mail');
Route::get('user/order-details/{id}', 'UserDetailController@userOrderDetails');
Route::post('user/search-data', 'UserDetailController@searchData')->name('user.search-data');

Route::get('/user-billing-setting', 'PageController@getUserBilling')->name('user-billing-setting');
Route::get('/user-account-address', 'PageController@getUserAccountAddress')->name('user-account-address');
Route::get('/user/activation/{token}', 'Auth\ResetPasswordController@userActivation');
Route::get('/user/resetPassword/{token}', 'Auth\ResetPasswordController@userResetPass');
Route::post('/user/changePassword', 'Auth\ResetPasswordController@userChangePass');

//Route::get('/user-favourites', 'PageController@getUserFavourites')->name('user-favourites');
//end-new-template
Route::get('/', 'FrontEndController@index');
Route::get('/about', 'FrontEndController@about');
Route::get('/faq', 'FrontEndController@faq');
Route::get('/contact', 'FrontEndController@contact');
Route::get('/listall', 'FrontEndController@all');
Route::get('/listfeatured', 'FrontEndController@featured');
Route::get('/services/{category}', 'FrontEndController@category');
Route::get('/services/order/{id}', 'FrontEndController@order');
Route::post('/subscribe', 'FrontEndController@subscribe');
Route::post('/profile/email', 'FrontEndController@usermail');
Route::post('/contact/email', 'FrontEndController@contactmail');
Route::get('/profile/{id}/{name}', 'FrontEndController@viewprofile');
Route::get('product/{id}/{title}', 'FrontEndController@productdetails')->name('product.details');
Route::get('loadcategory/{slug}/{page}', 'FrontEndController@loadcatproduct');
Route::get('category/{slug}', 'FrontEndController@catproduct')->name('categories.product');
Route::get('tags/{tag}', 'FrontEndController@tagproduct');
Route::get('/blogs', 'FrontEndController@allblog');
Route::get('/blog/{id}', 'FrontEndController@blogdetails');
Route::get('shop/{id}', 'FrontEndController@vendorproduct');
Route::get('shop/{id}/{name}', 'FrontEndController@vendorproduct');
Route::get('loadvendor/{id}/{page}', 'FrontEndController@loadvendproduct');
Route::get('search/{search}', 'FrontEndController@searchproduct');

Route::get('quick-view/{id}', 'FrontEndController@getProduct');

Route::post('user/review', 'FrontEndController@reviewsubmit')->name('review.submit');

Route::get('/checkout', 'ClientsController@checkout')->name('user.checkout');

Route::get('user/dashboard', 'ClientsController@index')->name('user.account');
Route::get('user/account-information', 'ClientsController@accinfo')->name('user.accinfo');
Route::get('user/account-password', 'ClientsController@userchangepass')->name('user.accpass');
Route::get('user/orders', 'ClientsController@userorders')->name('user.orders');
Route::get('user/order/{id}', 'ClientsController@userorderdetails');
Route::post('user/update/{id}', 'ClientsController@update')->name('user.update');
Route::post('user/passchange/{id}', 'ClientsController@passchange')->name('user.passchange');

Route::get('/cart', 'FrontEndController@cart')->name('user.cart');


Route::get('/cartdelete/{id}', 'FrontEndController@cartdelete');
Route::get('/cartdelete/product/{id}', 'FrontEndController@cartdeleteProduct');
Route::get('/cartupdate', 'FrontEndController@cartupdate');
Route::post('/cartupdate', 'FrontEndController@cartupdate')->name('api.user.cartupdate');
Route::get('/cart/product/qtyup/{id}', 'FrontEndController@cartProductQtyUp');
Route::get('/cart/product/qtydown/{id}', 'FrontEndController@cartProductQtyDown');

Route::get('/getchildcategories', 'FrontEndController@getChildCategories')->name('get.child.categories');
Route::get('/getproductsbycategory', 'FrontEndController@getProductsByCategory')->name('get.products');
Route::get('/getproductsbysearch', 'FrontEndController@getProductsBySearch')->name('search.products');
Route::get('/getcartdata', 'FrontEndController@getCartData')->name('get.cart.data');

// Route::group(['middleware' => ['guest:profile']], function () {
Route::get('/order-summary', 'OrderSummaryController@index')->name('order.summary');
// });
// Route::group(['middleware' => ['auth']], function () {
Route::get('/order-confirm', 'OrderConfirmController@index')->name('order.confirm');
Route::get('/order-confirmed', 'OrderConfirmController@confirmed')->name('order.confirmed');
// });

// static pages
Route::get('/deals', 'StaticPageController@deals')->name('static.deals');
Route::get('/buy-credits', 'StaticPageController@packages')->name('static.packages');
Route::get('/locations', 'StaticPageController@locations')->name('static.locations');
Route::get('/request-pickup', 'StaticPageController@requestPickup')->name('static.requestpickup');
Route::get('/drop-off', 'StaticPageController@dropOff')->name('static.dropoff');
Route::get('/rewards', 'StaticPageController@rewards')->name('static.rewards');

Route::get('/vendor', function () {
    return view('vendor.index');
})->name('vendor.login');

Route::get('/login', function () {
    return view('admin.login');
});

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.login');


Route::get('signin/{type}', 'Auth\LoginController@signIn');

Auth::routes();


Route::get('/vendor', 'Auth\VendorLoginController@showLoginForm')->name('vendor.login');
Route::post('/vendor/login', 'Auth\VendorLoginController@login')->name('vendor.login.submit');
Route::get('/vendor/registration', 'Auth\VendorRegistrationController@showRegistrationForm')->name('vendor.reg');
Route::post('/vendor/registration', 'Auth\VendorRegistrationController@register')->name('vendor.reg.submit');

Route::post('/plant/login', 'Auth\PlantLoginController@login')->name('plant.login.submit');
Route::get('/plant/dashboard', 'PlantController@index')->name('plant.dashboard');

Route::get('/vendor/withdraws', 'VendorController@withdraws');
Route::any('/vendor/customers', 'VendorController@customers');


Route::get('vendor/details/{id}', 'VendorController@details');

Route::get('/vendor/plant', 'VendorController@plant');
Route::get('/vendor/pos', 'VendorController@pos');
Route::get('/vendor/withdrawmoney', 'VendorController@withdraw');
Route::post('/vendor/withdrawsubmit', 'VendorController@withdrawsubmit')->name('account.withdraw.submit');;
Route::get('/vendor/dashboard', 'VendorController@index')->name('vendor.dashboard');
Route::get('vendor/products/status/{id}/{status}', 'VendorProductsController@status');
Route::resource('/vendor/products', 'VendorProductsController');

Route::get('vendor/vieworders/{status}', 'VendorController@vieworders');

Route::get('vendor/profile/{id}', 'VendorController@profile');


Route::get('/admin/registration', 'Auth\AdminRegistrationController@showAdminRegistrationForm')->name('admin.reg');
Route::post('/admin/register', 'Auth\AdminRegistrationController@register')->name('admin.reg.submit');
Route::get('/admin/activation/{token}', 'Auth\ResetPasswordController@adminActivation');
Route::get('/admin/resetPassword/{token}', 'Auth\ResetPasswordController@adminResetPassword');
Route::post('/admin/changePassword', 'Auth\ResetPasswordController@adminChangePassword');

Route::get('/admin/dashboard', 'HomeController@index')->name('admin.dashboard');
Route::post('/admin/updatecolor', 'SettingsController@themecolor');

Route::post('admin/settings/title', 'SettingsController@title');
Route::post('admin/settings/payment', 'SettingsController@payment');
Route::post('admin/settings/about', 'SettingsController@about');
Route::post('admin/settings/delivery-fee', 'SettingsController@delivery_fee');
Route::post('admin/settings/donation-amount', 'SettingsController@updateDonationAmount');
Route::post('admin/settings/address', 'SettingsController@address');
Route::post('admin/settings/footer', 'SettingsController@footer');
Route::post('admin/settings/logo', 'SettingsController@logo');
Route::post('admin/settings/favicon', 'SettingsController@favicon');
Route::post('admin/settings/pickup', 'SettingsController@pickup');
Route::get('admin/settings/pickup-del/{id}', 'SettingsController@pickdel');
Route::post('admin/settings/background', 'SettingsController@background');
Route::get('admin/language-settings', 'SettingsController@setlanguage');
Route::post('admin/settings/language', 'SettingsController@language');
Route::resource('/admin/settings', 'SettingsController');

Route::resource('/admin/sliders', 'SliderController');

Route::get('/admin/customers/email/{id}', 'CustomerController@email');
Route::post('/admin/customers/emailsend', 'CustomerController@sendemail');
Route::resource('/admin/customers', 'CustomerController');
Route::get('/admin/customers/{id}', 'CustomerController@show');
//Route::post('/admin/customers/destroy', 'CustomerController@destroy');
Route::any('/searchAjaxCities', 'CustomerController@getCities');
Route::any('/assignCustomersToVendor', 'CustomerController@assignCustomers');
Route::post('/admin/customers/searchResults', 'CustomerController@getCustomerSearchResults');

Route::resource('/admin/referrals', 'ReferralProgramController');

Route::get('/vendor/activation/{token}', 'Auth\ResetPasswordController@vendorActivation');
Route::get('/vendor/resetPassword/{token}', 'Auth\ResetPasswordController@vendorResetPassword');
Route::post('/vendor/changePassword', 'Auth\ResetPasswordController@vendorChangePassword');
Route::get('/admin/vendors/accept/{id}', 'VendorsController@accept');
Route::get('/admin/vendors/reject/{id}', 'VendorsController@reject');
Route::get('/admin/vendors/pending', 'VendorsController@pending');
Route::get('/admin/vendors/email/{id}', 'VendorsController@email');
Route::post('/admin/vendors/emailsend', 'VendorsController@sendemail');
Route::resource('/admin/vendors', 'VendorsController');
Route::get('/admin/vendors/show/{id}', 'VendorsController@show');

Route::post('/admin/blog/titles', 'BlogController@titles');
Route::resource('/admin/blog', 'BlogController');

Route::post('/admin/service/titles', 'ServiceSectionController@titles');
Route::resource('/admin/service', 'ServiceSectionController');

Route::post('/admin/testimonial/titles', 'TestimonialController@titles');
Route::resource('/admin/testimonial', 'TestimonialController');


Route::resource('/admin/services', 'ServiceController');
Route::get('/admin/categories/delete/{id}', 'CategoryController@delete');
Route::resource('/admin/categories', 'CategoryController');

Route::get('/subcats/{id}', 'SubCategoryController@subcats');
Route::get('/childcats/{id}', 'ChildCategoryController@childcats');

Route::resource('/admin/subcategory', 'SubCategoryController');
Route::resource('/admin/childcategory', 'ChildCategoryController');

Route::get('admin/brand/add', 'PageSettingsController@addbrand');
Route::get('admin/brand/{id}/delete', 'PageSettingsController@branddelete');
Route::get('admin/brand/{id}/edit', 'PageSettingsController@brandedit');
Route::post('admin/brand/{id}/update', 'PageSettingsController@brandupdate');
Route::post('admin/brand/brandsave', 'PageSettingsController@brandsave');

Route::get('admin/banner/add', 'PageSettingsController@addbanner');
Route::get('admin/banner/{id}/delete', 'PageSettingsController@bannerdelete');
Route::get('admin/banner/{id}/edit', 'PageSettingsController@banneredit');
Route::post('admin/banner/{id}/update', 'PageSettingsController@bannerupdate');
Route::post('admin/banner/save', 'PageSettingsController@bannersave');

Route::get('admin/faq/add', 'PageSettingsController@addfaq');
Route::get('admin/faq/{id}/delete', 'PageSettingsController@faqdelete');
Route::get('admin/faq/{id}/edit', 'PageSettingsController@faqedit');
Route::post('admin/faq/{id}/update', 'PageSettingsController@faqupdate');
Route::post('admin/pagesettings/faqsave', 'PageSettingsController@faqsave');
Route::post('admin/banner/large', 'PageSettingsController@largebanner');

Route::post('admin/pagesettings/about', 'PageSettingsController@about');
Route::post('admin/pagesettings/faq', 'PageSettingsController@faq');
Route::post('admin/pagesettings/contact', 'PageSettingsController@contact');
Route::resource('/admin/pagesettings', 'PageSettingsController');

Route::get('admin/products/pending', 'ProductController@pending');
Route::get('admin/products/pending/{id}', 'ProductController@pendingdetails');
Route::get('admin/products/status/{id}/{status}', 'ProductController@status');
Route::resource('/admin/products', 'ProductController');

Route::get('admin/ads/status/{id}/{status}', 'AdvertiseController@status');

Route::resource('/admin/ads', 'AdvertiseController');
Route::resource('/admin/social', 'SocialLinkController');
Route::resource('/admin/tools', 'SeoToolsController');
Route::get('admin/subscribers/download', 'SubscriberController@download');

Route::resource('/admin/subscribers', 'SubscriberController');
Route::post('/admin/adminpassword/change/{id}', 'AdminProfileController@changepass');
Route::get('/admin/adminpassword', 'AdminProfileController@password');
Route::resource('/admin/adminprofile', 'AdminProfileController');
Route::resource('admin/job-types', 'JobTypeController');


Route::get('/vendor/vendorpassword', 'VendorProfileController@password');

Route::post('/vendor/vendorpassword/change/{id}', 'VendorProfileController@changepass');

Route::post('/vendor/login-accounts', 'VendorProfileController@loginuser');
Route::post('/vendor/bank-account', 'VendorProfileController@bankaccount');

Route::resource('/vendor/settings', 'VendorProfileController');

Route::get('/vendor/delete-bank-account', 'VendorProfileController@deletebankaccount');
Route::get('/vendor/delete-login-user', 'VendorProfileController@deleteloginuser');

Route::get('/admin/withdraws/pending', 'WithdrawController@pendings');
Route::get('/admin/withdraws/accept/{id}', 'WithdrawController@accept');
Route::get('/admin/withdraws/reject/{id}', 'WithdrawController@reject');
Route::resource('/admin/withdraws', 'WithdrawController');

Route::get('/admin/orders/status/{id}/{status}', 'OrderController@status');
Route::get('/admin/orders/email/{id}', 'OrderController@email');
Route::post('/admin/orders/emailsend', 'OrderController@sendemail');
Route::post('/admin/orders/bulkMailSend', 'OrderController@sendBulkEmail');
Route::resource('/admin/orders', 'OrderController');
Route::post('/admin/orders/bulkMailSend', 'OrderController@sendBulkEmail');
Route::any('/getAjCities', 'OrderController@getCities');
Route::post('/admin/orders/searchResults', 'OrderController@searchResults');

Route::get('/vendor/orders/status/{id}/{status}', 'VendorOrdersController@status');
Route::resource('/vendor/orders', 'VendorOrdersController');

// Route::post('/payment', 'PaymentController@store')->name('payment.submit');
// Route::get('/payment/cancle', 'PaymentController@paycancle')->name('payment.cancle');
// Route::get('/payment/return', 'PaymentController@payreturn')->name('payment.return');
// Route::post('/payment/notify', 'PaymentController@notify')->name('payment.notify');

//paypal routes
// Route::post('payment/paypal', 'PayPalController@payment')->name('payment');
Route::get('cancel/paypal', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success/paypal', 'PayPalController@success')->name('payment.success');
Route::post('payment/purchase/order', 'PayPalController@payment')->name('purchase.order');

Route::get('payment/buy-credits/paypal', 'PayPalController@buyCredits')->name('buy.credits');
Route::get('payment/buy-credits/success/paypal', 'PayPalController@creditSuccess')->name('payment.credits.success');

Route::post('/stripe-submit', 'StripeController@store')->name('stripe.submit');

Route::post('/cashondelivery', 'FrontEndController@cashondelivery')->name('cash.submit');
Route::post('/mobile_money', 'FrontEndController@mobilemoney')->name('mobile.submit');
Route::post('/bank_wire', 'FrontEndController@bankwire')->name('bank.submit');

Route::get('/user/login', 'Auth\ProfileLoginController@showLoginFrom')->name('user.login');
Route::post('/user/login', 'Auth\ProfileLoginController@login')->name('user.login.submit');
Route::get('/user/registration', 'Auth\ProfileRegistrationController@showRegistrationForm')->name('user.reg');
Route::post('/user/registration', 'Auth\ProfileRegistrationController@register')->name('user.reg.submit');
Route::post('/user/get-address', 'Auth\ProfileRegistrationController@getAddress')->name('user.get.address');

Route::get('/user/forgot', 'Auth\ProfileResetPassController@showForgotForm')->name('user.forgotpass');
Route::post('/user/forgot', 'Auth\ProfileResetPassController@resetPass')->name('user.forgotpass.submit');

Route::get('/vendor/forgot', 'Auth\VendorResetPassController@showForgotForm')->name('vendor.forgotpass');
Route::post('/vendor/forgot', 'Auth\VendorResetPassController@resetPass')->name('vendor.forgotpass.submit');

Route::get('/admin/forgot', 'Auth\AdminResetPassController@showForgotForm')->name('admin.forgotpass');
Route::post('/admin/forgot', 'Auth\AdminResetPassController@resetPass')->name('admin.forgotpass.submit');

Route::post('/vendor/action/request-pickup', 'VendorActionsController@requestpickup');
Route::post('/vendor/action/batch-notify', 'VendorActionsController@batchnotify');
Route::get('/vendor/action/send-notification', 'VendorActionsController@sendnotification');


Route::resource('/admin/coupons', 'CouponController');
Route::get('admin/coupons/status/{id}/{status}', 'CouponController@status');

Route::post('/apply-coupon', 'FrontEndController@applyCoupon')->name('coupon.apply');
Route::delete('/remove-coupon', 'FrontEndController@removeCoupon')->name('coupon.remove');

Route::get('/newhome', 'FrontEndController@newhome')->name('newhome');
Route::get('/newhome2', 'FrontEndController@newhometwo')->name('newhometwo');

Route::resource('/admin/gift-cards', 'GiftCardController');
Route::get('admin/gift-cards/status/{id}/{status}', 'GiftCardController@status');
Route::get('user/gift-cards', 'BuyGiftCardController@index')->name('user-gift-cards');
Route::post('user/gift-cards/buy/{id}', 'BuyGiftCardController@buy');
Route::post('user/gift-cards/redeem/{id}', 'BuyGiftCardController@redeem');
Route::post('user/gift-cards/send/{id}', 'BuyGiftCardController@send');
Route::get('user/gift-cards/validate/{id}/{auth_code}', 'BuyGiftCardController@validate')->name('user.gift_card_validate');

//Route for gift friend

Route::get('user/gift-cards/gift-friend/{id}', 'GifttoaFriendController@gift');

Route::get('user/gift-cards/payment/fail/', 'BuyGiftCardController@paymentFail')->name('user.giftcardspayment.fail');
Route::get('user/gift-cards/payment/complete/', 'BuyGiftCardController@paymentComplete')->name('user.giftcardspayment.complete');

Route::get('/holiday2019', 'GiftCodeController@create');
Route::post('/gift-code/is-unique-code', 'GiftCodeController@isUniqueCode')->name('giftcode.isuniquecode');

Route::post('/gift-code', 'GiftCodeController@store')->name('giftcode.store');

// Route::get('/gift-code', 'GiftCodeController@create')->name('giftcode.store');


Route::any('/vendor/customer', 'VendorController@customer')->name('vendor.customer');
Route::get('/vendor/customer/{id}', 'VendorController@show')->name('vendor.customer.show');
Route::get('/vendor/customer/{id}/templates', 'VendorController@templates')->name('vendor.customer.templates');
Route::get('/vendor/customer/{id}/orders', 'VendorController@orders')->name('vendor.customer.orders');
Route::get('/vendor/template/{id}/create', 'OrderTemplateController@create')->name('vendor.customer.create');
Route::any('/vendor/customer/add', 'ClientController@customerAdd')->name('vendor.customer_add');
Route::post('/vendor/customer/update', 'ClientController@customerUpdate')->name('vendor.customer_update');
Route::any('/vendor/order', 'VendorOrderController@index')->name('vendor.order');
Route::any('/vendor/order/add', 'VendorOrderController@orderAdd')->name('vendor.order_add');
Route::any('/vendor/order/confirm', 'VendorOrderController@confirmOrder')->name('vendor.order_confirm');
Route::any('/vendor/order/get_ajax_product', 'VendorOrderController@getAJAXProduct')->name('get_ajax_product');

Route::resource('/vendor/order-template', 'OrderTemplateController');
Route::post('/vendor/order-template/generate', 'OrderTemplateController@makeRecurringOrder');
Route::post('/vendor/order-template/update', 'OrderTemplateController@update');
Route::get('/vendor/repeat-template-delete/{id}', 'OrderTemplateController@repeatTemplateDelete');
Route::get('/vendor/order-template-order/{id}', 'OrderTemplateController@OrderTemplateOrderView');
Route::get('/vendor/order-template-delete/{id}', 'OrderTemplateController@OrderTemplateOrderDelete');
Route::resource('/vendor/template-product', 'OrderTemplateItemController');
Route::post('/vendor/template-product/get-price', 'OrderTemplateItemController@getProductPrice');
Route::get('/vendor/get-template-ajax/{client_id}', 'OrderTemplateController@getTemplateAjax');
Route::get('/vendor/get-template-ajax-by-vendor', 'OrderTemplateController@getTemplateByVendor');
Route::get('/vendor/get-template-order-ajax/{client_id}', 'OrderTemplateController@getTemplateOrderAjax');
Route::post('/vendor/get-template-order-delete/{client_id}', 'OrderTemplateController@getTemplateOrderDelete');
Route::post('/vendor/get-order-template-activate', 'OrderTemplateController@getOrderTemplateActivate');
Route::any('/vendor/customer/get_ajax_search_client', 'ClientController@getAJAXSearchClient')->name('get_ajax_search_client');
Route::any('/vendor/customer/get_ajax_client', 'ClientController@getAJAXClient')->name('get_ajax_client');
Route::get('new-customer-order', 'ClientOrderController@index');
Route::any('/vendor/order/jobstatus', 'VendorOrderController@orderjobstatus')->name('vendor.order_job_status');


Route::get('/clientorder', 'ClientOrderController@index');
Route::any('/clientorder/store', 'ClientOrderController@ClientorderAdd')->name('clientorder.store');
Route::any('/client/order/get_ajax_product', 'ClientOrderController@getAJAXProduct')->name('client.get_ajax_product');
Route::any('/client/conform/get_ajax_product', 'ClientOrderController@getAJAXProductname')->name('conform.get_ajax_product');
Route::get('orders_details_mail/{id}', 'ClientOrderController@orders_details_mail')->name('orders_details_mail');

Route::any('/user_activated/{takn}/{ord_id}', 'ClientOrderController@user_activate');
Route::get('/newclientorderconfirm', 'VendorClientController@index');
Route::any('/customer/chang_pass/', 'ClientOrderController@vendor_user_change_pass')->name('customer.chang_pass');
Route::any('/client_user_activate/{takn}', 'ClientOrderController@client_user_activate');

//Index Page Routes
Route::get('/home', 'IndexController@showHome')->name('indexPage');
Route::get('/home/customers', 'IndexController@showCustomersPage')->name('home.order');
Route::get('/request_quote', 'IndexController@showRequestQuote')->name('quote');
Route::post('/request_quote/submit', 'IndexController@submitQuote')->name('quote.submit');

//Shop home page
Route::get('/shop/{id}', 'ShopFrontController@showFrontPage')->name('shop.index');
Route::get('/medical_masks', 'ShopFrontController@showMasksPage')->name('shop.masks');

################### OTHERS ##################
Route::get('/run-cmd', function () {
    /*Artisan::call('migrate');
    Artisan::call('make:auth');
    Artisan::call('make:controller', ['name' => 'DemoController']);
    dd(Artisan::output());*/
    exec('composer dump-autoload');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    echo('success');
});
