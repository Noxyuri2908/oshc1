<?php

namespace App\Http\Controllers\Admin;

use App\Admin\TaskMediaStatus;
use App\Http\Requests\TaskMediaStatusStoreRequest;
use App\Http\Requests\TaskMediaStatusUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskMediaStatusController extends Controller
{
    //
    public function index(Request $request){
        $flag = 'task-media-setting';
        return view('CRM.pages.task-media-setting.index',compact('flag'));
    }

    public function getData(Request $request)
    {
        $mediaSettingDatas = TaskMediaStatus::when($request->get('type'),function($query) use ($request){
            $query->where('type',$request->get('type'));
        })->when($request->get('name'),function($query) use ($request){
            $query->where('name','LIKE','%'.$request->get('name').'%');
        })->when($request->get('category'),function($query) use ($request){
            $query->where('category','LIKE','%'.$request->get('category').'%');
        })->orderBy('id', 'desc')->paginate(20);
        $lastPage = $mediaSettingDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.task-media-setting.data', compact(
                'mediaSettingDatas'
            ))->render(),
            'last_page' => $lastPage
        ]);
    }

    public function create()
    {
        $flag = 'task-media-setting';
        return view('CRM.pages.task-media-setting.form', compact('flag'));
    }

    public function store(TaskMediaStatusStoreRequest $request)
    {
        $data = $request->validated();
        TaskMediaStatus::create($data);
        $mediaSettingDatas = TaskMediaStatus::orderBy('id', 'desc')->paginate(15);
        $lastPage = $mediaSettingDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.task-media-setting.data', compact(
                'mediaSettingDatas'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $flag = 'task-media-setting-edit';
        $mediaSettingData = TaskMediaStatus::findOrFail($id);
        return view('CRM.pages.task-media-setting.form', compact(
            'flag',
            'mediaSettingData'
        ));
    }

    public function update(TaskMediaStatusUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $mediaSettingData = TaskMediaStatus::findOrFail($id);
        $mediaSettingData->update($data);
        $mediaSettingDatas = [$mediaSettingData];
        return response()->json([
            'view' => view('CRM.pages.task-media-setting.data', compact(
                'mediaSettingDatas'
            ))->render(),
            'id' => $mediaSettingData->id,
            'type' => 'update'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $TaskMediaStatusData = TaskMediaStatus::findOrFail($id);
        $TaskMediaStatusData->delete();
        return response()->json([
            'id' => $id
        ]);
    }
}
