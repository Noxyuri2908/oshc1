<?php

namespace App\Http\Controllers\Admin;

use App\Admin\MailSkypeList;
use App\Http\Requests\MailSkypeListRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailSkypeListController extends Controller
{
    public function index(Request $request){
        if(!$request->user()->can('email-skype-manager.index')) abort(403);
        $flag= 'mail-skype-lists';
        return view('CRM.pages.mail-skype-list.index',compact('flag'));
    }
    public function getData(Request $request)
    {
        if(!$request->user()->can('email-skype-manager.index')) abort(403);
        $mailSkypeDatas = MailSkypeList::when($request->get('domain_id'),function ($query) use ($request){
            $query->where('domain_id',$request->get('domain_id'));
        })->when($request->get('email'),function ($query) use ($request){
            $query->where('email','LIKE','%'.$request->get('email').'%');
        })->when($request->get('person_in_charge'),function ($query) use ($request){
            $query->where('person_in_charge',$request->get('person_in_charge'));
        })->when($request->get('password'),function ($query) use ($request){
            $query->where('password','LIKE','%'.$request->get('password').'%');
        })->when($request->get('skype'),function ($query) use ($request){
            $query->where('skype','LIKE','%'.$request->get('skype').'%');
        })->when($request->get('crm'),function ($query) use ($request){
            $query->where('crm','LIKE','%'.$request->get('crm').'%');
        })->when($request->get('dropbox'),function ($query) use ($request){
            $query->where('dropbox','LIKE','%'.$request->get('dropbox').'%');
        })->orderBy('id', 'desc')->paginate(15);
        $lastPage = $mailSkypeDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.mail-skype-list.data', compact(
                'mailSkypeDatas'
            ))->render(),
            'last_page' => $lastPage
        ]);
    }

    public function create(Request $request)
    {
        if(!$request->user()->can('email-skype-manager.store')) abort(403);
        $flag = 'mail-skype-list-store';
        return view('CRM.pages.mail-skype-list.form', compact('flag'));
    }

    public function store(MailSkypeListRequest $request)
    {
        if(!$request->user()->can('email-skype-manager.store')) abort(403);
        $data = $request->validated();
        MailSkypeList::create($data);
        $mailSkypeDatas = MailSkypeList::orderBy('id', 'desc')->paginate(15);
        $lastPage = $mailSkypeDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.mail-skype-list.data', compact(
                'mailSkypeDatas'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create'
        ]);
    }

    public function edit(Request $request, $id)
    {
        if(!$request->user()->can('email-skype-manager.edit')) abort(403);
        $flag = 'mail-skype-list-edit';
        $mailSkypeData = MailSkypeList::findOrFail($id);
        return view('CRM.pages.mail-skype-list.form', compact(
            'flag',
            'mailSkypeData'
        ));
    }

    public function update(MailSkypeListRequest $request, $id)
    {
        if(!$request->user()->can('email-skype-manager.update')) abort(403);
        $data = $request->validated();
        $mailSkypeData = MailSkypeList::findOrFail($id);
        $mailSkypeData->update($data);
        $mailSkypeDatas = [$mailSkypeData];
        return response()->json([
            'view' => view('CRM.pages.mail-skype-list.data', compact(
                'mailSkypeDatas'
            ))->render(),
            'id' => $mailSkypeData->id,
            'type' => 'update'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if(!$request->user()->can('email-skype-manager.delete')) abort(403);
        $mailSkypeData = MailSkypeList::findOrFail($id);
        $mailSkypeData->delete();
        return response()->json([
            'id' => $id
        ]);
    }
}
