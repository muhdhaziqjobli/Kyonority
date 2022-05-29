@extends('layouts.front')

@section('content')
<!-- ======= Request Section ======= -->
<section id="hero" style="height: 5vh"></section>
<section id="request" class="team section-bg" style="95vh">
<div class="container" data-aos="fade-up">

    <div class="section-title">
    <h2>Donation Requests</h2>
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

                            <div>Choose Delivery Service:</div>
                            <a class="btn btn-outline-success btn-sm rounded-pill" href="https://food.grab.com/my/en/" target="_blank">Grab</a>
                            <a class="btn btn-outline-danger btn-sm rounded-pill" href="https://www.foodpanda.my/" target="_blank">FoodPanda</a>

                            <div class="mt-3">Total Cost:</div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">RM</span>
                                </div>
                                <input type="number" step="0.01" class="form-control">
                            </div>

                            <div class="float-end mt-3">
                                <button class="btn btn-primary mb-3">Donate</button>
                            </div>
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

                    <div class="mt-3">Donation Amount:</div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">RM</span>
                        </div>
                        <input type="number" step="0.01" class="form-control">
                    </div>

                    <div class="float-end mt-3">
                        <button class="btn btn-primary mb-3">Donate</button>
                    </div>
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
@endpush