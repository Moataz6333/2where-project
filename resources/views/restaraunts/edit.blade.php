@extends('layouts.main')
@section('title') restaruants
    
@endsection

@section('content')
<h1 class="text-center m-3">Update Restaruant </h1>
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<div class="create-tradition">
    <img src="{{$rest->post->first()->path}}" class="card-img-center m-3" alt="..." style="width: 40%">

    <form method="POST" action="{{route('rests.update',$rest->id)}}" enctype="multipart/form-data" class="m-4" style="width:60%" >
        @csrf
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" value="{{$rest->title}}" name="title">
       </div>
        <div class="form-group">
          <label for="categories">Categories</label>
          <input type="text" class="form-control" value="{{$rest->categories}}" name="categories" placeholder="catefory1 catefory2 catefory3...">
       </div>
        <div class="form-group">
          <label for="price">price</label>
          <input type="text" class="form-control" value="{{$rest->price}}" placeholder="paragraph" name="price">
       </div>
       <div class="form-group">
        <label for="rate">Rate (from 1 to 5)</label>
        <select class="form-control" name="rate">
          <option @if ($rest->rate==1) selected @endif>1</option>
          <option @if ($rest->rate==2) selected @endif>2</option>
          <option @if ($rest->rate==3) selected @endif>3</option>
          <option @if ($rest->rate==4) selected @endif>4</option>
          <option @if ($rest->rate==5) selected @endif>5</option>
        </select>
      </div>
       
          <div class="form-group">
            <label for="address">address</label>
            <textarea class="form-control" name="address"  rows="3" placeholder="in deatails">{{$rest->address}} </textarea>
          </div>
         
            <div class="form-group">
              <label for="postPhoto">Post photo</label>
              <input type="file" class="form-control-file" name="postPhoto" >
            </div>
            <div class="form-group">
              <label for="hours">Opening hours</label>
              <textarea class="form-control" name="hours"  rows="3" placeholder="if exists">{{$rest->hours}} </textarea>
            </div>

         <button type="submit" class="btn btn-primary">Update</button>

          </form>
     
</div>



    
@endsection