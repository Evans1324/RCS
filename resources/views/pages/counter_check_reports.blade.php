@extends('layouts.app', ['page' => __('Counter Check Reports'), 'pageSlug' => 'counter_check_reports'])
@section('content')

<form name="land_tax_form" id="land_tax_form" method="post" action="{{ url('generateProvIncomeCounterCheckExcel') }}">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <h1>Counter Check All Account Titles</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                        <div class="row">
                            <div id="officer" class="col-md-6">
                                <label class="text-light" for="counterCheckReportNumber">Report Number</label>
                                <input type="text" name="counterCheckReportNumber" class="bg-white form-control mb-0 text-dark" id="counterCheckReportNumber">
                                <label class="text-danger">
                                    @error('reportOfficerCol')
                                    {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="piMonthStart">Month</label>
                                <?php
                                    $selected_month = date('m');
                                    echo '<select class="sgMonthPicker form-control bg-white text-dark" name="piMonthStart" id="piMonthStart">'."\n";
                                    echo '<option></option>';
                                    for ($i_month = 1; $i_month <= 12; $i_month++) { 
                                        $selected = ($selected_month == $i_month ? ' selected' : '');
                                        echo '<option value="'.$i_month.'"'.$selected.'>'.date('F', mktime(0,0,0,$i_month,3,0)).'</option>'."\n";
                                    }
                                    echo '</select>'."\n";
                                ?>
                            </div>

                            <div class="col-md-6">
                                <label for="piYear">Year</label>
                                <?php 
                                    $year_start  = 1940;
                                    $year_end = date('Y');
                                    $user_selected_year = date('Y');
                                    echo '<select class="sgMonthPicker form-control bg-white text-dark" name="piYear" id="piYear">'."\n";
                                    for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                                        $selected = ($user_selected_year == $i_year ? ' selected' : '');
                                        echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
                                    }
                                    echo '</select>'."\n";
                                ?>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-1">
                                <button type="input" name="pdf_B" id="export-pdf-b" value="2" class="btn btn-primary">Preview All</button>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h1>Counter Check Per Account Title</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                        <div class="row">
                            <div id="officer" class="col-md-6">
                                <label class="text-light" for="searchAccountTitles">Account Titles</label>
                                <input type="text" name="searchAccountTitles" class="bg-white form-control mb-0 text-dark" id="searchAccountTitles">
                                <label class="text-danger">
                                    @error('reportOfficerCol')
                                    {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div id="officer" class="col-md-6">
                                <label class="text-light" for="counterCheckReportNumber">Report Number</label>
                                <input type="text" name="counterCheckReportNumber" class="bg-white form-control mb-0 text-dark" id="counterCheckReportNumber">
                                <label class="text-danger">
                                    @error('reportOfficerCol')
                                    {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div id="officer" class="col-md-6">
                                <label class="text-light" for="checkStartDate">Start Date</label>
                                <input type="text" name="checkStartDate" class="datepicker bg-white form-control mb-0 text-dark" id="checkStartDate">
                                <label class="text-danger">
                                    @error('reportOfficerCol')
                                    {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div id="officer" class="col-md-6">
                                <label class="text-light" for="checkEndDate">End Date</label>
                                <input type="text" name="checkEndDate" class="datepicker bg-white form-control mb-0 text-dark" id="checkEndDate">
                                <label class="text-danger">
                                    @error('reportOfficerCol')
                                    {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-1 mr-2">
                                <a id="genPreview" class="text-white btn btn-primary">Preview</a>
                            </div>

                            <div class="col-sm-1 ml-2 mr-3">
                                <button type="input" name="pdf_B" id="export-pdf-b" value="1" class="btn btn-primary">Preview - Excel</button>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</form>
<div id="container" class="d-flex align-items-center justify-content-center">
    <div id="loader" class="loader"></div>
    <div id="loader-text" class="loader-text">
        <p>Fetching Data</p>
    </div>
</div>

<script>
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('#loader').hide();
        $('#loader-text').hide();
        $('#checkStartDate').val(moment().format("L"));
        $('#checkEndDate').val(moment().format("L"));
    });

    let currentYear = (new Date).getFullYear();
    $('#counterCheckReportNumber').val(currentYear);

    function disableWeekends(date) {
        return (date.getDay() === 0 || date.getDay() === 6);
    }

    $('.datepicker').flatpickr({
        dateFormat: 'm/d/Y'
        , disable: [disableWeekends]
    });

    let trigger = 0;
    let autoCompleteData = [];
    var category_autocomplete = {
        minLength: 0,
        autocomplete: true,
        source: function(request, response) {
            $.ajax({
                'url': '{{ route('getAccountTitlesPIR') }}',
                'data': {
                    "_token": "{{ csrf_token() }}",
                    "term": request.term,
                },
                'method': "post",
                'dataType': "json",
                'success': function(data) {
                    autoCompleteData = data;
                    response(data);
                }
            });
        }
    }

    $("#searchAccountTitles").autocomplete(category_autocomplete).focus(function() {
        $(this).autocomplete('search', $(this).val());
    });

    $('#genPreview').click(function() {
        $('#loader').show();
        $('#loader-text').show();
        $.ajax({
            'url': '{{ route('generateProvIncomeCounterCheck') }}',
            'data': {
                "_token": "{{ csrf_token() }}",
                "accTitle": $('#searchAccountTitles').val(),
                "startDate": $('#checkStartDate').val(),
                "endDate": $('#checkEndDate').val()
            },
            'method': "post",
            'dataType': "json",
            'success': function(data) {
                $('#loader').hide();
                $('#loader-text').hide();
                let pdfWindow = window.open("");
                pdfWindow.document.write(
                    "<html><body style='margin: 0px!important; width: 100vw!important; height: 100vh!important; background-color: #aeaeae!important;'><iframe style='width: 99.8%!important; height: 99.6%!important' src='data:application/pdf;base64, " +
                    encodeURI(data) + "'></iframe></body></html>"
                )
            }
        });
    });
</script>
@endsection
