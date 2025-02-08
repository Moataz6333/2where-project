@extends('layouts.main')
@section('title') add-city
    
@endsection
@section('content')
<h1 class="text-center mb-4">Add City</h1>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
  </div>

    @endif
<form method="POST" action="{{route('cities.store')}}" class="m-4">
    @csrf
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" name="title" required >
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control"  rows="3" name="description"></textarea>
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
        <label for="safty">Safty description:</label>
        <img src="{{asset('images/screens/safty1.png')}}" class="card-img-top mb-2" alt="...">
        <textarea class="form-control"  rows="3" name="safty"></textarea>
      </div>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
@endsection