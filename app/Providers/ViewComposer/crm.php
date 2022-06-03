<?php

use App\Admin;
use App\Admin\Dichvu;
use App\Admin\SaleTaskAssign;
use App\Admin\Status;
use Illuminate\Support\Facades\View;
use App\Admin\Webinfo;
use App\Admin\MenuHeader;
use App\Admin\Page;
use App\Admin\Service;
use App\User;

View::composer(['CRM.elements.report.filter', 'CRM.pages.event-google-form', 'CRM.elements.task.sale.table.sale_task_assign.data', 'CRM.elements.task.sale.table.sale_task_assign.form-modal'], function ($view) {
    $agents = User::get()->pluck('name', 'id');
    $view->with(['agents' => $agents]);
});
View::composer([
    //'CRM.elements.task.sale.table.follow-up-agent',
    //'CRM.elements.task.sale.table.appointment',
    //'CRM.elements.task.sale.table.market-feedback-agent',
    //'CRM.elements.task.sale.table.sale_task_assign',
    //'CRM.elements.task.sale.table.proposal-agent',
    'CRM.elements.table-agent',
    'CRM.elements.task.sale.sale',
    'CRM.elements.task.sale.table.sale_task_assign.data',
    'CRM.elements.task.sale.table.sale_task_assign.form-modal',
    'CRM.elements.task.sale.table.follow_up_agent.data',
    'CRM.elements.task.sale.table.appointment.data',
    'CRM.elements.task.sale.table.market_feedback_agent.data',
    'CRM.elements.task.sale.table.sale_task_assign.data',
    'CRM.elements.task.sale.table.proposal_agent.data',
    'CRM.elements.process.modal-follow-up',
    'CRM.elements.agents.process.modal-market-feedback',
    'CRM.elements.agents.process.modal-proposal',
    'CRM.elements.process.form',
    'CRM.elements.task.remind-follow-ups.index'
], function ($view) {
    $admins = Admin::pluck('admin_id', 'id');
    $dichvus = Dichvu::get();
    $statuses = Status::whereIn('type', [
        'sale_task_assign_type'
    ])->get();
    $saleTaskAssignType = $statuses->where('type', 'sale_task_assign_type');
    $view->with([
        'admins' => $admins,
        'dichvus' => $dichvus,
        'saleTaskAssignType' => $saleTaskAssignType
    ]);
});
View::composer(['CRM.pages.status.form'], function ($view) {
    $type = Status::$TYPE;
    $view->with([
        'type' => $type
    ]);
});

//View::composer(['CRM.elements.task.media.table.web.form'],function ($view){
//    $statuses = Status::whereIn('type',[
//        'category_media',
//        'type_source_media',
//        'web_media',
//        'group_media',
//        'source_post_media'
//    ])->get(['id','name','type','value']);
//    $typeSourceMedia = $statuses->where('type','type_source_media');
//    $categoryMedia = $statuses->where('type','category_media');
//    $webMedia = $statuses->where('type','web_media');
//    $services = Dichvu::get([
//        'name',
//        'id'
//    ]);
//    $sourcePostMedia = $statuses->where('type','source_post_media');
//    $groupMedia = $statuses->where('type','group_media');
//
//    $rates = Admin\MediaPost::$RATE;
//    $seos = Admin\MediaPost::$SEO;
//    $admins = Admin::pluck('username', 'id');
//    $types = Admin\MediaPost::$TYPE;
//
//    $view->with([
//        'typeSourceMedia'=>$typeSourceMedia,
//        'categoryMedia'=>$categoryMedia,
//        'services'=>$services,
//        'rates'=>$rates,
//        'seos'=>$seos,
//        'admins'=>$admins,
//        'webMedia'=>$webMedia,
//        'types'=>$types,
//        'sourcePostMedia'=>$sourcePostMedia,
//        'groupMedia'=>$groupMedia
//    ]);
//});
View::composer([
    'CRM.pages.archive-media-link.form',
    'CRM.pages.archive-media-link.filter'
], function ($view) {
    $statuses = Status::whereIn('type', [
        'from_archive_media_link',
        'type_archive_media_link',
        'information_focused_archive_media_link',
        'category_archive_media_link'
    ])->get(['id', 'name', 'type', 'value']);
    $fromMediaLinks = $statuses->where('type', 'from_archive_media_link');
    $typeMediaLinks = $statuses->where('type', 'type_archive_media_link');
    $informationFocusedMediaLinks = $statuses->where('type', 'information_focused_archive_media_link');
    $countries = config('country.list');
    $hotNews = Admin\ArchiveMediaLink::$HOTNEWS;
    $categoryArchiveMediaLink = $statuses->where('type', 'category_archive_media_link');

    $view->with([
        'fromMediaLinks' => $fromMediaLinks,
        'typeMediaLinks' => $typeMediaLinks,
        'informationFocusedMediaLinks' => $informationFocusedMediaLinks,
        'countries' => $countries,
        'hotNews' => $hotNews,
        'categoryArchiveMediaLink' => $categoryArchiveMediaLink
    ]);
});

view()->composer(
    '*',
    'App\Http\ViewComposers\FrontendViewComposer'
);
