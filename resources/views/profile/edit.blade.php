@extends('layouts.back')

@section('content')
{{ Form::open(['url' => route('profile.update', $user->id), 'method' => 'put', 'files' => true]) }}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
        <span>
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-primary" href="{{ url()->previous() }}">Cancel</a>
        </span>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Bio</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <textarea class="form-control" name="bio" id="bio" cols="30" rows="10">{{$user->user_detail->bio}}</textarea>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Upload Files</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div>Uploaded Files:</div>
                    <div>
                        @forelse ($user->files as $file)
                            <div>
                                <a href="{{ route('profile.download',$file->id) }}">{{ $file->name }}</a>
                                <span class="float-end"><a href="{{ route('profile.delete',$file->id) }}" class="btn btn-sm text-danger"><i class="fas fw fa-backspace"></i></a></span>
                            </div>
                        @empty
                            N/A
                        @endforelse
                    </div>
                    <br>
                    <div>*Only files is .zip format</div>
                    <input type="file" name="file" accept=".zip">
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
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{$user->user_detail->name}}" required autocomplete="name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="age" class="col-md-4 col-form-label text-md-end">Age</label>

                        <div class="col-md-6">
                            <input id="age" type="number" min="18" class="form-control" name="age" value="{{$user->user_detail->age}}" required autocomplete="age">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>

                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control" name="address" value="{{$user->user_detail->address}}" required autocomplete="address">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="postcode" class="col-md-4 col-form-label text-md-end">Postcode</label>

                        <div class="col-md-6">
                            <input id="postcode" type="number" class="form-control" name="postcode" value="{{$user->user_detail->postcode}}" required autocomplete="postcode">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="city" class="col-md-4 col-form-label text-md-end">City</label>

                        <div class="col-md-6">
                            <input id="city" type="text" class="form-control" name="city" value="{{$user->user_detail->city}}" required autocomplete="city">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="state" class="col-md-4 col-form-label text-md-end">State</label>

                        <div class="col-md-6">
                            <input id="state" type="text" class="form-control" name="state" value="{{$user->user_detail->state}}" required autocomplete="state">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number</label>

                        <div class="col-md-6">
                            <input id="phone_number" type="number" class="form-control" name="phone_number" value="{{$user->user_detail->phone_number}}" required autocomplete="phone_number">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="income" class="col-md-4 col-form-label text-md-end">Income(RM)</label>

                        <div class="col-md-6">
                            <input id="income" type="number" class="form-control" name="income" value="{{$user->user_detail->income}}" required autocomplete="income">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="occupation" class="col-md-4 col-form-label text-md-end">Occupation</label>

                        <div class="col-md-6">
                            <input id="occupation" type="text" class="form-control" name="occupation" value="{{$user->user_detail->occupation}}" required autocomplete="occupation">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="household_member" class="col-md-4 col-form-label text-md-end">Household Member</label>

                        <div class="col-md-6">
                            <input id="household_member" type="number" class="form-control" name="household_member" value="{{$user->user_detail->household_member}}" required autocomplete="household_member">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
@endsection