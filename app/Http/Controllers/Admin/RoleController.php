<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    public function index()
    {
        $roles = Role::paginate();
        $permissions = [];
        $flag = 'role';
        return view('CRM.pages.role.index', compact(
            'flag',
            'permissions',
            'roles'
        ));
    }
    public function create(){
        $flag='role';
        return view('CRM.pages.role.form',compact('flag'));
    }
    public function store(RoleStoreRequest $request){
        $data = $request->validated();
        $data['guard_name'] = 'admin';
        unset($data['member']);
        $role = Role::create($data);
        if(!empty($request->get('member'))){
            $role->users()->sync($request->get('member'));
        }
        return redirect()->route('roles.index');
    }
    public function edit(Request $request,$id){
        $role = Role::with([
            'users'
        ])->findOrFail($id);
        $flag = 'role';
        return view('CRM.pages.role.form',compact(
            'flag',
            'role'
        ));
    }
    public function update(RoleUpdateRequest $request,$id){
        $data = $request->validated();
        $role = Role::find($id);
        $role->update($data);
        if(!empty($request->get('member'))){
            $role->users()->sync($request->get('member'));
        }
        return redirect()->route('roles.index');
    }
    public function destroy(Request $request,$id){
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index');
    }
    public function getUserRole($id){

    }
}
