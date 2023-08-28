@extends('layouts.app', ['page' => __('Municipal Receipts'), 'pageSlug' => 'municipal_receipts'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Municipal Receipts</h1>
            </div>
            <form name="submit_mun_receipt_form" id="submit_mun_receipt_form" method="post" action="{{ url('submit_mun_receipt_form') }}">
                @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 d-none">
                                <label for="munReceiptsID">ID</label>
                                <input type="text" class="form-control" name="munReceiptsID" id="munReceiptsID">
                            </div>

                            <div class="col-md-2">
                                <label for="munReceiptDate">Receipt Date</label>
                                <input type="text" class="currentDate form-control mb-0 bg-white text-dark" name="munReceiptDate" id="munReceiptDate" value="{{ $current_date }}">
                            </div>

                            <div class="col-md-2">
                                <label for="munReceiptNo">Receipt No.</label>
                                <input type="text" class="form-control mb-0 bg-white text-dark" name="munReceiptNo"
                                    id="munReceiptNo">
                            </div>

                            <div class="col-sm-4">
                                    <label class="text-light" for="munReceiptClientType">Client Type</label>
                                    <select class="form-control bg-white text-dark" name="munReceiptClientType"
                                        id="munReceiptClientType">
                                        <option class="bg-white" value=""></option>
                                        @foreach ($displayCustType as $cust_items)
                                            <option class="bg-white" value="{{ $cust_items->id }}">
                                                {{ $cust_items->description_type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            <div class="col-sm-2">
                                <label class="text-light" for="munReceiptMunicipality">Municipality</label>
                                <select readonly class="form-control bg-light text-dark" name="munReceiptMunicipality"
                                    id="munReceiptMunicipality">
                                    <option class="bg-white" value=""></option>
                                </select>
                            </div>

                            <div id="munReceiptBarSelect" class="col-sm-2">
                                <label class="text-light" for="munReceiptBarangay">Barangay</label>
                                <select readonly class="form-control bg-light text-dark" name="munReceiptBarangay"
                                id="munReceiptBarangay">
                                    <option class="bg-white" value=""></option>
                                </select>
                            </div>
                        </div>

                        <hr id="client-type-separator" class="bg-white d-none">

                        <div id="client-type-others" class="row d-none ml-2">
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

                        <div id="client-type-individual" class="row d-none">
                            <div class="col-sm-3">
                                <label class="text-light" for="munReceiptLastName">Last Name</label>
                                <input type="text" name="munReceiptLastName" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptLastName">
                            </div>

                            <div class="col-sm-3">
                                <label class="text-light" for="munReceiptFirstName">First Name</label>
                                <input type="text" name="munReceiptFirstName" class="all-caps form-control mb-0 bg-white text-dark"
                                    id="munReceiptFirstName">
                            </div>

                            <div class="col-sm-1">
                                <label class="text-light" for="munReceiptMI">M.I.</label>
                                <input type="text" name="munReceiptMI" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptMI">
                            </div>

                            <div class="col-sm-1">
                                <label class="text-light" for="munReceiptSex">Sex</label>
                                <select class="form-control bg-white text-dark" name="munReceiptSex" id="munReceiptSex">
                                    <option class="bg-white" value=""></option>
                                    <option class="bg-white" value="M">M</option>
                                    <option class="bg-white" value="F">F</option>
                                </select>
                            </div>
                        </div>

                        <div id="client-type-spouse" class="row d-none">
                            <div class="col-sm-4">
                                <label class="text-light" for="munReceiptSpouses">Spouses</label>
                                <input type="text" name="munReceiptSpouses" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptSpouses">
                            </div>
                        </div>

                        <div id="client-type-company" class="row d-none">
                            <div class="col-sm-4">
                                <label class="text-light" for="munReceiptCompany">Company</label>
                                <input type="text" name="munReceiptCompany" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptCompany">
                            </div>
                        </div>

                        <div id="client-type-permittees" class="row d-none">
                            <div class="col-sm-4">
                                <label class="text-light" for="munReceiptPermittee">Permittee</label>
                                <input type="text" name="munReceiptPermittee" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptPermittee">
                            </div>

                            <div class="col-sm-5">
                                <label class="text-light" for="munReceiptPermitteeTradeName">Trade Name</label>
                                <input type="text" name="munReceiptPermitteeTradeName" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptPermitteeTradeName">
                            </div>

                            <div class="col-sm-2">
                                <div id="clientFieldPermittees"></div>
                            </div>
                        </div>

                        <div id="client-type-permitFees" class="row d-none">
                            <div class="col-sm-5">
                                <label class="text-light" for="munReceiptPermitFeesTradeName">Trade Name</label>
                                <input type="text" name="munReceiptPermitFeesTradeName" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptPermitFeesTradeName">
                            </div>

                            <div class="col-sm-4">
                                <label class="text-light" for="munReceiptProprietor">Proprietor</label>
                                <input type="text" name="munReceiptProprietor" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptProprietor">
                            </div>
                        </div>

                        <div id="client-type-contractor" class="row d-none">
                            <div class="col-sm-5">
                                <label class="text-light" for="munReceiptBusinessName">Business Name</label>
                                <input type="text" name="munReceiptBusinessName" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptBusinessName">
                            </div>

                            <div class="col-sm-4">
                                <label class="text-light" for="munReceiptOwner">Owner</label>
                                <input type="text" name="munReceiptOwner" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptOwner">
                            </div>

                            <div class="col-sm-4 d-none">
                                <label class="text-light" for="munReceiptAddress">Address</label>
                                <input type="text" name="munReceiptAddress" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptAddress">
                            </div>
                        </div>

                        <div id="client-type-bidders" class="row d-none">
                            <div class="col-sm-5">
                                <label class="text-light" for="munReceiptBiddersBusinessName">Bidders Business Name</label>
                                <input type="text" name="munReceiptBiddersBusinessName" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptBiddersBusinessName">
                            </div>

                            <div class="col-sm-3">
                                <label class="text-light" for="munReceiptBiddersOwner">Owner/Representative</label>
                                <input type="text" name="munReceiptBiddersOwner" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptBiddersOwner">
                            </div>

                            <div class="col-sm-2">
                                <div id="clientFieldBidders"></div>
                            </div>
                        </div>

                        <div id="client-type-rentals" class="row d-none">
                            <div class="col-sm-3 d-none">
                                <input type="text" name="munReceiptRentalID" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptRentalID">
                            </div>

                            <div class="col-sm-3">
                                <label class="text-light" for="munReceiptRentalName">Rental Name</label>
                                <input type="text" name="munReceiptRentalName" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptRentalName">
                            </div>

                            <div class="col-sm-4">
                                <label class="text-light" for="munReceiptRentalLocation">Location</label>
                                <input type="text" name="munReceiptRentalLocation" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptRentalLocation">
                            </div>

                            <div class="col-sm-3">
                                <label class="text-light" for="munReceiptRentalLease">Lease of Contact</label>
                                <input type="text" name="munReceiptRentalLease" class="form-control mb-0 bg-white text-dark"
                                    id="munReceiptRentalLease">
                            </div>

                            <div class="col-sm-2">
                                <div id="clientField"></div>
                            </div>
                        </div>

                        <hr class="bg-white">

                        <div class="row">
                            <div class="col-sm-3">
                                <label class="text-light" for="munReceiptTransaction">Transaction Type</label>
                                <select class="form-control bg-white text-dark" name="munReceiptTransaction"
                                    id="munReceiptTransaction">
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
                                <label class="text-light" for="munReceiptBank">Bank Name</label>
                                <input readonly type="text" name="munReceiptBank"
                                    class="edit-trigger form-control mb-0 text-dark" id="munReceiptBank">
                            </div>

                            <div class="col-sm-3">
                                <label class="text-light" for="munReceiptNumber">Number</label>
                                <input readonly type="text" name="munReceiptNumber"
                                    class="edit-trigger form-control mb-0 text-dark" id="munReceiptNumber">
                            </div>

                            <div class="col-sm-3">
                                <label class="text-light" for="munReceiptTransactDate">Date</label>
                                <input readonly type="text" name="munReceiptTransactDate"
                                    class="edit-trigger datepicker form-control mb-0 text-dark" id="munReceiptTransactDate">
                            </div>

                            <div id="bankRemarks" class="col-sm-12 d-none">
                                <label class="text-light" for="munReceiptBankRemarks">Bank Remarks</label>
                                <textarea id="munReceiptBankRemarks" name="munReceiptBankRemarks"></textarea>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="munReceiptCert">With Certificate</label>
                                <select class="form-control bg-white text-dark" name="munReceiptCert" id="munReceiptCert">
                                    <option class="bg-white" selected value="None">None</option>
                                    <option class="bg-white" value="Transfer Tax">Transfer Tax</option>
                                    <option class="bg-white" value="Sand & Gravel">Sand & Gravel</option>
                                    <option class="bg-white" value="Provincial Permit">Provincial Permit</option>
                                    <!-- <option class="bg-white" value="Sand & Gravel Cert">Sand & Gravel Certification</option> -->
                                </select>
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
                                                    <input type="text" id="munReceiptAccountID" name="munReceiptAccountID"
                                                        class="munReceiptAccountID form-control mb-0 bg-white text-dark">
                                                </td>
                                                <td>
                                                    <input type="text" name="munReceiptAccount[]"
                                                        class="munReceiptAccount form-control mb-0 bg-white text-dark">
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    <input readonly type="text" name="munReceiptTypeRate[]"
                                                        class="d-none munReceiptTypeRate bg-light form-control mb-0 text-dark">
                                                </td>
                                                <td>
                                                    <input readonly type="text" name="munReceiptQuantity[]"
                                                        class="d-none munReceiptQuantity bg-light form-control mb-0 text-dark">
                                                </td>
                                                <td>
                                                    <input type="text" name="munReceiptNature[]"
                                                        class="munReceiptNature form-control mb-0 bg-white text-dark">
                                                </td>
                                                <td>
                                                    <input type="text" name="munReceiptAmount[]"
                                                        class="munReceiptAmount form-control mb-0 bg-white text-dark">
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
                                                    <input type="text" id="munReceiptTotal" name="munReceiptTotal"
                                                        class="form-control mb-0 bg-light text-dark" id="munReceiptTotal">
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
                                <label class="text-light" for="munReceiptRemarks">Receipt Remarks</label>
                                <textarea id="munReceiptRemarks" name="munReceiptRemarks"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" id="submit-btn" class="btn btn-success mt-4">Save</button>
                                <div id="edit-buttons" class="d-none btn-group">
                                    <button type="button" id="update-btn" class="btn btn-success mt-4">Update</button>
                                    <button type="button" id="clear-btn" class="btn btn-warning mt-4">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- CERTIFICATION MODAL -->
            <div class="modal fade" id="certificateModal" tabindex="-1" role="dialog"
                aria-labelledby="certificateModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h3 class="modal-title text-white" id="certificateModalLongTitle">Certification</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="cert_form" id="cert_form" method="post" action="{{ url('cert_form') }}">
                                @csrf
                                <div class="row d-none">
                                    <div class="col-sm-3">
                                        <label for="certID">Cert ID</label>
                                        <input type="text" name="certID" class="form-control mb-0 bg-white text-dark"
                                            id="certID">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label class="text-light" for="certUser">User</label>
                                        <input readonly type="text" name="certUser" class="bg-light form-control mb-0 text-dark"
                                            id="certUser">
                                    </div>

                                    <div class="col-sm-1">
                                        <label class="text-light" for="certAFType">AF Type</label>
                                        <input readonly type="text" name="certAFType" class="bg-light form-control mb-0 text-dark"
                                            id="certAFType">
                                    </div>
                                    

                                    <div class="col-sm-2">
                                        <label class="text-light" for="certSerialNumber">Serial Number</label>
                                        <input readonly type="text" name="certSerialNumber"
                                            class="bg-light form-control mb-0 text-dark" id="certSerialNumber">
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="text-light" for="certClientType">Client Type</label>
                                        <input readonly type="text" name="certClientType" class="bg-light form-control mb-0 text-dark"
                                            id="certClientType">
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="text-light" for="certMunicipality">Municipality</label>
                                        <input readonly type="text" name="certMunicipality"
                                            class="bg-light form-control mb-0 text-dark" id="certMunicipality">
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="text-light" for="certBaqrangay">Barangay</label>
                                        <input readonly type="text" name="certBaqrangay" class="bg-light form-control mb-0 text-dark"
                                            id="certBaqrangay">
                                    </div>
                                    
                                </div>
                                
                                <hr class="bg-white">
                                <div class="row">
                                    <div class="col-sm-2 d-none">
                                        <label class="text-light" for="land_tax_info_id">Land Tax ID</label>
                                        <input readonly type="text" name="land_tax_info_id" class="bg-light form-control mb-0 text-dark"
                                            id="land_tax_info_id">
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="text-light" for="certType">Type</label>
                                        <select readonly class="form-control bg-light text-dark" name="certType" id="certType">
                                            <option class="bg-white" value="null">No Certificate</option>
                                            <option class="bg-white" value="Provincial Permit">Provincial Permit</option>
                                            <option class="bg-white" value="Transfer Tax">Transfer Tax</option>
                                            <option class="bg-white" value="Sand & Gravel">Sand & Gravel</option>
                                            {{-- <option class="bg-white" value="Sand & Gravel Certification">Sand & Gravel
                                            Certification
                                            </option> --}}
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="text-light" for="certDate">Date</label>
                                        <input readonly type="text" name="certDate"
                                            class="bg-light datepicker-cert form-control mb-0 text-dark" id="certDate">
                                    </div>

                                    <div id="preparedby" class="col-sm-3">
                                        <label class="text-light" for="certPreparedBy">PREPARED BY:</label>
                                        <select class="form-control bg-white text-dark" name="certPreparedBy" id="certPreparedBy">
                                            {{-- <option class="bg-white" value=""></option> --}}
                                            @foreach ($displayOfficers as $officer)
                                                <option class="bg-white" value="{{ $officer->id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="signeename" class="col-sm-3">
                                        <label class="text-light" for="certSignee">Treasurer Signee</label>
                                        <select class="form-control bg-white text-dark" name="certSignee" id="certSignee">
                                            {{-- <option class="bg-white" value=""></option> --}}
                                            @foreach ($displayOfficers as $officer)
                                                <option class="bg-white" value="{{ $officer->id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="otherSignee" class="col-sm-3">
                                        <label class="text-light" for="secondSignee">Assistant Treasurer/Other Signee</label>
                                        <select class="form-control bg-white text-dark" name="secondSignee" id="secondSignee">
                                            <option class="bg-white" value=""></option>
                                            @foreach ($displayOfficers as $officer)
                                                <option class="bg-white" value="{{ $officer->id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div id="govdropdown" class="col-sm-2">
                                        <label class="text-light" for="provGovernor">Provincial Governor</label>
                                        <select class="form-control bg-white text-dark" name="provGovernor" id="provGovernor">
                                            <option class="bg-white" value="null"></option>
                                            <option class="bg-white" value="MELCHOR D. DICLAS, MD">MELCHOR D. DICLAS, MD</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="text-light" for="certReipient">Recipient</label>
                                        <input type="text" name="certReipient" class="bg-white form-control mb-0 text-dark"
                                            id="certReipient">
                                    </div>

                                    <div class="col-sm-5">
                                        <label class="text-light" for="certAddress">Address</label>
                                        <input type="text" name="certAddress" class="bg-white form-control mb-0 text-dark"
                                            id="certAddress">
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="text-light" for="certEntriesFrom">Include Entries From</label>
                                        <input type="text" name="certEntriesFrom" class="bg-white form-control mb-0 text-dark"
                                            id="certEntriesFrom">
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="text-light" for="certEntriesTo">Include Entries To</label>
                                        <input type="text" name="certEntriesTo" class="bg-white form-control mb-0 text-dark"
                                            id="certEntriesTo">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="text-light" for="certDetails">Details</label>
                                        <textarea id="certDetails" name="certDetails"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3 class="modal-title text-white" id="toBeFilledUp">TO BE FILLED UP</h3>
                                    </div>
                                </div>

                                <div id="provincialPermit" class="row d-none">
                                    <div class="col-sm-3 d-none">
                                        <label class="text-light" for="provCertId">provincialPermit ID (reference ID)</label>
                                        @foreach ($acc_data as $cert_data)
                                            <input type="text" name="provCertId" class="bg-white form-control mb-0 text-dark"
                                            id="provCertId" value="{{ $cert_data->id }}">
                                        @endforeach
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="text-light" for="provCertClearance">Clearance Number</label>
                                        <input type="text" name="provCertClearance" class="bg-white form-control mb-0 text-dark"
                                            id="provCertClearance">
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="text-light" for="provCertType">Type</label>
                                        <select class="form-control bg-white text-dark" name="provCertType" id="provCertType">
                                            <option class="bg-white" value=""></option>
                                            <option class="bg-white" value="New">New</option>
                                            <option class="bg-white" value="Renewal">Renewal</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="text-light" for="provCertBidding">For Bidding?</label>
                                        <select class="form-control bg-white text-dark" name="provCertBidding" id="provCertBidding">
                                            <option class="bg-white" value=""></option>
                                            <option class="bg-white" value="1">Yes</option>
                                            <option class="bg-white" value="0">No</option>
                                        </select>
                                    </div>
                                </div>

                                <hr class="bg-white">

                                <div id="provPermitAdditional" class="row d-none">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table tablesorter" id="provinvial-permit-table">
                                                <thead>
                                                    <tr>
                                                        <th>Provincial Fees/Charges</th>
                                                        <th>Amount</th>
                                                        <th>OR Number</th>
                                                        <th>Date</th>
                                                        <th>Initials</th>
                                                        <th>
                                                            <button id="addRowPermit" type="button" class="btn btn-info btn-sm">Add
                                                                Row</button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="inputRowProvPermit">
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="provFeeCharge[]"
                                                                class="provFeeCharge bg-white form-control mb-0 text-dark">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="provAmount[]"
                                                                class="provAmount bg-white form-control mb-0 text-dark">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="provORNumber[]"
                                                                class="provORNumber bg-white form-control mb-0 text-dark">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="provDate[]"
                                                                class="provDate bg-white datepicker form-control mb-0 text-dark">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="provInitials[]"
                                                                class="provInitials bg-white form-control mb-0 text-dark">
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="transferTax" class="row d-none">
                                    <div class="col-sm-12">
                                        <label class="text-light" for="notaryPublic">Notary Public</label>
                                        <textarea id="notaryPublic" class="tinymce" name="notaryPublic"></textarea>
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="text-light" for="ptrNumber">PTR Number</label>
                                        <input type="text" name="ptrNumber" class="bg-white form-control mb-0 text-dark"
                                            id="ptrNumber">
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="text-light" for="docNumber">Doc. Number</label>
                                        <input type="text" name="docNumber" class="bg-white form-control mb-0 text-dark"
                                            id="docNumber">
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="text-light" for="pageNumber">Page Number</label>
                                        <input type="text" name="pageNumber" class="bg-white form-control mb-0 text-dark"
                                            id="pageNumber">
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="text-light" for="bookNumber">Book Number</label>
                                        <input type="text" name="bookNumber" class="bg-white form-control mb-0 text-dark"
                                            id="bookNumber">
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="text-light" for="certSeries">Series</label>
                                        <input type="text" name="certSeries" class="bg-white form-control mb-0 text-dark" id="certSeries">
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="text-light" for="refNumber">Reference Number</label>
                                        <input type="text" name="refNumber" class="bg-white form-control mb-0 text-dark"
                                            id="refNumber">
                                    </div>
                                </div>

                                <div id="sandAndGravel" class="row d-none">
                                    <div class="col-sm-3">
                                        <label class="text-light" for="sgProcessed">Less: Sand and Gravel (processed)</label>
                                        <input type="text" name="sgProcessed" class="bg-white form-control mb-0 text-dark"
                                            id="sgProcessed">
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="text-light" for="aggBaseCourse">Less: Aggregate Base Course</label>
                                        <input type="text" name="aggBaseCourse" class="bg-white form-control mb-0 text-dark"
                                            id="aggBaseCourse">
                                    </div>


                                    <div class="col-sm-3">
                                        <label class="text-light" for="lessSandAndGravel">Less: Sand and Gravel</label>
                                        <input type="text" name="lessSandAndGravel" class="bg-white form-control mb-0 text-dark"
                                            id="lessSandAndGravel">
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="text-light" for="lessBoulders">Less: Boulders</label>
                                        <input type="text" name="lessBoulders" class="bg-white form-control mb-0 text-dark"
                                            id="lessBoulders">
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <button type="button" id="save-cert-btn" class="float-right btn btn-primary ">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div> 
                        
                    

                        <!-- MODAL FOOTER -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="" target="_blank" id="print-cert-btn" class="float-right btn btn-primary">Print Certificate</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF NO CERTIFICATION MODAL -->
            
            <!-- PERCENT MODAL -->
            <div class="modal fade" id="percentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="percentModalTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-theme-color">
                        <div class="modal-header">
                            <h3 class="text-white modal-title" id="percentModalTitle">Details</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="percent_form" class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12 d-none">
                                        <label class="text-light" for="percentRowIndex">Row Index</label>
                                        <input type="text" id="percentRowIndex" name="percentRowIndex"
                                            class="form-control mb-0 bg-white text-dark">
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="text-light" for="percentRate">Rate(%)</label>
                                        <input readonly type="text" name="percentRate" class="bg-light form-control mb-0 text-dark"
                                            id="percentRate">
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="text-light" for="percentOf">of(%)</label>
                                        <input type="text" name="percentOf" class="bg-white form-control mb-0 text-dark"
                                            id="percentOf">
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <label class="text-light" for="percentAmount">Amount</label>
                                        <input type="text" name="percentAmount" id="percentAmount" class="bg-white form-control mb-0 text-dark">
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="withSpouse">
                                            <div class="col-sm-12">
                                                <div class="checkbox">
                                                    <label class="text-light">With Surviving Spouse<input id="survivingSpouse" type="checkbox"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="withDonation">
                                            <div class="col-sm-12">
                                                <div class="checkbox">
                                                    <label class="text-light float-left">With Donation<input id="donation" type="checkbox"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row notarytDate d-none">
                                    <div class="col-sm-4">
                                        <label class="text-light" for="notaryDate">Notary Date (mm/dd/yyyy)</label>
                                        <input type="text" name="notaryDate" class="bg-white datepenalty form-control mb-0 text-dark" id="notaryDate">
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="text-light" for="numOfMonths">NO. Month/s</label>
                                        <input readonly type="text" name="numOfMonths" class="bg-light form-control mb-0 text-dark" id="numOfMonths">
                                    </div>
                                </div>

                                <div class="row noneFines d-none">
                                    <div class="dateOfTransaction col-sm-4">
                                        <label class="text-light" for="dateOfTransaction">Date of Transaction</label>
                                        <input type="text" name="dateOfTransaction" class="bg-white datepenalty form-control mb-0 text-dark" id="dateOfTransaction">
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="text-light" for="dateOfPenalty">Deadline (mm/dd/yyyy)</label>
                                        <input readonly type="text" name="dateOfPenalty" class="bg-light datepenalty form-control mb-0 text-dark" id="dateOfPenalty">
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="text-light" for="ratePerMonth">Rate per month</label>
                                        <input readonly type="text" name="ratePerMonth" class="bg-light form-control mb-0 text-dark" id="ratePerMonth">
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="text-light" for="calculatedRate">Calculated Rate</label>
                                        <input readonly type="text" name="calculatedRate" class="bg-light form-control mb-0 text-dark" id="calculatedRate">
                                    </div>
                                    
                                    <input readonly type="hidden" name="penaltyType" id="penaltyType">
                                </div>

                                <div class="row">
                                    <div class="col-sm-4 d-none">
                                        <label class="text-light" for="amountHolder">Amount Holder</label>
                                        <input type="text" name="amountHolder" class="bg-white form-control mb-0 text-dark"
                                            id="amountHolder">
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="text-light" for="percentValue">Value</label>
                                        <input readonly type="text" name="percentValue" class="bg-light form-control mb-0 text-dark"
                                            id="percentValue">
                                    </div>

                                    <div class="col-sm-12 d-none">
                                        <label class="text-light" for="percentOfValue">Percent of Status</label>
                                        <input readonly type="text" name="percentOfValue" class="bg-light form-control mb-0 text-dark"
                                            id="percentOfValue">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="percent-btn" class="btn btn-primary">Go</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF PERCENT MODAL -->

            <!-- SCHEDULE MODAL -->
            <div class="modal fade" id="scheduleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLongTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-theme-color">
                        <div class="modal-header">
                            <h3 class="text-white modal-title" id="scheduleModalLongTitle">Details</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="sched_form" class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12 d-none">
                                        <label class="text-light" for="schedRowIndex">Row Index</label>
                                        <input type="text" id="schedRowIndex" name="schedRowIndex"
                                            class="form-control mb-0 bg-white text-dark">
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="text-light" for="schedAuto">Schedules</label>
                                        <input type="text" id="schedAuto" name="schedAuto"
                                            class="form-control mb-0 bg-white text-dark">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="text-light" for="munReceipt">Quantity</label>
                                        <input type="text" id="munReceipt" name="munReceipt"
                                            class="form-control mb-0 bg-white text-dark">
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="text-light" for="schedUnitCost">Unit</label>
                                        <input readonly type="text" id="schedUnitCost" name="schedUnitCost"
                                            class="form-control mb-0 bg-light text-dark">
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="text-light" for="schedValue">Cost</label>
                                        <input readonly type="text" id="schedValue" name="schedValue"
                                            class="form-control mb-0 bg-light text-dark">
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="text-light" for="schedTotal">Total Value</label>
                                        <input readonly type="text" id="schedTotal" name="schedTotal"
                                            class="form-control mb-0 bg-light text-dark">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="sched-btn" class="btn btn-primary">Go</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="mun-receipt-table">
                                <thead class=" text-primary bg-dark">
                                    <tr>
                                        <th class="bg-dark">Action</th>
                                        <th class="bg-dark">Receipt No.</th>
                                        <th class="bg-dark">Receipt Date</th>
                                        <th class="bg-dark">Customer/Payor</th>
                                        <th class="bg-dark">Municipality</th>
                                        <th class="bg-dark">Barangay</th>
                                        <th class="bg-dark">Certificate</th>
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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.currentDate').flatpickr({
            enableTime: true,
            dateFormat: 'm/d/Y H:i',
            defaultDate: new Date(),
        });

        tinymce.init({
            selector: '#munReceiptBankRemarks',
            forced_root_block : 'div'
        });

        tinymce.init({
            selector: '#munReceiptRemarks',
            forced_root_block : 'div',
        });

        let data = @json($displayMunReceipts);
        let message = @json(session('Message'));
        let table = null;
        if (message != null) {
            Swal.fire(message);
        }
        $(document).ready(function() {
            table = $('#mun-receipt-table').DataTable({
                data: data,
                autoWidth: false,
                columns: [{
                        'data': 'main_id',
                        render: function(data, type, row) {
                            return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button type="button" rel="tooltip" class="certificate-btn btn btn-light btn-sm btn-round btn-icon"><i class="tim-icons icon-molecule-40"></i></button>';
                        }
                    },
                    {
                        'data': 'mun_receipt_no'
                    },
                    {
                        'data': 'mun_receipt_date'
                    },
                    {
                        'data': 'mun_owner',
                        render: function(data, type, row) {
                            if(row.client_types == 'Individual/Company' || row.client_types == 'Monitoring') {
                                if (row.mun_client_type_radio == 'Individual') {
                                    return row.mun_last_name + ', ' + row.mun_first_name + ' ' + row
                                .mun_middle_initial;
                                } else if (row.mun_client_type_radio == 'Spouse') {
                                    return row.mun_spouses;
                                } else if (row.mun_client_type_radio == 'Company') {
                                    return row.mun_company;
                                }
                            } else if (row.client_types == 'Contractors (Prov.)') {
                                if (row.mun_business_name == null) {
                                    return row.mun_owner;
                                } else if (row.mun_owner == null) {
                                    return row.mun_business_name;
                                } else {
                                    return row.mun_business_name + ' By: ' +  row.mun_owner;
                                }
                            } else if (row.client_types == 'Municipal Remittance') {
                                return 'Municipal Government of ' + row.mun_name;
                            } else if (row.client_types == 'Industrial' || row.client_types == 'Commercial') {
                                if (row.mun_trade_name_permittees == null) {
                                    return row.mun_permittee;
                                } else if (row.mun_permittee) {
                                    return row.mun_trade_name_permittees;
                                } else {
                                    return row.mun_trade_name_permittees + ' By: ' + row.mun_permittee
                                }
                            } else if (row.client_types == 'Printing & Publication' || row.client_types == 'Franchise Tax') {
                                if (row.mun_trade_name_permit_fees == null) {
                                    return row.mun_proprietor;
                                } else if (row.mun_proprietor == null) {
                                    return row.mun_trade_name_permit_fees;
                                } else {
                                    return row.mun_trade_name_permit_fees + ' By: ' + row.mun_proprietor;
                                }
                            } else if (row.client_types == 'Brgy. Remittance') {
                                return row.bar_name + ', ' + row.mun_name;
                            } else if (row.client_types == 'Bidders' || row.client_types == 'Supplier of Drugs & Meds') {
                                if (row.mun_bidders_business_name == null) {
                                    return row.mun_owner_representative;
                                } else if (row.mun_owner_representative == null) {
                                    return row.mun_bidders_business_name;
                                } else {
                                    return row.mun_bidders_business_name + ' By: ' + row.mun_owner_representative;
                                }
                            } else {
                                return row.mun_business_name;
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
                        'data': 'mun_certificate'
                    },
                    {
                        'data': 'client_types'
                    },
                ],
                "columnDefs": [{
                    "targets": [7],
                    "visible": false,
                }],
                "order": [ 7, "desc" ]
            });

            $('#mun-receipt-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.row( $(this).parents('tr') ).data();
                var originalData = table.cells(idx, '').data();
                $('#submit-btn').addClass('d-none');
                $('#edit-buttons').removeClass('d-none');
                $('#munReceiptsID').val(data.id);
                $('#munReceiptNo').val(data.mun_receipt_no);
                $('#munReceiptClientType').val(data.mun_client_type_id);
                $('#munReceiptClientType').trigger('change');
                $('#munReceiptSpouses').val(data.mun_spouses);
                $('#munReceiptCompany').val(data.mun_company);
                $('#munReceiptLastName').val(data.mun_last_name);
                $('#munReceiptFirstName').val(data.mun_first_name);
                $('#munReceiptMI').val(data.mun_middle_initial);
                $('#munReceiptBusinessName').val(data.mun_business_name);
                $('#munReceiptOwner').val(data.mun_owner);

                let munReceiptAcc = $('.munReceiptAccount')[0];
                let munReceiptNature = $('.munReceiptNature')[0];
                let munReceiptQuantity = $('.munReceiptQuantity')[0];
                let munReceiptAmount = $('.munReceiptAmount')[0];
                let munReceiptTypeRate = $('.munReceiptTypeRate')[0];
                $(munReceiptAcc).val('');
                $(munReceiptNature).val('');
                $(munReceiptQuantity).val('');
                $(munReceiptAmount).val('');
                $(munReceiptTypeRate).val('');

                $('#munReceiptTotal').val('');
                $('.newRow').remove();
                $.ajax({
                    method: "POST",
                    url: "{{ route('land_tax_acc_data') }}",
                    // async: false,
                    data: {
                        id: originalData[0]
                    }
                }).done(function(data) {
                    let rowCount = data.length - 1;
                    if (data.length > 0) {
                        let munReceiptAcc = $('.munReceiptAccount')[0];
                        let munReceiptNature = $('.munReceiptNature')[0];
                        let munReceiptQuantity = $('.munReceiptQuantity')[0];
                        let munReceiptAmount = $('.munReceiptAmount')[0];
                        let munReceiptTypeRate = $('.munReceiptTypeRate')[0];
                        $(munReceiptAcc).val(data[0].account);
                        $(munReceiptNature).val(data[0].nature);
                        $(munReceiptQuantity).val(data[0].quantity);
                        $(munReceiptAmount).val(data[0].amount);
                        $(munReceiptTypeRate).val(data[0].rate_type);

                        let total = parseFloat(data[0].amount);
                        for (let i = 1; i <= rowCount; i++) {
                            $('#addRowAccount').trigger('click');
                            munReceiptAcc = $('.munReceiptAccount')[i];
                            munReceiptNature = $('.munReceiptNature')[i];
                            munReceiptQuantity = $('.munReceiptQuantity')[i];
                            munReceiptAmount = $('.munReceiptAmount')[i];
                            munReceiptTypeRate = $('.munReceiptTypeRate')[i];
                            total = parseFloat(data[i].amount) + total;
                            $(munReceiptAcc).val(data[i].account);
                            $(munReceiptNature).val(data[i].nature);
                            $(munReceiptQuantity).val(data[i].quantity);
                            $(munReceiptAmount).val(data[i].amount);
                            $(munReceiptTypeRate).val(data[i].rate_type);
                        }
                        $('#munReceiptTotal').val(parseFloat(total).toFixed(2));
                    }
                    $('.munReceiptAmount').trigger('keyup');
                    $('#munReceiptTotal').trigger('change');
                });
            });

            $('#clear-btn').click(function() {
                $('#submit_mun_receipt_form')[0].reset();
                $('#submit-btn').removeClass('d-none');
                $('#edit-buttons').addClass('d-none');
                $('#client-type-separator').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $('#client-type-company').addClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
            });

            $('#mun-receipt-table tbody').on('click', '.delete-btn-cl', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').data('display');
                Swal.fire({
                    title: 'Do you want to delete this Data?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#munReceiptsID').val(data[0]);
                        $('#land_tax_form').attr('action', '{{ route('delete_mun_receipt_form') }}');
                        $('#land_tax_form').submit();
                    }
                });
            });
        });

        

        $('#individualRadio').on('click', function() {
            $('#client-type-individual').removeClass('d-none');
            $('#client-type-spouse').addClass('d-none');
            $('#client-type-company').addClass('d-none');
        });

        $('#spousesRadio').on('click', function() {
            $('#client-type-spouse').removeClass('d-none');
            $('#client-type-individual').addClass('d-none');
            $('#client-type-company').addClass('d-none');
        });

        $('#companyRadio').on('click', function() {
            $('#client-type-individual').addClass('d-none');
            $('#client-type-spouse').addClass('d-none');
            $('#client-type-company').removeClass('d-none');
        });

        $('#munReceiptClientType').change(function() {
            if ($(this).val() == '8') {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-individual').removeClass('d-none');
                $('#client-type-others').removeClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#munReceiptBarSelect').removeClass('d-none');
                $('#munReceiptMunicipality').attr('readonly', true);
                $('#munReceiptMunicipality').addClass('bg-light');
                $('#munReceiptMunicipality').val('');
                $('#munReceiptBarangay').attr('readonly', true);
                $('#munReceiptBarangay').addClass('bg-light');
                $('#munReceiptBarangay').val('');
            } else if ($(this).val() == '1') {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-individual').removeClass('d-none');
                $('#client-type-others').removeClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#munReceiptMunicipality').attr('readonly', false);
                $('#munReceiptMunicipality').addClass('bg-white');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $.ajax({
                    method: "POST",
                    url: "{{ route('getMunicipality') }}",
                    async: false,
                    data: {
                        id: $(this).val(),
                        client_type: $('#munReceiptClientType').val()
                    }
                }).done(function(data) {
                    $('#munReceiptMunicipality').html('<option class="bg-white" value=""></option>');
                    data.forEach(element => {
                        $('#munReceiptMunicipality').html($('#munReceiptMunicipality').html() +
                            '<option class="bg-white" value="' + element.id + '">' + element.municipality + '</option>');
                    });
                });
            } else if ($(this).val() == '4') {
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-separator').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#munReceiptBarSelect').removeClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#munReceiptMunicipality').attr('readonly', false);
                $('#munReceiptMunicipality').addClass('bg-white');
                $('#munReceiptBarangay').attr('readonly', false);
                $('#munReceiptBarangay').removeClass('bg-white');
                $('#munReceiptBarangay').val('');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $.ajax({
                    method: "POST",
                    url: "{{ route('getMunicipality') }}",
                    async: false,
                    data: {
                        id: $(this).val(),
                        client_type: $('#munReceiptClientType').val()
                    }
                }).done(function(data) {
                    $('#munReceiptMunicipality').html('<option class="bg-white" value=""></option>');
                    data.forEach(element => {
                        $('#munReceiptMunicipality').html($('#munReceiptMunicipality').html() +
                            '<option class="bg-white" value="' + element.id + '">' + element.municipality + '</option>');
                    });
                });
            } else if ($(this).val() == '5') {
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-separator').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#munReceiptMunicipality').attr('readonly', false);
                $('#munReceiptMunicipality').addClass('bg-white');
                $('#munReceiptBarSelect').addClass('d-none');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $.ajax({
                    method: "POST",
                    url: "{{ route('getMunicipality') }}",
                    async: false,
                    data: {
                        id: $(this).val(),
                        client_type: $('#munReceiptClientType').val()
                    }
                }).done(function(data) {
                    $('#munReceiptMunicipality').html('<option class="bg-white" value=""></option>');
                    data.forEach(element => {
                        $('#munReceiptMunicipality').html($('#munReceiptMunicipality').html() +
                            '<option class="bg-white" value="' + element.id + '">' + 'Municipal Government of ' + element.municipality + '</option>');
                    });
                });
            } else if ($(this).val() == '6' || $(this).val() == '7') { 
                $('#client-type-permittees').removeClass('d-none');
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#munReceiptBarSelect').removeClass('d-none');
                $('#munReceiptMunicipality').attr('readonly', false);
                $('#munReceiptMunicipality').addClass('bg-white');
                $('#munReceiptBarangay').attr('readonly', false);
                $('#munReceiptBarangay').removeClass('bg-white');
                $('#munReceiptBarangay').val('');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $.ajax({
                    method: "POST",
                    url: "{{ route('getMunicipality') }}",
                    async: false,
                    data: {
                        id: $(this).val(),
                        client_type: $('#munReceiptClientType').val()
                    }
                }).done(function(data) {
                    $('#munReceiptMunicipality').html('<option class="bg-white" value=""></option>');
                    data.forEach(element => {
                        $('#munReceiptMunicipality').html($('#munReceiptMunicipality').html() +
                            '<option class="bg-white" value="' + element.id + '">' + element.municipality + '</option>');
                    });
                });
            } else if ($(this).val() == '9') {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').removeClass('d-none');
                $('#munReceiptBarSelect').removeClass('d-none');
                $('#munReceiptMunicipality').attr('readonly', true);
                $('#munReceiptMunicipality').removeClass('bg-white');
                $('#munReceiptMunicipality').val('');
                $('#munReceiptBarangay').attr('readonly', true);
                $('#munReceiptBarangay').removeClass('bg-white');
            } else if ($(this).val() == '10' || $(this).val() == '11') {
                $('#client-type-permitFees').removeClass('d-none');
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#munReceiptMunicipality').attr('readonly', false);
                $('#munReceiptMunicipality').addClass('bg-white');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#munReceiptBarSelect').removeClass('d-none');
                $('#munReceiptMunicipality').attr('readonly', true);
                $('#munReceiptMunicipality').removeClass('bg-white');
                $('#munReceiptMunicipality').val('');
                $('#munReceiptBarangay').attr('readonly', true);
                $('#munReceiptBarangay').removeClass('bg-white');
                $('#munReceiptBarangay').val('');
            } else if ($(this).val() == '13') {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-bidders').removeClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#munReceiptBarSelect').removeClass('d-none');
                $('#munReceiptMunicipality').attr('readonly', true);
                $('#munReceiptMunicipality').removeClass('bg-white');
                $('#munReceiptMunicipality').val('');
                $('#munReceiptBarangay').attr('readonly', true);
                $('#munReceiptBarangay').removeClass('bg-white');
            }  else if ($(this).val() == '') {
                $('#client-type-individual').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#munBar').removeClass('d-none');
                $('#client-type-separator').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-permittees').addClass('d-none')
                $('#client-type-permitFees').addClass('d-none')
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#munReceiptBarSelect').removeClass('d-none');
                $('#munReceiptMunicipality').attr('readonly', true);
                $('#munReceiptMunicipality').removeClass('bg-white');
                $('#munReceiptMunicipality').val('');
                $('#munReceiptBarangay').attr('readonly', true);
                $('#munReceiptBarangay').removeClass('bg-white');
                $('#munReceiptBarangay').val('');
            } else {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-contractor').removeClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#munBar').removeClass('d-none');
                $('#client-type-permittees').addClass('d-none')
                $('#client-type-permitFees').addClass('d-none')
                $('#client-type-others').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#munReceiptBarSelect').removeClass('d-none');
                $('#munReceiptMunicipality').attr('readonly', false);
                $('#munReceiptMunicipality').addClass('bg-white');
                $('#munReceiptBarangay').attr('readonly', false);
                $('#munReceiptBarangay').removeClass('bg-white');
                $('#munReceiptBarangay').val('');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $.ajax({
                    method: "POST",
                    url: "{{ route('getMunicipality') }}",
                    async: false,
                    data: {
                        id: $(this).val(),
                        client_type: $('#munReceiptClientType').val()
                    }
                }).done(function(data) {
                    $('#munReceiptMunicipality').html('<option class="bg-white" value=""></option>');
                    data.forEach(element => {
                        $('#munReceiptMunicipality').html($('#munReceiptMunicipality').html() +
                            '<option class="bg-white" value="' + element.id + '">' + element.municipality + '</option>');
                    });
                });
            }
        });

        function getPercentRate() {
            return $('#percentRate').val(); 
        }

        function setPercentRate(percentRate) {
            return $('#percentRate').val(percentRate);
        }

        var individual_last_name_auto = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getIndividualsLastName') }}',
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
                    $('#munReceiptFirstName').val(ui.item.firstName);
                    $('#munReceiptMI').val(ui.item.middleInitial);
                    $('#munReceiptSex').val(ui.item.sex);
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
                    'url': '{{ route('getIndividualsFirsttName') }}',
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
                    $('#munReceiptLastName').val(ui.item.lastName);
                    $('#munReceiptMI').val(ui.item.middleInitial);
                    $('#munReceiptSex').val(ui.item.sex);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                }
            }
        }
    
        var business_name_auto = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getContractors') }}',
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "term": request.term,
                    },
                    'method': "post",
                    'dataType': "json",
                    'success': function(data) {
                        if ($('#munReceiptBusinessName').val() == '') {
                            $('#munReceiptOwner').val('');
                            $('#munReceiptAddress').val('');
                        }
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                    $(this).val('');
                    $('#munReceiptOwner').val('');
                } else {
                    $('#munReceiptOwner').val(ui.item.owner);
                    $('#munReceiptAddress').val(ui.item.address);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                    $(this).val('');
                    $('#munReceiptOwner').val('');
                    Swal.fire({
                        title: "Entered data doesn't exist. Click 'Add' to save new clients info",
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: 'Add',
                        icon: 'warning'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href='{{ route('pages.contractors')  }}';
                            Swal.fire('Redirecting to Contractors page');
                        }
                    });
                }
            }
        }

        var permit_fees_trade_name_auto = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getPermitFeesTradeName') }}',
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
                    $(this).val('');
                    $('#munReceiptProprietor').val('');
                } else {
                    $('#munReceiptProprietor').val(ui.item.proprietor);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                    $(this).val('');
                    $('#munReceiptProprietor').val('');
                    Swal.fire({
                        title: "Entered data doesn't exist. Click 'Add' to save new clients info",
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: 'Add',
                        icon: 'warning'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href='{{ route('pages.permittees_others')  }}';
                            Swal.fire('Redirecting to Permit Fees page');
                        }
                    });
                }
            }
        }

        var permittees_sg_trade_name_auto = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getPermitteesTradeName') }}',
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
                    $(this).val('');
                    $('#munReceiptPermitteeTradeName').val('');
                } else {
                    $('#munReceiptPermitteeTradeName').val(ui.item.trade_name);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                    $(this).val('');
                    $('#munReceiptProprietor').val('');
                    Swal.fire({
                        title: "Entered data doesn't exist. Click 'Add' to save new clients info",
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: 'Add',
                        icon: 'warning'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href='{{ route('pages.permittees_sg')  }}';
                            Swal.fire('Redirecting to Permittees page');
                        }
                    });
                }
            }
        }

        var bidders_auto = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('biddersAutoComplete') }}',
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
                    $(this).val('');
                    $('#munReceiptBiddersOwner').val('');
                } else {
                    $('#munReceiptBiddersOwner').val(ui.item.owner_representative);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                    $('#clientFieldBidders').html('<label class="text-light">Add New Info</label><button id="addClientDataBtn" type="button" class="btn btn-info btn-sm">Add</button>');
                    Swal.fire({
                        title: "Entered data doesn't exist. Click 'Add' to save new clients info",
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                        icon: 'warning'
                    }).then((result) => {
                        $('#addClientDataBtn').click(function() {
                            Swal.fire({
                                title: "Save new info?",
                                showDenyButton: false,
                                showCancelButton: true,
                                confirmButtonText: 'Add',
                                icon: 'warning'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('insertBiidersInfo') }}",
                                        'data': {
                                            "_token": "{{ csrf_token() }}",
                                            "biddersBusinessName": $('#munReceiptBiddersBusinessName').val(),
                                            "biddersOwner": $('#munReceiptBiddersOwner').val()
                                        },
                                        'dataType': "json",
                                        'success': function(data) {
                                            response(data);
                                        }
                                    });
                                    Swal.fire('Successfully Saved');
                                    $('#clientFieldBidders').remove();
                                }
                            });
                        });
                    });
                }
            }
        }

        var rentals_auto = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('rentalsAutoComplete') }}',
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
                    $(this).val('');
                    $('#munReceiptRentalLocation').val('');
                    $('#munReceiptRentalLease').val('');
                } else {
                    $('#munReceiptRentalLocation').val(ui.item.location);
                    $('#munReceiptRentalLease').val(ui.item.lease_of_contact);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                    $('#clientField').html('<label class="text-light">Add New Info</label><button id="addClientDataBtn" type="button" class="btn btn-info btn-sm">Add</button>');
                    Swal.fire({
                        title: "Entered data doesn't exist. Click 'Add' to save new clients info",
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                        icon: 'warning'
                    }).then((result) => {
                        $('#addClientDataBtn').click(function() {
                            Swal.fire({
                                title: "Save new info?",
                                showDenyButton: false,
                                showCancelButton: true,
                                confirmButtonText: 'Add',
                                icon: 'warning'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('insertRentalsInfo') }}",
                                        'data': {
                                            "_token": "{{ csrf_token() }}",
                                            "rentalName": $('#munReceiptRentalName').val(),
                                            "rentalLocation": $('#munReceiptRentalLocation').val(),
                                            "rentalLease": $('#munReceiptRentalLease').val(),
                                        },
                                        'dataType': "json",
                                        'success': function(data) {
                                            response(data);
                                        }
                                    });
                                    Swal.fire('Successfully Saved');
                                    $('#clientField').remove();
                                }
                            });
                        });
                    });
                }
            }
        }

        $('#dateOfTransaction').change(function () {
            let dateOfTransaction = moment($(this).val(), 'MM/DD/YYYY');
            let transactionDay = dateOfTransaction.format('D');
            let transactionMonth = dateOfTransaction.format('M');
            let transactionYear = dateOfTransaction.format('YYYY')
            let currentMonth = moment().format('M');
            let currentDay = moment().format('D');
            let dayName = moment().format('dddd');
            let currentYear = moment().format('YYYY');
            let dateToday = moment();
            let rate = 0;
            let isValid = true;
            let penaltyYear = currentYear;
            let flag = false;
            let totalMonths = 0;

            if ($('#penaltyType').val() == 'Tax Revenue - Fines & Penalties - Goods & Services' || $('#penaltyType').val() == 'Fines & Penalties - Service Income (General Fund-Proper)') {
                if (transactionYear == currentYear) {
                    if (transactionMonth == 1) {
                        if (transactionDay > 21) {
                            flag = true;
                        }
                    }
                }
                
                if ( flag ) {
                    totalMonths = 0;
                } else {
                    if (transactionMonth == 1) {
                        if (transactionDay <= 21) {
                            penaltyYear = transactionYear;
                        }
                    } else {
                        penaltyYear = (transactionYear*1);
                    }

                    let penaltyMonth = moment('1').format('M');
                    if (currentMonth == 1) {
                        if (currentDay >= 21) {
                            currentMonth -= 1;
                        }
                    } else {
                        if (transactionDay >= 1) {
                            currentMonth = transactionMonth - penaltyMonth + 1;
                        } else {
                            currentMonth = transactionMonth - penaltyMonth;
                        }
                    }
                    let yearDiff = currentYear - penaltyYear;
                    totalMonths = (currentMonth*1) + (yearDiff * 12);
                }
                
                
            } else if ($('#penaltyType').val() == 'Tax Revenue - Fines & Penalties - on Individual (PTR)') {
                if (transactionYear == currentYear) {
                    if (transactionMonth == 1) {
                        if (transactionDay > 1) {
                            flag = true;
                        }
                    }
                }
                
                if ( flag ) {
                    totalMonths = 0;
                } else {
                    if (transactionMonth == 1) {
                        if (transactionDay <= 31 || transactionDay <= 30 || transactionDay <= 28) {
                            penaltyYear = transactionYear;
                        }
                    } else {
                        penaltyYear = (transactionYear*1);
                    }
                    
                    let penaltyMonth = moment('1').format('M');
                    if (currentMonth == 1) {
                        if (currentDay >= 2) {
                            currentMonth -= 1;
                        }
                    } else {
                        if (transactionDay >= 1) {
                            currentMonth = transactionMonth - penaltyMonth + 1;
                        }
                    }
                    
                    let yearDiff = currentYear - penaltyYear;
                    totalMonths = (currentMonth*1) + (yearDiff * 12);
                }
            }

            let calcRate = totalMonths*2;
            $('#calculatedRate').val(calcRate);

            $('#percentAmount').mask("#00,000,000,000,000.00", {reverse: true});
            let amountString = $('#percentAmount').val();
            let value = parseFloat(amountString.replace(/,/g, ""));
            let firstEqu = 0.00;
            firstEqu = value * getPercentRate();
            firstResult = firstEqu + value;
            SecondEqu = firstResult * calcRate / 100;
            finalValue = firstEqu  + SecondEqu;
            givenValue = finalValue.toFixed(2);
            $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $('#calculatedRate').val(calcRate);

            $('#percentAmount').keyup(function () {
                $('#percentAmount').mask("#00,000,000,000,000.00", {reverse: true});
                let amountString = $('#percentAmount').val();
                let value = parseFloat(amountString.replace(/,/g, ""));
                let firstEqu = 0.00;
                firstEqu = value * getPercentRate();
                firstResult = firstEqu + value;
                SecondEqu = firstResult * calcRate / 100;
                finalValue = firstEqu  + SecondEqu;
                givenValue = finalValue.toFixed(2);
                $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                $('#calculatedRate').val(calcRate);
            });
            return true;
        });

        $('#dateOfPenalty').change(function() {
            let dateOfTransaction = moment($('#dateOfTransaction').val(), 'MM/DD/YYYY');
            let dueDate = moment($('#dateOfPenalty').val(), 'MM/DD/YYYY');
            let transactionDay = dateOfTransaction.format('D');
            let transactionMonth = dateOfTransaction.format('M');
            let transactionYear = dateOfTransaction.format('YYYY');
            let transactionDueDay = dueDate.format('D');
            let transactionDueMonth = dueDate.format('M');
            let transactionDueYear = dueDate.format('YYYY')
            let currentMonth = moment().format('M');
            let currentDay = moment().format('D');
            let dayName = moment().format('dddd');
            let currentYear = moment().format('YYYY');
            let dateToday = moment();
            let rate = 0;
            let isValid = true;
            let penaltyYear = currentYear;
            let flag = false;
            let totalMonths = 0;
            let calcMonths = 0;

            if (transactionYear == currentYear) {
                if (transactionMonth == 1) {
                    if (transactionDay > 4) {
                        flag = true;
                    }
                }
            }
                
            if ( flag ) {
                totalMonths = 0;
            } else {
                if (transactionMonth == 1) {
                    if (transactionDay <= 3) {
                        penaltyYear = transactionYear;
                    }
                } else {
                    penaltyYear = (transactionYear*1);
                }

                let penaltyMonth = moment('1').format('M');
                if (transactionMonth == transactionDueMonth) {
                    if (transactionDay >= 3) {
                        penaltyRate = transactionMonth - transactionDueMonth + 1;
                    }
                } else {
                    if (transactionDay >= 3) {
                        penaltyRate = transactionMonth - transactionDueMonth + 1;
                    }
                }
                let yearDiff = currentYear - penaltyYear;
                calcMonths = (penaltyRate*1) + (yearDiff * 12);
            }
            
            let calcRate = calcMonths*2;
            $('#calculatedRate').val(calcRate);

            $('#percentAmount').mask("#00,000,000,000,000.00", {reverse: true});
            let amountString = $('#percentAmount').val();
            let value = parseFloat(amountString.replace(/,/g, ""));
            let firstEqu = 0.00;
            firstEqu = value * getPercentRate();
            firstResult = firstEqu + value;
            SecondEqu = firstResult * calcRate / 100;
            finalValue = firstEqu  + SecondEqu;
            givenValue = finalValue.toFixed(2);
            $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $('#calculatedRate').val(calcRate);

            $('#percentAmount').keyup(function () {
                $('#percentAmount').mask("#00,000,000,000,000.00", {reverse: true});
                let amountString = $('#percentAmount').val();
                let value = parseFloat(amountString.replace(/,/g, ""));
                let firstEqu = 0.00;
                firstEqu = value * getPercentRate();
                firstResult = firstEqu + value;
                SecondEqu = firstResult * calcRate / 100;
                finalValue = firstEqu  + SecondEqu;
                givenValue = finalValue.toFixed(2);
                $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                $('#calculatedRate').val(calcRate);
            });
            return true;
                
        });

        $('#munReceiptTransaction').change(function() {
            $('#munReceiptBank').attr('readonly', false);
            $('#munReceiptBank').addClass('bg-white');

            $('#munReceiptNumber').attr('readonly', false);
            $('#munReceiptNumber').addClass('bg-white');

            $('#munReceiptTransactDate').attr('readonly', false);
            $('#munReceiptTransactDate').addClass('bg-white');

            if ($(this).val() == 'Cash' || $(this).val() == 'null') {
                $('#munReceiptBank').attr('readonly', true);
                $('#munReceiptBank').removeClass('bg-white');

                $('#munReceiptNumber').attr('readonly', true);
                $('#munReceiptNumber').removeClass('bg-white');

                $('#munReceiptTransactDate').attr('readonly', true);
                $('#munReceiptTransactDate').removeClass('bg-white');

                $('#bankRemarks').addClass('d-none');
            } else {
                $('#bankRemarks').removeClass('d-none');
            }
        });

        $('#munReceiptCert').change(function() {
            trigger = 1;
            let modalContent = $('#inputRowProvPermit').find('tr').last();
            let munReceiptAccount = $('.munReceiptAccount')[0];
            let munReceiptNature = $('.munReceiptNature')[0];
            let munReceiptAmmount = $('.munReceiptAmmount')[0];

            $(munReceiptNature).val("");
            $(munReceiptAmmount).val("");
            
            if ($(this).val() == 'Transfer Tax') {
                $(munReceiptAccount).val('Real Property Transfer Tax');
                $(munReceiptAccount).trigger('focus');
                $('.noneFines').addClass('d-none');
                $('.notarytDate').addClass('d-none');
                $('.withSpouse').removeClass('d-none');
                $('.withDonation').removeClass('d-none');
                $('#delivery-receipts').addClass('d-none');
            }

            if ($(this).val() == 'Sand & Gravel') {
                $(munReceiptAccount).val('Tax on Sand, Gravel & Other Quarry Prod.');
                $(munReceiptAccount).trigger('focus');
                $('#delivery-receipts').removeClass('d-none');
            }

            if ($(this).val() == 'Provincial Permit') {
                $(munReceiptAccount).val('Permit Fees');
                $(munReceiptAccount).trigger('focus');
                $('#delivery-receipts').addClass('d-none');
            }
        });

        let trigger = 0;
        let autoCompleteData = [];
        var category_autocomplete = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getAccountTitles') }}',
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
            },
            open: function(e, ui) {
                if (trigger == 1) {
                    $(".ui-menu-item:eq(0)").trigger("click");
                }
                return false;
            },
            select: function(event, ui) {
                if (trigger == 1 || ui.item.id != '') {
                    $(this).val(ui.item.value);
                    trigger = 0;
                    var parent = $(this).parents('tr');
                    var munReceiptTypeRate = $(parent).find('td input')[2];
                    var myRow = $("#new-land-tax-table tr").index($(this).parents('tr'));

                    if (ui.item == null || ui.item == "") {
                        $(this).val('');
                    } else {

                        if (ui.item.type == 'Fixed') {
                            $('.munReceiptAmount').val(ui.item.fixed_rate);
                        } else if (ui.item.type == 'Manual') {

                        } else if (ui.item.type == 'Percent') {
                            $('#percentModal').modal('show');
                            $('#percentRate').val(ui.item.percent_value);
                            $('#ratePerMonth').val(2.00);
                            $('#percentOfValue').val(ui.item.percent_of);
                            $('#percentRowIndex').val(myRow - 1);

                        } else if (ui.item.type == 'Schedule') {
                            $('#sched_form')[0].reset();
                            $('#schedRowIndex').val(myRow - 1);

                            var schedule_autocomplete = {
                                minLength: 0,
                                autocomplete: true,
                                source: function(request, response) {
                                    $.ajax({
                                        'url': '{{ route('getSchedules') }}',
                                        'data': {
                                            "_token": "{{ csrf_token() }}",
                                            "term": request.term,
                                            "id": ui.item.id
                                        },
                                        'method': "post",
                                        'dataType': "json",
                                        'success': function(data) {
                                            response(data);
                                        }
                                    });
                                },
                                select: function(event, ui) {
                                    if (ui.item.id != '') {
                                        $(this).val(ui.item.value);
                                    } else {
                                        $(this).val('');
                                    }
                                    return false;
                                },
                                change: function(event, ui) {
                                    if (ui.item == null || ui.item == "") {
                                        $(this).val('');
                                    } else {
                                        if (ui.item.shared_per_unit == 1) {
                                            $('#munReceipt').attr('readonly', false);
                                        } else {
                                            $('#munReceipt').attr('readonly', true);
                                        }
                                        $('#munReceipt').val(ui.item.shared_per_unit);
                                        $('#schedUnitCost').val(ui.item.shared_unit);
                                        $('#schedValue').val(ui.item.shared_value);
                                        $('#schedTotal').val(ui.item.shared_value);
                                    }
                                }
                            }

                            $("#schedAuto").autocomplete(schedule_autocomplete).focus(function() {
                                $(this).autocomplete('search', $(this).val());
                            });

                            $('#scheduleModal').modal('show');
                        } else {

                        }
                        $(munReceiptTypeRate).val(ui.item.type);
                    }
                }  else {
                    $(this).val('');
                }
                return false;
            },
            change: function(event, ui) {
                var parent = $(this).parents('tr');
                var munReceiptTypeRate = $(parent).find('td input')[2];
                var myRow = $("#new-land-tax-table tr").index($(this).parents('tr'));
                var munReceiptAccount = $(parent).find('td input')[1];
                if (ui.item == null || ui.item == "") {
                    $(this).val('');
                } else {
                    if (ui.item.type == 'Fixed') {
                        $('.munReceiptAmount').val(ui.item.fixed_rate);
                    } else if (ui.item.type == 'Manual') {

                    } else if (ui.item.type == 'Percent') {
                        $('#percent_form')[0].reset();
                        $('#percentModal').modal('show');
                        let ratePenalty = $('#percentRate').val(ui.item.percent_value);
                        ratePenalty = ui.item.percent_value / 100;
                        setPercentRate(ratePenalty);
                        let ratePerMonth = 2.00;
                        $('#ratePerMonth').val(ratePerMonth.toFixed(2));
                        let amount = $('.munReceiptAmount').val();
                        $('#percentOfValue').val(ui.item.percent_of);
                        $('#percentRowIndex').val(myRow - 1);

                        if (ui.item.title == 'Fines & Penalties - Service Income (General Fund-Proper)') {
                            $('.withSpouse').addClass('d-none');
                            $('.withDonation').addClass('d-none');
                            $('.noneFines').removeClass('d-none');
                            $('.dateOfTransaction').removeClass('d-none');
                            $('.notarytDate').addClass('d-none');
                            $('#penaltyType').val(ui.item.title);
                            $('#dateOfPenalty').val('01/21/2022');
                            $('#percentAmount').val(amount);
                            
                            if(myRow == 1) {
                                isValid = false;
                                $('#percentModal').modal('hide');
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Choose an account before entering Fines & Penalties'
                                });
                                $($($('#inputRow').find('tr')[0]).find('td input')[1]).val('');
                                $($($('#inputRow').find('tr')[0]).find('td input')[2]).val('');
                            } else if (myRow == 2) {
                                let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                $('#percentAmount').val(firstRow.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 3 && $(munReceiptAccount).val().includes('Fines & Penalties')) {
                                let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let secondRow = $('#inputRow').find('tr:nth-child(2)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let resultRow = (firstRow*1) + (secondRow*1);
                                result = resultRow.toFixed(2);
                                $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 4 && $(munReceiptAccount).val().includes('Fines & Penalties')) {
                                let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                let secondRow = $('#inputRow').find('tr:nth-child(2)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                let thirdRow = $('#inputRow').find('tr:nth-child(3)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                let resultRow = (firstRow*1) + (secondRow*1) +(thirdRow*1);
                                $('#percentAmount').val(resultRow.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 5 && $(munReceiptAccount).val().includes('Fines & Penalties')) {
                                if ($('#inputRow').find('tr:nth-child(4)').find('td:nth-child(2)').children('input').val() != $(munReceiptAccount).val().includes('Fines & Penalties')) {
                                    let fourthRow = $('#inputRow').find('tr:nth-child(4)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                    $('#percentAmount').val(fourthRow.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                }
                            } else if (myRow == 6 && $(munReceiptAccount).val().includes('Fines & Penalties')) {
                                if ($('#inputRow').find('tr:nth-child(4)').find('td:nth-child(2)').children('input').val().includes('Real Property Transfer Tax')) {
                                    if ($('#inputRow').find('tr:nth-child(5)').find('td:nth-child(2)').children('input').val().includes('Real Property Transfer Tax')) {
                                        let fourthRow = $('#inputRow').find('tr:nth-child(4)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                        let fifthRow = $('#inputRow').find('tr:nth-child(5)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                        let resultRow = (fourthRow*1) + (fifthRow*1);
                                        result = resultRow.toFixed(2);
                                        $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                    }
                                } else {
                                    let fifthRow = $('#inputRow').find('tr:nth-child(5)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                    $('#percentAmount').val(fifthRow.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                }
                            }

                            if(myRow <= 1) {
                                isValid = false;
                                $('#percentModal').modal('hide');
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Choose an account before entering Fines & Penalties'
                                });
                                $($($('#inputRow').find('tr')[0]).find('td input')[1]).val('');
                                $($($('#inputRow').find('tr')[0]).find('td input')[2]).val('');
                            }

                        } else if (ui.item.title == 'Fines & Penalties - Business Income (General Fund-Proper)') {
                            $('.withSpouse').addClass('d-none');
                            $('.withDonation').addClass('d-none');
                            $('.noneFines').removeClass('d-none');
                            $('.dateOfTransaction').removeClass('d-none');
                            $('.notarytDate').addClass('d-none');
                            $('#dateOfPenalty').attr('readonly', false);
                            $('#dateOfPenalty').addClass('bg-white');
                            $('#penaltyType').val(ui.item.title);
                            $('#percentAmount').val(amount);
                                
                            if(myRow == 1) {
                                isValid = false;
                                $('#percentModal').modal('hide');
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Choose an account before entering Fines & Penalties'
                                });
                                $($($('#inputRow').find('tr')[0]).find('td input')[1]).val('');
                                $($($('#inputRow').find('tr')[0]).find('td input')[2]).val('');
                            } else {
                                let firstRowAmount = $($('#inputRow').find('tr')[0]).find('td input')[5];
                                $('#percentAmount').val($(firstRowAmount).val());
                            }

                        } else if (ui.item.title == 'Tax Revenue - Fines & Penalties - on Individual (PTR)') {
                            $('.withSpouse').addClass('d-none');
                            $('.withDonation').addClass('d-none');
                            $('.noneFines').removeClass('d-none');
                            $('.dateOfTransaction').removeClass('d-none');
                            $('.notarytDate').addClass('d-none');
                            $('.dateOfTransaction').removeClass('d-none');
                            $('#penaltyType').val(ui.item.title);
                            $('#dateOfPenalty').val('02/01/2022');

                            if(myRow == 1) {
                                isValid = false;
                                $('#percentModal').modal('hide');
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Choose an account before entering Fines & Penalties'
                                });
                                $($($('#inputRow').find('tr')[0]).find('td input')[1]).val('');
                                $($($('#inputRow').find('tr')[0]).find('td input')[2]).val('');
                            } else {
                                let firstRowAmount = $($('#inputRow').find('tr')[0]).find('td input')[5];
                                $('#percentAmount').val($(firstRowAmount).val());
                            }

                        } else if (ui.item.title == 'Tax Revenue - Fines & Penalties - Goods & Services') {
                            $('.noneFines').removeClass('d-none');
                            $('.dateOfTransaction').removeClass('d-none');
                            $('.notarytDate').addClass('d-none');
                            $('.withSpouse').addClass('d-none');
                            $('.withDonation').addClass('d-none');
                            $('#percentAmount').val(amount);
                            $('#penaltyType').val(ui.item.title);
                            $('#dateOfPenalty').val('01/21/2022');

                            if(myRow == 1) {
                                isValid = false;
                                $('#percentModal').modal('hide');
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Choose an account before entering Fines & Penalties'
                                });
                                $($($('#inputRow').find('tr')[0]).find('td input')[1]).val('');
                                $($($('#inputRow').find('tr')[0]).find('td input')[2]).val('');
                            } else {
                                let firstRowAmount = $($('#inputRow').find('tr')[0]).find('td input')[5];
                                $('#percentAmount').val($(firstRowAmount).val());
                            }

                        } else if (ui.item.title == 'Tax Revenue - Fines & Penalties - Property Taxes') {
                            $('.notarytDate').removeClass('d-none');
                            $('.noneFines').removeClass('d-none');
                            $('.withSpouse').addClass('d-none');
                            $('.withDonation').addClass('d-none');
                            $('.dateOfTransaction').addClass('d-none');
                            $('#penaltyType').val(ui.item.title);
                            $('#dateOfPenalty').val('01/21/2022');
                            $('#percentAmount').val(amount);
                            
                            
                            if(myRow == 1) {
                                isValid = false;
                                $('#percentModal').modal('hide');
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Choose an account before entering Fines & Penalties'
                                });
                                $($($('#inputRow').find('tr')[0]).find('td input')[1]).val('');
                                $($($('#inputRow').find('tr')[0]).find('td input')[2]).val('');
                            } else if (myRow == 2) {
                                let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                $('#percentAmount').val(firstRow.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 3 && $(munReceiptAccount).val().includes('Fines & Penalties')) {
                                let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let secondRow = $('#inputRow').find('tr:nth-child(2)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let resultRow = (firstRow*1) + (secondRow*1);
                                result = resultRow.toFixed(2);
                                $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 4 && $(munReceiptAccount).val().includes('Fines & Penalties')) {
                                let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let secondRow = $('#inputRow').find('tr:nth-child(2)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let thirdRow = $('#inputRow').find('tr:nth-child(3)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let resultRow = (firstRow*1) + (secondRow*1) +(thirdRow*1);
                                result = resultRow.toFixed(2);
                                $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 5 && $(munReceiptAccount).val().includes('Fines & Penalties')) {
                                if ($('#inputRow').find('tr:nth-child(4)').find('td:nth-child(2)').children('input').val() != $(munReceiptAccount).val().includes('Fines & Penalties')) {
                                    let fourthRow = $('#inputRow').find('tr:nth-child(4)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                    result = fourthRow.toFixed(2);
                                    $('#percentAmount').val(fourthRow.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                }
                            } else if (myRow == 6 && $(munReceiptAccount).val().includes('Fines & Penalties')) {
                                if ($('#inputRow').find('tr:nth-child(4)').find('td:nth-child(2)').children('input').val().includes('Real Property Transfer Tax')) {
                                    if ($('#inputRow').find('tr:nth-child(5)').find('td:nth-child(2)').children('input').val().includes('Real Property Transfer Tax')) {
                                        let fourthRow = $('#inputRow').find('tr:nth-child(4)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                        let fifthRow = $('#inputRow').find('tr:nth-child(5)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                        let resultRow = (fourthRow*1) + (fifthRow*1);
                                        result = resultRow.toFixed(2);
                                        $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                    }
                                } else {
                                    let fifthRow = $('#inputRow').find('tr:nth-child(5)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                    $('#percentAmount').val(fifthRow.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                }
                            }

                            if(myRow == 1) {
                                isValid = false;
                                $('#percentModal').modal('hide');
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Choose an account before entering Fines & Penalties'
                                });
                                $($($('#inputRow').find('tr')[0]).find('td input')[1]).val('');
                                $($($('#inputRow').find('tr')[0]).find('td input')[2]).val('');
                            }
                            
                        } else {
                            $('.noneFines').addClass('d-none');
                            $('.notarytDate').addClass('d-none');
                            $('.withSpouse').removeClass('d-none');
                            $('.withDonation').removeClass('d-none');
                        }
                    } else if (ui.item.type == 'Schedule') {
                        $('#sched_form')[0].reset();
                        $('#schedRowIndex').val(myRow - 1);

                        var schedule_autocomplete = {
                            minLength: 0,
                            autocomplete: true,
                            source: function(request, response) {
                                $.ajax({
                                    'url': '{{ route('getSchedules') }}',
                                    'data': {
                                        "_token": "{{ csrf_token() }}",
                                        "term": request.term,
                                        "id": ui.item.id
                                    },
                                    'method': "post",
                                    'dataType': "json",
                                    'success': function(data) {
                                        response(data);
                                    }
                                });
                            },
                            select: function(event, ui) {
                                if (ui.item.id != '') {
                                    $(this).val(ui.item.value);
                                } else {
                                    $(this).val('');
                                }
                                return false;
                            },
                            change: function(event, ui) {
                                if (ui.item == null || ui.item == "") {
                                    $(this).val('');
                                } else {
                                    if (ui.item.shared_per_unit == 1) {
                                        $('#munReceipt').attr('readonly', false);
                                    } else {
                                        $('#munReceipt').attr('readonly', true);
                                    }
                                    $('#munReceipt').val(ui.item.shared_per_unit);
                                    $('#schedUnitCost').val(ui.item.shared_unit);
                                    $('#schedValue').val(ui.item.shared_value);
                                    $('#schedTotal').val(ui.item.shared_value);

                                    $("#schedAuto").autocomplete(schedule_autocomplete).focus(function() {
                                        $(this).autocomplete('search', $(this).val());
                                    });
                                }
                            }
                        }
                        $('#scheduleModal').modal('show');
                    } else {

                    }
                    $(munReceiptTypeRate).val(ui.item.type);    
                }
            }
        }

        $(".munReceiptAccount").autocomplete(category_autocomplete).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#munReceiptLastName").autocomplete(individual_last_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#munReceiptFirstName").autocomplete(individual_first_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#munReceiptBusinessName").autocomplete(business_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });
        
        $("#munReceiptPermitFeesTradeName").autocomplete(permit_fees_trade_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#munReceiptPermittee").autocomplete(permittees_sg_trade_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#munReceiptBiddersBusinessName").autocomplete(bidders_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#munReceiptRentalName").autocomplete(rentals_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $('#percentModal').on('shown.bs.modal', function (e) {
            $('#percentAmount').keyup(function () {
                $(this).mask("#00,000,000,000,000.00", {reverse: true});
                let amountString = $(this).val();
                let amount = parseFloat(amountString.replace(/,/g, ""));
                let ofValue = $('#percentOfValue').val();
                let givenValue = 0.00;
                givenValue = 0.005 * amount;
                givenValue = givenValue.toFixed(2);
                $('#amountHolder').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            });

            $('#percentOf').keyup(function () {
                $('#percentOf').mask("#00,000,000,000,000.00", {reverse: true});
                let percent = $('#amountHolder').val();
                let convert = parseFloat(percent.replace(/,/g, ""));
                let percentValue = $('#percentOf').val();
                let percentOf = percentValue / 10;
                let totalValue = 0.00;
                totalValue = convert * percentOf;
                totalValue = totalValue.toFixed(2);
                $('#percentValue').val(totalValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            });
        });

        $('#munReceiptMunicipality').change(function() {
            $('#munReceiptBarangay').attr('readonly', false);
            $('#munReceiptBarangay').addClass('bg-white');
            if ($(this).val() == 'null') {
                $('#munReceiptBarangay').attr('readonly', true);
                $('#munReceiptBarangay').removeClass('bg-white');
            }
            $.ajax({
                method: "POST",
                url: "{{ route('getBarangays') }}",
                async: false,
                data: {
                    id: $(this).val(),
                }
            }).done(function(data) {
                $('#munReceiptBarangay').html('<option class="bg-white" value=""></option>');
                data.forEach(element => {
                    $('#munReceiptBarangay').html($('#munReceiptBarangay').html() +
                        '<option class="bg-white" value="' + element.id + '">' + element.barangay_name + '</option>');
                });
            });
        });

        $('#addRowAccount').click(function() {
            var html = '';
            html += '<tr class="newRow">';
            html +=
                '<td class="d-none"><input type="text"name="munReceiptAccountID[]" class="munReceiptAccountID form-control mb-0 bg-white text-dark">';

            html += '<td>';
            html +=
                '<input type="text" name="munReceiptAccount[]" class="munReceiptAccount form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '</td>';

            html += '<td>';
            html +=
                '<input readonly type="text" name="munReceiptTypeRate[]"class="d-none munReceiptTypeRate form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html +=
                '<input readonly type="text" name="munReceiptQuantity[]"class="d-none munReceiptQuantity form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html +=
                '<input type="text" name="munReceiptNature[]" class="munReceiptNature form-control mb-0 bg-white text-dark">';
            html += '</td>';

            html += '<td>';
            html +=
                '<input type="text" name="munReceiptAmount[]" class="munReceiptAmount form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html +=
                '<div><button type="button" class=" removeRow btn btn-danger btn-sm mb-4 tim-icons icon-simple-delete"></button></div>';
            html += '</td>';
            html += '</tr>';

            let lastRow = $('#inputRow').find('tr').last();
            $('#inputRow').append(html);

            $(".munReceiptAccount").autocomplete(category_autocomplete).focus(function() {
                $(this).autocomplete('search', $(this).val())
            });

            $('.removeRow').on('click', function() {
                $(this).closest('tr').remove();
                $('.munReceiptAmount').trigger('change');
            });

            $('.munReceiptAmount').keyup(function () {
                $(this).mask("#00,000,000,000,000.00", {reverse: true});
            });
            
            $('.munReceiptAmount').change(function() {
                var sum = 0.00;
                $('.munReceiptAmount').each(function() {
                    let stringFloat = '0.00';
                    if ($(this).val() != '') {
                        stringFloat = $(this).val();
                    }
                    let float = stringFloat.replace(',','');
                    sum = sum + parseFloat(float);
                });
                sum = sum.toFixed(2);
                $('#munReceiptTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            });
        });

        $('#survivingSpouse').on('click', function() {
            if ($('#survivingSpouse').prop('checked') == true) {
                let spouse = $('#percentValue').val();
                let amount = parseFloat(spouse.replace(/,/g, ""));
                let resultSpouse = amount/2;
                $('#percentValue').val(resultSpouse);
                resultSpouse = resultSpouse.toFixed(2);
                $('#percentValue').val(resultSpouse.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                $(this).val(1);
            } else {
                $('#percentAmount').mask("#00,000,000,000,000.00", {reverse: true});
                let amountString = $('#percentAmount').val();
                let amount = parseFloat(amountString.replace(/,/g, ""));
                let ofValue = $('#percentOfValue').val();
                let givenValue = 0.00;
                givenValue = 0.005 * amount;
                givenValue = givenValue.toFixed(2);
                $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                $(this).val(0);
            }
        });

        $('#donation').on('click', function() {
            if ($('#donation').prop('checked') == true) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        });

        $('#munReceipt').keyup(function() {
            $(this).mask("#00,000,000,000,000.00", {reverse: true});
            let setVal = $(this).val();
            let getVal = parseFloat(setVal.replace(/,/g, ""));
            let total = 0.00;
            total = getVal * $('#schedValue').val();
            total = total.toFixed(2);
            $('#schedTotal').val(total.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('.munReceiptAmmount').change(function() {
            let total = 0;
            $('.munReceiptAmmount').each(function() {
                total = total + $(this).val();
            });
            $('#munReceiptTotal').val(total);
        });

        $('.munReceiptAmmount').change(function() {
            let total = 0;
            $('.munReceiptAmmount').each(function() {
                total = total + $(this).val();
            });
            $('#munReceiptTotal').val(total);
        });

        $('.munReceiptAmount').keyup(function () {
            $(this).mask("#00,000,000,000,000.00", {reverse: true});
        });

        $('.munReceiptAmount').change(function() {
            var sum = 0.00;
            $('.munReceiptAmount').each(function() {
                let stringFloat = '0.00';
                if ($(this).val() != '') {
                    stringFloat = $(this).val();
                }
                let float = stringFloat.replace(',','');
                sum = sum + parseFloat(float);
            });
            sum = sum.toFixed(2);
            $('#munReceiptTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('#sched-btn').click(function() {
            let row = $('#new-land-tax-table tbody').find('tr')[$('#schedRowIndex').val()];
            var munReceiptQuantity = $(row).find('td input')[3];
            var munReceiptAccount = $(row).find('td input')[1];
            var munReceiptTotal = $(row).find('td input')[5];
            var munReceiptNature = $(row).find('td input')[4];
            $(munReceiptQuantity).val($('#munReceipt').val());
            $(munReceiptTotal).val($('#schedTotal').val());
            $(munReceiptTotal).trigger('change');
            if ($('#schedAuto').val() == 'Aggregate Base Course/SBBC (1cu.m @ 15.00)') {
                $(munReceiptNature).val('Aggregate Base Course/SBBC ('+$('#munReceipt').val()+'cu.m @ 15.00)');
            } else if ($('#schedAuto').val() == 'Boulders/stones (1cu.m @ 22.50)') {
                $(munReceiptNature).val('Boulders/stones ('+$('#munReceipt').val()+'cu.m @ 22.50)');
            } else if ($('#schedAuto').val() == 'Crushed Gravel and Sand (1cu.m @ 27.50)') {
                $(munReceiptNature).val('Crushed Gravel and Sand ('+$('#munReceipt').val()+'cu.m @ 27.50)');
            } else if ($('#schedAuto').val() == 'River Sand and Gravel (1cu.m @ 22.50)') {
                $(munReceiptNature).val('River Sand and Gravel ('+$('#munReceipt').val()+'cu.m @ 22.50)');
            } else if ($('#schedAuto').val() == 'Sand and Gravel Penalty (1cu.m @ 100.00)') {
                $(munReceiptNature).val('Sand and Gravel Penalty ('+$('#munReceipt').val()+'cu.m @ 100.00)');
            } else if ($('#schedAuto').val() == 'Sand and Gravel Penalty (1cu.m @ 100.00)') {
                $(munReceiptNature).val('Sand and Gravel Penalty ('+$('#munReceipt').val()+'cu.m @ 100.00)');
            } else if ($('#schedAuto').val() == 'Sand and Gravel Penalty (1cu.m @ 150.00)') {
                $(munReceiptNature).val('Sand and Gravel Penalty ('+$('#munReceipt').val()+'cu.m @ 150.00)');
            } else if ($('#schedAuto').val() == 'Sand and Gravel Penalty (1cu.m @ 200.00)') {
                $(munReceiptNature).val('Sand and Gravel Penalty ('+$('#munReceipt').val()+'cu.m @ 200.00)');
            } else if ($('#schedAuto').val() == 'Sand and Gravel Penalty (1cu.m @ 300.00)') {
                $(munReceiptNature).val('Sand and Gravel Penalty ('+$('#munReceipt').val()+'cu.m @ 300.00)');
            } else if ($(munReceiptAccount).val() == 'General (Buildings/Lots/Light & Water)') {
                $(munReceiptNature).val($('#schedAuto').val() + ' for the month of');
            } else {
                $(munReceiptNature).val($('#schedAuto').val());
            }
            $('#scheduleModal').modal('toggle');
        });

        $('#percent-btn').click(function () {
            let row = $('#new-land-tax-table tbody').find('tr')[$('#percentRowIndex').val()];
            let collAmount = $('munReceiptAmount')[0];
            var munReceiptTotal = $(row).find('td input')[5];
            var munReceiptAccount = $(row).find('td input')[1];
            var munReceiptNature = $(row).find('td input')[4];
            var munReceiptQuantity = $(row).find('td input')[3];

            $(munReceiptTotal).val($('#percentValue').val());
            if ($(munReceiptAccount).val() == 'Fines & Penalties - Service Income (General Fund-Proper)') {
                $(munReceiptNature).val('Surcharge & Interest');
            } else if ($(munReceiptAccount).val() == 'Fines & Penalties - Business Income (General Fund-Proper)') {
                $(munReceiptNature).val('Surcharge & Interest');
            } else if ($(munReceiptAccount).val() == 'Tax Revenue - Fines & Penalties - on Individual (PTR)') {
                $(munReceiptNature).val('Surcharge & Interest');
            } else if ($(munReceiptAccount).val() == 'Tax Revenue - Fines & Penalties - Goods & Services') {
                $(munReceiptNature).val('Surcharge & Interest');
            } else if ($(munReceiptAccount).val() == 'Tax Revenue - Fines & Penalties - Property Taxes') {
                $(munReceiptNature).val('Surcharge & Interest');
            } else if ($(munReceiptAccount).val() == 'Real Property Transfer Tax') {
                if ($('#survivingSpouse').val() == 1) {
                    $(munReceiptNature).val($(munReceiptAccount).val() + ' (EJS w/ surviving spouse ' + $('#percentAmount').val() + ')');
                } else if ($('#survivingSpouse').val() == 0) {
                    $(munReceiptNature).val('Real Property Transfer Tax (Sale w/ SP of ' + $('#percentAmount').val() + ')');
                } else if ($('#donation').val() == 1) {
                    $(munReceiptNature).val('Real Property Transfer Tax (EJS w/ Donation & Consideration of ' + $('#percentAmount').val() + ')');
                } else if ($('#donation').val() == 0) {
                    $(munReceiptNature).val('Real Property Transfer Tax (Sale w/ SP of ' + $('#percentAmount').val() + ')');
                } else {
                    $(munReceiptNature).val('Real Property Transfer Tax (Sale w/ SP of ' + $('#percentAmount').val() + ')');
                }
            } else {
                $(munReceiptNature).val($(munReceiptAccount).val() + ' (w/ amount ' + $('#percentAmount').val() + ')');
            }
            $(munReceiptTotal).trigger('change');
            $('#percentModal').modal('hide');
        });

        $('#submit-btn').click(function() {
            Swal.fire({
                icon: 'info',
                title: 'Form will be Saved. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#submit_mun_receipt_form').submit();
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
        });

        $('#update-btn').click(function() {
            Swal.fire({
                icon: 'info',
                title: 'Form will be Updated. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Update',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('update_mun_receipt_form') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "data": $('#submit_mun_receipt_form').val(),
                        },
                        'dataType': "json",
                        'success': function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfuly Updated Values',
                            });
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
        });
    </script>
@endsection