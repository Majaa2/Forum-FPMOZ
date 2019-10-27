<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Thread;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
   
    public function create(Request $request)
    {
        $id = $request->id;
        $comments = new Comments();
        $comments->fill($request->all());
        $comments->user_id = Auth::user()->id;
        $comments->text = $request->text;
        $comments->thread_id = $id;
        $comments->save();

        return redirect('/threads/thread/'.$id)->with('success');
    }

   
   
    public function delete($id)
    {
        $comment = Comments::find($id);
        $thread = DB::table('comments')
        ->select('thread_id')
        ->where('id','=',$id)
        ->first();
        $tid = $thread->thread_id;
        $comment->delete();

        return redirect('/threads/thread/'.$tid)->with('success','Komentar je uspješno izbrisan');
    }
}
