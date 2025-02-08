@extends('layouts.main')
@section('content')
<a href="{{route('dashboard')}}" class="btn btn-dark m-2">Back</a>
<h1 class="text-center m-3">API</h1>
     
<div class="d-flex "style="justify-content:space-evenly">
    <a href="{{route('api.get')}}" class="btn btn-primary">Get Api</a>
    <a href="{{route('api.post')}}" class="btn btn-danger">Post Api</a>
</div>

  
    
    

  










@endsection