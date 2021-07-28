<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.domain-hosting-list.form',
    'CRM.pages.domain-hosting-list.filter',
    'CRM.pages.domain-hosting-list.data'
], function ($view) {
    $statuses = \App\Admin\Status::whereIn('type',[
        'category_media',
        'type_source_media',
        'web_media',
        'group_media',
        'source_post_media',
        'web_media_content',
        'category_archive_media_link',
        'type_domain_hosting'
    ])->get(['id','name','type','value']);
    $webMedia = $statuses->where('type','web_media_content');
    $types = $statuses->where('type','type_domain_hosting');
    $admins = \App\Admin::pluck('username', 'id');
    $statusArchiveMediaContent = \App\Admin\ArchiveMediaContent::$STATUS;
    $view->with(compact(
        'webMedia',
        'admins',
        'statusArchiveMediaContent',
        'types'
    ));
});
