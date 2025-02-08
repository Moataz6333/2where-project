@extends('layouts.main')
@section('title')
Cities-Photos
    
@endsection
@section('content')

<h1 class="text-center m-3">Photos for {{$city->title}}</h1>   
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
  </div>

    @endif 
<form method="POST" enctype="multipart/form-data" action="{{route('cities.CreatePhotos',$city->id)}}" class="m-4 bg-light p-3">
    @csrf
    <div class="form-group">
      <label for="mainPhoto">Slider Photo</label>
      <input type="file" class="form-control-file" name="mainPhoto"  required>
    </div>
    <button class="btn btn-primary">Submit</button>
  </form>

  <div class="citiesContainer d-flex justify-content-flex-start m-3">
    @foreach ($photos as $photo)
    <div class="card" style="width: 18rem;">
        <img src="{{$photo->path}}" class="card-img-top" alt="...">
        <form method="POST" action="{{route('cities.UpdatePhotos',$photo->id)}}" enctype="multipart/form-data"  class="m-2">
            @csrf
            <div class="form-group">
             
              <input type="file" class="form-control-file" name="mainPhoto" required>
            </div>
            <button class="btn btn-primary">Update</button>
          </form>
          <form action="{{route('cities.DeletePhotos',$photo->id)}}" method="POST" class="m-2" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>

          </form>
        </div>
    @endforeach
  </div>
@endsection