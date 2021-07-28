<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\School;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Admin\TemplateSchool;
use App\Admin;
use Excel;
use File;
use Session;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget('data_fillter_school');
        $objs = School::orderby('name')->paginate(50);
        $flag = "partner_school";
        return view('CRM.pages.school')->with(compact('objs', 'flag'));
    }

    public function searchSchool(Request $request)
    {
        $name = $request->input('f_name');
        $country = $request->input('f_country');
        $state = $request->input('f_state');
        $city = $request->input('f_city');
        $request->session()->put('data_fillter_school', [
            'name' => $name,
            'country' => $country,
            'state' => $state,
            'city' => $city,
        ]);
        $query = School::where('id', '>', 0);
        if ($name != null && $name != '') {
            $_tmp = mb_strtolower($name, 'UTF-8');
            $query = $query->whereRaw('lower(name) like (?)', ["%{$_tmp}%"]);
        }
        if ($state != null && $state != '') {
            $_tmp = mb_strtolower($state, 'UTF-8');
            $query = $query->whereRaw('lower(state) like (?)', ["%{$_tmp}%"]);
        }
        if ($city != null && $city != '') {
            $_tmp = mb_strtolower($city, 'UTF-8');
            $query = $query->whereRaw('lower(city) like (?)', ["%{$_tmp}%"]);
        }
        if ($country != 'all') {
            $query = $query->where('country', $country);
        }
        $query = $query->get();
        return view('CRM.elements.schools.table', ['objs' => $query]);
    }

    public function importSchool(Request $request)
    {
        $extension = File::extension($request->file->getClientOriginalName());
        if ($extension == "xlsx" || $extension == "xls") {
            $path = $request->file->getRealPath();
            try {
                (new FastExcel)->sheet(1)->import($path, function ($line) {
                    $arr_tmp = [];
                    $arr_tmp['name'] = $line['Name'];
                    $arr_tmp['country'] = array_search($line['Country'], config('country.list'));
                    $arr_tmp['state'] = $line['State/Region'];
                    $arr_tmp['city'] = $line['City'];
                    $arr_tmp['created_by'] = auth()->guard('admin')->user()->id;
                    if ($arr_tmp['name'] != null && $arr_tmp['name'] != "") {
                        School::create($arr_tmp);
                    }
                });
            } catch (Exception $e) {
                Session::flash('error-list-school', "Format file incorrect !");
                return back();
            }
        } else {
            Session::flash('error-list-school', "File import must is excel !");
            return back();
        }
        Session::flash('success-list-school', "Import successful !");
        return back();
    }

    public function exportSchool(Request $request)
    {

        return Excel::download(
            new TemplateSchool(),
            'export_school_' . date('d_m_Y') . '.xlsx'
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = School::where('name', $request->name)
            ->where('country', $request->country)->count();
        if ($check > 0) {
            Session::flash('error-list-school', 'School is exists!');
        } else {
            $data = $request->all();
            $data['created_by'] = auth()->guard('admin')->user()->id;
            School::create($data);
            Session::flash('success-list-school', 'Create school successful!');
        }
        return redirect()->back();
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
    }

    public function editSchool(Request $request)
    {
        $id = $request->input('id');
        $obj = School::find($id);
        return view('CRM.elements.schools.modal-update', ['obj' => $obj]);
    }

    public function deleteSchool(Request $request)
    {
        $obj = School::find($request->school_id);
        if ($obj == null) {
            Session::flash('error-list-school', 'Can not found school data!');
        } else {
            $obj->delete();
            Session::flash('success-list-school', 'Delete school successful!');
        }
        return redirect()->back();
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
        $obj = School::find($id);
        if ($obj == null) {
            Session::flash('error-list-school', 'Can not found school data!');
        } else {
            $check = School::where('name', $request->name)
                ->where('id', '<>', $id)
                ->where('country', $request->country)->count();
            if ($check > 0) {
                Session::flash('error-list-school', 'School is exists!');
            } else {
                $data['updated_by'] = auth()->guard('admin')->user()->id;
                $obj->update($data);
                Session::flash('success-list-school', 'Update school successful!');
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
