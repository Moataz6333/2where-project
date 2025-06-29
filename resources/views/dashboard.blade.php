@extends('layouts.main')
@section('content')

<h1 class="m-4 text-center">Welcome to Dashboard</h1>
<div class="d-flex justify-content-around mt-5" style="flex-wrap: wrap; gap:20px; ">
    <a href="{{route('cities.index')}}" class="btn btn-primary" style="width: 10rem;">Cities</a>
    <a href="{{route('api.view')}}" class="btn btn-danger" style="width: 10rem;">Api</a>
    <a href="{{route('plans.index')}}" class="btn btn-success" style="width: 10rem;">Plans</a>

       
  
</div>
    <div class="d-flex justify-content-around mt-5" style="flex-wrap: wrap; gap:20px; ">
        <a href="{{route('subs.index')}}" style="width: 10rem;" class="btn btn-info">Subsecripers</a>
        <a href="{{route('clear-photos')}}" style="width: 10rem;" class="btn btn-warning">Clear photos</a>
        <a href="{{route('requests.index')}}" class="btn btn-dark" style="width: 10rem;" >Requestes ({{$requests}})</a>

    </div>
    <div class="d-flex justify-content-around mt-5" style="flex-wrap: wrap; gap:20px; ">
        <a href="{{route('tourGuide.index')}}" style="width: 10rem;" class="btn btn-primary">Tour-Guides({{$tourGuides}})</a>
        <a href="{{route('companies.index')}}" style="width: 10rem;" class="btn btn-secondary">Companies</a>
       
    </div>
  
    
@endsection