<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Flysystem\Config;

class StatusController extends Controller
{
    //
    public function index(Request $request)
    {
        $flag = 'status';
        $statuses = Status::when($request->get('q'), function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->get('q') . '%');
        })->orderBy('id', 'desc')
            ->get(['id', 'name', 'type', 'created_at'])->groupBy('type');
        return view('CRM.pages.status.index', compact(
            'statuses',
            'flag'
        ));
    }

    public function create(Request $request)
    {
        $typeCreate = $request->get('type');
        return view('CRM.pages.status.status_form', compact('typeCreate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StatusStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'type',
            'color',
            'value',
            'is_success'
        ]);
        if (!$data['value'][0] == null) {
            $data['value'] = json_encode($data['value']);
        }else{
            $data['value'] = null;
        }
        $status = Status::create($data);
        $statuses = Status::orderBy('id', 'desc')
            ->get(['id', 'name', 'type', 'created_at'])->groupBy('type');
        return view('CRM.pages.status.data', compact('statuses'));
//        return redirect()->route('status.index')->with('success', __('Created : :title', ['title' => $status->name]));
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Status $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $flag = 'status.edit';
        $status = Status::findOrFail($id);
        $statusValues = json_decode($status->value, true);
        return view('CRM.pages.status.status_form', compact(
            'status',
            'statusValues'
        ));
//
//        return view('CRM.pages.status.form', compact(
//            'status',
//            'flag',
//            'statusValues'
//        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\StatusUpdate $request
     * @param \App\Models\Status $status
     *
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'type',
            'color',
            'value',
            'is_success'
        ]);
//        dd(!$data['value'][0] == null);

        if (!$data['value'][0] == null) {
            $data['value'] = json_encode($data['value']);
        }else{
            $data['value'] = null;
        }
        $status = Status::findOrFail($id);
        $status->update($data);
        $statuses = Status::orderBy('id', 'desc')
            ->get(['id', 'name', 'type', 'created_at'])->groupBy('type');
        return view('CRM.pages.status.data', compact('statuses'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Status $status
     *
     * @return void
     * @throws \Exception
     */
    public function destroy(Request $request, $id)
    {
        $status = Status::findOrFail($id);
        $status->delete();
        return redirect()->route('status.index')->with('success', __('Delete : :title', ['title' => $status->name]));
    }
}
