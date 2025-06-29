@extends('layouts.main')
@section('title')
    Companies
@endsection

@section('content')
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
    <h2 class="text-center m-3">Add Company</h2>
    <a href="{{ route('companies.index') }}" class="btn btn-dark m-2">Back</a>

    <form class="mb-3" method="POST" action="{{ route('companies.update',$company->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Company name :</label>
            <input type="text" class="form-control" required value="{{ $company->name }}" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="description">Company description :</label>
            <textarea name="description"  id="description" cols="10" rows="3" placeholder="optional" class="form-control">
                {{ $company->description }}
            </textarea>
        </div>
        <div class="row my-2">
            <div class="col-6">
                <label for="phone">Company Phone :</label>
                <input type="text" class="form-control" required value="{{ $company->phone }}" name="phone" placeholder="+20 000000">
            </div>
            <div class="col-6">
                <label for="phone2">Phone 2:</label>
                <input type="text" class="form-control" value="{{ $company->phone2 }}" name="phone2" placeholder="+20 000000">
            </div>
        </div>
        <div class="row my-2">
            <div class="col-4">
                <label for="phone">Email :</label>
                <input type="text" class="form-control" required name="email" value="{{ $company->email }}" placeholder="company@gmail.com">
            </div>
            <div class="col-4">
                <label for="phone2">Bank IBAN :</label>
                <input type="text" class="form-control" required name="bank" value="{{ $company->bankIBAN }}" placeholder="2110000000....">
            </div>
            <div class="form-group col-4">
                <label for="postPhoto">Update photo</label>
                <small class="form-text text-muted">recommended 600×400 px</small>
                <input type="file" class="form-control" name="postPhoto" >
            </div>
        </div>
        <hr>
        <h3 class="my-2">Founder Details</h3>
        <div class="row my-2">
            <div class="form-group col-4">
                <label for="founder_name">Founder name :</label>
                <input type="text" class="form-control" required value="{{ $company->founder->name }}" name="founder_name" placeholder="Name">
            </div>
            <div class="form-group col-4">
                <label for="founder_phone">Founder phone :</label>
                <input type="text" class="form-control" required name="founder_phone" value="{{ $company->founder->phone }}" placeholder="+20 000000">
            </div>
            <div class="form-group col-4">
                <label for="national_id"> National_id :</label>
                <input type="text" class="form-control" required name="national_id" value="{{ $company->founder->national_id }}" placeholder="303030....">
            </div>
        </div>



        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
