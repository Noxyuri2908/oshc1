<?php

namespace App\Http\Controllers\Admin;

use App\Imports\AgentImport;
use App\Imports\ImportPrice;
use App\Imports\UsersImportTypeOfAgent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Price;
use App\Admin\Service;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use Session;


class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Price::all();
        $services = Service::where('status',1)->where('price_type',0)->get();
        return view('back-end.price.list',['data'=>$objs,'services'=>$services]);
    }

    public function import(Request $request)
    {
        $file = $request->file;
        $id = $request->service_id;
        $service = Service::where('price_type',0)->where('id',$id)->first();
        if($service == null){
            Session::flash('error-price', 'Không tìm thấy dữ liệu.');
            return redirect()->route('price.index');
        }

        $check = '';
        if ($fh = fopen($file, 'r')) {
            while (!feof($fh)) {
                $line = fgets($fh);

                if (strpos($line, 'Single') !== false) $check = 's';
                elseif (strpos($line, 'Couple') !== false) $check = 'c';
                elseif (strpos($line, 'Family') !== false) $check = 'f';

                if($check == 's'){
                    $type = 1;
                }elseif ($check == 'c') {
                    $type = 2;
                }elseif ($check == 'f') {
                    $type = 3;
                }
                if(strpos($line, '[-1]') !== false){
                    $month = 0;
                    if(strpos($line, ';') !== false){
                        $tmp = explode(';', $line);
                        $line = $tmp[0];
                        $tmp = explode('|', $line);
                        $price = floatval($tmp[1]);
                        $month = intval(substr($tmp[0], strrpos($tmp[0], '[')+1, strlen($tmp[0])));
                    }else{
                        if(strpos($line, '|') !== false){
                            $tmp = explode(' | ', $line);
                            if(sizeof($tmp) == 2 && strrpos($tmp[0], '[') !== false && strpos($tmp[1], ']') !== false){
                                $month = intval(substr($tmp[0], strrpos($tmp[0], '[')+1, strlen($tmp[0])));
                                $price = floatval(str_replace("][-1]\r\n", "", $tmp[1]));
                            }
                        }
                    }
                    if($month != 0)
                    {

                        $data = [];
                        $data['service_id'] = $id;
                        $data['num_month'] = $month;
                        $data['type'] = $type;
                        $data['price'] = $price;
                        $data['status'] = 1;

                        $price = Price::where('type',$type)->where('service_id', $id)->where('num_month',$month)->first();
                        if($price != null) $price->update($data);
                        else Price::create($data);
                        $month = 0;
                    }

                }
            }
            fclose($fh);
        }
        Session::flash('success-price', 'Import dữ liệu thành công.');
        return redirect()->route('price.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::where('status',1)->where('price_type',0)->get();
        return view('back-end.price.create',['services'=>$services]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        $price = Price::where('service_id', $arr_data['service_id'])->where('num_month', $arr_data['num_month'])->where('type',$arr_data['type'])->first();
        if($price != null){
            Session::flash('error-price', 'Dữ liệu bị trùng. Xin kiểm tra lại.');
            return redirect()->route('price.edit',['id'=>$id]);
        }else{
            Price::create($arr_data);
        }
        Session::flash('success-price', 'Tạo mới dữ liệu thành công.');
        return redirect()->route('price.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj = Price::find($id);
        if($obj == null){
            Session::flash('error-price', 'Không tìm thấy dữ liệu.');
            return redirect()->route('price.index');
        }
        $services = Service::where('status',1)->where('price_type',0)->get();
        return view('back-end.price.edit',['obj'=>$obj,'services'=>$services]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obj = Price::find($id);
        if($obj == null){
            Session::flash('error-price', 'Không tìm thấy dữ liệu.');
            return redirect()->route('price.index');
        }
        $arr_data = $request->all();
        $comm = Commission::where('service_id', $arr_data['service_id'])->where('num_month', $arr_data['num_month'])->where('id','<>', $obj->id)->where('type',$arr_data['type'])->first();
        if($comm != null){
            Session::flash('error-price', 'Dữ liệu bị trùng. Xin kiểm tra lại.');
            return redirect()->route('price.edit',['id'=>$id]);
        }else{
            $obj->update($arr_data);
        }

        Session::flash('success-price', 'Cập nhật dữ liệu thành công.');
        return redirect()->route('price.edit',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Price::find($id);
        if($obj == null){
            Session::flash('error-price', 'Không tìm thấy dữ liệu.');
            return redirect()->route('price.index');
        }
        $obj->delete();
        Session::flash('success-price', 'Xóa bài viết thành công.');
        return redirect()->route('price.index');
    }

    public function mutileUpdate(Request $request)
    {
        $status = $request->status;
        $data = $request->data_selected;
        $data = explode(",", $data[0]);
        if($status != 2)
        {
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Price::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Price::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }
        Session::flash('success-price', 'Update đồng loạt thành công.');
        return redirect()->route('price.index');
    }

    function importExcel(Request $request){
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $loaidv = $request->get('loaidv');
            Excel::import(new ImportPrice(), $file);

        }
        ini_set('memory_limit', '-1');
        return back();
    }
}
