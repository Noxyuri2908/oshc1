<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin\Tag;
use App\Admin\Webinfo;
use App\Admin\Category;
use App\Admin\Post;
use App\Admin\Person;
use App\Admin\Page;
use App\Info;
use App\User;
use Lang;
use Session;
use App\Admin\Section;
use App\Admin\Content;
use App\Admin\Comment;
use App\Admin\MenuHeader;
use Illuminate\Support\Facades\Mail;
use Spipu\Html2Pdf\Html2Pdf;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function about()
    {
        $about = Page::where('slug', 'about-us')->where('status', 1)->first();
        $about->content = json_decode($about->content, true);
        (!empty($about)) ? $about : [];
        return view('fontend.page.about', ['about' => $about]);
    }

    public function urgent()
    {
        return view('fontend.page.urgent');
    }

    public function specialOffer()
    {
        return view('fontend.page.special');
    }
    public function sendMailSpecialOffer(Request $request)
    {
        $datas = $request->only([
            'full_name',
            'email',
            'tel',
        ]);
        Mail::send('fontend.mail.special-offer.special-offer', ['datas' => $datas], function ($message) {
            $message->to(config('mail.mail_oshc'));
        });
        return back()->with('success', 1);
    }

    // public function special()
    // {
    //     return view('fontend.page.special');
    // }

    public function other_sevice()
    {
        return view('fontend.page.other-sevice');
    }

    public function claim()
    {
        return view('fontend.page.claim');
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->where('status', 1)->first();
        if ($tag == null) return abort(404);
        $menu = $tag->menu_header;
        if ($menu == null) return abort(404);
        $id = $tag->id;
        $cats = Category::where('status', 1)->where('menu_id', $menu->id)->get();
        $tags = Tag::where('status', 1)->where('menu_id', $menu->id)->get();
        $info = Webinfo::whereIN('code', ['news_section_1'])
            ->where('status', 1)->get();
        $posts = Post::where('status', 1)->whereIn('cat_id', $cats->pluck('id')->all())->orderby('created_at', 'desc')->where('type', 1)->whereRaw('tags like (?)', ["%{$id}%"])->paginate(6);
        $news_section_1 = $info->where('code', 'news_section_1')->first();
        return view('fontend.page.news', ['tags' => $tags, 'news_section_1' => $news_section_1, 'cats' => $cats, 'posts' => $posts, 'tag' => $tag, 'c_menu' => $menu]);
    }

    public function getByMenu(Request $request, $slug)
    {
        $menu = MenuHeader::where('slug', $slug)->where('status', 1)->first();
        if ($menu == null) return abort(404);
        $cats = Category::where('status', 1)->where('menu_id', $menu->id)->get();
        $tags = Tag::where('status', 1)->where('menu_id', $menu->id)->get();
        $info = Webinfo::whereIN('code', ['news_section_1'])
            ->where('status', 1)->get();
        $posts = Post::when($request->get('s'), function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->get('s') . '%');
        })->where('status', 1)->whereIn('cat_id', $cats->pluck('id')->all())->orderby('created_at', 'desc')->where('type', 1)->paginate(6);
        $news_section_1 = $info->where('code', 'news_section_1')->first();
        return view('fontend.page.news', ['tags' => $tags, 'news_section_1' => $news_section_1, 'cats' => $cats, 'posts' => $posts, 'c_menu' => $menu]);
    }

    public function getByCat($slug, $cat)
    {
        $menu = MenuHeader::where('slug', $slug)->where('status', 1)->first();
        if ($menu == null) return abort(404);
        $category = Category::where('slug', $cat)->where('menu_id', $menu->id)->where('status', 1)->first();
        if ($category == null) return abort(404);
        $cats = Category::where('status', 1)->where('menu_id', $menu->id)->get();
        $tags = Tag::where('status', 1)->where('menu_id', $menu->id)->get();
        $info = Webinfo::whereIN('code', ['news_section_1'])
            ->where('status', 1)->get();
        $posts = Post::where('status', 1)->where('cat_id', $category->id)->orderby('post_created_at', 'desc')->where('type', 1)->paginate(6);
        $news_section_1 = $info->where('code', 'news_section_1')->first();
        return view('fontend.page.news', ['tags' => $tags, 'news_section_1' => $news_section_1, 'cats' => $cats, 'posts' => $posts, 'c_menu' => $menu, 'category' => $category]);
    }

    public function getNewsByCat(Request $request)
    {
        $id_menu = $request->input('menu');
        $menu = MenuHeader::find($id_menu);
        if ($menu == null) return abort(404);
        $id = $request->input('cat');
        $tags = $request->input('tags');
        if ($id == 0) {
            $cats = $menu->category()->get()->pluck('id')->all();
            $posts = Post::where('status', 1)->whereIn('cat_id', $cats)->orderby('created_at', 'desc')->where('type', 1);
            if (isset($tags) && sizeof($tags) > 0) {
                $posts->where(function ($q) use ($tags) {
                    foreach ($tags as $key => $value) {
                        $q->orwhereRaw('tags like (?)', ["%{$value}%"]);
                    }
                });
            }
        } else {
            $posts = Post::where('status', 1)->where('cat_id', $id)->orderby('created_at', 'desc')->where('type', 1);
            if (isset($tags) && sizeof($tags) > 0) {
                $posts->where(function ($q) use ($tags) {
                    foreach ($tags as $key => $value) {
                        $q->orwhereRaw('tags like (?)', ["%{$value}%"]);
                    }
                });
            }
        }
        $count_load = intval($request->input('load'));
        $num_record = 6 + $count_load * 6;
        $posts = $posts->take($num_record)->get();
        $posts = $posts->take($num_record)->get();
        return view('fontend.partials.list-news', ['posts' => $posts, 'c_menu' => $menu]);
    }

    public function getOption(Request $request)
    {
        $id_menu = $request->input('menu');
        $menu = MenuHeader::find($id_menu);
        if ($menu == null) return abort(404);
        $category = Category::where('id', $request->input('query'))
            ->where('status', 1)->first();
        $tag = Tag::find($request->input('tag'));
        $cats = $menu->category()->where('status', 1)->get();
        $tags = $menu->tag()->where('status', 1)->get();
        return view('fontend.partials.option-news', ['category' => $category, 'cats' => $cats, 'tags' => $tags, 'tag' => $tag]);
    }

    public function getDetail($slug, $cat, $post)
    {
        $menu = MenuHeader::where('slug', $slug)->where('status', 1)->first();
        if ($menu == null) return abort(404);
        $cat = Category::where('slug', $cat)->where('menu_id', $menu->id)->where('status', 1)->first();
        if ($cat == null) return abort(404);
        $post = Post::where('status', 1)->where('slug', $post)->where('cat_id', $cat->id)->first();
        if ($post == null) return abort(404);
        $cats = Category::where('status', 1)->where('menu_id', $menu->id)->get();
        $sc = Section::where('status', 1)->where('page_id', 1)->first();
        $ct = Content::where('status', 1)->where('section_id', 1)->get();
        $info = Webinfo::whereIN('code', ['news_detail_section_1', 'news_detail_section_2', 'news_detail_section_3', 'comment_note'])
            ->where('status', 1)->get();
        $news_detail_section_1 = $info->where('code', 'news_detail_section_1')->first();
        $news_detail_section_2 = $info->where('code', 'news_detail_section_2')->first();
        $news_detail_section_3 = $info->where('code', 'news_detail_section_3')->first();
        $comment_note = $info->where('code', 'comment_note')->first();
        $comments = Comment::where('post_id', $post->id)->where('status', 1)->where('comment_id', null)->get();
        $tags = Tag::where('status', 1)->where('menu_id', $menu->id)->get();
        $posts = Post::where('status', 1)->whereIn('cat_id', $cats->pluck('id')->all())->where('type', 1)->where('slug', '<>', $post->slug)->take(5)->get();
        $r_posts = Post::where('status', 1)->whereIn('cat_id', $cats->pluck('id')->all())->where('slug', '<>', $post->slug)->orderby('created_at', 'desc')->where('type', 1);
        $r_posts->where(function ($q) use ($post) {
            $q->orwhere('cat_id', $post->cat_id);
            foreach ($post->array_tag as $key => $value) {
                $q->orwhereRaw('tags like (?)', ["%{$value}%"]);
            }
        });
        $r_posts = $r_posts->take(5)->get();

        return view('fontend.page.news-detail', [
            'comments' => $comments, 'scs' => $sc, 'cts' => $ct, 'post' => $post, 'cat' => $cat,
            'comment_note' => $comment_note, 'posts' => $posts, 'news_detail_section_1' => $news_detail_section_1,
            'news_detail_section_2' => $news_detail_section_2, 'r_posts' => $r_posts,
            'news_detail_section_3' => $news_detail_section_3, 'tags' => $tags, 'c_menu' => $menu
        ]);
    }

    public function register()
    {
        if (\Auth::check()) {
            return redirect()->route('home');
        }
        $info = Webinfo::whereIN('code', ['reg_section_1', 'reg_section_2', 'reg_section_3', 'reg_section_4'])
            ->where('status', 1)->get();
        $reg_section_1 = $info->where('code', 'reg_section_1')->first();
        $reg_section_2 = $info->where('code', 'reg_section_2')->first();
        $reg_section_3 = $info->where('code', 'reg_section_3')->first();
        $reg_section_4 = $info->where('code', 'reg_section_4')->first();
        return view('fontend.page.register-oshc', ['reg_section_1' => $reg_section_1, 'reg_section_2' => $reg_section_2, 'reg_section_3' => $reg_section_3, 'reg_section_4' => $reg_section_4]);
    }

    public function postRegister(Request $request)
    {
        if (\Auth::check()) return redirect()->back();
        $arr_data = $request->all();
        $check = User::where('email', $arr_data['email'])->first();
        if ($check != null) {
            Session::flash('error-reg-web', Lang::get('register.msg.error_mail'));
            return redirect()->back();
        }
        $user_data = [];
        $user_data['name'] =  $arr_data['name'];
        $user_data['email'] =  $arr_data['email'];
        $user_data['status'] =  2;
        $user_data['role'] =  'agent';
        $user_data['address'] = $arr_data['address_1'];
        $user_data['address_1'] = $arr_data['address_2'];
        $user = User::create($user_data);

        if ($user != null) {
            $contact['name'] = $arr_data['contact_person'];
            $contact['position'] = $arr_data['title'];
            $contact['status'] =  1;
            $person = Person::create($contact);
        } else {
            Session::flash('error-reg-web', Lang::get('register.msg.error'));
            return redirect()->back();
        }


        if ($user != null && $person != null) {
            $info_data['user_id'] = $user->id;
            $info_data['tel_1'] =  $arr_data['tel_1'];
            $info_data['tel_2'] =  $arr_data['tel_2'];
            $info_data['country'] =  $arr_data['country'];
            $info_data['registered_date'] =  date('d/m/Y');
            $info_data['contact_person'] =  $person->id;
            $info_data['note'] =  $arr_data['note'];
            $info = Info::create($info_data);
        } else {
            Session::flash('error-reg-web', Lang::get('register.msg.error'));
            return redirect()->back();
        }
        Session::flash('success-reg-web', Lang::get('register.msg.success_reg'));
        return redirect()->back();
    }
}
