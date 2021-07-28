<?php
namespace App\Http\ViewComposers;
use App\Admin\CommentsTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NavBarViewComposer {

    public $commentTasks = '';
    public function __construct()
    {
        $commentTasks = CommentsTask::select('comment')->where('send_to_staff_id', Auth::user()->id)->with('follow');
    }

    public function compose(View $view)
    {
        $view->with('commentTasks', end($this->commentTasks));
    }
}
