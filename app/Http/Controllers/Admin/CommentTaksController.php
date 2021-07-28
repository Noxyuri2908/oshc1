<?php

namespace App\Http\Controllers\Admin;

use App\Admin\CommentsTask;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentTaksController extends Controller
{
    //

    public function updateCommentTasks(Request $request)
    {
        $id = $request->get('id');
        $commentTasks = CommentsTask::find($id);

        $data = [
            'comment' => $request->get('comment'),
        ];

        $commentTasks->update($data);

    }

    public function deleteCommentTasks(Request $request)
    {
        CommentsTask::destroy($request->get('id'));
    }

    public function updateSeeCommentTasks(Request $request)
    {
        $comment_id = $request->get('comment_id');
        CommentsTask::where('id', $comment_id)->update(['see' => 1]);

        $countTasks = \Illuminate\Support\Facades\DB::table('comments_tasks')
            ->where('comments_tasks.send_to_staff_id', Auth::user()->id)
            ->where('see', 0)
            ->get();
        return response()->json(['number_noti' => $countTasks->count()]);
    }

    public function formNotifications(){
        $commentTasks = DB::table('follows')
            ->select('*')
            ->rightJoin('comments_tasks', 'comments_tasks.follow_id', 'follows.id')
            ->where('comments_tasks.send_to_staff_id', Auth::user()->id)
            ->orderBy('date', 'desc')
            ->get();

        $countComments = DB::table('comments_tasks')
            ->where('comments_tasks.send_to_staff_id', Auth::user()->id)
            ->where('see', 0)
            ->count();

        return view('CRM.elements.Notifications.comments', compact(
            'countComments',
            'commentTasks'
            ));
    }

    public function autoUdpateFormNotifications()
    {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        while (true) {

            $commentTasks = DB::table('follows')
                ->select('*')
                ->rightJoin('comments_tasks', 'comments_tasks.follow_id', 'follows.id')
                ->where('comments_tasks.send_to_staff_id', Auth::user()->id)
                ->orderBy('date', 'desc')
                ->get();

            $countComments = DB::table('comments_tasks')
                ->where('comments_tasks.send_to_staff_id', Auth::user()->id)
                ->where('see', 0)
                ->get();

            $countComments = $countComments->count();

            $viewRender = view('CRM.elements.Notifications.comment', compact(
                'commentTasks'
            ))->render();

            $viewRenderCount = view('CRM.elements.Notifications.count-noti', compact(
                'countComments'
            ))->render();

            $view = json_encode($viewRender);
            $count = json_encode($viewRenderCount);

            echo "event: ping\n";
            echo 'data: {"view": '.$view.', "count" : '.$count.'}';
            echo "\n\n";

            ob_flush();
            flush();

            if ( connection_aborted() ) break;

            sleep(1);
        }
    }


}
