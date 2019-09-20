<?php

Route::get('', ['as' => '', 'uses' => 'Admin\Auth\LoginController@getLogin']);
Route::post('login', ['as' => 'login', 'uses' => 'Admin\Auth\LoginController@postLogin']);
Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'Admin\HomeController@index']);

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
            Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'Admin\UsersController@edit']);
            Route::get('/{id}',['as' => 'delete', 'uses' => 'Admin\RolesController@destroy']);
        });

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
    Route::get('customer/data/{id}', 'Admin\CustomerController@delete');

    // Ebook
    Route::resource('ebook', 'Admin\EbookController');
    Route::get('ebook/{id}/create/book','Admin\BookController@create')->name('ebook.create.book');
    Route::get('ebook/{id}/create/video','Admin\VideoController@create')->name('ebook.create.video');

    Route::get('ebook/{id}/book-data','Admin\EbookController@bookData')->name('ebook.bookData');
    Route::get('ebook/{id}/video-data','Admin\EbookController@videoData')->name('ebook.videoData');

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
        Route::get('update-password', ['as' => 'update-password', 'uses' => 'Admin\MemberController@updatePassword']);
        Route::get('buy-product', ['as' => 'buy-product', 'uses' => 'Admin\MemberController@buyProduct']);

        // Transaction
        Route::get('/transaction', ['as' => 'transaction', 'uses' => 'Admin\TransactionController@index']);


        // Datatable for member
        Route::get('/{id}/point-history','Admin\MemberController@historyPointData')->name('points.history');
        Route::get('/{id}/cash-history','Admin\MemberController@historyCashData')->name('cash.history');
        Route::get('/{id}/pv-history','Admin\MemberController@historyPV')->name('pv.history');
        Route::get('/{id}/transaction','Admin\MemberController@transactionMember')->name('transaction.member');


        Route::group(['prefix'=>'active','as'=>'active.'], function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\MemberController@index']);
            Route::post('', ['as' => 'store', 'uses' => 'Admin\MemberController@store']);
            Route::get('/{id}/nonactive', ['as' => 'nonactive', 'uses' => 'Admin\MemberController@nonactive']);
        });

        Route::group(['prefix' => 'nonactive','as'=>'nonactive.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'Admin\MemberController@member_nonactive']);
            Route::get('/{id}/active', ['as' => 'active', 'uses' => 'Admin\MemberController@active']);
        });
    });



    Route::group(['prefix'=>'new.tree','as'=>'new.tree.'], function(){
            Route::get('index', ['as' => 'index', 'uses' => 'Admin\NewTreeController@tree']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\NewTreeController@create']);
            Route::get('select', ['as' => 'select', 'uses' => 'Admin\NewTreeController@getTree']);
    });

    Route::group(['prefix'=>'tree','as'=>'tree.'], function(){
            Route::get('index', ['as' => 'index', 'uses' => 'Admin\TreeController@tree']);
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
        Route::get('transaction-member', ['as' => 'transaction-member', 'uses' => 'Admin\ReportController@transactionMember']);
        Route::get('membership', ['as' => 'membership', 'uses' => 'Admin\ReportController@membership']);
    });

    Route::group(['prefix'=>'bonus','as'=>'bonus.'], function(){
        Route::get('sponsor', ['as' => 'sponsor', 'uses' => 'Admin\BonusController@bonusSponsor']);
        Route::get('pairing', ['as' => 'pairing', 'uses' => 'Admin\BonusController@bonusPairing']);
        Route::get('profit', ['as' => 'profit', 'uses' => 'Admin\BonusController@bonusProfit']);
        Route::get('reward', ['as' => 'reward', 'uses' => 'Admin\BonusController@bonusReward']);
        Route::get('general', ['as' => 'general', 'uses' => 'Admin\BonusController@general']);
    });

    Route::group(['prefix'=>'transfer-confirmation','as'=>'transfer-confirmation.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'Admin\TransferConfirmationController@index']);
        Route::get('/{id}/show', ['as' => 'edit', 'uses' => 'Admin\TransferConfirmationController@show']);
        Route::get('/approve/{invoice_number}', ['as' => 'approve', 'uses' => 'Admin\TransferConfirmationController@approve']);
    });

    Route::group(['prefix'=>'reward-claims','as'=>'reward-claims.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'Admin\RewardClaimController@index']);
        Route::get('/{id}/show', ['as' => 'edit', 'uses' => 'Admin\RewardClaimController@show']);
        Route::get('/approve/{id}', ['as' => 'approve', 'uses' => 'Admin\RewardClaimController@approve']);
    });

    Route::group(['prefix'=>'starterpack-shipping','as'=>'starterpack-shipping.'], function(){
        // Route::resource('testimonials', 'Admin\TestimonialController');
        Route::get('', ['as' => 'index', 'uses' => 'Admin\StarterpackShippingController@index']);
        Route::post('deliver', 'Admin\StarterpackShippingController@deliver')->name('deliver.starterpack');
        Route::get('import', ['as' => 'import', 'uses' => 'Admin\StarterpackShippingController@import']);
        // Route::post('update-testimony', 'Admin\TestimonialController@update')->name('update-testimony');
        // Route::get('testimonials/published/{id}', ['as' => 'published', 'uses' => 'Admin\TestimonialController@published']);
        // Route::get('testimonials/unpublished/{id}', ['as' => 'unpublished', 'uses' => 'Admin\TestimonialController@unpublished']);
    });



    Route::group(['prefix'=>'cms','as'=>'cms.'], function(){
        Route::resource('our-products', 'Admin\OurProductController');

        Route::resource('testimonials', 'Admin\TestimonialController');
        Route::post('update-testimony', 'Admin\TestimonialController@update')->name('update-testimony');
        Route::get('testimonials/published/{id}', ['as' => 'published', 'uses' => 'Admin\TestimonialController@published']);
        Route::get('testimonials/unpublished/{id}', ['as' => 'unpublished', 'uses' => 'Admin\TestimonialController@unpublished']);


        Route::resource('about-us', 'Admin\AboutUsController');
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
    });*/
    Route::get('generate-mail', ['as' => 'generate-mail', 'uses' => 'Member\SendEmailOldMember@sendMail']);
});
