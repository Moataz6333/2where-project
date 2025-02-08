@extends('layouts.main')
@section('content')

    <form action="{{route('subs.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>    


@endsection