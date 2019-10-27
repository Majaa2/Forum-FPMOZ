@extends('layouts.font')

@section('content')

    @if($users)
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Ime i prezime</th>
            <th scope="col">Email</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        
            <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td><a href="{{ route('users.edit', $user->id )}}" class="btn btn-primary btn-sm ">Uredi</a>
            <a href="{{ route('users.delete', $user->id )}}" class="btn btn-danger btn-sm ">Izbriši</a>
            </td>
            </tr>
            @endforeach   
            {{$users->links()}}   
        </tbody>
        </table>
    @else
        <p>Nema korisnika</p>
    @endif
    @endsection