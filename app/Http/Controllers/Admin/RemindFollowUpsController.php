<?php

namespace App\Http\Controllers\Admin;

use App\RemindFollowUps;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RemindFollowUpsController extends Controller
{
    //

    public function getAll()
    {
        $remindsFollowUps = RemindFollowUps::select('remind_follow_ups.follow_up_id', 'remind_follow_ups.time_no_follow_up')
            ->with('follows')
            ->get();
        return response()->json([
            'view' => view('CRM.elements.task.remind-follow-ups.data', compact('remindsFollowUps'))->render()
        ]);
    }
}
