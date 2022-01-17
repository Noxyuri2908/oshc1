<?php

namespace App\Http\Controllers\Admin;

use App\Admin\CheckList;
use App\Admin\CheckListSetting;
use App\Admin\Tailieu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use function foo\func;

class CheckListController extends Controller
{
    //
    public function getData(Request $request)
    {
        if (!$request->user()->can('check-list.index')) {
            abort(403);
        }
        $person_id = $request->get('person_id');
        $group_id = $request->get('group_id');
        $checkListDatas = CheckList::when($request->get('website_id'), function ($query) use ($request) {
            $query->where('website_id', $request->get('website_id'));
        })->when($request->get('category_id'), function ($query) use ($request) {
            $query->where('category_id', $request->get('category_id'));
        })->when($request->get('person_id') && $request->get('person_id') != [], function ($query) use ($request, $person_id) {
            $query->whereJsonContains('person_id', $person_id)
                    ->orWhereRaw('CAST(person_id AS signed) = "'.$request->get('person_id')[0].'"');
        })->when($request->get('problem'), function ($query) use ($request) {
            $query->where('problem', 'LIKE', '%'.$request->get('problem').'%');
        })->when($request->get('date_of_suggestion'), function ($query) use ($request) {
            $query->whereDate('date_of_suggestion', convert_date_to_db($request->get('date_of_suggestion')));
        })->when($request->get('detail'), function ($query) use ($request) {
            $query->where('detail', 'LIKE', '%'.$request->get('detail').'%');
        })->when($request->get('solution_text'), function ($query) use ($request) {
            $query->where('solution_text', 'LIKE', '%'.$request->get('solution_text').'%');
        })->when($request->get('result_id'), function ($query) use ($request) {
            $query->where('result_id', $request->get('result_id'));
        })->when($request->get('processing_time'), function ($query) use ($request) {
            $query->whereDate('processing_time', convert_date_to_db($request->get('processing_time')));
        })->when($request->get('budget'), function ($query) use ($request) {
            $query->where('budget', 'LIKE', '%'.$request->get('budget').'%');
        })->when($request->get('checklist_created_at'), function ($query) use ($request) {
            $query->whereDate('checklist_created_at', convert_date_to_db($request->get('checklist_created_at')));
        })->when($request->get('type_id'), function ($query) use ($request) {
            $query->where('type_id', $request->get('type_id'));
        })
            ->where('group_id', $group_id)
            ->orderByRaw("FIELD(result_id,1) desc")
            ->paginate(10);
        $lastPage = $checkListDatas->lastPage();
        $type = $request->get('type');
        if ($type == 'checklist') {
            return response()->json([
                'view' => view('CRM.elements.task.checklist-and-task.checklist.data', compact(
                    'checkListDatas',
                    'type'
                ))->render(),
                'last_page' => $lastPage,
                'type' => $type,
            ]);
        } else {
            if ($type == 'task') {
                return response()->json([
                    'view' => view('CRM.elements.task.checklist-and-task.task.data', compact(
                        'checkListDatas',
                        'type'
                    ))->render(),
                    'last_page' => $lastPage,
                    'type' => $type,
                ]);
            }
        }
    }

    public function create(Request $request)
    {
        if (!$request->user()->can('check-list.store')) {
            abort(403);
        }
        $flag = 'check-list-create';
        $groupId = $request->get('groupId');
        $type = $request->get('type');
        return view('CRM.elements.task.checklist-and-task.checklist.form', compact(
            'flag',
            'groupId',
            'type'
        ));
    }

    public function store(Request $request)
    {
        if (!$request->user()->can('check-list.store')) {
            abort(403);
        }
        $data = $request->only([
            'group_id',
            'website_id',
            'category_id',
            'person_id',
            'problem',
            'date_of_suggestion',
            'detail',
            'solution_text',
            'level_of_process',
            'result_id',
            'processing_time',
            'budget',
            'checklist_created_at',
            'assigned_by',
            'type_id',
            'proposer',
            'file'
        ]);

        $file = (!empty($data['file'])) ? $data['file'] : null;

        $arrDate = [
            'date_of_suggestion',
            'processing_time',
            'checklist_created_at',
        ];
        foreach ($arrDate as $key) {
            $data[$key] = (!empty($data[$key])) ? convert_date_to_db($data[$key]) : null;
        }

        if(!empty($file)){
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $name = $fileName.'-'.time() . str_random(5) .'.' . $file->getClientOriginalExtension();
            $file->move('tailieus', $name);
            $data['file'] = $name;
        }

        $data['proposer'] = (int)$data['proposer'];

        $group_id = $request->get('group_id');
        CheckList::create($data);

        $checkListDatas = CheckList::where('group_id', $group_id)->orderBy('id', 'DESC')->orderByRaw("FIELD(result_id,1) desc")->paginate(10);
        $lastPage = $checkListDatas->lastPage();
        $type = $request->get('type');
        return response()->json([
            'view_checklist' => view('CRM.elements.task.checklist-and-task.checklist.data', compact(
                'checkListDatas',
                'type'
            ))->render(),
            'view_task' => view('CRM.elements.task.checklist-and-task.task.data', compact(
                'checkListDatas',
                'type'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create',
        ]);
    }

    public function edit(Request $request, $id)
    {
        if (!$request->user()->can('check-list.edit')) {
            abort(403);
        }
        $flag = 'check-list-edit';
        $checkListData = CheckList::findOrFail($id);
        $groupId = $checkListData->group_id;
        $type = $request->get('type');
        return view('CRM.elements.task.checklist-and-task.checklist.form', compact(
            'flag',
            'checkListData',
            'groupId',
            'type'
        ));
    }

    public function update(Request $request, $id)
    {
        if (!$request->user()->can('check-list.update')) {
            abort(403);
        }
        $type = $request->get('type');
        $data = $request->only([
            'group_id',
            'website_id',
            'category_id',
            'person_id',
            'problem',
            'date_of_suggestion',
            'detail',
            'solution_text',
            'level_of_process',
            'result_id',
            'processing_time',
            'budget',
            'checklist_created_at',
            'assigned_by',
            'type_id',
        ]);
        $arrDate = [
            'date_of_suggestion',
            'processing_time',
            'checklist_created_at',
        ];
        foreach ($arrDate as $key) {
            $data[$key] = (!empty($data[$key])) ? convert_date_to_db($data[$key]) : null;
        }
        if ($type == 'task' && $data['processing_time'] == null) {
            unset($data['processing_time']);
        }
        $group_id = $request->get('group_id');
        $checkListData = CheckList::findOrFail($id);
        $checkListData->update($data);
        $checkListDatas = [$checkListData];

        return response()->json([
            'view_checklist' => view('CRM.elements.task.checklist-and-task.checklist.data', compact(
                'checkListDatas'
            ))->with(['type' => 'checklist'])->render(),
            'view_task' => view('CRM.elements.task.checklist-and-task.task.data', compact(
                'checkListDatas',
                'type'
            ))->with(['type' => 'task'])->render(),
            'id' => $checkListData->id,
            'type' => 'update',
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if (!$request->user()->can('check-list.delete')) {
            abort(403);
        }
        $checkListData = CheckList::findOrFail($id);
        $checkListData->delete();
        return response()->json([
            'id' => $id,
        ]);
    }

    public function getValueByType(Request $request)
    {
        $type = $request->get('type');
        $checklistSetting = CheckListSetting::with('children')->find($type);
        if(!empty($checklistSetting)){
            $options = $checklistSetting->children;
        }else{
            $options = [];
        }
        return view('CRM.elements.task.checklist-and-task.task.choose_option', compact('options'));
    }
}
