@extends('layouts.main')
@section('title')
    Plans
@endsection
@section('content')

    <h1 class="text-center m-4">Create Plan</h1>
    <a href="{{ route('plans.index') }}" class="btn btn-dark m-3">Back</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('plans.store') }}">
        @csrf

        <div class="form-group">
            <label for="title">Plan name :</label>
            <input type="text" class="form-control" name="title" required placeholder="plan name">
        </div>
        <div class="form-group">
            <label for="description">Plan description :</label>
            <textarea name="description" id="description" cols="10" rows="3" placeholder="optional" class="form-control"></textarea>
        </div>
        <hr>
        <h4 class="my-2">Company details</h4>
        <div class="my-2 row">
            <div class="form-group col-4">
                <label for="title">Company :</label>
                <select class="form-select" id="company" name="company">
                    <option value="admin" selected>Admin</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-4">
                <label for="title">Plan date :</label>
                <input type="datetime-local" class="form-control" name="date">
            </div>
            <div class="form-group col-4">
                <label for="title">Price  :</label>
                <input type="text" required class="form-control" name="price" placeholder="0">
            </div>
        </div>
        <hr>
        <div class="form-group my-2">
            <label for="places">Places :</label>
            <small class="form-text text-muted">Hold on ctrl to select multiple item</small>
            <select multiple class="form-control" id="places" name="places[]">
                @foreach ($places as $place)
                    <option value="{{ $place->id }}">{{ $place->title }}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group my-2">
            <label for="rests">Restrauants :</label>
            <small class="form-text text-muted">Hold on ctrl to select multiple item</small>
            <select multiple class="form-control" id="rests" name="rests[]">
                @foreach ($rests as $rest)
                    <option value="{{ $rest->id }}">{{ $rest->title }}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group my-2">
            <label for="hotels">Hotels :</label>
            <small class="form-text text-muted">Hold on ctrl to select multiple item</small>
            <select multiple class="form-control" id="hotels" name="hotels[]">
                @foreach ($hotels as $hotel)
                    <option value="{{ $hotel->id }}">{{ $hotel->title }}</option>
                @endforeach

            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



@endsection
