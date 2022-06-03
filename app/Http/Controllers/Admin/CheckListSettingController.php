<?php

namespace App\Http\Controllers\Admin;

use App\Admin\CheckListSetting;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckListSettingStoreRequest;
use Illuminate\Http\Request;

class CheckListSettingController extends Controller
{
    //
    public function index(){
        $flag='checklist_setting';
        $settingStatuses = $this->getTreeNodeList();
        $settings = $this->getTreeNodeSetting();
        return view('CRM.pages.checklist-setting.index',compact(
            'flag',
            'settingStatuses',
            'settings'
        ));
    }
    public function create(Request $request){
        $typeCreate = $request->get('type');
        $settings = $this->getTreeNodeSetting();
        return view('CRM.pages.checklist-setting.form',compact('typeCreate','settings'));
    }
    public function store(CheckListSettingStoreRequest $request){
        $data = $request->validated();
        $setting = CheckListSetting::create($data);
        $settingStatuses = $this->getTreeNodeList();
        return view('CRM.pages.checklist-setting.data', compact('settingStatuses'));
    }
    public function edit(Request $request,$id){
        $setting = CheckListSetting::findOrFail($id);
        $settings = $this->getTreeNodeSetting();
        return view('CRM.pages.checklist-setting.form', compact(
            'setting',
            'settings'
        ));
    }
    public function update(Request $request,$id){
        $setting = CheckListSetting::findOrFail($id);
        $setting->update($request->only(['name','parent_id','same_department']));
        $settingStatuses = $this->getTreeNodeList();
        return view('CRM.pages.checklist-setting.data', compact('settingStatuses'));
    }
    public function destroy(Request $request,$id){
        $setting = CheckListSetting::findOrFail($id);
        $setting->delete();
        return response()->json(['success'=>1]);
    }
    public function getTreeNodeSetting(){
        $settingTree = CheckListSetting::with(implode('.', array_fill(0, 2, 'children')))->whereNull('parent_id')->get();
        $traverse = function ($settings, $prefix = '') use (&$traverse) {
            $result = [];
            foreach ($settings as $setting) {
                $result[] = [
                    'id' => $setting->id,
                    'name' => $prefix.' '.$setting->name
                ];
                $result = array_merge($result, $traverse($setting->children, $prefix.'-'));
            }
            return $result;
        };

        $settings = $traverse($settingTree);
        return $settings;
    }
    public function getTreeNodeList(){
        $settingStatuses = CheckListSetting::with(implode('.', array_fill(0, 10, 'children')))
            ->whereNull('parent_id')
            ->get()
            ->groupBy('type');
        return $settingStatuses;
    }
    public function getSetting(){
        $settings = $this->getTreeNodeSetting();
        return view('CRM.pages.checklist-setting.form',compact('settings'));
    }

}
