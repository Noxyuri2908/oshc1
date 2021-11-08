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
        $data = [
          'service_id' => $service_id,
          'policy' => $policy,
          'cover' => $cover
        ];

        $idCover = DB::table('covers')->insertGetId($data);
        if (empty($idCover)) return response()->json(['error' => 'please check again']);

        $covers = Cover::where('service_id', $service_id)->get();
        return response()->json(['message' => 'successfully', 'view' => view('back-end.cover.tbody-data', ['covers' => $covers])->render()]);

    }
}
