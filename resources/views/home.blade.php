@extends('layouts.front')

@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center" style="height: 100vh">

    <div class="container">
    <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
        <h1>Donate To Those In Need</h1>
        <h2>Have you done your part today? Just a few clicks could save lifes</h2>
        <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="{{ route('donators.index') }}" class="btn-get-started scrollto">Get Started</a>
        </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
        <img src="assets/img/placeholder.png" class="img-fluid animated" alt="">
        </div>
    </div>
    </div>

</section><!-- End Hero -->
@endsection