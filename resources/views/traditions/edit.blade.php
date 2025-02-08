@extends('layouts.main')
@section('title') Update-tradition
@endsection
@section('content')
<h1 class="text-center m-3">Update Tradition</h1>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
  </div>

    @endif
    <div class="create-tradition">
        <img src="{{$trad->photo->first()->path}}" class="card-img-center m-3" alt="..." style="width: 40%">
  
        <form method="POST" action="{{route('traditions.update',$trad->id)}}" enctype="multipart/form-data" class="m-4" style="width:60%" >
            @csrf
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control"  name="title" value="{{$trad->title}}">
           </div>
           
              <div class="form-group">
                <label for="description">description</label>
                <textarea class="form-control" name="description"  rows="3">{{$trad->description}} </textarea>
              </div>
             
                <div class="form-group">
                  <label for="tradition_Photo">Tradition photo</label>
                  <input type="file" class="form-control-file" name="tradition_Photo" >
                </div>

             <button type="submit" class="btn btn-primary">Update</button>

              </form>
         
    </div>
   
    

@endsection