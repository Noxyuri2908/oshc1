<?php

namespace App\Http\Controllers;

use App\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoverController extends Controller
{
    //

    public function pushStore(Request $request)
    {
        $service_id = $request->get('service_id');
        $policy = $request->get('policy');
        $cover = $request->get('cover');
        $action = $request->get('action');
        $cover_id = $request->get('cover_id');
        $data = [
          'service_id' => $service_id,
          'policy' => $policy,
          'cover' => $cover
        ];

        if ($action == 'update' && $cover_id){
            $this->updateCover($cover_id, $data);
        }else{
            $idCover = DB::table('covers')->insertGetId($data);
            if (empty($idCover)) return response()->json(['error' => 'please check again']);
        }

        return $this->getCoverByServiceId($service_id);

    }

    function delete(Request $request){
        $id = $request->get('id');
        $deletedRows = Cover::where('id', $id)->delete();
        if ($deletedRows == 0) return response()->json(['error' => 'Error : please call admin check code']);

        return response()->json(['message' => 'successfully']);

    }

    public function getCoverByServiceAndPolicy(Request $request){
        $service = $request->get('service');
        $policy = $request->get('policy');

        $cover = Cover::getCover($service, $policy);

        if (count($cover) <= 0) return response()->json(['message' => 'Service data for covers is blank, please double check', 'error' => 'ghost']);

        return response()->json(['result' => $cover]);

    }

    public function updateCover($id, $data)
    {
        return DB::table('covers')->where('id', $id)->update($data);
    }

    public function getCoverByServiceId($service_id)
    {
        $covers = Cover::where('service_id', $service_id)->get();
        return response()->json(['message' => 'successfully', 'view' => view('back-end.cover.tbody-data', ['covers' => $covers])->render()]);
    }
}
