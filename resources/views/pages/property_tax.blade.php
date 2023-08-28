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
                        <form name="submit_rpt_receipt_form" id="submit_rpt_receipt_form" method="post" action="{{ url('submit_rpt_receipt_form') }}">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 d-none">
                                            <label for="rptReceiptsID">ID</label>
                                            <input type="text" class="form-control" name="rptReceiptsID" id="rptReceiptsID">
                                        </div>
            
                                        <div class="col-md-5">
                                            <label for="rptReceiptDate">Receipt Date</label>
                                            <input type="text" class="currentDate form-control mb-0 bg-white text-dark" name="rptReceiptDate" id="rptReceiptDate" value="{{ $current_date }}">
                                        </div>
                                        <div class="col-sm-7">
                                            <label class="text-light" for="rptReceiptClientType">Client Type</label>
                                            <select class="form-control bg-white text-dark" name="rptReceiptClientType"
                                                id="rptReceiptClientType">
                                                <option class="bg-white" value=""></option>
                                                @foreach ($displayCustType as $cust_items)
                                                    <option class="bg-white" value="{{ $cust_items->id }}">
                                                        {{ $cust_items->description_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="rptReceiptNo">Series</label>
                                            <input type="text" class="form-control mb-0 bg-white text-dark" name="rptReceiptNo"
                                                id="rptReceiptNo">
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="text-light" for="taxColrpticipality">rpticipality</label>
                                            <select class="form-control bg-white text-dark" name="taxColrpticipality"
                                                id="taxColrpticipality">
                                                <option class="bg-white" value=""></option>
                                            </select>
                                        </div>

                                        <div id="taxColBarSelect" class="col-sm-4">
                                            <label class="text-light" for="taxColBarangay">Barangay</label>
                                            <select class="form-control bg-white text-dark" name="taxColBarangay"
                                            id="taxColBarangay">
                                                <option class="bg-white" value=""></option>
                                            </select>
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
                                                <label class="form-check-label text-light" for="spousesRadio"> SPS </label>
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
                                        <div class="col-sm-4">
                                            <label class="text-light" for="rptReceiptSpouses">Spouses</label>
                                            <input type="text" name="rptReceiptSpouses" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptSpouses">
                                        </div>
                                    </div>
            
                                    <div id="client-type-company" class="row d-none">
                                        <div class="col-sm-4">
                                            <label class="text-light" for="rptReceiptCompany">Company</label>
                                            <input type="text" name="rptReceiptCompany" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptCompany">
                                        </div>
                                    </div>
            
                                    <div id="client-type-permittees" class="row d-none">
                                        <div class="col-sm-4">
                                            <label class="text-light" for="rptReceiptPermittee">Permittee</label>
                                            <input type="text" name="rptReceiptPermittee" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptPermittee">
                                        </div>
            
                                        <div class="col-sm-5">
                                            <label class="text-light" for="rptReceiptPermitteeTradeName">Trade Name</label>
                                            <input type="text" name="rptReceiptPermitteeTradeName" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptPermitteeTradeName">
                                        </div>
            
                                        <div class="col-sm-2">
                                            <div id="clientFieldPermittees"></div>
                                        </div>
                                    </div>
            
                                    <div id="client-type-permitFees" class="row d-none">
                                        <div class="col-sm-5">
                                            <label class="text-light" for="rptReceiptPermitFeesTradeName">Trade Name</label>
                                            <input type="text" name="rptReceiptPermitFeesTradeName" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptPermitFeesTradeName">
                                        </div>
            
                                        <div class="col-sm-4">
                                            <label class="text-light" for="rptReceiptProprietor">Proprietor</label>
                                            <input type="text" name="rptReceiptProprietor" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptProprietor">
                                        </div>
                                    </div>
            
                                    <div id="client-type-contractor" class="row d-none">
                                        <div class="col-sm-5">
                                            <label class="text-light" for="rptReceiptBusinessName">Business Name</label>
                                            <input type="text" name="rptReceiptBusinessName" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptBusinessName">
                                        </div>
            
                                        <div class="col-sm-4">
                                            <label class="text-light" for="rptReceiptOwner">Owner</label>
                                            <input type="text" name="rptReceiptOwner" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptOwner">
                                        </div>
            
                                        <div class="col-sm-4 d-none">
                                            <label class="text-light" for="rptReceiptAddress">Address</label>
                                            <input type="text" name="rptReceiptAddress" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptAddress">
                                        </div>
                                    </div>
            
                                    <div id="client-type-bidders" class="row d-none">
                                        <div class="col-sm-5">
                                            <label class="text-light" for="rptReceiptBiddersBusinessName">Bidders Business Name</label>
                                            <input type="text" name="rptReceiptBiddersBusinessName" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptBiddersBusinessName">
                                        </div>
            
                                        <div class="col-sm-3">
                                            <label class="text-light" for="rptReceiptBiddersOwner">Owner/Representative</label>
                                            <input type="text" name="rptReceiptBiddersOwner" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptBiddersOwner">
                                        </div>
            
                                        <div class="col-sm-2">
                                            <div id="clientFieldBidders"></div>
                                        </div>
                                    </div>
            
                                    <div id="client-type-rentals" class="row d-none">
                                        <div class="col-sm-3 d-none">
                                            <input type="text" name="rptReceiptRentalID" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptRentalID">
                                        </div>
            
                                        <div class="col-sm-3">
                                            <label class="text-light" for="rptReceiptRentalName">Rental Name</label>
                                            <input type="text" name="rptReceiptRentalName" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptRentalName">
                                        </div>
            
                                        <div class="col-sm-4">
                                            <label class="text-light" for="rptReceiptRentalLocation">Location</label>
                                            <input type="text" name="rptReceiptRentalLocation" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptRentalLocation">
                                        </div>
            
                                        <div class="col-sm-3">
                                            <label class="text-light" for="rptReceiptRentalLease">Lease of Contact</label>
                                            <input type="text" name="rptReceiptRentalLease" class="form-control mb-0 bg-white text-dark"
                                                id="rptReceiptRentalLease">
                                        </div>
            
                                        <div class="col-sm-2">
                                            <div id="clientField"></div>
                                        </div>
                                    </div>
            
                                    <hr class="bg-white">
            
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label class="text-light" for="rptReceiptTransaction">Transaction Type</label>
                                            <select class="form-control bg-white text-dark" name="rptReceiptTransaction"
                                                id="rptReceiptTransaction">
                                                <option class="bg-white" value="null"></option>
                                                <option class="bg-white" selected value="Cash">Cash</option>
                                                <option class="bg-white" value="Check">Check</option>
                                                <option class="bg-white" value="Check">Check & Cash</option>
                                                <option class="bg-white" value="Money Order">Money Order</option>
                                                <option class="bg-white" value="ADA-LBP">ADA-LBP</option>
                                                <option class="bg-white" value="Bank Deposit/Transfer">Bank Deposit/Transfer</option>
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
                                                class="edit-trigger datepicker form-control mb-0 text-dark" id="rptReceiptTransactDate">
                                        </div>

                                        <div class="col-sm-2">
                                            <label class="text-light" for="form56TaxType">Tax Type</label>
                                            <select class="form-control bg-white text-dark" name="form56TaxType"
                                                id="form56TaxType">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div id="rptRemarkSection" class="col-md-12">
                                            <label class="text-light" for="rptRemarks">Remarks</label>
                                            <textarea id="rptRemarks" name="rptRemarks"></textarea>
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
                                            <input type="text" name="rptPrevDate"
                                                class="form-control mb-0 bg-white text-dark" id="rptPrevDate">
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
                                                            <th class="bg-dark">
                                                                <button id="addRowRpt" type="button"
                                                                    class="btn btn-info btn-sm tim-icons icon-simple-add"></button>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="#">
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
                                                                <input type="text" name="rptBarangay[]"
                                                                    class="rptBarangay bg-white form-control mb-0 text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rptClassification[]"
                                                                    class="rptClassification bg-white form-control mb-0 text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rptAssessValue[]"
                                                                    class="rptAssessValue form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rptPeriodCovered[]"
                                                                    class="rptPeriodCovered form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rptFullPartial[]"
                                                                    class="rptFullPartial form-control mb-0 bg-white text-dark">
                                                            </td>
            
                                                            <td></td>
                                                        </tr>
            
                                                    </tbody>
                                                    <thead>
                                                        <tr>
                                                            <th class="bg-dark">Current/Advance Year Gross Amt.</th>
                                                            <th class="bg-dark">Discount</th>
                                                            <th class="bg-dark">Previous Year/s</th>
                                                            <th class="bg-dark">Penalty for Current Year</th>
                                                            <th class="bg-dark">Penalty for Previous Year/s</th>
                                                            <th class="bg-dark">SEF</th>
                                                            <th class="bg-dark">BASIC</th>
                                                            <th class="bg-dark">Grand Total (net)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="inputRow">
                                                        <tr>
                                                            <td>
                                                                <input type="text" id="rptGrossAmount" name="rptGrossAmount"
                                                                    class="form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="rptDiscount" name="rptDiscount"
                                                                    class="form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="rptPrevYears" name="rptPrevYears"
                                                                    class="form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="rptPenaltyCurrYear" name="rptPenaltyCurrYear"
                                                                    class="form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="rptPenaltyPrevYear" name="rptPenaltyPrevYear"
                                                                    class="form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
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
                                                                <input type="text" name="rptReceiptAccount[]"
                                                                    class="rptReceiptAccount form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                            </td>
                                                            <td>
                                                                <input readonly type="text" name="rptReceiptTypeRate[]"
                                                                    class="d-none rptReceiptTypeRate bg-light form-control mb-0 text-dark">
                                                            </td>
                                                            <td>
                                                                <input readonly type="text" name="rptReceiptQuantity[]"
                                                                    class="d-none rptReceiptQuantity bg-light form-control mb-0 text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rptReceiptNature[]"
                                                                    class="rptReceiptNature form-control mb-0 bg-white text-dark">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rptReceiptAmount[]"
                                                                    class="rptReceiptAmount form-control mb-0 bg-white text-dark">
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
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div id="remarks" class="row mt-5">
                                        <div class="col-sm-12">
                                            <label class="text-light" for="rptReceiptRemarks">Receipt Remarks</label>
                                            <textarea id="rptReceiptRemarks" name="rptReceiptRemarks"></textarea>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-md-3">
                                            <button type="button" id="submit-btn" class="btn btn-primary mt-4">Save</button>
                                            <div id="edit-buttons" class="d-none btn-group">
                                                <button type="button" id="update-btn" class="btn btn-primary mt-4">Update</button>
                                                <button type="button" id="clear-btn" class="btn btn-warning mt-4">Clear</button>
                                            </div>
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
    tinymce.init({
        selector: '#rptRemarks',
        forced_root_block : 'div',
    });

    tinymce.init({
        selector: '#rptPrevReceiptRemarks',
        forced_root_block : 'div',
    });

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('#individualRadio').on('click', function() {
        $('#client-type-individual').removeClass('d-none');
        $('#client-type-spouse').addClass('d-none');
        $('#client-type-company').addClass('d-none');
        $('#taxColLastName').val('');
        $('#taxColFirstName').val('');
        $('#taxColMI').val('');
        $('#taxColSex').val('');
        $('.indiv').removeClass('d-none');
    });

    $('#spousesRadio').on('click', function() {
        $('#client-type-spouse').removeClass('d-none');
        $('.indiv').addClass('d-none');
        $('#client-type-individual').addClass('d-none');
        $('#client-type-company').addClass('d-none');
        $('#spousesRadio').val('Spouse');
        $('#taxColSpouses').val('');
    });

    $('#companyRadio').on('click', function() {
        $('.indiv').addClass('d-none');
        $('#client-type-spouse').addClass('d-none');
        $('#client-type-individual').addClass('d-none');
        $('#client-type-company').removeClass('d-none');
        $('#companyRadio').val('Company');
        $('#taxColCompany').val('');
    });

    $('#addRowRpt').click(function() {
        var htmlHead = '';
        var html = '';
        var htmlSecHead = '';
        var htmlSec = '';

        htmlHead += '<tr></tr>'
        htmlHead += '<tr class="newHead">';
        htmlHead += '<th class="bg-dark text-white">DECLARED OWNER</th>';
        htmlHead += '<th class="bg-dark text-white">TD/ARP NO.</th>';
        htmlHead += '<th class="bg-dark text-white">BARANGAY</th>';
        htmlHead += '<th class="bg-dark text-white">CLASSIFICATION</th>';
        htmlHead += '<th class="bg-dark text-white">ASSESSMENT VALUE</th>';
        htmlHead += '<th class="bg-dark text-white">PERIOD COVERED</th>';
        htmlHead += '<th class="bg-dark text-white">FULL/PARTIAL</th>';
        htmlHead += '</tr>';

        html += '<tr class="newRowFirst">';
        html += '<td class="d-none"><input type="text"name="rptReceiptID[]" class="rptReceiptID form-control mb-0 bg-white text-dark">';

        html += '<td>';
        html += '<input type="text" name="rptDeclaredOwner[]" class="rptDeclaredOwner form-control mb-0 bg-white text-dark">';
        html += '</td>'

        html += '<td>';
        html += '<input type="text" name="rptTdarpNo[]" class="rptTdarpNo form-control mb-0 bg-white text-dark">';
        html += '</td>';

        html += '<td>';
        html += '<input readonly type="text" name="rptBarangay[]"class="rptBarangay form-control mb-0 bg-white text-dark">';
        html += '</td>';

        html += '<td>';
        html += '<input readonly type="text" name="rptClassification[]"class="rptClassification form-control mb-0 bg-white text-dark">';
        html += '</td>';

        html += '<td>';
        html += '<input type="text" name="rptAssessValue[]" class="rptAssessValue form-control mb-0 bg-white text-dark">';
        html += '</td>';

        html += '<td>';
        html += '<input type="text" name="rptPeriodCovered[]" class="rptPeriodCovered form-control mb-0 bg-white text-dark">';
        html += '</td>';

        html += '<td>';
        html += '<input type="text" name="rptFullPartial[]" class="rptFullPartial form-control mb-0 bg-white text-dark">';
        html += '</td>';

        htmlSecHead += '<tr class="newHead">';
        htmlSecHead += '<th class="bg-dark text-white">CURRENT/ADVANCE YEAR GROSS AMT.</th>';
        htmlSecHead += '<th class="bg-dark text-white">DISCOUNT</th>';
        htmlSecHead += '<th class="bg-dark text-white">PREVIOUS YEAR/S</th>';
        htmlSecHead += '<th class="bg-dark text-white">PENALTY FOR CURRENT YEAR</th>';
        htmlSecHead += '<th class="bg-dark text-white">PENALTY FOR PREVIOUS YEAR/S</th>';
        htmlSecHead += '<th class="bg-dark text-white">SEF</th>';
        htmlSecHead += '<th class="bg-dark text-white">BASIC</th>';
        htmlSecHead += '<th class="bg-dark text-white">GRAND TOTAL (NET)</th>';
        htmlSecHead += '</tr>';

        htmlSec += '<tr class="newRowSec">';
        htmlSec += '<td class="d-none"><input type="text"name="rptReceiptID[]" class="rptReceiptID form-control mb-0 bg-white text-dark">';

        htmlSec += '<td>';
        htmlSec += '<input type="text" name="rptGrossAmount[]" class="rptGrossAmount form-control mb-0 bg-white text-dark">';
        htmlSec += '</td>'

        htmlSec += '<td>';
        htmlSec += '<input type="text" name="rptDiscount[]" class="rptDiscount form-control mb-0 bg-white text-dark">';
        htmlSec += '</td>';

        htmlSec += '<td>';
        htmlSec += '<input readonly type="text" name="rptPrevYears[]"class="rptPrevYears form-control mb-0 bg-white text-dark">';
        htmlSec += '</td>';

        htmlSec += '<td>';
        htmlSec += '<input readonly type="text" name="rptPenaltyCurrYear[]"class="rptPenaltyCurrYear form-control mb-0 bg-white text-dark">';
        htmlSec += '</td>';

        htmlSec += '<td>';
        htmlSec += '<input type="text" name="rptPenaltyPrevYear[]" class="rptPenaltyPrevYear form-control mb-0 bg-white text-dark">';
        htmlSec += '</td>';

        htmlSec += '<td>';
        
        htmlSec += '</td>';

        htmlSec += '<td>';
        
        htmlSec += '</td>';

        htmlSec += '<td>';
        htmlSec += '</td>';

        htmlSec += '<td>';
        htmlSec += '<div><button type="button" class="removeRow btn btn-danger btn-sm mb-4 tim-icons icon-simple-delete"></button></div>';
        htmlSec += '</td>';
        htmlSec += '</tr>';
        
        $('#inputRow').append(htmlHead);
        $('#inputRow').append(html);
        $('#inputRow').append(htmlSecHead);
        $('#inputRow').append(htmlSec);

        let lastRow = $('#inputRow').find('tr').slice(-4);
        let secToLastRow = $('#inputRow').find('tr:nth-child(3)');
        console.log(lastRow);
        console.log(secToLastRow);

        $('.removeRow').on('click', function() {
            $(this).closest('tr').remove();
            lastRow.remove();
            $('.taxColAmount').trigger('change');
        });
    });
    
    </script>
@endsection