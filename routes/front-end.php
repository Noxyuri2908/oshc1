<?php


use Illuminate\Support\Facades\Mail;

Route::group(['middleware' => 'locale'], function () {
    Route::get('change-lang/{language}', 'HomeController@changeLanguage')->name('change-language');
});
Route::get('/redirect-page/', 'HomeController@redirectPage')->name('redirectPage');
Route::get('/', 'HomeController@index')->name('homepage');
Route::get('/become-a-agent', 'IndexController@register')->name('become-a-agent');
Route::post('/become-a-agent', 'IndexController@postRegister')->name('become-a-agent');
Route::get('/get-a-quote', [\App\Http\Controllers\GetAQuoteController::class,'getFormQuote'])
    ->name('get-a-quote.get');
Route::post('/get-a-quote', [\App\Http\Controllers\GetAQuoteController::class,'getQuote'])
    ->name('get-a-quote');
Route::get('/get-a-quote/ajax', [\App\Http\Controllers\GetAQuoteController::class,'getQuoteAjax'])
    ->name('get-a-quote.ajax');

Route::get('ajax.getNib', 'GetAQuoteController@getNib')->name('ajax.getNib');
Route::get('ajax.getAhm', 'GetAQuoteController@getAhm')->name('ajax.getAhm');
Route::get('ajax.getMedibank', 'GetAQuoteController@getMedibank')->name('ajax.getMedibank');
Route::get('ajax.getAllian', 'GetAQuoteController@getAllian')->name('ajax.getAllian');
Route::get('ajax.getBupa', 'GetAQuoteController@getBupa')->name('ajax.getBupa');


Route::get('/payment/{id}', 'PaymentController@getForm')
    ->name('payment');
Route::get('/payment-tranfer/ajax', 'PaymentController@paymentTranfer')
    ->name('payment.tranfer');
Route::post('/apply/service/{id}/{price}', 'ApplyController@applyService')->name('apply');
Route::get('/apply/register',[\App\Http\Controllers\ApplyController::class,'register'])->name('apply.register');
Route::get('/apply/{id}', 'ApplyController@apply')->name('apply.get');
Route::post('/apply/register', [\App\Http\Controllers\ApplyController::class,'applyPost'])->name('apply.register.post');
Route::get('/about', 'IndexController@about')->name('about');
Route::get('/special-offer', 'IndexController@specialOffer')->name('special_offer');
Route::post('/special-offer/send-mail', 'IndexController@sendMailSpecialOffer')->name('special-offer.send-mail');

Route::get('/tag/{slug}', 'IndexController@tag')->name('tag');
Route::get('/qa', 'HomeController@getQa')->name('qa');
Route::get('/contact', 'HomeController@getForm')->name('get.contact');
Route::post('/question', 'HomeController@question')->name('question');
Route::get('/subcriber', 'HomeController@subcriber')->name('subcriber');
Route::get('/open/option-view', 'IndexController@getOption')
    ->name('get.option');
Route::get('/get-news-by-cat/ajax', 'IndexController@getNewsByCat')
    ->name('get.news.by.cat');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/download/{id}/{type}', 'PaymentController@downloadInvoice')->name('download');
Route::get('/payment/paypal/{id}', 'PaymentController@paymentPayPal')->name('method.paypal');
Route::get('/payment/credit-card/{id}', 'PaymentController@paymentCredit')->name('method.credit');
Route::get('/customer/comments', 'HomeController@postComment')->name('post.comment');
Route::get('/{slug}.html', 'IndexController@getByMenu')->name('get_by_menu');
Route::get('/{slug}/{cat}.html', 'IndexController@getByCat')->name('get_by_cat');
Route::get('/{slug}/{cat}/{post}.html', 'IndexController@getDetail')->name('get_detail');
Route::get('/payment/paypal/order/success', 'PaymentController@paypalSuccess')->name('payment.paypal.order.success');
Route::get('/payment/paypal/order/cancel', 'PaymentController@paypalCancel')->name('payment.paypal.order.cancel');
Route::get('/payment/paypal/credit_card/success', 'PaymentController@paypalCreditSuccess')->name('payment.paypal.credit_card.success');
Route::get('/payment/paypal/credit_card/cancel', 'PaymentController@paypalCreditCancel')->name('payment.paypal.credit_card.cancel');
Route::post('/service_home/request', 'HomeController@sendMailServiceHome')->name('service_home.request');
Route::get('/payment/flywire/order/success', 'PaymentController@flywirePaymentSuccess')->name('payment.flywire.order.success');
//
//Route::get('test',function(){
//    echo 'a';
//    return view('fontend.page.payment_success');
////    Mail::to('tungp788@gmail.com')->send(new \App\Mail\AppliMail());
//});
