@extends('layouts.front')

@section('content')
<!-- ======= Request Section ======= -->
<section id="request" class="team section-bg">
<div class="container" data-aos="fade-up">

    <div class="section-title">
    <h2>Donation Requests</h2>
    </div>

    <div class="row">

        @foreach ($requests as $request)
            <div class="col-4 mt-4" data-bs-toggle="modal" data-bs-target="#modal{{$request->id}}">
                <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                <div class="pic"><img src="{{ asset('assets/img/undraw_profile.svg') }}" class="img-fluid" alt=""></div>
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
                        <div class="col-4">
                            <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="img-fluid" alt="" style="width:128px;height:128px;">
                        </div>
                        <div class="col-8">
                            <div>{{ $request->user->user_detail->address }}</div>
                            <div>{{ $request->user->user_detail->postcode }}, {{ $request->user->user_detail->city }}</div>
                            <div class="mb-3">{{ $request->user->user_detail->state }}</div>

                            <p>{{ $request->details }}</p>
                            <div class="modal-icons mb-3">
                                @if (in_array('food',$request->icons)) <a href="#"><i class="fa-solid fa-bowl-food"></i></a> @endif
                                @if (in_array('money',$request->icons)) <a href="#"><i class="fas fa-money-bill"></i></a> @endif
                                @if (in_array('baby',$request->icons)) <a href="#"><i class="fas fa-baby"></i></a> @endif
                                @if (in_array('medicine',$request->icons)) <a href="#"><i class="fas fa-capsules"></i></a> @endif
                            </div>

                            <button class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#bankModal{{$request->id}}">Show Bank Accounts</button>
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
                    @forelse ($request->user->bank_accounts as $bank_account)
                        <div class="mb-3">
                            {{ $bank_account->bank_name }} <br>
                            {{ $bank_account->type }} <br>
                            {{ $bank_account->holder_name }} <br>
                            {{ $bank_account->account_number }}
                        </div>
                    @empty
                        No Bank Account
                    @endforelse
                </table>
                <div class="float-end">
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal{{$request->id}}">Back</button>
                </div>
            </div>
        </div>
        </div>
    </div>
@endforeach
@endsection

@push('css')
    <style>
        .modal-icons a {
            display: inline;
            border-radius: 50px;
            width: 32px;
            height: 32px;
            background: #eff2f8;
            pointer-events: none;
        }

        .modal-icons a i {
            color: #37517e;
            margin: 0 2px;
        }
    </style>
@endpush