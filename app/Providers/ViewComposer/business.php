<?php 
use Illuminate\Support\Facades\View;
use App\Admin\Webinfo;

View::composer('back-end.agent.profile', function ($view) {
	$view->with(['flag'=>'profile','page_name'=>'APPLY', 'name_session'=>'profile']);
});
View::composer('back-end.agent.commission', function ($view) {
	$view->with(['flag'=>'commission','page_name'=>'COMMISSION', 'name_session'=>'commission']);
});
View::composer('back-end.agent.reg', function ($view) {
	$view->with(['flag'=>'reg','page_name'=>'SERVICE REGISTER', 'name_session'=>'reg']);
});

        //START APPLY
View::composer('back-end.apply.*', function ($view) {
	$view->with(['flag'=>'apply','page_name'=>'APPLY', 'name_session'=>'apply']);
});
View::composer(['back-end.apply.create', 'back-end.apply.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - APPLY', 'parent_route'=>route('apply.index')]);
});
View::composer(['back-end.apply.list', 'back-end.apply.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('apply.create'), 
		'route_update'=>route('mutileUpdate.apply')]);
});
        //END APPLY

        //START COMM
View::composer('back-end.sub.*', function ($view) {
	$view->with(['flag'=>'sub','page_name'=>'Subcriber', 'name_session'=>'sub']);
});
View::composer(['back-end.sub.create', 'back-end.sub.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - Subcriber', 'parent_route'=>route('sub.index')]);
});
View::composer(['back-end.sub.list', 'back-end.sub.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('sub.create'), 
		'route_update'=>route('mutileUpdate.sub')]);
});
        //END COMM

        //START COMM
View::composer('back-end.price.*', function ($view) {
	$view->with(['flag'=>'price','page_name'=>'PRICE', 'name_session'=>'price']);
});
View::composer(['back-end.price.create', 'back-end.price.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - PRICE', 'parent_route'=>route('price.index')]);
});
View::composer(['back-end.price.list', 'back-end.price.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('price.create'), 
		'route_update'=>route('mutileUpdate.price')]);
});
        //END COMM

        //START COMM
View::composer('back-end.question.*', function ($view) {
	$view->with(['flag'=>'question','page_name'=>'QUESTION', 'name_session'=>'question']);
});
View::composer(['back-end.question.create', 'back-end.question.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - QUESTION', 'parent_route'=>route('question.index')]);
});
View::composer(['back-end.question.list', 'back-end.question.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('question.create'), 
		'route_update'=>route('mutileUpdate.question')]);
});
        //END COMM

        //START COMM
View::composer('back-end.commission.*', function ($view) {
	$view->with(['flag'=>'commission','page_name'=>'THIẾT LẬP HOA HỒNG', 'name_session'=>'commission']);
});
View::composer(['back-end.commission.create', 'back-end.commission.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - THIẾT LẬP HOA HỒNG', 'parent_route'=>route('commission.index')]);
});
View::composer(['back-end.commission.list', 'back-end.commission.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('commission.create'), 
		'route_update'=>route('mutileUpdate.commission')]);
});
        //END COMM

        //START Person
View::composer('back-end.person.*', function ($view) {
	$view->with(['flag'=>'person','page_name'=>'Danh sách người liên hệ', 'name_session'=>'person']);
});
View::composer(['back-end.person.create', 'back-end.person.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách người liên hệ', 'parent_route'=>route('person.index')]);
});
View::composer(['back-end.person.list', 'back-end.person.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('person.create'), 
		'route_update'=>route('mutileUpdate.person')]);
});
        //END Person

        //START Support
View::composer('back-end.support.*', function ($view) {
	$view->with(['flag'=>'support','page_name'=>'Chăm sóc khách hàng', 'name_session'=>'support']);
});
View::composer(['back-end.support.create', 'back-end.support.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách hoạt động hỗ trợ khách hàng', 'parent_route'=>route('support.index')]);
});
View::composer(['back-end.support.list', 'back-end.support.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('support.create'), 
		'route_update'=>route('mutileUpdate.support')]);
});
        //END Support

//START AGENT
View::composer('back-end.info.*', function ($view) {
	$view->with(['flag'=>'info','page_name'=>'AGENT', 'name_session'=>'info']);
});
View::composer(['back-end.info.create', 'back-end.info.edit'], function ($view) {
	$view->with(['parent_menu'=>'List - AGENT', 'parent_route'=>route('info.index')]);
});
View::composer(['back-end.info.list', 'back-end.info.edit'], function ($view) {
	$view->with(['name_button'=>'Create new', 
		'route_button'=>route('info.create'), 
		'route_update'=>route('mutileUpdate.info')]);
});
//END AGENT

        //START CONF
View::composer('back-end.conf.*', function ($view) {
	$view->with(['flag'=>'conf','page_name'=>'CÀI ĐẶT LỢI ÍCH', 'name_session'=>'conf']);
});
View::composer(['back-end.conf.create', 'back-end.conf.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - CÀI ĐẶT LỢI ÍCH', 'parent_route'=>route('conf.index')]);
});
View::composer(['back-end.conf.list', 'back-end.conf.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('conf.create'), 
		'route_update'=>route('mutileUpdate.conf')]);
});
        //END CONF

        //START BENEFIT
View::composer('back-end.benefit.*', function ($view) {
	$view->with(['flag'=>'benefit','page_name'=>'LỢI ÍCH', 'name_session'=>'benefit']);
});
View::composer(['back-end.benefit.create', 'back-end.benefit.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - LỢI ÍCH', 'parent_route'=>route('benefit.index')]);
});
View::composer(['back-end.benefit.list', 'back-end.benefit.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('benefit.create'), 
		'route_update'=>route('mutileUpdate.benefit')]);
});
        //END BENEFIT

        //START CAT-BENEFIT
View::composer('back-end.cat-benefit.*', function ($view) {
	$view->with(['flag'=>'cat-benefit','page_name'=>'LOẠI LỢI ÍCH', 'name_session'=>'cat-benefit']);
});
View::composer(['back-end.cat-benefit.create', 'back-end.cat-benefit.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - LOẠI LỢI ÍCH', 'parent_route'=>route('cat-benefit.index')]);
});
View::composer(['back-end.cat-benefit.list', 'back-end.cat-benefit.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('cat-benefit.create'), 
		'route_update'=>route('mutileUpdate.cat-benefit')]);
});
        //END CAT-BENEFIT

        //START DOCUMENT
View::composer('back-end.doc.*', function ($view) {
	$view->with(['flag'=>'doc','page_name'=>'TÀI LIỆU', 'name_session'=>'doc']);
});
View::composer(['back-end.doc.create', 'back-end.doc.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách - TÀI LIỆU', 'parent_route'=>route('doc.index')]);
});
View::composer(['back-end.doc.list', 'back-end.doc.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('doc.create'), 
		'route_update'=>route('mutileUpdate.doc')]);
});
        //END DOCUMENT

        //START DỊCH VỤ
View::composer('back-end.service.*', function ($view) {
	$view->with(['flag'=>'service','page_name'=>'PROVIDER', 'name_session'=>'service']);
});
View::composer(['back-end.service.create', 'back-end.service.edit'], function ($view) {
	$view->with(['parent_menu'=>'List - PROVIDER', 'parent_route'=>route('service.index')]);
});
View::composer(['back-end.service.list', 'back-end.service.edit'], function ($view) {
	$view->with(['name_button'=>'Add', 
		'route_button'=>route('service.create'), 
		'route_update'=>route('mutileUpdate.service')]);
});
        //END DỊCH VỤ


        //START Area
View::composer('back-end.area.*', function ($view) {
	$view->with(['flag'=>'area','page_name'=>'Area', 'name_session'=>'area']);
});
View::composer(['back-end.area.create', 'back-end.area.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách khu vực', 'parent_route'=>route('area.index')]);
});
View::composer(['back-end.area.list', 'back-end.area.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('area.create'), 
		'route_update'=>route('mutileUpdate.area')]);
});
        //END Area

        //START Question
View::composer('back-end.qa.*', function ($view) {
	$view->with(['flag'=>'qa','page_name'=>'Question and Answer', 'name_session'=>'qa']);
});
View::composer(['back-end.qa.create', 'back-end.qa.edit'], function ($view) {
	$view->with(['parent_menu'=>'Danh sách hỏi đáp', 'parent_route'=>route('qa.index')]);
});
View::composer(['back-end.qa.list', 'back-end.qa.edit'], function ($view) {
	$view->with(['name_button'=>'Thêm mới', 
		'route_button'=>route('qa.create'), 
		'route_update'=>route('mutileUpdate.qa')]);
});
        //END Question