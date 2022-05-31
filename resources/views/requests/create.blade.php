@extends('layouts.back')

@section('content')
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Request</h1>
    </div> --}}

    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Create Request</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="POST" action="{{ route('requests.store') }}">
                        @csrf

                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                        <input type="hidden" value="0" name="is_active">

                        <div class="row mb-3 text-center">
                            <label for="details" class="col-2 col-form-label text-md-end">Details</label>

                            <div class="col-6">
                                <textarea class="form-control" name="details" id="details" cols="30" rows="10" required autocomplete="details"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3 text-center">
                            <label for="icons" class="col-2 col-form-label text-md-end">Preferred Aids</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="icons[]" value="food" />
                                <label class="form-check-label" for="inlineCheckbox1"><i class="fa-solid fa-bowl-food"></i></label>
                            </div>
                            
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="icons[]" value="money" />
                                <label class="form-check-label" for="inlineCheckbox2"><i class="fas fa-money-bill"></i></label>
                            </div>
                            
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="icons[]" value="baby" />
                                <label class="form-check-label" for="inlineCheckbox3"><i class="fas fa-baby"></i></label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="icons[]" value="medicine" />
                                <label class="form-check-label" for="inlineCheckbox3"><i class="fas fa-capsules"></i></label>
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection