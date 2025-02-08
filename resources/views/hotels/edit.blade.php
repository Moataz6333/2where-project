@extends('layouts.main')
@section('title') hotels
    
@endsection

@section('content')
<h1 class="text-center m-3">Update Hotel </h1>
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<div class="create-tradition">
    <img src="{{$hotel->post->first()->path}}" class="card-img-center m-3" alt="..." style="width: 40%">

    <form method="POST" action="{{route('hotels.update',$hotel->id)}}" enctype="multipart/form-data" class="m-4" style="width:60%" >
        @csrf
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" value="{{$hotel->title}}" name="title">
       </div>
        <div class="form-group">
          <label for="features">Features</label>
          <input type="text" class="form-control" value="{{$hotel->features}}" name="features" placeholder="feat1 feat2 feat3...">
       </div>
        <div class="form-group">
          <label for="price">price</label>
          <input type="text" class="form-control" placeholder="paragraph" name="price" value="{{$hotel->price}}">
       </div>
       <div class="form-group">
        <label for="rate">Rate (from 1 to 5)</label>
        <select class="form-control" name="rate">
            <option @if ($hotel->rate==1) selected @endif>1</option>
            <option @if ($hotel->rate==2) selected @endif>2</option>
            <option @if ($hotel->rate==3) selected @endif>3</option>
            <option @if ($hotel->rate==4) selected @endif>4</option>
            <option @if ($hotel->rate==5) selected @endif>5</option>
        </select>
      </div>
       
          <div class="form-group">
            <label for="address">address</label>
            <textarea class="form-control" name="address"  rows="3" placeholder="in deatails">{{$hotel->address}} </textarea>
          </div>
          <div class="form-group">
            <label for="link">Link (op)</label>
            <input type="text" class="form-control" placeholder="if existis" name="link" value="{{$hotel->link}}">
         </div>
         
            <div class="form-group">
              <label for="postPhoto">Post photo</label>
              <input type="file" class="form-control-file" name="postPhoto" >
            </div>

         <button type="submit" class="btn btn-primary">Update</button>

          </form>
     
</div>



    
@endsection