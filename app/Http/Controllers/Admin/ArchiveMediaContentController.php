<?php

namespace App\Http\Controllers\Admin;

use App\Admin\ArchiveMediaContent;
use App\Admin\ArchiveMediaLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArchiveMediaContentController extends Controller
{
    //
    public function index()
    {
        $flag = 'archive-media-content';
        return view('CRM.pages.archive-media-content.index', compact(
            'flag'));
    }
    public function getData(Request $request)
    {
        $archiveMediaContentDatas = ArchiveMediaContent::when($request->get('category_id'), function ($query) use ($request) {
            $query->where('category_id', $request->get('category_id'));
        })->when($request->get('note'), function ($query) use ($request) {
            $query->where('note','LIKE','%'. $request->get('note').'%' );
        })->when($request->get('website_id'),function($query) use ($request){
            $query->where('website_id',$request->get('website_id'));
        })->when($request->get('title'), function ($query) use ($request) {
            $query->where('title','LIKE','%'. $request->get('title').'%' );
        })->when($request->get('date'), function ($query) use ($request) {
            $query->whereDate('date',convert_date_to_db($request->get('date')));
        })->when($request->get('status'),function($query) use ($request){
            $query->where('status',$request->get('status'));
        })->when($request->get('created_by'),function($query) use ($request){
            $query->where('created_by',$request->get('created_by'));
        })
            ->orderBy('id', 'desc')->paginate(15);
        $lastPage = $archiveMediaContentDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.archive-media-content.data', compact(
                'archiveMediaContentDatas'
            ))->render(),
            'last_page' => $lastPage
        ]);
    }
    public function create(){
        $flag = 'archive-media-content-create';
        return view('CRM.pages.archive-media-content.form',compact('flag'));
    }
    public function store(Request $request){
        $data = $request->only([
            'category_id',
            'title',
            'content',
            'status',
            'link',
            'date',
            'note',
            'created_by',
            'website_id'
        ]);
        $arrDate = [
            'date'
        ];
        foreach($arrDate as $key){
            $data[$key]=(!empty($data[$key]))?convert_date_to_db($data[$key]):null;
        }
        ArchiveMediaContent::create($data);
        return redirect()->route('archive-media-content.index')->with([
            'success'=>1,
            'store'=>1
        ]);
    }
    public function edit(Request $request,$id){
        $flag = 'archive-media-content-edit';
        $archiveMediaContentData = ArchiveMediaContent::findOrFail($id);
        return view('CRM.pages.archive-media-content.form',compact(
            'flag',
            'archiveMediaContentData'
        ));
    }
    public function update(Request $request,$id){
        $flag = 'archive-media-content-update';
        $data = $request->only([
            'category_id',
            'title',
            'content',
            'status',
            'link',
            'date',
            'note',
            'created_by',
            'website_id'
        ]);
        $arrDate = [
            'date'
        ];
        foreach($arrDate as $key){
            $data[$key]=(!empty($data[$key]))?convert_date_to_db($data[$key]):null;
        }
        $archiveMediaContent = ArchiveMediaContent::findOrFail($id);
        $archiveMediaContent->update($data);
        return redirect()->route('archive-media-content.index')->with([
            'success'=>1,
            'update'=>1
        ]);
    }
    public function destroy(Request $request,$id){
        $archiveMediaContent = ArchiveMediaContent::findOrFail($id);
        $archiveMediaContent->delete();
        return response()->json([
            'id'=>$archiveMediaContent->id,
        ]);
    }
    public function viewContentPost(Request $request,$id){
        $archiveMediaContent = ArchiveMediaContent::findOrFail($id);
        return view('CRM.pages.archive-media-content.modal_view_content_post',compact('archiveMediaContent'));
    }
}
