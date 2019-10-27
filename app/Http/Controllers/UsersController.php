<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Hash;
use Illuminate\Http\Request;
use App\User;



class UsersController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
        ->select('users.id AS id','users.name AS name', 'users.email AS email','users.password AS password')
        ->where('users.type', '=', 'user' )
        ->orderBy('name','ASC')
        ->paginate(15);
        return view('users.index')->with('users',$users);
        
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with('user',$user);
    }

    public function update(Request $request, $id)
    {
        $user= User::find($id);
        $user->fill($request->all());
        
        $user->save();

        return redirect('/users')->with('success','Korisnik je uspješno promijenjena');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success','Korisnik je uspješno izbrisana');
    }

    
    public function prof($id)
    {
    $user = DB::table('users')
    ->select('users.id AS id','users.name AS name', 'users.email AS email','users.password AS password','users.created_At AS created')
    ->where('users.id', '=', $id)->first();
    
    $threads = DB::table('threads')
        ->join('users', 'threads.user_id', '=', 'users.id')
        ->select('threads.id AS id','threads.subject AS subject','threads.name AS name', 'threads.text AS text','users.name AS uname','users.id AS uid', 'threads.created_at AS created','threads.updated_at AS updated','threads.user_id AS tuid')
        ->where('threads.user_id', '=', $id)
        ->paginate(15);

    $data=array();
    $data['user']= $user;
    $data['threads']= $threads;

    return view('/users/profile')->with('data',$data);
    }
}
