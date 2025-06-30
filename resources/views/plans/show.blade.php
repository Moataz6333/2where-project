@extends('layouts.main')
@section('title')
    Plans
@endsection
@section('content')
    <h1 class="m-4 text-center">{{ $plan->title }}</h1>
    <a href="{{ route('plans.index') }}" class="btn btn-dark m-3">Back</a>
    <div class="card">
        <div class="card-header">
            {{ $plan->title }}
        </div>
        <div class="card-body">
            <figure>
                <blockquote class="blockquote">
                    <p>{{ $plan->description }}</p>
                </blockquote>
            </figure>
            <div class="my-2 p-2 ">
                    <div class="d-flex gap-2 align-items-center ">
                            <h4>Company : </h4>
                            <b>{{ $plan->company? $plan->company->name : 'Admin' }}</b>
                    </div>
                    <div class="d-flex gap-2 align-items-center ">
                            <h4>Date : </h4>
                            <b>{{ date_create($plan->date )->format('d-m-Y  h:i a')}}</b>
                    </div>
                    <div class="d-flex gap-2 align-items-center ">
                            <h4>Price : </h4>
                            <b>{{ $plan->price}}</b>
                    </div>
            </div>
        </div>
    </div>

    @if (!$plan->places->isEmpty())
        <h2 class="my-2">Places:</h2>
        <div class=" m-3 d-flex justify-content-start bg-primary-light alert-primary ">
            @foreach ($plan->places as $place)
                <div class="card m-2 border-primary" style="width: 15rem; color:black;">
                    <img src="{{ asset($place->post->first()->path) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $place->post_title }}</h5>

                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- rests --}}
    @if (!$plan->restaruants->isEmpty())
        <h2 class="my-2">Restaruants:</h2>

        <div class="rests m-3 d-flex justify-content-start alert-danger ">
            @foreach ($plan->restaruants as $place)
                <div class="card m-2 border-danger" style="width: 15rem; color:black;">
                    <img src="{{ asset($place->post->first()->path) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $place->title }}</h5>

                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if (!$plan->hotels->isEmpty())
        <h2 class="my-2">Hotels:</h2>

        <div class="rests m-3 d-flex justify-content-start alert-success ">
            @foreach ($plan->hotels as $place)
                <div class="card m-2 border-success" style="width: 15rem; color:black; ">
                    <img src="{{ asset($place->post->first()->path) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $place->title }}</h5>

                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
