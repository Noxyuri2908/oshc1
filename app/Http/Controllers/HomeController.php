<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin\Banner;
use App\Admin\Section;
use App\Admin\Content;
use App\Admin\Service;
use App\Admin\CatBenefit;
use App\Admin\Conf;
use App\Admin\Area;
use App\Admin\Webinfo;
use App\Admin\Question;
use App\Admin\Sub;
use App\Admin\Comment;
use App\Admin\Dichvu;
use App\Admin\Page;
use Exception;
use Illuminate\Support\Facades\Mail;
use Session;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);
        return redirect()->back();
    }

    public function question(Request $request)
    {
        $arr_data = $request->all();
        $arr_data['status'] = 0;
        $question = Question::create($arr_data);
        return redirect()->back();
    }


    public function postComment(Request $request)
    {
        $data = [];
        $data['post_id'] = $request->input('post');
        $data['comment_id'] = $request->input('comment');
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['content'] = $request->input('content');
        $data['status'] = 1;
        Comment::create($data);
        $comments = Comment::where('post_id', $data['post_id'])->where('status', 1)->where('comment_id', null)->get();
        return view('fontend.partials.item-comment', ['comments' => $comments]);
    }

    public function subcriber(Request $request)
    {
        $arr_data['email'] = $request->input('sub_email');
        $arr_data['status'] = 0;
        $check = Sub::where('email', $arr_data['email'])->first();
        if ($check != null) return "Email đã được đăng ký";
        $sub = Sub::create($arr_data);
        return "Bạn đã đăng ký thành công";
    }


    public function redirectPage()
    {
        if (\Auth::check()) {
            $user = \Auth()->user();
            if ($user->role == 'admin' || $user->role == 'super-admin') {
                return redirect()->route('webinfo.index');
            } else {
                return redirect()->route('agent-profile.get');
            }
        }
        return redirect()->route('home');
    }

    public function index()
    {
        reset_data();
        $info = cache()->remember('web_info_modal_popup',60*60*24,function(){
            return Webinfo::whereIN('code', ['modal_popup'])
                ->where('status', 1)->get();
        });
        $infos =  $info->where('code', 'modal_popup')->first();

        $start_date = \Session::put('start_date', '');
        $end_date = \Session::put('end_date', '');
        $childs = \Session::put('childs', '');
        $adults = \Session::put('adults', '');
        \Session::put('provider_id', '');
        \Session::put('country', '');
        \Session::put('apply_id', '');
        \Session::put('policy', '');

        set_step(1);
        $sc = cache()->remember('web_section_welcome',60*60*24,function(){
            return Section::where('status', 1)->where('page_id', 1)->first();
        });
        $ct = cache()->remember('web_content_kol_welcome',60*60*24,function(){
            return Content::where('status', 1)->where('section_id', 1)->get();
        });
        $bn = cache()->remember('web_banner_img_welcome',60*60*24,function(){
            return Banner::where('status', 1)->where('page', 1)->get();
        });
        return view('welcome', [
            'bns' => $bn, 'scs' => $sc, 'cts' => $ct, 'infos' => $infos,
            'start_date' => $start_date, 'end_date' => $end_date,
            'childs' => $childs, 'adults' => $adults
        ]);
    }

    public function getQa()
    {
        $info = Webinfo::whereIN('code', ['qa_section_1', 'qa_section_2',])
            ->where('status', 1)->get();
        $qa_section_1 =  $info->where('code', 'qa_section_1')->first();
        $qa_section_2 =  $info->where('code', 'qa_section_2')->first();
        $areas = Area::where('status', 1)->get();
        $sc = Section::where('status', 1)->where('page_id', 1)->first();
        $ct = Content::where('status', 1)->where('section_id', 1)->get();

        return view('fontend.page.qa', [
            'scs' => $sc,
            'cts' => $ct,
            'qa_section_1' => $qa_section_1,
            'qa_section_2' => $qa_section_2,
            'areas' => $areas,
        ]);
    }

    public function getForm()
    {
        return view('fontend.page.contact');
    }
    public function sendMailServiceHome(Request $request)
    {
        $arrayData['request'] = $request->only([
            'type_request',
            'first_name',
            'last_name',
            'relationship_dependent',
            'birth_day',
            'new_start_date',
            'termination_date',
            'reason_termination',
            'passport_no',
            'note',
            'country_id'
        ]);

        $arrayData['info'] = $request->only([
            'full_name',
            'birth_day_request',
            'email',
            'provider_id',
            'policy_no'
        ]);
        // dd($arrayData);

        $files = $request->file('service_home_file');
        $fileLists = [];
        if (!empty($files)) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $new_name = rand() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/storage/attr'), $new_name);
                array_push($fileLists, $new_name);
            }
        }

        $subject = 'Request change ' . $request->get('type_request') . ' ' . $request->get('full_name');
        try {
            Mail::send('fontend.mail.service-home.service_home', ['arrayData' => $arrayData], function ($message) use ($subject, $fileLists) {
                $message->to(config('mail.mail_oshc'));
                $message->subject($subject);
                foreach ($fileLists as $one) {
                    $message->attach(public_path('/storage/attr') . '/' . $one);
                }
            });
            return redirect()->back()->with('success', '1');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['msg', 'Error ' . $e]);
        }
    }
}
