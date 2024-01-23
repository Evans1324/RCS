@extends('layouts.app', ['page' => __('Real Property Tax'), 'pageSlug' => 'property_tax'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Real Property Tax (Form 56)</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <form name="rptCollection" id="rptCollection" method="post" action="{{ url('rptCollection') }}">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 d-none">
                                            <label for="rptID">ID</label>
                                            <input type="text" class="form-control" name="rptID" id="rptID">
                                        </div>
            
                                        <div id="dateRow" class="col-md-4">
                                            <label for="rptReceiptDate">Receipt Date</label>
                                            <input type="text" class="form-control mb-0 bg-white text-dark" name="rptReceiptDate" id="rptReceiptDate" value="{{ $current_date }}">
                                        </div>

                                        <div id="editDateRow" class="col-sm-4 d-none">
                                            <label class="text-light" for="editDate">Date</label>
                                            <input type="text" name="editDate" class="form-control currentDate bg-white text-dark mb-3" id="editDate"/>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="rptReceiptNo">Series&emsp;<span id="series-counter"></span></label>
                                            <select class="form-control bg-white text-dark" name="rptReceiptNo" id="rptReceiptNo"></select>
                                            <input class="form-control bg-white text-dark d-none" name="serialNumber" id="serialNumber">
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="text-light" for="rptReceiptMunicipality">municipality</label>
                                            <input class="form-control bg-white text-dark" name="rptReceiptMunicipality" id="rptReceiptMunicipality">
                                        </div>
                                    </div>
            
                                    <hr id="client-type-separator" class="bg-white">
            
                                    <div id="client-type-others" class="row ml-2">
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="clientTypeRadio" id="individualRadio" value="Individual" checked/>
                                                <label class="form-check-label text-light" for="individualRadio"> Individual </label>
                                            </div>
                                        </div>
            
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="clientTypeRadio" id="spousesRadio" />
                                                <label class="form-check-label text-light" for="spousesRadio"> Spouse </label>
                                            </div>
                                        </div>
            
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="clientTypeRadio" id="companyRadio" />
                                                <label class="form-check-label text-light" for="companyRadio"> Company </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div id="client-type-individual" class="row">
                                        <div class="col-sm-4">
                                            <label class="text-light" for="rptReceiptLastName">Last Name</label>
                                            <input type="text" name="rptReceiptLastName" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptLastName">
                                        </div>
            
                                        <div class="col-sm-4">
                                            <label class="text-light" for="rptReceiptFirstName">First Name</label>
                                            <input type="text" name="rptReceiptFirstName" class="all-caps form-control mb-0 bg-white text-dark"
                                                id="rptReceiptFirstName">
                                        </div>
            
                                        <div class="col-sm-2">
                                            <label class="text-light" for="rptReceiptMI">M.I.</label>
                                            <input type="text" name="rptReceiptMI" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptMI">
                                        </div>
            
                                        <div class="col-sm-2">
                                            <label class="text-light" for="rptReceiptSex">Sex</label>
                                            <select class="form-control bg-white text-dark" name="rptReceiptSex" id="rptReceiptSex">
                                                <option class="bg-white" value=""></option>
                                                <option class="bg-white" value="M">M</option>
                                                <option class="bg-white" value="F">F</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="client-type-spouse" class="row d-none">
                                        <div class="col-sm-7">
                                            <label class="text-light" for="rptReceiptSpouses">Spouses</label>
                                            <input type="text" name="rptReceiptSpouses" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptSpouses">
                                        </div>
                                    </div>

                                    <div id="client-type-company" class="row d-none">
                                        <div class="col-sm-7">
                                            <label class="text-light" for="rptReceiptCompany">Company</label>
                                            <input type="text" name="rptReceiptCompany" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptCompany">
                                        </div>
                                    </div>
            
                                    <hr class="bg-white">
            
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label class="text-light" for="rptReceiptTransaction">Transaction Type</label>
                                            <select class="form-control bg-white text-dark" name="rptReceiptTransaction"
                                                id="rptReceiptTransaction">
                                                <option class="bg-white" value="null"></option>
                                                <option class="bg-white" selected value="1">Cash</option>
                                                @foreach ($getTransactionType as $transact_type)
                                                    <option class="bg-white" value="{{ $transact_type->id }}">{{ $transact_type->transaction_type_menu }}</option>
                                                @endforeach
                                            </select>
                                        </div>
            
                                        <div class="col-sm-3">
                                            <label class="text-light" for="rptReceiptBank">Bank Name</label>
                                            <input readonly type="text" name="rptReceiptBank"
                                                class="edit-trigger form-control mb-0 text-dark" id="rptReceiptBank">
                                        </div>
            
                                        <div class="col-sm-3">
                                            <label class="text-light" for="rptReceiptNumber">Number</label>
                                            <input readonly type="text" name="rptReceiptNumber"
                                                class="edit-trigger form-control mb-0 text-dark" id="rptReceiptNumber">
                                        </div>
            
                                        <div class="col-sm-2">
                                            <label class="text-light" for="rptReceiptTransactDate">Date</label>
                                            <input readonly type="text" name="rptReceiptTransactDate"
                                                class="currentDate edit-trigger datepicker form-control mb-0 text-dark" id="rptReceiptTransactDate">
                                        </div>

                                        <div class="col-sm-2">
                                            <label class="text-light" for="form56TaxType">Tax Type</label>
                                            <select class="form-control bg-white text-dark" name="form56TaxType" id="form56TaxType">
                                                <option class="bg-white" selected value="1">Collected by PTO</option>
                                                @foreach ($getTaxType as $taxType)
                                                    <option class="bg-white" value="{{ $taxType->id }}">{{ $taxType->tax_type_menu }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div id="rptRemarkSection" class="col-md-12">
                                            <label class="text-light" for="rptBankRemarks">Remarks</label>
                                            <textarea id="rptBankRemarks" name="rptBankRemarks"></textarea>
                                        </div>
                                    </div>
            
                                    <hr class="bg-white">

                                    <h3 class="card-title">Previous Receipt Details</h3>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="text-light" for="rptPrevReceipt">Prev-Receipt NO.</label>
                                            <input type="text" name="rptPrevReceipt"
                                                class="form-control mb-0 bg-white text-dark" id="rptPrevReceipt">
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="text-light" for="rptPrevDate">Prev-Date</label>
                                            <input type="text" name="rptPrevDate" class="currentDate form-control mb-0 bg-white text-dark" id="rptPrevDate">
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="text-light" for="rptPrevForYear">For the Year</label>
                                            <input type="text" name="rptPrevForYear"
                                                class="form-control mb-0 bg-white text-dark" id="rptPrevForYear">
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="text-light" for="rptPrevTaxDecNo">Tax Declaration No. <a href="#" data-toggle="tooltip" title="This field is required but will not appear on the receipt. The system will search for the previous receipt based on the Tax Declaration No. provided below"><span class="tim-icons icon-alert-circle-exc"></span></a></label>
                                            <input type="text" name="rptPrevTaxDecNo"
                                                class="form-control mb-0 bg-white text-dark" id="rptPrevTaxDecNo">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-sm-12">
                                            <label class="text-light" for="rptPrevReceiptRemarks">Previous Receipt Remarks</label>
                                            <textarea id="rptPrevReceiptRemarks" name="rptPrevReceiptRemarks"></textarea>
                                        </div>
                                    </div>

                                    <hr class="bg-white">

                                    <div class="row mt-5 mb-5">
                                        <div class="col-md-6">
                                            <label class="text-light" for="rptViewTaxDec">View TDRP By TAX DEC NO.</label>
                                            <input type="text" name="rptViewTaxDec"
                                                class="form-control mb-0 bg-white text-dark" id="rptViewTaxDec">
                                        </div>

                                        <div class="col-md-3">
                                            <button type="button" id="view-taxdec-btn" class="btn btn-primary mt-4">Go</button>
                                            <button type="button" id="close-taxdec-btn" class="btn btn-primary mt-4">Clear</button>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <iframe src="{{ asset('black') }}/img/receipt.jpg" style="border:0px #ffffff none; margin: 0 auto; display: block;" id="viewTaxDecImage" class="d-none" name="myiFrame" scrolling="no" frameborder="1" marginheight="0px" marginwidth="0px" height="1000px" width="900px" allowfullscreen></iframe>
                                        </div>
                                    </div>

                                    {{-- Dynamic Table --}}
                                    <div class="row account pb-5" id="account">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table tablesorter" id="rpt_table">
                                                    <thead>
                                                        <tr>
                                                            <th class="bg-dark">Declared Owner</th>
                                                            <th class="bg-dark">TD/ARP No.</th>
                                                            <th class="bg-dark">BARANGAY</th>
                                                            <th class="bg-dark">Classification</th>
                                                            <th class="bg-dark">Assessment Value</th>
                                                            <th class="bg-dark">Period Covered</th>
                                                            <th class="bg-dark">Full/Partial</th>
                                                            <th class="bg-dark">Current/Advance Year Gross Amt.</th>
                                                            <th class="bg-dark">Discount</th>
                                                            <th class="bg-dark">Previous Year/s</th>
                                                            <th class="bg-dark">Penalty for Current Year</th>
                                                            <th class="bg-dark">Penalty for Previous Year/s</th>
                                                            <th class="bg-dark">SEF</th>
                                                            <th class="bg-dark">BASIC</th>
                                                            <th class="bg-dark">Grand Total (net)</th>
                                                            <th class="bg-dark">
                                                                <button id="addRowRpt" type="button" class="btn btn-info btn-sm tim-icons icon-simple-add"></button>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="inputRow">
                                                        <tr>
                                                            <td class="d-none">
                                                                <input type="text" id="rptReceiptID" name="rptReceiptID"
                                                                    class="rptReceiptID form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rptDeclaredOwner[]"
                                                                    class="rptDeclaredOwner form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rptTdarpNo[]"
                                                                    class="rptTdarpNo bg-white form-control mb-0 text-dark">
                                                            </td>
                                                            <td>
                                                                <select class="rptBarangay form-control bg-white text-dark" name="rptBarangay[]" id="rptBarangay">
                                                                    <option class="bg-white" value=""></option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="rptClassification form-control bg-white text-dark" name="rptClassification[]" id="rptClassification">
                                                                    <option class="bg-white" value=""></option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rptAssessValue[]"
                                                                    class="rptAssessValue form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rptPeriodCovered[]"
                                                                    class="rptPeriodCovered form-control mb-0 bg-white text-dark" value="{{ $currYear }}">
                                                            </td>
                                                            <td>
                                                                <select class="rptFullPartial form-control bg-white text-dark" name="rptFullPartial[]" id="rptFullPartial"></select>
                                                            </td>

                                                            <td>
                                                                <input type="text" id="rptGrossAmount" name="rptGrossAmount[]" class="rptGrossAmount decimalFormat form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="rptDiscount" name="rptDiscount[]" class="rptDiscount decimalFormat form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="rptPrevYears" name="rptPrevYears[]" class="rptPrevYears decimalFormat form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="rptPenaltyCurrYear" name="rptPenaltyCurrYear[]" class="rptPenaltyCurrYear decimalFormat form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="rptPenaltyPrevYear" name="rptPenaltyPrevYear[]" class="rptPenaltyPrevYear decimalFormat form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td><div class="sefSlot"></div></td>
                                                            <td><div class="basicSlot"></div></td>
                                                            <td><div class="grandSlot"></div></td>
                                                        </tr>
            
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- Static Table --}}
                                    <div class="row mt-5" id="account">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table tablesorter" id="new-land-tax-table">
                                                    <thead>
                                                        <tr>
                                                            <th class="bg-dark">Account</th>
                                                            <th class="bg-dark"></th>
                                                            <th class="bg-dark"></th>
                                                            <th class="bg-dark"></th>
                                                            <th class="bg-dark">Nature</th>
                                                            <th class="bg-dark">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="d-none">
                                                                <input type="text" id="rptReceiptAccountID" name="rptReceiptAccountID"
                                                                    class="rptReceiptAccountID form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input readonly type="text" name="rptReceiptAccount"
                                                                    class="rptReceiptAccount form-control mb-0 bg-light text-dark" value="Real Property Tax-Basic (Net of Discount)">
                                                            </td>
                                                            <td>
                                                            </td>
                                                            <td>
                                                                <input readonly type="text" name="rptReceiptTypeRate"
                                                                    class="d-none rptReceiptTypeRate bg-light form-control mb-0 text-dark">
                                                            </td>
                                                            <td>
                                                                <input readonly type="text" name="rptReceiptQuantity"
                                                                    class="d-none rptReceiptQuantity bg-light form-control mb-0 text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rptReceiptNature"
                                                                    class="rptReceiptNature form-control mb-0 bg-white text-dark" value="Real Property Tax-Basic (Net of Discount)">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rptReceiptAmount" id="rptReceiptAmount"
                                                                    class="decimalFormat rptReceiptAmount form-control mb-0 bg-white text-dark">
                                                            </td>
            
                                                            <td></td>
                                                        </tr>
            
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><input readonly="" type="text" id="rptTotal" name="rptTotal" class="form-control mb-0 bg-light text-dark"></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" id="clearData" class="clearDataForm float-right btn btn-primary mt-4 d-none">Clear</button>
                                            <button type="button" id="submit-btn" class="float-right btn btn-primary mt-4">Save</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                        <div class="col-sm-12">
                                            <!-- START OF LEGEND -->
                                            <fieldset>
                                                <h3 class="modal-title text-white" id="toBeFilledUp">LEGEND:</h3>
                                                <button type="button" rel="tooltip" class="float-left edit btn btn-success btn-sm btn-round btn-icon">
                                                    <i class="tim-icons icon-settings"></i>
                                                </button>
                                                <h4 class="float-left mt-2 ml-1">Edit&emsp;</h4>
                                                <button type="button" rel="tooltip" class="float-left edit btn btn-danger btn-sm btn-round btn-icon">
                                                    <i class="tim-icons icon-trash-simple"></i>
                                                </button>
                                                <h4 class="float-left mt-2 ml-1">Delete&emsp;</h4>
                                                <button type="button" rel="tooltip" style="background:#d47720" class="float-left edit btn btn-sm btn-round btn-icon">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                                <h4 class="float-left mt-2 ml-1">Cancel&emsp;</h4>
                                                <button type="button" rel="tooltip" style="background: #e0c151" class="float-left edit btn btn-info btn-sm btn-round btn-icon">
                                                    <i class="tim-icons icon-paper"></i>
                                                </button>
                                                <h4 class="float-left mt-2 ml-1">View Receipt</h4>
                                            </fieldset>
                                            <!-- END OF LEGEND -->
                                        </div>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table tablesorter " id="rpt-table">
                                                <thead class=" text-primary bg-dark">
                                                    <tr>
                                                        <th class="bg-dark">Actions</th>
                                                        <th class="bg-dark">Municipality</th>
                                                        <th class="bg-dark">Barangay</th>
                                                        <th class="bg-dark">Serial</th>
                                                        <th class="bg-dark">Date</th>
                                                        <th class="bg-dark">Customer/Payor</th>
                                                        <th class="bg-dark">Transaction Type</th>
                                                        <th class="bg-dark">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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

    tinymce.init({
        selector: '#rptBankRemarks',
        forced_root_block : 'div',
    });

    tinymce.init({
        selector: '#rptPrevReceiptRemarks',
        forced_root_block : 'div',
    });

    $('.currentDate').flatpickr({
        dateFormat: 'M d, Y'
    });

    $.fn.getSeriesRPT = function() {
        $.ajax({
            method: "POST",
            url: "{{ route('getSeriesRPT') }}",
            async: false,
            data: {
                id: '',
            }
        }).done(function(data) {
            let series = data[0];
            let currentSerial = data[1];
            let previousSerial = data[2];
            $('#rptReceiptNo').html('');
            let html = '';
            series.forEach(element => {
                $('#rptReceiptMunicipality').val(element.municipality);
                html += '<option class="bg-white text-dark" value="' + element.id + '"';
                if (element.serial_number == null) {
                    html += ' >';
                    $('#series-counter').html(element.start_serial);
                    $('#serialNumber').val(element.start_serial);
                } else {
                    html += '>';
                    $('#series-counter').html(element.serial_number+1);
                    $('#serialNumber').val(element.serial_number+1);
                }
                html += element.Serial +'</option>';
            });
            $('#rptReceiptNo').html($('#rptReceiptNo').html() + html);
        });
    }

    $.fn.barnagaysMenu = function() {
        $.ajax({
            method: "POST",
            url: "{{ route('getBarangaysOnly') }}",
            async: false,
            data: {
                id: $(this).val(),
            }
        }).done(function(data) {
            $('.rptBarangay').html('<option class="bg-white" value=""></option>');
            data.forEach(element => {
                $('.rptBarangay').html($('.rptBarangay').html() +
                    '<option class="bg-white" value="' + element.id + '">' + element.barangay_name + '</option>');
            });
        });
    }

    $.fn.classificationMenu = function() {
        $.ajax({
            method: "POST",
            url: "{{ route('getClassification') }}",
            async: false,
            data: {
                id: $(this).val(),
            }
        }).done(function(data) {
            $('.rptClassification').html('<option class="bg-white" value=""></option>');
            data.forEach(element => {
                $('.rptClassification').html($('.rptClassification').html() +
                    '<option class="bg-white" value="' + element.id + '">' + element.classification_menu + '</option>');
            });
        });
    }

    $.fn.fullPartialMenu = function() {
        $.ajax({
            method: "POST",
            url: "{{ route('getFullPartial') }}",
            async: false,
            data: {
                id: $(this).val(),
            }
        }).done(function(data) {
            $('.rptFullPartial').html('<option class="bg-white" value="1">Full</option>');
            data.forEach(element => {
                $('.rptFullPartial').html($('.rptFullPartial').html() +
                    '<option class="bg-white" value="' + element.id + '">' + element.full_partial_menu + '</option>');
            });
        });
    }

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $.fn.getSeriesRPT();
    });

    $('#individualRadio').on('click', function() {
        $('#client-type-individual').removeClass('d-none');
        $('#client-type-spouse, #client-type-company').addClass('d-none');
        $('#rptReceiptLastName, #rptReceiptFirstName, #rptReceiptMI, #rptReceiptSex').val('');
        $('.indiv').removeClass('d-none');
    });

    $('#spousesRadio').on('click', function() {
        $('#client-type-spouse').removeClass('d-none');
        $('.indiv, #client-type-individual, #client-type-company').addClass('d-none');
        $('#spousesRadio').val('Spouse');
        $('#rptReceiptSpouses').val('');
    });

    $('#companyRadio').on('click', function() {
        $('.indiv, #client-type-spouse, #client-type-individual').addClass('d-none');
        $('#client-type-company').removeClass('d-none');
        $('#companyRadio').val('Company');
        $('#rptReceiptCompany').val('');
    });

    let selectStatus = false;
    $(document).ready(function() {
        if ($.fn.getSeriesRPT() != undefined) {
            $.fn.getSeriesRPT();
        }
        rptTable = $('#rpt-table').DataTable({
            info: false,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            pageLength: 10,
            dateFormat: 'yyyy-mm-dd',
            processing: true,
            serverSide: true,
            recordsTotal: 50,
            // stateSave: true,
            paging: true,
            ajax: {
                url:'{{route("getReceiptRPTData")}}',
                type: 'POST',
                dataType: "json",
                dataSrc: function ( json ) {
                return json.data;
                },
                headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            autoWidth: false,
            columns: [{
                    'data': 'main_id',
                    render: function(data, type, row) {
                        if (row.certificate == 'None') {
                            if (row.status == 'Cancelled') {
                                return '<button type="button" rel="tooltip" class="restore-btn btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-refresh-01"></i></button>';
                            } else {
                                return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button style="background:#d47720" type="button" rel="tooltip" class="cancel-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-remove"></i></button>';
                            }
                        } else {
                            if (row.status == 'Cancelled') {
                                return '<button type="button" rel="tooltip" class="restore-btn btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-refresh-01"></i></button>';
                            } else {
                                return '<button type="button" data-toggle="tooltip" data-placement="top" title="Edit Receipt" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" data-toggle="tooltip" data-placement="top" title="Delete Receipt" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button type="button" style="background:#d47720" data-toggle="tooltip" data-placement="top" title="Cancel Receipt" class="cancel-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-remove"></i></button><a target="_blank" data-toggle="tooltip" data-placement="top" title="Print Receipt" style="background: #e0c151;" class="receipt-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-tag"></i></a';
                            }
                        }
                    }
                },
                {
                    'data': 'mun_name'
                },
                {
                    'data': 'bar_name'
                },
                {
                    'data': 'serial_number'
                },
                {
                    'data': 'report_date'
                },
                {
                    'data': 'last_name',
                    render: function(data, type, row) {
                        if (row.client_type_radio == 'Individual') {
                            if (row.middle_initial == null) {
                                return row.first_name + ' ' + row.last_name;
                            } else {
                                return row.first_name + ' ' + row.middle_initial + ' ' + row.last_name;
                            }
                        } else if (row.client_type_radio == 'Spouse') {
                            return row.spouses;
                        } else if (row.client_type_radio == 'Company') {
                            return row.company;
                        }
                    }
                },
                {
                    'data': 'transaction_type_menu'
                },
                {
                    'data': 'status'
                },
            ],
            "order": [ 7, "desc" ]
        });

        $('#rpt-table tbody').on('click', '.edit', function(e) {
            selectStatus = true;
            var idx = rptTable.row($(this).parents('tr'));
            var originalData = rptTable.cells(idx, '').data();
            var data = rptTable.row( $(this).parents('tr') ).data();
            
            $('#editDate').val(moment(data.report_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY'));
            $('.clearDataForm, #editDateRow, #serialNumber').removeClass('d-none');
            $('#rptID').val(originalData[0]);
            $('#rptReceiptClientType').val(data.client_type_id);
            $('#dateRow, #rptReceiptNo').addClass('d-none');

            if (data.client_type_radio == 'Individual') {
                $('#individualRadio').trigger('click');
                $('#individualRadio').val(data.client_type_radio);
                $('#rptReceiptLastName').val(data.last_name);
                $('#rptReceiptFirstName').val(data.first_name);
                $('#rptReceiptMI').val(data.middle_name);
                $('#rptReceiptSex').val(data.sex);
            } else if (data.client_type_radio == 'Spouse') {
                $('#spousesRadio').trigger('click');
                $('#spousesRadio').val(data.client_type_radio);
                $('#rptReceiptSpouses').val(data.spouse);
            } else if (data.client_type_radio == 'Company') {
                $('#companyRadio').trigger('click');
                $('#client-type-individual, #client-type-spouse').addClass('d-none');
                $('#client-type-company').removeClass('d-none');
                $('#companyRadio').val(data.client_type_radio);
                $('#rptReceiptCompany').val(data.company);
            }

            $('#rptReceiptTransaction').val(data.transaction_type);
            $('#rptReceiptlBank').val(data.bank_name);
            $('#rptReceiptlNumber').val(data.number);
            $('#rptReceiptlTransactDate').val(data.bank_date);
            $('#form56TaxType').val(data.tax_type);
            if (data.bank_remarks != null) {
                tinymce.get("rptBankRemarks").setContent(data.bank_remarks);
            } else {
                tinymce.get("rptBankRemarks").setContent('');
            }

            $('#rptPrevReceipt').val(data.prev_receipt_no);
            $('#rptPrevDate').val(data.prev_date);
            $('#rptPrevForYear').val(data.previous_year);
            $('#rptPrevTaxDecNo').val(data.tax_dec_no);
            if (data.prev_receipt_remarks != null) {
                tinymce.get("rptPrevReceiptRemarks").setContent(data.prev_receipt_remarks);
            } else {
                tinymce.get("rptPrevReceiptRemarks").setContent('');
            }

            $('#rptReceiptAmount').val(data.amount);

            if (data.municipality_id != null) {
                $('#sefMunicipality').val(data.municipality_id);
                $('#sefMunicipality').trigger('change');
            } else {
                $('#sefMunicipality').val('');
            }

            $('#rptReceiptAmount').trigger('change');
            
            let rptReceiptID = $('.rptReceiptID')[0];
            let rptDeclaredOwner = $('.rptDeclaredOwner')[0];
            let rptTdarpNo = $('.rptTdarpNo')[0];
            let rptBarangay = $('.rptBarangay')[0];
            let rptClassification = $('.rptClassification')[0];
            let rptAssessValue = $('.rptAssessValue')[0];
            let rptPeriodCovered = $('.rptPeriodCovered')[0];
            let rptFullPartial = $('.rptFullPartial')[0];
            let rptGrossAmount = $('.rptGrossAmount')[0];
            let rptDiscount = $('.rptDiscount')[0];
            let rptPrevYears = $('.rptPrevYears')[0];
            let rptPenaltyCurrYear = $('.rptPenaltyCurrYear')[0];
            let rptPenaltyPrevYear = $('.rptPenaltyPrevYear')[0];
            let sefSlot = $('.sefSlot')[0];
            let basicSlot = $('.basicSlot')[0];
            let grandSlot = $('.grandSlot')[0];
            $(rptReceiptID, rptDeclaredOwner, rptTdarpNo, rptBarangay, rptClassification, rptAssessValue, rptPeriodCovered, rptFullPartial, rptGrossAmount, rptDiscount, rptPrevYears, rptPenaltyCurrYear, rptPenaltyPrevYear, sefSlot, basicSlot, grandSlot).val('');
            $('#rptTotal').val('');
            $('.newRow').remove();
            $('.sefSlot, .basicSlot, .grandSlot').html('');

            $.ajax({
                    method: "POST",
                    url: "{{ route('getRPTData') }}",
                    // async: false,
                    data: {
                        id: originalData[0]
                    }
                }).done(function(data) {
                    let rowCount = data.length - 1;
                    
                    if (data.length > 0) {
                        let rptReceiptID = $('.rptReceiptID')[0];
                        let rptDeclaredOwner = $('.rptDeclaredOwner')[0];
                        let rptTdarpNo = $('.rptTdarpNo')[0];
                        let rptBarangay = $('.rptBarangay')[0];
                        let rptClassification = $('.rptClassification')[0];
                        let rptAssessValue = $('.rptAssessValue')[0];
                        let rptPeriodCovered = $('.rptPeriodCovered')[0];
                        let rptFullPartial = $('.rptFullPartial')[0];
                        let rptGrossAmount = $('.rptGrossAmount')[0];
                        let rptDiscount = $('.rptDiscount')[0];
                        let rptPrevYears = $('.rptPrevYears')[0];
                        let rptPenaltyCurrYear = $('.rptPenaltyCurrYear')[0];
                        let rptPenaltyPrevYear = $('.rptPenaltyPrevYear')[0];
                        let sefSlot = $('.sefSlot')[0];
                        let basicSlot = $('.basicSlot')[0];
                        let grandSlot = $('.grandSlot')[0];
                        $(rptReceiptID).val(data[0].rpt_id);
                        $(rptDeclaredOwner).val(data[0].declared_owner);
                        $(rptTdarpNo).val(data[0].td_arp_no);
                        $(rptBarangay).val(data[0].barangay_id);
                        $(rptClassification).val(data[0].classification);
                        $(rptAssessValue).val(data[0].assessment_value);
                        $(rptPeriodCovered).val(data[0].period_covered);
                        $(rptFullPartial).val(data[0].full_partial);
                        $(rptGrossAmount).val(data[0].gross_amount);
                        $(rptDiscount).val(data[0].discount);
                        $(rptPrevYears).val(data[0].previous_year);
                        $(rptPenaltyCurrYear).val(data[0].penalty_curr_year);
                        $(rptPenaltyPrevYear).val(data[0].penalty_prev_year);
                        $(sefSlot).html(data[0].sef);
                        $(basicSlot).html(data[0].basic);
                        $(grandSlot).html(data[0].grand_total_net);
                        for (let i = 1; i <= rowCount; i++) {
                            $('#addRowRpt').trigger('click');
                            rptReceiptID = $('.rptReceiptID')[i];
                            rptDeclaredOwner = $('.rptDeclaredOwner')[i];
                            rptTdarpNo = $('.rptTdarpNo')[i];
                            rptBarangay = $('.rptBarangay')[i];
                            rptClassification = $('.rptClassification')[i];
                            rptAssessValue = $('.rptAssessValue')[i];
                            rptPeriodCovered = $('.rptPeriodCovered')[i];
                            rptFullPartial = $('.rptFullPartial')[i];
                            rptGrossAmount = $('.rptGrossAmount')[i];
                            rptDiscount = $('.rptDiscount')[i];
                            rptPrevYears = $('.rptPrevYears')[i];
                            rptPenaltyCurrYear = $('.rptPenaltyCurrYear')[i];
                            rptPenaltyPrevYear = $('.rptPenaltyPrevYear')[i];
                            sefSlot = $('.sefSlot')[i];
                            basicSlot = $('.basicSlot')[i];
                            grandSlot = $('.grandSlot')[i];
                            
                            $(rptReceiptID).val(data[i].rpt_id);
                            $(rptDeclaredOwner).val(data[i].declared_owner);
                            $(rptTdarpNo).val(data[i].td_arp_no);
                            $(rptBarangay).val(data[i].barangay_id);
                            $(rptClassification).val(data[i].classification);
                            $(rptAssessValue).val(data[i].assessment_value);
                            $(rptPeriodCovered).val(data[i].period_covered);
                            $(rptFullPartial).val(data[i].full_partial);
                            $(rptGrossAmount).val(data[i].gross_amount);
                            $(rptDiscount).val(data[i].discount);
                            $(rptPrevYears).val(data[i].previous_year);
                            $(rptPenaltyCurrYear).val(data[i].penalty_curr_year);
                            $(rptPenaltyPrevYear).val(data[i].penalty_prev_year);
                            $(sefSlot).html(data[i].sef);
                            $(basicSlot).html(data[i].basic);
                            $(grandSlot).html(data[i].grand_total_net);
                        }
                        //$('#rptTotal').val(parseFloat(total).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }
                    $('.rptReceiptAmount').trigger('keyup');
                    $('#rptTotal').trigger('change');
                });
            
            $('#submit-btn').html('Update');
            $('.edit-trigger').attr('readonly', false);
            $('.edit-trigger').addClass('bg-white');
            $('#sefTotal').val('');
        });

        $('#rpt-table tbody').on('click', '.delete-btn-cl', function(e) {
            var idx = rptTable.row($(this).parents('tr'));
            var data = rptTable.cells(idx, '').data('display');
            var originalData = rptTable.cells(idx, '').data();
            
            Swal.fire({
                title: 'Do you want to delete this Transaction?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Delete',
                icon: 'warning'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#rptID').val(data[0]);
                    $.ajax({
                    'method': "POST",
                    'url': "{{ route('deleteDataRPT') }}",
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "id": originalData[0]
                    }
                    }).done(function(data) {
                        $('#rpt-table').DataTable().ajax.reload();
                    });

                    Swal.fire({
                        title: 'Successfully Deleted',
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            });
        });

        $('#rpt-table tbody').on('click', '.cancel-btn', function (e) {
            var idx = rptTable.row($(this).parents('tr'));
            var originalData = rptTable.cells(idx, '').data();
            
            Swal.fire({
                title: 'Do you want to cancel this Transaction?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Proceed',
                icon: 'warning'
            }).then((result) => {   
                if (result.isConfirmed) {
                    $.ajax({
                    'method': "POST",
                    'url': "{{ route('cancelDataRPT') }}",
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "id": originalData[0],
                    }
                    }).done(function(data) {
                        $('#rpt-table').DataTable().ajax.reload();
                    });

                    Swal.fire({
                        title: 'Updating Transaction Status',
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            });
        });

        $('#rpt-table tbody').on('click', '.restore-btn', function (e) {
            var idx = rptTable.row($(this).parents('tr'));
            var originalData = rptTable.cells(idx, '').data();

            Swal.fire({
                title: 'Restore this receipt?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Restore',
                icon: 'warning'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    type: "POST",
                    url: "{{ route('restoreDataRPT') }}",
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "id": originalData[0],
                    }
                    }).done(function(data){
                        $('#rpt-table').DataTable().ajax.reload();
                    });

                    Swal.fire({
                        title: 'Updating Transaction Status',
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 1000
                    });
                } else {
                    Swal.fire('Problem Occured');
                }
            });
        });

        $('#rpt-table tbody').on('click', '.receipt-btn', function (e) {
            var data = rptTable.row( $(this).parents('tr') ).data();
            let serialID = 0;
            
            $.ajax({
                'url': '{{ route('openRPTReceipt') }}',
                'async': false,
                'data': {
                    serialNumber: data.serial_number
                },
                'method': "post",
                'dataType': "json",
                'success': function(data) {
                    console.log(data);
                    $('#printCertID').val(data);
                    serialID = data;
                }
            });
            $('.receipt-btn').prop('href', 'printReceiptRPT/' + serialID);
        });
    });

    $('#clearData').click(function() {
        $('#rptCollection')[0].reset();
        $('.sefSlot, .basicSlot, .grandSlot').html('');
        $(this).addClass('d-none')
        $('#serialNumber, this').addClass('d-none');
        $('#rptReceiptNo').removeClass('d-none');
        $('.newRow').remove();
        $('#submit-btn').html('Save');
        $('.edit').removeClass('bg-white');
    });


    $('#view-taxdec-btn').click(function() {
        $.ajax({
          method: "GET",
          url: "http://192.168.2.20/api/archives",
          data: {
            search_tdrp: $('#rptViewTaxDec').val(),
            municipality: $('#rptReceiptMunicipality').val(),
            barangay: $('#rptBarangay').val()
        }
          
        }).done(function(data) {
            const path_url = 'http://192.168.2.20/storage/' + data.path_image
            const data_url = path_url + "#view=Fit&zoom=85&scrollbar=0&toolbar=0&navpanes=0&page=1";
            $('#viewTaxDecImage').attr('src', data_url);
            $('#viewTaxDecImage').removeClass('d-none');
        });
    });

    $('#close-taxdec-btn').click(function() {
        $('#viewTaxDecImage').addClass('d-none');
    });

    $('.rptReceiptAmount').keyup(function () {
        $(this).mask("#00,000,000,000,000.00", {reverse: true});

        var sum = 0.00;
        $('.rptReceiptAmount').each(function() {
            let stringFloat = '0.00';
            if ($(this).val() != '') {
                stringFloat = $(this).val();
            }
            let float = stringFloat.replace(/\,/g,'');
            sum = sum + parseFloat(float);
        });
        sum = sum.toFixed(2);
        $('#rptTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });

    $('.rptReceiptAmount').change(function() {
        var sum = 0.00;
        $('.rptReceiptAmount').each(function() {
            let stringFloat = '0.00';
            if ($(this).val() != '') {
                stringFloat = $(this).val();
            }
            let float = stringFloat.replace(/\,/g,'');
            sum = sum + parseFloat(float);
        });
        sum = sum.toFixed(2);
        $('#rptTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });

    let rowCounter = 0;
    $('#addRowRpt').click(function() {
        var html = '';

        rowCounter++;
        html += '<tr class="newRow">';
        html += '<td class="d-none"><input type="text"name="rptReceiptID[]" class="rptReceiptID form-control mb-0 bg-white text-dark"></td>';

        html += '<td><input type="text" name="rptDeclaredOwner[]" class="rptDeclaredOwner form-control mb-0 bg-white text-dark"></td>';

        html += '<td><input id="rptTdarpNo'+rowCounter+'" type="text" name="rptTdarpNo[]" class="rptTdarpNo form-control mb-0 bg-white text-dark"></td>';                               
                                                                
        html += '<td><select id="rptBarangayRow'+rowCounter+'" class="rptBarangay form-control bg-white text-dark" name="rptBarangay[]"><option class="bg-white" value=""></option></select></td>';   

        html += '<td><select id="rptClassificationRow'+rowCounter+'" class="rptClassification form-control bg-white text-dark" name="rptClassification[]"><option class="bg-white" value=""></option></select></td>';

        html += '<td><input id="rptAssessValue'+rowCounter+'" type="text" name="rptAssessValue[]" class="rptAssessValue form-control mb-0 bg-white text-dark"></td>';

        html += '<td><input id="rptPeriodCovered'+rowCounter+'" type="text" name="rptPeriodCovered[]" class="rptPeriodCovered form-control mb-0 bg-white text-dark" value="2023"></td>';

        html += '<td><select id="rptFullPartial'+rowCounter+'" class="rptFullPartial form-control bg-white text-dark" name="rptFullPartial[]"></select></td>';

        html += '<td><input id="rptGrossAmount'+rowCounter+'" type="text" name="rptGrossAmount[]" class="rptGrossAmount decimalFormat form-control mb-0 bg-white text-dark"></td>';

        html += '<td><input id="rptDiscount'+rowCounter+'" type="text" name="rptDiscount[]" class="rptDiscount decimalFormat form-control mb-0 bg-white text-dark"></td>';

        html += '<td><input id="rptPrevYears'+rowCounter+'" type="text" name="rptPrevYears[]"class="rptPrevYears decimalFormat form-control mb-0 bg-white text-dark"></td>';

        html += '<td><input id="rptPenaltyCurrYear'+rowCounter+'" type="text" name="rptPenaltyCurrYear[]"class="rptPenaltyCurrYear decimalForma form-control mb-0 bg-white text-dark"></td>';

        html += '<td><input id="rptPenaltyPrevYear'+rowCounter+'" type="text" name="rptPenaltyPrevYear[]" class="rptPenaltyPrevYear decimalFormat form-control mb-0 bg-white text-dark"></td>';

        html += '<td><div class="sefSlot" id="sefSlot'+rowCounter+'"></div></td>';

        html += '<td><div class="basicSlot" id="basicSlot'+rowCounter+'"></div></td>';

        html += '<td><div class="grandSlot" id="grandSlot'+rowCounter+'"></div></td>';

        html += '<td><div><button type="button" class="removeRow btn btn-danger btn-sm mb-4 tim-icons icon-simple-delete"></button></div></td>';
        html += '</tr>';

        $('#inputRow').append(html);

        $('.decimalFormat').keyup(function() {
            $(this).mask("#00,000,000,000,000.00", {reverse: true});
        });

        setTimeout(function(){  // to prevent time lage from generating a row
            $.fn.fullPartialMenu();
        }, 1);

        $('#rptTdarpNo'+rowCounter).change(function() {
            let currentDate = new Date();
            let currentYear = currentDate.getFullYear();
            let currentMonth = currentDate.getMonth() + 1; // Adding 1 to get a 1-based month value

            $.ajax({
                method: "GET",
                url: "http://192.168.2.20/api/archives",
                data: {
                    search_tdrp: $('#rptTdarpNo'+rowCounter).val(),
                    municipality: $('#rptReceiptMunicipality').val(),
                    barangay: $('#rptBarangay').val()
                }
            }).done(function(data) {
                $('#rptDeclaredOwner'+rowCounter).val(data.owner_name);
                $('#rptTdarpNo'+rowCounter).val(data.tdrp_number);
                $('#rptBarangay'+rowCounter).val(data.barangay.id);
                $('#rptClassification'+rowCounter).val(data.td_archive_property_infos[0].measurement_id);
                $('#rptAssessValue'+rowCounter).val(data.td_archive_property_infos[0].assessed_value);
                let gross = data.td_archive_property_infos[0].assessed_value*0.01;
                let totalPercentage=initial=discount=penalty=first=second=third=fourth=totalPenalty=0;
                let monthlyPenalty = rptMonthPenaltyCurrent();
                
                if ($('#rptPeriodCovered'+rowCounter).val() == currentYear) {
                    
                    let grossDiv = gross/4;
                    let penalties = calculatePenalty();
                    first = grossDiv*penalties.penalty2ndQuarter;
                    second = grossDiv*penalties.penalty3rdQuarter;
                    third = grossDiv*penalties.penalty4thQuarter;
                    totalPenalty = initial = first+second+third;
                    
                    $('#rptGrossAmount'+rowCounter).val(gross.toFixed(2));
                    $('#rptDiscount'+rowCounter).val(0);
                    $('#rptPenaltyCurrYear'+rowCounter).val(totalPenalty.toFixed(2));
                    
                } else if ($('#rptPeriodCovered'+rowCounter).val() > currentYear) { //Advanced Payment
                    discount = gross*0.1;
                    $('#rptDiscount'+rowCounter).val(discount.toFixed(2));
                    $('#rptPrevYears'+rowCounter).val(0);
                    $('#rptPenaltyPrevYear'+rowCounter).val(0);
                } else if ($('#rptPeriodCovered'+rowCounter).val() == currentYear-1) { //Previous Year Minus 1
                    console.log(0);
                    totalPercentage = rptMonthPenaltyPrevious();
                    initial = gross*totalPercentage;
                    $('#rptGrossAmount'+rowCounter).val(0);
                    $('#rptDiscount'+rowCounter).val(0);
                    $('#rptPrevYears'+rowCounter).val(gross.toFixed(2));
                    $('#rptPenaltyPrevYear'+rowCounter).val(initial);

                } else if ($('#rptPeriodCovered'+rowCounter).val() == currentYear-2) { //Previous Year Minus 2
                    console.log(1);
                    totalPercentage = rptMonthPenaltyPrevious();
                    initial = gross*totalPercentage;
                    $('#rptGrossAmount'+rowCounter).val(0);
                    $('#rptPrevYears'+rowCounter).val(gross.toFixed(2));
                    $('#rptPenaltyPrevYear'+rowCounter).val(initial);
                } else if ($('#rptPeriodCovered'+rowCounter).val() < currentYear-2) { // Previous Years with 72%
                    initial = gross*0.72;
                    $('#rptGrossAmount'+rowCounter).val(0);
                    $('#rptPrevYears'+rowCounter).val(gross.toFixed(2));
                    $('#rptPenaltyPrevYear'+rowCounter).val(initial);
                }
                
                let basicSubTotal = gross+initial-discount;
                let sefSubTotal = gross+initial-discount;
                let grandTotal = basicSubTotal+sefSubTotal;
                
                $('#sefSlot'+rowCounter).html(sefSubTotal.toFixed(2));
                $('#basicSlot'+rowCounter).html(basicSubTotal.toFixed(2));
                $('#grandSlot'+rowCounter).html(grandTotal.toFixed(2));
                $('#rptReceiptAmount, #rptTotal'+rowCounter).val(grandTotal.toFixed(2));
            });
        });

        if (selectStatus) {
             $.ajax({
                method: "POST",
                url: "{{ route('getBarangaysOnly') }}",
                async: false,
                data: {
                    id: $(this).val(),
                }
            }).done(function(data) {
                $('#rptBarangayRow'+rowCounter).html('<option class="bg-white" value=""></option>');
                data.forEach(element => {
                    $('#rptBarangayRow'+rowCounter).html($('#rptBarangayRow'+rowCounter).html() +
                        '<option class="bg-white" value="' + element.id + '">' + element.barangay_name + '</option>');
                });
            });

            $.ajax({
                method: "POST",
                url: "{{ route('getClassification') }}",
                async: false,
                data: {
                    id: $(this).val(),
                }
            }).done(function(data) {
                $('#rptClassificationRow'+rowCounter).html('<option class="bg-white" value=""></option>');
                data.forEach(element => {
                    $('#rptClassificationRow'+rowCounter).html($('#rptClassificationRow'+rowCounter).html() +
                        '<option class="bg-white" value="' + element.id + '">' + element.classification_menu + '</option>');
                });
            });
        }
        
        $('#rptBarangayRow'+rowCounter).focus(function() {
            $.ajax({
                method: "POST",
                url: "{{ route('getBarangaysOnly') }}",
                async: false,
                data: {
                    id: $(this).val(),
                }
            }).done(function(data) {
                $('#rptBarangayRow'+rowCounter).html('<option class="bg-white" value=""></option>');
                data.forEach(element => {
                    $('#rptBarangayRow'+rowCounter).html($('#rptBarangayRow'+rowCounter).html() +
                        '<option class="bg-white" value="' + element.id + '">' + element.barangay_name + '</option>');
                });
            });
        });
        
        $('#rptClassificationRow'+rowCounter).focus(function() {
            $.ajax({
                method: "POST",
                url: "{{ route('getClassification') }}",
                async: false,
                data: {
                    id: $(this).val(),
                }
            }).done(function(data) {
                $('#rptClassificationRow'+rowCounter).html('<option class="bg-white" value=""></option>');
                data.forEach(element => {
                    $('#rptClassificationRow'+rowCounter).html($('#rptClassificationRow'+rowCounter).html() +
                        '<option class="bg-white" value="' + element.id + '">' + element.classification_menu + '</option>');
                });
            });
        });
        

        $('#rptPeriodCovered'+rowCounter).change(function() {
            $.fn.TaxDecComputation();
        });
        
        $('.removeRow').on('click', function() {
            $(this).closest('tr').remove();
            $('.rptReceiptAmount').trigger('change');
            rowCounter--;
        });
        selectStatus = false;
    });

    function rptMonthPenaltyCurrent() {
        let currentDate = new Date();
        let currentYear = currentDate.getFullYear();
        let currentMonth = currentDate.getMonth() + 1; // Adding 1 to get a 1-based month value
        let totalPercentage = 0;
        // Loop through each month starting from January of the previous year
        for (let month = 0; month <= 11; month++) {
            // Calculate percentage for the month
            const monthPercentage = (month === 0) ? 0.08 : Math.min(0.24 - totalPercentage, 2);

            // Accumulate the total percentage
            totalPercentage += monthPercentage;

            // Break out of the loop if the current month is reached
            if (month === currentMonth) {
                break;
            }

            // Break out of the loop if 48% is reached
            if (totalPercentage >= 0.48) {
                break;
            }
        }
        return totalPercentage;
    }

    function rptMonthPenaltyPrevious() {
        let currentDate = new Date();
        let currentYear = currentDate.getFullYear();
        let currentMonth = currentDate.getMonth() + 1; // Adding 1 to get a 1-based month value
        let totalPercentage = 0;
        // Loop through each month starting from January of the previous year
        for (let month = 0; month <= 11; month++) {
            // Calculate percentage for the month
            const monthPercentage = (month === 0) ? 0.26 : Math.min(0.48 - totalPercentage, 2);

            // Accumulate the total percentage
            totalPercentage += monthPercentage;

            // Break out of the loop if the current month is reached
            if (month === currentMonth) {
                break;
            }

            // Break out of the loop if 48% is reached
            if (totalPercentage >= 0.48) {
                break;
            }
        }
        return totalPercentage;
    }

    function calculatePenalty() {
        // Get the current month (0-11)
        let currentMonth = new Date().getMonth();

        // Starting month for penalty calculation
        const startMonth = 3; // April

        // Maximum penalty rate
        const maxPenaltyRate = 0.24; // 24%

        // Initial penalty rate
        let penaltyRate = 0.08; // 8%

        // Calculate the penalty for each quarter
        let penalty2ndQuarter = 0;
        let penalty3rdQuarter = 0;
        let penalty4thQuarter = 0;

        for (let i = startMonth; i <= currentMonth; i++) {
            if (i < startMonth + 3) {
                penalty2ndQuarter = penaltyRate;
            } else if (i < startMonth + 6) {
                penalty3rdQuarter = penaltyRate;
            } else if (i < startMonth + 9) {
                penalty4thQuarter = penaltyRate;
            }

            // Increase penalty rate by 2% every month, but not exceeding the maximum
            penaltyRate = Math.min(penaltyRate + 0.02, maxPenaltyRate);
        }

        return {
            penalty2ndQuarter: penalty2ndQuarter.toFixed(2), // Adjust precision as needed
            penalty3rdQuarter: penalty3rdQuarter.toFixed(2),
            penalty4thQuarter: penalty4thQuarter.toFixed(2),
        };
    }
    
    $.fn.TaxDecComputation = function() {
        let currentDate = new Date();
        let currentYear = currentDate.getFullYear();
        let currentMonth = currentDate.getMonth() + 1; // Adding 1 to get a 1-based month value
        
        $.ajax({
            method: "GET",
            url: "http://192.168.2.20/api/archives",
            data: {
                search_tdrp: $('.rptTdarpNo').val(),
                municipality: $('#rptReceiptMunicipality').val(),
                barangay: $('#rptBarangay').val()
            }
        }).done(function(data) {
            $('.rptDeclaredOwner').val(data.owner_name);
            $('.rptTdarpNo').val(data.tdrp_number);
            $('.rptBarangay').val(data.barangay.id);
            $('.rptClassification').val(data.td_archive_property_infos[0].measurement_id);
            $('.rptAssessValue').val(data.td_archive_property_infos[0].assessed_value);
            let gross = data.td_archive_property_infos[0].assessed_value*0.01;
            let totalPercentage=initial=discount=penalty=first=second=third=fourth=totalPenalty=0;
            let monthlyPenalty = rptMonthPenaltyCurrent();
            
            if ($('.rptPeriodCovered').val() == currentYear) {
                
                let grossDiv = gross/4;
                let penalties = calculatePenalty();
                first = grossDiv*penalties.penalty2ndQuarter;
                second = grossDiv*penalties.penalty3rdQuarter;
                third = grossDiv*penalties.penalty4thQuarter;
                totalPenalty = initial = first+second+third;
                
                $('.rptGrossAmount').val(gross.toFixed(2));
                $('.rptDiscount').val(0);
                $('.rptPenaltyCurrYear').val(totalPenalty.toFixed(2));
                
            } else if ($('.rptPeriodCovered').val() > currentYear) { //Advanced Payment
                discount = gross*0.1;
                $('.rptPenaltyCurrYear').val(0);
                $('.rptDiscount').val(discount.toFixed(2));
                $('.rptPrevYears').val(0);
                $('.rptPenaltyPrevYear').val(0);
            } else if ($('.rptPeriodCovered').val() == currentYear-1) { //Previous Year Minus 1
                console.log(0);
                totalPercentage = rptMonthPenaltyPrevious();
                initial = gross*totalPercentage;
                $('.rptGrossAmount').val(0);
                $('.rptDiscount').val(0);
                $('.rptPenaltyCurrYear').val(0);
                $('.rptPrevYears').val(gross.toFixed(2));
                $('.rptPenaltyPrevYear').val(initial);

            } else if ($('.rptPeriodCovered').val() == currentYear-2) { //Previous Year Minus 2
                console.log(1);
                totalPercentage = rptMonthPenaltyPrevious();
                initial = gross*totalPercentage;
                $('.rptGrossAmount').val(0);
                $('.rptPenaltyCurrYear').val(0);
                $('.rptPrevYears').val(gross.toFixed(2));
                $('.rptPenaltyPrevYear').val(initial);
            } else if ($('.rptPeriodCovered').val() < currentYear-2) { // Previous Years with 72%
                initial = gross*0.72;
                $('.rptGrossAmount').val(0);
                $('.rptPenaltyCurrYear').val(0);
                $('.rptPrevYears').val(gross.toFixed(2));
                $('.rptPenaltyPrevYear').val(initial);
            }
            
            let basicSubTotal = gross+initial-discount;
            let sefSubTotal = gross+initial-discount;
            let grandTotal = basicSubTotal+sefSubTotal;
            
            $('.sefSlot').html(sefSubTotal.toFixed(2));
            $('.basicSlot').html(basicSubTotal.toFixed(2));
            $('.grandSlot').html(grandTotal.toFixed(2));
            $('#rptReceiptAmount, #rptTotal').val(grandTotal.toFixed(2));
            
        });
    }

    $('.rptTdarpNo').change(function() {
        $.fn.TaxDecComputation();
    });

    $('.rptPeriodCovered').change(function() {
        $.fn.TaxDecComputation();
    });

    $('#rptBarangay').ready(function() {
        $.fn.barnagaysMenu();
        $.fn.classificationMenu();
        $.fn.fullPartialMenu();
    });

    $('#rptReceiptNo').change(function() {
        $.fn.getSeriesRPT();
    });

    $('.decimalFormat').keyup(function() {
       $(this).mask("#00,000,000,000,000.00", {reverse: true});
    });

    $('#submit-btn').click(function () {
        let rptData = $('#submit_rpt_receipt_form').serializeArray();

        Swal.fire({
            icon: 'info',
            title: 'Form will be Saved. Are you sure you want to proceed?',
            showCancelButton: true,
            confirmButtonText: 'Save',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    'url': '{{ route('rptSumbmitForm') }}',
                    'data': rptData,
                    'method': "post",
                    'dataType': "json",
                });
                Swal.fire({
                    icon: 'success',
                    title: 'Data has been saved',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#rptCollection')[0].reset();
                $.fn.getSeriesRPT();
                $('#clearData').addClass('d-none')
                $('#sef-table').DataTable().ajax.reload();
            }
        });
    });
    
    </script>
@endsection