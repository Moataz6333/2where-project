@extends('layouts.main')
@section('content')

<h1 class="text-center m-4">Create Plan</h1>
<a href="{{route('plans.index')}}" class="btn btn-dark m-3">Back</a>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<form method="POST" action="{{route('plans.store')}}">
    @csrf

    <div class="form-group">
        <label for="title">Plan name :</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="description">Plan description :</label>
        <textarea name="description" id="description" cols="10" rows="3" placeholder="optional" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="places">Places :</label>
        <small  class="form-text text-muted">Hold on ctrl to select multiple item</small>
        <select multiple class="form-control" id="places" name="places[]">
            @foreach ($places as $place)
            <option value="{{$place->id}}">{{$place->title}}</option>
                
            @endforeach
           
        </select>
    </div>
    <div class="form-group">
        <label for="rests">Restrauants :</label>
        <small  class="form-text text-muted">Hold on ctrl to select multiple item</small>
        <select multiple class="form-control" id="rests" name="rests[]">
            @foreach ($rests as $rest)
            <option value="{{$rest->id}}">{{$rest->title}}</option>
                
            @endforeach
           
        </select>
    </div>
    <div class="form-group">
        <label for="hotels">Hotels :</label>
        <small  class="form-text text-muted">Hold on ctrl to select multiple item</small>
        <select multiple class="form-control" id="hotels" name="hotels[]">
            @foreach ($hotels as $hotel)
            <option value="{{$hotel->id}}">{{$hotel->title}}</option>
                
            @endforeach
           
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


    
@endsection