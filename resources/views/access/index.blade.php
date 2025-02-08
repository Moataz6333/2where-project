@extends('layouts.main')
@section('title') Accessabiltily
    
@endsection
@section('content')
<h2 class="text-center m-4">Accessabiltily for {{$place->title}}</h2>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
  </div>

    @endif

    @if (!$place->accessability )
    <form method="POST" action="{{route('access.store',$place->id)}}" class="m-3" >
      @csrf
  
          <div class="form-row m-4">
            <div class="col">
          <label for="ramps">Ramps : </label>
  
              <input type="text" class="form-control"  name="ramps" >
            </div>
            </div>
  
          <div class="form-row m-4">
            <div class="col">
              <label for="elevators">Elevators : </label>
  
              <input type="text" class="form-control"  name="elevators" >
            </div>
           
          </div>
          <div class="form-row m-4">
              <div class="col">
              <label for="facilities">Facilities : </label>
                  
              <input type="text" class="form-control"  name="facilities" >
  
              </div>
          </div>
      
      <div class="form-group">
          <label for="description">Description : </label>
          <textarea class="form-control" name="description" rows="3" placeholder="optional"> </textarea>
        </div>
  
    
     
      <button type="submit" class="btn btn-primary">Submit</button>
   </form>

    @else
    <form method="POST" action="{{route('access.update',$place->id)}}" class="m-3" >
      @csrf
  
          <div class="form-row m-4">
            <div class="col">
          <label for="ramps">Ramps : </label>
  
              <input type="text" class="form-control"  name="ramps" value="{{$place->accessability->ramps}}">
            </div>
            </div>
  
          <div class="form-row m-4">
            <div class="col">
              <label for="elevators">Elevators : </label>
  
              <input type="text" class="form-control"  name="elevators" value="{{$place->accessability->elevators}}">
            </div>
           
          </div>
          <div class="form-row m-4">
              <div class="col">
              <label for="facilities">Facilities : </label>
                  
              <input type="text" class="form-control"  name="facilities" value="{{$place->accessability->facilities}}">
  
              </div>
          </div>
      
      <div class="form-group">
          <label for="description">Description : </label>
          <textarea class="form-control" name="description" rows="3" placeholder="optional">{{$place->accessability->description}} </textarea>
        </div>
  
    
     
      <button type="submit" class="btn btn-primary">Submit</button>
   </form>
        
    @endif
    
@endsection