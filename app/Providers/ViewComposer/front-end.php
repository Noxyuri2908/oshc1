<?php

use App\Admin\Dichvu;
use Illuminate\Support\Facades\View;
use App\Admin\Webinfo;
use App\Admin\MenuHeader;
use App\Admin\Page;
use App\Admin\Service;

//FRONT-END
View::composer(
    [
//        'fontend.partials.header',
        'fontend.page.news-detail',
//        'fontend.partials.footer',
//        'fontend.layouts.master',
        'welcome',
        'fontend.page.qa',
        'fontend.page.register-oshc',
        'fontend.page.get-a-quote',
        'fontend.page.news',
        'fontend.page.about',
        'fontend.page.apply',
        'fontend.page.payment',
        'fontend.page.contact',
        'fontend.page.special',
        'fontend.partials.service-home'
    ],
    'App\Http\ViewComposers\FrontendViewComposer'
);
View::composer('fontend.layouts.master', function ($view) {
    $info = Webinfo::whereIN('code', ['quote_now', 'special_offer'])->where('status', 1)->get();
    $view->with(['quote_now' => $info->where('code', 'quote_now')->first()]);
    $view->with(['special_offer' => $info->where('code', 'special_offer')->first()]);
});
View::composer('fontend.partials.footer', function ($view) {
    $info = Webinfo::where('status', 1)->get(['code', 'name', 'name_cn', 'name_vi', 'content_cn', 'content_vi', 'image', 'link', 'content', 'id', 'status']);
    $email = $info->where('code', 'email')->first();
    $linkFb = $info->where('code', 'link_fb')->first();
    $linkGg = $info->where('code', 'link_gplus')->first();
    $linkTwiter = $info->where('code', 'link_twiter')->first();
    $newLetter = $info->where('code', 'new_letter_footer')->first();
    $aboutUs = $info->where('code', 'about_us')->first();
    $termAndConditions = $info->where('code', 'term_and_conditions')->first();
    $privacyPolicy = $info->where('code', 'privacy_policy')->first();
    $hotline = $info->where('code', 'hotline')->first();
    $address = $info->where('code', 'address_footer')->first();
    $homeFooter = $info->where('code', 'home_footer')->first();
    $aboutFooter = $info->where('code', 'about_footer')->first();
    $eventFooter = $info->where('code', 'event_footer')->first();
    $contactFooter = $info->where('code', 'contact_footer')->first();

    $view->with([
        'email' => $email,
        'linkFb' => $linkFb,
        'linkGg' => $linkGg,
        'linkTwiter' => $linkTwiter,
        'newLetter' => $newLetter,
        'aboutUs' => $aboutUs,
        'termAndConditions' => $termAndConditions,
        'privacyPolicy' => $privacyPolicy,
        'hotline' => $hotline,
        'address' => $address,
        'homeFooter' => $homeFooter,
        'aboutFooter' => $aboutFooter,
        'eventFooter' => $eventFooter,
        'contactFooter' => $contactFooter
    ]);
});
View::composer(['fontend.partials.service-home', 'welcome'], function ($view) {
    $pageHomePage = Page::where('type', 2)->first()->content;
    $serviceHome = json_decode($pageHomePage, true);
    $serviceId = Dichvu::where('service_id', 1)->first()->id;
    $provider = Service::where('dichvu_id', $serviceId)->pluck('name', 'id')->toArray();
    $view->with([
        'serviceHome' => $serviceHome,
        'provider' => $provider
    ]);
});
