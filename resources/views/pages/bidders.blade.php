@extends('layouts.app', ['page' => __('Bidders'), 'pageSlug' => 'bidders'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Bidders</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form name="bidders-form" id="bidders-form" method="post" action="{{ url('saveNewContractorsForm') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 d-none">
                                        <label for="contractorsID">ID</label>
                                        <input type="text" class="form-control" name="contractorsID" id="contractorsID">
                                        <label class="text-danger">
                                            @error('contractorsID')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <label for="businessName">Business Name</label>
                                        <input type="text" class="form-control bg-white text-dark" name="businessName" id="businessName">
                                        <label class="text-danger">
                                            @error('businessName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="businessOwner">Owner</label>
                                        <input type="text" class="form-control bg-white text-dark" name="businessOwner" id="businessOwner">
                                        <label class="text-danger">
                                            @error('businessOwner')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="businessPosition">Position</label>
                                        <input type="text" class="form-control bg-white text-dark" name="businessPosition" id="businessPosition">
                                        <label class="text-danger">
                                            @error('businessPosition')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-8">
                                        <label for="businessAddress">Business Address</label>
                                        <input type="text" class="form-control bg-white text-dark" name="businessAddress" id="businessAddress">
                                        <label class="text-danger">
                                            @error('businessAddress')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="businessNumber">Contact Number</label>
                                        <input type="text" class="form-control bg-white text-dark" name="businessNumber" id="businessNumber">
                                        <label class="text-danger">
                                            @error('businessNumber')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="button" id="clear-btn" class="btn btn-success mx-auto d-none">Clear</button>
                                        <button type="submit" id="submit-btn" class="btn btn-success">Add</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection