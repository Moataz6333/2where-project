@extends('layouts.main')
@section('content')
<a href="{{route('subs.index')}}" class="btn btn-dark ">Back</a>
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

    <h1 class="text-center ">Create Email</h1>
 
    <div class="row">
        <form action="{{route('email.send')}}" method="POST" class="col-8">

            @csrf
    
         <div class="form-group">
            <label for="title">Title :</label>
            <input type="text" class="form-control" name="title">
         </div>
         <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" id="description" cols="10" rows="3" placeholder="optional" class="form-control"></textarea>
         </div>
    
         {{-- radio buttons --}}
         <div class="form-group d-flex " style="justify-content: space-evenly">
            <div class="d-flex" style="align-items: center; gap:5px;">
                <input type="radio" name="type" id="r1" value="places">
            <label for="rl">Place</label>
            </div>
            <div class="d-flex" style="align-items: center; gap:5px;">
                <input type="radio" name="type" id="r2" value="rests">
                <label for="r2">Restrauant</label>
    
            </div>
            <div class="d-flex" style="align-items: center; gap:5px;">
    
                <input type="radio" name="type" id="r3" value="hotels">
                <label for="r3">Hotel</label>
            </div>
            <div class="d-flex" style="align-items: center; gap:5px;">
    
                <input type="radio" name="type" id="r4" value="none">
                <label for="r4">None</label>
            </div>
         </div>
    
         <div class="form-group" id="places">
            <label for="places">Places :</label>
            <select multiple class="form-control"  name="places">
                @foreach ($places as $place)
                <option value="{{$place->id}}">{{$place->title}}</option>
                    
                @endforeach
               
            </select>
         </div>
         <div class="form-group" id="rests" >
            <label for="rests">Restrauants :</label>
            <select multiple class="form-control" name="rests">
                @foreach ($rests as $rest)
                <option value="{{$rest->id}}">{{$rest->title}}</option>
                    
                @endforeach
               
            </select>
         </div>
         <div class="form-group" id="hotels">
            <label for="hotels">Hotels :</label>
            <select multiple class="form-control" name="hotels">
                @foreach ($hotels as $hotel)
                <option value="{{$hotel->id}}">{{$hotel->title}}</option>
                    
                @endforeach
               
            </select>
         </div>
    
         <button type="submit" class="btn btn-primary">Submit</button>
    
        </form>
    
        <div class="image col-4">
            <img src="{{asset('images/screens/email.png')}}" alt="">
        </div>
    </div>

    <script src="{{asset("js/email.js")}}"></script>
@endsection