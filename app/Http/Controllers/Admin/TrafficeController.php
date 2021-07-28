<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Traffice;
use App\Http\Requests\TrafficeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrafficeController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->user()->can('traffice.index')) abort(403);
        $flag = 'traffice-lists';
        return view('CRM.pages.traffice.index', compact(
            'flag'
        ));
    }

    public function getData(Request $request)
    {
        if(!$request->user()->can('traffice.index')) abort(403);
        $trafficeDatas = Traffice::when($request->get('start_date'),function($query) use ($request){
            $query->whereDate('start_date',convert_date_to_db($request->get('start_date')));
        })->when($request->get('end_date'),function($query) use ($request){
            $query->whereDate('end_date',convert_date_to_db($request->get('end_date')));
        })->orderBy('id', 'desc')->paginate(15);
        $lastPage = $trafficeDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.traffice.data', compact(
                'trafficeDatas'
            ))->render(),
            'last_page' => $lastPage
        ]);
    }

    public function create(Request $request)
    {
        if(!$request->user()->can('traffice.store')) abort(403);

        $flag = 'traffice-lists';
        return view('CRM.pages.traffice.form', compact(
            'flag'
        ));
    }

    public function store(TrafficeRequest $request)
    {
        if(!$request->user()->can('traffice.store')) abort(403);

        $data = $request->validated();
        $arrDate = [
            'start_date',
            'end_date'
        ];
        foreach($arrDate as $key){
            $data[$key] = !empty($data[$key])?convert_date_to_db($data[$key]):null;
        }
        Traffice::create($data);
        $trafficeDatas = Traffice::orderBy('id', 'desc')->paginate(15);

        $lastPage = $trafficeDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.traffice.data', compact(
                'trafficeDatas'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create'
        ]);
    }

    public function edit(Request $request, $id)
    {
        if(!$request->user()->can('traffice.edit')) abort(403);
        $flag = 'traffice-lists';
        $trafficeData = Traffice::findOrFail($id);
        return view('CRM.pages.traffice.form', compact(
            'flag',
            'trafficeData'
        ));
    }

    public function update(TrafficeRequest $request, $id)
    {
        if(!$request->user()->can('traffice.update')) abort(403);

        $data = $request->validated();
        $arrDate = [
            'start_date',
            'end_date'
        ];
        foreach($arrDate as $key){
            $data[$key] = !empty($data[$key])?convert_date_to_db($data[$key]):null;
        }
        $trafficeData = Traffice::findOrFail($id);
        $trafficeData->update($data);
        $trafficeDatas = [$trafficeData];
        return response()->json([
            'view' => view('CRM.pages.traffice.data', compact(
                'trafficeDatas'
            ))->render(),
            'id' => $trafficeData->id,
            'type' => 'update'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if(!$request->user()->can('traffice.delete')) abort(403);
        $trafficeData = Traffice::findOrFail($id);
        $trafficeData->delete();
        return response()->json([
            'id' => $id
        ]);
    }
}
