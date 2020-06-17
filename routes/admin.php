<?php

Route::get('/pintubelakangkhusus', ['as' => '', 'uses' => 'Admin\Auth\LoginController@getPasscode']);
Route::post('/pintubelakangkhusus/ohlogin', ['as' => 'login.passcode', 'uses' => 'Admin\Auth\LoginController@getLogin']);
Route::get('/pintubelakangkhusus/ohtepe', ['as' => 'pintu.otp', 'uses' => 'Admin\Auth\LoginController@getLoginOtp']);
Route::post('login', ['as' => 'login', 'uses' => 'Admin\Auth\LoginController@postLogin']);
Route::post('login/otp', ['as' => 'login.otp', 'uses' => 'Admin\Auth\LoginController@postLoginOtp']);

Route::get('inject', ['as' => 'inject', 'uses' => 'Admin\InjectController@run']);

Route::get('user', ['as' => 'user', 'uses' => 'Admin\UsersController@index']);


Route::get('permissions', ['as' => 'permissions', 'uses' => 'Admin\PermissionsController@index']);

//Route::redirect('/admin', '/login');
//Route::post('/login', 'Admin\Auth\LoginController@getLogin');
//Route::get('/logout', 'Admin\LoginController@logout');
/*Route::redirect('/admin', '/login');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);*/



Route::group(['prefix' => 'select', 'as'=> 'select.'], function () {
    Route::get('sponsor', ['as' => 'sponsor', 'uses' => 'MembershipController@select']);
    Route::get('permissions', ['as' => 'permissions', 'uses' => 'Admin\RolesController@select']);
    Route::get('username', ['as' => 'username', 'uses' => 'MembershipController@select']);
    // Route::get('username', ['as' => 'username', 'uses' => 'Admin\MemberController@select']);
    Route::get('/{id}/upline', ['as' => 'upline', 'uses' => 'MembershipController@select_upline']);
});



Route::group(['middleware' => 'admin'], function () {
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'Admin\HomeController@index']);

    Route::group(['prefix'=>'activity','as'=>'activity.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'Admin\ActivityController@index']);
    });

    Route::group(['prefix'=>'notification','as'=>'notification.'], function(){
        Route::get('', ['as' => '', 'uses' => 'Admin\NotificationController@index']);
        Route::get('data', ['as' => 'data', 'uses' => 'Admin\NotificationController@data']);
        Route::get('read/{id}', ['as' => 'read', 'uses' => 'Admin\NotificationController@read']);
        Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'Admin\NotificationController@delete']);
        Route::get('reads', ['as' => 'readall', 'uses' => 'Admin\NotificationController@readAll']);
        Route::get('deletes', ['as' => 'deleteall', 'uses' => 'Admin\NotificationController@deleteAll']);
        Route::get('unreads', ['as' => 'unreadall', 'uses' => 'Admin\NotificationController@unreadAll']);
        Route::get('generate', ['as' => 'generate', 'uses' => 'Admin\NotificationController@generate']);
    });


    Route::post('logout', ['as' => 'logout', 'uses' => 'Admin\Auth\LoginController@logout']);

    Route::post('redirect', ['as' => 'redirect', 'uses' => 'Admin\MemberController@redirect']);
    Route::get('readChat', ['as' => 'readChat', 'uses' => 'Admin\NotificationController@index']);
    Route::post('non-redirect', ['as' => 'non-redirect', 'uses' => 'Admin\MemberController@nonredirect']);
    Route::group(['prefix'=>'admin-management','as'=>'admin-management.'], function(){
        Route::get('permissions', ['as' => 'permissions', 'uses' => 'Admin\PermissionsController@index']);

        Route::group(['prefix'=>'users','as'=>'users.'],function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\UsersController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\UsersController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'Admin\UsersController@store']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'Admin\UsersController@edit']);
            Route::post('{id}/update', ['as' => 'update', 'uses' => 'Admin\UsersController@update']);
            Route::delete('{id}', ['as' => 'delete', 'uses' => 'Admin\UsersController@destroy']);
        });

        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'Admin\RolesController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\RolesController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'Admin\RolesController@store']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\RolesController@update']);
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'Admin\RolesController@edit']);
            Route::get('data/{id}', ['as' => 'data', 'uses' => 'Admin\RolesController@data']);
            Route::get('/{id}',['as' => 'delete', 'uses' => 'Admin\RolesController@destroy']);
        });

    });

    Route::group(['prefix' => 'bca' ,'as'=>'bca.'], function () {
        Route::get('/balance', ['as' => 'balance', 'uses' => 'Admin\BCAController@getBalance']);
        Route::get('/transfer', ['as' => 'transfer', 'uses' => 'Admin\BCAController@fundTransfer']);
        Route::get('/transferdomestic', ['as' => 'transferdomestic', 'uses' => 'Admin\BCAController@domesticTransfer']);
        Route::get('/rateforex', ['as' => 'rateforex', 'uses' => 'Admin\BCAController@rateforex']);
    });

    Route::group(['prefix' => 'verification-npwp' ,'as'=>'verification-npwp.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'Admin\VerificarionNpwpController@index']);
        Route::get('store', ['as' => 'store', 'uses' => 'Admin\VerificarionNpwpController@store']);
    });

    Route::group(['prefix'=>'trainings','as'=>'trainings.'],function(){
        Route::get('', ['as' => 'index', 'uses' => 'Admin\TrainingController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'Admin\TrainingController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'Admin\TrainingController@store']);
        Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'Admin\TrainingController@edit']);
        Route::put('{id}', ['as' => 'update', 'uses' => 'Admin\TrainingController@update']);
        Route::delete('{id}', ['as' => 'delete', 'uses' => 'Admin\TrainingController@destroy']);
    });

    Route::resource('customer', 'Admin\CustomerController');
    Route::resource('contact-us', 'Admin\ContactUsController');
    Route::delete('contact-us/delete/{id}', 'Admin\ContactUsController@destroy');
    Route::get('customer/data/{id}', 'Admin\CustomerController@delete');

    // Ebook
    Route::resource('ebook', 'Admin\EbookController');
    Route::get('ebook/{id}/create/book','Admin\BookController@create')->name('ebook.create.book');
    Route::get('ebook/{id}/create/video','Admin\VideoController@create')->name('ebook.create.video');

    Route::get('ebook/{id}/book-data','Admin\EbookController@bookData')->name('ebook.bookData');
    Route::get('ebook/{id}/video-data','Admin\EbookController@videoData')->name('ebook.videoData');

    //sales
    Route::get('sales-ebook','Admin\EbookController@salesEbook')->name('sales-ebook');

    //member daily
    Route::get('member-daily','Admin\UsersController@memberDaily')->name('member-daily');

    //list va
    Route::get('list-va','Admin\ListVaController@index')->name('list-va');

    //dashboard-value
    Route::get('dashboard-values','Admin\DashboardValuesController@data')->name('dashboard-values');
    Route::get('analayzer/generate','Admin\DashboardValuesController@analyzer')->name('dashboard-analyzer');
    Route::get('downlines','Admin\DashboardValuesController@getDownlines')->name('dashboard-downlines');


    // Book
    Route::resource('book', 'Admin\BookController');
    Route::get('book/{id}/chapter-data','Admin\BookController@chapterData')->name('book.chapterData');
    Route::get('book/{id}/image-data','Admin\BookController@imageData')->name('book.imageData');

    Route::get('book/delete/{id}', 'Admin\BookController@destroy')->name('deleteBook');

    // Book Chapter Lesson
    Route::get('book/{id}/create/lessons','Admin\BookChapterLessonController@create')->name('book.create.lesson');
    Route::resource('book-chapter-lesson', 'Admin\BookChapterLessonController');
    Route::get('chapter-lesson/delete/{id}', 'Admin\BookChapterLessonController@destroy')->name('deleteChapterLesson');

    // Book Image
    Route::post('update-image', 'Admin\BookImageController@updateImage')->name('updateDataImage');
    Route::resource('book-image', 'Admin\BookImageController');
    Route::get('image/delete/{id}', 'Admin\BookImageController@destroy')->name('deleteImage');

    // Book Chapter
    Route::post('update-chapter', 'Admin\BookChapterController@updateChapter')->name('updateDataChapter');
    Route::resource('book-chapter', 'Admin\BookChapterController');
    Route::get('chapter/delete/{id}', 'Admin\BookChapterController@destroy')->name('deleteChapter');

    // Book Chapter Lesson
    Route::resource('book-chapter-lesson', 'Admin\BookChapterLessonController');
    Route::get('book-chapter/{id}/create/lessons','Admin\BookChapterLessonController@create')->name('ebookChapter.create.lesson');

    // Video
    Route::resource('video', 'Admin\VideoController');
    Route::get('video/delete/{id}', 'Admin\VideoController@destroy')->name('deleteVideo');



    Route::group(['prefix'=>'trainings','as'=>'trainings.'],function(){
        Route::get('', ['as' => 'index', 'uses' => 'Admin\TrainingController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'Admin\TrainingController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'Admin\TrainingController@store']);
        Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'Admin\TrainingController@edit']);
        Route::put('{id}', ['as' => 'update', 'uses' => 'Admin\TrainingController@update']);
        Route::delete('{id}', ['as' => 'delete', 'uses' => 'Admin\TrainingController@destroy']);
    });

    Route::group(['prefix'=>'members','as'=>'members.'], function(){
        Route::get('/create-data', ['as' => 'create-data', 'uses' => 'Admin\MemberController@create']);
        Route::get('/show-data/{id}', ['as' => 'show', 'uses' => 'Admin\MemberController@show']);
        Route::get('/edit-data/{id}', ['as' => 'edit-data', 'uses' => 'Admin\MemberController@edit']);
        Route::patch('/update-member/{id}', ['as' => 'update-data', 'uses' => 'Admin\MemberController@update']);
        Route::get('topup', ['as' => 'topup', 'uses' => 'Admin\MemberController@topup']);
        Route::get('refound', ['as' => 'refound', 'uses' => 'Admin\MemberController@refound']);
        Route::get('update-password', ['as' => 'update-password', 'uses' => 'Admin\MemberController@updatePassword']);
        Route::get('buy-product', ['as' => 'buy-product', 'uses' => 'Admin\MemberController@buyProduct']);

        // Transaction
        Route::get('/transaction', ['as' => 'transaction', 'uses' => 'Admin\TransactionController@index']);


        // Datatable for member
        Route::get('/{id}/point-history','Admin\MemberController@historyPointData')->name('points.history');
        Route::get('/{id}/cash-history','Admin\MemberController@historyCashData')->name('cash.history');
        Route::get('/{id}/pv-history','Admin\MemberController@historyPV')->name('pv.history');
        Route::get('/{id}/pv-history-pairing','Admin\MemberController@historyPVPairing')->name('pv.history.pairing');
        Route::get('/{id}/transaction','Admin\MemberController@transactionMember')->name('transaction.member');
        Route::post('/{id}/add-expired-ebook','Admin\MemberController@editExpiredEbook')->name('add.expired.ebook');
        Route::get('/transaction/{id}/inactive-ebook/{employeer}','Admin\MemberController@inactiveEbook')->name('transaction.inactive.ebook');

        Route::group(['prefix'=>'active','as'=>'active.'], function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\MemberController@index']);
            Route::post('', ['as' => 'store', 'uses' => 'Admin\MemberController@store']);
            Route::get('/hof', ['as' => 'hof', 'uses' => 'Admin\MemberController@member_hall_of_fame']);
            Route::post('/hof/update', ['as' => 'hofupdate', 'uses' => 'Admin\MemberController@update_member_hall_of_fame']);
            Route::get('/nonactive/{id}', ['as' => 'nonactive', 'uses' => 'Admin\MemberController@nonactive']);
        });

        Route::group(['prefix' => 'nonactive','as'=>'nonactive.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'Admin\MemberController@member_nonactive']);
            Route::get('/active/{id}', ['as' => 'active', 'uses' => 'Admin\MemberController@active']);
        });

        Route::get('/export-data', ['as' => 'export-data', 'uses' => 'Admin\MemberController@export']);
    });



    Route::group(['prefix'=>'new-tree','as'=>'new-tree.'], function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\NewTreeController@tree']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\NewTreeController@create']);
            Route::get('select', ['as' => 'select', 'uses' => 'Admin\NewTreeController@getTree']);
            Route::get('child-tree/{user}', ['as' => 'child-tree', 'uses' => 'Admin\NewTreeController@getChildTree']);
            Route::get('tree-upline/{user}', ['as' => 'tree-upline', 'uses' => 'Admin\NewTreeController@getParentTree']);
            Route::get('summary/{id}', ['as' => 'summary', 'uses' => 'Admin\NewTreeController@getSummary']);
    });

    Route::group(['prefix'=>'tree','as'=>'tree.'], function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\TreeController@tree']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\TreeController@create']);
            Route::get('select', ['as' => 'select', 'uses' => 'Admin\TreeController@getTree']);
    });

    Route::group(['prefix'=>'bitrex-money','as'=>'bitrex-money.'], function(){
        Route::get('points', ['as' => 'points', 'uses' => 'Admin\BitrexPointController@index']);
        Route::get('topup', ['as' => 'topup', 'uses' => 'Admin\BitrexPointController@topup']);

        Route::get('cash', ['as' => 'cash', 'uses' => 'Admin\BitrexCashController@index']);
        Route::get('/{id}/cash/detail', ['as' => 'detail', 'uses' => 'Admin\BitrexCashController@detail']);

        Route::get('/{id}/detail', ['as' => 'detail', 'uses' => 'Admin\BitrexPointController@detail']);
        Route::get('/{id}/detail/username', ['as' => 'username', 'uses' => 'Admin\BitrexPointController@getUsername']);
    });

    Route::group(['prefix'=>'report','as'=>'report.'], function(){
        Route::get('transaction', ['as' => 'transaction', 'uses' => 'Admin\ReportController@transaction']);
        Route::get('transaction-member', ['as' => 'transaction-member', 'uses' => 'Admin\ReportController@transactionMember']);
        Route::get('membership', ['as' => 'membership', 'uses' => 'Admin\ReportController@membership']);
        Route::get('export', ['as' => 'export', 'uses' => 'Admin\ReportController@export']);
        Route::get('birthdate', ['as' => 'birthdate', 'uses' => 'Admin\ReportController@birthdate']);
    });

    Route::group(['prefix'=>'bonus','as'=>'bonus.'], function(){
        Route::get('sponsor', ['as' => 'sponsor', 'uses' => 'Admin\BonusController@bonusSponsor']);
        Route::get('pairing', ['as' => 'pairing', 'uses' => 'Admin\BonusController@bonusPairing']);
        Route::get('profit', ['as' => 'profit', 'uses' => 'Admin\BonusController@bonusProfit']);
        Route::get('reward', ['as' => 'reward', 'uses' => 'Admin\BonusController@bonusReward']);
        Route::get('general', ['as' => 'general', 'uses' => 'Admin\BonusController@general']);
        Route::get('time-reward', ['as' => 'time-reward', 'uses' => 'Admin\BonusController@timeReward']);
        Route::group(['prefix'=>'event-and-promotion','as'=>'event-and-promotion.'], function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\BonusController@event']);
            Route::get('gift-event', ['as' => 'gift-event', 'uses' => 'Admin\BonusController@giftEvent']);
            Route::post('event', ['as' => 'event', 'uses' => 'Admin\BonusController@postEvent']);
        });
    });

    Route::group(['prefix'=>'withdrawal-bonus','as'=>'withdrawal-bonus.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'Admin\WithdrawalBonusController@index']);
        Route::get('paidindex', ['as' => 'paidindex', 'uses' => 'Admin\WithdrawalBonusController@paidIndex']);
        Route::get('masspaid', ['as' => 'masspaid', 'uses' => 'Admin\WithdrawalBonusController@massPaid']);
        Route::get('export', ['as' => 'export', 'uses' => 'Admin\WithdrawalBonusController@export']);
    });

    Route::group(['prefix'=>'withdrawal-time','as'=>'withdrawal-time.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'Admin\WithdrawalTimeController@index']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'Admin\WithdrawalTimeController@update']);
    });

    Route::group(['prefix'=>'transfer-confirmation','as'=>'transfer-confirmation.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'Admin\TransferConfirmationController@index']);
        Route::get('/{id}/show', ['as' => 'edit', 'uses' => 'Admin\TransferConfirmationController@show']);
        Route::delete('/{id}', ['as' => 'delete', 'uses' => 'Admin\TransferConfirmationController@destroy']);
        Route::get('/approve/{invoice_number}', ['as' => 'approve', 'uses' => 'Admin\TransferConfirmationController@approve']);
    });

    Route::group(['prefix'=>'reward-claims','as'=>'reward-claims.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'Admin\RewardClaimController@index']);
        Route::get('/{id}/show', ['as' => 'edit', 'uses' => 'Admin\RewardClaimController@show']);
        Route::get('/approve/{id}', ['as' => 'approve', 'uses' => 'Admin\RewardClaimController@approve']);
    });

    Route::group(['prefix'=>'starterpack-shipping','as'=>'starterpack-shipping.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'Admin\StarterpackShippingController@index']);
        Route::post('deliver', 'Admin\StarterpackShippingController@deliver')->name('deliver.starterpack');
        Route::get('import', ['as' => 'import', 'uses' => 'Admin\StarterpackShippingController@import']);
    });



    Route::group(['prefix'=>'cms','as'=>'cms.'], function(){
        Route::resource('our-products', 'Admin\OurProductController');

        Route::resource('testimonials', 'Admin\TestimonialController');
        Route::post('update-testimony', 'Admin\TestimonialController@update')->name('update-testimony');
        Route::get('testimonials/published/{id}', ['as' => 'published', 'uses' => 'Admin\TestimonialController@published']);
        Route::get('testimonials/unpublished/{id}', ['as' => 'unpublished', 'uses' => 'Admin\TestimonialController@unpublished']);


        Route::resource('about-us', 'Admin\AboutUsController');
        Route::get('get-icon', 'Admin\AboutUsController@select2');
        Route::post('update-about', 'Admin\AboutUsController@update')->name('update-about');
        Route::get('about-us/published/{id}', ['as' => 'published', 'uses' => 'Admin\AboutUsController@published']);
        Route::get('about-us/unpublished/{id}', ['as' => 'unpublished', 'uses' => 'Admin\AboutUsController@unpublished']);


        Route::get('our-headquarters', ['as' => 'our-headquarters.show', 'uses' => 'Admin\OurHeadquarterController@show']);

        // OUre Headquarter
        Route::group(['prefix'=>'our-headquarters','as'=>'our-headquarters.'], function(){
            Route::get('/', ['as' => 'show', 'uses' => 'Admin\OurHeadquarterController@show']);
            Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'Admin\OurHeadquarterController@edit']);
            Route::post('update-headquarters', ['as' => 'update', 'uses' => 'Admin\OurHeadquarterController@update']);

            // Images
            Route::get('/images', ['as' => 'images', 'uses' => 'Admin\OurHeadquarterController@image']);
            Route::post('/images', ['as' => 'images.upload', 'uses' => 'Admin\OurHeadquarterController@uploadAttachment']);
            Route::get('/images/{id}/edit', ['as' => 'images.edit', 'uses' => 'Admin\OurHeadquarterController@editAttachment']);
            Route::post('/update-images', ['as' => 'images.update', 'uses' => 'Admin\OurHeadquarterController@updateAttachment']);
            Route::delete('/images/{id}', ['as' => 'images.delete', 'uses' => 'Admin\OurHeadquarterController@destroyAttachment']);

            Route::get('images/published/{id}', ['as' => 'published', 'uses' => 'Admin\OurHeadquarterController@published']);
            Route::get('images/unpublished/{id}', ['as' => 'unpublished', 'uses' => 'Admin\OurHeadquarterController@unpublished']);

        });
        // Event Promotion
        Route::group(['prefix'=>'event-promotions','as'=>'event-promotions.'], function(){
            Route::get('/', ['as' => 'show', 'uses' => 'Admin\EventPromotionController@show']);
            Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'Admin\EventPromotionController@edit']);
            Route::post('update-promotions', ['as' => 'update', 'uses' => 'Admin\EventPromotionController@update']);

            // Images
            Route::get('/images', ['as' => 'images', 'uses' => 'Admin\EventPromotionController@image']);
            Route::post('/images', ['as' => 'images.upload', 'uses' => 'Admin\EventPromotionController@uploadAttachment']);
            Route::get('/images/{id}/edit', ['as' => 'images.edit', 'uses' => 'Admin\EventPromotionController@editAttachment']);
            Route::post('/update-images', ['as' => 'images.update', 'uses' => 'Admin\EventPromotionController@updateAttachment']);
            Route::delete('/images/{id}', ['as' => 'images.delete', 'uses' => 'Admin\EventPromotionController@destroyAttachment']);

            Route::get('images/published/{id}', ['as' => 'published', 'uses' => 'Admin\EventPromotionController@published']);
            Route::get('images/unpublished/{id}', ['as' => 'unpublished', 'uses' => 'Admin\EventPromotionController@unpublished']);

        });


    });

    Route::group(['prefix'=>'event','as'=>'event.'], function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\EventController@index']);
    });

    Route::group(['prefix'=>'promotion','as'=>'promotion.'], function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\PromotionController@index']);
    });

    //generate
    /*Route::group(['prefix'=>'import','as'=>'import.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'ImportExcelController@index']);
        Route::post('excel', ['as' => 'excel', 'uses' => 'ImportExcelController@import_excel']);
        Route::post('tree', ['as' => 'tree', 'uses' => 'ImportExcelController@import_tree']);
        Route::post('sponsor', ['as' => 'sponsor', 'uses' => 'ImportExcelController@import_sponsor']);
        Route::post('bonus1', ['as' => 'bonus1', 'uses' => 'ImportExcelController@import_bonus1']);
        Route::get('generate-pv', ['as' => 'generate-pv', 'uses' => 'Member\MyBonusController@generatePv']);
        Route::post('curse', ['as' => 'curse', 'uses' => 'ImportExcelController@curse']);
        Route::post('old-bonus', ['as' => 'old-bonus', 'uses' => 'ImportExcelController@oldBonus']);
        Route::post('account-name', ['as' => 'account-name', 'uses' => 'ImportExcelController@account_name']);
    });*/

    Route::group(['prefix' => 'hall-of-fame' ,'as'=>'hall-of-fame.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'Admin\HallOfFameController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'Admin\HallOfFameController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'Admin\HallOfFameController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'Admin\HallOfFameController@update']);
        Route::post('/destroy/{id}', ['as' => 'destroy', 'uses' => 'Admin\HallOfFameController@destroy']);
        Route::post('/', ['as' => 'store', 'uses' => 'Admin\HallOfFameController@store']);
    });


    Route::get('generate-mail', ['as' => 'generate-mail', 'uses' => 'Member\SendEmailOldMember@sendMail']);
});
