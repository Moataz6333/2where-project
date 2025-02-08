@extends('layouts.main')
@section('content')
<a href="{{route('dashboard')}}" class="btn btn-dark m-2">Back</a>

<h1 class="text-center my-3">Requestes</h1>


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
          <a href="{{route('rest.accept',$rest->id)}}" class="btn btn-success">Accept</a>
          <a href="{{route('rest.show',$rest->id)}}" class="btn btn-primary">Show</a>
          <form action="{{route('rests.destroy',$rest->id)}}" method="POST" class="d-inline-block" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>

          </form>          

        </div>
      </div>
        
    @endforeach


    </div>
<div class="citiesContainer m-4 d-flex" style="flex-wrap: wrap;">

    {{-- hotels --}}
    @foreach ($hotels as $hotel)
    <div class="card" style="width: 18rem;">
        <img src="{{$hotel->post->first()->path}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$hotel->title}}</h5>
          <a href="{{route('hotel.accept',$hotel->id)}}" class="btn btn-success">Accept</a>
          <a href="{{route('hotel.show',$hotel->id)}}" class="btn btn-primary">Show</a>
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