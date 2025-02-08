@extends('layouts.main')
@section('title') Update-place
    
@endsection
@section('content')
<h1 class="text-center mb-4">Update Place</h1>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
  </div>

    @endif
<form method="POST" action="{{route('places.update',$place->id)}}" class="m-4 " enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="city">Place for</label>
        <select class="form-control" name="city">
          @foreach ($cities as $city)
              <option value="{{$city->id}}" @if ($place->city_id ==$city->id) selected @endif>{{$city->title}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="title">Title </label>
        <input type="text" class="form-control"  name="title" value="{{$place->title}}">
        
      </div>
      <div class="form-group">
        <label for="body">Description (for the place page)</label>
        <textarea class="form-control"  rows="3" name="body" >{{$place->body}}</textarea>
      </div>
      <div class="form-group">
        <label for="address_title">Address </label>
        <input type="text" class="form-control"  name="address_title" value="{{$place->address_title}}">

      </div>

      <div class="form-group">
        <label for="address_details">Address Details </label>
        <textarea class="form-control"  rows="3" name="address_details" placeholder="optional">{{$place->address_details}}</textarea>
      </div>
      <div class="form-group">
        <label for="rate">Rate (from 1 to 5)</label>
        <select class="form-control" name="rate">
          <option @if ($place->rate==1) selected @endif>1</option>
          <option @if ($place->rate==2) selected @endif>2</option>
          <option @if ($place->rate==3) selected @endif>3</option>
          <option @if ($place->rate==4) selected @endif>4</option>
          <option @if ($place->rate==5) selected @endif>5</option>
        </select>
      </div>
      <h3 class="mt-2 mb-2">Post</h3>
      <img src="{{$postPhoto->path}}" class="card-img-top mb-2" alt="..." style="width: 50%">
      <div class="form-group">
        <label for="postPhoto">Post photo</label>
        <small  class="form-text text-muted">recommended 600×400 px</small>

        <input type="file" class="form-control-file" name="postPhoto" >
      </div>

      <div class="form-group">
        <label for="post_title">Post title </label>
        <input type="text" class="form-control"  name="post_title" value="{{$place->post_title}}">

      </div>

      <div class="form-group">
        <label for="post_description">Post description  </label>
        <textarea class="form-control"  rows="3" name="post_description" >{{$place->post_description}} </textarea>
      </div>
      <h3 class="mt-2 mb-2">Features</h3>
      <img src="{{asset('images/screens/placeFeatures.png')}}" class="card-img-top mb-2" alt="..." style="width: 50%">
      <div class="form-group">
        <label for="features">Features   </label>
        <textarea class="form-control"  rows="3" name="features" placeholder="feat1
feat2
feat3..">{{$place->features}} </textarea>
      </div>
       {{-- prices --}}
       <h3 class="mt-2 mb-2">Prices (op)</h3>
       <img src="{{asset('images/screens/prices.png')}}" class="card-img-top mb-2" alt="..." style="width: 50%">
       <div class="form-row">
         <div class="form-group col-md-6">
           <label for="egyptions">For egyptions</label>
           <input type="text" class="form-control" name="egyptions" placeholder="description" @if($place->prices !=null )value="{{$place->prices->egyptions}}" @endif>
         </div>
         
         <div class="form-group col-md-2">
           <label for="epyption_price">price</label>
           <input type="text" class="form-control" name="epyption_price" placeholder="price(int)"@if ($place->prices != null)
               
           value="{{$place->prices->epyption_price}}" @endif>
         </div>
       </div>
 
       <div class="form-row">
         <div class="form-group col-md-6">
           <label for="egyptions">For foreigners</label>
           <input type="text" class="form-control" name="foreigners" placeholder="description" @if ($place->prices != null) value="{{$place->prices->foreigners}}" @endif>
         </div>
         
         <div class="form-group col-md-2">
           <label for="foreigners_price">price</label>
           <input type="text" class="form-control" name="foreigners_price" placeholder="price(int)" @if ($place->prices != null) value="{{$place->prices->foreigners_price}}" @endif>
         </div>
       </div>
 
       <div class="form-row">
         <div class="form-group col-md-6">
           <label for="entry">free entry</label>
           <input type="text" class="form-control" name="entry" placeholder="description" @if ($place->prices != null) value="{{$place->prices->entry}}" @endif>
         </div>
         
         <div class="form-group col-md-2">
           <label for="entry_price">price </label>
           <input type="text" class="form-control" name="entry_price" placeholder="price(int)" @if ($place->prices != null) value="{{$place->prices->entry_price}}" @endif>
         </div>
       </div>
 
 
       <img src="{{asset('images/screens/timeTable.png')}}" class="card-img-top mb-2" alt="..." style="width: 50%">
 
      <div class="form-group">
        <label for="timeTables">Time Table   </label>
        <textarea class="form-control"  rows="3" name="timeTables" placeholder="if exists"> {{$place->timeTables}} </textarea>
      </div>
<button class="btn btn-primary">Update</button>
</form>
@endsection