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
                    <h6 class="m-0 font-weight-bold text-primary">Bank Account List</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table">
                        <tr>
                            <th>Bank Name</th>
                            <th>Type</th>
                            <th>Holder Name</th>
                            <th>Account Number</th>
                            <th></th>
                        </tr>
                        @foreach ($bank_accounts as $bank_account)
                        <tr>
                            <td>{{ $bank_account->bank_name }}</td>
                            <td>{{ $bank_account->type }}</td>
                            <td>{{ $bank_account->holder_name }}</td>
                            <td>{{ $bank_account->account_number }}</td>
                            <td>
                                {{ Form::open(['url' => route('bank_accounts.destroy', $bank_account->id), 'method' => 'delete']) }}
                                <button class="btn btn-sm text-danger" type="submit"><i class="fas fw fa-backspace"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection