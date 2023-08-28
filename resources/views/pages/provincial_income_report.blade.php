@extends('layouts.app', ['page' => __('Provincial Income Report'), 'pageSlug' => 'provincial_income_report'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Provincial Income Report</h1>
        </div>
    </div>
    <form name="provincial-report" id="provincial-form" method="post" action="{{ url('generateProvIncomeReport') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 d-none">
                                <label for="provincialID">ID</label>
                            </div>

                            <div class="col-md-3">
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

                            <div class="col-md-3">
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

                            <div id="officer" class="col-md-3">
                                <label class="text-light" for="reportOfficerCol">Accountable Officers:</label>
                                <select class="form-control bg-white text-dark" name="reportOfficerCol" id="reportOfficerCol">
                                    <option class="bg-white" value="IMDELDA I. MACANES">IMDELDA I. MACANES</option>
                                </select>
                                <label class="text-danger">
                                    @error('reportOfficerCol')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <button type="input" name="pdf_B" id="export-pdf-b" value="1" id="submit-btn" class="btn btn-success">Generate Report</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @foreach ($accCategories as $category_item)
                            <div class="table-responsive">
                                <table class="table tablesorter" id="prov-income-table">
                                    <thead>
                                        <tr>
                                            <th>Account Title <br> {{ $category_item->acc_category_settings }}</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Adjustment</th>
                                        </tr>                    
                                    </thead>
                                    <tbody>
                                        @foreach ($accGroups as $groupTitles)
                                            @if ($groupTitles->category_id == $category_item->id)
                                                <tr>
                                                    <td group-id="{{ $groupTitles->id }}">{{ $groupTitles->type }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>

                                                @foreach ($accTitles as $titleItems)
                                                    @if ($titleItems->title_category_id == $groupTitles->id)
                                                        <tr>
                                                            <td><div class="ml-4 mb-2 mt-2">{{ $titleItems->title_name }}</div></td>
                                                            
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                <input id="accTitleId-{{ $titleItems->id }}" type="text" class="accIncomeReportValue form-control mb-0 bg-white text-dark" name="accIncomeReportValue[]">
                                                                <input type="text" class="form-control mb-0 bg-white text-dark d-none" name="accIncomeReportID[]" value="{{ $titleItems->id }}">
                                                            </td>
                                                        </tr>

                                                        @foreach ($accSubtitles as $subItems)
                                                            @if ($subItems->title_id == $titleItems->id)
                                                                <tr>
                                                                    <td>
                                                                        <div class="ml-5 mb-2 mt-2">{{ $subItems->subtitle }}</div>
                                                                        <table class="table tablesorter">
                                                                            @foreach ($accSubSubtitles as $subSub)
                                                                                @if ($subItems->main_id == $subSub->subtitle_id)
                                                                                    <tr>
                                                                                        <td style="width: 5%">
                                                                                            <div class="ml-5 mb-2 mt-2">
                                                                                                {{ $subSub->sub_subtitles }}
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </table>
                                                                    </td>
                                                                    <td>
                                                                        <input id="subTitleId-{{ $subItems->id }}" type="text" class="subIncomeReportValue form-control bg-white text-dark" name="subIncomeReportValue[]">
                                                                        <input type="text" class="form-control bg-white text-dark d-none" name="subIncomeReportID[]" value="{{ $subItems->id }}">
                                                                        <table class="table tablesorter">
                                                                            @foreach ($accSubSubtitles as $subSub)
                                                                                @if ($subItems->main_id == $subSub->subtitle_id)
                                                                                    <tr>
                                                                                        <td>
                                                                                            <input id="subSubTitleId-{{ $subSub->id }}" type="text" class="subSubIncomeReportValue form-control bg-white text-dark" name="subSubIncomeReportValue[]">
                                                                                            <input type="text" class="form-control bg-white text-dark d-none" name="subSubIncomeReportID[]" value="{{ $subSub->id }}">
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </table>
                                                                    </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        let currentYear = (new Date).getFullYear();
        $('#counterCheckReportNumber').val(currentYear);
        
        function disableWeekends(date) {
            return (date.getDay() === 0 || date.getDay() === 6);
        }
        
        $('.datepicker').flatpickr({
            dateFormat: 'm/d/Y',
            disable: [disableWeekends]
        });
    </script>
@endsection