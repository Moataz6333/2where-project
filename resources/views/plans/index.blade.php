@extends('layouts.main')
@section('content')

<h1 class="text-center m-4">Plans</h1>
<div class="d-flex justify-content-center">
    <a href="{{route('plans.create')}}" class="btn btn-success  text-center " >Create Plan</a>

</div>
@if(session('success'))
<div class="alert alert-success m-2">
{{ session('success') }}
</div>
@endif

<div class="citesContainer d-flex justify-content-center mt-3" style="gap: 20px">
    @foreach ($plans as $plan)
<div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">{{$plan->title}}</h5>
      <p class="card-text">{{$plan->description}} </p>
      <p class="text-muted">places: (<span class="badge badge-light">{{count($plan->places)}} </span>) , restaruants: (<span class="badge badge-light">{{count($plan->restaruants)}} </span>) , hotels: (<span class="badge badge-light">{{count($plan->hotels)}} </span>)</p>
      <a href="{{route('plans.show',$plan->id)}}" class="btn btn-primary">show</a>
      <a href="{{route('plans.edit',$plan->id)}}" class="btn btn-info"> update</a>
      <form action="{{route('plans.destroy',$plan->id)}}" method="POST" class="d-inline-block" onsubmit="return confirmDelete()">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>

      </form>  
    </div>
  </div>
    
@endforeach
</div>



<script>function confirmDelete() {
    return confirm('Are you sure you want to delete this City?');
}
</script>
@endsection