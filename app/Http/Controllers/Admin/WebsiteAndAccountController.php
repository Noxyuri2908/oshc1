<?php

namespace App\Http\Controllers\Admin;

use App\Admin\WebsiteAndAccountService;
use App\Http\Requests\WebsiteAccountListRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteAndAccountController extends Controller
{
    public function index(Request $request){
        $type = $request->get('type');
        if(!empty($type)){
            if($type == 'website'){
                if(!$request->user()->can('website-account-manager.index')) abort(403);
                $flag= 'website-lists';
            }elseif($type == 'service'){
                if(!$request->user()->can('serviceAccount.index')) abort(403);
                $flag= 'account-service-lists';
            }
        }
        $typeId = array_search($type,WebsiteAndAccountService::$TYPE);
        return view('CRM.pages.website-and-account-service.index',compact(
            'flag',
            'type',
            'typeId'
        ));
    }
    public function getData(Request $request)
    {
        $typeId = $request->get('typeId');
        if($typeId == 1){
            if(!$request->user()->can('website-account-manager.index')) abort(403);
        }elseif($typeId == 2){
            if(!$request->user()->can('serviceAccount.index')) abort(403);
        }
        $websiteAndAccountDatas = WebsiteAndAccountService::when($request->get('website'),function($query) use ($request){
            $query->where('website','LIKE','%'.$request->get('website').'%');
        })->when($request->get('service'),function($query) use ($request){
            $query->where('service','LIKE','%'.$request->get('service').'%');
        })->when($request->get('link'),function($query) use ($request){
            $query->where('link','LIKE','%'.$request->get('link').'%');
        })->when($request->get('website_and_service_id'),function($query) use ($request){
            $query->where('website_and_service_id','LIKE','%'.$request->get('website_and_service_id').'%');
        })->when($request->get('password'),function($query) use ($request){
            $query->where('password','LIKE','%'.$request->get('password').'%');
        })->when($request->get('supporter'),function($query) use ($request){
            $query->where('supporter','LIKE','%'.$request->get('supporter').'%');
        })
            ->where('type',$request->get('typeId'))
            ->orderBy('id', 'desc')
            ->paginate(15);
        $lastPage = $websiteAndAccountDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.website-and-account-service.data', compact(
                'websiteAndAccountDatas',
                'typeId'
            ))->render(),
            'last_page' => $lastPage
        ]);
    }

    public function create(Request $request)
    {
        $flag = 'website-account-service-store';
        $typeId = $request->get('typeId');
        if($typeId == 1){
            if(!$request->user()->can('website-account-manager.store')) abort(403);
        }elseif($typeId == 2){
            if(!$request->user()->can('serviceAccount.store')) abort(403);
        }
        return view('CRM.pages.website-and-account-service.form', compact(
            'flag',
            'typeId'
        ));
    }

    public function store(WebsiteAccountListRequest $request)
    {
        $data = $request->validated();
        $typeId = $data['type'];
        if($typeId == 1){
            if(!$request->user()->can('website-account-manager.store')) abort(403);
        }elseif($typeId == 2){
            if(!$request->user()->can('serviceAccount.store')) abort(403);
        }
        WebsiteAndAccountService::create($data);
        $websiteAndAccountDatas = WebsiteAndAccountService::where('type',$typeId)->orderBy('id', 'desc')->paginate(15);
        $lastPage = $websiteAndAccountDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.website-and-account-service.data', compact(
                'websiteAndAccountDatas',
                'typeId'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $flag = 'website-and-account-service-edit';
        $typeId = $request->get('typeId');
        if($typeId == 1){
            if(!$request->user()->can('website-account-manager.edit')) abort(403);
        }elseif($typeId == 2){
            if(!$request->user()->can('serviceAccount.edit')) abort(403);
        }
        $websiteAndAccountData = WebsiteAndAccountService::findOrFail($id);
        return view('CRM.pages.website-and-account-service.form', compact(
            'flag',
            'websiteAndAccountData',
            'typeId'
        ));
    }

    public function update(WebsiteAccountListRequest $request, $id)
    {
        $data = $request->validated();
        $typeId = $data['type'];
        if($typeId == 1){
            if(!$request->user()->can('website-account-manager.update')) abort(403);
        }elseif($typeId == 2){
            if(!$request->user()->can('serviceAccount.update')) abort(403);
        }
        $websiteAndAccountData = WebsiteAndAccountService::findOrFail($id);
        $websiteAndAccountData->update($data);
        $websiteAndAccountDatas = [$websiteAndAccountData];
        return response()->json([
            'view' => view('CRM.pages.website-and-account-service.data', compact(
                'websiteAndAccountDatas',
                'typeId'
            ))->render(),
            'id' => $websiteAndAccountData->id,
            'type' => 'update'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $websiteAndAccountData = WebsiteAndAccountService::findOrFail($id);
        $typeId = $websiteAndAccountData->type;
        if($typeId == 1){
            if(!$request->user()->can('website-account-manager.delete')) abort(403);
        }elseif($typeId == 2){
            if(!$request->user()->can('serviceAccount.delete')) abort(403);
        }
        $websiteAndAccountData->delete();
        return response()->json([
            'id' => $id
        ]);
    }
}
