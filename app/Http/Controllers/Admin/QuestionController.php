<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Question;
use Session;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Question::all();
        return view('back-end.question.list',['data'=>$objs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('question.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('question.index');
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
        $obj = Question::find($id);
        if($obj == null){
            Session::flash('error-question', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('question.index');  
        }
        return view('back-end.question.edit',['obj'=>$obj]);
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
        $obj = Question::find($id);
        if($obj == null){
            Session::flash('error-question', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('question.index');  
        }
        $email = $obj->email;
        $title = "Trả lời câu hỏi khách hàng.";
        $question = $obj->ques;
        $content = $obj->content;
        $answer = $request->answer;
        $subject = "OSHC Global trả lời câu hỏi của khách hàng.";
        $content_mail = "Dear ".$obj->name.",<br>";
        $content_mail = $content_mail."Chúng tôi đã nhận được câu hỏi của bạn:<br>". $question."<br>"."Với nội dung";
        send_mail($email, $title, $subject, $content_mail);
        $user = \Auth::user();
        $obj->user_id = $user->id;
        $obj->status = 1;
        $obj->update();
        Session::flash('success-question', 'Đã gửi câu trả lời thành công.'); 
        return redirect()->route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
