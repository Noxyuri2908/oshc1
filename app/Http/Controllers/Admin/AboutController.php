<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    //
    public function index()
    {
        $pageAboutUs = Page::where('type', 1)->first();
        $content = json_decode($pageAboutUs->content, true);
        return view('back-end.about-us.form', compact('content'));
    }
    public function create(Request $request)
    {

        for ($i = 1; $i < 5; $i++) {
            $corevalue[] = [
                'main_content' => $request->get('core_value_main_content_' . $i),
                'image' => $request->get('core_value_image_' . $i),
                'title' => $request->get('box_core_value_title_' . $i),
            ];
            $our_mission[] = [
                'main_content' => $request->get('our_mission_main_content_' . $i),
                'image' => $request->get('our_mission_image_banner_' . $i),
                'title' => $request->get('our_mission_value_title_' . $i),
            ];
            $company_business[] = [
                'image' => $request->get('company_business_image_banner_' . $i),
                'main_content' => $request->get('company_business_main_content_' . $i),
            ];
        }
        for ($i = 1; $i < 4; $i++) {
        }
        $data = $request->all();
        $data['repeat'] = [
            'core_value' => $corevalue,
            'our_mission' => $our_mission,
            'company_business' => $company_business
        ];
        $dataInsert['content'] = json_encode($data);

        $pageAboutUs = Page::where('type', 1)->update($dataInsert);
        if ($pageAboutUs) {
            return redirect()->back();
        }
    }
}
