@extends('layouts.main')
@section('title')
    Plans
@endsection
@section('content')
    <h2 class="text-center m-3">Registers to {{ $plan->title }} , <span class="text-success">{{ $daysLeft }}</span> Days left</h2>
    @if (session('success'))
        <div class="alert alert-success m-2">
            {{ session('success') }}
        </div>
    @endif
<div class="d-flex justify-content-center my-4">
    <a href="{{route('sendToCompany',$plan->id)}}" class="btn btn-success  text-center " >Send to Company</a>

</div>

    <table class="table table-striped mt-4 ">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Paid</th>
                <th scope="col">Transaction</th>
                <th scope="col">Email</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($plan->registers as $key => $val)
            @endforeach
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $val->user->name }}</td>
                <td>{{ $val->user->email }}</td>
                <td>
                    @if ($val->paid)
                        <span class="text-success">Yes</span>
                    @else
                        <span class="text-danger">NO</span>
                    @endif
                </td>
                <td>
                    @if ($val->transaction)
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                            data-bs-target="#trans{{ $val->id }}">Transaction</button>
                        <!-- Modal -->
                        <div class="modal fade" id="trans{{ $val->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Transaction</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Invoice Id :</h5>
                                                <p class="p-text">
                                                    {{ $val->transaction->InvoiceId }}
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <h5>Invoice Status :</h5>
                                                <p class="p-text">
                                                    {{ $val->transaction->InvoiceStatus }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Invoice Value :</h5>
                                                <p class="p-text">
                                                    {{ $val->transaction->InvoiceValue }}
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <h5>Currency :</h5>
                                                <p class="p-text">
                                                    {{ $val->transaction->Currency }} (= {{ env('MYFATOORAH_EXCHANGE_RATE') }}
                                                    EGP)
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Customer Name :</h5>
                                                <p class="p-text">
                                                    {{ $val->transaction->CustomerName }}
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <h5>Customer Mobile :</h5>
                                                <p class="p-text">
                                                    {{ $val->transaction->CustomerMobile }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Payment Gateway :</h5>
                                                <p class="p-text">
                                                    {{ $val->transaction->PaymentGateway }}
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <h5>Payment Id :</h5>
                                                <p class="p-text">
                                                    {{ $val->transaction->PaymentId }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Card Number :</h5>
                                                <p class="p-text">
                                                    {{ $val->transaction->CardNumber }}
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <h5>Payment Date :</h5>
                                                <p class="p-text">
                                                    {{ date_create($val->transaction->create_at)->format('l d-m-Y h a') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        -
                    @endif
                </td>

                <td><a href="mailto:{{ $val->user->email }}" class="btn btn-primary">Email</a></td>
                <td>
                    <button class="btn btn-danger">Delete</button>
                </td>
            </tr>

        </tbody>
    </table>




    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this City?');
        }
    </script>
@endsection
{{-- "mpdf/mpdf": "^8.2", --}}