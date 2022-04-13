@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello, {{ Auth::user()->name }}! <br><br>

                    <a href="">Create a new blog post</a> <br>
                    <a href="">Show posts history</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
