@extends('layouts.admin')

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
        <h1 class="h3 mb-0 text-gray-800">Report</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div>Number of Users: {{ $userCount }}</div>
                    <div>Number of Donators: {{ $donatorCount }}</div>
                    <div>Number of Active Request: {{ $requestCount }}</div>
                    <div>Number of Donation Made: {{ $donationCount }}</div>
                    <div>Number of Monetary Donation: {{ $monetaryCount }}</div>
                    <div>Number of Aid Donation: {{ $aidCount }}</div>
                    <br>
                    <div>Total Donation: RM {{ $totalDonation }}</div>
                    <div>Highest Donation Received: RM {{ $highestDonation }}</div>
                    <div>Net For Monetary: RM {{ $netMonetary }}</div>
                    <div>Net for Aid: RM {{ $netAid }}</div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Donation Chart</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Aid
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Monetary
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Aid", "Monetary"],
        datasets: [{
        data: [{{ $netAid }}, {{ $netMonetary }}],
        backgroundColor: ['#4e73df', '#1cc88a'],
        hoverBackgroundColor: ['#2e59d9', '#17a673'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        },
        legend: {
        display: false
        },
        cutoutPercentage: 80,
    },
    });
</script>
@endpush