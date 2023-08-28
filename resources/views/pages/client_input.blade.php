@extends('layouts.app', ['page' => __('Client Input'), 'pageSlug' => 'client_input'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Client Input</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form name="client-input-form" id="client-input-form" method="post" action="{{ url('saveNewContractorsForm') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 d-none">
                                        <label for="clientInputID">ID</label>
                                        <input type="text" class="form-control" name="clientInputID" id="clientInputID">
                                        <label class="text-danger">
                                            @error('clientInputID')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <label for="clientTypeCI">Client Type</label>
                                        <select class="form-control bg-white text-dark" name="clientTypeCI" id="clientTypeCI">
                                            <option class="bg-white" value=""></option>
                                            @foreach ($displayCustType as $cust_items)
                                                <option class="bg-white" value="{{ $cust_items->id }}">
                                                    {{ $cust_items->description_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                </div>

                                <div class="row mt-2">
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

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        {{-- <p class="category"> Here is a subtitle for this table</p> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="client-input-table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th></th>
                                        <th>Client Type</th>
                                        <th>Owner</th>
                                        <th>Position</th>
                                        <th>Address</th>
                                        <th>Contact Number</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection