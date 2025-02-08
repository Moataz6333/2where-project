@extends('layouts.main')
@section('title') edit-city
    
@endsection
@section('content')
<h1 class="text-center mb-4">Update City</h1>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
    </div>
    @endif
<form method="POST" action="{{route('cities.update',$city->id)}}" class="m-4">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" name="title" value="{{$city->title}}" >
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control"  rows="3" name="description">{{$city->description}}</textarea>
    </div>
    <div class="form-group">
        <label for="rate">Rate (from 1 to 5)</label>
        <select class="form-control" name="rate" >
          <option @if($city->rate==1) selected @endif>1</option>
          <option @if($city->rate==2) selected @endif>2</option>
          <option @if($city->rate==3) selected @endif>3</option>
          <option @if($city->rate==4) selected @endif>4</option>
          <option @if($city->rate==5) selected @endif>5</option>
        </select>
      </div>
      <div class="form-group">
        <label for="safty">Safty description:</label>
        <img src="{{asset('images/screens/safty1.png')}}" class="card-img-top mb-2" alt="...">
        <textarea class="form-control"  rows="3" name="safty">{{$city->safty}}</textarea>
      </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
@endsection