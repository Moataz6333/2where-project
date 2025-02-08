@extends('layouts.main')
@section('content')

<h1 class="text-center my-4">Photos for {{$rest->title}} </h1>
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

    <div class="row">
        <form method="POST" enctype="multipart/form-data" action="{{route('rests.slider',$rest->id)}}" class="m-4 bg-light p-3">
            @csrf
            <div class="form-group">
              <label for="mainPhoto">Slider Photo</label>
            <small  class="form-text text-muted">recommended 600*390 px</small>
        
              <input type="file" class="form-control-file" name="mainPhoto[]" multiple required>
            </div>
            <button class="btn btn-primary">Submit</button>
          </form>
          {{-- menue --}}
          <form method="POST" enctype="multipart/form-data" action="{{route('rests.menu',$rest->id)}}" class="m-4 bg-light p-3">
            @csrf
            <div class="form-group">
              <label for="menuPhoto">Menu Photo (if exists)</label>
            <small  class="form-text text-muted">recommended 600*390 px</small>
        
              <input type="file" class="form-control-file" name="menuPhoto[]" multiple required>
            </div>
            <button class="btn btn-primary">Submit</button>
          </form>
         
           
    </div>

   
    <div class="citiesContainer d-flex justify-content-flex-start m-3 alert alert-dark">
      
      @foreach ($menus as $menu)
      <div class="card" style="width: 18rem;">
        <img src="{{url($menu->path)}}" class="card-img-top" alt="...">
        <small class="pl-2">Menu</small>
        <form method="POST" action="{{route('rests.slider_update',$menu->id)}}" enctype="multipart/form-data"  class="m-2">
            @csrf
            <div class="form-group">
             
              <input type="file" class="form-control-file" name="mainPhoto" required>
            </div>
            <button class="btn btn-primary d-inline">Update</button>
          </form>
          <form action="{{route('rests.slider_delete',$menu->id)}}" method="POST" class="m-2 d-inline" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>

          </form>
        </div> 
        @endforeach

    </div>
        
 


  <div class="citiesContainer d-flex justify-content-flex-start m-3">
    @foreach ($photos as $photo)
    <div class="card" style="width: 18rem;">
        <img src="{{url($photo->path)}}" class="card-img-top" alt="...">
        <form method="POST" action="{{route('rests.slider_update',$photo->id)}}" enctype="multipart/form-data"  class="m-2">
            @csrf
            <div class="form-group">
             
              <input type="file" class="form-control-file" name="mainPhoto" required>
            </div>
            <button class="btn btn-primary">Update</button>
          </form>
          <form action="{{route('rests.slider_delete',$photo->id)}}" method="POST" class="m-2" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>

          </form>
        </div>
    @endforeach
  </div>


@endsection