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
            <div class="col-4 mt-4">
                <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                <div class="pic"><img src="{{ asset('assets/img/undraw_profile.svg') }}" class="img-fluid" alt=""></div>
                <div class="member-info">
                    <h4>{{ $request->user->user_detail->name }}</h4>
                    <span>{{ $request->user->user_detail->occupation }}, {{ $request->user->user_detail->age }}</span>
                    <p>{{ $request->details }}</p>
                    <div class="social">
                    <a href=""><i class="ri-twitter-fill"></i></a>
                    <a href=""><i class="ri-facebook-fill"></i></a>
                    <a href=""><i class="ri-instagram-fill"></i></a>
                    <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                    </div>
                </div>
                </div>
            </div>
        @endforeach

    <div class="col-4 mt-4">
        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
        <div class="pic"><img src="assets/img/team/team-1.jpg" class="img-fluid" alt=""></div>
        <div class="member-info">
            <h4>Walter White</h4>
            <span>Chief Executive Officer</span>
            <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
            <div class="social">
            <a href=""><i class="ri-twitter-fill"></i></a>
            <a href=""><i class="ri-facebook-fill"></i></a>
            <a href=""><i class="ri-instagram-fill"></i></a>
            <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
            </div>
        </div>
        </div>
    </div>

    <div class="col-4 mt-4">
        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="200">
        <div class="pic"><img src="assets/img/team/team-2.jpg" class="img-fluid" alt=""></div>
        <div class="member-info">
            <h4>Sarah Jhonson</h4>
            <span>Product Manager</span>
            <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
            <div class="social">
            <a href=""><i class="ri-twitter-fill"></i></a>
            <a href=""><i class="ri-facebook-fill"></i></a>
            <a href=""><i class="ri-instagram-fill"></i></a>
            <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
            </div>
        </div>
        </div>
    </div>

    <div class="col-4 mt-4">
        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="300">
        <div class="pic"><img src="assets/img/team/team-3.jpg" class="img-fluid" alt=""></div>
        <div class="member-info">
            <h4>William Anderson</h4>
            <span>CTO</span>
            <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
            <div class="social">
            <a href=""><i class="ri-twitter-fill"></i></a>
            <a href=""><i class="ri-facebook-fill"></i></a>
            <a href=""><i class="ri-instagram-fill"></i></a>
            <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
            </div>
        </div>
        </div>
    </div>

    <div class="col-4 mt-4">
        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="400">
        <div class="pic"><img src="assets/img/team/team-4.jpg" class="img-fluid" alt=""></div>
        <div class="member-info">
            <h4>Amanda Jepson</h4>
            <span>Accountant</span>
            <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
            <div class="social">
            <a href=""><i class="ri-twitter-fill"></i></a>
            <a href=""><i class="ri-facebook-fill"></i></a>
            <a href=""><i class="ri-instagram-fill"></i></a>
            <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
            </div>
        </div>
        </div>
    </div>

    </div>

</div>
</section><!-- End Request Section -->
@endsection