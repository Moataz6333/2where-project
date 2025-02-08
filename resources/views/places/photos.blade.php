@extends('layouts.main')
@section('title')
Places-Photos
    
@endsection
@section('content')

<h1 class="text-center m-3">Photos for {{$place->title}}</h1>   
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
  </div>

    @endif 
    <form method="POST" enctype="multipart/form-data" action="{{route('places.storePhotos',$place->id)}}" class="m-4 bg-light p-3">
        @csrf
        <div class="form-group">
          <label for="mainPhoto">Slider Photo</label>
        <small  class="form-text text-muted">recommended 1920×920 px</small>

          <input type="file" class="form-control-file" name="mainPhoto[]" multiple required>
        </div>
        <button class="btn btn-primary">Submit</button>
      </form>


      <div class="citiesContainer d-flex justify-content-flex-start m-3" style="flex-wrap: wrap;">
        @foreach ($photos as $photo)
        <div class="card" style="width: 18rem;">
            <img src="{{url($photo->path)}}" class="card-img-top" alt="...">
            <form method="POST" action="{{route('places.updatePhotos',$photo->id)}}" enctype="multipart/form-data"  class="m-2">
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