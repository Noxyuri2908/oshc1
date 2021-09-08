<?php
//START ADMIN ROUTE
Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login.get');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login.post');
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    //User
    Route::get('/profile', 'Admin\AdminController@getProfile')->name('profile.get');
    Route::post('/profile', 'Admin\AdminController@postProfile')->name('profile.post');
    Route::post('/mutile-update/staff', 'Admin\AdminController@mutileUpdate')
        ->name('mutileUpdate.staff');

    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('/add-new/comm/ajax', 'Admin\InfoController@addNewComm')->name('report.index');
    Route::get('/report', 'Admin\ReportController@index')->name('report.index');
    Route::get('/report/all/{month}', 'Admin\ReportController@reportAll')->name('report.all');
    Route::get('/report/{agent}/{month}', 'Admin\ReportController@reportByAgent')->name('report.agent');
    Route::get('/reload-data', 'Admin\HomeController@reloadData')
        ->name('reload-data');
    Route::resource('comment', 'Admin\CommentController');
    Route::post(
        '/mutile-update/comment',
        'Admin\CommentController@mutileUpdate'
    )
        ->name('mutileUpdate.comment');

    Route::get('/', 'Admin\HomeController@adminHome')->name('admin.home');
    Route::resource('question', 'Admin\QuestionController');
    Route::post(
        '/mutile-update/question',
        'Admin\QuestionController@mutileUpdate'
    )
        ->name('mutileUpdate.question');

    Route::resource('price', 'Admin\PriceController');
    Route::post('/mutile-update/price', 'Admin\PriceController@mutileUpdate')->name('mutileUpdate.price');
    Route::post('/import/price', 'Admin\PriceController@import')->name('import.price');
    Route::post('/import/price/import', 'Admin\PriceController@importExcel')->name('import.excel');


    Route::resource('apply', 'Admin\ApplyController');
    Route::post('action/status/apply/{id}', 'Admin\ApplyController@updateStatus')->name('apply.action.update.status');
    Route::post('/mutile-update/apply', 'Admin\ApplyController@mutileUpdate')
        ->name('mutileUpdate.apply');
    Route::get('/notify-apply', 'Admin\ApplyController@notify')->name('notify.apply');

    Route::resource('sub', 'Admin\SubController');
    Route::post('/mutile-update/sub', 'Admin\SubController@mutileUpdate')
        ->name('mutileUpdate.sub');

    //Hoa Hồng
    Route::resource('conf-mail', 'Admin\ConfMailController');
    Route::post('/mutile-update/conf-mail', 'Admin\ConfMailController@mutileUpdate')
        ->name('mutileUpdate.conf-mail');

    //Hoa Hồng
    Route::resource('commission', 'Admin\CommissionController');
    Route::post('/mutile-update/commission', 'Admin\CommissionController@mutileUpdate')
        ->name('mutileUpdate.commission');

    //Question
    Route::resource('qa', 'Admin\QaController');
    Route::post('/mutile-update/qa', 'Admin\QaController@mutileUpdate')
        ->name('mutileUpdate.qa');

    //Area Question
    Route::resource('area', 'Admin\AreaController');
    Route::post('/mutile-update/area', 'Admin\AreaController@mutileUpdate')
        ->name('mutileUpdate.area');

    //User
    Route::resource('info', 'Admin\InfoController');
    Route::post('/mutile-update/info', 'Admin\InfoController@mutileUpdate')
        ->name('mutileUpdate.info');
    Route::get('/register-agent', 'Admin\InfoController@deactiveAgent')->name('deactive.agent');
    Route::get('/active/agent/{id}', 'Admin\InfoController@active')->name('active.info');

    //Cài đặt
    Route::resource('conf', 'Admin\ConfController');
    Route::post('/mutile-update/conf', 'Admin\ConfController@mutileUpdate')
        ->name('mutileUpdate.conf');

    //Lợi cihs
    Route::resource('benefit', 'Admin\BenefitController');
    Route::post('/mutile-update/benefit', 'Admin\BenefitController@mutileUpdate')
        ->name('mutileUpdate.benefit');

    //Loại lợi ích
    Route::resource('cat-benefit', 'Admin\CatBenefitController');
    Route::post('/mutile-update/cat-benefit', 'Admin\CatBenefitController@mutileUpdate')
        ->name('mutileUpdate.cat-benefit');

    //Tài liệu
    Route::resource('doc', 'Admin\DocController');
    Route::post('/mutile-update/doc', 'Admin\DocController@mutileUpdate')
        ->name('mutileUpdate.doc');

    //Dịch vụ
    Route::resource('service', 'Admin\ServiceController');
    Route::post('/mutile-update/service', 'Admin\ServiceController@mutileUpdate')
        ->name('mutileUpdate.service');

    //Content
    Route::resource('content', 'Admin\ContentController');
    Route::post('/mutile-update/content', 'Admin\ContentController@mutileUpdate')
        ->name('mutileUpdate.content');

    //Section
    Route::resource('section', 'Admin\SectionController');
    Route::post('/mutile-update/section', 'Admin\SectionController@mutileUpdate')
        ->name('mutileUpdate.section');

    //Post
    Route::resource('post', 'Admin\PostController');
    Route::post('/mutile-update/post', 'Admin\PostController@mutileUpdate')
        ->name('mutileUpdate.post');

    //Album
    Route::resource('album', 'Admin\AlbumController');
    Route::post('/mutile-update/album', 'Admin\AlbumController@mutileUpdate')
        ->name('mutileUpdate.album');
    Route::get('/get-image/autocomplete', 'Admin\AlbumController@getImage')
        ->name('get-image');

    //Category
    Route::resource('category', 'Admin\CategoryController');
    Route::post('/mutile-update/category', 'Admin\CategoryController@mutileUpdate')
        ->name('mutileUpdate.category');

    //Category
    Route::resource('menu', 'Admin\MenuHeaderController');
    Route::post('/mutile-update/menu', 'Admin\MenuHeaderController@mutileUpdate')
        ->name('mutileUpdate.menu');

    //Tag
    Route::resource('tag', 'Admin\TagController');
    Route::post('/mutile-update/tag', 'Admin\TagController@mutileUpdate')
        ->name('mutileUpdate.tag');

    //Tag
    Route::resource('temp-mail', 'Admin\TempMailController');
    Route::post('/mutile-update/temp-mail', 'Admin\TempMailController@mutileUpdate')
        ->name('mutileUpdate.temp-mail');

    //Icon
    Route::resource('icon', 'Admin\IconController');
    Route::post('/mutile-update/icon', 'Admin\IconController@mutileUpdate')
        ->name('mutileUpdate.icon');

    //Seo
    Route::resource('seo', 'Admin\SeoController');
    Route::post('/mutile-update/seo', 'Admin\SeoController@mutileUpdate')
        ->name('mutileUpdate.seo');

    //Media
    Route::resource('media', 'Admin\MediaController');
    Route::post('/mutile-update/media', 'Admin\MediaController@mutileUpdate')
        ->name('mutileUpdate.media');

    //Home
    Route::get('/home', 'Admin\HomeController@adminHome')->name('admin.home');

    //User
    Route::resource('user', 'Admin\UserController');
    Route::get('/agent-profile', 'Admin\UserController@getProfile')->name('profile.agent.get');
    Route::post('/agent-profile', 'Admin\UserController@postProfile')->name('profile.agent.post');
    Route::post('/mutile-update/user', 'Admin\UserController@mutileUpdate')
        ->name('mutileUpdate.user');

    //Webinfo
    Route::resource('webinfo', 'Admin\WebinfoController');
    Route::post('/mutile-update/webinfo', 'Admin\WebinfoController@mutileUpdate')
        ->name('mutileUpdate.webinfo');

    //Page
    Route::resource('page', 'Admin\PageController');
    Route::post('/mutile-update/page', 'Admin\PageController@mutileUpdate')
        ->name('mutileUpdate.page');

    //Person
    Route::resource('person', 'Admin\PersonController');
    Route::post('/mutile-update/person', 'Admin\PersonController@mutileUpdate')
        ->name('mutileUpdate.person');

    //Support
    Route::resource('support', 'Admin\SupportController');
    Route::post('/mutile-update/support', 'Admin\SupportController@mutileUpdate')
        ->name('mutileUpdate.support');

    //Banner
    Route::resource('banner', 'Admin\BannerController');
    Route::post('/mutile-update/banner', 'Admin\BannerController@mutileUpdate')
        ->name('mutileUpdate.banner');

    //Logs
    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')
        ->name('admin.logs');

    //Files
    Route::get('/files', function () {
        return view('back-end.pages.files');
    })->name('admin.files');

    //Page test
    Route::get('/test', function () {
        return view('back-end.pages.test', ['flag' => 'rfgr', 'page_name' => 'rfgr']);
    })->name('admin.test');
    //about us
    Route::get('/about-us', 'Admin\AboutController@index')->name('admin.about-us');
    Route::get('/about-us/store', 'Admin\AboutController@create')->name('about-us.store');
    //homepage
    Route::get('/home-page', 'Admin\HomePageController@index')->name('admin.home-page');
    Route::get('/home-page/store', 'Admin\HomePageController@create')->name('home-page.store');
    //Slug
    Route::get('/create-slug', 'Admin\HomeController@createSlug')
        ->name('create-slug');
});
//END ADMIN ROUTE
Auth::routes();
