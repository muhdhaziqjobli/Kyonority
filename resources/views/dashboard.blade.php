@extends('layouts.back')

@section('content')
    <div class="row">
        <div class="col-xl-4">
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
                            <a class="dropdown-item" href="#">View</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Edit</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    Status: 
                    @if (Auth::user()->is_verified)
                        <span class="btn-sm bg-successful text-white shadow">Verified</span>
                    @else
                        <span class="btn-sm bg-warning text-white shadow">Unverified</span>
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
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Deactivate</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @if (Auth::user()->request)
                        
                    @else
                        You have no aid request. <a href="">Create one here</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
