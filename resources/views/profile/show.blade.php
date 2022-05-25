@extends('layouts.back')

@section('content')
    <!-- Page Heading -->
    @if (Session::has('success'))
        <div class="alert alert-success"> {{Session::get('success')}} </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger"> 
            @foreach ($errors->all() as $message)
                {{$message}} <br>
            @endforeach
        </div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
        <span>
            <a class="btn btn-primary" href="{{ route('profile.edit',$user->id) }}">Edit</a>
            <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
        </span>
    </div>

    <!-- Content Row -->
    <div class="row mb-5">
        <div class="col-2 mx-5">
            <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="img-fluid" alt="">
        </div>

        <div class="col-6 mt-3">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Additional Information</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    Status:
                    @if ($user->is_verified)
                        <span class="btn-sm bg-success text-white shadow">Verified</span>
                    @else
                        <span class="btn-sm bg-warning text-white shadow">Unverified</span>
                    @endif
                    <br><br>

                    Bio: 
                    @if ($user->user_detail->bio === NULL)
                        <span class="btn-sm bg-warning text-white shadow">Nil</span>
                    @else
                        {{ $user->user_detail->bio }}
                    @endif
                    <br><br>

                    Bank Accounts:
                    @if ($user->bank_accounts->count() == 0)
                        <span class="btn-sm bg-warning text-white shadow">Nil</span>
                    @else
                        @php
                            $bank_accounts = $user->bank_accounts;
                        @endphp
                        <table class="table table-sm table-borderless">
                            @foreach ($bank_accounts as $bank_account)
                            <tr>
                                <th>{{ $bank_account->bank_name }}</th>
                                <td>{{ $bank_account->account_number }}</td>
                                <td></td>
                                <td>
                                    {{ Form::open(['url' => route('bank_accounts.destroy', $bank_account->id), 'method' => 'delete']) }}
                                    <button class="btn btn-sm text-danger" type="submit"><i class="fas fw fa-backspace"></i></button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-3 mt-3">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Files Uploaded</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @forelse ($user->files as $file)
                    <div>
                        <a href="{{ route('profile.download',$file->id) }}">{{ $file->name }}</a>
                        <span class="float-end"><a href="{{ route('profile.delete',$file->id) }}" class="btn btn-sm text-danger"><i class="fas fw fa-backspace"></i></a></span>
                    </div>
                    @empty
                        N/A
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div>Name: {{ $user->user_detail->name }}</div>
                    <div>Age: {{ $user->user_detail->age }}</div>
                    <div>Address: {{ $user->user_detail->address }}</div>
                    <div>Postcode: {{ $user->user_detail->postcode }}</div>
                    <div>City: {{ $user->user_detail->city }}</div>
                    <div>State: {{ $user->user_detail->state }}</div>
                    <div>Phone Number: {{ $user->user_detail->phone_number }}</div>
                    <div>Income: {{ $user->user_detail->income }}</div>
                    <div>Occupation: {{ $user->user_detail->occupation }}</div>
                    <div>Household Member: {{ $user->user_detail->household_member }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection