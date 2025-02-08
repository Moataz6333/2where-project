@extends('layouts.main')
@section('title') restaruants
    
@endsection

@section('content')
<h1 class="text-center m-3">Restaruants for {{$city->title}} </h1>
<div class="d-flex justify-content-center">
    <a href="{{route('rests.create',$city->id)}}" class="btn btn-success  text-center " >Add Restaruant</a>

</div>
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif
<div class="citiesContainer m-4 d-flex" style="flex-wrap: wrap;">

    @foreach ($rests as $rest)
    <div class="card" style="width: 18rem;">
        <img src="{{$rest->post->first()->path}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$rest->title}}</h5>
          <a href="{{route('rests.edit',$rest->id)}}" class="btn btn-primary">Update</a>
          <a href="{{route('rests.photos',$rest->id)}}" class="btn btn-success">Photos</a>
          <form action="{{route('rests.destroy',$rest->id)}}" method="POST" class="d-inline-block" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>

          </form>          

        </div>
      </div>
        
    @endforeach
    </div>
    
@endsection