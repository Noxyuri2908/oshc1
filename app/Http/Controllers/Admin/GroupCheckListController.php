<?php

namespace App\Http\Controllers\Admin;

use App\Admin\ArchiveMediaLink;
use App\Admin\CheckListGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GroupCheckListController extends Controller
{
    //
    public function index(Request $request)
    {
        if(!$request->user()->can('check-list-group.index')) abort(403);
        $flag = 'check-list-group';
        return view('CRM.pages.checklist-group.index', compact(
            'flag'));
    }
    public function getData(Request $request)
    {
        if(!$request->user()->can('check-list-group.index')) abort(403);
        $groupDatas = CheckListGroup::orderBy('id', 'desc')->paginate(10);
        $lastPage = $groupDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.checklist-group.data', compact(
                'groupDatas'
            ))->render(),
            'last_page' => $lastPage
        ]);
    }
    public function create(Request $request)
    {
        if(!$request->user()->can('check-list-group.store')) abort(403);
        $flag = 'check-list-group-store';
        return view('CRM.pages.checklist-group.form', compact('flag'));
    }
    public function store(Request $request)
    {
        if(!$request->user()->can('check-list-group.store')) abort(403);
        $data = $request->only([
            'group_name',
        ]);
        $created_id = Auth::user()->id;
        $data['created_by']=$created_id;
        CheckListGroup::create($data);
        $groupDatas = CheckListGroup::orderBy('id', 'desc')->paginate(10);
        $lastPage = $groupDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.checklist-group.data', compact(
                'groupDatas'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create'
        ]);
    }
    public function edit(Request $request, $id)
    {
        if(!$request->user()->can('check-list-group.edit')) abort(403);
        $flag = 'check-list-group-edit';
        $groupData = CheckListGroup::findOrFail($id);
        return view('CRM.pages.checklist-group.form', compact(
            'flag',
            'groupData'
        ));
    }
    public function update(Request $request, $id)
    {
        if(!$request->user()->can('check-list-group.update')) abort(403);
        $data = $request->only([
            'group_name',
        ]);
        $groupData = CheckListGroup::findOrFail($id);
        $groupData->update($data);
        $groupDatas = [$groupData];
        return response()->json([
            'view' => view('CRM.pages.checklist-group.data', compact(
                'groupDatas'
            ))->render(),
            'id' => $groupData->id,
            'type' => 'update'
        ]);
    }
    public function destroy(Request $request, $id)
    {
        if(!$request->user()->can('check-list-group.delete')) abort(403);
        $groupData = CheckListGroup::findOrFail($id);
        $groupData->delete();
        return response()->json([
            'id' => $id
        ]);
    }
    public function getGroup(Request $request,$type){
        $user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $groups = \App\Admin\CheckListGroup::with(['checkLists'])->where('created_by',$user_id)->orderBy('id','desc')->get()->map(function($process){
            $process->countProcessingg = $process->checkLists->where('result_id',1)->count();
            return $process;
        });
        return response()->json([
            'view'=>view('CRM.elements.task.checklist-and-task.checklist.tab-list',compact('groups'),['type'=>$type])->render(),
            'first_group'=>$groups->first()->id
        ]);
    }
}
