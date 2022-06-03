<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Apply;
use App\Admin\Tailieu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Session;

class TailieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('id');
        $obj = Apply::find($id);
        if ($obj == null) abort(404);
        if ($request->get('type') == 'customer_docs') {
            return view('CRM.elements.customers.docs.modal-form', ['obj' => $obj]);
        }elseif($request->get('type') == 'flywire_docs'){
            return view('CRM.elements.customers.docs.modal-form', ['obj' => $obj,'type'=>'flywire']);
        } else {
            return view('CRM.elements.customer-process.docs.modal-form', ['obj' => $obj]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file;
        if ($file == null && $file == '') {
            Session::flash('error-customer-process-' . $obj->id, 'You must choose file to upload.');
            return redirect()->route('customer.process.index', ['id' => $obj->id, 'tab' => 6]);
        }
        $name = time() . str_random(5) . '.' . $file->getClientOriginalExtension();
        $file->move('tailieus', $name);
        $data = $request->all();
        $data['link'] = $name;
        $data['admin_id'] = auth()->guard('admin')->user()->id;
        Tailieu::create($data);
        $obj = Apply::with(['applyLink.tailieus','tailieus'])->find($request->apply_id);
        $docs = $obj->tailieus;
        $linkDocs = (!empty($obj->applyLink))?$obj->applyLink->tailieus:collect([]);
        $totalDocs = $docs->merge($linkDocs);
        Session::flash('success-customer-process-' . $obj->id, 'Create document successful.');
        if ($request->get('action') == 'customer_docs_receipt_create') {
            if(!empty($request->get('type')) && $request->get('type')=='flywire'){
                return view('CRM.elements.flywire-process.table-doc', compact('totalDocs'));
            }else{
                return view('CRM.elements.customer-process.table-doc', compact('obj'));
            }
        } else {
            return redirect()->route('customer.process.index', ['id' => $obj->id, 'tab' => 6]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $tailieu_id = $request->input('tailieu_id');
        $tailieu = Tailieu::with('invoice')->find($tailieu_id);

        $obj = !empty($tailieu) && !empty($tailieu->invoice)?$tailieu->invoice:collect([]);
        //$docs = !empty($obj) && !empty($obj->tailieus)?$obj->tailieus:collect([]);
        //$linkDocs = (!empty($obj->applyLink))?$obj->applyLink->tailieus:collect([]);
        //$totalDocs = $docs->merge($linkDocs);
        if ($tailieu == null) abort(404);
        if ($request->get('type') == 'customer_docs') {
            return view('CRM.elements.customers.docs.modal-form', ['obj' => $obj, 'tailieu' => $tailieu]);
        } else {
            return view('CRM.elements.customer-process.docs.modal-form', ['obj' => $obj, 'tailieu' => $tailieu]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->has('apply_id')){
            $obj = Apply::find($request->get('apply_id'));
        }
        $tailieu = Tailieu::find($id);
        if ($tailieu == null) abort(404);
        if ($tailieu->invoice == null) abort(404);
        $file = $request->file;
        $data = $request->all();
        if ($file != null) {
            $name = time() . str_random(5) . '.' . $file->getClientOriginalExtension();
            $file->move('tailieus', $name);
            $data['link'] = $name;
        }
        $tailieu->update($data);
        Session::flash('success-customer-process-' . $tailieu->invoice->id, 'Update document successful.');
        if ($request->get('action') == 'customer_docs_receipt_update') {
            return view('CRM.elements.customer-process.table-doc', compact('obj'));
        } else {
            return redirect()->route('customer.process.index', ['id' => $tailieu->invoice->id, 'tab' => 6]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->data_del;
        $tailieu = Tailieu::findOrFail($id);
        $applyId = $tailieu->apply_id;
        $tailieu->delete();
        $obj = Apply::with(['applyLink.tailieus','tailieus'])->find($applyId);
        $docs = $obj->tailieus;
        $linkDocs = (!empty($obj->applyLink))?$obj->applyLink->tailieus:collect([]);
        $totalDocs = $docs->merge($linkDocs);
        if ($request->get('action') == 'customer_docs_receipt_delete') {
            if(!empty($request->get('type')) && $request->get('type')=='flywire'){
                return view('CRM.elements.flywire-process.table-doc', compact('totalDocs'));
            }else{
                return view('CRM.elements.customer-process.table-doc', compact('obj'));
            }
        }else{
            Session::flash('success-customer-process-' . $obj->id, 'Delete document successful.');
            return redirect()->route('customer.process.index', ['id' => $obj->id, 'tab' => 6]);
        }

    }
}
