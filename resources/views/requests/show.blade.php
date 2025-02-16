@extends('layouts.main')
@section('content')
<a href="{{route('requests.index')}}" class="btn btn-dark ">Back</a>

<h1 class="text-center my-4">Request for <span class="text-primary">{{$rest->title}}</span> </h1>
    <h3>Resquest from : <span class="text-primary">{{$user->name}}</span> </h3>
    <h3>Email : <span class="text-primary"> {{$user->email}}</span> </h3>

    <h3>Title : <span class="text-primary">{{$rest->title}}</span></h3>
    <h3>Address : <span class="text-primary">{{$rest->address}}</span></h3>
    <h3>Price : <span class="text-primary">{{$rest->price}}</span></h3>
    <h3>Rate : <span class="text-primary">{{$rest->rate}}</span></h3>
    <h3>TimeTable : <span class="text-primary">{{$rest->hours}}</span></h3>

    <div class=" p-4">
        <div class="card p-3">
            <h3>Post image</h3>
            <img src="{{$rest->post->first()->path}}" alt="" class="card-img-top" style="width: 18rem;">
        </div>
    </div>

    <div class="citiesContainer d-flex justify-content-flex-start m-3 alert alert-dark">
        <h3>Proofs </h3>
      
        @foreach ($proofs as $proof)
        <div class="card" style="width: 18rem;">
          <img src="{{url($proof->path)}}" class="card-img-top" alt="...">
        
          
          </div> 
          @endforeach
  
      </div>
    <div class="citiesContainer d-flex justify-content-flex-start m-3 alert alert-dark">
        <h3>Menu </h3>
      
        @foreach ($menus as $menu)
        <div class="card" style="width: 18rem;">
          <img src="{{url($menu->path)}}" class="card-img-top" alt="...">
        
          
          </div> 
          @endforeach
  
      </div>
          
   
  
  
    <div class="citiesContainer d-flex justify-content-flex-start m-3">
        
        <h3>Slider </h3>
      @foreach ($photos as $photo)
      <div class="card" style="width: 18rem;">
          <img src="{{url($photo->path)}}" class="card-img-top" alt="...">
         
          </div>
      @endforeach
    </div>


    <div class="d-flex m-4" style="justify-content: space-evenly">
         
        <a href="{{route('rest.accept',$rest->id)}}" class="btn btn-success" style="width: 10rem">Accept</a>

    </div>
    
@endsection