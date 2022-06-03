<?php

use Illuminate\Support\Facades\View;

View::composer([
    'CRM.elements.task.media.table.web',
    'CRM.elements.task.media.table.fanpage.data',
    'CRM.elements.task.media.table.group.data',
    'CRM.elements.task.media.table.web.data',
    'CRM.elements.task.media.table.email-marketing.data',
    //'CRM.elements.task.media.table.email-marketing.filter',
    'CRM.elements.task.media.table.email-marketing.form',
    'CRM.elements.task.media.table.web.form',
    'CRM.elements.task.media',

], function ($view) {
    $statuses = \App\Admin\Status::whereIn('type', [
        'category_media',
        'type_source_media',
        'web_media',
        'group_media',
        'source_post_media',
        'task_media_category_email_marketing',
        'task_media_object_email_marketing',
        'task_media_type_of_promotion_email_marketing',
        'source_archive_media_link',
    ])->get(['id', 'name', 'type', 'value']);
    $categoryEmailMarketing = $statuses->where('type', 'task_media_category_email_marketing');
    $objectEmailMarketing = $statuses->where('type', 'task_media_object_email_marketing');
    $typeOfPromotionEmailMarketing = $statuses->where('type', 'task_media_type_of_promotion_email_marketing');
    $webMedia = \App\Admin\TaskMediaStatus::get();
    $webMediaValue = $webMedia->pluck('category');

    $typeSourceMedia = $statuses->where('type', 'type_source_media');

    $sourcePostMedias = $statuses->where('type', 'source_archive_media_link');
    $archiveMediaList = \App\Admin\ArchiveMediaLink::get(['id', 'source_id', 'name'])->groupBy('source_id');
    $sourcePostMedias = $sourcePostMedias->map(function ($item, $key) use ($archiveMediaList) {
        return collect([
            'id' => $item->id,
            'name' => $item->name,
            'value' => !empty($archiveMediaList[$item->id]) ? $archiveMediaList[$item->id]->pluck('name')->toJson() : ''
        ]);
    });
    //dd($sourcePostMedias);
    $services = \App\Admin\Dichvu::get([
        'name',
        'id',
    ]);
    $rates = \App\Admin\MediaPost::$RATE;
    $seos = \App\Admin\MediaPost::$SEO;
    $types = \App\Admin\MediaPost::$TYPE;
    $typePromotion = \App\Admin\MediaPost::$TypePromotion;
    $admins = \App\Admin::pluck('admin_id', 'id');
    $view->with([
        'typeSourceMedia' => $typeSourceMedia,
        'webMedia' => $webMedia,
        'rates' => $rates,
        'seos' => $seos,
        'admins' => $admins,
        'services' => $services,
        'webMediaValue' => $webMediaValue,
        'types' => $types,
        'sourcePostMedias' => $sourcePostMedias,
        'categoryEmailMarketing' => $categoryEmailMarketing,
        'objectEmailMarketing' => $objectEmailMarketing,
        'typeOfPromotionEmailMarketing' => $typeOfPromotionEmailMarketing,
        'typePromotion'=>$typePromotion
        //'sourcePostValue' => $sourcePostValue,
    ]);
});
