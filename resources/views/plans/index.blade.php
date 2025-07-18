@extends('layouts.main')
@section('title')Plans
    
@endsection
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
      <p class="card-text">{{ \Illuminate\Support\Str::limit($plan->description, 80,'...') }} </p>
      <p class="text-muted">places: (<span class="badge text-primary">{{count($plan->places)}} </span>) , restaruants: (<span class="badge text-primary">{{count($plan->restaruants)}} </span>) , hotels: (<span class="badge text-primary">{{count($plan->hotels)}} </span>)</p>
      <a href="{{route('plans.show',$plan->id)}}" class="btn btn-primary">show</a>
      <a href="{{route('plans.edit',$plan->id)}}" class="btn btn-info"> update</a>
      <a href="{{route('plan.registers',$plan->id)}}" class="btn btn-success"> registers</a>
      <form action="{{route('plans.destroy',$plan->id)}}" method="POST" class="mt-2 d-inline-block" onsubmit="return confirmDelete()">
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