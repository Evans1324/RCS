@extends('layouts.app', ['page' => __('Form 56'), 'pageSlug' => 'form_56'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Form 56</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form name="form56_form" id="form56_form" method="post" action="{{ url('update_form56') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <!-- To do: get data from database and display on each input -->
                                <label for="inputEffectivityYear">EFFECTIVITY YEAR</label>
                                <input type="text" name="inputEffectivityYear"
                                    class="yearpicker form-control mb-0 bg-white text-dark" id="inputEffectivityYear"
                                    value="{{ old('inputEffectivityYear') }}">
                                <label class="text-danger">
                                    @error('inputEffectivityYear')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="inputTaxPercentage">TAX PERCENTAGE TO BE COLLECTED</label>
                                <input type="text" name="inputTaxPercentage" class="form-control bg-white text-dark"
                                    id="inputTaxPercentage" value="{{ old('inputTaxPercentage') }}">
                                <label>
                                    @error('inputTaxPercentage')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="inputAidFull">AID IN FULL BEFORE JANUARY 1</label>
                                <input type="text" name="inputAidFull" class="form-control bg-white text-dark"
                                    id="inputAidFull" value="{{ old('inputAidFull') }}">
                                <label>
                                    @error('inputAidFull')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="inputPaidFull">PAID IN FULL FROM JANUARY 1 TO MARCH 31</label>
                                <input type="text" name="inputPaidFull" class="form-control bg-white text-dark"
                                    id="inputPaidFull" value="{{ old('inputPaidFull') }}">
                                <label>
                                    @error('inputPaidFull')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="inputPenaltyPerMonth">PENALTY PER MONTH</label>
                                <input type="text" name="inputPenaltyPerMonth" class="form-control bg-white text-dark"
                                    id="inputPenaltyPerMonth" value="{{ old('inputPenaltyPerMonth') }}">
                                <label>
                                    @error('inputPenaltyPerMonth')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">Update Form</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(".yearpicker").datepicker({
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        });
    </script>
@endsection
