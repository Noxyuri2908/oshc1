<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\ProviderCom;
use App\Admin\Service;
use Session;

class ProviderComController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->user()->can('providerCom.index')) {
            abort(403);
        }
        $objs = ProviderCom::with(['provider.dichvu'])->orderbyDesc('provider_id')->get();
        $flag = "partner_provider_com";
        $providers = Service::orderby('dichvu_id')->where('status', 1)->get();
        return view('CRM.pages.provider_com')->with(compact('objs', 'flag', 'providers'));
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
        if (!$request->user()->can('providerCom.store')) {
            abort(403);
        }
        //$check = ProviderCom::where('provider_id', $request->provider_id)->where('policy', $request->policy)->count();
        $check = 0;
        if ($check > 0) {
            Session::flash('error-list-providerCom', 'Provider commission id is exists!');
        } else {
            ProviderCom::create($request->all());
            Session::flash('success-list-providerCom', 'Create provider commission successful!');
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

    public function editCom(Request $request)
    {
        if (!$request->user()->can('providerCom.edit')) {
            abort(403);
        }
        $id = $request->input('id');
        $obj = ProviderCom::find($id);
        $providers = Service::all();
        return view('CRM.elements.provider_com.modal-update', ['obj' => $obj, 'providers' => $providers]);
    }

    public function deleteCom(Request $request)
    {
        if (!$request->user()->can('providerCom.delete')) {
            abort(403);
        }
        $obj = ProviderCom::find($request->id);
        if ($obj == null) {
            Session::flash('error-list-providerCom', 'Can not found provider commission data!');
        } else {
            $obj->delete();
            Session::flash('success-list-providerCom', 'Delete provider commission successful!');
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
        if (!$request->user()->can('providerCom.update')) {
            abort(403);
        }
        $obj = ProviderCom::find($id);
        if ($obj == null) {
            Session::flash('error-list-providerCom', 'Can not found provider commission data!');
            return redirect()->back();
        }
        //$check = ProviderCom::where('provider_id', $request->provider_id)
        //    ->where('policy', $request->policy)->where('id', '<>', $id)->count();
        $check = 0;

        if ($check > 0) {
            Session::flash('error-list-providerCom', 'Provider commission id is exists!');
        } else {
            $obj->update($request->all());
            Session::flash('success-list-providerCom', 'Update provider commission successful!');
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
