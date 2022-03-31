<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminUpdateRequest;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Admin;
use Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if (!$request->user()->can('users.viewAny')) return abort(403);
        $admins = Admin::with(['staff'])->get();
        $roles = config('admin.role');
        return view('CRM.pages.staff', ['flag' => 'list_staff', 'data' => $admins, 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $flag = 'staff_create';
        if (!$request->user()->can('users.store')) return abort(403);
        return view('CRM.elements.staff.form', compact('flag'));
    }

    public function getProfile()
    {
        $obj = Admin::find(auth()->guard('admin')->user()->id);
        return view('back-end.staff.profile', ['obj' => $obj]);
    }

    public function postProfile(Request $request)
    {
        $obj = Admin::find(auth()->guard('admin')->user()->id);
        $tmp = $request->all();
        if (isset($tmp['password_new']) && $tmp['password_new'] != "") {
            $tmp['password'] = bcrypt($tmp['password_new']);
        }
        $obj->update($tmp);
        Session::flash('success-staff', 'Update successfull.');
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        if (!$request->user()->can('users.store')) return abort(403);
        $tmp = $request->validated();
        if(!empty($tmp['password'])){
            $tmp['password'] = bcrypt($tmp['password']);
        }
        if (isset($tmp['authorization'])){
            $tmp['authorization'] =  implode(';', $tmp['authorization']);
        }
        $tmp['created_by'] =  auth()->guard('admin')->user()->id;
        $tmp['date_of_birth'] = (!empty($tmp['date_of_birth']))?convert_date_to_db($tmp['date_of_birth']):null;
        $staff = Admin::create($tmp);

        if(!empty($tmp['roles'])){
            $staff->syncRoles($tmp['roles'] ?? []);
        }
        Session::flash('success-staff', 'Create new staff "' . $request->username . '" successfull.');
        return redirect()->route('staff.index');
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
    public function edit(Request $request,$id)
    {
        if (!$request->user()->can('users.update')) return abort(403);
        $obj = Admin::findOrFail($id);
        $obj->load(['roles', 'permissions']);
        $flag = 'edit_staff';
        return view('CRM.elements.staff.form', compact('obj', 'flag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        if (!$request->user()->can('users.update')) return abort(403);
        $staff = Admin::findOrFail($id);
        $tmp = $request->validated();
//        dd(!empty($tmp['password']) && $tmp['password'] != null);
        if (!empty($tmp['password']) && $tmp['password'] != null) {
            $tmp['password'] = bcrypt($tmp['password']);
        }else{
            unset($tmp['password']);
        }
        if (isset($tmp['authorization'])){
            $tmp['authorization'] =  implode(';', $tmp['authorization']);
        }
        if(!empty($tmp['roles'])){
            $staff->syncRoles($tmp['roles'] ?? []);
        }
        $tmp['date_of_birth'] = (!empty($tmp['date_of_birth']))?convert_date_to_db($tmp['date_of_birth']):null;
        $staff->update($tmp);
        Session::flash('success-staff', 'Update successfull.');
        return redirect()->route('staff.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if (!$request->user()->can('users.destroy')) return abort(403);
        $obj = Admin::find($id);
        if ($obj == null) abort(404);
        $obj->delete();
        Session::flash('success-staff', 'Delete staff successfull.');
        return redirect()->route('staff.index');
    }

    public function roleCountries(Request $request)
    {
        $countries = $request->arrCountries;
        $idStaff = $request->idStaff;
        $update = Admin::updateRoleCountries($idStaff, $countries);
        if ($update = 1)
        {
            return response()->json(['code' => 200, 'message' => 'success']);
        }
    }

    public function getRoleCountries(Request $request)
    {
        $idStaff = $request->idStaff;
        $roleCountries = Admin::getRoleCountriesById($idStaff);
        $roleCountries = \GuzzleHttp\json_decode($roleCountries);
        if (!empty($roleCountries))
        {
            foreach ($roleCountries as $item)
            {
                $data[$item] = config("country.list.$item");
            }
            return response()->json(['code' => 200, 'data' => $data]);
        }

        return;
    }

    public function roleDepartment(Request $request)
    {
        $department = $request->arrDepartment;
        $idStaff = $request->idStaff;
        $update = Admin::updateRoleDepartment($idStaff, $department);
        if ($update = 1)
        {
            return response()->json(['code' => 200, 'message' => 'success']);
        }
    }

    public function getRoleDepartment(Request $request)
    {
        $idStaff = $request->idStaff;
        $roleDepartment = Admin::getRoleDepartmentById($idStaff);
        $roleDepartment = \GuzzleHttp\json_decode($roleDepartment);
        if (!empty($roleDepartment))
        {
            foreach ($roleDepartment as $item)
            {
                $data[$item] = config("myconfig.department.$item");
            }
            return response()->json(['code' => 200, 'data' => $data]);
        }

        return;
    }


}
