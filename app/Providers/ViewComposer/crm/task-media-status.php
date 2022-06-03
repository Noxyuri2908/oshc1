<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.task-media-setting.form',
    'CRM.pages.task-media-setting.filter',
    'CRM.pages.task-media-setting.data'

], function ($view) {
    $typeSetting = \App\Admin\MediaPost::$TYPE;
    $view->with(compact('typeSetting'));
});
