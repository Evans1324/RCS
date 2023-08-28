@extends('layouts.app', ['page' => __('Collections & Deposits'), 'pageSlug' => 'collections_deposits'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Collections & Deposits</h1>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('submitCollectionDepositReport') }}">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="text-light" for="cdType">Type</label>
                                <select class="form-control bg-white text-dark" name="cdType" id="cdType">
                                    <option class="bg-white" value=""></option>
                                    @foreach ($acc_categories as $acc)
                                        <option class="bg-white" value="{{ $acc->id }}">{{ $acc->acc_category_settings }}</option>
                                    @endforeach
                                </select>
                                <label class="text-danger">
                                @error('cdType')
                                    {{ $message }}
                                @enderror
                                </label>
                            </div>
    
                            <div class="col-md-4">
                                <label class="text-light" for="reportNumber">Report Number</label>
                                <input type="text" name="reportNumber" class="form-control mb-0 bg-white text-dark" id="reportNumber">
                                <label class="text-danger">
                                @error('reportNumber')
                                    {{ $message }}
                                @enderror
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="text-light" for="reportDate">Report Date</label>
                                <input type="text" name="reportDate" class="bg-white datepicker form-control mb-0 text-dark" id="reportDate">
                                <label class="text-danger">
                                    @error('reportDate')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="text-light" for="startDate">Start Date</label>
                                <input type="text" name="startDate" class="bg-white datepicker form-control mb-0 text-dark" id="startDate">
                                <label class="text-danger">
                                    @error('startDate')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
    
                            <div class="col-md-4">
                                <label class="text-light" for="endDate">End Date</label>
                                <input type="text" name="endDate" class="bg-white datepicker form-control mb-0 text-dark" id="endDate">
                                <label class="text-danger">
                                    @error('endDate')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <h3 class="mb-1">Report Officers</h3>
                        </div>

                        <div class="row">
                            <div id="officer" class="col-md-4">
                                <label class="text-light" for="reportOfficerCol">Accountable Officer A</label>
                                <select class="form-control bg-white text-dark" name="reportOfficerCol" id="reportOfficerCol">
                                    <option class="bg-white" selected value="3">MARY JANE P. LAMPACAN - Local Revenue Collection Officer IV</option>
                                    @foreach ($displayOfficers as $officer)
                                        <option class="bg-white" value="{{ $officer->id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                    @endforeach
                                </select>
                                <label class="text-danger">
                                    @error('reportOfficerCol')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div id="officer" class="col-md-4">
                                <label class="text-light" for="reportOfficerColB">Accountable Officer B</label>
                                <select class="form-control bg-white text-dark" name="reportOfficerColB" id="reportOfficerColB">
                                    <option class="bg-white" selected value="6">IRENE C. BAGKING</option>
                                    @foreach ($displayOfficers as $officer)
                                        <option class="bg-white" value="{{ $officer->id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                    @endforeach
                                </select>
                                <label class="text-danger">
                                    @error('reportOfficerColB')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div id="officer" class="col-md-4">
                                <label class="text-light" for="reportOfficerColD">Accountable Officer D Certification</label>
                                <select class="form-control bg-white text-dark" name="reportOfficerColD" id="reportOfficerColD">
                                    <option class="bg-white" selected value="3">MARY JANE P. LAMPACAN - Local Revenue Collection Officer IV</option>
                                    @foreach ($displayOfficers as $officer)
                                        <option class="bg-white" value="{{ $officer->id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                    @endforeach
                                </select>
                                <label class="text-danger">
                                    @error('reportOfficerColD')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div id="officer" class="col-md-4">
                                <label class="text-light" for="reportOfficerColV">Accountable Officer D Verification</label>
                                <select class="form-control bg-white text-dark" name="reportOfficerColV" id="reportOfficerColV">
                                    <option class="bg-white" selected value="6">IRENE C. BAGKING</option>
                                    @foreach ($displayOfficers as $officer)
                                        <option class="bg-white" value="{{ $officer->id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                    @endforeach
                                </select>
                                <label class="text-danger">
                                    @error('reportOfficerColV')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <button type="input" name="pdf_B" id="export-pdf-b" value="1" class="btn btn-primary">Generate Report</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function disableWeekends(date) {
            return (date.getDay() === 0 || date.getDay() === 6);
        }


        $('.datepicker').flatpickr({
            dateFormat: 'm/d/Y',
            disable: [disableWeekends],  
        });

        let currentYear = (new Date).getFullYear();
        $('#reportNumber').val(currentYear);
        $('#reportDate').val(moment().format("L"));
        $('#startDate').val(moment().format("L"));
        $('#endDate').val(moment().format("L"));

        $('#reportDate').change(function () {
            let value = $(this);
            $('#startDate').val($(value).val());
            $('#endDate').val($(value).val());
        });
    </script>
@endsection