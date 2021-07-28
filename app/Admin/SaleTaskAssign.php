<?php

namespace App\Admin;

use App\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SaleTaskAssign extends Model
{
    //
    protected $table = 'sale_task_assigns';
    protected $fillable = [
        'processing_date',
        'item',
        'type',
        'deadline',
        'assigned_by',
        'note',
        'type_table',
        'user_id',
        'person_in_charge',
        'hot_issue',
        'assigned_person',
        'follow_up_status',
        'estimate'
    ];
    public static $TYPE = [
        1 => 'task_asigned_by_company',
//         2 => 'personal_task',
//         3 => 'arised_by_team',
//         4 => 'supporting_marketing_for_agent'
    ];
    public function getType()
    {
        $typeId = $this->type;
        if (!empty($typeId)) {
            return (!empty(config('myconfig.type_sale_task_assign')[$typeId])) ? config('myconfig.type_sale_task_assign')[$typeId] : '';
        }
        return;
    }
    public function getPersonName()
    {
        $person_id = $this->assigned_by;
        if (!empty($person_id)) {
            return (!empty($this->admin))?$this->admin->admin_id:'';
        }
        return '';
    }
    public function admin(){
        return $this->belongsTo(Admin::class,'assigned_by');
    }
    public static function getSaleTaskExport($request){
        $getChildUser = getChildUser('tasksAsigned');
        $typeTableId = 1;
        $dataSaleTaskAssign = SaleTaskAssign::when($request->get('processing_date_sale_task_assign_start') && $request->get('processing_date_sale_task_assign_end'), function ($query) use ($request) {
            $query->whereBetween('processing_date', [convert_date_to_db($request->get('processing_date_sale_task_assign_start')), convert_date_to_db($request->get('processing_date_sale_task_assign_end'))]);
        })->when($request->get('report_start_date') && $request->get('report_end_date'), function ($query) use ($request) {
            $query->whereBetween('processing_date', [convert_date_to_db($request->get('report_start_date')), convert_date_to_db($request->get('report_end_date'))]);
        })->when($request->get('deadline_sale_task_assign_start') && $request->get('deadline_sale_task_assign_end'), function ($query) use ($request) {
        $query->whereBetween('deadline', [convert_date_to_db($request->get('deadline_sale_task_assign_start')), convert_date_to_db($request->get('deadline_sale_task_assign_end'))]);
        })->when(($request->get('type_sale_task_assign_filter')), function ($query) use ($request) {
            $query->where('type', $request->get('type_sale_task_assign_filter'));
        })->when(($request->get('asigned_sale_task_assign_filter')), function ($query) use ($request) {
            $query->where('assigned_by', $request->get('asigned_sale_task_assign_filter'));
        })
            ->with(['admin'])
            ->where('type_table', $typeTableId)
            ->orderBy('id', 'desc');
        if($getChildUser['permissionSee']->contains(3)){
            $dataSaleTaskAssign->where('assigned_by',$getChildUser['admin']->id);
        }elseif($getChildUser['permissionSee']->contains(2)){
            $dataSaleTaskAssign->whereIn('assigned_by',$getChildUser['getAllAdminDepartment']);
        }
        return $dataSaleTaskAssign;
    }
}
