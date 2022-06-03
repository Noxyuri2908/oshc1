<?php

namespace App\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Trainings extends Model
{
    //
    protected $table = 'trainings';
    protected $fillable = [
        'processing_date',
        'item',
        'type',
        'deadline',
        'result',
        'note'
    ];
    public function getType()
    {
        $type_id = $this->type;
        if (!empty($type_id)) {
            return (!empty(config('myconfig.type_training_task_sale')[$type_id])) ? config('myconfig.type_training_task_sale')[$type_id] : '';
        }
        return '';
    }
    public function getResult()
    {
        $result_id = $this->result;
        if (!empty($result_id)) {
            return (!empty(config('myconfig.result_training_task_sale')[$result_id])) ? config('myconfig.result_training_task_sale')[$result_id] : '';
        }
        return '';
    }
    public static function getSaleTaskExport($request){

        $startDate = (!empty($request->deadline_training_start)) ? convert_date_to_db($request->deadline_training_start) : date('Y-01-01');
        $endDate = (!empty($request->deadline_training_end)) ? convert_date_to_db($request->deadline_training_end) . ' 23:59:59' : date('Y-m-d 23:59:59');
        if (!empty($request->get('filter_date_option'))) {
            if ($request->get('filter_date_option') == 'week') {
                $startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
            } elseif ($request->get('filter_date_option') == 'month') {
                $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            } elseif ($request->get('filter_date_option') == 'year') {
                $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
            }
            $endDate = date('Y-m-d 23:59:59');
        }
        $trainings = Trainings::when($request->get('processing_date_training_start') && $request->get('processing_date_training_end'), function ($query) use ($request) {
            $query->whereBetween('processing_date', [convert_date_to_db($request->get('processing_date_training_start')), convert_date_to_db($request->get('processing_date_training_end'))]);
        })->when($startDate && $endDate, function ($query) use ($request,$startDate,$endDate) {
            $query->whereBetween('deadline', [$startDate, $endDate]);
        })->when(($request->get('type_training_filter')), function ($query) use ($request) {
            $query->where('type', $request->get('type_training_filter'));
        })->when(($request->get('result_training_filter')), function ($query) use ($request) {
            $query->where('result', $request->get('result_training_filter'));
        })->when(($request->get('item_training_filter')), function ($query) use ($request) {
            $query->where('item', 'LIKE', '%' . $request->get('item_training_filter') . '%');
        })
            ->orderBy('id', 'desc');
        return $trainings;
    }
}
