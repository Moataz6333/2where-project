
@extends('layouts.main')
@section('title')  Companies  @endsection

@section('content')

    <h1 class="text-center mb-4">Companies</h1>
    <div class="d-flex justify-content-center">
            <a href="{{route('companies.create')}}" class="btn btn-success  text-center " >Add Company</a>

    </div>
    @if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
  </div>

    @endif
    <div class="citesContainer d-flex justify-content-center mt-3">
        @foreach ($companies as $company)
        <div class="card p-2 mb-3" style="width: 20rem">
           
            <div class="card-body">
              <h5 class="card-title">{{$company->name}}</h5>
            </div>
        <img src="{{url($company->photo->path)}}" class="card-img-top" alt="..." style="width: 100%" >

           
            <div class="card-body">
              <a href="{{route('companies.edit',$company->id)}}" class="btn btn-primary ">Update</a>
              {{-- <a href="{{route('companies.photos',$company->id)}}" class="btn btn-success">Photos</a> --}}
              <form action="{{route('companies.destroy',$company->id)}}" method="POST" class="d-inline-block mt-2" onsubmit="return confirmDelete()">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-2">Delete</button>

              </form>
            </div>
          </div>
            
        @endforeach
      
        
    </div>




    <script>function confirmDelete() {
        return confirm('Are you sure you want to delete this Company?');
    }
    </script>
@endsection