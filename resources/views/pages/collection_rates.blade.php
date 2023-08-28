@extends('layouts.app', ['page' => __('Budget Estimate'), 'pageSlug' => 'collection_rates'])
@section('content')

    <form name="submit_collection_rate" id="submit_collection_rate"
        action="{{ route('submit_collection_rate') }}" method="post">
        @csrf
        <div class="modal fade set-rate-modal-lg" id="setRateModal" tabindex="-1" role="dialog"
            aria-labelledby="setRateModal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content bg-dark">

                    <div class="modal-header">
                        <h4 class="modal-title text-light" id="setRateModalTitle">Professional Tax</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row d-none">
                            <div class="col-md-3">
                                <label for="dateOfChangeRate">Date of Change</label>
                                <input type="text" name="dateOfChangeRate"
                                    class="currentDate form-control mb-0 bg-white text-dark" id="dateOfChangeRate">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-none">
                                <label for="collRatesID">ID</label>
                                <input type="text" class="form-control" name="collRatesID"
                                    id="collRatesID">
                            </div>

                            <div class="col-md-12 d-none">
                                <label for="accountTitleID">Title ID</label>
                                <input type="number" value="{{ old('accountTitleID') }}"
                                    class="form-control" name="accountTitleID" id="accountTitleID">
                            </div>

                            <div class="col-md-12 d-none">
                                <label for="subtitleId">Subtitle ID</label>
                                <input type="number" value="{{ old('subtitleId') }}" class="form-control" name="subtitleId"
                                    id="subtitleId">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            
                            <div class="col-md-6">
                                <h5>Shared with Municipality and/or Barangay</h5>
                            </div>

                            <div class="col-md-5 offset-md-1">
                                <select name="sharedMunBar" id="sharedMunBar"
                                    class="form-control bg-white text-dark">
                                    <option class="bg-white"></option>
                                    <option class="bg-white" value="1">Yes</option>
                                    <option class="bg-white" value="0">No</option>
                                </select>
                                <label class="text-danger">
                                    @error('sharedMunBar')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row d-none share">
                            <div class="col-md-6">
                                <h5 class="ml-4">Provincial Share(%)</h5>
                            </div>

                            <div class="col-md-5 offset-md-1">
                                <input type="text" class="form-control mb-0 bg-white text-dark"
                                    name="provincialShare" id="provincialShare"
                                    value=" {{ old('provincialShare') }} ">
                                <label class="text-danger">
                                    @error('provincialShare')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row d-none share">
                            <div class="col-md-6">
                                <h5 class="ml-4">Municipal Share(%)</h5>
                            </div>

                            <div class="col-md-5 offset-md-1">
                                <input type="text" class="form-control mb-0 bg-white text-dark"
                                    name="municipalShare" id="municipalShare" value=" {{ old('municipalShare') }} ">
                                <label class="text-danger">
                                    @error('municipalShare')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row d-none share">
                            <div class="col-md-6">
                                <h5 class="ml-4">Barangay Share(%)</h5>
                            </div>

                            <div class="col-md-5 offset-md-1">
                                <input type="text" class="form-control mb-0 bg-white text-dark"
                                    name="barangayShare" id="barangayShare" value=" {{ old('barangayShare   ') }} ">
                                <label class="text-danger">
                                    @error('barangayShare')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Rate Type</h5>
                            </div>
                            <div class="col-md-5 offset-md-1">
                                <select name="rateType" id="rateType"
                                    class="form-control bg-white text-dark">
                                    <option class="bg-white"></option>
                                    <option class="bg-white" calue="Fixed">Fixed</option>
                                    <option class="bg-white" value="Manual">Manual</option>
                                    <option class="bg-white" value="Percent">Percent</option>
                                    <option class="bg-white" value="Schedule">Schedule</option>
                                </select>
                                <label class="text-danger">
                                    @error('rateType')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row d-none" id="fixed">
                            <div class="col-md-6">
                                <h5 class="ml-4">Fixed Rate</h5>
                            </div>

                            <div class="col-md-5 offset-md-1">
                                <input type="text" class="form-control mb-0 bg-white text-dark"
                                    name="fixedRate" id="fixedRate">
                                <label class="text-danger">
                                    @error('fixedRate')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row d-none percent">
                            <div class="col-md-6">
                                <h5 class="ml-4">Percent Value</h5>
                            </div>

                            <div class="col-md-5 offset-md-1">
                                <input type="text" class="form-control mb-0 bg-white text-dark"
                                    name="percentValue" id="percentValue">
                                <label class="text-danger">
                                    @error('percentValue')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row d-none percent">
                            <div class="col-md-6">
                                <h5 class="ml-4">Percent of</h5>
                            </div>

                            <div class="col-md-5 offset-md-1">
                                <select name="percentOf" id="percentOf"
                                    class="form-control bg-white text-dark">
                                    <option class="bg-white d-none"></option>
                                    <option class="bg-white" value="Given Value">Given Value</option>
                                    <option class="bg-white" value="Total">Total</option>
                                </select>
                                <label class="text-danger">
                                    @error('percentOf')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row d-none percent">
                            <div class="col-md-6">
                                <h5 class="ml-4">Deadline</h5>
                            </div>

                            <div class="col-md-5 offset-md-1">
                                <select name="deadline" id="deadline"
                                    class="form-control bg-white text-dark">
                                    <option class="bg-white d-none"></option>
                                    <option class="bg-white" value="1">Yes</option>
                                    <option class="bg-white" value="0">No</option>
                                </select>
                                <label class="text-danger">
                                    @error('deadline')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row d-none deadline">
                            <div class="col-md-6">
                                <h5 class="ml-4">Rate after Deadline (per month)</h5>
                            </div>

                            <div class="col-md-5 offset-md-1">
                                <input type="text" class="form-control mb-0 bg-white text-dark"
                                    name="rateAfterDeadline" id="rateAfterDeadline">
                                <label class="text-danger">
                                    @error('rateAfterDeadline')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row d-none deadline">
                            <div class="col-md-6">
                                <h5 class="ml-4">Deadline Date</h5>
                            </div>

                            <div class="col-md-5 offset-md-1">
                                <input type="text" class="deadlineDatepicker form-control mb-0 bg-white text-dark"
                                    name="deadlineDate" id="deadlineDate">
                                <label class="text-danger">
                                    @error('deadlineDate')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row d-none schedule" id="schedule">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table tablesorter" id="collection-rate-table">
                                        <thead>
                                            <tr>
                                                <th>Label<br></th>
                                                <th>Value</th>
                                                <th>Per Unit?</th>
                                                <th>Unit</th>
                                                <th>
                                                    <button id="addRow" type="button"
                                                        class="btn btn-info btn-sm">Add
                                                        Row</button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="inputRow">
                                            <tr>
                                                <td>
                                                    <input type="text" name="collectionLabel[]"
                                                        class="collectionLabel form-control m-input bg-white text-dark"
                                                        autocomplete="off">
                                                    <label class="text-danger">
                                                        @error('collectionLabel')
                                                            {{ $message }}
                                                        @enderror
                                                    </label>
                                                </td>
                                                <td>
                                                    <input type="text" name="collectionValue[]"
                                                        class="collectionValue form-control m-input bg-white text-dark"
                                                        autocomplete="off">
                                                    <label class="text-danger">
                                                        @error('collectionValue')
                                                            {{ $message }}
                                                        @enderror
                                                    </label>
                                                </td>
                                                <td>
                                                    <select name="collectionPerUnit[]"
                                                        class="collectionPerUnit form-control bg-white text-dark">
                                                        <option class="bg-white"></option>
                                                        <option class="bg-white" value="1">Yes
                                                        </option>
                                                        <option class="bg-white" value="0">No
                                                        </option>
                                                    </select>
                                                    <label class="text-danger">
                                                        @error('collectionPerUnit')
                                                            {{ $message }}
                                                        @enderror
                                                    </label>
                                                </td>
                                                <td>
                                                    <input type="text" id="collectDark" name="collectionUnit[]"
                                                        class="collectionUnit form-control m-input bg-white text-dark"
                                                        autocomplete="off">
                                                    <label class="text-danger">
                                                        @error('collectionUnit')
                                                            {{ $message }}
                                                        @enderror
                                                    </label>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="setRateBtn" class="btn btn-primary">Set Rate</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Collection Rates</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                        
                            <label for="dateOfChange">Date of Change</label>
                            <?php 
                                $year_start  = 1940;
                                $year_end = date('Y');
                                $user_selected_year = date('Y');
                                echo '<select class="sgMonthPicker form-control bg-white text-dark" name="dateOfChange" id="dateOfChange">'."\n";
                                for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                                    $selected = ($user_selected_year == $i_year ? ' selected' : '');
                                    echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
                                }
                                echo '</select>'."\n";
                            ?>
                        </div>

                        <div class="col-md-3">
                            <button type="button" id="setTitlesRateBtn" class="btn btn-primary mt-4">Set Rate</button>
                        </div>
                    </div>
                    @foreach ($accCategories as $category_item)
                        <div class="table-responsive">
                            <table class="table tablesorter" id="collection-rate-table">
                                <thead>
                                    <tr>
                                        <th>Account Title <br>{{ $category_item->acc_category_settings }}
                                        </th>
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
                                                            <div class="ml-4 setTitleRate">
                                                                <span
                                                                    id="titleNames">{{ $titleItems->title_name }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="float-right">
                                                                <button titleID="{{ $titleItems->id }}"
                                                                    titleName="{{ $titleItems->title_name }}"
                                                                    type="button"
                                                                    class="setTitleRateBtn btn btn-primary">Set
                                                                    Rate</button>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    @foreach ($accSubtitles as $subItems)
                                                        @if ($subItems->title_id == $titleItems->id)

                                                            <tr>
                                                                <td>
                                                                    <div class="ml-5">
                                                                        {{ $subItems->subtitle }}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="float-right">
                                                                        <button subTitlesID="{{ $subItems->id }}"
                                                                            subTitleName="{{ $subItems->subtitle }}"
                                                                            type="button"
                                                                            class="setSubtitleRateBtn btn btn-primary"
                                                                            >Set Rate</button>
                                                                    </div>
                                                                </td>
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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.setTitleRateBtn').on('click', function() {
            $('#submit_collection_rate')[0].reset();
            $('#dateOfChangeRate').val($('#dateOfChange').val());
            $('.share').addClass('d-none');
            $('#fixed').addClass('d-none');
            $('.percent').addClass('d-none');
            // $('.deadline').addClass('d-none');
            $('#schedule').addClass('d-none');

            //Change Modal Title according to the Title
            let titleName = $(this).attr('titleName');
            $('#setRateModalTitle').text(titleName);
            let titleID = $(this).attr('titleID');
            $('#accountTitleID').val(titleID);

            $.ajax({
                method: "POST",
                url: "{{ route('getTitleRate') }}",
                data: {
                    id: titleID,
                    date_of_change: $('#dateOfChange').val()
                }
            }).done(function(data) {
                let collectionRate = data.collectionRate;
                let rateSchedules = data.rateSchedules;
                let ratescheduleCount = rateSchedules.length;
                let rows = $('#inputRow').children('tr');
                for (let i=0; i<rows.length; i++) {
                    if(i != 0) {
                        let row = $(rows)[i].remove();
                    }
                }
                if (collectionRate != null) {
                    $('#sharedMunBar').val(collectionRate.shared_status);
                    $('#sharedMunBar').trigger('change');
                    $('#provincialShare').val(collectionRate.provincial_share);
                    $('#municipalShare').val(collectionRate.municipal_share);
                    $('#barangayShare').val(collectionRate.barangay_share);
                    $('#rateType').val(collectionRate.rate_type);
                    $('#rateType').trigger('change');
                    $('#fixedRate').val(collectionRate.fixed_rate);
                    $('#percentValue').val(collectionRate.percent_value);
                    $('#percentOf').val(collectionRate.percent_of);
                    $('#deadline').val(collectionRate.deadline_status);
                    $('#deadline').trigger('change');
                    $('#rateAfterDeadline').val(collectionRate.rate_after_deadline);
                    $('#deadlineDate').val(collectionRate.deadline_date);

                    if(ratescheduleCount > 0) {
                        for(let i=1; i<ratescheduleCount; i++) {
                            $('#addRow').trigger('click');
                        }
                        for(let i=0; i<ratescheduleCount; i++) {
                            let rateSchedule = rateSchedules[i];
                            $($('.collectionLabel')[i]).val(rateSchedule.shared_label);
                            $($('.collectionValue')[i]).val(rateSchedule.shared_value);
                            $($('.collectionPerUnit')[i]).val(rateSchedule.shared_per_unit);
                            $($('.collectionUnit')[i]).val(rateSchedule.shared_unit);
                        }
                    }
                }
            });
            $('#setRateModal').modal('show');
        });

        $('.setSubtitleRateBtn').on('click', function() {
            $('#submit_collection_rate')[0].reset();
            $('#setRateModal').modal('show');
            $('.share').addClass('d-none');
            $('#fixed').addClass('d-none');
            $('.percent').addClass('d-none');
            // $('.deadline').addClass('d-none');
            $('#schedule').addClass('d-none');
            $('#dateOfChangeRate').val($('#dateOfChange').val());
            //Changed Modal Title according to the Title
            let subTitleName = $(this).attr('subTitleName');
            $('#setRateModalTitle').text(subTitleName);

            let subTitleID = $(this).attr('subTitlesID');
            $('#subtitleId').val(subTitleID);
            $.ajax({
                method: 'POST',
                url: "{{ route('getSubtitleRate') }}",
                data: {
                    id: subTitleID,
                    date_of_change: $('#dateOfChange').val()
                }
            }).done(function(data) {
                let subCollectionRate = data.subCollectionRate;
                let subRateSchedules = data.subRateSchedules;
                let ratescheduleCount = subRateSchedules.length;
                let rows = $('#inputRow').children('tr');
                for (let i=0; i<rows.length; i++) {
                    if(i != 0) {
                        let row = $(rows)[i].remove();
                    }
                }
                if (subCollectionRate != null) {
                    $('#sharedMunBar').val(subCollectionRate.shared_status);
                    $('#sharedMunBar').trigger('change');
                    $('#provincialShare').val(subCollectionRate.provincial_share);
                    $('#municipalShare').val(subCollectionRate.municipal_share);
                    $('#barangayShare').val(subCollectionRate.barangay_share);
                    $('#rateType').val(subCollectionRate.rate_type);
                    $('#rateType').trigger('change');
                    $('#fixedRate').val(subCollectionRate.fixed_rate);
                    $('#percentValue').val(subCollectionRate.percent_value);
                    $('#percentOf').val(subCollectionRate.percent_of);
                    $('#deadline').val(subCollectionRate.deadline_status);
                    $('#deadline').trigger('change');
                    $('#rateAfterDeadline').val(subCollectionRate.rate_after_deadline);
                    $('#deadlineDate').val(subCollectionRate.deadline_date);

                    if(ratescheduleCount > 0) {
                        
                        for(let i=1; i<ratescheduleCount; i++) {
                            $('#addRow').trigger('click');
                        }
                        for(let i=0; i<ratescheduleCount; i++) {
                            let rateSchedule = subRateSchedules[i];
                            $($('.collectionLabel')[i]).val(rateSchedule.shared_label);
                            $($('.collectionValue')[i]).val(rateSchedule.shared_value);
                            $($('.collectionPerUnit')[i]).val(rateSchedule.shared_per_unit);
                            $($('.collectionUnit')[i]).val(rateSchedule.shared_unit);
                        }
                    }
                }
            });
            $('#setRateModal').modal('show');
        });

        $('#setTitlesRateBtn').click(function () {
            Swal.fire({
                icon: 'info',
                title: 'This will set the rate for all account titles for transactions. Are you sure you want to Proceed?',
                showCancelButton: true,
                confirmButtonText: 'Update',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: "POST",
                        url: "{{ route('saveYearSelected') }}",
                        data: {
                            date_of_change: $('#dateOfChange').val()
                        }
                    });
                    Swal.fire('Updated Successfully!', '', 'success');
                } else if (result.isDenied) {
                    Swal.fire('Changes were not saved', '', 'info');
                }
            })
        });

        $('#sharedMunBar').on('change', function() {
            if (this.value == "1") {
                $('.share').removeClass('d-none');
            } else {
                $('.share').addClass('d-none');
                $('#provincialShare').val("");
                $('#municipalShare').val("");
                $('#barangayShare').val("");
            }
        });

        $('#rateType').on('change', function() {
            if (this.value == "Fixed") {
                $('#fixed').removeClass('d-none');
            } else {
                $('#fixed').addClass('d-none');
            }

            if (this.value == "Percent") {
                $('.percent').removeClass('d-none');
            } else {
                $('.percent').addClass('d-none');
            }

            if (this.value == 'Schedule') {
                $('#schedule').removeClass('d-none');
            } else {
                $('#schedule').addClass('d-none');
            }

        });

        $('#deadline').change(function() {
            if (this.value == "1") {
                $('.deadline').each(function(index) {
                    $(this).removeClass('d-none');
                });
            } else {
                $('.deadline').each(function(index) {
                    $(this).addClass('d-none');
                });
            }
        });

        $('#schedule').change(function() {
            if (this.value == "1") {
                $('.deadline').each(function(index) {
                    $(this).removeClass('d-none');
                });
            } else {
                $('.deadline').each(function(index) {
                    $(this).addClass('d-none');
                });
            }
        });

        $('.collectionPerUnit').change(function () {
            let td = $(this).parents('tr').children('td')[3];
            let input = $(td).children('input');
            if ($(this).val() == '1') {
                $(input).attr('readonly', false);
                $(input).addClass('bg-white');
            } else if($(this).val() == '0') {
                $(input).attr('readonly', true);
                $(input).removeClass('bg-white');
                $('#collectDark').addClass('bg-dark');
                $(input).val("");
            }
        });

        $("#addRow").click(function() {
            var html = '';
            html += '<tr><div class="input-group mb-3">';
            html += '<td>';
            html +=
                '<input type="text" name="collectionLabel[]" class="collectionLabel form-control m-input bg-white text-dark" autocomplete="off">';
            html += '<label class="text-danger">                                @error('collectionLabel'){{ $message }}@enderror</label>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="text" name="collectionValue[]" class="collectionValue form-control m-input bg-white text-dark" autocomplete="off">';
            html +=
                '<label class="text-danger">                                                @error('collectionValue'){{ $message }}@enderror</label>';
            html += '</td>';
            html += '<td>';
            html +=
                '<select name="collectionPerUnit[]" class="collectionPerUnit form-control bg-white text-dark"><option class="bg-white"></option><option class="bg-white" value="1">Yes</option><option class="bg-white" value="0">No</option></select>';
            html +=
                '<label class="text-danger">                                                        @error('collectionPerUnit'){{ $message }}@enderror</label>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input <input type="text" id="collectDark" name="collectionUnit[]" class="collectionUnit form-control m-input bg-white text-dark" autocomplete="off">';
            html +=
                '<label class="text-danger">                                                        @error('collectionUnit'){{ $message }}@enderror</label>';
            html += '</td>';
            html += '<td>';
            html +=
                '<div><button type="button" class=" removeRow btn btn-danger btn-sm mb-4">Remove</button></div>';
            html += '</td></tr>';

            let lastRow = $('#inputRow').find('tr').last();
            $('#inputRow').append(html);

            $('.removeRow').on('click', function() {
                $(this).closest('tr').remove();
            });

            $('.collectionPerUnit').change(function () {
                let td = $(this).parents('tr').children('td')[3];
                let input = $(td).children('input');
                if ($(this).val() == '1') {
                    $(input).attr('readonly', false);
                    $(input).addClass('bg-white');
                } else if($(this).val() == '0') {
                    $(input).attr('readonly', true);
                    $(input).removeClass('bg-white');
                    $('#collectDark').addClass('bg-dark');
                    $(input).val("");
                }
            });
        });

        $('.currentDate').flatpickr({
            enableTime: true,
            dateFormat: 'Y',
            defaultDate: new Date(),
        });

        /*$(".datepicker").datepicker({
            format: 'yyyy',
            viewMode: "years", 
            minViewMode: "years",
            autoclose: true
        });*/

        $('.currentDate').val('2021');

        $(".deadlineDatepicker").datepicker({
            format: 'mm/dd',
            autoclose: true
        });

        $("#setRateBtn").on('click', function() {
            let $form = $(this);
            Swal.fire({
                icon: 'info',
                title: 'Form will be updated. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Update',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Updated Successfully!', '', 'success')
                    $('#submit_collection_rate').submit();
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        });
    </script>
@endsection
