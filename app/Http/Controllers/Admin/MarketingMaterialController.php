<?php

namespace App\Http\Controllers\Admin;

use App\Admin\MarketingMaterialList;
use App\Admin\Tailieu;
use App\Http\Requests\MarketingMaterialListRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarketingMaterialController extends Controller
{
    //
    public function index(){
        $flag= 'marketing-material-list';
        return view('CRM.pages.marketing-material.index',compact('flag'));
    }
    public function getData(Request $request)
    {
        $marketingMaterialDatas = MarketingMaterialList::when($request->get('category_id'),function($query) use ($request){
            $query->where('category_id',$request->get('category_id'));
        })->when($request->get('use_for'),function($query) use ($request){
            $query->where('use_for',$request->get('use_for'));
        })->when($request->get('target'),function($query) use ($request){
            $query->where('target',$request->get('target'));
        })->when($request->get('type'),function($query) use ($request){
            $query->where('type',$request->get('type'));
        })
        ->when($request->get('sub_target'),function($query) use ($request){
        $query
            ->where('target',$request->get('target'))
            ->where('sub_target',$request->get('sub_target'));
        })->orderBy('id', 'desc')->paginate(15);
        $lastPage = $marketingMaterialDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.marketing-material.data', compact(
                'marketingMaterialDatas'
            ))->render(),
            'last_page' => $lastPage
        ]);
    }

    public function create()
    {
        $flag = 'marketing-material-list';
        return view('CRM.pages.marketing-material.form', compact('flag'));
    }

    public function store(MarketingMaterialListRequest $request)
    {
        ini_set('memory_limit','256M');
        $data = $request->validated();
        $files = (!empty($data['file_attachment']))?$data['file_attachment']:null;
        $arrayId = [];

        if (!empty($files))
        {
            foreach ($files as $file)
            {
                if(!empty($file)){
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $name = $fileName.'-'.time() . str_random(5) .'.' . $file->getClientOriginalExtension();
                    $file->move('tailieus', $name);
                    $id = Tailieu::insertGetId([
                        'link' => $name
                    ]);
                    array_push($arrayId, $id);
                }
            }
        }

        $data['file_attachment'] = json_encode($arrayId);
        MarketingMaterialList::create($data);
        $marketingMaterialDatas = MarketingMaterialList::orderBy('id', 'desc')->paginate(15);
        $lastPage = $marketingMaterialDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.marketing-material.data', compact(
                'marketingMaterialDatas'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $flag = 'marketing-material-list';
        $marketingMaterialData = MarketingMaterialList::findOrFail($id);
        return view('CRM.pages.marketing-material.form', compact(
            'flag',
            'marketingMaterialData'
        ));
    }

    public function update(MarketingMaterialListRequest $request, $id)
    {
        ini_set('memory_limit','256M');
        $data = $request->validated();
        $files = (!empty($data['file_attachment']))?$data['file_attachment']:null;
        $arrayId = [];

        if (!empty($files))
        {
            foreach ($files as $file)
            {
                if(!empty($file)){
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $name = $fileName.'-'.time() . str_random(5) .'.' . $file->getClientOriginalExtension();
                    $file->move('tailieus', $name);

                    $idTaiLieus = Tailieu::insertGetId([
                        'link' => $name
                    ]);
                    array_push($arrayId, $idTaiLieus);

                }else{
                    unset($data['file_attachment']);
                }
            }
        }

        $data['file_attachment'] = json_encode($arrayId);
        $marketingMaterialData = MarketingMaterialList::find($id);
        $marketingMaterialData->update($data);
        $marketingMaterialDatas = [$marketingMaterialData];
        return response()->json([
            'view' => view('CRM.pages.marketing-material.data', compact(
                'marketingMaterialDatas'
            ))->render(),
            'id' => $marketingMaterialData->id,
            'type' => 'update'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $marketingMaterialData = MarketingMaterialList::findOrFail($id);
        $marketingMaterialData->delete();
        return response()->json([
            'id' => $id
        ]);
    }
}
