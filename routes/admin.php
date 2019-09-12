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
        Route::get('buy-product', ['as' => 'buy-product', 'uses' => 'Admin\MemberController@buyProduct']);

        // Datatable for member
        Route::get('/{id}/point-history','Admin\MemberController@historyPointData')->name('points.history');
        Route::get('/{id}/cash-history','Admin\MemberController@historyCashData')->name('cash.history');
        Route::get('/{id}/my-pv','Admin\MemberController@historyMyPV')->name('my.pv');


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
    });

    Route::group(['prefix'=>'cms','as'=>'cms.'], function(){
        Route::resource('our-products', 'Admin\OurProductController');
        Route::resource('testimonials', 'Admin\TestimonialController');
        Route::post('update-testimony', 'Admin\TestimonialController@update')->name('update-testimony');
        Route::get('testimonials/published/{id}', ['as' => 'published', 'uses' => 'Admin\TestimonialController@published']);
        Route::get('testimonials/unpublished/{id}', ['as' => 'unpublished', 'uses' => 'Admin\TestimonialController@unpublished']);

    });

    Route::group(['prefix'=>'event','as'=>'event.'], function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\EventController@index']);
    });

    Route::group(['prefix'=>'promotion','as'=>'promotion.'], function(){
            Route::get('', ['as' => 'index', 'uses' => 'Admin\PromotionController@index']);
    });

    Route::group(['prefix'=>'import','as'=>'import.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'ImportExcelController@index']);
        Route::post('excel', ['as' => 'excel', 'uses' => 'ImportExcelController@import_excel']);
    });
/*Route::group(['prefix'=>'member','as'=>'member.'], function(){
    Route::get('/login', 'AuthEmployeer\LoginController@showLoginAdmin')->name('login');
    Route::post('/login/cek', 'AuthEmployeer\LoginController@login')->name('login.cek');
    Route::get('/dashboard', 'Member\DashboardController@index')->name('dashboard');
    Route::group(['prefix'=>'profile','as'=>'profile.'], function(){
        Route::get('', ['as' => 'index', 'uses' => 'Member\ProfileMemberController@index']);
    });
});*/