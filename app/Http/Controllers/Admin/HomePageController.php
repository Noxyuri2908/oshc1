<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $pageHomePage = Page::where('type', 2)->first();
        $content = json_decode($pageHomePage->content, true);
        $flag = 'homepage';
        $page_name = 'Home page';
        return view('back-end.home-page.form', compact(
            'content',
            'flag',
            'page_name'
        ));
    }
    public function create(Request $request)
    {
        // dd($request->all());
        for ($i = 1; $i < 5; $i++) {
            $sub_service_home[] = [
                'image' => $request->get('sub_service_home_image_' . $i),
                'title' => $request->get('sub_service_home_value_title_' . $i),
                'link' => $request->get('sub_service_home_value_link_'.$i),
            ];
        }
        for ($i = 1; $i <= 8; $i++) {
            $service_home[] = [
                'image' => $request->get('service_home_image_' . $i),
                'title' => $request->get('service_home_value_title_' . $i),
                'type'=>$request->get('service_home_type_'.$i),
                'link'=>$request->get('service_home_value_link_'.$i)
            ];
        }
        $data = $request->all();
        $data['repeat'] = [
            'service_home' => $service_home,
            'sub_service_home' => $sub_service_home,
        ];
        $dataInsert['content'] = json_encode($data);
        $pageAboutUs = Page::where('type', 2)->update($dataInsert);
        if ($pageAboutUs) {
            return redirect()->back();
        }
    }
}
