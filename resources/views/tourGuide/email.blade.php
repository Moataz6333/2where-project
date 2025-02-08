@extends('layouts.main')
@section('content')
<a href="{{route('tourGuide.index')}}" class="btn btn-dark ">Back</a>

<h2 class="text-center my-2">Email to <span style="text-decoration: underline; font-weight: 700;">{{$tourGuide->user->name}} </span></h2>
    <form action="{{route('tourGuide.send',$tourGuide->id)}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Title :</label>
            <input type="text" class="form-control" name="title" required>
         </div>
         <div class="form-group">
            <label for="description">Body :</label>
            <textarea name="body" id="body" cols="10" rows="3"  class="form-control" required></textarea>
         </div>
         <button type="submit" class="btn btn-primary">Send</button>
    </form>
    
@endsection