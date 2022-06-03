<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ITCheckListController extends Controller
{
    public function index(Request $request){
        if(!$request->user()->can('it-checklist.index')) abort(403);
        $flag = 'it-checklist';
        return view('CRM.elements.it-checklist.index',compact('flag'));
    }
}
