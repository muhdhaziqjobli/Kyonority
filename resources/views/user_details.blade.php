@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Details</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user_details.store') }}">
                        @csrf

                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required autocomplete="name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="age" class="col-md-4 col-form-label text-md-end">Age</label>

                            <div class="col-md-6">
                                <input id="age" type="number" min="18" class="form-control" name="age" value="" required autocomplete="age">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="" required autocomplete="address">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="postcode" class="col-md-4 col-form-label text-md-end">Postcode</label>

                            <div class="col-md-6">
                                <input id="postcode" type="number" class="form-control" name="postcode" value="" required autocomplete="postcode">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">City</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="" required autocomplete="city">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="state" class="col-md-4 col-form-label text-md-end">State</label>

                            <div class="col-md-6">
                                <input id="state" type="text" class="form-control" name="state" value="" required autocomplete="state">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="number" class="form-control" name="phone_number" value="" required autocomplete="phone_number">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Income" class="col-md-4 col-form-label text-md-end">Income(RM)</label>

                            <div class="col-md-6">
                                <input id="Income" type="number" class="form-control" name="Income" value="" required autocomplete="Income">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="occupation" class="col-md-4 col-form-label text-md-end">Occupation</label>

                            <div class="col-md-6">
                                <input id="occupation" type="text" class="form-control" name="occupation" value="" required autocomplete="occupation">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="household_member" class="col-md-4 col-form-label text-md-end">Household Member</label>

                            <div class="col-md-6">
                                <input id="household_member" type="number" class="form-control" name="household_member" value="" required autocomplete="household_member">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection