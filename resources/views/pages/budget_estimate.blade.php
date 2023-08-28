@extends('layouts.app', ['page' => __('Budget Estimate'), 'pageSlug' => 'budget_estimate'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Budget Estimate</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="card-header">
                            {{-- <h3 class="card-title">General Fund-Proper</h3>
                            <h4 class="card-title">Tax Revenue</h4> --}}
                        </div>
                    </div>
                    <form name="budget_estimate_form" id="budget_estimate_form" method="post" action="{{ url('budgetEstimateField') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="budgetYearPicker">Year</label>
                                <?php 
                                    $year_start  = 1940;
                                    $year_end = date('Y');
                                    $user_selected_year = date('Y');
                                    echo '<select class="bYearPicker form-control bg-white text-dark" name="budgetYearPicker" id="budgetYearPicker">'."\n";
                                    for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                                        $selected = ($user_selected_year == $i_year ? ' selected' : '');
                                        echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
                                    }
                                    echo '</select>'."\n";
                                ?>
                            </div>

                            <div class="col-md-9">
                                <button type="submit" id="submit-btn" class="budget-submit btn btn-success mt-4">Save</button>
                            </div>
                        </div>
                        
                        @foreach ($accCategories as $category_item)
                            <div class="table-responsive">
                                <table class="table tablesorter" id="budget-estimate-table">
                                    <thead>
                                        <tr>
                                            <th>Account Title <br>{{ $category_item->acc_category_settings }}</th>
                                            <th>Account Code</th>
                                            <th>Budget Estimate</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            {{-- <th>Actual Collection</th>
                                            <th>Actual Collection</th>
                                            <th>Total</th>
                                            <th>% of Coll.</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($accGroups as $groupItems)
                                            @if ($groupItems->category_id == $category_item->id)
                                                <tr>
                                                    <td colspan="7" group-id="{{ $groupItems->id }}">
                                                        {{ $groupItems->type }}
                                                    </td>
                                                </tr>
                                                @foreach ($accTitles as $titleItems)
                                                    @if ($titleItems->title_category_id == $groupItems->id)
                                                        <tr>
                                                            <td>
                                                                
                                                                <div class="ml-4 mb-4">
                                                                    {{ $titleItems->title_name }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                @if ($titleItems->title_name == 'Share from National Wealth-Mining')
                                                                    <div></div>
                                                                @else
                                                                    <div class="mb-4">
                                                                    {{ $titleItems->title_code }}
                                                                </div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                
                                                                @if ($titleItems->title_name == 'Share from National Wealth-Mining')
                                                                    <div></div>
                                                                @else
                                                                    <input id="accTitleId-{{ $titleItems->id }}" type="text"
                                                                    class="accTitlesBudgetValue form-control mb-0 bg-white text-dark"
                                                                    name="accTitlesBudgetValue[]">
                                                                    <input type="text"
                                                                        class="form-control mb-0 bg-white text-dark d-none"
                                                                        name="accTitlesBudgetID[]" value="{{ $titleItems->id }}">
                                                                @endif
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            {{-- <td>
                                                                <input disabled type="text"
                                                                    class="form-control mb-0 bg-dark text-dark"
                                                                    name="accTitlesJanColl" id="accTitlesJanColl">
                                                            </td>
                                                            <td>
                                                                <input disabled type="text"
                                                                    class="form-control mb-0 bg-dark text-dark"
                                                                    name="accTitlesAugColl" id="accTitlesAugColl">
                                                            </td>
                                                            <td>
                                                                <input disabled type="text"
                                                                    class="form-control mb-0 bg-dark text-dark"
                                                                    name="accTitlesTotal" id="accTitlesTotal">
                                                            </td>
                                                            <td>
                                                                <input disabled type="text"
                                                                    class="form-control mb-0 bg-dark text-dark"
                                                                    name="accTitlesPercentage" id="accTitlesPercentage">
                                                            </td> --}}
                                                        </tr>

                                                        @foreach ($accSubtitles as $subItems)
                                                            @if ($subItems->title_id == $titleItems->id)

                                                                <tr>
                                                                    <td>
                                                                        @if($subItems->subtitle == 'Drugs and Medicines-5 District Hospitals' || $subItems->subtitle == 'Accountable Forms/Printed forms' || $subItems->subtitle == 'Sales on Veterinary Products')
                                                                            <div class="ml-5 mb-4">
                                                                                {{ $subItems->subtitle }}
                                                                            </div>
                                                                            <table class="table tablesorter">
                                                                                @foreach ($accSubSubtitles as $subSub)
                                                                                    @if ($subItems->main_id == $subSub->subtitle_id)
                                                                                        <tr>
                                                                                            <td style="width: 5%">
                                                                                                <div class="ml-5 mb-2">
                                                                                                    {{ $subSub->sub_subtitles }}
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </table>
                                                                        @else
                                                                            <div class="ml-5 mb-4">
                                                                                {{ $subItems->subtitle }}
                                                                            </div>
                                                                        @endif
                                                                        
                                                                    </td>
                                                                    <td></td>
                                                                    <td>
                                                                        @if($subItems->subtitle == 'Drugs and Medicines-5 District Hospitals' || $subItems->subtitle == 'Accountable Forms/Printed forms' || $subItems->subtitle == 'Sales on Veterinary Products')
                                                                            <input id="subTitleId-{{ $subItems->id }}" type="text"
                                                                            class="subTitlesBudgetValue form-control bg-white text-dark"
                                                                            name="subTitlesBudgetValue[]">
                                                                            <input type="text"
                                                                                class="form-control bg-white text-dark d-none"
                                                                                name="subTitlesBudgetID[]" value="{{ $subItems->id }}">
                                                                            <table class="table tablesorter">
                                                                                @foreach ($accSubSubtitles as $subSub)
                                                                                    @if ($subItems->main_id == $subSub->subtitle_id)
                                                                                        <tr>
                                                                                            <td style="width: 5%">
                                                                                                <div>
                                                                                                    <input id="subSubTitleId-{{ $subSub->id }}" type="text"
                                                                                                        class="subSubTitlesBudgetValue form-control bg-white text-dark"
                                                                                                        name="subSubTitlesBudgetValue[]">
                                                                                                    <input type="text"
                                                                                                        class="form-control bg-white text-dark d-none"
                                                                                                        name="subSubTitlesBudgetID[]" value="{{ $subSub->id }}">
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </table>
                                                                        @else
                                                                            <input id="subTitleId-{{ $subItems->id }}" type="text"
                                                                            class="subTitlesBudgetValue form-control bg-white text-dark"
                                                                            name="subTitlesBudgetValue[]">
                                                                            <input type="text"
                                                                                class="form-control bg-white text-dark d-none"
                                                                                name="subTitlesBudgetID[]" value="{{ $subItems->id }}">
                                                                        @endif
                                                                        
                                                                    </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    {{-- <td>
                                                                        <input disabled type="text"
                                                                            class="form-control bg-dark text-dark"
                                                                            name="subTitlesJanColl" id="subTitlesJanColl">
                                                                    </td>
                                                                    <td>
                                                                        <input disabled type="text"
                                                                            class="form-control mb-0 bg-dark text-dark"
                                                                            name="subTitlesAugColl" id="subTitlesAugColl">
                                                                    </td>
                                                                    <td>
                                                                        <input disabled type="text"
                                                                            class="form-control mb-0 bg-dark text-dark"
                                                                            name="subTitlesTotal" id="subTitlesTotal">
                                                                    </td>
                                                                    <td>
                                                                        <input disabled type="text"
                                                                            class="form-control mb-0 bg-dark text-dark"
                                                                            name="subTitlesPercentage" id="subTitlesPercentage">
                                                                    </td> --}}
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
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#budgetYearPicker').ready(function () {
            let budgetEst = $('.accTitlesBudgetValue')[0];
            let budgetEstSub = $('.subTitlesBudgetValue')[0];
            let budgetEstSubSub = $('.subSubTitlesBudgetValue')[0];
            $(budgetEst).val('');
            $(budgetEstSub).val('');
            $(budgetEstSubSub).val('');
            $.ajax({
                'url': '{{ route('yearlyBudget') }}',
                'data': {
                    "_token": "{{ csrf_token() }}",
                    "year": $('#budgetYearPicker').val(),
                },
                'method': "post",
                'dataType': "json",
                'success': function(data) {
                    let rowCount = data.length - 1;
                    if (data.length > 0) {
                        let budgetEst = $('.accTitlesBudgetValue')[0];
                        let budgetEstSub = $('.subTitlesBudgetValue')[0];
                        let budgetEstSubSub = $('.subSubTitlesBudgetValue')[0];
                        $(budgetEst).val('');
                        $(budgetEstSub).val('');
                        $(budgetEstSubSub).val('');
                        
                        for (let i=0; i<=rowCount; i++) {
                            budgetEstAccTitles = $('#accTitleId-'+data[i].acc_titles_id);
                            budgetEstSubTitles = $('#subTitleId-'+data[i].sub_titles_id);
                            budgetEstSubSubTitles = $('#subSubTitleId-'+data[i].sub_subtitles_id);
                            if (data[i].acc_titles_id != null) {
                                $(budgetEstAccTitles).val(parseFloat(data[i].amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } 
                            
                            if (data[i].sub_titles_id != null) {
                                $(budgetEstSubTitles).val(parseFloat(data[i].amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            }

                            if (data[i].sub_subtitles_id != null) {
                                $(budgetEstSubSubTitles).val(parseFloat(data[i].amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            }
                        }
                    } 
                }
            });
        });

        $('.accTitlesBudgetValue').keyup(function() {                     
            $(this).mask("#00,000,000,000,000.00", {reverse: true});
        });

        $('.subTitlesBudgetValue').keyup(function() {                     
            $(this).mask("#00,000,000,000,000.00", {reverse: true});
        });

        $('.subSubTitlesBudgetValue').keyup(function() {                     
            $(this).mask("#00,000,000,000,000.00", {reverse: true});
        });

        $('#budgetYearPicker').change(function() {
            let budgetEst = $('.accTitlesBudgetValue')[0];
            let budgetEstSub = $('.subTitlesBudgetValue')[0];
            let budgetEstSubSub = $('.subSubTitlesBudgetValue')[0];
            $(budgetEst).val('');
            $(budgetEstSub).val('');
            $(budgetEstSubSub).val('');
            $.ajax({
                'url': '{{ route('yearlyBudget') }}',
                'data': {
                    "_token": "{{ csrf_token() }}",
                    "year": $(this).val(),
                },
                'method': "post",
                'dataType': "json",
                'success': function(data) {
                    let savedYear = $('#budgetYearPicker').val();
                    let rowCount = data.length - 1;
                    if (rowCount <= -1) {
                        $('#budget_estimate_form')[0].reset();
                        $('#budgetYearPicker').val(savedYear);
                        $('#budgetYearPicker').trigger('change');
                    }

                    if (data.length > 0) {
                        let budgetEst = $('.accTitlesBudgetValue')[0];
                        let budgetEstSub = $('.subTitlesBudgetValue')[0];
                        let budgetEstSubSub = $('.subSubTitlesBudgetValue')[0];
                        $(budgetEst).val('');
                        $(budgetEstSub).val('');
                        $(budgetEstSubSub).val('');
                        
                        for (let i=0; i<=rowCount; i++) {
                            budgetEstAccTitles = $('#accTitleId-'+data[i].acc_titles_id);
                            budgetEstSubTitles = $('#subTitleId-'+data[i].sub_titles_id);
                            budgetEstSubSubTitles = $('#subSubTitleId-'+data[i].sub_subtitles_id);
                            
                            if (data[i].acc_titles_id != null) {
                                $(budgetEstAccTitles).val(parseFloat(data[i].amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            }
                            
                            if (data[i].sub_titles_id != null) {
                                $(budgetEstSubTitles).val(parseFloat(data[i].amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            }

                            if (data[i].sub_subtitles_id != null) {
                                $(budgetEstSubSubTitles).val(parseFloat(data[i].amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            }
                        }
                    }
                    if (data.length == 0) {
                        $(budgetEst).val('');
                        $(budgetEstSub).val('');
                        $(budgetEstSubSub).val('');
                    }
                }
            });
        });
    </script>
@endsection

