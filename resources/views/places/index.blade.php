@extends('layouts.main')
@section('title')  Places  @endsection

@section('content')

    <h1 class="text-center mb-4">Places</h1>
    <div class="d-flex justify-content-center">
            <a href="{{route('places.create')}}" class="btn btn-success  text-center " >Add Place</a>

    </div>
    @if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

    <div class="citesContainer d-flex justify-content-center mt-3" style="flex-wrap: wrap; gap:20px;">
      @foreach ($places as $place)
      <div class="card" style="width: 18rem;">
        <img src="{{$photos->where('place_id',$place->id)->first()->path}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$place->title}}</h5>
          <a href="{{route('places.edit',$place->id)}}" class="btn btn-primary">Update</a>
          <a href="{{route('places.photos',$place->id)}}" class="btn btn-success">Photos</a>
          <form action="{{route('places.destroy',$place->id)}}" method="POST" class="d-inline-block" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>

          </form>          
          <a href="{{route('access.index',$place->id)}}" class="btn btn-dark mt-2">Accessability</a>

        </div>
      </div>
          
      @endforeach

    </div>




  <script>function confirmDelete() {
    return confirm('Are you sure you want to delete this City?');
}
</script>
@endsection