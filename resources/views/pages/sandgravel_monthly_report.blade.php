@extends('layouts.app', ['page' => __('S&G Monthly Report'), 'pageSlug' => 'sandgravel_monthly_report'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Sand & Gravel Monthly Report</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <form name="permittees-form" id="permittees-form" method="post" action="{{ url('generateMonthlyReportSG') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 d-none">
                                        <input type="text" name="sgCollectionID" class="form-control mb-0 bg-white text-dark"
                                                id="sgCollectionID">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="sgMonthStart">Month</label>
                                        <?php
                                            $selected_month = date('m');
                                            echo '<select class="sgMonthPicker form-control bg-white text-dark" name="sgMonthStart" id="sgMonthStart">'."\n";
                                            echo '<option></option>';
                                            for ($i_month = 1; $i_month <= 12; $i_month++) { 
                                                $selected = ($selected_month == $i_month ? ' selected' : '');
                                                echo '<option value="'.$i_month.'"'.$selected.'>'. date('F', mktime(0,0,0,$i_month,3,0)).'</option>'."\n";
                                            }
                                            echo '</select>'."\n";
                                        ?>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="sgYear">Year</label>
                                        <?php 
                                            $year_start  = 1940;
                                            $year_end = date('Y');
                                            $user_selected_year = date('Y');
                                            echo '<select class="sgMonthPicker form-control bg-white text-dark" name="sgYear" id="sgYear">'."\n";
                                            for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                                                $selected = ($user_selected_year == $i_year ? ' selected' : '');
                                                echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
                                            }
                                            echo '</select>'."\n";
                                        ?>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div id="officer" class="col-md-4">
                                        <label class="text-light" for="reportOfficerCol">Prepared By:</label>
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
                                        <label class="text-light" for="reportOfficerColB">Noted By:</label>
                                        <select class="form-control bg-white text-dark" name="reportOfficerColB" id="reportOfficerColB">
                                            <option class="bg-white" selected value="1">IMELDA I. MACANES - Provincial Treasurer</option>
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

                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <button type="button" id="clear-btn" class="btn btn-success mx-auto d-none">Clear</button>
                                        <button type="input" name="pdf_B" id="export-pdf-b" value="1" id="submit-btn" class="btn btn-success">Generate Report</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    </script>
@endsection