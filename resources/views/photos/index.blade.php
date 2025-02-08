@extends('layouts.main')
@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
  </div>

    @endif 

    <h1 class="text-center my-4">Clear Photos</h1>
    <div class="d-flex " style="justify-content: space-evenly; flex-wrap:wrap; gap:20px;">
        <a href="{{route('clear',['cities','city_id'])}}" class="btn btn-primary">Cities ({{$cities}})</a>
        <a href="{{route('clear',['places','place_id'])}}" class="btn btn-success">Places ({{$places}})</a>
        <a href="{{route('clear',['restaraunts','restaruant_id'])}}" class="btn btn-danger">Restaraunts ({{$rests}})</a>
        <a href="{{route('clear',['hotels','hotel_id'])}}" class="btn btn-info">Hotels ({{$hotels}})</a>
        <a href="{{route('clear',['traditions','tradition_id'])}}" class="btn btn-dark">Traditions ({{$trads}})</a>
    </div>

@endsection
