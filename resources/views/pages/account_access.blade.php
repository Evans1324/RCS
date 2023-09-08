@extends('layouts.app', ['page' => __('Account Access'), 'pageSlug' => 'account_access'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Account Access</h1>
            </div>
        </div>
    </div>

    <div class="row">
         @foreach ($accCategories as $category_item)
            <div class="table-responsive">
                <table class="table tablesorter" id="budget-estimate-table">
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
                                                    <input class="form-control" name="accTitlesAccessLandTax[]" type="checkbox" value="{{ $titleItems->id }}">
                                                @else
                                                    <input class="form-control" name="accTitlesAccessLandTax[]" type="checkbox" value="{{ $titleItems->id }}">
                                                @endif
                                            </td>
                                            <td>
                                                <input class="form-control" name="accTitlesAccessFieldTax[]" type="checkbox" value="{{ $titleItems->id }}">
                                            </td>
                                            <td>
                                                <input class="form-control" name="accTitlesAccessCash[]" type="checkbox" value="{{ $titleItems->id }}">
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
                                                                                    <input class="form-control" name="subSubTitlesBudget[]" type="checkbox" value="{{ $subSub->id }}">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </table>
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="accTitlesAccessFieldTax[]" type="checkbox" value="{{ $subItems->id }}">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="accTitlesAccessFieldTax[]" type="checkbox" value="{{ $subItems->id }}">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="accTitlesAccessFieldTax[]" type="checkbox" value="{{ $subItems->id }}">
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
    <script>
    </script>
@endsection
