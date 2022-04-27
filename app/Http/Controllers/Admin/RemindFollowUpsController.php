<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Follow;
use App\RemindFollowUps;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RemindFollowUpsController extends Controller
{
    //

    public function getAll()
    {
        $remindsFollowUps = DB::table("remind_follow_ups")
            ->select('users.department', 'users.name', 'users.email', 'users.country', 'users.staff_id', 'users.rating', 'users.status', 'users.type_id', 'follows.process_date', 'remind_follow_ups.time_no_follow_up', 'remind_follow_ups.id')
            ->join("follows", function ($join) {
                $join->on("remind_follow_ups.follow_up_id", "=", "follows.id");
            })
            ->join("users", function ($join) {
                $join->on("follows.user_id", "=", "users.id");
            })
            ->get();
        $total = count($remindsFollowUps);

        $i = 0;
        foreach ($remindsFollowUps as $key) {
            if ($key->time_no_follow_up >= 60) {
                $i++;
            }
        }
        $sos = $i;

        return response()->json([
            'view' => view('CRM.elements.task.remind-follow-ups.data', compact('remindsFollowUps'))->render(),
            'total' => $total,
            'sos' => $sos

        ]);
    }

    public function postFilter(Request $request)
    {
        $remindsFollowUps = DB::table("remind_follow_ups")
            ->select('users.department', 'users.name', 'users.email', 'users.country', 'users.staff_id', 'users.rating', 'users.status', 'users.type_id', 'follows.process_date', 'remind_follow_ups.time_no_follow_up', 'remind_follow_ups.id')
            ->join("follows", function ($join) {
                $join->on("remind_follow_ups.follow_up_id", "=", "follows.id");
            })
            ->join("users", function ($join) {
                $join->on("follows.user_id", "=", "users.id");
            })
            ->when($request->get('branch_remind_follow_ups_filter'), function ($query) use ($request) {
                $query->where("users.department", "=", $request->get('branch_remind_follow_ups_filter'));
            })
            ->when($request->get('agent_remind_follow_ups_filter'), function ($query) use ($request) {
                $query->where("users.name", "LIKE", '%' . $request->get('agent_remind_follow_ups_filter') . '%');
            })
            ->when($request->get('company_email_remind_follow_ups_filter'), function ($query) use ($request) {
                $query->where("users.email", "LIKE", '%' . $request->get('company_email_remind_follow_ups_filter') . '%');
            })
            ->when($request->get('country_remind_follow_ups_filter'), function ($query) use ($request) {
                $query->where("users.country", "LIKE", '%' . $request->get('country_remind_follow_ups_filter') . '%');
            })
            ->when($request->get('pc_remind_follow_ups_filter'), function ($query) use ($request) {
                $query->where("users.staff_id", "=", $request->get('pc_remind_follow_ups_filter'));
            })
            ->when($request->get('rating_remind_follow_ups_filter'), function ($query) use ($request) {
                $query->where("users.rating", "=", $request->get('rating_remind_follow_ups_filter'));
            })
            ->when($request->get('status_remind_follow_ups_filter'), function ($query) use ($request) {
                $query->where("users.status", "=", $request->get('status_remind_follow_ups_filter'));
            })
            ->when($request->get('type_of_agent_remind_follow_ups_filter'), function ($query) use ($request) {
                $query->where("users.type_id", "=", $request->get('type_of_agent_remind_follow_ups_filter'));
            })
            ->when($request->get('time_no_remind_follow_ups_filter'), function ($query) use ($request) {
                $query->where("remind_follow_ups.time_no_follow_up", ">=", (int)$request->get('time_no_remind_follow_ups_filter'));
            })
            ->when($request->get('lastest_date_remind_follow_ups_filter_start') || $request->get('lastest_date_remind_follow_ups_filter_end'), function ($query) use ($request) {
                $query->whereBetween('follows.process_date', [convert_date_to_db($request->get('lastest_date_remind_follow_ups_filter_start')), convert_date_to_db($request->get('lastest_date_remind_follow_ups_filter_end'))]);
            })
            ->get();

        $total = count($remindsFollowUps);

        $i = 0;
        foreach ($remindsFollowUps as $key) {
            if ($key->time_no_follow_up >= 60) {
                $i++;
            }
        }
        $sos = $i;

        return response()->json([
            'view' => view('CRM.elements.task.remind-follow-ups.data', compact('remindsFollowUps'))->render(),
            'total' => $total,
            'sos' => $sos
        ]);
    }
}
