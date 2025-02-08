@extends('layouts.main')
@section('content')

<a href="{{route('dashboard')}}" class="btn btn-dark m-2">Back</a>
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-center">
    <a href="{{route('subs.email')}}" class="btn btn-success">Send Email</a>
</div>
<h2 class="text-center m-3">Subsecripers</h2>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">email</th>
        <th scope="col">delete</th>
      
      </tr>
    </thead>
    <tbody>
        @foreach ($subs as $sub)
        <tr>
            <th scope="row">{{$i++}}</th>
            <td>{{$sub->email}}</td>
            
            <td>
                <form action="{{route('subs.destroy',$sub->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
          </tr>
        @endforeach
     
    
    </tbody>
  </table>
    
@endsection