<?php

namespace App\Http\Controllers;

use App\Admin\HospitalAccess;
use Illuminate\Http\Request;

class HospitalAccessController extends Controller
{
    //

    public function __construct()
    {
    }

    public function add(Request $request)
    {
        $service = $request->service_id;
        $hospital = $request->hospital;
        $data = [
          'hostpital_access' => $hospital,
          'service_id' => $service
        ];

        $data = HospitalAccess::create($data);
        return response()->json($data);
    }

    public function remove(Request $request)
    {
        $hospitalId = $request->hospital;
        $data = HospitalAccess::destroy($hospitalId);
        if ($data)
        {
            return $data;
        }
    }

    public function update(Request $request){
        $hospitalId = $request->hospital;
        $hospital = $request->value;
        $data = HospitalAccess::where('id', $hospitalId)->update(['hostpital_access' => $hospital]);
        return $data;
    }

    public function get(Request $request)
    {
        $service_id = $request->service;
        $hospital = HospitalAccess::where('service_id', $service_id)->get();
        return response()->json($hospital);
    }
}
