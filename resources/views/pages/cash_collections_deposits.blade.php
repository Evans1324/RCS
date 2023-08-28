@extends('layouts.app', ['page' => __('Cash Collections & Deposits'), 'pageSlug' => 'cash_collections_deposits'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Cash Collections & Deposits</h1>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('generateCashReport') }}">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="text-light" for="reportDate">Report Date</label>
                                <input type="text" name="reportDate" class="bg-white datepicker form-control mb-0 text-dark" id="reportDate">
                                <label class="text-danger">
                                    @error('reportDate')
                                    {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="startDate">Start Date</label>
                                <input type="text" name="startDate" class="bg-white datepicker form-control mb-0 text-dark" id="startDate">
                                <label class="text-danger">
                                    @error('startDate')
                                    {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="endDate">End Date</label>
                                <input type="text" name="endDate" class="bg-white datepicker form-control mb-0 text-dark" id="endDate">
                                <label class="text-danger">
                                    @error('endDate')
                                    {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="reportNumber">Report Number</label>
                                <input type="text" name="reportNumber" class="form-control mb-0 bg-white text-dark" id="reportNumber">
                                <label class="text-danger">
                                    @error('reportNumber')
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
                                <label class="text-light" for="reportOfficerCol">Accountable Officer</label>
                                <select class="form-control bg-white text-dark" name="reportOfficerCol" id="reportOfficerCol">
                                    <option class="bg-white" selected value="6">IRENE C. BAGKING - Supervising Administrative Officer</option>
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
                                <label class="text-light" for="reportOfficerColB">Accountable Officer Verification</label>
                                <select class="form-control bg-white text-dark" name="reportOfficerColB" id="reportOfficerColB">
                                    <option class="bg-white" selected value="1">IMELDA L. MACANES - Provincial Treasurer</option>
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