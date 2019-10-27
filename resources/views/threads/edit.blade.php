@extends ('layouts.font')
@section('content')
@if(Auth::check())
        <h1>Uredi objavu</h1><br>
        <form action="{{route('threads.update', $thread->id) }}" method="GET">
            @csrf
           
                <div class="form-group">
                    <label for="nazivPredmeta">Unesite naziv predmeta</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="{{$thread->subject}}" required>
                </div>
                <div class="form-group">
                    <label for="name">Unesite naslov objave</label>
                    <input type="text" class="form-control" id="name" name="name"value="{{$thread->name}}" required>
                </div>
                <div class="form-group">
                    <label for="text">Unesite tekst</label>
                    <textarea class="form-control" aria-label="With textarea" id="text" name="text" required>{{$thread->text}}</textarea> 

                </div>
           
            <button type="submit" class="btn btn-primary">Uredi</button>
        </form>
        
        @else
            <script type="text/javascript">
                window.location = "{{ url('/') }}";//here double curly bracket
            </script>
    @endif

@endsection