@extends('layouts.app', ['page' => __('Account Access'), 'pageSlug' => 'account_access'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Account Access</h1>
            </div>
        </div>
    </div>

    <form name="acc_access_form" id="acc_access_form" method="post">
        @csrf
        <div class="row">
            @foreach ($accCategories as $category_item)
                <div class="table-responsive">
                    <table class="table tablesorter" id="account-access-table">
                        <thead>
                            <tr>
                                <th>Account Title <br>{{ $category_item->acc_category_settings }}</th>
                                <th></th>
                                <th>Land Tax Collections</th>
                                <th>Feild Land Tax Collections</th>
                                <th>Cash Division Collections</th>
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
                                                            {{-- for another button based on the reference accounts access page  --}}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    
                                                    @if ($titleItems->title_name == 'Share from National Wealth-Mining')
                                                        <input class="setAccStateLandTax form-control" name="accTitlesAccessLandTax[]" type="checkbox" value="{{ $titleItems->id }}">
                                                    @else
                                                        <input class="setAccStateLandTax form-control" name="accTitlesAccessLandTax[]" type="checkbox" value="{{ $titleItems->id }}">
                                                    @endif
                                                </td>
                                                <td>
                                                    <input class="setAccStateFieldTax form-control" name="accTitlesAccessFieldTax[]" type="checkbox" value="{{ $titleItems->id }}">
                                                </td>
                                                <td>
                                                    <input class="setAccStateCash form-control" name="accTitlesAccessCash[]" type="checkbox" value="{{ $titleItems->id }}">
                                                </td>
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
                                                        <td>
                                                            @if($subItems->subtitle == 'Drugs and Medicines-5 District Hospitals' || $subItems->subtitle == 'Accountable Forms/Printed forms' || $subItems->subtitle == 'Sales on Veterinary Products')
                                                                <table class="table tablesorter">
                                                                    @foreach ($accSubSubtitles as $subSub)
                                                                        @if ($subItems->main_id == $subSub->subtitle_id)
                                                                            <tr>
                                                                                <td style="width: 5%">
                                                                                    <div>
                                                                                        {{-- <input class="form-control" name="subSubTitlesBudget[]" type="checkbox" value="{{ $subSub->id }}"> --}}
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </table>
                                                            @endif
                                                            
                                                        </td>
                                                        <td>
                                                            <input class="setAccStateLandTax form-control" name="subTitlesAccessLandTax[]" type="checkbox" value="{{ $subItems->id }}">
                                                        </td>
                                                        <td>
                                                            <input class="setAccStateFieldTax form-control" name="subTitlesAccessFieldTax[]" type="checkbox" value="{{ $subItems->id }}">
                                                        </td>
                                                        <td>
                                                            <input class="setAccStateCash form-control" name="subTitlesAccessCash[]" type="checkbox" value="{{ $subItems->id }}">
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
    </form>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $.ajax({
                'url': '{{ route('getActiveAccounts') }}',
                'data': '',
                'method': "post",
                'dataType': "json",
                'success': function(data) {
                    let activeLand = data[0];
                    let activeLandValues = [];
                    
                    activeLand.forEach(element => {
                        activeLandValues.push(element.acc_titles_id);
                    });
                    console.log(activeLandValues);
                    let checkboxValues = [];

                    $('.setAccStateLandTax').each(function() {
                        // Get the value of each checkbox
                        var checkboxValue = $(this).val();
                        checkboxValues.push(parseInt(checkboxValue));
                    });
            
                    // Now, you can compare the two arrays
                    activeLandValues.forEach(activeValue => {
                        if (checkboxValues.includes(activeValue)) {
                            
                            $('#account-access-table tr').find('td').eq(activeValue).find('input[type="checkbox"]').prop('checked', true);
                            /*
                            var selectedRow = $('#account-access-table tr').filter(function() {
                                return $(this).find('td').eq(activeValue).find('input[type="checkbox"]').prop('checked', true);
                            });
                            console.log(selectedRow);
                            */
                        }
                    });
                }
            });
        });

        let uncheckedLand = [];
        let uncheckedField = [];
        let uncheckedCash = [];
        let checker = true;
        $('.setAccStateLandTax').click(function () {
            var parent = $(this).parents('tr');
            var landTax = $(parent).find('td input[type="checkbox"]').val()[0];
            if (!$(this).prop("checked")) {
                uncheckedLand.push(landTax);
                
                checker = false;
            } else {
                landTax = [];
                uncheckedLand.push(landTax);
                $(this).addClass('checkedLand');
            }
            let accountData  = $('#acc_access_form').serializeArray();
            accountData.push({name:'uncheckedLand', value:uncheckedLand});
            
            $.ajax({
                'url': '{{ route('accountAccessForm') }}',
                'data': accountData,
                'method': "post",
                'dataType': "json",
                'success': function(data) {
                }
            });
        });

        $('.setAccStateFieldTax').click(function () {
            var parent = $(this).parents('tr');
            var fieldTax = $(parent).find('td input[type="checkbox"]').val()[0];
            if (!$(this).prop("checked")) {
                uncheckedField.push(fieldTax);
            } else {
                fieldTax = [];
                uncheckedField.push(fieldTax);
            }
            let accountData  = $('#acc_access_form').serializeArray();
            accountData.push({name:'uncheckedField', value:uncheckedField});

            $.ajax({
                'url': '{{ route('accountAccessForm') }}',
                'data': accountData,
                'method': "post",
                'dataType': "json",
                'success': function(data) {
                    let inactiveLand = data[1];
                }
            });
        });

        $('.setAccStateCash').click(function () {
            if (!$(this).prop("checked")) {
                var parent = $(this).parents('tr');
                var cash = $(parent).find('td input[type="checkbox"]').val()[0];
                uncheckedCash.push(cash);
            } else {
                cashArr = [];
                uncheckedCash.push(cashArr);
            }
            let accountData  = $('#acc_access_form').serializeArray();
            accountData.push({name:'uncheckedCash', value:uncheckedCash});

            $.ajax({
                'url': '{{ route('accountAccessForm') }}',
                'data': accountData,
                'method': "post",
                'dataType': "json",
                'success': function(data) {
                    let inactiveLand = data[2];
                }
            });
        });
        
    </script>
@endsection
