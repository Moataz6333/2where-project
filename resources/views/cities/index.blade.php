
@extends('layouts.main')
@section('title')  Cities  @endsection

@section('content')

    <h1 class="text-center mb-4">Cities</h1>
    <div class="d-flex justify-content-center">
            <a href="{{route('cities.create')}}" class="btn btn-success  text-center " >Add City</a>

    </div>
    @if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
  </div>

    @endif
    <div class="citesContainer d-flex justify-content-center mt-3">
        @foreach ($cities as $city)
        <div class="card p-2 mb-3" style="width: 20rem">
           
            <div class="card-body">
              <h5 class="card-title">{{$city->title}}</h5>
            </div>
        <img src="{{url($city->photos->first()->path)}}" class="card-img-top" alt="..." style="width: 100%" >

           
            <div class="card-body">
              <a href="{{route('cities.edit',$city->id)}}" class="btn btn-primary ">Update</a>
              <a href="{{route('cites.photos',$city->id)}}" class="btn btn-success">Photos</a>
              <a href="{{route('traditions.index',$city->id)}}" class="btn btn-dark">Traditions</a>
              <a href="{{route('safty.index',$city->id)}}" class="btn btn-info mt-2">Safty</a>
              
              <form action="{{route('cities.destroy',$city->id)}}" method="POST" class="d-inline-block mt-2" onsubmit="return confirmDelete()">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-2">Delete</button>

              </form>
            </div>
          </div>
            
        @endforeach
      
        
    </div>




    <script>function confirmDelete() {
        return confirm('Are you sure you want to delete this City?');
    }
    </script>
@endsection