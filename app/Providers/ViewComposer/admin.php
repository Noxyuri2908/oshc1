<?php
use Illuminate\Support\Facades\View;
use App\Admin\Webinfo;
use App\User;


//START STAFF
View::composer('back-end.staff.*', function ($view) {
	$view->with(['flag'=>'staff','page_name'=>'Staff', 'name_session'=>'staff']);
});
View::composer(['back-end.staff.create', 'back-end.staff.edit'], function ($view) {
	$view->with(['parent_menu'=>'All Staff', 'parent_route'=>route('staff.index')]);
});
View::composer(['back-end.staff.list', 'back-end.staff.edit'], function ($view) {
	$view->with(['name_button'=>'Create new',
		'route_button'=>route('staff.create'),
		'route_update'=>route('mutileUpdate.staff')]);
});
//END STAFF

View::composer('back-end.partials.nav-business', function ($view) {
	$notifi = reload_notifi()->count();
	$apply = reload_apply_pending()->count();
	$reg = reload_reg_agent()->count();
	$agent_active = User::where('status',1)->count();
	$person = reload_date_of_birth();
	$view->with(['notify' => $notifi, 'apply' => $apply, 'reg'=>$reg, 'agent_active' =>$agent_active, 'person'=>$person]);
});
View::composer('back-end.pages.files', function ($view) {
	$view->with(['page_name'=>'Files', 'flag'=>'files']);
});

View::composer('back-end.pages.home', function ($view) {
	$view->with(['page_name'=>'Bảng Tin', 'flag'=>'admin-home']);
});
View::composer('back-end.report.*', function ($view) {
	$view->with(['flag'=>'report','page_name'=>'Report', 'name_session'=>'report']);
});

		//START USER
View::composer('back-end.users.*', function ($view) {
	$view->with(['flag'=>'users','page_name'=>'Người Dùng', 'name_session'=>'user']);
});
View::composer(['back-end.users.create', 'back-end.users.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - Người Dùng', 'parent_route'=>route('user.index')]);
});
View::composer(['back-end.users.list', 'back-end.users.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('user.create'),
		'route_update'=>route('mutileUpdate.user')]);
});
		//END USER
        //START WEB INFO
View::composer('back-end.conf-mail.*', function ($view) {
	$view->with(['flag'=>'conf-mail','page_name'=>'Content Mail', 'name_session'=>'conf-mail']);
});
View::composer(['back-end.conf-mail.create', 'back-end.conf-mail.edit'], function ($view) {
	$view->with(['parent_menu'=>'List - Content Mail', 'parent_route'=>route('conf-mail.index')]);
});
View::composer(['back-end.conf-mail.list', 'back-end.conf-mail.edit'], function ($view) {
	$view->with(['name_button'=>'Add new',
		'route_button'=>route('conf-mail.create'),
		'route_update'=>route('mutileUpdate.conf-mail')]);
});
        //END WEB INFO

        //START WEB INFO
View::composer('back-end.temp-mail.*', function ($view) {
	$view->with(['flag'=>'temp-mail','page_name'=>'Template Mail', 'name_session'=>'temp-mail']);
});
View::composer(['back-end.temp-mail.create', 'back-end.temp-mail.edit'], function ($view) {
	$view->with(['parent_menu'=>'List - Template Mail', 'parent_route'=>route('temp-mail.index')]);
});
View::composer(['back-end.temp-mail.list', 'back-end.temp-mail.edit'], function ($view) {
	$view->with(['name_button'=>'Add new',
		'route_button'=>route('temp-mail.create'),
		'route_update'=>route('mutileUpdate.temp-mail')]);
});
        //END WEB INFO

        //START WEB INFO
View::composer('back-end.webinfo.*', function ($view) {
	$view->with(['flag'=>'webinfo','page_name'=>'Thông Tin Website', 'name_session'=>'webinfo']);
});
View::composer(['back-end.webinfo.create', 'back-end.webinfo.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - Thông Tin Website', 'parent_route'=>route('webinfo.index')]);
});
View::composer(['back-end.webinfo.list', 'back-end.webinfo.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('webinfo.create'),
		'route_update'=>route('mutileUpdate.webinfo')]);
});
        //END WEB INFO

        //START WEB INFO
View::composer('back-end.comment.*', function ($view) {
	$view->with(['flag'=>'comment','page_name'=>'Bình luận bài viết', 'name_session'=>'comment']);
});
View::composer(['back-end.comment.create', 'back-end.comment.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - Bình luận', 'parent_route'=>route('comment.index')]);
});
View::composer(['back-end.comment.list', 'back-end.comment.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('comment.create'),
		'route_update'=>route('mutileUpdate.comment')]);
});
        //END WEB INFO

        //START PAGE
View::composer('back-end.page.*', function ($view) {
	$view->with(['flag'=>'page','page_name'=>'Trang', 'name_session'=>'page']);
});
View::composer(['back-end.page.create', 'back-end.page.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - Trang', 'parent_route'=>route('page.index')]);
});
View::composer(['back-end.page.list', 'back-end.page.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('page.create'),
		'route_update'=>route('mutileUpdate.page')]);
});
        //END PAGE

        //START BANNER
View::composer('back-end.banner.*', function ($view) {
	$view->with(['flag'=>'banner','page_name'=>'Banner', 'name_session'=>'banner']);
});
View::composer(['back-end.banner.create', 'back-end.banner.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - Banner', 'parent_route'=>route('banner.index')]);
});
View::composer(['back-end.banner.list', 'back-end.banner.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('banner.create'),
		'route_update'=>route('mutileUpdate.banner')]);
});
        //END BANNER

        //START SEO
View::composer('back-end.seo.*', function ($view) {
	$view->with(['flag'=>'seo','page_name'=>'SEO', 'name_session'=>'seo']);
});
View::composer(['back-end.seo.create', 'back-end.seo.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - SEO', 'parent_route'=>route('seo.index')]);
});
View::composer(['back-end.seo.list', 'back-end.seo.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('seo.create'),
		'route_update'=>route('mutileUpdate.seo')]);
});
        //END SEO

        //START MEDIA
View::composer('back-end.media.*', function ($view) {
	$view->with(['flag'=>'media','page_name'=>'MEDIA', 'name_session'=>'media']);
});
View::composer(['back-end.media.create', 'back-end.media.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - MEDIA', 'parent_route'=>route('media.index')]);
});
View::composer(['back-end.media.list', 'back-end.media.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('media.create'),
		'route_update'=>route('mutileUpdate.media')]);
});
        //END MEDIA

        //START ICON
View::composer('back-end.icon.*', function ($view) {
	$view->with(['flag'=>'icon','page_name'=>'ICON', 'name_session'=>'icon']);
});
View::composer(['back-end.media.create', 'back-end.media.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - ICON', 'parent_route'=>route('icon.index')]);
});
View::composer(['back-end.icon.list', 'back-end.icon.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('icon.create'),
		'route_update'=>route('mutileUpdate.icon')]);
});
        //END ICON

        //START TAG
View::composer('back-end.tag.*', function ($view) {
	$view->with(['flag'=>'tag','page_name'=>'TAG', 'name_session'=>'tag']);
});
View::composer(['back-end.tag.create', 'back-end.tag.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - TAGS', 'parent_route'=>route('tag.index')]);
});
View::composer(['back-end.tag.list', 'back-end.tag.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('tag.create'),
		'route_update'=>route('mutileUpdate.tag')]);
});
        //END TAG

        //START CATEGORY
View::composer('back-end.category.*', function ($view) {
	$view->with(['flag'=>'category','page_name'=>'CHUYÊN MỤC', 'name_session'=>'category']);
});
View::composer(['back-end.category.create', 'back-end.category.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - CHUYÊN MỤC', 'parent_route'=>route('category.index')]);
});
View::composer(['back-end.category.list', 'back-end.category.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('category.create'),
		'route_update'=>route('mutileUpdate.category')]);
});
        //END CATEGORY
        //START MENU HEADER
View::composer('back-end.menu.*', function ($view) {
	$view->with(['flag'=>'menu','page_name'=>'MENU HEADER', 'name_session'=>'menu']);
});
View::composer(['back-end.menu.create', 'back-end.menu.edit'], function ($view) {
	$view->with(['parent_menu'=>'LIST MENU HEADER', 'parent_route'=>route('menu.index')]);
});
View::composer(['back-end.menu.list', 'back-end.menu.edit'], function ($view) {
	$view->with(['name_button'=>'Add new',
		'route_button'=>route('menu.create'),
		'route_update'=>route('mutileUpdate.menu')]);
});
        //END MENU HEADER

        //START POST
View::composer('back-end.post.*', function ($view) {
	$view->with(['flag'=>'post','page_name'=>'BÀI VIẾT', 'name_session'=>'post']);
});
View::composer(['back-end.post.create', 'back-end.post.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - BÀI VIẾT', 'parent_route'=>route('post.index')]);
});
View::composer(['back-end.post.list', 'back-end.post.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('post.create'),
		'route_update'=>route('mutileUpdate.post')]);
});
        //END POST

        //START ALBUM
View::composer('back-end.album.*', function ($view) {
	$view->with(['flag'=>'album','page_name'=>'ALBUM', 'name_session'=>'album']);
});
View::composer(['back-end.album.create', 'back-end.album.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - ALBUM', 'parent_route'=>route('album.index')]);
});
View::composer(['back-end.album.list', 'back-end.album.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('album.create'),
		'route_update'=>route('mutileUpdate.album')]);
});
 //START CONTENT
View::composer('back-end.content.*', function ($view) {
	$view->with(['flag'=>'content','page_name'=>'CONTENT', 'name_session'=>'content']);
});
View::composer(['back-end.content.create', 'back-end.content.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - CONTENT', 'parent_route'=>route('content.index')]);
});
View::composer(['back-end.content.list', 'back-end.content.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('content.create'),
		'route_update'=>route('mutileUpdate.content')]);
});
        //END CONTENT

        //START SECTION
View::composer('back-end.section.*', function ($view) {
	$view->with(['flag'=>'section','page_name'=>'SECTION', 'name_session'=>'section']);
});
View::composer(['back-end.section.create', 'back-end.section.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - SECTION', 'parent_route'=>route('section.index')]);
});
View::composer(['back-end.section.list', 'back-end.section.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới',
		'route_button'=>route('section.create'),
		'route_update'=>route('mutileUpdate.section')]);
});
        //END SECTION

//START ABOUT US
View::composer('back-end.about-us.*', function ($view) {
    $view->with(['flag'=>'about','page_name'=>'About Us', 'name_session'=>'about']);
});
//View::composer(['back-end.banner.create', 'back-end.banner.edit'], function ($view) {
//    $view->with(['parent_menu'=>'Danh sách - Banner', 'parent_route'=>route('banner.index')]);
//});
//View::composer(['back-end.banner.list', 'back-end.banner.edit'], function ($view) {
//    $view->with(['name_button'=>'Thêm mới',
//        'route_button'=>route('banner.create'),
//        'route_update'=>route('mutileUpdate.banner')]);
//});
//END ABOUT US
