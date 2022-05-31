@extends('layouts.front')

@section('content')
<!-- ======= Request Section ======= -->
<section id="hero" style="height: 5vh"></section>
<section id="request" class="team section-bg" style="95vh">
<div class="container" data-aos="fade-up">

    <div class="section-title">
    <h2>Donation Requests</h2>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success"> {{Session::get('success')}} </div>
    @endif

    <div class="row">
        <div class="col-9">
            {{ Form::open(['url' => route('donators.search'), 'method' => 'post', 'id' => 'searchForm']) }}
            <input type="text" class="form-control" name="search" id="search" placeholder="Search by name" @if (isset($search)) value="{{$search}}" @endif>
            {{ Form::close() }}
        </div>
        <div class="col-1">
            {{ Form::open(['url' => route('donators.sort'), 'method' => 'post', 'id' => 'sortForm']) }}
            <select name="sort" id="sort" class="form-control">
                <option value="all" disabled @if (!isset($sort)) selected @endif>Sort by:</option>
                <option value="latest" @if (isset($sort)) @if ($sort == "latest") selected @endif @endif>Newest</option>
                <option value="oldest" @if (isset($sort)) @if ($sort == "oldest") selected @endif @endif>Oldest</option>
            </select>
            {{ Form::close() }}
        </div>
        <div class="col-1">
            {{ Form::open(['url' => route('donators.filter'), 'method' => 'post', 'id' => 'filterForm']) }}
            <select name="filter" id="filter" class="form-control">
                <option value="all" disabled @if (!isset($filter)) selected @endif>Filter by:</option>
                <option value="money" @if (isset($filter)) @if ($filter == "money") selected @endif @endif>Money</option>
                <option value="food" @if (isset($filter)) @if ($filter == "food") selected @endif @endif>Food</option>
                <option value="medicine" @if (isset($filter)) @if ($filter == "medicine") selected @endif @endif>Medicine</option>
                <option value="baby" @if (isset($filter)) @if ($filter == "baby") selected @endif @endif>Baby</option>
            </select>
            {{ Form::close() }}
        </div>
        <div class="col-1 mt-1">
            <a href="{{ route('donators.index') }}" class="btn btn-outline-primary btn-sm">Reset</a>
        </div>
    </div>

    <div class="row">

        @foreach ($requests as $request)
            <div class="col-4 mt-4">
                <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                <div class="pic">
                    @if ($request->user->user_detail->files)
                    <img src="{{ asset('storage/images/'.$request->user->user_detail->files) }}" class="img-fluid" alt="">
                    @else
                    <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="img-fluid" alt="">
                    @endif
                </div>
                <div class="member-info">
                    <h4>{{ $request->user->user_detail->name }}</h4>
                    <span>{{ $request->user->user_detail->occupation }}, {{ $request->user->user_detail->age }}</span>
                    <p>{{ $request->details }}</p>
                    <div class="social">
                        @if (in_array('food',$request->icons)) <a href="#"><i class="fa-solid fa-bowl-food"></i></a> @endif
                        @if (in_array('money',$request->icons)) <a href="#"><i class="fas fa-money-bill"></i></a> @endif
                        @if (in_array('baby',$request->icons)) <a href="#"><i class="fas fa-baby"></i></a> @endif
                        @if (in_array('medicine',$request->icons)) <a href="#"><i class="fas fa-capsules"></i></a> @endif
                    </div>
                    <span></span>
                    <div class="social">
                        <button class="btn btn-outline-primary btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#modal{{$request->id}}">Send Aid</button>
                        <button class="btn btn-outline-success btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#bankModal{{$request->id}}">Send Money</button>
                    </div>
                </div>
                </div>
            </div>
        @endforeach

    </div>

</div>
</section><!-- End Request Section -->

<!-- Modal -->
@foreach ($requests as $request)
    <div class="modal fade" id="modal{{$request->id}}" tabindex="-1" aria-labelledby="modal{{$request->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal{{$request->id}}Label">{{ $request->user->user_detail->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div>Address:</div>
                            <div>{{ $request->user->user_detail->address }}</div>
                            <div>{{ $request->user->user_detail->postcode }}, {{ $request->user->user_detail->city }}</div>
                            <div class="mb-3">{{ $request->user->user_detail->state }}</div>
                            
                            @if ($request->user->user_detail->coord)
                                <div id="map{{$request->id}}" style="height: 20vh; width: 100%;" class="mb-3"></div>
                            @endif
                            
                            <div>Choose Delivery Service:</div>
                            <a class="btn btn-outline-success btn-sm rounded-pill" href="https://food.grab.com/my/en/" target="_blank">Grab</a>
                            <a class="btn btn-outline-danger btn-sm rounded-pill" href="https://www.foodpanda.my/" target="_blank">FoodPanda</a>
                            
                            {{ Form::open(['url' => route('donators.donate', ['donator_id' => Auth::guard('donator')->user()->id, 'request_id' => $request->id]), 'method' => 'post']) }}
                            {{ Form::hidden('type', 'aid') }}
                            <div class="mt-3">Total Cost:</div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">RM</span>
                                </div>
                                <input type="number" step="0.01" class="form-control" name="price">
                            </div>

                            <div class="float-end mt-3">
                                <button class="btn btn-primary mb-3">Donate</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="bankModal{{$request->id}}" tabindex="-1" aria-labelledby="bankModal{{$request->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bankModal{{$request->id}}Label">Bank Accounts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="mb-3">
                        <select id="select-bank-{{$request->id}}" class="form-control">
                            <option value="default" selected disabled>Choose Preferred Bank</option>
                        @forelse ($request->user->bank_accounts as $bank_account)
                            <option value="{{ $bank_account->id }}">{{ $bank_account->bank_name }}</option>
                        @empty
                            <option value="#">No Registered Account</option>
                        @endforelse
                        </select>
                    </div>

                    <div id="bank-details-{{$request->id}}"></div>

                    {{ Form::open(['url' => route('donators.donate', ['donator_id' => Auth::guard('donator')->user()->id, 'request_id' => $request->id]), 'method' => 'post']) }}
                    {{ Form::hidden('type', 'monetary') }}
                    <div class="mt-3">Donation Amount:</div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">RM</span>
                        </div>
                        <input type="number" step="0.01" class="form-control" name="price">
                    </div>

                    <div class="float-end mt-3">
                        <button class="btn btn-primary mb-3">Donate</button>
                    </div>
                    {{ Form::close() }}
                </table>
            </div>
        </div>
        </div>
    </div>
@endforeach
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $('#search').on('keypress',function(e) {
            if(e.which == 13) {
                $('#searchForm').submit();
            }
        });

        $('#filter').on('change',function(e) {
            $('#filterForm').submit();
        });

        $('#sort').on('change',function(e) {
            $('#sortForm').submit();
        });

        @foreach ($requests as $request)
            $("#select-bank-{{$request->id}}").change(function(){
                $("#bank-details-{{$request->id}}").empty();
                
                var id = $("#select-bank-{{$request->id}}").val();

                $.ajax({ 
                    type: "GET",
                    url: "/donators/get-bank",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id,
                    },
                    dataType: 'json',    
                    success: function (data) {
                        $("#title").html(data.title);
                        $("#description").html(data.description);

                        var details = 
                            "Account Holder: " + data.holder_name + "<br>" +
                            "Account Number: " + data.account_number + "<br>" +
                            "Account Type: " + data.type + "<br>"
                        ;
                        $("#bank-details-{{$request->id}}").append(details);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
        @endforeach
    });
</script>

<script>
    function initMap() {
        @foreach ($requests as $request)
        @if ($request->user->user_detail->coord)
            @php
                $coord = str_replace( ['(',')',' '], '', $request->user->user_detail->coord);
                $coord = explode(',', $coord);

                $latitude = $coord[0];
                $longitude = $coord[1];
            @endphp
            var marker{{$request->id}};
            const myLatLng{{$request->id}} = { lat: {{$latitude}}, lng: {{$longitude}} };

            const map{{$request->id}} = new google.maps.Map(document.getElementById("map{{$request->id}}"), {
                zoom: 15,
                center: myLatLng{{$request->id}},
            });

            marker{{$request->id}} = new google.maps.Marker({
                position: myLatLng{{$request->id}},
            });

            marker{{$request->id}}.setMap(map{{$request->id}});
        @endif
        @endforeach
    }
</script>

<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?key=AIzaSyB2xmMWhlZWfV7ZuVXMK72D3fVfkH-CafU&callback=initMap" >
</script>
@endpush