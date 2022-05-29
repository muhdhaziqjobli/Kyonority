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
        <h1 class="h3 mb-0 text-gray-800">Saved Report</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                @forelse ($reports as $report)
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="btn btn-outline-dark btn-block" data-bs-toggle="collapse" data-bs-target="#report-{{ $report->id }}" aria-expanded="false" aria-controls="report-{{ $report->id }}">
                            Generated on {{ $report->created_at }} by Admin
                        </div>
                        <div class="collapse" id="report-{{ $report->id }}">
                            <div class="card card-body">
                                <div>Number of Users: {{ $report->user_count }}</div>
                                <div>Number of Donators: {{ $report->donator_count }}</div>
                                <div>Number of Active Request: {{ $report->request_count }}</div>
                                <div>Number of Donation Made: {{ $report->donation_count }}</div>
                                <div>Number of Monetary Donation: {{ $report->monetary_count }}</div>
                                <div>Number of Aid Donation: {{ $report->aid_count }}</div>
                                <br>
                                <div>Total Donation: RM {{ $report->total_donation }}</div>
                                <div>Highest Donation Received: RM {{ $report->highest_donation }}</div>
                                <div>Net For Monetary: RM {{ $report->net_monetary }}</div>
                                <div>Net for Aid: RM {{ $report->net_aid }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    No Saved Report
                @endforelse
            </div>
        </div>
    </div>
@endsection