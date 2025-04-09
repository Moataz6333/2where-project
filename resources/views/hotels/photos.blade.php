@extends('layouts.main')
@section('content')

<h1 class="text-center my-4">Photos for {{$hotel->title}} </h1>
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

    <div class="row">
        <form method="POST" enctype="multipart/form-data" action="{{route('hotels.slider',$hotel->id)}}" class="m-4 bg-light p-3">
            @csrf
            <div class="form-group">
              <label for="mainPhoto">Slider Photo</label>
            <small  class="form-text text-muted">recommended 600*390 px</small>
        
              <input type="file" class="form-control-file" name="mainPhoto[]" multiple required>
            </div>
            <button class="btn btn-primary">Submit</button>
          </form>
        
         
           
    </div>




  <div class="citiesContainer d-flex  m-3 flex-wrap">
    @foreach ($photos as $photo)
    <div class="card" style="width: 18rem;">
        <img src="{{url($photo->path)}}" class="card-img-top" alt="...">
        <form method="POST" action="{{route('hotels.slider_update',$photo->id)}}" enctype="multipart/form-data"  class="m-2">
            @csrf
            <div class="form-group">
             
              <input type="file" class="form-control-file" name="mainPhoto" required>
            </div>
            <button class="btn btn-primary">Update</button>
          </form>
          <form action="{{route('hotels.slider_delete',$photo->id)}}" method="POST" class="m-2" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>

          </form>
        </div>
    @endforeach
  </div>


@endsection