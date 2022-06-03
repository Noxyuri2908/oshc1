<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Admin\Webinfo;

class FrontendViewComposer
{
    public function __construct()
    {

    }

    public function compose($view)
    {
        $info = cache()->remember('web_info_front_end_all',60*2,function(){
            return Webinfo::whereIN('code', [
                'logo',
                'logo_company',
                'link_fb',
                'link_twiter',
                'link_gplus',
                'hotline',
                'quote_now',
                'special_offer',
                'copyright',
                'title_form_home',
                'des_form_home',
                'banner_home',
                'sevice_title_home',
                'sevice_des_home',
                'title_choose_home',
                'des_choose_home',
                'video_home',
                'title_client_home',
                'des_client_home',
                'partner_title_home',
                'partner_des_home',
                'title_footer_col_1',
                'title_footer_col_2',
                'title_footer_col_3',
                'content_footer_col_1',
                'content_footer_col_2',
                'content_footer_col_3',
                'get_a_quote_section_1',
                'get_a_quote_section_2',
                'get_a_quote_banner_deskop_1',
                'get-a-quote-image-quote-now'
            ])
                ->orWhere('code','LIKE','%sevice_intro_home%')
                ->orWhere('code','LIKE','%sevice_home%')
                ->orWhere('code','LIKE','%chose_home%')
                ->orWhere('code','LIKE','%pt_item%')
                ->where('status', 1)
                ->get();
        });
//        dd($info);
        $tmp = "sevice_intro_home";
//        $sevice_intro_home = Webinfo::whereRaw('code like (?)', ["%{$tmp}%"])->get();
        $sevice_intro_home= $info->whereIn('code',[
            'sevice_intro_home_1',
            'sevice_intro_home_2',
            'sevice_intro_home_3',
            'sevice_intro_home_4'
        ]);
//        dd($sevice_intro_home);
        $sev = "sevice_home";
//        $sevice_home = Webinfo::whereRaw('code like (?)', ["%{$sev}%"])->get();
        $sevice_home = $info->whereIn('code',[
            'sevice_home_1',
            'sevice_home_2',
            'sevice_home_3',
            'sevice_home_4',
            'sevice_home_5',
            'sevice_home_6',
        ]);
        $chose = "chose_home";
//        $chose_home = Webinfo::whereRaw('code like (?)', ["%{$chose}%"])->get();
        $chose_home = $info->whereIn('code',[
            'chose_home_1',
            'chose_home_2',
            'chose_home_3',
            'chose_home_4',
            'chose_home_5',
        ]);
        $pt = "pt_item";
//        $pt_item = Webinfo::whereRaw('code like (?)', ["%{$pt}%"])->get();
        $pt_item = $info->whereIn('code',[
            'pt_item_1',
            'pt_item_2',
            'pt_item_3',
            'pt_item_4',
            'pt_item_5',
        ]);
        $view->with(['sevice_intro_home' => $sevice_intro_home]);
        $view->with(['sevice_home' => $sevice_home]);
        $view->with(['chose_home' => $chose_home]);
        $view->with(['pt_item' => $pt_item]);
        $view->with('logo',  $info->where('code', 'logo')->first());
        $view->with('logo_company',  $info->where('code', 'logo_company')->first());
        $view->with('hotline',  $info->where('code', 'hotline')->first());
        $view->with('link_fb',  $info->where('code', 'link_fb')->first());
        $view->with('link_twiter',  $info->where('code', 'link_twiter')->first());
        $view->with('link_gplus',  $info->where('code', 'link_gplus')->first());
        $view->with('quote_now',  $info->where('code', 'quote_now')->first());
        $view->with('special_offer',  $info->where('code', 'special_offer')->first());
        $view->with('copyright',  $info->where('code', 'copyright')->first());
        $view->with('title_form_home',  $info->where('code', 'title_form_home')->first());
        $view->with('des_form_home',  $info->where('code', 'des_form_home')->first());
        $view->with('banner_home',  $info->where('code', 'banner_home')->first());
        $view->with('sevice_title_home',  $info->where('code', 'sevice_title_home')->first());
        $view->with('sevice_des_home',  $info->where('code', 'sevice_des_home')->first());
        $view->with('title_choose_home',  $info->where('code', 'title_choose_home')->first());
        $view->with('des_choose_home',  $info->where('code', 'des_choose_home')->first());
        $view->with('video_home',  $info->where('code', 'video_home')->first());
        $view->with('title_client_home',  $info->where('code', 'title_client_home')->first());
        $view->with('des_client_home',  $info->where('code', 'des_client_home')->first());
        $view->with('partner_title_home',  $info->where('code', 'partner_title_home')->first());
        $view->with('partner_des_home',  $info->where('code', 'partner_des_home')->first());
        $view->with('title_footer_col_1',  $info->where('code', 'title_footer_col_1')->first());
        $view->with('title_footer_col_2',  $info->where('code', 'title_footer_col_2')->first());
        $view->with('title_footer_col_3',  $info->where('code', 'title_footer_col_3')->first());
        $view->with('content_footer_col_1',  $info->where('code', 'content_footer_col_1')->first());
        $view->with('content_footer_col_2',  $info->where('code', 'content_footer_col_2')->first());
        $view->with('content_footer_col_3',  $info->where('code', 'content_footer_col_3')->first());
        $view->with('get_a_quote_section_1',  $info->where('code', 'get_a_quote_section_1')->first());
        $view->with('get_a_quote_section_2',  $info->where('code', 'get_a_quote_section_2')->first());
        $view->with('get_a_quote_banner_deskop_1',  $info->where('code', 'get_a_quote_banner_deskop_1')->first());
        $view->with('getImageQuote',  $info->where('code', 'get-a-quote-image-quote-now')->first());
        $view->with('username',  (!is_null(auth()->user())) ? auth()->user()->admin_id : '');
        $view->with('emailuser',  (!is_null(auth()->user())) ? auth()->user()->email : '');
    }
}

