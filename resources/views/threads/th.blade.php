@extends ('layouts.font')
@section('content')
        <form action="{{route('comment.create', $data['thread']->id) }}" method="GET">
            @csrf
           
            <h5 class="h1">{{$data['thread']->name}} ({{$data['thread']->subject}})</h5>
            <p>{{$data['thread']->text}}</p>

              <p class="font-italic font-weight-lighter"><a href="{{ route('users.user', $data['thread']->user_id)}}">{{$data['thread']->uname}}</a>@ {{$data['thread']->updated}}</p>
            @if(Auth::user() && Auth::user() ->id == $data['thread'] ->uid)
                <a href="{{ route('threads.edit', $data['thread']->id )}}" class="btn btn-primary btn-sm ">Uredi</a>
                <a href="{{ route('threads.delete', $data['thread']->id )}}" class="btn btn-danger btn-sm ">Izbriši</a>
           @endif
            <br>
             
        <br>
       
        @if($data['comments'])
            @foreach($data['comments'] as $comment)
            <div class="card">
                    <div class="card-header">
                    <a href="{{ route('users.user', $comment->user_id)}}">{{$comment->uname}}</a>
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                        <p>{{$comment->text}}</p>
                        <footer class="blockquote-footer"> <cite>{{$comment->updated}}</cite></footer>
                        @if(Auth::user() && Auth::user()->id == $comment->uid)
                        <a  href="{{ route('comment.delete',$comment->cid )}}" class="btn btn-danger btn-sm ">Izbriši</a>
                        @endif
                        </blockquote>
                    </div>
                    </div>
                    <br>
        @endforeach
        {{$data['comments']->links()}}
        @endif
        @if (Auth::user())
            <textarea class="form-control" aria-label="With textarea" name="text" required></textarea>  
            <br>
            <button type="submit" class="btn btn-primary">Komentiraj</button>
        @endif
        
        
        </form>
        
       
@endsection