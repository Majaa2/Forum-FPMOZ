@extends ('layouts.font')

@section('content')
<div class="container" style="padding:5%">
  <div class="row">
    <div class="col-md-6 img">
      <img width="75%" height="75%" src="http://www.coastalbend.edu/uploadedImages/CBC/Content/Student_Services/Title_V/student_working_on_laptop_anim_500_clr_1849%20(1).gif"  style= 'text-align:center;' alt="" class="img-rounded">
    </div>
    <div class="col-md-6" style="border-left:3px solid #ded4da;">
      <blockquote>
        <h5>{{$data['user']->name}}</h5>
        
      </blockquote>
      <p style=" font-size:15px; font-weight:bold;">
        {{$data['user']->email}}
        @if (Auth::check() && Auth::user()->id== $data['user']->id)
        <button  type="button" class="btn btn-outline-success"><a href="{{ route('users.edit', $data['user']->id )}}">Uredi</a></button>
       
        @endif
        <br>

         <br>
         <small><cite title="Source Title"><i class="icon-map-marker">Pristupio: {{$data['user']->created}}</i></cite></small>
      </p>
    </div>
 
  </div>
  <br>
  <hr>
  @if($data['threads'])
        @foreach($data['threads'] as $thread)
        <div class="card">
            <div class="card-header">
                 {{$thread->name}} ({{$thread->subject}})
                 <a class ="float-right " href="{{ route('threads.thread', $thread->id )}}" class="btn btn-primary">Opširnije</a>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>{{$thread->text}}</p>
                    <footer class="blockquote-footer"> <cite>{{$thread->uname}}@ {{$thread->updated}}</cite></footer>
                </blockquote>
            </div>
        </div>
        <br>
            
            @endforeach    
            {{$data['threads']->links()}}  
        
    @else
        <p>Nema objava</p>
    @endif
</div>
       
       
       
@endsection