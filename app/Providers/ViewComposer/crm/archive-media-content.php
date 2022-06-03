<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.archive-media-content.form',
    'CRM.pages.archive-media-content.filter',
    'CRM.pages.archive-media-content.data'
], function ($view) {
    $statuses = \App\Admin\Status::whereIn('type',[
        'category_media',
        'type_source_media',
        'web_media',
        'group_media',
        'source_post_media',
        'web_media_content',
        'category_archive_media_link'
    ])->get(['id','name','type','value']);
    $webMedia = $statuses->where('type','web_media_content');
    $admins = \App\Admin::pluck('username', 'id');
    $statusArchiveMediaContent = \App\Admin\ArchiveMediaContent::$STATUS;
    $view->with(compact(
        'webMedia',
        'admins',
        'statusArchiveMediaContent'
    ));
});
