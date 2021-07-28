<?php

namespace App\Http\Controllers\Admin;

use App\Admin\QueueErrorLogs;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QueueErrorLogController extends Controller
{
    //
    public function index($model){
        $flag = 'queue-error-log';
        return view('CRM.pages.queue-error-log.index',compact('flag','model'));
    }
    public function getData(Request $request,$model){
        $logs = QueueErrorLogs::where('model',$model)->orderBy('id','desc')->paginate(50);
        $lastPage = $logs->lastPage();
        $totalRow = $logs->total();
        return response()->json([
            'view' => view('CRM.pages.queue-error-log.data', compact('logs'))->render(),
            'last_page' => $lastPage
        ]);
    }
}
