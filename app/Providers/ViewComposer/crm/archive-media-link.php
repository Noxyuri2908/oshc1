<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.archive-media-link.form',
    'CRM.pages.archive-media-link.filter',
    'CRM.pages.archive-media-link.data'
], function ($view) {
    $statuses = \App\Admin\Status::whereIn('type',[
        'from_archive_media_link',
        'type_archive_media_link',
        'information_focused_archive_media_link',
        'category_archive_media_link',
        'source_archive_media_link',
    ])->get(['id','name','type','value']);
    $hotnewsArchiveMediaLink = \App\Admin\ArchiveMediaLink::$HOTNEWS;
    $fromStatuses = $statuses->where('type','from_archive_media_link');
    $typeStatuses = $statuses->where('type','type_archive_media_link');
    $informationStatuses = $statuses->where('type','information_focused_archive_media_link');
    $sourceStatuses = $statuses->where('type','source_archive_media_link');
    //dd($sourceStatuses);
    //$sourceStatuses = $statuses->where('type','source_archive_media_link');

    $view->with(compact(
        'hotnewsArchiveMediaLink',
        'typeStatuses',
        'informationStatuses',
        //'categoryStatuses',
        'sourceStatuses',
        'fromStatuses'
    ));
});
