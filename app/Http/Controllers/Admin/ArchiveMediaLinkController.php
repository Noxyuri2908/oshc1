<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Admin\SaleTaskAssign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\ArchiveMediaLink;

class ArchiveMediaLinkController extends Controller
{
    //
    public function index()
    {
        $flag = 'archive-media-link';
        return view('CRM.pages.archive-media-link.index', compact(
            'flag'));
    }

    public function getData(Request $request)
    {
        $archiveMediaLinkDatas = ArchiveMediaLink::when($request->get('source_id'), function ($query) use ($request) {
            $query->where('source_id', $request->get('source_id'));
        })->when($request->get('form_id'), function ($query) use ($request) {
            $query->where('form_id', $request->get('form_id'));
        })->when($request->get('country_id'), function ($query) use ($request) {
            $query->where('country_id', $request->get('country_id'));
        })->when($request->get('link'), function ($query) use ($request) {
            $query->where('link', 'LIKE', '%' . $request->get('link') . '%');
        })->when($request->get('type_id'), function ($query) use ($request) {
            $query->where('type_id', $request->get('type_id') );
        })->when($request->get('is_hot_new'), function ($query) use ($request) {
            $query->where('is_hot_new', $request->get('is_hot_new') );
        })->when($request->get('information_focused_id'), function ($query) use ($request) {
            $query->where('information_focused_id', $request->get('information_focused_id') );
        })->when($request->get('note'), function ($query) use ($request) {
            $query->where('note','LIKE','%'. $request->get('note').'%' );
        })->when($request->get('name'), function ($query) use ($request) {
            $query->where('name','LIKE','%'. $request->get('name').'%' );
        })->when($request->get('admin'), function ($query) use ($request) {
            $query->where('admin','LIKE','%'. $request->get('admin').'%' );
        })->when($request->get('email_admin'), function ($query) use ($request) {
            $query->where('email_admin','LIKE','%'. $request->get('email_admin').'%' );
        })->when($request->get('telephone'), function ($query) use ($request) {
            $query->where('telephone','LIKE','%'. $request->get('telephone').'%' );
        })
            ->orderBy('id', 'desc')->paginate(15);
        $lastPage = $archiveMediaLinkDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.archive-media-link.data', compact(
                'archiveMediaLinkDatas'
            ))->render(),
            'last_page' => $lastPage
        ]);
    }

    public function create()
    {
        $flag = 'archive-media-link-store';
        return view('CRM.pages.archive-media-link.form', compact('flag'));
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'category_id',
            'form_id',
            'country_id',
            'source_id',
            'link',
            'type_id',
            'is_hot_new',
            'information_focused_id',
            'note',
            'name',
            'admin',
            'email_admin',
            'telephone'
        ]);
        ArchiveMediaLink::create($data);
        $archiveMediaLinkDatas = ArchiveMediaLink::orderBy('id', 'desc')->paginate(15);
        $lastPage = $archiveMediaLinkDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.archive-media-link.data', compact(
                'archiveMediaLinkDatas'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $flag = 'archive-media-link-edit';
        $archiveMediaLinkData = ArchiveMediaLink::findOrFail($id);
        return view('CRM.pages.archive-media-link.form', compact(
            'flag',
            'archiveMediaLinkData'
        ));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only([
            'category_id',
            'form_id',
            'country_id',
            'source_id',
            'link',
            'type_id',
            'is_hot_new',
            'information_focused_id',
            'note',
            'name',
            'admin',
            'email_admin',
            'telephone'
        ]);
        $archiveMediaLinkData = ArchiveMediaLink::findOrFail($id);
        $archiveMediaLinkData->update($data);
        $archiveMediaLinkDatas = [$archiveMediaLinkData];
        return response()->json([
            'view' => view('CRM.pages.archive-media-link.data', compact(
                'archiveMediaLinkDatas'
            ))->render(),
            'id' => $archiveMediaLinkData->id,
            'type' => 'update'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $archiveMediaLinkData = ArchiveMediaLink::findOrFail($id);
        $archiveMediaLinkData->delete();
        return response()->json([
            'id' => $id
        ]);
    }
}
