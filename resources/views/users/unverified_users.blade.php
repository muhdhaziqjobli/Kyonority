@extends('layouts.admin')

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
                    <h6 class="m-0 font-weight-bold text-primary">Unverified Users List</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Files</th>
                            <th>Verification</th>
                        </tr>
                        @foreach ($unverified_users as $user)
                        <tr data-bs-toggle="modal" data-bs-target="#modal{{$user->id}}">
                            <td>{{ $user->user_detail->name ?? 'N/A' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse ($user->files as $file)
                                    <div>
                                        <a href="{{ route('profile.download',$file->id) }}">{{ $file->name }}</a>
                                    </div>
                                @empty
                                    N/A
                                @endforelse
                            </td>
                            <td> <input type="checkbox" id="{{ $user->id }}" class="ml-5"> </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


    @foreach ($unverified_users as $user)
    <div class="modal fade" id="modal{{$user->id}}" tabindex="-1" aria-labelledby="modal{{$user->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal{{$user->id}}Label">{{ $user->user_detail->name ?? 'N/A'}}</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-window-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="img-fluid" alt="" style="width:128px;height:128px;">
                        </div>
                        <div class="col-8">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Age</strong></td>
                                    <td>{{ $user->user_detail->age ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Occupation</strong></td>
                                    <td>{{ $user->user_detail->occupation ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Address</strong></td>
                                    <td>{{ $user->user_detail->address ?? 'N/A'}}, {{ $user->user_detail->postcode ?? 'N/A'}}, {{ $user->user_detail->city ?? 'N/A'}}, {{ $user->user_detail->state ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone Number</strong></td>
                                    <td>{{ $user->user_detail->phone_number ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Income</strong></td>
                                    <td>{{ $user->user_detail->income ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Household Members</strong></td>
                                    <td>{{ $user->user_detail->household_member ?? 'N/A'}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    @endforeach
@endsection

@push('js')
<script>
    $(document).ready(function(){
        @foreach ($unverified_users as $user)
            
        $("#{{ $user->id }}").click(function(){
            @if ($user->is_verified)
                is_verified = 0;
            @else
                is_verified = 1;
            @endif

            $.ajax({
                url: "{{ route('admin.verify',[$user->id]) }}",
                method: 'POST',
                data:{
                    is_verified:is_verified,
                    _token: '{{csrf_token()}}'
                },
                success: function(data){
                    location.reload(true);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        });

        @endforeach
    });
</script>    
@endpush