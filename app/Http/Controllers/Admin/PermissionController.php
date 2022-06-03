<?php

namespace App\Http\Controllers\Admin;

use App\Admin\EmployeeAccessList;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionUpdateRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    //
    public function index(Request $request, $id)
    {
        $flag = 'permission-index';
        $permissions = Permission::get()
            ->groupBy('type');
        $rolepermissions = Role::with([
            'permissions',
        ])
            ->find($id);
        $getRolePermission = $rolepermissions->permissions->groupBy('type');
        $employeeAccessLists = EmployeeAccessList::where('role_id', $id)->get([
            'role_id',
            'permission_type',
            'action_id',
        ]);



        return view('CRM.pages.permission.index', compact(
            'flag',
            'permissions',
            'getRolePermission',
            'rolepermissions',
            'employeeAccessLists'
        ));
    }

    public function update(PermissionUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $role = Role::find($id);
        if (!empty($data['permission'])) {
            $role->syncPermissions($data['permission']);
        }
        //dd($data['can_see']);
        if (!empty($data['can_see']) && count($data['can_see']) > 0) {
            foreach ($data['can_see'] as $typePermission => $valueSee) {
                $check = EmployeeAccessList::where('role_id', $id)
                        ->where('permission_type', $typePermission)->count() > 0;
                if ($check) {
                    EmployeeAccessList::where('role_id', $id)
                        ->where('permission_type', $typePermission)->update([
                            'role_id' => $id,
                            'permission_type' => $typePermission,
                            'action_id' => $valueSee,
                        ]);
                } else {
                    EmployeeAccessList::create([
                        'role_id' => $id,
                        'permission_type' => $typePermission,
                        'action_id' => $valueSee,
                    ]);
                }
            }
        }
        return redirect()->back();
    }
}
