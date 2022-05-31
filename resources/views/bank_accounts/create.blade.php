@extends('layouts.back')

@section('content')
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Request</h1>
    </div> --}}

    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Add Bank Account</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="POST" action="{{ route('bank_accounts.store') }}">
                        @csrf

                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                        <input type="hidden" value="1" name="is_active">

                        <div class="row mb-3 text-center">
                            <label for="bank_name" class="col-1 col-form-label text-md-end">Bank Name</label>

                            <div class="col-6">
                                <input id="bank_name" type="text" class="form-control" name="bank_name" value="" required autocomplete="bank_name">
                            </div>
                        </div>

                        <div class="row mb-3 text-center">
                            <label for="type" class="col-1 col-form-label text-md-end">Account Type</label>

                            <div class="col-4">
                                <select id="select" name="type" class="form-control" required autocomplete="type">
                                    <option value="Savings">Savings</option>
                                    <option value="Current">Current</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Loan">Loan</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 text-center">
                            <label for="holder_name" class="col-1 col-form-label text-md-end">Holder Name</label>

                            <div class="col-6">
                                <input id="holder_name" type="text" class="form-control" name="holder_name" value="" required autocomplete="holder_name">
                            </div>
                        </div>

                        <div class="row mb-3 text-center">
                            <label for="account_number" class="col-1 col-form-label text-md-end">Account Number</label>

                            <div class="col-6">
                                <input id="account_number" type="text" class="form-control" name="account_number" value="" required autocomplete="account_number">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection