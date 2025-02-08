@extends('layouts.main')
@section('title') hotels
    
@endsection

@section('content')
<h1 class="text-center m-3">Hotels for {{$city->title}} </h1>
<div class="d-flex justify-content-center">
    <a href="{{route('hotels.create',$city->id)}}" class="btn btn-success  text-center " >Add Hotel</a>

</div>
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif
<div class="citiesContainer m-4 d-flex" style="flex-wrap: wrap;">

    @foreach ($hotels as $hotel)
    <div class="card" style="width: 18rem;">
        <img src="{{$hotel->post->first()->path}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$hotel->title}}</h5>
          <a href="{{route('hotels.edit',$hotel->id)}}" class="btn btn-primary">Update</a>
          <a href="{{route('hotels.photos',$hotel->id)}}" class="btn btn-success">Photos</a>
          <form action="{{route('hotels.destroy',$hotel->id)}}" method="POST" class="d-inline-block" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>

          </form>          

        </div>
      </div>
        
    @endforeach
    </div>
    
@endsection