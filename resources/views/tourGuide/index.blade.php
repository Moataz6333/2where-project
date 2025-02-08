@extends('layouts.main')
@section('content')
<a href="{{route('dashboard')}}" class="btn btn-dark ">Back</a>

<h2 class="text-center my-3">Tour-Guidies</h2>
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

    <div class="d-flex w-100 flex-column gap-3" style="gap:20px;">
        @foreach ($tourGuides as $tourGuide)
            
       
        <div class="border border-info my-2 p-2 bg-white rounded row">
                <div class="licence col-4" >
                    <img src="{{$tourGuide->licence}}" alt="Not Found" class="w-100 h-100">
                </div>
                <div class="col-8 position-relative">
                        <h5>{{$tourGuide->user->name}}</h5>
                        <p>{{$tourGuide->about}}</p>
                        <p>{{$tourGuide->areas}}</p>
                        <p>{{$tourGuide->languages}}</p>
                        <p>{{$tourGuide->experience}}</p>
                        <div class="position-absolute d-flex " style=" gap:10px;   right: 0; bottom: 3px;">
                            <form action="{{route('tourGuide.destroy',$tourGuide->id)}}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{route('tourGuide.email',$tourGuide->id)}}" class="btn btn-info">Email </a>
                            <a href="{{route('tourGuide.accept',$tourGuide->id)}}" class="btn btn-success">Accept</a>
                        </div>
                </div>
        </div>
        @endforeach

    </div>



    
@endsection