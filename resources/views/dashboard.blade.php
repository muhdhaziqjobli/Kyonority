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
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('profile.show', $user->id) }}">View</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('profile.edit',$user->id) }}">Edit</a>
                        </div>
                    </div>
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
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Request Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            @if ($user->request)
                                <a class="dropdown-item" href="{{ route('requests.edit',$user->request->id) }}">Edit</a>
                                @if ($user->request->is_active)
                                    <a class="dropdown-item" href="#" id="updateStatus">Deactivate</a>
                                @else
                                    <a class="dropdown-item" href="#" id="updateStatus">Activate</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                {{ Form::open(['url' => route('requests.destroy', $user->request->id), 'method' => 'delete']) }}
                                <button class="dropdown-item" type="submit">Delete</button>
                                {{ Form::close() }}
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @if ($user->request)
                        Status:
                        @if ($user->request->is_active)
                            <span class="btn-sm bg-success text-white shadow">Active</span>
                        @else
                            <span class="btn-sm bg-warning text-white shadow">Unactive</span>
                        @endif
                        <br>
                        Created on: {{ $user->request->created_at }}<br><br>

                        Details: {{ $user->request->details }} <br>

                        Preferred Aids:
                        @if (in_array('food',$icons)) <i class="fa-solid fa-bowl-food"></i> @endif
                        @if (in_array('money',$icons)) <i class="fas fa-money-bill"></i> @endif
                        @if (in_array('baby',$icons)) <i class="fas fa-baby"></i> @endif
                        @if (in_array('medicine',$icons)) <i class="fas fa-capsules"></i> @endif
                    @else
                        You have no aid request. <a href="{{ route('requests.create') }}">Create one here</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function(){
        @if ($user->request)
        $("#updateStatus").click(function(){
            @if ($user->request->is_active)
                is_active = 0;
            @else
                is_active = 1;
            @endif

            $.ajax({
                url: "{{ route('requests.update_status',[$user->request->id]) }}",
                method: 'POST',
                data:{
                    is_active:is_active,
                    _token: '{{csrf_token()}}'
                },
                success: function(data){
                    location.reload(true);
                    console.log(data);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        });
        @endif
    });
</script>    
@endpush