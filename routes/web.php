<?php
\Cache::flush();

/*Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'select', 'as'=> 'select.'], function () {
    Route::get('sponsor', ['as' => 'sponsor', 'uses' => 'MembershipController@select']);
    Route::get('permissions', ['as' => 'permissions', 'uses' => 'Admin\RolesController@select']);
    Route::get('username', ['as' => 'username', 'uses' => 'Admin\MemberController@select']);
    Route::get('/{id}/upline', ['as' => 'upline', 'uses' => 'MembershipController@select_upline']);
});

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
    Route::get('roles', ['as' => 'roles', 'uses' => 'Admin\RolesController@index']);
    Route::get('membership', ['as' => 'membership', 'uses' => 'MembershipController@index']);
    Route::get('tree', 'MembershipController@tree');

    Route::group(['prefix'=>'admin-management','as'=>'admin-management.'], function(){
        Route::get('permissions', ['as' => 'permissions', 'uses' => 'Admin\PermissionsController@index']);

        Route::group(['prefix'=>'users','as'=>'users.'],function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\UsersController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\UsersController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'Admin\UsersController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'Admin\UsersController@edit']);
            Route::put('{id}', ['as' => 'update', 'uses' => 'Admin\UsersController@update']);
            Route::delete('{id}', ['as' => 'delete', 'uses' => 'Admin\UsersController@destroy']);
        });

        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'Admin\RolesController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\RolesController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'Admin\RolesController@store']);
            Route::get('/{id}',['as' => 'delete', 'uses' => 'Admin\RolesController@destroy']);
        });

    });

    Route::resource('customer', 'Admin\CustomerController');
    Route::get('customer/data/{id}', 'Admin\CustomerController@delete');

    Route::group(['prefix'=>'trainings','as'=>'trainings.'],function(){
        Route::get('', ['as' => 'index', 'uses' => 'Admin\TrainingController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'Admin\TrainingController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'Admin\TrainingController@store']);
        Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'Admin\TrainingController@edit']);
        Route::put('{id}', ['as' => 'update', 'uses' => 'Admin\TrainingController@update']);
        Route::delete('{id}', ['as' => 'delete', 'uses' => 'Admin\TrainingController@destroy']);
    });

    Route::group(['prefix'=>'members','as'=>'members.'], function(){
        Route::group(['prefix'=>'active','as'=>'active.'], function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\MemberController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\MemberController@create']);
            Route::get('/{id}/nonactive', ['as' => 'nonactive', 'uses' => 'Admin\MemberController@nonactive']);
        });

        Route::group(['prefix' => 'nonactive','as'=>'nonactive.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'Admin\MemberController@member_nonactive']);
            Route::get('/{id}/active', ['as' => 'active', 'uses' => 'Admin\MemberController@active']);
        });
    });

    Route::group(['prefix'=>'bitrex-money','as'=>'bitrex-money.'], function(){
        Route::get('points', ['as' => 'points', 'uses' => 'Admin\BitrexPointController@index']);
        Route::get('topup', ['as' => 'topup', 'uses' => 'Admin\BitrexPointController@topup']);

        Route::get('cash', ['as' => 'cash', 'uses' => 'Admin\BitrexCashController@index']);
        Route::get('/{id}/cash/detail', ['as' => 'detail', 'uses' => 'Admin\BitrexCashController@detail']);

        Route::get('/{id}/detail', ['as' => 'detail', 'uses' => 'Admin\BitrexPointController@detail']);
        Route::get('/{id}/detail/username', ['as' => 'username', 'uses' => 'Admin\BitrexPointController@getUsername']);
    });

});

Route::group(['prefix'=>'member','as'=>'member.'], function(){
    Route::get('/login', 'AuthEmployeer\LoginController@showLoginAdmin')->name('login');
    Route::post('/login/cek', 'AuthEmployeer\LoginController@login')->name('login.cek');
    Route::get('/dashboard', 'Member\DashboardController@index')->name('dashboard');
    Route::group(['prefix'=>'profile','as'=>'profile.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'Member\ProfileMemberController@index']);
    });
});
*/
Route::redirect('/', '/login');
Route::get('/login', 'Auth\LoginController@getLogin')->middleware('guest')->name('guest.login');
Route::get('/event', 'Member\EventController@index');

Route::post('/contact-us/send', 'Webstore\ContactUsController@sendMessage')->name('contact.send');
Route::get('/announcment',  'Webstore\AnnouncmentController@index');
Route::get('/video/{file}', 'FileController@serveVideo')->name('serve.video');
Route::group(['prefix' => 'hall-of-fame', 'as'=> 'hall-of-fame.'], function () {
    Route::get('', ['as' => 'index', 'uses' => 'Member\HallOfFameController@index']);
});
Route::post('/login', 'Auth\LoginController@postLogin');
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/finish', 'Member\BitrexPointController@index');
Route::get('/validate-unique-user', 'ValidationDataController@validateUniqueMemberUsername');
Route::get('/validate-exist-user', 'ValidationDataController@validateExistMember');
Route::get('/validate-exist-identity', 'ValidationDataController@validateExistIdentity');
Route::get('/validate-unique-email', 'ValidationDataController@validateUniqueMemberEmail');
Route::get('user/{user}', ['as' => 'user', 'uses' => 'Member\PvController@issetUser']);
Route::post('register-auto', ['as' => 'register-auto', 'uses' => 'Member\ProfileMemberController@registerAuto']);
Route::post('register-auto-webstore', ['as' => 'register-auto-webstore', 'uses' => 'Webstore\MemberController@register']);
Route::get('email/{user}', ['as' => 'email', 'uses' => 'Member\ProfileMemberController@isSameEmail']);

Route::post('register-autoplacement', ['as' => 'register-autoplacement', 'uses' => 'Member\ProfileMemberController@registerAutoPlacement']);

Route::post('register-member', ['as' => 'register-member', 'uses' => 'Member\RegisterController@registerMember']);

Route::get('/payment-confirm', ['as' => 'payment.confirm', 'uses' => 'Payment\V2\PaymentController@confirm']);

Route::post('/notification/handler', ['as' => 'notification.handler', 'uses' => 'Payment\Midtrans\PaymentMindtransController@notificationHandler']);

Route::post('/payment-confirmation', ['as' => 'payment.confirmation', 'uses' => 'Member\TransactionController@paymentConfirmation']);

Route::post('/response-pay-topup', ['as' => 'response.pay.topup', 'uses' => 'Member\TransactionController@responsePayment']);

Route::group(['namespace' => 'Ebook\Api', 'prefix' => 'api/ebook'], function() {
  Route::get('/ebooks', 'EbookController@all')->name('api.ebook.ebooks');
});

Route::post('/xendit-payment', ['as' => 'xendit-payment', 'uses' => 'Member\XenditController@store']);

Route::post('forgot-password', ['as' => 'forgot-password', 'uses' => 'Member\ForgotPasswordController@sendEmail']);

Route::group(['middleware' => 'web', 'prefix' => 'member', 'as'=> 'member.'], function () {

    Route::group(['prefix' => 'testimonial', 'as'=> 'testimonial.'], function() {
        Route::post('store', ['as' => 'store', 'uses' => 'Member\TestimonialController@store']);
    });

    Route::group(['prefix' => 'sendBp', 'as'=> 'sendBp.'], function() {
        Route::post('store', ['as' => 'store', 'uses' => 'Member\BitrexPointController@sendBP']);
    });

    Route::group(['prefix' => 'bp', 'as'=> 'bp.'], function () {
        Route::post('store', ['as' => 'store', 'uses' => 'Member\BitrexPointController@store']);
    });

    Route::post('change-photo', ['as' => 'change-photo', 'uses' => 'Member\ProfileMemberController@changePhoto'] );

    Route::group(['prefix' => 'shipping', 'as'=> 'shipping.'], function () {
        Route::get('province', ['as' => 'province', 'uses' => 'ShippingController@getProvince']);
        Route::get('city/{id}', ['as' => 'city', 'uses' => 'ShippingController@getCity']);
        Route::get('subdistrict/{id}', ['as' => 'subdistrict', 'uses' => 'ShippingController@getSubDistrict']);
        Route::get('kurir', ['as' => 'kurir', 'uses' => 'ShippingController@getKurir']);
        Route::get('cost/{id}', ['as' => 'cost', 'uses' => 'ShippingController@getCost']);
    });

    Route::group(['prefix' => 'bonus', 'as'=> 'bonus.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'Member\MyBonusController@index']);
    });

    Route::group(['prefix' => 'payment', 'as'=> 'payment.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'Member\MyBonusController@index']);
        Route::post('midtrans', ['as' => 'midtrans', 'uses' => 'Payment\Midtrans\PaymentMindtransController@submitDonation']);
    });

    Route::group(['prefix' => 'history-bonus', 'as'=> 'history-bonus.'], function () {
        Route::get('sponsor', ['as' => 'sponsor', 'uses' => 'Member\MyBonusController@sponsor']);
        Route::get('sales-profit', ['as' => 'sales-profit', 'uses' => 'Member\MyBonusController@profit']);
        Route::get('pairing', ['as' => 'pairing', 'uses' => 'Member\MyBonusController@pairing']);
        Route::get('rewards', ['as' => 'rewards', 'uses' => 'Member\MyBonusController@rewards']);
        Route::get('event', ['as' => 'event', 'uses' => 'Member\MyBonusController@event']);
    });

    Route::post('convert-bitrex-points', ['as' => 'convert-bitrex-points', 'uses' => 'Member\BitrexPointController@convertBitrexPoints']);

    Route::get('', ['as' => 'dashboard', 'uses' => 'Member\DashboardController@index']);
    Route::get('tree', ['as' => 'tree', 'uses' => 'Member\DashboardController@tree']);
    Route::get('hall-of-fame', ['as' => 'hall-of-fame', 'uses' => 'Member\HallOfFameController@index2']);
    Route::post('direct-tree', ['as' => 'direct-tree', 'uses' => 'Member\DashboardController@directTree']);
    Route::get('prospected-member', ['as' => 'prospected-member', 'uses' => 'Member\ProspectedMemberController@index']);
    Route::post('register-downline', ['as' => 'register-downline', 'uses' => 'Member\ProfileMemberController@register']);
    Route::get('reward', ['as' => 'reward', 'uses' => 'Member\ProfileMemberController@rewards']);
    Route::get('reward/{id}/update', 'Member\ProfileMemberController@getMyRewards');

    Route::group(['prefix' => 'ebook', 'as'=> 'ebook.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'Member\EbookController@index']);
        Route::post('', ['as' => 'store', 'uses' => 'Member\EbookController@store'] );
    });


    Route::post('register-auto', ['as' => 'register-auto', 'uses' => 'Member\ProfileMemberController@registerAuto']);

    Route::group(['prefix' => 'select', 'as'=> 'select.'], function () {
        Route::get('daily-retail', ['as' => 'daily-retail', 'uses' => 'Member\DashboardController@getAutoRetailDaily']);
        Route::get('training', ['as' => 'training', 'uses' => 'Member\DashboardController@getTraining']);
        Route::get('tree', ['as' => 'tree', 'uses' => 'Member\DashboardController@getTree']);
        Route::post('tree-analyzer', ['as' => 'tree-analyzer', 'uses' => 'Member\DashboardController@getTree']);
        Route::get('ebook', ['as' => 'ebook', 'uses' => 'Member\EbookController@getEbook']);
        Route::get('child-tree/{user}', ['as' => 'child-tree', 'uses' => 'Member\DashboardController@getChildTree']);
        Route::get('tree-upline/{user}', ['as' => 'tree-upline', 'uses' => 'Member\DashboardController@getParentTree']);
        Route::get('username/{user}', ['as' => 'username', 'uses' => 'Member\ProfileMemberController@isSameUsername']);
        Route::get('user/{user}', ['as' => 'user', 'uses' => 'Member\ProfileMemberController@getUser']);
        Route::get('email/{user}', ['as' => 'email', 'uses' => 'Member\ProfileMemberController@isSameEmail']);
        Route::get('nik/{user}', ['as' => 'nik', 'uses' => 'Member\ProfileMemberController@isSameNik']);
        Route::get('history-points', ['as' => 'history-points', 'uses' => 'Member\BitrexPointController@getHistoryPoints']);
        Route::get('history-value', ['as' => 'history-cash', 'uses' => 'Member\BitrexCashController@getHistoryCash']);
        Route::get('history-pv', ['as' => 'history-pv', 'uses' => 'Member\PvController@getHistoryPv']);
        Route::get('daily-bonus-sponsor', ['as' => 'daily-bonus-sponsor', 'uses' => 'Member\DashboardController@getBonusSponsorDaily']);
        Route::get('daily-pairing', ['as' => 'daily-pairing', 'uses' => 'Member\DashboardController@getBonusPairing']);
        //Route::get('generate', ['as' => 'generate', 'uses' => 'Member\PvController@generate']);
        Route::get('my-transaction', ['as' => 'my-transaction', 'uses' => 'Member\TransactionController@myTransaction']);
        Route::get('prospected-member-transaction', ['as' => 'prospected-member-transaction', 'uses' => 'Member\TransactionController@prospectedMemberHistory']);
        Route::get('reward', ['as' => 'reward', 'uses' => 'Member\ProfileMemberController@getRewards']);
        Route::get('reward-claim', ['as' => 'reward-claim', 'uses' => 'Member\ProfileMemberController@rewardClaim']);
        Route::get('bitrex-points', ['as' => 'bitrex-points', 'uses' => 'Member\BitrexPointController@getBitrexPoints']);
        Route::get('history-topup', ['as' => 'history-topup', 'uses' => 'Member\BitrexPointController@getHistoryTransaction']);
        Route::get('history-pv-pairing', ['as' => 'history-pv-pairing', 'uses' => 'Member\PvController@historyPvPairing']);
        Route::get('bonus', ['as' => 'bonus', 'uses' => 'Member\MyBonusController@bonus']);
        Route::get('bonus-sponsor', ['as' => 'bonus-sponsor', 'uses' => 'Member\MyBonusController@bonusSponsor']);
        Route::get('bonus-profit', ['as' => 'bonus-profit', 'uses' => 'Member\MyBonusController@bonusProfit']);
        Route::get('bonus-pairing', ['as' => 'bonus-pairing', 'uses' => 'Member\MyBonusController@bonusPairing']);
        Route::get('bonus-event', ['as' => 'bonus-event', 'uses' => 'Member\MyBonusController@bonusEvent']);
        Route::get('bonus-rewards', ['as' => 'bonus-rewards', 'uses' => 'Member\MyBonusController@bonusRewards']);
        Route::get('expired-member', ['as' => 'expired-member', 'uses' => 'Member\ProfileMemberController@getExpiredMember']);
        Route::get('expired-ebook', ['as' => 'expired-ebook', 'uses' => 'Member\EbookController@getExpiredEbook']);
        Route::get('exp-three-month', ['as' => 'exp-three-month', 'uses' => 'Member\ProfileMemberController@expNotif']);
        Route::get('summary/{id}', ['as' => 'summary', 'uses' => 'Member\PvController@getSummary']);
        Route::get('search-downline/{id}', ['as' => 'search-downline', 'uses' => 'Member\PvController@searchDownline']);
        Route::get('is-have-change-profile', ['as' => 'is-have-change-profile', 'uses' => 'Member\ProfileMemberController@isHaveChange']);
    });

    Route::get('claim-reward', ['as' => 'claim-reward', 'uses' => 'Member\ProfileMemberController@claimReward']);

    Route::group(['prefix' => 'transaction', 'as'=> 'transaction.'], function () {
        Route::get('my-transaction', ['as' => 'my-transaction', 'uses' => 'Member\TransactionController@index']);
        Route::get('prospected-member-transaction', ['as' => 'prospected-member-transaction', 'uses' => 'Member\TransactionController@transactionNonMember']);
        Route::post('topup', ['as' => 'topup', 'uses' => 'Member\TransactionController@topup']);
    });

    Route::group(['prefix' => 'profile', 'as'=> 'profile.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'Member\ProfileMemberController@index']);
        Route::post('reset-password', ['as' => 'reset-password', 'uses' => 'Member\ProfileMemberController@resetPassword']);
        Route::get('update',['as' => 'update', 'uses' => 'Member\ProfileMemberController@updateProfile']);
        Route::get('data',['as' => 'data', 'uses' => 'Member\ProfileMemberController@data']);
        Route::get('update-profile',['as' => 'update-profile', 'uses' => 'Member\ProfileMemberController@update_profile']);
    });

    Route::group(['prefix' => 'add-member', 'as'=> 'add-member.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'Member\AddNewMemberController@index']);
        Route::post('reset-password', ['as' => 'reset-password', 'uses' => 'Member\ProfileMemberController@resetPassword']);
    });

    Route::post('withrawal', ['as' => 'withdrawal', 'uses' => 'Member\BitrexCashController@withdrawal']);
    Route::post('resend-otp', ['as' => 'resend-otp', 'uses' => 'Member\BitrexCashController@resendOTP']);
    Route::post('send-otp', ['as' => 'send-otp', 'uses' => 'Member\BitrexCashController@sendOTP']);

    Route::group(['prefix' => 'income-and-expenses', 'as'=> 'bitrex-money.'], function () {
        Route::get('bitrex-points', ['as' => 'bitrex-points', 'uses' => 'Member\BitrexPointController@index']);
        Route::get('bitrex-value', ['as' => 'bitrex-cash', 'uses' => 'Member\BitrexCashController@index']);
        Route::get('pv', ['as' => 'pv', 'uses' => 'Member\PvController@index']);
        Route::get('pv-pairing', ['as' => 'pv-pairing', 'uses' => 'Member\PvController@pvHistory']);
    });

    Route::group(['prefix' => 'team-report', 'as'=> 'team-report.'], function () {
        Route::get('my-sponsor', ['as' => 'my-sponsor', 'uses' => 'Member\TeamReportController@mySponsor']);
        Route::get('my-analizer', ['as' => 'my-analizer', 'uses' => 'Member\TeamReportController@myAnalizer']);
        Route::get('team-analizer', ['as' => 'team-analizer', 'uses' => 'Member\TeamReportController@teamAnalizer']);
        Route::get('generate-analizer', ['as' => 'team-analizer', 'uses' => 'Member\TeamReportController@generateAnalyzer']);
    });

});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::domain(env('EBOOK_URL'))->group(function () {
    // Route::group(['prefix' => 'v2'], function() {
    //   Route::get('/ebook', 'EbookV2\EbookController@index');
    //   Route::get('/ebook/{type}/{username}', 'EbookV2\EbookController@detail')->name('member.ebookv2.referral');
    //   Route::get('/ebook/{type}', 'EbookV2\EbookController@detail')->name('member.ebookv2.detail');
    // });

    Route::get('/videoEbook', 'MemberV2\ExploreController@videoBasic')->name('member.video.ebook');
    Route::get('/videoAdvanced', 'MemberV2\ExploreController@videoAdvanced')->name('member.video.ebook.advanced');

    // Route::get('/ebook', 'MemberV2\ExploreController@subscription')->name('member.home');
    // Route::get('explore/{type}/{username}', 'MemberV2\ExploreController@detail')->name('member.ebook.referral');
    // Route::get('explore/{type}', 'MemberV2\ExploreController@detail')->name('member.ebook.detail');
    // Route::get('/', 'MemberV2\ExploreController@home')->name('member.home');
    Route::get('/ebook', 'EbookV2\EbookController@index')->name('member.home');
    Route::get('/ebook/{type}/{username}', 'EbookV2\EbookController@detail')->name('member.ebook.referral');
    Route::get('/ebook/{type}', 'EbookV2\EbookController@detail')->name('member.ebook.detail');

    // Route::get('explores', 'MemberV2\ExploreController@index')->name('member.explore');
    // Route::get('/member/{username}', 'MemberV2\ExploreController@subscription')->name('member.subscription.referral');

    // Route::get('chapters/{slug}', 'MemberV2\ExploreController@chapters')->name('chapter.list')->middleware('ebook.access');
    Route::get('book/{slug}', 'MemberV2\ExploreController@bookDetail')->name('book.detail')->middleware('ebook.access');
    // Route::get('chapter/{id}', 'MemberV2\ExploreController@chapter')->name('chapter.detail')->middleware('ebook.access');

    Route::post('register', 'MemberV2\RegisterController@register')->name('member.register');

    Route::post('buy-ebook', 'MemberV2\EbookController@store')->name('member.buy-ebook');

    Route::post('/v2/register', 'MemberV2\RegisterController@registerV2')->name('member.register-v2');

    Route::post('/v3/register', 'MemberV2\RegisterController@registerV3')->name('member.register-v3');
    Route::post('/v3/register/new', 'MemberV2\RegisterController@registerNonMember')->name('member.register-new');

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
  Route::post('/response-pay-member', ['as' => 'response.pay.member', 'uses' => 'Member\RegisterController@responsePayment']);
  Route::post('/backend-response-pay', ['as' => 'backend.response.pay', 'uses' => 'Payment\V2\PaymentController@backendResponsePayment']);
