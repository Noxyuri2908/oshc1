<?php

namespace App\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Follow extends Model
{
    protected $fillable = [
        'user_id',
        'process_date',
        'status',
        'rating',
        'contact_by',
        'des',
        'person_in_charge',
        'type',
        'potential_service',
        'condition_follow',
        'create_person',
        'assigned_person',
        'follow_up_status',
        'hot_issue',
        'due_date',
        'estimate',
        'title_task',
        'task_description',
    ];

    protected $casts = [
        'contact_by' => 'array',
    ];

    public function commentsTask()
    {
        return $this->hasMany(CommentsTask::class);
    }

    public static function getDataExportExcel($request)
    {
        $getChildUser = getChildUser('followUp');
        $potential_service_follow_ups_filter = (!empty($request->get('potential_service_follow_ups_filter'))) ? json_decode($request->get('potential_service_follow_ups_filter')) : [];
        $arrayPotential = collect($potential_service_follow_ups_filter)->pluck('id')->toArray();
        $followUps = static::when($request->get('agent_follow_ups_filter'), function ($query) use ($request) {
            $query->whereHas('agent', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->get('agent_follow_ups_filter').'%');
            });
        })
            ->when(($request->get('processing_date_follow_ups_start') && $request->get('processing_date_follow_ups_end')), function ($query) use ($request) {
                $query->whereBetween('process_date', [
                    convert_date_to_db($request->get('processing_date_follow_ups_start')),
                    convert_date_to_db($request->get('processing_date_follow_ups_end')),
                ]);
            })
            ->when(($request->get('report_start_date') && $request->get('report_end_date')), function ($query) use ($request) {
                $query->whereBetween('process_date', [
                    convert_date_to_db($request->get('report_start_date')),
                    convert_date_to_db($request->get('report_end_date')),
                ]);
            })
            ->when($request->get('status_follow_ups_filter'), function ($query) use ($request) {
                $query->where('status', $request->get('status_follow_ups_filter'));
            })
            ->when($request->get('rating_follow_ups_filter'), function ($query) use ($request) {
                $query->where('rating', 'LIKE', '%'.$request->get('rating_follow_ups_filter').'%');
            })
            ->when($request->get('contact_by_follow_ups_filter'), function ($query) use ($request) {
                $query->where('contact_by', $request->get('contact_by_follow_ups_filter'));
            })
            ->when($request->get('person_in_charge_follow_ups_filter'), function ($query) use ($request) {
                $query->where('person_in_charge', 'LIKE', '%'.$request->get('person_in_charge_follow_ups_filter').'%');
            })
            ->when($request->get('potential_service_follow_ups_filter') && $request->get('potential_service_follow_ups_filter') != '[]' && $request->get('potential_service_follow_ups_filter') != 'null', function ($query) use ($request, $arrayPotential, $potential_service_follow_ups_filter) {
                $query->whereJsonContains('potential_service', $potential_service_follow_ups_filter);
            })
            ->when($request->get('filter_date_option'), function ($query) use ($request) {
                if ($request->get('filter_date_option') == 'week') {
                    $query->whereBetween('process_date', [
                        Carbon::now()->startOfWeek()->format('Y-m-d'),
                        Carbon::now()->format('Y-m-d'),
                    ]);
                } else {
                    if ($request->get('filter_date_option') == 'month') {
                        $query->whereBetween('process_date', [
                            Carbon::now()->startOfMonth()->format('Y-m-d'),
                            Carbon::now()->format('Y-m-d'),
                        ]);
                    } else {
                        if ($request->get('filter_date_option') == 'year') {
                            $query->whereBetween('process_date', [
                                Carbon::now()->startOfYear()->format('Y-m-d'),
                                Carbon::now()->format('Y-m-d'),
                            ]);
                        }
                    }
                }
            })
            ->with(['agent', 'staff'])
            ->orderBy('process_date', 'desc');
        if($getChildUser['permissionSee']->contains(3)){
            $followUps->where('person_in_charge',$getChildUser['admin']->id);
        }elseif($getChildUser['permissionSee']->contains(2)){
            $followUps->whereIn('person_in_charge',$getChildUser['getAllAdminDepartment']);
        }
        return $followUps->get();
    }

    public static function getFollowUpSale($request)
    {
        $startDate = (!empty($request->report_start_date)) ? convert_date_to_db($request->report_start_date) : date('Y-01-01');
        $endDate = (!empty($request->report_end_date)) ? convert_date_to_db($request->report_end_date).' 23:59:59' : date('Y-m-d 23:59:59');
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
        $potential_service_follow_ups_filter = (!empty($request->get('potential_service_follow_ups_filter'))) ? json_decode($request->get('potential_service_follow_ups_filter')) : [];
        $arrayPotential = collect($potential_service_follow_ups_filter)->pluck('id')->toArray();
        $followUps = static::when($request->get('agent_follow_ups_filter'), function ($query) use ($request) {
            $query->whereHas('agent', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->get('agent_follow_ups_filter').'%');
            });
        })
            ->when($startDate && $endDate, function ($query) use ($request, $startDate, $endDate) {
                $query->whereBetween('process_date', [$startDate, $endDate]);
            })
            ->when($request->get('status_follow_ups_filter'), function ($query) use ($request) {
                $query->where('status', $request->get('status_follow_ups_filter'));
            })
            ->when($request->get('rating_follow_ups_filter'), function ($query) use ($request) {
                $query->where('rating', 'LIKE', '%'.$request->get('rating_follow_ups_filter').'%');
            })
            ->when($request->get('contact_by_follow_ups_filter'), function ($query) use ($request) {
                $query->where('contact_by', $request->get('contact_by_follow_ups_filter'));
            })
            ->when($request->get('person_in_charge_follow_ups_filter'), function ($query) use ($request) {
                $query->where('person_in_charge', 'LIKE', '%'.$request->get('person_in_charge_follow_ups_filter').'%');
            })
            ->when($request->get('potential_service_follow_ups_filter') && $request->get('potential_service_follow_ups_filter') != '[]', function ($query) use ($request, $arrayPotential, $potential_service_follow_ups_filter) {
                $query->whereJsonContains('potential_service', $potential_service_follow_ups_filter);
            })
            ->when($request->get('filter_date_option'), function ($query) use ($request) {
                if ($request->get('filter_date_option') == 'week') {
                    $query->whereBetween('process_date', [
                        Carbon::now()->startOfWeek()->format('Y-m-d'),
                        Carbon::now()->format('Y-m-d'),
                    ]);
                } else {
                    if ($request->get('filter_date_option') == 'month') {
                        $query->whereBetween('process_date', [
                            Carbon::now()->startOfMonth()->format('Y-m-d'),
                            Carbon::now()->format('Y-m-d'),
                        ]);
                    } else {
                        if ($request->get('filter_date_option') == 'year') {
                            $query->whereBetween('process_date', [
                                Carbon::now()->startOfYear()->format('Y-m-d'),
                                Carbon::now()->format('Y-m-d'),
                            ]);
                        }
                    }
                }
            })
            ->with('agent')
            ->orderBy('process_date', 'desc');
        return $followUps;
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Admin', 'person_in_charge');
    }

    public function getAgentName()
    {
        $user_id = $this->user_id;
        if (!empty($user_id)) {
            return (!empty($this->agent)) ? $this->agent->name : '';
        } else {
            return '';
        }
    }

    public function getStatus()
    {
        $status_id = $this->status;
        if (!empty($status_id)) {
            return (!empty(config('admin.status')[$status_id])) ? config('admin.status')[$status_id] : '';
        }
        return '';
    }

    public function getContact()
    {
        //$contact_id = $this->contact_by;
        //if (!empty($contact_id)) {
        //    return (!empty(config('myconfig.contact_by')[$contact_id])) ? config('myconfig.contact_by')[$contact_id] : '';
        //}
        //return '';
        $arrValue = [];
        $contact_id = $this->contact_by;
        if (!empty($contact_id) && is_array($contact_id)) {
            foreach (config('myconfig.contact_by') as $key => $value) {
                if (in_array($key, $contact_id)) {
                    $arrValue[] = $value;
                }
            }
        }
        return collect($arrValue)->implode(',');
    }

    public function getPersonName()
    {
        $person_id = $this->person_in_charge;
        if (!empty($person_id)) {
            return (!empty($this->staff)) ? $this->staff->username : '';
        }
        return '';
    }

    public function getPotentialService($dichvu)
    {
        if (!empty($this->agent)) {
            $potential_service = $this->agent->potential_service;
            if (!empty($potential_service)) {
                if (is_array($potential_service)) {
                    $dichvus = $dichvu->whereIn('id', $potential_service)->pluck('name');
                    $nameService = '';
                    foreach ($dichvus as $key => $dichvu) {
                        $nameService .= $dichvu.(($key + 1 == count($dichvus)) ? '.' : ', ');
                    }
                    return $nameService;
                } else {
                    $dichvus = $dichvu->where('id', $potential_service)->first();
                    return $dichvus->name;
                }
            }
        } else {
            return '';
        }
    }

}
