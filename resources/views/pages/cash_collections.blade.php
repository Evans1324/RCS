@extends('layouts.app', ['page' => __('Cash Collections'), 'pageSlug' => 'Cash Collections'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Cash Division Collections</h1>
            </div>
            <div class="card-body">
                {{-- <div class="col-md-12">
                    <div class="row"> --}}
                        <div class="card-body">
                            <div class="col-sm-12">
                                <form name="submitCashCollections" id="submitCashCollections" method="post" action="{{ url('submitCashCollections') }}">
                                @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <ul class="nav nav-tabs">
                                                <li id="cash-tab-button" value="0" role="presentation"><a href="#" id="module-button-cash" class="nav-link">Cash</a></li>
                                                <li id="opag-tab-button" value="1" role="presentation"><a href="#" id="module-button-opag" class="nav-link" >OPAG</a></li>
                                                <li id="pvet-tab-button" value="2" role="presentation"><a href="#" id="module-button-pvet" class="nav-link">PVET</a></li>
                                                <li id="pho-tab-button" value="3" role="presentation"><a href="#" id="module-button-pho" class="nav-link">PHO</a></li>
                                                <li id="hospitals-tab-button" value="4" role="presentation"><a href="#" id="module-button-hos" class="nav-link">Hospitals</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div id="cash-tab" class="mt-4">
                                        <h3>Cash</h3>
                                        <div class="row">
                                            <div class="col-sm-3 d-none">
                                                <label for="taxColID">Tax ID</label>
                                                <input type="text" name="taxColID" class="form-control mb-0 bg-white text-dark"
                                                    id="taxColID">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div id="currentDate" class="col-sm-3">
                                                <label class="text-light" for="taxColSelectDateCash">Select Date</label>
                                                <input type="text" name="taxColSelectDateCash" id="taxColSelectDateCash" class="form-control currentDate bg-white text-dark mb-3"/>
                                            </div>

                                            <div id="editDateRow" class="col-sm-3 d-none">
                                                <label class="text-light" for="editDate">Date</label>
                                                <input type="text" name="editDate" class="form-control currentDate bg-white text-dark mb-3" id="editDate"/>
                                            </div>

                                            <div id="editCurrentDate" class="col-sm-3 d-none">
                                                <label class="text-light" for="taxColEditcurrentDate">Date</label>
                                                <input type="text" name="taxColEditcurrentDate" class="form-control currentDate bg-white text-dark mb-3" id="taxColEditcurrentDate"/>
                                            </div>

                                            <div class="col-sm-3 d-none">
                                                <label class="text-light" for="taxColClientType">Client Type</label>
                                                <select class="form-control bg-white text-dark" name="taxColClientType"
                                                    id="taxColClientType">
                                                    <option class="bg-white" value="8">Individual/Company</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-3 d-none">
                                                <label class="text-light" for="taxColReceiptType">Receipt Type</label>
                                                <select class="form-control bg-white text-dark" name="taxColReceiptType" id="taxColReceiptType">
                                                    <option class="bg-white" value="Field Land Tax Collection Cash">Field Land Tax Collection Cash</option>
                                                </select>
                                            </div>

                                            <div id="seriesInput" class="col-sm-3">
                                                <label class="text-light" for="taxColSeries">Series &emsp;<span id="series-counter" class="d-none"></span></label>
                                                <select class="form-control bg-white text-dark" name="taxColSeries" id="taxColSeries">
                                                    
                                                </select>
                                            </div>

                                            <div class="col-sm-3 d-none">
                                                <label class="text-light" for="recoveredSeries">Series</label>
                                                <input class="form-control bg-white text-dark" name="recoveredSeries" id="recoveredSeries">
                                            </div>

                                            <div id="" class="col-sm-3">
                                                <label class="text-light" for="serialNumber">Serial Number</label>
                                                <input class="form-control bg-white text-dark" name="serialNumber" id="serialNumber">
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColMunicipality">Municipality</label>
                                                <select class="form-control bg-white text-dark" name="taxColMunicipality"
                                                    id="taxColMunicipality">
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColRole">Income Type</label>
                                                <select class="form-control bg-white text-dark" name="taxColRole" id="taxColRole">
                                                    <option class="bg-white" value="0">Current</option>
                                                    <option class="bg-white" value="1">Deffered</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-2 d-none">
                                                <label class="text-light" for="printStatus">Status</label>
                                                <input readonly type="text" name="printStatus"
                                                    class="bg-light form-control mb-0 text-dark" id="printStatus" value="Saved">
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
                                                    <input class="form-check-input" type="radio" name="clientTypeRadio" id="companyRadio" />
                                                    <label class="form-check-label text-light" for="companyRadio"> Company </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="client-type-individual" class="row">
                                            <div class="col-sm-3">
                                                <label class="text-light indiv" for="taxColLastName">Last Name</label>
                                                <input type="text" name="taxColLastName" class="form-control mb-0 bg-white text-dark indiv"
                                                    id="taxColLastName">
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light indiv" for="taxColFirstName">First Name</label>
                                                <input type="text" name="taxColFirstName" class="all-caps form-control mb-0 bg-white text-dark indiv"
                                                    id="taxColFirstName">
                                            </div>

                                            <div class="col-sm-1">
                                                <label class="text-light indiv" for="taxColMI">M.I.</label>
                                                <input type="text" name="taxColMI" class="form-control mb-0 bg-white text-dark indiv"
                                                    id="taxColMI">
                                            </div>

                                            <div class="col-sm-1">
                                                <label class="text-light indiv" for="taxColSex">Sex</label>
                                                <select class="form-control bg-white text-dark indiv" name="taxColSex" id="taxColSex">
                                                    <option class="bg-white" value=""></option>
                                                    <option class="bg-white" value="M">M</option>
                                                    <option class="bg-white" value="F">F</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="client-type-company" class="row d-none">
                                            <div class="col-sm-4">
                                                <label class="text-light" for="taxColCompany">Company</label>
                                                <input type="text" name="taxColCompany" class="form-control mb-0 bg-white text-dark"
                                                    id="taxColCompany">
                                            </div>
                                        </div>
                                        {{-- STOP HERE --}}
                                        <hr class="bg-white">

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColTransaction">Transaction Type</label>
                                                <select class="form-control bg-white text-dark" name="taxColTransaction"
                                                    id="taxColTransaction">
                                                    <option class="bg-white" value="null"></option>
                                                    <option class="bg-white" selected value="Cash">Cash</option>
                                                    <option class="bg-white" value="Check">Check</option>
                                                    <option class="bg-white" value="Check & Cash">Check & Cash</option>
                                                    <option class="bg-white" value="Money Order">Money Order</option>
                                                    <option class="bg-white" value="ADA-LBP">ADA-LBP</option>
                                                    <option class="bg-white" value="Bank Deposit/Transfer">Bank Deposit/Transfer</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColBank">Bank Name</label>
                                                <input readonly type="text" name="taxColBank"
                                                    class="edit-trigger form-control mb-0 text-dark" id="taxColBank">
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColNumber">Number</label>
                                                <input readonly type="text" name="taxColNumber"
                                                    class="edit-trigger form-control mb-0 text-dark" id="taxColNumber">
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColTransactDate">Date</label>
                                                <input readonly type="text" name="taxColTransactDate"
                                                    class="edit-trigger datepicker form-control mb-0 text-dark" id="taxColTransactDate">
                                            </div>

                                            <div id="bankRemarks" class="col-sm-12 d-none">
                                                <label class="text-light" for="taxColBankRemarksCash">Bank Remarks</label>
                                                <textarea id="taxColBankRemarksCash" name="taxColBankRemarksCash"></textarea>
                                            </div>
                                        </div>

                                        <hr class="bg-white">

                                        <div class="row account" id="account">
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
                                                                <th class="bg-dark">
                                                                    <button id="addRowAccount" type="button"
                                                                        class="btn btn-info btn-sm tim-icons icon-simple-add"></button>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="inputRow">
                                                            <tr>
                                                                <td class="d-none">
                                                                    <input type="text" id="taxColAccountID" name="taxColAccountID"
                                                                        class="taxColAccountID form-control mb-0 bg-white text-dark">
                                                                </td>
                                                                <td style="width: 40%">
                                                                    <input type="text" name="taxColAccount[]"
                                                                        class="taxColAccount form-control mb-0 bg-white text-dark">
                                                                </td>
                                                                <td></td>
                                                                <td>
                                                                    <input readonly type="text" class="d-none" name="taxColTypeRate[]">
                                                                </td>
                                                                <td>
                                                                    <input readonly type="text" name="taxColQuantity[]"
                                                                        class="d-none taxColQuantity bg-light form-control mb-0 text-dark">
                                                                </td>
                                                                <td style="width: 40%"> 
                                                                    <input type="text" name="taxColNature[]"
                                                                        class="taxColNature form-control mb-0 bg-white text-dark">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="taxColAmount[]"
                                                                        class="taxColAmount form-control mb-0 bg-white text-dark">
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
                                                                <td>
                                                                    <input type="text" id="taxColTotal" name="taxColTotal"
                                                                        class="form-control mb-0 bg-light text-dark" id="taxColTotal">
                                                                </td>
                                                                <td>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="remarks" class="row mt-5">
                                            <div class="col-sm-12">
                                                <label class="text-light" for="taxColReceiptRemarksCash">Receipt Remarks</label>
                                                <textarea id="taxColReceiptRemarksCash" name="taxColReceiptRemarksCash"></textarea>
                                            </div>
                                        </div>

                                        <div class="row setCashData">
                                            <button type="button" id="clearData" class="clearDataForm float-right btn btn-primary d-none">Clear</button>
                                            <button type="button" id="setNewDataCash" class="setNewDataCash float-right btn btn-primary">Save</button>
                                        </div>

                                        <div class="col-sm-12 mt-3">
                                            <input type="text" name="checkTransaction" id="checkTransaction" class="form-control mb-0 bg-white text-dark d-none">
                                        </div>

                                        <div class="row mt-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                {{-- <button type="button" id="addTaxColBtn" class="btn btn-primary">Add</button> --}}
                                                            </div>
                                                        </div>
                                                        <br>
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
                                                                </fieldset>
                                                                <!-- END OF LEGEND -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card-header">
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table tablesorter " id="cash-table">
                                                                            <thead class=" text-primary bg-dark">
                                                                                <tr>
                                                                                    <th class="bg-dark">Action</th>
                                                                                    <th class="bg-dark">User</th>
                                                                                    <th class="bg-dark">Receipt Type</th>
                                                                                    <th class="bg-dark">Serial Number</th>
                                                                                    <th class="bg-dark">Date Report</th>
                                                                                    <th class="bg-dark">Customer/Payor</th>
                                                                                    <th class="bg-dark">Transaction Type</th>
                                                                                    <th class="bg-dark">Income Type</th>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="opag-tab" class="mt-4 d-none">
                                        <h3>OPAG</h3>
                                        <div class="row">
                                            <div id="currentDateOPAG" class="col-sm-3">
                                                <label class="text-light" for="taxColSelectDateOPAG">Select Date</label>
                                                <input type="text" name="taxColSelectDateOPAG" id="taxColSelectDateOPAG" class="form-control currentDate bg-white text-dark mb-3"/>
                                            </div>

                                            <div id="editDateRowOPAG" class="col-sm-3 d-none">
                                                <label class="text-light" for="editDateOPAG">Date</label>
                                                <input type="text" name="editDateOPAG" class="form-control currentDate bg-white text-dark mb-3" id="editDateOPAG"/>
                                            </div>

                                            <div id="editCurrentDate" class="col-sm-3 d-none">
                                                <label class="text-light" for="taxColEditcurrentDate">Date</label>
                                                <input type="text" name="taxColEditcurrentDate" class="form-control currentDate bg-white text-dark mb-3" id="taxColEditcurrentDate"/>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColReportNoOPAG">Report No.</label>
                                                <input type="text" name="taxColReportNoOPAG" class="form-control bg-white text-dark mb-3" id="taxColReportNoOPAG" value="OPAG " onkeydown="return handleKeyPress(event);"/>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColAccountableOfficerOPAG">Accountable Officer</label>
                                                <select class="form-control bg-white text-dark" name="taxColAccountableOfficerOPAG" id="taxColAccountableOfficerOPAG">
                                                    <option class="bg-white" value=""></option>
                                                    @foreach ($displayOfficersOPAG as $officer)
                                                    <option class="bg-white" value="{{ $officer->officer_id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row account" id="account">
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
                                                                <th class="bg-dark">
                                                                    <button id="addRowAccountOPAG" type="button"
                                                                        class="btn btn-info btn-sm tim-icons icon-simple-add"></button>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="inputRowOPAG">
                                                            <tr>
                                                                <td class="d-none">
                                                                    <input type="text" id="taxColAccountID" name="taxColAccountID"
                                                                        class="taxColAccountID form-control mb-0 bg-white text-dark">
                                                                </td>
                                                                <td style="width: 40%">
                                                                    <input type="text" name="taxColAccount[]"
                                                                        class="taxColAccountOpag form-control mb-0 bg-white text-dark">
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                    <input readonly type="text" class="d-none" name="taxColTypeRate[]">
                                                                </td>
                                                                <td>
                                                                    <input readonly type="text" name="taxColQuantity[]"
                                                                        class="d-none taxColQuantity bg-light form-control mb-0 text-dark">
                                                                </td>
                                                                <td style="width: 40%"> 
                                                                    <input type="text" name="taxColNature[]"
                                                                        class="taxColNature taxColNatureOpag form-control mb-0 bg-white text-dark">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="taxColAmount[]"
                                                                        class="taxColAmount taxColAmountOpag form-control mb-0 bg-white text-dark">
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
                                                                <td>
                                                                    <input readonly type="text" id="taxColTotalOPAG" name="taxColTotalOPAG"
                                                                        class="form-control mb-0 bg-light text-dark" id="taxColTotalOPAG">
                                                                </td>
                                                                <td>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row setCashData">
                                            <button type="button" id="clearData" class="clearDataForm float-right btn btn-primary d-none">Clear</button>
                                            <button type="button" id="setNewDataCash" class="setNewDataCash float-right btn btn-primary">Save</button>
                                        </div>

                                        <div class="col-sm-12 mt-3">
                                            <input type="text" name="checkTransaction" id="checkTransaction" class="form-control mb-0 bg-white text-dark d-none">
                                        </div>

                                        <div class="row mt-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                {{-- <button type="button" id="addTaxColBtn" class="btn btn-primary">Add</button> --}}
                                                            </div>
                                                        </div>
                                                        <br>
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
                                                                </fieldset>
                                                                <!-- END OF LEGEND -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card-header">
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table tablesorter " id="opag-table">
                                                                            <thead class=" text-primary bg-dark">
                                                                                <tr>
                                                                                    <th class="bg-dark">Action</th>
                                                                                    <th class="bg-dark">User</th>
                                                                                    <th class="bg-dark">Date Report</th>
                                                                                    <th class="bg-dark">Report No.</th>
                                                                                    <th class="bg-dark">Accountable Officer</th>
                                                                                    <th class="bg-dark">Total Amount</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="pvet-tab" class="mt-4 d-none">
                                        <h3>PVET</h3>
                                        <div class="row">
                                            <div id="currentDatePVET" class="col-sm-3">
                                                <label class="text-light" for="taxColSelectDatePVET">Select Date</label>
                                                <input type="text" name="taxColSelectDatePVET" id="taxColSelectDatePVET" class="form-control currentDate bg-white text-dark mb-3"/>
                                            </div>

                                            <div id="editDateRowPVET" class="col-sm-3 d-none">
                                                <label class="text-light" for="editDatePVET">Date</label>
                                                <input type="text" name="editDatePVET" class="form-control currentDate bg-white text-dark mb-3" id="editDatePVET"/>
                                            </div>

                                            <div id="editCurrentDate" class="col-sm-3 d-none">
                                                <label class="text-light" for="taxColEditcurrentDate">Date</label>
                                                <input type="text" name="taxColEditcurrentDate" class="form-control currentDate bg-white text-dark mb-3" id="taxColEditcurrentDate"/>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColReportNoPVET">Report No.</label>
                                                <input type="text" name="taxColReportNoPVET" class="form-control bg-white text-dark mb-3" id="taxColReportNoPVET" value="PVET " onkeydown="return handleKeyPress(event);"/>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColAccountableOfficerPVET">Accountable Officer</label>
                                                <select class="form-control bg-white text-dark" name="taxColAccountableOfficerPVET" id="taxColAccountableOfficerPVET">
                                                    <option class="bg-white"  value=""></option>
                                                    @foreach ($displayOfficersPVET as $officer)
                                                    <option class="bg-white" value="{{ $officer->officer_id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row account" id="account">
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
                                                                <th class="bg-dark">
                                                                    <button id="addRowAccountPVET" type="button"
                                                                        class="btn btn-info btn-sm tim-icons icon-simple-add"></button>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="inputRowPVET">
                                                            <tr>
                                                                <td class="d-none">
                                                                    <input type="text" id="taxColAccountID" name="taxColAccountID"
                                                                        class="taxColAccountID form-control mb-0 bg-white text-dark">
                                                                </td>
                                                                <td style="width: 40%">
                                                                    <input type="text" name="taxColAccount[]"
                                                                        class="taxColAccountPvet form-control mb-0 bg-white text-dark">
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                    <input readonly type="text" class="d-none" name="taxColTypeRate[]">
                                                                </td>
                                                                <td>
                                                                    <input readonly type="text" name="taxColQuantity[]"
                                                                        class="d-none taxColQuantity bg-light form-control mb-0 text-dark">
                                                                </td>
                                                                <td style="width: 40%"> 
                                                                    <input type="text" name="taxColNature[]"
                                                                        class="taxColNature taxColNaturePvet form-control mb-0 bg-white text-dark">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="taxColAmount[]"
                                                                        class="taxColAmount taxColAmountPvet form-control mb-0 bg-white text-dark">
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
                                                                <td>
                                                                    <input readonly type="text" id="taxColTotalPVET" name="taxColTotalPVET"
                                                                        class="form-control mb-0 bg-light text-dark">
                                                                </td>
                                                                <td>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row setCashData">
                                            <button type="button" id="clearData" class="clearDataForm float-right btn btn-primary d-none">Clear</button>
                                            <button type="button" id="setNewDataCash" class="setNewDataCash float-right btn btn-primary">Save</button>
                                        </div>

                                        <div class="col-sm-12 mt-3">
                                            <input type="text" name="checkTransaction" id="checkTransaction" class="form-control mb-0 bg-white text-dark d-none">
                                        </div>

                                        <div class="row mt-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                {{-- <button type="button" id="addTaxColBtn" class="btn btn-primary">Add</button> --}}
                                                            </div>
                                                        </div>
                                                        <br>
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
                                                                </fieldset>
                                                                <!-- END OF LEGEND -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card-header">
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table tablesorter " id="pvet-table">
                                                                            <thead class=" text-primary bg-dark">
                                                                                <tr>
                                                                                    <th class="bg-dark">Action</th>
                                                                                    <th class="bg-dark">User</th>
                                                                                    <th class="bg-dark">Date Report</th>
                                                                                    <th class="bg-dark">Report No.</th>
                                                                                    <th class="bg-dark">Accountable Officer</th>
                                                                                    <th class="bg-dark">Total Amount</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="pho-tab" class="mt-4 d-none">
                                        <h3>PHO</h3>
                                        <div class="row">
                                            <div id="currentDatePHO" class="col-sm-3">
                                                <label class="text-light" for="taxColSelectDatePHO">Select Date</label>
                                                <input type="text" name="taxColSelectDatePHO" id="taxColSelectDatePHO" class="form-control currentDate bg-white text-dark mb-3"/>
                                            </div>

                                            <div id="editDateRowPHO" class="col-sm-3 d-none">
                                                <label class="text-light" for="editDatePHO">Date</label>
                                                <input type="text" name="editDatePHO" class="form-control currentDate bg-white text-dark mb-3" id="editDatePHO"/>
                                            </div>

                                            <div id="editCurrentDate" class="col-sm-3 d-none">
                                                <label class="text-light" for="taxColEditcurrentDate">Date</label>
                                                <input type="text" name="taxColEditcurrentDate" class="form-control currentDate bg-white text-dark mb-3" id="taxColEditcurrentDate"/>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColReportNoPHO">Report No.</label>
                                                <input type="text" name="taxColReportNoPHO" class="form-control bg-white text-dark mb-3" id="taxColReportNoPHO" value="PHO "onkeydown="return handleKeyPress(event);"/>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColAccountableOfficerPHO">Accountable Officer</label>
                                                <select class="form-control bg-white text-dark" name="taxColAccountableOfficerPHO" id="taxColAccountableOfficerPHO">
                                                    <option class="bg-white"  value=""></option>
                                                    @foreach ($displayOfficersPHO as $officer)
                                                        <option class="bg-white" value="{{ $officer->officer_id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row account" id="account">
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
                                                                <th class="bg-dark">
                                                                    <button id="addRowAccountPHO" type="button"
                                                                        class="btn btn-info btn-sm tim-icons icon-simple-add"></button>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="inputRowPHO">
                                                            <tr>
                                                                <td class="d-none">
                                                                    <input type="text" id="taxColAccountID" name="taxColAccountID"
                                                                        class="taxColAccountID form-control mb-0 bg-white text-dark">
                                                                </td>
                                                                <td style="width: 40%">
                                                                    <input type="text" name="taxColAccount[]"
                                                                        class="taxColAccountPho form-control mb-0 bg-white text-dark">
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                    <input readonly type="text" class="d-none" name="taxColTypeRate[]">
                                                                </td>
                                                                <td>
                                                                    <input readonly type="text" name="taxColQuantity[]"
                                                                        class="d-none taxColQuantity bg-light form-control mb-0 text-dark">
                                                                </td>
                                                                <td style="width: 40%"> 
                                                                    <input type="text" name="taxColNature[]"
                                                                        class="taxColNature taxColNaturePho form-control mb-0 bg-white text-dark">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="taxColAmount[]"
                                                                        class="taxColAmount taxColAmountPho form-control mb-0 bg-white text-dark">
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
                                                                <td>
                                                                    <input readonly type="text" id="taxColTotalPHO" name="taxColTotalPHO"
                                                                        class="form-control mb-0 bg-light text-dark" id="taxColTotalPHO">
                                                                </td>
                                                                <td>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row setCashData">
                                            <button type="button" id="clearData" class="clearDataForm float-right btn btn-primary d-none">Clear</button>
                                            <button type="button" id="setNewDataCash" class="setNewDataCash float-right btn btn-primary">Save</button>
                                        </div>

                                        <div class="col-sm-12 mt-3">
                                            <input type="text" name="checkTransaction" id="checkTransaction" class="form-control mb-0 bg-white text-dark d-none">
                                        </div>

                                        <div class="row mt-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                {{-- <button type="button" id="addTaxColBtn" class="btn btn-primary">Add</button> --}}
                                                            </div>
                                                        </div>
                                                        <br>
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
                                                                </fieldset>
                                                                <!-- END OF LEGEND -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card-header">
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table tablesorter " id="pho-table">
                                                                            <thead class=" text-primary bg-dark">
                                                                                <tr>
                                                                                    <th class="bg-dark">Action</th>
                                                                                    <th class="bg-dark">User</th>
                                                                                    <th class="bg-dark">Date Report</th>
                                                                                    <th class="bg-dark">Report No.</th>
                                                                                    <th class="bg-dark">Accountable Officer</th>
                                                                                    <th class="bg-dark">Total Amount</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="submitType" id="submitType" class="d-none form-control mb-0 bg-white text-dark">
                                </form>
                                <div id="hospitals-tab" class="mt-4 d-none">
                                    <form name="submitDistrictHospitals" id="submitDistrictHospitals" method="post" action="{{ url('submitDistrictHospitals') }}">
                                        @csrf
                                        <h3>District Hospitals</h3>
                                        <div class="row">
                                            <div id="districtHos" class="col-sm-3 d-none">
                                                <label class="text-light" for="districtID">District Hospital ID</label>
                                                <input type="text" name="districtID" id="districtID" class="form-control currentDate bg-white text-dark mb-3"/>
                                            </div>

                                            <div id="currentDateHos" class="col-sm-3">
                                                <label class="text-light" for="taxColSelectDateHos">Select Date</label>
                                                <input type="text" name="taxColSelectDateHos" id="taxColSelectDateHos" class="form-control currentDate bg-white text-dark mb-3"/>
                                            </div>

                                            <div id="editDateRowHos" class="col-sm-3 d-none">
                                                <label class="text-light" for="editDateHos">Date</label>
                                                <input type="text" name="editDateHos" class="form-control currentDate bg-white text-dark mb-3" id="editDateHos"/>
                                            </div>

                                            <div id="editCurrentDate" class="col-sm-3 d-none">
                                                <label class="text-light" for="taxColEditcurrentDate">Date</label>
                                                <input type="text" name="taxColEditcurrentDate" class="form-control currentDate bg-white text-dark mb-3" id="taxColEditcurrentDate"/>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColDistrictHos">District Hospital</label>
                                                <select class="form-control bg-white text-dark" name="taxColDistrictHos" id="taxColDistrictHos">
                                                    <option class="bg-white" value=""></option>
                                                    <option class="bg-white" value="ADH">ADH</option>
                                                    <option class="bg-white" value="DMDH">DMDH</option>
                                                    <option class="bg-white" value="IDH">IDH</option>
                                                    <option class="bg-white" value="KDH">KDH</option>
                                                    <option class="bg-white" value="NBD">NBDH</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColReportNoHos">Report No.</label>
                                                <input type="text" name="taxColReportNoHos" class="form-control bg-white text-dark mb-3" id="taxColReportNoHos" onkeydown="return handleKeyPress(event);"/>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="text-light" for="taxColAccountableOfficerHos">Accountable Officer</label>
                                                <select class="form-control bg-white text-dark" name="taxColAccountableOfficerHos" id="taxColAccountableOfficerHos">
                                                    <option class="bg-white"  value=""></option>
                                                    @foreach ($displayOfficersDH as $officer)
                                                        <option class="bg-white" value="{{ $officer->officer_id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <h3 class="text-white">Summary of Collections</h3>
                                            </div>

                                            <div class="col-md-6">
                                                <h3 class="text-white">Summary of Remittances</h3>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <h4 class="text-light" for="taxColMedicineHos">Medicines</h4>
                                            </div>
                                        </div>

                                        <div class="row ml-4">
                                            <div class="col-md-3">
                                                <h5 class="text-light" for="taxColCostPriceHos">Cost Price</h5>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="text" name="taxColCostPriceHos" class="left-col-input selling-price-total form-control bg-white text-dark mb-3" id="taxColCostPriceHos"/>
                                            </div>

                                            <div class="col-md-1"></div>

                                            <div class="col-md-2">
                                                <h5 class="text-light" for="taxColCashHos">Cash</h5>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="text" name="taxColCashHos" class="right-col-input form-control bg-white text-dark mb-3" id="taxColCashHos"/>
                                            </div>
                                        </div>

                                        <div class="row ml-4">
                                            <div class="col-md-3">
                                                <h5 class="text-light" for="taxColGainsHos">Gain from sale of meds</h5>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="text" name="taxColGainsHos" class="left-col-input selling-price-total form-control bg-white text-dark mb-3" id="taxColGainsHos"/>
                                            </div>

                                            <div class="col-md-1"></div>

                                            <div class="col-md-2">
                                                <h5 class="text-light" for="taxColCheckHos">Checks</h5>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="text" name="taxColCheckHos" class="right-col-input form-control bg-white text-dark mb-3" id="taxColCheckHos"/>
                                            </div>
                                        </div>

                                        <div class="row ml-4">
                                            <div class="col-md-3">
                                                <h5 class="text-light" for="taxColSellingPriceHos">Selling Price</h5>
                                            </div>

                                            <div class="col-md-2">
                                                <input readonly type="text" name="taxColSellingPriceHos" class="form-control bg-light text-dark mb-3" id="taxColSellingPriceHos"/>
                                            </div>

                                            <div class="col-md-1"></div>

                                            <div class="col-md-2">
                                                <h5 class="text-light" for="taxColDepositHos">Bank Deposit</h5>
                                            </div>

                                            <div class="col-md-2">
                                                <select class="form-control bg-white text-dark" name="taxColBankBranch" id="taxColBankBranch">
                                                    <option class="bg-white"  value=""></option>
                                                    <option class="bg-white"  value="LBP">LBP</option>
                                                    <option class="bg-white"  value="LBP-LTB">LBP-LTB</option>
                                                    <option class="bg-white"  value="LBP-Buguias">LBP-Buguias</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row ml-4">
                                            <div class="col-md-3">
                                            </div>

                                            <div class="col-md-2">
                                            </div>

                                            <div class="col-md-1"></div>

                                            <div class="col-md-2">
                                            </div>

                                            <div class="col-md-2">
                                                <input type="text" name="taxColDepositHos" class="right-col-input form-control bg-white text-dark mb-3" id="taxColDepositHos"/>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 class="text-light" for="taxColMedicalHos">Medical/Dental/Xray/supplies</h5>
                                            </div>

                                            <div class="col-md-2 ml-4">
                                                <input type="text" name="taxColMedicalHos" class="left-col-input form-control bg-white text-dark mb-3" id="taxColMedicalHos"/>
                                            </div>

                                            <div class="col-md-1"></div>

                                            <div class="col-md-2">
                                                <h5 class="text-light" for="taxColADAHos">ADA</h5>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 class="text-light" for="taxColChargesHos">Hospital Charges and Other Fees (HC)</h5>
                                            </div>

                                            <div class="col-md-2 ml-4">
                                                <input type="text" name="taxColChargesHos" class="left-col-input form-control bg-white text-dark mb-3" id="taxColChargesHos"/>
                                            </div>

                                            <div class="col-md-1"></div>

                                            <div class="col-md-2">
                                                <h5 class="text-light" for="taxColHCHos">HC</h5>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="text" name="taxColHCHos" class="right-col-input form-control bg-white text-dark mb-3" id="taxColHCHos"/>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 class="text-light" for="taxColAmublanceHos">Amublance</h5>
                                            </div>

                                            <div class="col-md-2 ml-4">
                                                <input type="text" name="taxColAmublanceHos" class="left-col-input form-control bg-white text-dark mb-3" id="taxColAmublanceHos"/>
                                            </div>

                                            <div class="col-md-1"></div>

                                            <div class="col-md-2">
                                                <h5 class="text-light" for="taxColPCHos">PC</h5>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="text" name="taxColPCHos" class="right-col-input form-control bg-white text-dark mb-3" id="taxColPCHos"/>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 class="text-light" for="taxColPHICHos">PHIC Prof. Fees</h5>
                                            </div>

                                            <div class="col-md-2 ml-4">
                                                <input type="text" name="taxColPHICHos" class="left-col-input form-control bg-white text-dark mb-3" id="taxColPHICHos"/>
                                            </div>

                                            <div class="col-md-1"></div>

                                            <div class="col-md-2">
                                                <h4 class="text-light" for="taxColSummaryTotalHos">Total</h4>
                                            </div>

                                            <div class="col-md-2">
                                                <input readonly type="text" name="taxColSummaryTotalHos" class="form-control bg-light text-dark mb-3" id="taxColSummaryTotalHos"/>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <h4 class="text-light" for="taxColAccountTotalHos">Total</h4>
                                            </div>

                                            <div class="col-md-2 ml-4">
                                                <input readonly type="text" name="taxColAccountTotalHos" class="form-control bg-light text-dark mb-3" id="taxColAccountTotalHos"/>
                                            </div>
                                        </div>

                                        <div class="row" id="setDistrictHos">
                                            <button type="button" id="clearDisHos" class="float-right btn btn-primary d-none">Clear</button>
                                            <button type="button" id="setDisHos" class="float-right btn btn-primary">Save</button>
                                        </div>

                                        <div class="row mt-5">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                {{-- <button type="button" id="addTaxColBtn" class="btn btn-primary">Add</button> --}}
                                                            </div>
                                                        </div>
                                                        <br>
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
                                                                </fieldset>
                                                                <!-- END OF LEGEND -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card-header">
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table tablesorter " id="hos-table">
                                                                            <thead class=" text-primary bg-dark">
                                                                                <tr>
                                                                                    <th class="bg-dark">Action</th>
                                                                                    <th class="bg-dark">User</th>
                                                                                    <th class="bg-dark">Date Report</th>
                                                                                    <th class="bg-dark">Report No.</th>
                                                                                    <th class="bg-dark">Disctrict Hospital</th>
                                                                                    <th class="bg-dark">Liquidating Officer</th>
                                                                                    <th class="bg-dark">Total Amount</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="saveSubmitType" id="saveSubmitType" class="d-none form-control mb-0 bg-white text-dark">
                    {{-- </div>
                </div> --}}
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function handleKeyPress(event) {
            const keycode = event.keyCode || event.which;
            const input = event.target;
            const defaultValue = input.value;
            const inputLenght = defaultValue.length;

            console.log(inputLenght);
            if ((keycode === 8 && input.selectionStart <= 5 && input.selectionStart > 4) || (keycode === 8 && input.selectionStart <= 4)) {
                event.preventDefault();
                return false;
            }
            
        }

        tinymce.init({
            selector: '#taxColReceiptRemarksCash',
            forced_root_block : 'div',
        });

        $('#cash-tab-button').click(function() {
            $('#submitCashCollections')[0].reset();
            $('.setNewDataCash').removeClass('d-none');
            $('#cash-tab').removeClass('d-none');
            $('#opag-tab').addClass('d-none');
            $('#pvet-tab').addClass('d-none');
            $('#pho-tab').addClass('d-none');
            $('#hospitals-tab').addClass('d-none');
            $('#module-button-cash').addClass('active text-white');
            $('#module-button-opag').removeClass('active text-white');
            $('#module-button-pvet').removeClass('active text-white');
            $('#module-button-pho').removeClass('active text-white');
            $('#module-button-hos').removeClass('active text-white');
            $('#client-type-company').addClass('d-none');
            $('.indiv').removeClass('d-none');
            $('#saveSubmitType').val('Cash Collection');
            $('#submitType').val($('#saveSubmitType').val());
            $('.clearDataForm').addClass('d-none');
            $('.setNewDataCash').html('Save');
            $('#taxColSeries').trigger('change');
        });

        $('#opag-tab-button').click(function() {
            $('#submitCashCollections')[0].reset();
            $('.setNewDataCash').removeClass('d-none');
            $('#cash-tab').addClass('d-none');
            $('#opag-tab').removeClass('d-none');
            $('#pvet-tab').addClass('d-none');
            $('#pho-tab').addClass('d-none');
            $('#hospitals-tab').addClass('d-none');
            $('#module-button-cash').removeClass('active text-white');
            $('#module-button-opag').addClass('active text-white');
            $('#module-button-pvet').removeClass('active text-white');
            $('#module-button-pho').removeClass('active text-white');
            $('#module-button-hos').removeClass('active text-white');
            $('#saveSubmitType').val('OPAG Collection');
            $('#submitType').val($('#saveSubmitType').val());
            $('.clearDataForm').addClass('d-none');
            $('.setNewDataCash').html('Save');
        });

        $('#pvet-tab-button').click(function() {
            $('#submitCashCollections')[0].reset();
            $('.setNewDataCash').removeClass('d-none');
            $('#cash-tab').addClass('d-none');
            $('#opag-tab').addClass('d-none');
            $('#pvet-tab').removeClass('d-none');
            $('#pho-tab').addClass('d-none');
            $('#hospitals-tab').addClass('d-none');
            $('#module-button-cash').removeClass('active text-white');
            $('#module-button-opag').removeClass('active text-white');
            $('#module-button-pvet').addClass('active text-white');
            $('#module-button-pho').removeClass('active text-white');
            $('#module-button-hos').removeClass('active text-white');
            $('#saveSubmitType').val('PVET Collection');
            $('#submitType').val($('#saveSubmitType').val());
            $('.clearDataForm').addClass('d-none');
            $('.setNewDataCash').html('Save');
        });

        $('#pho-tab-button').click(function() {
            $('#submitCashCollections')[0].reset();
            $('.setNewDataCash').removeClass('d-none');
            $('#cash-tab').addClass('d-none');
            $('#opag-tab').addClass('d-none');
            $('#pvet-tab').addClass('d-none');
            $('#pho-tab').removeClass('d-none');
            $('#hospitals-tab').addClass('d-none');
            $('#module-button-cash').removeClass('active text-white');
            $('#module-button-opag').removeClass('active text-white');
            $('#module-button-pvet').removeClass('active text-white');
            $('#module-button-pho').addClass('active text-white');
            $('#module-button-hos').removeClass('active text-white');
            $('#saveSubmitType').val('PHO Collection');
            $('#submitType').val($('#saveSubmitType').val());
            $('.clearDataForm').addClass('d-none');
            $('.setNewDataCash').html('Save');
        });

        $('#hospitals-tab-button').click(function() {
            $('#submitDistrictHospitals')[0].reset();
            $('.setNewDataCash').addClass('d-none');
            $('#cash-tab').addClass('d-none');
            $('#opag-tab').addClass('d-none');
            $('#pvet-tab').addClass('d-none');
            $('#pho-tab').addClass('d-none');
            $('#hospitals-tab').removeClass('d-none');
            $('#module-button-cash').removeClass('active text-white');
            $('#module-button-opag').removeClass('active text-white');
            $('#module-button-pvet').removeClass('active text-white');
            $('#module-button-pho').removeClass('active text-white');
            $('#module-button-hos').addClass('active text-white');
            $('#saveSubmitType').val('Hospital Collection');
            $('#submitType').val($('#saveSubmitType').val());
            $('#clearData').addClass('d-none');
            $('.setNewDataCash').html('Save');
        });
        
        $('.datepenalty').flatpickr({
            dateFormat: 'm/d/Y',
        });

        $('.datepicker').flatpickr({
            dateFormat: 'M d, Y',
        });

        $('.datepicker-cert').flatpickr({
            dateFormat: 'F d, Y',
        });

        $('.currentDate').flatpickr({
            enableTime: true,
            dateFormat: 'm/d/Y H:i',
            //defaultDate: new Date(),
        });

        tinymce.init({
            selector: '#taxColBankRemarks',
            forced_root_block : 'div'
        });

        tinymce.init({
            selector: '#notaryPublic',
            toolbar: 'undo redo | styleselect | forecolor | bold underline italic | alignleft aligncenter alignright alignjustify | fontsizeselect | outdent indent | link image | code',
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });

        $('#individualRadio').on('click', function() {
            $('#client-type-spouse').addClass('d-none');
            $('#client-type-company').addClass('d-none');
            $('#taxColLastName').val('');
            $('#taxColFirstName').val('');
            $('#taxColMI').val('');
            $('#taxColSex').val('');
            $('.indiv').removeClass('d-none');
        });

        $('#companyRadio').on('click', function() {
            $('.indiv').addClass('d-none');
            $('#client-type-spouse').addClass('d-none');
            $('#taxColCompany').removeClass('d-none');
            $('#client-type-company').removeClass('d-none');
            $('#companyRadio').val('Company');
            $('#taxColCompany').val('');
        });

        let message = @json(session('Message'));
        let table = null;
        if (message != null) {
            //Swal.fire(message);
            Swal.fire({
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 1500
            });
        }
        
        $(document).ready(function() {
            $('#module-button-cash').addClass('active text-white');
            $('#saveSubmitType').val('Cash Collection');
            $('#submitType').val($('#saveSubmitType').val());
            table = $('#cash-table').DataTable({
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
                    url:'{{route("getCashReceiptData")}}',
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
                                    return '<button type="button" data-toggle="tooltip" data-placement="top" title="Edit Receipt" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" data-toggle="tooltip" data-placement="top" title="Delete Receipt" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button type="button" style="background:#d47720" data-toggle="tooltip" data-placement="top" title="Cancel Receipt" class="cancel-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-remove"></i></button>'/*<a target="_blank" data-toggle="tooltip" data-placement="top" title="Print Receipt" style="background: #355f96;" class="receipt-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-tag"></i></a>*/;
                                }
                            }
                        }
                    },
                    {  
                        'data': 'receipt_type', // for the purpose of databales looking for data
                        render: function(data, type, row) {
                            return 'User 1'
                        }
                    },
                    {
                        'data': 'receipt_type'
                    },
                    {
                        'data': 'serial_number'
                    },
                    {
                        'data': 'report_date'
                    },
                    {
                        'data': 'owner',
                        render: function(data, type, row) {
                            if (row.client_type_radio == 'Individual' && row.municipality_id != null) {
                                return 'Municipal Government of '+row.mun_name;
                            } else if (row.client_type_radio == 'Individual') {
                                if (row.middle_initial == null) {
                                    return row.last_name + ', ' + row.first_name;
                                } else {
                                    return row.last_name + ', ' + row.first_name + ' ' + row.middle_initial;
                                }
                            } else {
                                return row.company;
                            }
                        }
                    },
                    {
                        'data': 'transact_type'
                    },
                    {
                        'data': 'role',
                        render: function (data, type, row) {
                            if (row.role == 0 || row.role == null) {
                                return 'current';
                            } else if (row.role == 1) {
                                return 'Deffered';
                            } else if (row.role == 2) {
                                return 'Accounts Receivable';
                            }
                        }
                    },
                    {
                        'data': 'status',
                        render: function(data, type, row) {
                            if (row.status == 'Cancelled') {
                                $(row).addClass('row-disabled');
                                return '<p style="color:orange; font-weight:600">Cancelled</p>'
                            } else {
                                return '<p style="color:green; font-weight:600">Saved</p>'
                            }
                        }
                    },
                    {
                        'data': 'order'
                    },
                ],
                "columnDefs": [{
                    "targets": [9],
                    "visible": false,
                }], 
                "order": [ 9, "desc" ]
            });

            opagTable = $('#opag-table').DataTable({
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
                    url:'{{route("getOPAGReceiptData")}}',
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
                                    return '<button type="button" data-toggle="tooltip" data-placement="top" title="Edit Receipt" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" data-toggle="tooltip" data-placement="top" title="Delete Receipt" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button type="button" style="background:#d47720" data-toggle="tooltip" data-placement="top" title="Cancel Receipt" class="cancel-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-remove"></i></button>'/*<a target="_blank" data-toggle="tooltip" data-placement="top" title="Print Receipt" style="background: #355f96;" class="receipt-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-tag"></i></a>*/;
                                }
                            }
                        }
                    },
                    {  
                        'data': 'receipt_type',
                        render: function(data, type, row) {
                            return 'Cash Division';
                        }
                    },
                    {
                        'data': 'report_date'
                    },
                    {
                        'data': 'report_number'
                    },
                    {
                        'data': 'officer'
                    },
                    {
                        'data': 'total_amount'
                    },
                    {
                        'data': 'order'
                    },
                ],
                "columnDefs": [{
                    "targets": [6],
                    "visible": false,
                }], 
                "order": [ 6, "desc" ]
            });

            pvetTable = $('#pvet-table').DataTable({
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
                    url:'{{route("getPVETReceiptData")}}',
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
                                    return '<button type="button" data-toggle="tooltip" data-placement="top" title="Edit Receipt" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" data-toggle="tooltip" data-placement="top" title="Delete Receipt" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button type="button" style="background:#d47720" data-toggle="tooltip" data-placement="top" title="Cancel Receipt" class="cancel-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-remove"></i></button>'/*<a target="_blank" data-toggle="tooltip" data-placement="top" title="Print Receipt" style="background: #355f96;" class="receipt-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-tag"></i></a>*/;
                                }
                            }
                        }
                    },
                    {  
                        'data': 'receipt_type', // for the purpose of databales looking for data
                        render: function(data, type, row) {
                            return 'User 1'
                        }
                    },
                    {
                        'data': 'report_date'
                    },
                    {
                        'data': 'report_number'
                    },
                    {
                        'data': 'officer',
                    },
                    {
                        'data': 'total_amount'
                    },
                    {
                        'data': 'order'
                    },
                ], 
                "columnDefs": [{
                    "targets": [6],
                    "visible": false,
                }], 
                "order": [ 6, "desc" ]
            });

            phoTable = $('#pho-table').DataTable({
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
                    url:'{{route("getPHOReceiptData")}}',
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
                                    return '<button type="button" data-toggle="tooltip" data-placement="top" title="Edit Receipt" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" data-toggle="tooltip" data-placement="top" title="Delete Receipt" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button type="button" style="background:#d47720" data-toggle="tooltip" data-placement="top" title="Cancel Receipt" class="cancel-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-remove"></i></button>'/*<a target="_blank" data-toggle="tooltip" data-placement="top" title="Print Receipt" style="background: #355f96;" class="receipt-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-tag"></i></a>*/;
                                }
                            }
                        }
                    },
                    {  
                        'data': 'receipt_type', // for the purpose of databales looking for data
                        render: function(data, type, row) {
                            return 'User 1'
                        }
                    },
                    {
                        'data': 'report_date'
                    },
                    {
                        'data': 'report_number'
                    },
                    {
                        'data': 'officer',
                    },
                    {
                        'data': 'total_amount'
                    },
                    {
                        'data': 'order'
                    },
                ], 
                "columnDefs": [{
                    "targets": [6],
                    "visible": false,
                }], 
                "order": [ 6, "desc" ]
            });

            hosTable = $('#hos-table').DataTable({
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
                    url:'{{route("getHospitalReceiptData")}}',
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
                                if (row.cash_status == 'Cancelled') {
                                    return '<button type="button" rel="tooltip" class="restore-btn btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-refresh-01"></i></button>';
                                } else {
                                    return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button style="background:#d47720" type="button" rel="tooltip" class="cancel-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-remove"></i></button>';
                                }
                            } else {
                                if (row.cash_status == 'Cancelled') {
                                    return '<button type="button" rel="tooltip" class="restore-btn btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-refresh-01"></i></button>';
                                } else {
                                    return '<button type="button" data-toggle="tooltip" data-placement="top" title="Edit Receipt" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" data-toggle="tooltip" data-placement="top" title="Delete Receipt" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button type="button" style="background:#d47720" data-toggle="tooltip" data-placement="top" title="Cancel Receipt" class="cancel-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-remove"></i></button>'/*<a target="_blank" data-toggle="tooltip" data-placement="top" title="Print Receipt" style="background: #355f96;" class="receipt-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-tag"></i></a>*/;
                                }
                            }
                        }
                    },
                    {  
                        'data': 'main_id',
                        render: function(data, type, row) {
                            return 'User 1'
                        }
                    },
                    {
                        'data': 'r_date'
                    },
                    {
                        'data': 'r_no'
                    },
                    {
                        'data': 'district_hospital',
                    },
                    {
                        'data': 'officer',
                    },
                    {
                        'data': 'total_amount',
                        render: function (data, type, row) {
                            return row.total_amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                    },
                    {
                        'data': 'order'
                    },
                ], 
                "columnDefs": [{
                    "targets": [7],
                    "visible": false,
                }], 
                "order": [ 7, "desc" ]
            });
            
            $('#cash-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                // var data1 = table.cells(idx, '').render('display');
                var originalData = table.cells(idx, '').data();
                var data = table.row( $(this).parents('tr') ).data();
                
                if (data.created_at != data.updated_at) {
                    $('#editDate').val(moment(data.report_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY h:mm'));
                } else {
                    $('#editDate').val(moment(data.report_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY h:mm'));
                }
                $('.clearDataForm').removeClass('d-none');
                $('#taxColID').val(originalData[0]);
                $('#taxColReceiptType').val(data.receipt_type);
                $('#taxColReceiptType').attr('readonly', true);
                $('#serialNumber').attr('readonly', true);
                $('#seriesInput').addClass('d-none');
                $('#taxColReceiptType').trigger('change');
                $('#taxColSeries').val(data.series_id);
                $('#serialInput').removeClass('d-none');
                if (data.client_type_radio == 'Individual') {
                    $('#individualRadio').trigger('click');
                    $('#individualRadio').val(data.client_type_radio);
                    $('#taxColLastName').val(data.last_name);
                    $('#taxColFirstName').val(data.first_name);
                    $('#taxColMI').val(data.middle_initial);
                    $('#taxColSex').val(data.sex);
                } else {
                    $('#companyRadio').trigger('click');
                    $('#client-type-individual').addClass('d-none');
                    $('#client-type-spouse').addClass('d-none');
                    $('#client-type-company').removeClass('d-none');
                    $('#companyRadio').val(data.client_type_radio);
                    $('#taxColCompany').val(data.company);
                }
                $('#serialNumber').val(data.serial_number);
                // $('#taxColTransaction').val(data.transact_type);
                $('#taxColBank').val(data.bank_name);
                $('#taxColNumber').val(data.number);
                $('#taxColTransactDate').val(data.transact_date);

                if (data.municipality_id != null) {
                    $('#taxColMunicipality').val(data.municipality_id);
                    $('#taxColMunicipality').trigger('change');
                } else {
                    $('#taxColMunicipality').val('');
                }

                if (data.mun_name != null) {
                    $('#client-type-separator').addClass('d-none');
                    $('#client-type-others').addClass('d-none');
                    $('#client-type-individual').addClass('d-none');
                    $('#client-type-company').addClass('d-none');
                }

                /*if (data.receipt_remarks != null) {
                    tinymce.get("taxColReceiptRemarks").setContent(data.receipt_remarks);
                } else {
                    tinymce.get("taxColReceiptRemarks").setContent('');
                }*/
                
                $('.setNewDataCash').html('Update');
                $('.edit-trigger').attr('readonly', false);
                $('.edit-trigger').addClass('bg-white');

                if ($('#taxColTransaction').val() == 'Cash') {
                    $('#taxColBank').addClass('bg-light').removeClass('bg-white');
                    $('#taxColBank').attr('readonly', true);
                    $('#taxColNumber').addClass('bg-light').removeClass('bg-white');
                    $('#taxColNumber').attr('readonly', true);
                    $('#taxColTransactDate').addClass('bg-light').removeClass('bg-white');
                    $('#taxColTransactDate').attr('readonly', true);
                    $('#bankRemarks').addClass('d-none');
                } else {
                    $('#bankRemarks').removeClass('d-none');
                }
                let taxColAcc = $('.taxColAccount')[0];
                let taxColNature = $('.taxColNature')[0];
                let taxColQuantity = $('.taxColQuantity')[0];
                let taxColAmount = $('.taxColAmount')[0];
                let taxColTypeRate = $('.taxColTypeRate')[0];
                $(taxColAcc).val('');
                $(taxColNature).val('');
                $(taxColQuantity).val('');
                $(taxColAmount).val('');
                $(taxColTypeRate).val('');

                $('#taxColTotal').val('');
                $('.newRow').remove();
                $.ajax({
                    method: "POST",
                    url: "{{ route('land_tax_acc_data') }}",
                    // async: false,
                    data: {
                        id: originalData[0]
                    }
                }).done(function(accData) {
                    let rowCount = accData.length - 1;
                    if (accData.length > 0) {
                        let taxColAcc = $('.taxColAccount')[0];
                        let taxColNature = $('.taxColNature')[0];
                        let taxColQuantity = $('.taxColQuantity')[0];
                        let taxColAmount = $('.taxColAmount')[0];
                        let taxColTypeRate = $('.taxColTypeRate')[0];
                        $(taxColAcc).val(accData[0].account);
                        $(taxColNature).val(accData[0].nature);
                        $(taxColQuantity).val(accData[0].quantity);
                        $(taxColAmount).val(accData[0].amount);
                        $(taxColTypeRate).val(accData[0].rate_type);

                        let total = parseFloat(accData[0].amount);
                        for (let i = 1; i <= rowCount; i++) {
                            $('#addRowAccount').trigger('click');
                            taxColAcc = $('.taxColAccount')[i];
                            taxColNature = $('.taxColNature')[i];
                            taxColQuantity = $('.taxColQuantity')[i];
                            taxColAmount = $('.taxColAmount')[i];
                            taxColTypeRate = $('.taxColTypeRate')[i];
                            total = parseFloat(accData[i].amount) + total;
                            $(taxColAcc).val(accData[i].account);
                            $(taxColNature).val(accData[i].nature);
                            $(taxColQuantity).val(accData[i].quantity);
                            $(taxColAmount).val(accData[i].amount);
                            $(taxColTypeRate).val(accData[i].rate_type);
                        }
                        $('#taxColTotal').val(parseFloat(total).toFixed(2));
                    }
                    $('.taxColAmount').trigger('keyup');
                    $('#taxColTotal').trigger('change');
                });
                $('#currentDate').addClass('d-none');
                $('#editDateRow').removeClass('d-none');
            });

            $('#opag-table tbody').on('click', '.edit', function(e) {
                var idx = opagTable.row($(this).parents('tr'));
                var originalData = opagTable.cells(idx, '').data();
                var data = opagTable.row( $(this).parents('tr') ).data();
                
                $('.clearDataForm').removeClass('d-none');
                $('#taxColID').val(originalData[0]);
                $('#taxColReceiptType').val(data.receipt_type);
                if (data.created_at != data.updated_at) {
                    $('#editDateOPAG').val(moment(data.report_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY h:mm'));
                } else {
                    $('#editDateOPAG').val(moment(data.report_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY h:mm'));
                }
                $('#taxColReportNoOPAG').val(data.report_number);
                $('#taxColAccountableOfficerOPAG').val(data.accountable_officer);

                $('.setNewDataCash').html('Update');
                $('.edit-trigger').attr('readonly', false);
                $('.edit-trigger').addClass('bg-white');

                if ($('#taxColTransaction').val() == 'Cash') {
                    $('#taxColBank').addClass('bg-light').removeClass('bg-white');
                    $('#taxColBank').attr('readonly', true);
                    $('#taxColNumber').addClass('bg-light').removeClass('bg-white');
                    $('#taxColNumber').attr('readonly', true);
                    $('#taxColTransactDate').addClass('bg-light').removeClass('bg-white');
                    $('#taxColTransactDate').attr('readonly', true);
                    $('#bankRemarks').addClass('d-none');
                } else {
                    $('#bankRemarks').removeClass('d-none');
                }

                let taxColAcc = $('.taxColAccountOpag')[0];
                let taxColNatureOpag = $('.taxColNatureOpag')[0];
                let taxColAmount = $('.taxColAmountOpag')[0];
                let taxColTypeRate = $('.taxColTypeRate')[0];
                $(taxColAcc).val('');
                $(taxColNatureOpag).val('');
                $(taxColAmount).val('');
                $(taxColTypeRate).val('');

                $('#taxColTotalOPAG').val('');
                $('.newRow').remove();
                $.ajax({
                    method: "POST",
                    url: "{{ route('land_tax_acc_data') }}",
                    // async: false,
                    data: {
                        id: originalData[0]
                    }
                }).done(function(accData) {
                    let rowCount = accData.length - 1;
                    if (accData.length > 0) {
                        let taxColAcc = $('.taxColAccountOpag')[0];
                        let taxColAmount = $('.taxColAmountOpag')[0];
                        let taxColNatureOpag = $('.taxColNatureOpag')[0];
                        $(taxColAcc).val(accData[0].account);
                        $(taxColNatureOpag).val(accData[0].nature);
                        $(taxColAmount).val(accData[0].amount);
                        $(taxColTypeRate).val(accData[0].rate_type);

                        let total = parseFloat(accData[0].amount);
                        for (let i = 1; i <= rowCount; i++) {
                            $('#addRowAccountOPAG').trigger('click');
                            taxColAcc = $('.taxColAccountOpag')[i];
                            taxColAmount = $('.taxColAmountOpag')[i];
                            taxColNatureOpag = $('.taxColNatureOpag')[i];
                            total = parseFloat(accData[i].amount) + total;
                            $(taxColAcc).val(accData[i].account);
                            $(taxColNatureOpag).val(accData[i].nature);
                            $(taxColAmount).val(accData[i].amount);
                            $(taxColTypeRate).val(accData[i].rate_type);
                        }
                        $('#taxColTotalOPAG').val(parseFloat(total).toFixed(2));
                    }
                    $('.taxColAmountOpag').trigger('keyup');
                    $('#taxColTotalOPAG').trigger('change');
                });
                $('#currentDateOPAG').addClass('d-none');
                $('#editDateRowOPAG').removeClass('d-none');
            });

            $('#pvet-table tbody').on('click', '.edit', function(e) {
                var idx = pvetTable.row($(this).parents('tr'));
                var originalData = pvetTable.cells(idx, '').data();
                var data = pvetTable.row( $(this).parents('tr') ).data();
                
                $('.clearDataForm').removeClass('d-none');
                $('#taxColID').val(originalData[0]);
                $('#taxColReceiptType').val(data.receipt_type);
                if (data.created_at != data.updated_at) {
                    $('#editDatePVET').val(moment(data.report_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY h:mm'));
                } else {
                    $('#editDatePVET').val(moment(data.report_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY h:mm'));
                }
                $('#taxColReportNoPVET').val(data.report_number);
                $('#taxColAccountableOfficerPVET').val(data.accountable_officer);
                
                $('.setNewDataCash').html('Update');
                $('.edit-trigger').attr('readonly', false);
                $('.edit-trigger').addClass('bg-white');

                if ($('#taxColTransaction').val() == 'Cash') {
                    $('#taxColBank').addClass('bg-light').removeClass('bg-white');
                    $('#taxColBank').attr('readonly', true);
                    $('#taxColNumber').addClass('bg-light').removeClass('bg-white');
                    $('#taxColNumber').attr('readonly', true);
                    $('#taxColTransactDate').addClass('bg-light').removeClass('bg-white');
                    $('#taxColTransactDate').attr('readonly', true);
                    $('#bankRemarks').addClass('d-none');
                } else {
                    $('#bankRemarks').removeClass('d-none');
                }
                
                let taxColAcc = $('.taxColAccountPvet')[0];
                let taxColAmount = $('.taxColAmountPvet')[0];
                let taxColNaturePvet = $('.taxColNaturePvet')[0];
                $(taxColAcc).val('');
                $(taxColAmount).val('');
                $(taxColNaturePvet).val('');

                $('#taxColTotalPVET').val('');
                $('.newRow').remove();
                $.ajax({
                    method: "POST",
                    url: "{{ route('land_tax_acc_data') }}",
                    // async: false,
                    data: {
                        id: originalData[0]
                    }
                }).done(function(accData) {
                    let rowCount = accData.length - 1;
                    if (accData.length > 0) {
                        let taxColAcc = $('.taxColAccountPvet')[0];
                        let taxColAmount = $('.taxColAmountPvet')[0];
                        let taxColNaturePvet = $('.taxColNaturePvet')[0];
                        $(taxColAcc).val(accData[0].account);
                        $(taxColNaturePvet).val(accData[0].nature);
                        $(taxColAmount).val(accData[0].amount);

                        let total = parseFloat(accData[0].amount);
                        for (let i = 1; i <= rowCount; i++) {
                            $('#addRowAccountPVET').trigger('click');
                            taxColAcc = $('.taxColAccountPvet')[i];
                            taxColAmount = $('.taxColAmountPvet')[i];
                            taxColNaturePvet = $('.taxColNaturePvet')[i];
                            total = parseFloat(accData[i].amount) + total;
                            $(taxColAcc).val(accData[i].account);
                            $(taxColAmount).val(accData[i].amount);
                            $(taxColNaturePvet).val(accData[i].nature);
                        }
                        $('#taxColTotalPVET').val(parseFloat(total).toFixed(2));
                    }
                    $('.taxColAmountPvet').trigger('keyup');
                    $('#taxColTotalPVET').trigger('change');
                });
                $('#currentDatePVET').addClass('d-none');
                $('#editDateRowPVET').removeClass('d-none');
            });

            $('#pho-table tbody').on('click', '.edit', function(e) {
                var idx = phoTable.row($(this).parents('tr'));
                var originalData = phoTable.cells(idx, '').data();
                var data = phoTable.row( $(this).parents('tr') ).data();
                
                $('.clearDataForm').removeClass('d-none');
                $('#taxColID').val(originalData[0]);
                $('#taxColReceiptType').val(data.receipt_type);
                if (data.created_at != data.updated_at) {
                    $('#editDatePHO').val(moment(data.report_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY h:mm'));
                } else {
                    $('#editDatePHO').val(moment(data.report_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY h:mm'));
                }
                $('#taxColReportNoPHO').val(data.report_number);
                $('#taxColAccountableOfficerPHO').val(data.accountable_officer);
                
                $('.setNewDataCash').html('Update');
                $('.edit-trigger').attr('readonly', false);
                $('.edit-trigger').addClass('bg-white');

                if ($('#taxColTransaction').val() == 'Cash') {
                    $('#taxColBank').addClass('bg-light').removeClass('bg-white');
                    $('#taxColBank').attr('readonly', true);
                    $('#taxColNumber').addClass('bg-light').removeClass('bg-white');
                    $('#taxColNumber').attr('readonly', true);
                    $('#taxColTransactDate').addClass('bg-light').removeClass('bg-white');
                    $('#taxColTransactDate').attr('readonly', true);
                    $('#bankRemarks').addClass('d-none');
                } else {
                    $('#bankRemarks').removeClass('d-none');
                }

                let taxColAcc = $('.taxColAccountPho')[0];
                let taxColAmount = $('.taxColAmountPho')[0];
                let taxColNaturePho = $('.taxColNaturePho')[0];
                $(taxColAcc).val('');
                $(taxColAmount).val('');
                $(taxColNaturePho).val('');

                $('#taxColTotalPHO').val('');
                $('.newRow').remove();
                $.ajax({
                    method: "POST",
                    url: "{{ route('land_tax_acc_data') }}",
                    // async: false,
                    data: {
                        id: originalData[0]
                    }
                }).done(function(accData) {
                    let rowCount = accData.length - 1;
                    if (accData.length > 0) {
                        let taxColAcc = $('.taxColAccountPho')[0];
                        let taxColAmount = $('.taxColAmountPho')[0];
                        let taxColNaturePho = $('.taxColNaturePho')[0];
                        $(taxColAcc).val(accData[0].account);
                        $(taxColAmount).val(accData[0].amount);
                        $(taxColNaturePho).val(accData[0].nature);

                        let total = parseFloat(accData[0].amount);
                        for (let i = 1; i <= rowCount; i++) {
                            $('#addRowAccountPHO').trigger('click');
                            taxColAcc = $('.taxColAccountPho')[i];
                            taxColAmount = $('.taxColAmountPho')[i];
                            taxColNaturePho = $('.taxColNaturePho')[i];
                            total = parseFloat(accData[i].amount) + total;
                            $(taxColAcc).val(accData[i].account);
                            $(taxColAmount).val(accData[i].amount);
                            $(taxColNaturePho).val(accData[i].nature);
                        }
                        $('#taxColTotalPHO').val(parseFloat(total).toFixed(2));
                    }
                    $('.taxColAmountPho').trigger('keyup');
                    $('#taxColTotalPHO').trigger('change');
                });
                $('#currentDatePHO').addClass('d-none');
                $('#editDateRowPHO').removeClass('d-none');
            });

            $('#hos-table tbody').on('click', '.edit', function(e) {
                var idx = hosTable.row($(this).parents('tr'));
                var originalData = hosTable.cells(idx, '').data();
                var data = hosTable.row( $(this).parents('tr') ).data();
                
                $('#clearDisHos').removeClass('d-none');
                $('#districtID').val(originalData[0]);
                if (data.created_at != data.updated_at) {
                    $('#editDateHos').val(moment(data.r_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY h:mm'));
                } else {
                    $('#editDateHos').val(moment(data.r_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY h:mm'));
                }
                $('#taxColReportNoHos').val(data.r_no);
                $('#taxColDistrictHos').val(data.district_hospital);
                $('#taxColAccountableOfficerHos').val(data.acc_officer);
                $('#taxColCostPriceHos').val(data.cost_price);
                $('#taxColGainsHos').val(data.gain_from_sale);
                $('#taxColSellingPriceHos').val(data.selling_price);
                $('#taxColMedicalHos').val(data.med_supplies);
                $('#taxColChargesHos').val(data.hospital_fees);
                $('#taxColAmublanceHos').val(data.ambulance);
                $('#taxColPHICHos').val(data.prof_fees);
                $('#taxColBankBranch').val(data.bank_branch);

                $('#taxColCashHos').val(data.cash);
                $('#taxColCheckHos').val(data.check);
                $('#taxColDepositHos').val(data.bank_deposit);
                $('#taxColHCHos').val(data.ada_hc);
                $('#taxColPCHos').val(data.ada_pc);

                $('#setDisHos').html('Update');
                $('.edit-trigger').attr('readonly', false);
                $('.edit-trigger').addClass('bg-white');
                $('.newRow').remove();

                $('.left-col-input').trigger('keyup');
                $('.right-col-input').trigger('keyup');
                
                $('#currentDateHos').addClass('d-none');
                $('#editDateRowHos').removeClass('d-none');
            });

            $('#cash-table tbody').on('click', '.delete-btn-cl', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').data('display');
                var originalData = table.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to delete this Title?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#taxColID').val(data[0]);
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('deleteCashData') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "serialNum": originalData[5],
                            "tcSeries": originalData[23]
                        }
                        }).done(function(data) {
                            $('#cash-table').DataTable().ajax.reload();
                            $('#series-counter').html(data.serial);
                            $('#serialNumber').val(data.serial);
                            $('#recoveredSeries').val(data.seriesId);
                            $('#taxColSeries').val('');
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

            $('#opag-table tbody').on('click', '.delete-btn-cl', function(e) {
                var idx = opagTable.row($(this).parents('tr'));
                var data = opagTable.cells(idx, '').data('display');
                var originalData = opagTable.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to delete this Title?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#taxColID').val(data[0]);
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('deleteCashData') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "serialNum": originalData[5],
                            "tcSeries": originalData[23]
                        }
                        }).done(function(data) {
                            $('#opag-table').DataTable().ajax.reload();
                            $('#series-counter').html(data.serial);
                            $('#serialNumber').val(data.serial);
                            $('#recoveredSeries').val(data.seriesId);
                            $('#taxColSeries').val('');
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

            $('#pvet-table tbody').on('click', '.delete-btn-cl', function(e) {
                var idx = pvetTable.row($(this).parents('tr'));
                var data = pvetTable.cells(idx, '').data('display');
                var originalData = pvetTable.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to delete this Title?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#taxColID').val(data[0]);
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('deleteCashData') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "serialNum": originalData[5],
                            "tcSeries": originalData[23]
                        }
                        }).done(function(data) {
                            $('#pvet-table').DataTable().ajax.reload();
                            $('#series-counter').html(data.serial);
                            $('#serialNumber').val(data.serial);
                            $('#recoveredSeries').val(data.seriesId);
                            $('#taxColSeries').val('');
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

            $('#pho-table tbody').on('click', '.delete-btn-cl', function(e) {
                var idx = phoTable.row($(this).parents('tr'));
                var data = phoTable.cells(idx, '').data('display');
                var originalData = phoTable.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to delete this Title?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#taxColID').val(data[0]);
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('deleteCashData') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "serialNum": originalData[5],
                            "tcSeries": originalData[23]
                        }
                        }).done(function(data) {
                            $('#pho-table').DataTable().ajax.reload();
                            $('#series-counter').html(data.serial);
                            $('#serialNumber').val(data.serial);
                            $('#recoveredSeries').val(data.seriesId);
                            $('#taxColSeries').val('');
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

            $('#hos-table tbody').on('click', '.delete-btn-cl', function(e) {
                var idx = hosTable.row($(this).parents('tr'));
                var data = hosTable.cells(idx, '').data('display');
                var originalData = hosTable.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to delete this Title?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#taxColID').val(data[0]);
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('deleteHospitalData') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                        }
                        }).done(function(data) {
                            $('#hos-table').DataTable().ajax.reload();
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
            
            $('#cash-table tbody').on('click', '.cancel-btn', function (e) {
                var idx = table.row($(this).parents('tr'));
                var originalData = table.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to cancel this receipt?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Cancel',
                    icon: 'warning'
                }).then((result) => {   
                    if (result.isConfirmed) {
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('updateReceiptStatusCash') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "status": $('#printStatus').val()
                        }
                        }).done(function(data) {
                            $('#printStatus').val('Cancelled');
                            $('#cash-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Updating Receipt Status',
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                });
            });

            $('#opag-table tbody').on('click', '.cancel-btn', function (e) {
                var idx = opagTable.row($(this).parents('tr'));
                var originalData = opagTable.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to cancel this receipt?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Cancel',
                    icon: 'warning'
                }).then((result) => {   
                    if (result.isConfirmed) {
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('updateReceiptStatusCash') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "status": $('#printStatus').val()
                        }
                        }).done(function(data) {
                            $('#printStatus').val('Cancelled');
                            $('#opag-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Updating Receipt Status',
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                });
            });

            $('#pvet-table tbody').on('click', '.cancel-btn', function (e) {
                var idx = pvetTable.row($(this).parents('tr'));
                var originalData = pvetTable.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to cancel this receipt?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Cancel',
                    icon: 'warning'
                }).then((result) => {   
                    if (result.isConfirmed) {
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('updateReceiptStatusCash') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "status": $('#printStatus').val()
                        }
                        }).done(function(data) {
                            $('#printStatus').val('Cancelled');
                            $('#pvet-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Updating Receipt Status',
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                });
            });

            $('#pho-table tbody').on('click', '.cancel-btn', function (e) {
                var idx = phoTable.row($(this).parents('tr'));
                var originalData = phoTable.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to cancel this receipt?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Cancel',
                    icon: 'warning'
                }).then((result) => {   
                    if (result.isConfirmed) {
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('updateReceiptStatusCash') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "status": $('#printStatus').val()
                        }
                        }).done(function(data) {
                            $('#printStatus').val('Cancelled');
                            $('#pho-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Updating Receipt Status',
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                });
            });

            $('#hos-table tbody').on('click', '.cancel-btn', function (e) {
                var idx = hosTable.row($(this).parents('tr'));
                var originalData = hosTable.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to cancel this receipt?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Cancel',
                    icon: 'warning'
                }).then((result) => {   
                    if (result.isConfirmed) {
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('updateReceiptStatusCash') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "hos_status": $('#printStatus').val()
                        }
                        }).done(function(data) {
                            $('#printStatus').val('Cancelled');
                            $('#hos-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Updating Receipt Status',
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                });
            });
            
            $('#cash-table tbody').on('click', '.restore-btn', function (e) {
                var idx = table.row($(this).parents('tr'));
                var originalData = table.cells(idx, '').data();

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
                        url: "{{ route('updateReceiptStatusCash') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "status": $('#printStatus').val()
                        }
                        }).done(function(data){
                            $('#printStatus').val('Saved');
                            $('#cash-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Updating Receipt Status',
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

            $('#opag-table tbody').on('click', '.restore-btn', function (e) {
                var idx = opagTable.row($(this).parents('tr'));
                var originalData = opagTable.cells(idx, '').data();

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
                        url: "{{ route('updateReceiptStatusCash') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "status": $('#printStatus').val()
                        }
                        }).done(function(data){
                            $('#printStatus').val('Saved');
                            $('#opag-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Updating Receipt Status',
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

            $('#pvet-table tbody').on('click', '.restore-btn', function (e) {
                var idx = pvetTable.row($(this).parents('tr'));
                var originalData = pvetTable.cells(idx, '').data();
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
                        url: "{{ route('updateReceiptStatusCash') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "status": $('#printStatus').val()
                        }
                        }).done(function(data){
                            $('#printStatus').val('Saved');
                            $('#pvet-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Updating Receipt Status',
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

            $('#pho-table tbody').on('click', '.restore-btn', function (e) {
                var idx = phoTable.row($(this).parents('tr'));
                var originalData = phoTable.cells(idx, '').data();

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
                        url: "{{ route('updateReceiptStatusCash') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "status": $('#printStatus').val()
                        }
                        }).done(function(data){
                            $('#printStatus').val('Saved');
                            $('#pho-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Updating Receipt Status',
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

            $('#hos-table tbody').on('click', '.restore-btn', function (e) {
                var idx = hosTable.row($(this).parents('tr'));
                var originalData = hosTable.cells(idx, '').data();
                
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
                        url: "{{ route('updateReceiptStatusCash') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "hos_status": "Cancelled" // $('#printStatus').val() 
                        }
                        }).done(function(data){
                            $('#printStatus').val('Saved');
                            $('#hos-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Updating Receipt Status',
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

            $('.clearDataForm').click(function() {
                $('#submitCashCollections')[0].reset();
                $('.clearDataForm').addClass('d-none');
                $('#submitType').val($('#saveSubmitType').val());
                $('.newRow').remove();
                $('.setNewDataCash').html('Save');
                $(this).addClass('d-none');
                $('.edit').removeClass('bg-white');
                $('#serialInput').addClass('d-none');
                $('#seriesInput').removeClass('d-none');

                $('#client-type-separator').removeClass('d-none');
                $('#client-type-others').removeClass('d-none');
                $('#client-type-individual').removeClass('d-none');
                $('#client-type-company').removeClass('d-none');
            });

            $('#clearDisHos').click(function() {
                $('#submitDistrictHospitals')[0].reset();
                $('#submitType').val($('#saveSubmitType').val());
                $('.newRow').remove();
                $('#setDisHos').html('Save');
                $(this).addClass('d-none');
                $('.edit').removeClass('bg-white');
                $('#serialInput').addClass('d-none');
                $('#seriesInput').removeClass('d-none');
            });
        });

        $('#taxColDistrictHos').change(function () {
            $('#taxColReportNoHos').val($(this).val()+' ');
        });

        $('#taxColSeries').change(function () {
            let seriesVal = $(this).val();
            $(this).find('option[value="' + seriesVal + '"]').attr("selected", "selected");
            $.ajax({
                method: "POST",
                url: "{{ route('getCurrentSerialCash') }}",
                async: false,
                data: {
                    id: $(this).val(),
                    taxColReceiptType: $('#taxColReceiptType').val()
                }
            }).done(function(data) {
                if (data == 'Serial Error') {
                    Swal.fire({
                        title: 'Series Complete.Please assign a new series',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                        icon: 'warning'
                    });
                    $('#serialNumber').val('');
                    $('#series-counter').html('');
                } else {
                    let counterVal = data;

                    $('#serialNumber').val(data);
                    $('#series-counter').html(data);
                }
            });
        });
        
        $('#taxColReceiptType').ready(function () {
            $.ajax({
                method: "POST",
                url: "{{ route('getSeriesCash') }}",
                async: false,
                data: {
                    id: $('#taxColReceiptType').val(),
                }
            }).done(function(data) {
                if (data == 'Serial Error') {
                    Swal.fire({
                        title: 'Series Complete.Please assign a new series',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                        icon: 'warning'
                    });
                    $('#serialNumber').val('');
                    $('#series-counter').html('');
                    
                } else {
                    let series = data[0];
                    let currentSerial = data[1];
                    let previousSerial = data[2];
                    let html = '';
                    $('#taxColSeries').html('');
                    series.forEach(element => {
                        html += '<option class="bg-white" value="' + element.id + '"';
                        if (element.Serial.includes(previousSerial.start_serial) && element.unit == 'Pad') {
                            console.log(previousSerial.serial_number);
                            html += 'selected >';
                            $('#series-counter').html(previousSerial.serial_number+1);
                            $('#serialNumber').val(previousSerial.serial_number+1);
                        } else {
                            html += '>';
                            
                            if (element.unit == 'Pad') {
                                $('#series-counter').html(previousSerial.serial_number+1);
                                $('#serialNumber').val(previousSerial.serial_number+1);
                            } else {
                                if (element.serial_number == null) {
                                    $('#series-counter').html(element.start_serial);
                                    $('#serialNumber').val(element.start_serial);
                                } else {
                                    $('#series-counter').html(element.serial_number+1);
                                    $('#serialNumber').val(element.serial_number+1);
                                }
                            }
                        }
                        html += element.Serial +'</option>';
                    });
                    $('#taxColSeries').html($('#taxColSeries').html() + html);
                }
            });

            if ($(this).val() == 'Field Land Tax Collection') {
                $('#serialInput').removeClass('d-none');
            } else {
                $('#serialInput').removeClass('d-none');
                $('#serialInput').addClass('d-none');
            }
            $('#series-counter').removeClass('d-none');
        });

        $('#serialNumber').keyup(function() {
            $('#series-counter').html($(this).val());
        });

        var individual_last_name_auto = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getIndividualsLastNameCash') }}',
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "term": request.term,
                    },
                    'method': "post",
                    'dataType': "json",
                    'success': function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                } else {
                    $('#taxColFirstName').val(ui.item.firstName);
                    $('#taxColMI').val(ui.item.middleInitial);
                    $('#taxColSex').val(ui.item.sex);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                }
            }
        }

        var individual_first_name_auto = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getIndividualsFirsttNameCash') }}',
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "term": request.term,
                    },
                    'method': "post",
                    'dataType': "json",
                    'success': function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                } else {
                    $('#taxColLastName').val(ui.item.lastName);
                    $('#taxColMI').val(ui.item.middleInitial);
                    $('#taxColSex').val(ui.item.sex);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                }
            }
        }
        
        let autoCompleteData = [];
        var category_autocomplete = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getAccountTitlesCash') }}',
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "term": request.term,
                        "municipality": $('#taxColMunicipality').val()
                    },
                    'method': "post",
                    'dataType': "json",
                    'success': function(data) {
                        autoCompleteData = data;
                        response(data);
                        
                    }
                });
            },
        }

        var category_opag_autocomplete = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getAccountTitlesOpag') }}',
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "term": request.term,
                        "municipality": $('#taxColMunicipality').val()
                    },
                    'method': "post",
                    'dataType': "json",
                    'success': function(data) {
                        autoCompleteData = data;
                        response(data);
                        
                    }
                });
            },
        }
        
        var category_pvet_autocomplete = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getAccountTitlesPvet') }}',
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "term": request.term,
                        "municipality": $('#taxColMunicipality').val()
                    },
                    'method': "post",
                    'dataType': "json",
                    'success': function(data) {
                        autoCompleteData = data;
                        response(data);
                        
                    }
                });
            },
        }

        var category_pho_autocomplete = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getAccountTitlesPho') }}',
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "term": request.term,
                        "municipality": $('#taxColMunicipality').val()
                    },
                    'method': "post",
                    'dataType': "json",
                    'success': function(data) {
                        autoCompleteData = data;
                        response(data);
                        
                    }
                });
            },
        }

        $(".taxColAccount").autocomplete(category_autocomplete).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $(".taxColAccountOpag").autocomplete(category_opag_autocomplete).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $(".taxColAccountPvet").autocomplete(category_pvet_autocomplete).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $(".taxColAccountPho").autocomplete(category_pho_autocomplete).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#taxColLastName").autocomplete(individual_last_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#taxColFirstName").autocomplete(individual_first_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        let series = @json($serials);
        if (series.length > 0) {
            $('#taxColSeries').attr('readonly', false);
            $('#taxColSeries').addClass('bg-white');
        };

        $('#taxColMunicipality').ready(function() {
            $.ajax({
                method: "POST",
                url: "{{ route('getMunicipality') }}",
                async: false,
                data: {
                    id: $(this).val(),
                    client_type: $('#taxColClientType').val()
                }
            }).done(function(data) {
                $('#taxColMunicipality').html('<option class="bg-white" value=""></option>');
                data.forEach(element => {
                    $('#taxColMunicipality').html($('#taxColMunicipality').html() +
                        '<option class="bg-white" value="' + element.id + '">' + element.municipality + '</option>');
                });
            });
        });

        $('#taxColMunicipality').change(function () {
            if ($(this).val() != '') {
                $('#client-type-separator').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-company').addClass('d-none');
                $('#taxColCompany').addClass('d-none');
            } else {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-others').removeClass('d-none');
                $('#client-type-individual').removeClass('d-none');
                $('#client-type-company').removeClass('d-none');
            }
        });

        $('#addRowAccount').click(function() {
            var html = '';
            html += '<tr class="newRow">';
            html += '<td class="d-none"><input type="text"name="taxColAccountID[]" class="taxColAccountID form-control mb-0 bg-white text-dark">';

            html += '<td style="width: 40%">';
            html += '<input type="text" name="taxColAccount[]" class="taxColAccount form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '<input readonly type="text" name="taxColTypeRate[]"class="d-none taxColTypeRate form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input readonly type="text" name="taxColQuantity[]"class="d-none taxColQuantity form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '</td>';

            html += '<td style="width: 40%">';
            html += '<input type="text" name="taxColNature[]" class="taxColNature form-control mb-0 bg-white text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input type="text" name="taxColAmount[]" class="taxColAmount form-control mb-0 bg-white text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<div><button type="button" class=" removeRow btn btn-danger btn-sm mb-4 tim-icons icon-simple-delete"></button></div>';
            html += '</td>';
            html += '</tr>';

            let lastRow = $('#inputRow').find('tr').last();
            $('#inputRow').append(html);

            $(".taxColAccount").autocomplete(category_autocomplete).focus(function() {
                $(this).autocomplete('search', $(this).val())
            });

            $('.removeRow').on('click', function() {
                $(this).closest('tr').remove();
                $('.taxColAmount').trigger('change');
            });

            $('.taxColAmount').keyup(function () {
                $(this).mask("#00,000,000,000,000.00", {reverse: true});

                var sum = 0.00;
                $('.taxColAmount').each(function() {
                    let stringFloat = '0.00';
                    if ($(this).val() != '') {
                        stringFloat = $(this).val();
                    }
                    let float = stringFloat.replace(/\,/g,'');
                    sum = sum + parseFloat(float);
                });
                sum = sum.toFixed(2);
                $('#taxColTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            });
        });

        $('#addRowAccountOPAG').click(function() {
            var html = '';
            html += '<tr class="newRow">';
            html += '<td class="d-none"><input type="text"name="taxColAccountID[]" class="taxColAccountID form-control mb-0 bg-white text-dark">';

            html += '<td style="width: 40%">';
            html += '<input type="text" name="taxColAccount[]" class="taxColAccount taxColAccountOpag form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '<input readonly type="text" name="taxColTypeRate[]"class="d-none taxColTypeRate form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input readonly type="text" name="taxColQuantity[]"class="d-none taxColQuantity form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '</td>';
            html += '<td style="width: 40%">';
            html += '<input type="text" name="taxColNature[]"class="taxColNature taxColNatureOpag form-control mb-0 bg-white text-dark">'
            html += '</td>';

            html += '<td>';
            html += '<input type="text" name="taxColAmount[]" class="taxColAmount taxColAmountOpag form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '<div><button type="button" class=" removeRow btn btn-danger btn-sm mb-4 tim-icons icon-simple-delete"></button></div>';
            html += '</td>';
            html += '</tr>';

            let lastRow = $('#inputRowOPAG').find('tr').last();
            $('#inputRowOPAG').append(html);

            $(".taxColAccount").autocomplete(category_opag_autocomplete).focus(function() {
                $(this).autocomplete('search', $(this).val())
            });

            $('.removeRow').on('click', function() {
                $(this).closest('tr').remove();
                $('.taxColAmount').trigger('change');
            });

            $('.taxColAmount').keyup(function () {
                $(this).mask("#00,000,000,000,000.00", {reverse: true});

                var sum = 0.00;
                $('.taxColAmount').each(function() {
                    let stringFloat = '0.00';
                    if ($(this).val() != '') {
                        stringFloat = $(this).val();
                    }
                    let float = stringFloat.replace(/\,/g,'');
                    sum = sum + parseFloat(float);
                });
                sum = sum.toFixed(2);
                $('#taxColTotalOPAG').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            });
        });

        $('#addRowAccountPVET').click(function() {
            var html = '';
            html += '<tr class="newRow">';
            html += '<td class="d-none"><input type="text"name="taxColAccountID[]" class="taxColAccountID form-control mb-0 bg-white text-dark">';

            html += '<td style="width: 40%">';
            html += '<input type="text" name="taxColAccount[]" class="taxColAccount taxColAccountPvet form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '<input readonly type="text" name="taxColTypeRate[]"class="d-none taxColTypeRate form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input readonly type="text" name="taxColQuantity[]"class="d-none taxColQuantity form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '</td>';

            html += '<td style="width: 40%">';
            html += '<input type="text" name="taxColNature[]"class="taxColNature taxColNaturePvet form-control mb-0 bg-white text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input type="text" name="taxColAmount[]" class="taxColAmount taxColAmountPvet form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '<div><button type="button" class=" removeRow btn btn-danger btn-sm mb-4 tim-icons icon-simple-delete"></button></div>';
            html += '</td>';
            html += '</tr>';

            let lastRow = $('#inputRowPVET').find('tr').last();
            $('#inputRowPVET').append(html);

            $(".taxColAccount").autocomplete(category_pvet_autocomplete).focus(function() {
                $(this).autocomplete('search', $(this).val())
            });

            $('.removeRow').on('click', function() {
                $(this).closest('tr').remove();
                $('.taxColAmount').trigger('change');
            });

            $('.taxColAmount').keyup(function () {
                $(this).mask("#00,000,000,000,000.00", {reverse: true});

                var sum = 0.00;
                $('.taxColAmount').each(function() {
                    let stringFloat = '0.00';
                    if ($(this).val() != '') {
                        stringFloat = $(this).val();
                    }
                    let float = stringFloat.replace(/\,/g,'');
                    sum = sum + parseFloat(float);
                });
                sum = sum.toFixed(2);
                $('#taxColTotalPVET').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            });
        });

        $('#addRowAccountPHO').click(function() {
            var html = '';
            html += '<tr class="newRow">';
            html += '<td class="d-none"><input type="text"name="taxColAccountID[]" class="taxColAccountID form-control mb-0 bg-white text-dark">';

            html += '<td style="width: 40%">';
            html += '<input type="text" name="taxColAccount[]" class="taxColAccount taxColAccountPho form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '<input readonly type="text" name="taxColTypeRate[]"class="d-none taxColTypeRate form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input readonly type="text" name="taxColQuantity[]"class="d-none taxColQuantity form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '</td>';

            html += '<td style="width: 40%">';
            html += '<input type="text" name="taxColNature[]"class="taxColNature taxColNaturePho form-control mb-0 bg-white text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input type="text" name="taxColAmount[]" class="taxColAmount taxColAmountPho form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '<div><button type="button" class=" removeRow btn btn-danger btn-sm mb-4 tim-icons icon-simple-delete"></button></div>';
            html += '</td>';
            html += '</tr>';

            let lastRow = $('#inputRowPHO').find('tr').last();
            $('#inputRowPHO').append(html);

            $(".taxColAccount").autocomplete(category_pho_autocomplete).focus(function() {
                $(this).autocomplete('search', $(this).val())
            });

            $('.removeRow').on('click', function() {
                $(this).closest('tr').remove();
                $('.taxColAmount').trigger('change');
            });

            $('.taxColAmount').keyup(function () {
                $(this).mask("#00,000,000,000,000.00", {reverse: true});

                var sum = 0.00;
                $('.taxColAmount').each(function() {
                    let stringFloat = '0.00';
                    if ($(this).val() != '') {
                        stringFloat = $(this).val();
                    }
                    let float = stringFloat.replace(/\,/g,'');
                    sum = sum + parseFloat(float);
                });
                sum = sum.toFixed(2);
                $('#taxColTotalPHO').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            });
        });
        
        $('#taxColTransaction').change(function() {
            $('#taxColBank').attr('readonly', false);
            $('#taxColBank').addClass('bg-white');

            $('#taxColNumber').attr('readonly', false);
            $('#taxColNumber').addClass('bg-white');

            $('#taxColTransactDate').attr('readonly', false);
            $('#taxColTransactDate').addClass('bg-white');

            if ($(this).val() == 'Cash' || $(this).val() == 'null') {
                $('#taxColBank').attr('readonly', true);
                $('#taxColBank').removeClass('bg-white');

                $('#taxColNumber').attr('readonly', true);
                $('#taxColNumber').removeClass('bg-white');

                $('#taxColTransactDate').attr('readonly', true);
                $('#taxColTransactDate').removeClass('bg-white');

                $('#bankRemarks').addClass('d-none');
            } else {
                $('#bankRemarks').removeClass('d-none');
            }
        });
        
        $(".setNewDataCash").on('click', function() {
            let revenueData  = $('#submitCashCollections').serializeArray();
            revenueData.push({name:'receiptRemarksCash', value:tinymce.get("taxColReceiptRemarksCash").getContent()});
            let seriesVal = $('#taxColSeries').val();
            $('#submitType').val($('#saveSubmitType').val());
            
            Swal.fire({
                icon: 'info',
                title: 'Form will be Saved. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        'url': '{{ route('submitCashCollections') }}',
                        'data': revenueData,
                        'method': "post",
                        'dataType': "json",
                        'success': function(data) {
                            if (data.currentSerial == data.endSerial) {
                                let status = 'Completed';
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('updateSerialStatus') }}",
                                    'data': {
                                        "_token": "{{ csrf_token() }}",
                                        "id": data.seriesID,
                                        "seriesUpdate": status
                                    },
                                    'dataType': "json",
                                    'success': function(update) {
                                        
                                    }
                                }); 

                                Swal.fire({
                                    title: 'Series ' + data.startSerial + ' - ' + data.endSerial + ' is Complete',
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok',
                                    icon: 'warning'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                                $('#serialNumber').val('');
                                $('#series-counter').html('');
                            } else {
                                $('#taxColSeries').val(seriesVal);
                                $('#series-counter').html(data.latestSerial);
                                $('#serialNumber').val(data.latestSerial);
                            }
                        }
                    });

                    Swal.fire({
                        icon: 'success',
                        title: 'Data has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    $('.newRow').remove();
                    $('#submitCashCollections')[0].reset();
                    $('.clearDataForm').addClass('d-none');
                    $('.setNewDataCash').html('Save');
                    $('#submitType').val($('#saveSubmitType').val());
                    $('#client-type-company').addClass('d-none');
                    $('#client-type-individual').removeClass('d-none');
                    $('#cash-table').DataTable().ajax.reload();
                    $('#opag-table').DataTable().ajax.reload();
                    $('#pvet-table').DataTable().ajax.reload();
                    $('#pho-table').DataTable().ajax.reload();
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
            
        });

        $('#setDisHos').on('click', function() {
            let hospitalData  = $('#submitDistrictHospitals').serializeArray();
            Swal.fire({
                icon: 'info',
                title: 'Form will be Saved. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        'url': '{{ route('submitDistrictHospitals') }}',
                        'data': hospitalData,
                        'method': "post",
                        'dataType': "json",
                        'success': function(data) {
                            
                        }
                    });

                    Swal.fire({
                        icon: 'success',
                        title: 'Data has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    $('#submitDistrictHospitals')[0].reset();
                    $('#hos-table').DataTable().ajax.reload();
            } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
        });

        $('.taxColAmount').keyup(function () {
            var sum = 0.00;
            $('.taxColAmount').each(function() {
                let stringFloat = '0.00';
                if ($(this).val() != '') {
                    stringFloat = $(this).val();
                }
                let float = stringFloat.replace(/\,/g,'');
                sum = sum + parseFloat(float);
            });
            sum = sum.toFixed(2);
            $('#taxColTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $('#taxColTotalOPAG').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $('#taxColTotalPVET').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $('#taxColTotalPHO').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('.left-col-input').keyup(function () {
            $(this).mask("#00,000,000,000,000.00", {reverse: true});

            var sum = 0.00;
            $('.left-col-input').each(function() {
                let stringFloat = '0.00';
                if ($(this).val() != '') {
                    stringFloat = $(this).val();
                }
                let float = stringFloat.replace(/\,/g,'');
                sum = sum + parseFloat(float);
            });
            sum = sum.toFixed(2);
            $('#taxColAccountTotalHos').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('.right-col-input').keyup(function () {
            $(this).mask("#00,000,000,000,000.00", {reverse: true});

            var sum = 0.00;
            $('.right-col-input').each(function() {
                let stringFloat = '0.00';
                if ($(this).val() != '') {
                    stringFloat = $(this).val();
                }
                let float = stringFloat.replace(/\,/g,'');
                sum = sum + parseFloat(float);
            });taxColAccountTotalHos = 
            sum = sum.toFixed(2);
            $('#taxColSummaryTotalHos').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('.selling-price-total').keyup(function () {
            $(this).mask("#00,000,000,000,000.00", {reverse: true});

            var sum = 0.00;
            $('.selling-price-total').each(function() {
                let stringFloat = '0.00';
                if ($(this).val() != '') {
                    stringFloat = $(this).val();
                }
                let float = stringFloat.replace(/\,/g,'');
                sum = sum + parseFloat(float);
            });
            sum = sum.toFixed(2);
            $('#taxColSellingPriceHos').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });
    </script>
    
    @endsection