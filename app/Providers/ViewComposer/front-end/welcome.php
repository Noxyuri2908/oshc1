<?php

use App\Admin\Dichvu;
use Illuminate\Support\Facades\View;
use App\Admin\Webinfo;
use App\Admin\MenuHeader;
use App\Admin\Page;
use App\Admin\Service;

View::composer('welcome', function ($view) {
//    $info = Webinfo::whereIN('code', [
//        'email',
//        'logo',
//        'link_fb',
//        'link_twiter',
//        'link_gplus',
//        'hotline',
//        'sevice_intro_home',
//        'sevice_home',
//        'chose_home',
//        'partner'
//    ])
//        ->where('status', 1)->get();
//    $email = $info->where('code', 'email')->first();
//    $menu_headers = MenuHeader::orderBy('pos', 'asc')->where('status', 1)->get();
//    $view->with([
//        'menu_headers' => $menu_headers,
//        'logo' => $info->where('code', 'logo')->first(),
//        'link_fb' => $info->where('code', 'link_fb')->first(),
//        'link_twiter' => $info->where('code', 'link_twiter')->first(),
//        'link_gplus' => $info->where('code', 'link_gplus')->first(),
//        'hotline' => $info->where('code', 'hotline')->first(),
//        'email' => $email
//    ]);
});
