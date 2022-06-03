<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.google-adword-media.form',
    'CRM.pages.google-adword-media.filter'
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
    $webMedias = $statuses->where('type','web_media_content');
    $countries = config()->get('country.list');
    $view->with(compact(
        'webMedias',
        'countries'
    ));
});
