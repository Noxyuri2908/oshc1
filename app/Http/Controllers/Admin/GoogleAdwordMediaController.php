<?php

namespace App\Http\Controllers\Admin;

use App\Admin\ArchiveMediaLink;
use App\Admin\GoogleAdwordMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GoogleAdwordMediaController extends Controller
{
    //
    public function index(){
        $flag='google-adword-media';
        return view('CRM.pages.google-adword-media.index',compact(
            'flag'
        ));
    }
    public function getData(Request $request)
    {
        $googleAdwordMediaDatas = GoogleAdwordMedia::when($request->get('website_id'),function($query) use($request){
            $query->where('website_id',$request->get('website_id'));
        })->when($request->get('campaign'),function($query) use($request){
            $query->where('campaign','LIKE','%'.$request->get('campaign').'%');
        })->when($request->get('location_search'),function($query) use($request){
            $query->where('location_search','LIKE','%'.$request->get('location_search').'%');
        })->when($request->get('language_search'),function($query) use($request){
            $query->where('language_search',$request->get('language_search'));
        })->when($request->get('type_campaign'),function($query) use($request){
            $query->where('type_campaign','LIKE','%'.$request->get('type_campaign').'%');
        })->when($request->get('bid_price'),function($query) use($request){
            $query->where('bid_price','LIKE','%'.$request->get('bid_price').'%');
        })->when($request->get('keyword'),function($query) use($request){
            $query->where('keyword','LIKE','%'.$request->get('keyword').'%');
        })->when($request->get('title_1'),function($query) use($request){
            $query->where('title_1','LIKE','%'.$request->get('title_1').'%');
        })->when($request->get('title_2'),function($query) use($request){
            $query->where('title_2','LIKE','%'.$request->get('title_2').'%');
        })->when($request->get('title_3'),function($query) use($request){
            $query->where('title_3','LIKE','%'.$request->get('title_3').'%');
        })->when($request->get('describe'),function($query) use($request){
            $query->where('describe','LIKE','%'.$request->get('describe').'%');
        })->when($request->get('link_post'),function($query) use($request){
            $query->where('link_post','LIKE','%'.$request->get('link_post').'%');
        })->when($request->get('budget'),function($query) use($request){
            $query->where('budget','LIKE','%'.$request->get('budget').'%');
        })
            ->orderBy('id', 'desc')->paginate(15);
        $lastPage = $googleAdwordMediaDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.google-adword-media.data', compact(
                'googleAdwordMediaDatas'
            ))->render(),
            'last_page' => $lastPage
        ]);
    }

    public function create()
    {
        $flag = 'archive-media-link-store';
        return view('CRM.pages.google-adword-media.form', compact('flag'));
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'start_date',
            'end_date',
            'website_id',
            'campaign',
            'location_search',
            'language_search',
            'type_campaign',
            'bid_price',
            'keyword',
            'title_1',
            'title_2',
            'title_3',
            'describe',
            'link_post',
            'number_days',
            'budget',
            'number_click_expected',
            'number_click_reality',
            'number_impression',
            'average_CPC',
            'created_by'
        ]);
        $arrDate = [
            'start_date',
            'end_date'
        ];
        foreach($arrDate as $key){
            $data[$key] = !empty($data[$key])?convert_date_to_db($data[$key]):null;
        }
        $data['created_by'] = Auth::user()->id;
        GoogleAdwordMedia::create($data);
        $googleAdwordMediaDatas = GoogleAdwordMedia::orderBy('id', 'desc')->paginate(15);
        $lastPage = $googleAdwordMediaDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.google-adword-media.data', compact(
                'googleAdwordMediaDatas'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $flag = 'google-adword-media-edit';
        $googleAdwordMediaData = GoogleAdwordMedia::findOrFail($id);
        return view('CRM.pages.google-adword-media.form', compact(
            'flag',
            'googleAdwordMediaData'
        ));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only([
            'start_date',
            'end_date',
            'website_id',
            'campaign',
            'location_search',
            'language_search',
            'type_campaign',
            'bid_price',
            'keyword',
            'title_1',
            'title_2',
            'title_3',
            'describe',
            'link_post',
            'number_days',
            'budget',
            'number_click_expected',
            'number_click_reality',
            'number_impression',
            'average_CPC',
            'created_by'
        ]);
        $arrDate = [
            'start_date',
            'end_date'
        ];
        foreach($arrDate as $key){
            $data[$key] = !empty($data[$key])?convert_date_to_db($data[$key]):null;
        }
        $googleAdwordMediaData = GoogleAdwordMedia::findOrFail($id);
        $googleAdwordMediaData->update($data);
        $googleAdwordMediaDatas = [$googleAdwordMediaData];
        return response()->json([
            'view' => view('CRM.pages.google-adword-media.data', compact(
                'googleAdwordMediaDatas'
            ))->render(),
            'id' => $googleAdwordMediaData->id,
            'type' => 'update'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $googleAdwordMediaData = GoogleAdwordMedia::findOrFail($id);
        $googleAdwordMediaData->delete();
        return response()->json([
            'id' => $id
        ]);
    }
}
