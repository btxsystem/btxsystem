<?php
// Route::group(['prefix' => 'asep'], function () {
//     Route::group(['namespace' => 'Ebook\Api', 'prefix' => 'api/ebook'], function() {
//       Route::get('/ebooks', 'EbookController@all')->name('api.ebook.ebooks');
//     });

//     Route::get('/home', 'Ebook\HomeController@index');

//     // Route::get('/', 'MemberV2\ExploreController@home')->name('member.home');
//     Route::get('explore/{type}/{username}', 'MemberV2\ExploreController@detail')->name('member.ebook.referral');
//     Route::get('explore/{type}', 'MemberV2\ExploreController@detail')->name('member.ebook.detail');
//     Route::get('explores', 'MemberV2\ExploreController@index')->name('member.explore');
//     // Route::get('/member/{username}', 'MemberV2\ExploreController@subscription')->name('member.subscription.referral');
//     Route::get('/ebook', 'MemberV2\ExploreController@subscription')->name('member.home');
//     // Route::get('chapters/{slug}', 'MemberV2\ExploreController@chapters')->name('chapter.list')->middleware('ebook.access');
//     Route::get('book/{slug}', 'MemberV2\ExploreController@bookDetail')->name('book.detail')->middleware('ebook.access');
//     // Route::get('chapter/{id}', 'MemberV2\ExploreController@chapter')->name('chapter.detail')->middleware('ebook.access');

//     Route::post('register', 'MemberV2\RegisterController@register')->name('member.register');

//     Route::post('/v2/register', 'MemberV2\RegisterController@registerV2')->name('member.register-v2');

//     Route::post('/v3/register', 'MemberV2\RegisterController@registerV3')->name('member.register-v3');

//     Route::get('/v2/login', 'Auth\NonMemberController@getLogin')->middleware('guest')->name('member.login');
//     Route::post('/v2/login', 'Auth\NonMemberController@postLogin')->name('member.login.post');
//     Route::get('/v2/logout', 'Auth\NonMemberController@logout')->name('member.logout');

//     Route::get('checkReferral', 'MemberV2\ExploreController@checkReferral')->name('member.check-referral');
//     Route::get('checkUsername', 'MemberV2\ExploreController@checkUsername')->name('member.check-username');

//     Route::get('solvedLesson', 'MemberV2\ExploreController@solvedLesson')->name('member.solved-lesson');

//     Route::get('testMail', 'MemberV2\ExploreController@testMail');

//     Route::post('renewalEbook', 'MemberV2\RegisterController@renewalEbook')->name('member.ebook-renewal');

//     Route::get('/{username}', 'MemberV2\ExploreController@subscription')->name('member.subscription.referral');
// });

Route::domain('ebook.bitrexgo.id')->group(function () {
  Route::get('/home', 'Ebook\HomeController@index');

  // Route::get('/', 'MemberV2\ExploreController@home')->name('member.home');
  Route::get('explore/{type}/{username}', 'MemberV2\ExploreController@detail')->name('member.ebook.referral');
  Route::get('explore/{type}', 'MemberV2\ExploreController@detail')->name('member.ebook.detail');
  Route::get('explores', 'MemberV2\ExploreController@index')->name('member.explore');
  // Route::get('/member/{username}', 'MemberV2\ExploreController@subscription')->name('member.subscription.referral');
  Route::get('/ebook', 'MemberV2\ExploreController@subscription')->name('member.home');
  // Route::get('chapters/{slug}', 'MemberV2\ExploreController@chapters')->name('chapter.list')->middleware('ebook.access');
  Route::get('book/{slug}', 'MemberV2\ExploreController@bookDetail')->name('book.detail')->middleware('ebook.access');
  // Route::get('chapter/{id}', 'MemberV2\ExploreController@chapter')->name('chapter.detail')->middleware('ebook.access');

  Route::post('register', 'MemberV2\RegisterController@register')->name('member.register');

  Route::post('/v2/register', 'MemberV2\RegisterController@registerV2')->name('member.register-v2');

  Route::post('/v3/register', 'MemberV2\RegisterController@registerV3')->name('member.register-v3');

  Route::get('/v2/login', 'Auth\NonMemberController@getLogin')->middleware('guest')->name('member.login');
  Route::post('/v2/login', 'Auth\NonMemberController@postLogin')->name('member.login.post');
  Route::get('/v2/logout', 'Auth\NonMemberController@logout')->name('member.logout');

  Route::get('checkReferral', 'MemberV2\ExploreController@checkReferral')->name('member.check-referral');
  Route::get('checkUsername', 'MemberV2\ExploreController@checkUsername')->name('member.check-username');

  Route::get('solvedLesson', 'MemberV2\ExploreController@solvedLesson')->name('member.solved-lesson');

  Route::get('testMail', 'MemberV2\ExploreController@testMail');

  Route::post('renewalEbook', 'MemberV2\RegisterController@renewalEbook')->name('member.ebook-renewal');

  Route::get('/{username}', 'MemberV2\ExploreController@subscription')->name('member.subscription.referral');
});


Route::post('/rePayment', ['as' => 're.payment', 'uses' => 'Payment\V2\PaymentController@payment']);

Route::post('/payment', ['as' => 'payment', 'uses' => 'Payment\V2\PaymentController@payment']);
Route::post('/response-pay', ['as' => 'response.pay', 'uses' => 'Payment\V2\PaymentController@responsePayment']);
Route::post('/backend-response-pay', ['as' => 'backend.response.pay', 'uses' => 'Payment\V2\PaymentController@backendResponsePayment']);