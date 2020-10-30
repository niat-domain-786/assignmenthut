<?php

use App\User;
include('messenger.php');



Route::get('checkout/{id?}','User\AssignmentController@checkout')->name('checkout_page');
Route::get('cancel-order/{id}','User\AssignmentController@cancel_order_checkout')->name('cancel-order')->middleware('auth');


//Route::get('/', 'MainController@index')->name('index');
Route::get('/',function(){
 return redirect('/'); });

// Auth::routes();
Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/paypal', 'PaypalController@create')->name('paypal.create');
Route::post('/paypal', 'PaypalController@store')->name('paypal.store');
Route::get('/paypal/verify', 'PaypalController@verify')->name('paypal.verify');

Route::post('/order', 'OrderController@store')->name('order.store');
Route::get('/order/verify', 'OrderController@verify')->name('order.verify');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/careers', function () {
    return view('careers');
})->name('careers');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/terms-and-conditions', function () {
    return view('terms-and-condition');
})->name('terms-and-condition');

Route::get('/refund-policy', function () {
    return view('refund-policy');
})->name('refund-policy');

Route::get('/revision-policy', function () {
    return view('revision-policy');
})->name('revision-policy');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/prices', function () {
    return view('prices');
})->name('prices');

Route::get('/business-management-assignment-help', function () {
    return view('business-management-assignment-help');
})->name('business-management-assignment-help');

Route::get('/information-technology-assignment-help', function () {
    return view('information-technology-assignment-help');
})->name('information-technology-assignment-help');

Route::get('/law-assignment-help', function () {
    return view('law-assignment-help');
})->name('law-assignment-help');

Route::get('/management-assignment-help', function () {
    return view('management-assignment-help');
})->name('management-assignment-help');

Route::get('/marketing-assignment-help', function () {
    return view('marketing-assignment-help');
})->name('marketing-assignment-help');

Route::get('/project-management-assignment-help', function () {
    return view('project-management-assignment-help');
})->name('project-management-assignment-help');

Route::get('/psychology-assignment-help', function () {
    return view('psychology-assignment-help');
})->name('psychology-assignment-help');

Route::get('/statistics-assignment-help', function () {
    return view('statistics-assignment-help');
})->name('statistics-assignment-help');

Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware(['auth','can:isUser']);


Route::namespace('Admin')->prefix('admin')->as('admin.')->middleware('role:admin')->middleware(['auth', 'can:isAdmin'])->group( function () {

    Route::resource('/dashboard', 'DashboardController', ['only' => 'index']);

    Route::resource('service', 'ServiceController');
    Route::post('service-enabled', 'ServiceController@enable_service')->name('service_enable');
     Route::get('/transaction', 'DashboardController@trans');
   
    Route::resource('academic-level', 'AcademicLevelController');
    Route::resource('paper', 'PaperController');
    Route::resource('currency', 'CurrencyController');
     Route::delete('delete-price', 'CurrencyController@admin_delete_price')->name('admin_delete_price');
     Route::get('change-email-request', 'UserController@change_email_request');
     Route::get('approve-email-request/{id}', 'UserController@approve_email_request');
     Route::get('reject-email-request/{id}', 'UserController@reject_email_request');

    Route::resource('user', 'UserController');
    Route::resource('order', 'OrderController');

    #completed orders in admin dashboard
    Route::get('completed-orders', 'OrderController@completed_orders')->name('order.completed_orders');

    #revision show
    Route::get('revisions', 'OrderController@revisions')->name('order.revisions');

    # single new revisions page loading
    Route::get('deliver-revisions/{id}', 'OrderController@deliver_revisions')->name('order.deliver_revisions');


    # single completed revisions page loading
    Route::get('completed-revisions', 'OrderController@completed_revisions')->name('order.completed_revisions');

    #submit a revision after updating by admin
    Route::post('submit-revision', 'OrderController@submit_revision')->name('order.submit_revision');

    #admin Profile settings
    Route::get('settings', 'SettingController@index')->name('order.settings');
    #search by admin
    Route::post('search', 'SettingController@search')->name('search');

    Route::post('settings', 'SettingController@store')->name('settings.store');
    Route::resource('paypal', 'PaypalController');
    Route::post('update-paypal-keys', 'PaypalController@update_paypal_keys')->name('update-paypal-keys');

    Route::get('prices/create', 'CurrencyController@add_price')->name('prices-create');

    Route::get('prices/list', 'CurrencyController@price_list')->name('prices-list');

    Route::post('prices/store', 'CurrencyController@store_price')->name('store_price');
    Route::post('get/price', 'CurrencyController@find_price')->name('find_price');
   
});

Route::resource('order', 'OrderController')->middleware(['auth','can:isUser']);

Route::get('/orderfile/{id}', 'OrderController@orderfiledownload')->name('orderfile.download')->middleware('auth');

Route::get('/solved-file-download/{id}', 'OrderController@solvedFileDownload')->name('solver_file.download')->middleware('auth');

Route::get('/revision-attachment-file/{id}', 'OrderController@revision_attached_file_download')->name('revision_attachment.download')->middleware('auth');

Route::get('/revision-file-download/{id}', 'OrderController@revision_file_download')->name('revision-file-download')->middleware('auth');

Route::get('/admin-revision-file-download/{id}', 'OrderController@admin_revision_file_download')->name('admin-revision-file-download')->middleware('auth');

Route::get('/file/{id}', 'OrderController@filedownload')->name('file.download')->middleware('auth');

Route::post('add_revision_file', 'OrderController@add_revision_file')->name('add_revision_file')->middleware('auth');

Route::post('/addnote/{id}', 'OrderController@addnote')->name('addnote')->middleware('auth');

Route::delete('delete-note', 'OrderController@deleteNote')->name('deleteNote')->middleware('auth');

#delete revision files(soft delete)
Route::delete('delete-file', 'OrderController@deleteFile')->name('deleteFile')->middleware('auth');

#force delete files
Route::delete('delete-file-by-admin', 'OrderController@delete_file_by_admin')->name('deleteFileAdmin')->middleware('auth');

Route::post('/addfile/{id}', 'OrderController@addfile')->name('addfile')->middleware('auth');
Route::post('/deliver_project/{orderId}', 'OrderController@deliverFile')->name('DeliverFile')->middleware('auth');

Route::post('/download_completed_assignment', 'OrderController@download_completed_assignment')->name('download_completed_assignment')->middleware('auth');

Route::post('/delete_user_order', 'OrderController@delete_user_order')->name('delete_user_order')->middleware(['auth','can:isUser']);


#user revision page
Route::get('/revisions', 'OrderController@show_revisions')->name('show_revisions')->middleware(['auth','can:isUser']);

#submit a revision by user
Route::post('/submit-revision', 'OrderController@submitRevision')->name('submitRevision')->middleware(['auth','can:isUser']);


#user info settings

Route::post('update_user_info', 'SettingController@update_user_info')->name('update_user_info')->middleware(['auth','can:isUser']);
Route::post('change_password', 'SettingController@change_password')->name('change_password')->middleware(['auth','can:isUser']);
Route::post('update-profile-image', 'SettingController@update_profile_image')->name('update-profile-image')->middleware(['auth','can:isUser']);



# ----------------------------------------
Route::prefix('user')->group(function () {
    Route::post('place-order-registered', 'User\AssignmentController@place_order_registered')->name('place_order_registered');

    Route::post('update-price', 'User\AssignmentController@update_price')->name('update_price');
    Route::post('update-user-phone', 'SettingController@update_user_phone')->name('update-user-phone');
    Route::post('/request_change_email', 'SettingController@request_change_email');
    Route::get('/cancel_email_request', 'SettingController@cancel_email_request');
    Route::post('/confirm-order-checkout/{id}', 'User\AssignmentController@confirm_order_checkout')->name('confirm-order-checkout');

});

    Route::get('pay-with-paypal/{id?}', 'PaypalController@payWithpaypal')->name('pay-with-paypal');
    Route::get('execute-payment/{currency}/{price}/{id}', 'PaypalController@execute_payment')->name('execute-payment');

    Route::get('execute-payment-failed', 'PaypalController@execute_payment_failed')->name('execute-payment-failed');
    Route::post('activate_paypal_keys', 'Admin\PaypalController@activate_paypal_keys')->name('activate_paypal_keys');

    // paypal checkout sdk

    Route::get('pay-with-paypal-checkout/{id?}', 'PaypalController@payWithpaypal_checkout_sdk')->name('pay-with-paypal-checkout');

    Route::get('paypal-cancel', 'PaypalController@payment_cancel__checkout_sdk')
    ->name('payment_cancel');

    Route::get('paypal-return/{id?}', 'PaypalController@payment_return__checkout_sdk')
    ->name('payment_return');

    // paypal checkout sdk ends
    // index pade data
    Route::get('get_paper_list/{array?}', 'MainController@get_paper_list');
    Route::get('get_academics/{array?}', 'MainController@get_academics');
    Route::get('get_urgency/{array?}', 'MainController@get_urgency');

    // ====================== view composer ==========================
    // ====================== find change email requests ==========================
View::composer(['admins.partials.left-sidebar'], function ($view) {
$email_request_count = User::where('change_email_request', '!=', '0')->count();

$view->with('email_request_count',$email_request_count);
});
