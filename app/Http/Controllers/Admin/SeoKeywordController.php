<?php

namespace App\Http\Controllers\Admin;

use App\Admin\SeoKeyword;
use App\Http\Requests\SeoKeywordListRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeoKeywordController extends Controller
{
    //
    public function index(Request $request){
        if(!$request->user()->can('seo-keyword.index')) abort(403);
        $flag= 'seo-keyword-lists';
        return view('CRM.pages.seo-keyword.index',compact('flag'));
    }
    public function getData(Request $request)
    {
        if(!$request->user()->can('seo-keyword.index')) abort(403);
        $seoKeywordDatas = SeoKeyword::when($request->get('destination_target'),function($query) use ($request){
            $query->where('destination_target','LIKE','%'.$request->get('destination_target').'%');
        })->when($request->get('keyword'),function($query) use ($request){
            $query->where('keyword','LIKE','%'.$request->get('keyword').'%');
        })->when($request->get('relevant_info'),function($query) use ($request){
            $query->where('relevant_info','LIKE','%'.$request->get('relevant_info').'%');
        })->when($request->get('gg_ad'),function($query) use ($request){
            $query->where('gg_ad','LIKE','%'.$request->get('gg_ad').'%');
        })->when($request->get('link'),function($query) use ($request){
            $query->where('link','LIKE','%'.$request->get('link').'%');
        })->when($request->get('title'),function($query) use ($request){
            $query->where('title','LIKE','%'.$request->get('title').'%');
        })->when($request->get('description'),function($query) use ($request){
            $query->where('description','LIKE','%'.$request->get('description').'%');
        })->orderBy('id', 'desc')->paginate(15);
        $lastPage = $seoKeywordDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.seo-keyword.data', compact(
                'seoKeywordDatas'
            ))->render(),
            'last_page' => $lastPage
        ]);
    }

    public function create(Request $request)
    {
        if(!$request->user()->can('seo-keyword.store')) abort(403);
        $flag = 'seo-keyword-store';
        return view('CRM.pages.seo-keyword.form', compact('flag'));
    }

    public function store(SeoKeywordListRequest $request)
    {
        if(!$request->user()->can('seo-keyword.store')) abort(403);
        $data = $request->validated();
        $arrDate = [
            'expiry_date'
        ];
        foreach($arrDate as $date){
            $data[$date] = !empty($data[$date])?convert_date_to_db($data[$date]):null;
        }
        SeoKeyword::create($data);
        $seoKeywordDatas = SeoKeyword::orderBy('id', 'desc')->paginate(15);
        $lastPage = $seoKeywordDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.seo-keyword.data', compact(
                'seoKeywordDatas'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create'
        ]);
    }

    public function edit(Request $request, $id)
    {
        if(!$request->user()->can('seo-keyword.edit')) abort(403);
        $flag = 'seo-keyword-edit';
        $seoKeywordData = SeoKeyword::findOrFail($id);
        return view('CRM.pages.seo-keyword.form', compact(
            'flag',
            'seoKeywordData'
        ));
    }

    public function update(SeoKeywordListRequest $request, $id)
    {
        if(!$request->user()->can('seo-keyword.update')) abort(403);
        $data = $request->validated();
        $arrDate = [
            'expiry_date'
        ];
        foreach($arrDate as $date){
            $data[$date] = !empty($data[$date])?convert_date_to_db($data[$date]):null;
        }
        $seoKeywordData = SeoKeyword::findOrFail($id);
        $seoKeywordData->update($data);
        $seoKeywordDatas = [$seoKeywordData];
        return response()->json([
            'view' => view('CRM.pages.seo-keyword.data', compact(
                'seoKeywordDatas'
            ))->render(),
            'id' => $seoKeywordData->id,
            'type' => 'update'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if(!$request->user()->can('seo-keyword.delete')) abort(403);
        $seoKeywordData = SeoKeyword::findOrFail($id);
        $seoKeywordData->delete();
        return response()->json([
            'id' => $id
        ]);
    }
}
