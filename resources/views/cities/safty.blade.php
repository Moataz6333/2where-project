@extends('layouts.main')
@section('title') Safty
    
@endsection
@section('content')
<h1 class="text-center m-4">Safty for {{$city->title}}</h1>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
    </div>
    @endif
{{-- keys --}}
<h2>Safty Keys</h2>
<img src="{{asset('images/screens/safty2.png')}}" class="card-img-top mb-2" alt="..." style="width: 50%">
<form action="{{route('safty.store',$city->id)}}" class="m-4" method="POST">
    @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" required >
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control"  rows="3" name="description"></textarea>
      </div>
    <button type="submit" class="btn btn-primary">Create</button>

</form>






{{-- update Safty description --}}
<form action="{{route('safty.updateSaftyDescription',$city->id)}}" method="POST" class="m-3">
    @csrf
    <div class="form-group">        
        <img src="{{asset('images/screens/safty1.png')}}" class="card-img-top mb-2" alt="..." style="">

        <label for="safty">Safty description:</label>
        <textarea class="form-control"  rows="3" name="safty">{{$city->safty}} </textarea>
      </div>
    <button type="submit" class="btn btn-primary">Update</button>

</form>


{{-- udated keys --}}
@foreach ($keys as $key)

<form method="POST" action="{{route('safty.update',$key->id)}}" class=" mt-4 mb-3 p-3" style="background-color: #bed6ee">
    @csrf

    <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" value="{{$key->title}}" >
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control"  rows="3" name="description">{{$key->description}}</textarea>
  </div>
<button type="submit" class="btn btn-primary">Update</button>


</form>
<form action="{{route('safty.destroy',$key->id)}}" method="POST" class="m-2" onsubmit="return confirmDelete()">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>

  </form>
    
@endforeach
    
@endsection