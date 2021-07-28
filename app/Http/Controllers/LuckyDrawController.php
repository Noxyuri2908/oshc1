<?php

namespace App\Http\Controllers;

use App\Admin\LuckyDraw;
use Illuminate\Http\Request;

class LuckyDrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $flag='lucky_draw';
        $lucky = LuckyDraw::first();
        $textValue = '';
        if(!empty($lucky)){
            $bias = json_decode($lucky->arr_bias_number);
            foreach ($bias as $line) {
                $textValue .= $line."\n";
            }
        }
        return view('CRM.pages.lucky-draw.index',compact('flag','lucky','textValue'));
    }

    public function store(Request $request)
    {
        //
        $data=[];
        $value = $request->get('arr_bias_number');
        $text = trim($value);
        $textAr = explode("\r\n", $text);
        $textAr = array_filter($textAr, 'trim');
        $data['arr_bias_number'] = json_encode($textAr);
        LuckyDraw::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\LuckyDraw  $luckyDraw
     * @return \Illuminate\Http\Response
     */
    public function show(LuckyDraw $luckyDraw)
    {
        //
        return view('test');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\LuckyDraw  $luckyDraw
     * @return \Illuminate\Http\Response
     */
    public function edit(LuckyDraw $luckyDraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\LuckyDraw  $luckyDraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data=[];
        $value = $request->get('arr_bias_number');
        $text = trim($value);
        $textAr = explode("\r\n", $text);
        $textAr = array_filter($textAr, 'trim');
        $data['arr_bias_number'] = json_encode($textAr);
        $lucky = LuckyDraw::findOrFail($id);
        $lucky->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\LuckyDraw  $luckyDraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(LuckyDraw $luckyDraw)
    {
        //
    }
}
