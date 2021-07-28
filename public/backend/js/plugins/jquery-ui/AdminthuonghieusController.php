<?php

namespace App\Http\Controllers\Backend\api;

use App\Http\Controllers\Backend\BaseAdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use View;
use App\Model\thuonghieu;
use App\Model\FunctionAuthority;
use App\Exceptions\ErrorCodes;
use App\Exceptions\ShopCommon;
use App\Exceptions\ShopUpload;
use Illuminate\Support\Facades\DB;

class AdminthuonghieusController extends BaseAdminController
{

    public function index (Request $request) {

        $thuonghieus = DB::table('thuonghieus')
            ->select('*')
            ->where([
                ['del_flg', '=', 0]
            ])
            ->orderBy('position', 'desc')
            ->get();

        $output = [];
        foreach ($thuonghieus as $key => $thuonghieu) {
            $vitri = $key+1;
            $row = $this->GetRow($thuonghieu, $vitri);
            $output[] = $row;
        }

        $data['code'] = 200;
        $data['data'] = $output;
        return response()->json($data, 200);
    }

    //-------------------------------------------------------------------------------
    public function store(Request $request)
    {
        try {

            // validate
            $error_validate = thuonghieu::validate(0);
            $validator = \Validator::make($request->value, $error_validate['pattern'], $error_validate['messenger'], $error_validate['customName']);
            if ($validator->fails()) {
                $data['code'] = 300;
                $data['error'] = $validator->errors();
                return response()->json($data, 200);
            }

            $save_db = $this->SaveDB($request->all(),'thuonghieu');

            return response()->json($save_db, 200);

        } catch (Exception $e) {
            $data['code'] = 300;
            $data['error'] = 'Lỗi kết nối';
            return response()->json($data, 200);
        }

    }

    //-------------------------------------------------------------------------------
    public function update(Request $request, $id)
    {
        try {

            if ($request->status_code == 'edit') {
                // validate
                $error_validate = thuonghieu::validate($id);
                $validator = \Validator::make($request->value, $error_validate['pattern'], $error_validate['messenger'], $error_validate['customName']);

                if ($validator->fails()) {
                    $data['code'] = 300;
                    $data['error'] = $validator->errors();
                    return response()->json($data, 200);
                }
            }

            $edit_db = $this->EditDB($request->all(),'thuonghieu', $id);

            if ($request->status_code == 'edit') {
                $edit_db['row'] = $this->GetRow($edit_db['row'], $request->vitri);
            }

            return response()->json($edit_db, 200);

        } catch (Exception $e) {
            $data['code'] = 300;
            $data['error'] = 'Lỗi kết nối';
            return response()->json($data, 200);
        }
    }

    //-------------------------------------------------------------------------------
    public function destroy ($id) {

        try {

            $thuonghieu = DB::table('thuonghieus')
                ->select('*')
                ->where([
                    ['id', '=', $id],
                ])
                ->first();

            if (!$thuonghieu) {
                $data['code'] = 300;
                $data['error'] = 'Không tìm thấy.';
                return response()->json($data, 200);
            }

            thuonghieu::where([
                ['id', $thuonghieu->id]
            ])->update(['del_flg' => 1]);

            $image_path = config('general.thuonghieu_path').$thuonghieu->avatar;
            rename($image_path, config('general.thuonghieu_path')."del_".$thuonghieu->avatar);

            $data['code'] = 200;
            $data['message'] = 'Xóa thành công';
            return response()->json($data, 200);

        } catch (Exception $e) {

            $data['code'] = 300;
            $data['error'] = 'Lỗi kết nối';
            return response()->json($data, 200);

        }
    }

    //-------------------------------------------------------------------------------
    public function GetRow($thuonghieu, $vitri)
    {
        $row = [];
        $row[] = $thuonghieu->id;
        $row[] = $thuonghieu->position;
        $row[] = $vitri;
        $row[] = $thuonghieu->title;
        $row[] = $this->GetImg([
            'avatar'=> $thuonghieu->avatar,
            'data'=> 'thuonghieu',
            'time'=> $thuonghieu->updated_at
        ]);
        $row[] = '<span class="hidden">'.$thuonghieu->updated_at.'</span>'.date('d/m/Y', strtotime($thuonghieu->updated_at));
        $view = View::make('Backend/thuonghieu/_status', ['status' => $thuonghieu->status]);
        $row[] = $view->render();
        $view = View::make('Backend/thuonghieu/_actions', ['id' => $thuonghieu->id,'page' => 'thuonghieu']);
        $row[] = $view->render();

        return $row;
    }
}
