@extends('layouts.main')
@section('title') hotels
    
@endsection

@section('content')
<h1 class="text-center m-3">Create Hotel </h1>
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<div class="create-tradition">
    <img src="{{asset('images/screens/hotels.png')}}" class="card-img-center m-3" alt="..." style="width: 40%">

    <form method="POST" action="{{route('hotels.store',$city->id)}}" enctype="multipart/form-data" class="m-4" style="width:60%" >
        @csrf
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" required name="title">
       </div>
        <div class="form-group">
          <label for="features">Features</label>
          <input type="text" class="form-control" required name="features" placeholder="feat1 feat2 feat3...">
       </div>
        <div class="form-group">
          <label for="price">price</label>
          <input type="text" class="form-control" placeholder="paragraph" name="price">
       </div>
       <div class="form-group">
        <label for="rate">Rate (from 1 to 5)</label>
        <select class="form-control" name="rate">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
       
          <div class="form-group">
            <label for="address">address</label>
            <textarea class="form-control" name="address" required rows="3" placeholder="in deatails"></textarea>
          </div>
          <div class="form-group">
            <label for="link">Link (op)</label>
            <input type="text" class="form-control" placeholder="if existis" name="link">
         </div>
         
            <div class="form-group">
              <label for="postPhoto">Post photo</label>
              <small  class="form-text text-muted">recommended 650×400 px</small>

              <input type="file" class="form-control-file" name="postPhoto" required>
            </div>

         <button type="submit" class="btn btn-primary">Submit</button>

          </form>
     
</div>



    
@endsection