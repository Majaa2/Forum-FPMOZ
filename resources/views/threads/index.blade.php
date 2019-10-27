@extends('layouts.font')

@section('content')

    @if($threads)
        @foreach($threads as $thread)
        <div class="card">
            <div class="card-header">
                 {{$thread->name}} ({{$thread->subject}})
                 <a class ="float-right " href="{{ route('threads.thread', $thread->id )}}" class="btn btn-primary">Opširnije</a>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>{{$thread->text}}</p>
                    <footer class="blockquote-footer"> <cite><a href="{{ route('users.user', $thread->user_id)}}">{{$thread->uname}}</a>@ {{$thread->updated}}</cite></footer>
                </blockquote>
            </div>
        </div>
        <br>
            
            @endforeach      
        {{$threads->links()}}
    @else
        <p>Nema objava</p>
    @endif
    @endsection