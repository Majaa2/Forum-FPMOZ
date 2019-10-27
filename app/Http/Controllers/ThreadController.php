<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Thread;
use App\User;
use App\Comments;




class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = DB::table('threads')
        ->join('users', 'threads.user_id', '=', 'users.id')
        ->select('threads.id AS id','threads.subject AS subject','threads.name AS name', 'threads.text AS text','threads.user_id','users.name AS uname', 'threads.created_at AS created','threads.updated_at AS updated')
        ->orderBy('created','DESC')
        ->paginate(15);
        return view('threads.index')->with('threads',$threads);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/threads/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $thread = new Thread();
        $thread->fill($request->all());
        $thread->user_id=Auth::user()->id;
        $thread->subject = $request->subject;
        $thread->name =  $request->name;
        $thread->text = $request->text;
       
        $thread->save();

        return redirect('/threads')->with('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thread =Thread::find($id);
        return view('threads.edit')->with('thread',$thread);
    }

    public function thread($id)
    {
        //$thread = Thread::find($id);
        $thread = DB::table('threads')
        ->join('users', 'threads.user_id', '=', 'users.id')
        ->select('threads.id AS id','threads.subject AS subject','threads.name AS name', 'threads.text AS text','users.name AS uname','users.id AS uid', 'threads.created_at AS created','threads.updated_at AS updated','threads.user_id')
        ->where('threads.id', '=', $id )->first();
        
        $comments = DB::table('comments')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->join('threads', 'comments.thread_id', '=', 'threads.id')
        ->select('comments.id AS cid','comments.text AS text','users.name AS  uname','users.id AS uid', 'comments.created_at AS created','comments.updated_at AS updated','comments.user_id')
        ->where('threads.id', '=', $id )
        ->paginate(15);

        $data=array();
        $data['thread']= $thread;
        $data['comments']= $comments;

        return view('/threads/th')->with('data',$data);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $thread= Thread::find($id);
        $thread->fill($request->all());
        
        $thread->save();

        return redirect('threads/thread/'. $id)->with('success','Objava je uspješno promijenjena');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
    public function delete($id)
    {
        $thread = Thread::find($id);
        $thread->delete();

        return redirect('/threads')->with('success','Objava je uspješno izbrisana');
    }

    public function search(Request $request){
        $search = $request->get('search');
        $threads = DB::table('threads')
        ->join('users', 'threads.user_id', '=', 'users.id')
        ->select('threads.id AS id','threads.user_id','threads.subject AS subject','threads.name AS name', 'threads.text AS text','users.name AS uname','users.id AS uid', 'threads.created_at AS created','threads.updated_at AS updated')
        ->where('threads.subject', 'like', '%'.$search.'%' )
            ->orwhere('threads.name', 'like', '%'.$search.'%')
            ->orwhere('users.name', 'like', '%'.$search.'%')
        ->paginate(15);
        return view('threads/index')->with('threads',$threads);
    }
}
