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
        <h1 class="h3 mb-0 text-gray-800">Set Location</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pin Your Location</h6>
                    {{ Form::open(['url' => route('location.store'), 'method' => 'post']) }}
                    <input type="hidden" name="coord" id="coord">
                    <button id="save" class="btn btn-sm btn-primary" disabled>Save</button>
                    {{ Form::close() }}
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="map" class="map"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
    .map {
        height: 75vh;
        width: 100%;
    }
</style>
    
@endpush

@push('js')
<script type="text/javascript">
    function initMap() {
        var marker;
        const myLatLng = { lat: {{$latitude}}, lng: {{$longitude}} };

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: myLatLng,
        });

        marker= new google.maps.Marker({
            position: myLatLng,
            map,
        });

        map.addListener('click', function(mapsMouseEvent) {
            document.getElementById("save").disabled = false;
            document.getElementById("coord").value = mapsMouseEvent.latLng.toString();
        
            if (marker != null)
            {
                marker.setMap(null);
            }
                
            marker = new google.maps.Marker({
                position: mapsMouseEvent.latLng,
                map: map
        });
            
        marker.setMap(map);
    });
    }

    window.initMap = initMap;
</script>

<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?key=AIzaSyB2xmMWhlZWfV7ZuVXMK72D3fVfkH-CafU&callback=initMap" ></script>
@endpush