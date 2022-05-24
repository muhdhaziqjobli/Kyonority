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
        <h1 class="h3 mb-0 text-gray-800">Add Location</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pin Your Location</h6>
                    <button class="btn btn-sm btn-primary">Save</button>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAduXb4AkMEdeeHmTnyQeW4EbB9djIRB0U"></script>
<script>
    let map;

    function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
    });
    }

    window.initMap = initMap;

    $(document).ready(function() {
        initMap(); 
    });
</script>    
@endpush