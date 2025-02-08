@extends('layouts.main')
@section('title') create-tradition
@endsection
@section('content')
<h1 class="text-center m-3">Create Tradition</h1>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
  </div>

    @endif
    <div class="create-tradition">
        <img src="{{asset('images/screens/tradition.png')}}" class="card-img-center m-3" alt="..." style="width: 40%">
  
        <form method="POST" action="{{route('traditions.store',$city->id)}}" enctype="multipart/form-data" class="m-4" style="width:60%" >
            @csrf
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" required name="title">
           </div>
           
              <div class="form-group">
                <label for="description">description</label>
                <textarea class="form-control" name="description" required rows="3"></textarea>
              </div>
             
                <div class="form-group">
                  <label for="tradition_Photo">Tradition photo</label>
                  <input type="file" class="form-control-file" name="tradition_Photo" required>
                </div>

             <button type="submit" class="btn btn-primary">Submit</button>

              </form>
         
    </div>
   
    

@endsection