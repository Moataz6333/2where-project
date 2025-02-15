@extends('layouts.main')
@section('title')Plans
    
@endsection
@section('content')

<h1 class="text-center m-4">Update {{$plan->title}}</h1>
<a href="{{route('plans.index')}}" class="btn btn-dark m-3">Back</a>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<form method="POST" action="{{route('plans.update',$plan->id)}}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">Plan name :</label>
        <input type="text" class="form-control" name="title" value="{{$plan->title}}">
    </div>
    <div class="form-group">
        <label for="description">Plan description :</label>
        <textarea name="description" id="description" cols="10" rows="3" placeholder="optional" class="form-control">{{$plan->description}} </textarea>
    </div>
    <div class="form-group">
        <label for="places">Places :</label>
        <small  class="form-text text-muted">Hold on ctrl to select multiple item</small>
        <select multiple class="form-control" id="places" name="places[]">
            @foreach ($places as $place)
            <option value="{{$place->id}}" @if (  in_array($place->id , $plan_places)) selected
                
            @endif>{{$place->title}}</option>
                
            @endforeach
           
        </select>
    </div>
    <div class="form-group">
        <label for="rests">Restrauants :</label>
        <small  class="form-text text-muted">Hold on ctrl to select multiple item</small>
        <select multiple class="form-control" id="rests" name="rests[]">
            @foreach ($rests as $rest)
            <option value="{{$rest->id}}" @if (in_array($rest->id,$plan_rests))selected
                
            @endif >{{$rest->title}}</option>
                
            @endforeach
           
        </select>
    </div>
    <div class="form-group">
        <label for="hotels">Hotels :</label>
        <small  class="form-text text-muted">Hold on ctrl to select multiple item</small>
        <select multiple class="form-control" id="hotels" name="hotels[]">
            @foreach ($hotels as $hotel)
            <option value="{{$hotel->id}}" @if (in_array($hotel->id,$plan_hotels))selected
                
            @endif >{{$hotel->title}}</option>
                
            @endforeach
           
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>


    
@endsection