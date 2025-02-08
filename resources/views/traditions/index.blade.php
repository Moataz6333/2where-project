@extends('layouts.main')
@section('title') Traditions
@endsection
@section('content')
<h1 class="text-center m-3">Traditions for {{$city->title}}</h1>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
  </div>

    @endif
  <div class="d-flex justify-content-center">
        <a href="{{route('traditions.create',$city->id)}}" class="text-center btn btn-success">Add Tradition</a>

  </div>
    <div class="citiesContainer m-4 d-flex">
      @foreach ($traditions as $trad)
      <div class="card" style="width: 18rem;">
        <img src="{{$trad->photo->first()->path}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$trad->title}}</h5>
          <a href="{{route('traditions.edit',$trad->id)}}" class="btn btn-primary">Update</a>
          
          <form action="{{route('traditions.destroy',$trad->id)}}" method="POST" class="d-inline-block" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>

          </form>
        </div>
      </div>
      @endforeach
    </div>
    

@endsection