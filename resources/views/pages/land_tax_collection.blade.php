@extends('layouts.app', ['page' => __('Land Tax Collection'), 'pageSlug' => 'land_tax_collection'])

@section('content')
    <form name="land_tax_form" id="land_tax_form" method="post" action="{{ url('land_tax_form') }}">
        @csrf
        <div class="modal fade" id="addTaxColModal" data-modal-overflow="true" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h3 class="modal-title text-white" id="addTaxColModalTitle">Add New Data</h3>
                        <button type="button" class="closeBtn close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 d-none">
                                    <label for="taxColID">Tax ID</label>
                                    <input type="text" name="taxColID" class="form-control mb-0 bg-white text-dark"
                                        id="taxColID">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div id="currentDate" class="col-sm-3">
                                    <label class="text-light" for="taxColcurrentDate">Currrent Date</label>
                                    <input type="text" name="taxColcurrentDate" class="form-control currentDate bg-white text-dark mb-3" id="taxColcurrentDate"/>
                                </div>

                                <div id="editDateRow" class="col-sm-3 d-none">
                                    <label class="text-light" for="editDate">Date</label>
                                    <input type="text" name="editDate" class="form-control currentDate bg-white text-dark mb-3" id="editDate"/>
                                </div>

                                <div id="editCurrentDate" class="col-sm-3 d-none">
                                    <label class="text-light" for="taxColEditcurrentDate">Date</label>
                                    <input type="text" name="taxColEditcurrentDate" class="form-control currentDate bg-white text-dark mb-3" id="taxColEditcurrentDate"/>
                                </div>

                                <div class="col-sm-2">
                                    <label class="text-light" for="taxColClientType">Client Type</label>
                                    <select class="form-control bg-white text-dark" name="taxColClientType"
                                        id="taxColClientType">
                                        <option class="bg-white" value=""></option>
                                        @foreach ($displayCustType as $cust_items)
                                            <option class="bg-white" value="{{ $cust_items->id }}">
                                                {{ $cust_items->description_type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <label class="text-light" for="taxColReceiptType">Receipt Type</label>
                                    <input id="taxColReceiptType" type="text" name="taxColReceiptType" class="form-control bg-white text-dark mb-3"/>
                                    {{-- <select class="form-control bg-white text-dark" name="taxColReceiptType" id="taxColReceiptType">
                                        <option class="bg-white" value=""></option>
                                        <option class="bg-white" value="Land Tax Collection">Land Tax Collection</option>
                                        <option class="bg-white" value="Field Land Tax Collection">Field Land Tax Collection</option>
                                    </select> --}}
                                </div>

                                <div class="col-sm-3 d-none">
                                    <label class="text-light" for="taxColIP">User IP</label>
                                    @foreach ($displayTaxID as $tax_item)

                                    @endforeach
                                    <input type="text" name="taxColIP" class="form-control mb-0 bg-white text-dark"
                                        id="taxColIP" value="{{ $tax_item->id }}">
                                </div>

                                <div id="seriesInput" class="col-sm-2">
                                    <label class="text-light" for="taxColSeries">Series &emsp;<span id="series-counter" class="d-none"></span></label>
                                    <select readonly class="form-control text-dark" name="taxColSeries" id="taxColSeries">
                                        
                                    </select>
                                </div>

                                <div id="serialInput" class="col-sm-2">
                                    <label class="text-light" for="serialNumber">Serial Number</label>
                                    <input class="form-control bg-white text-dark" name="serialNumber" id="serialNumber">
                                </div>

                                <div class="col-sm-2 d-none">
                                    <label class="text-light" for="printStatus">Status</label>
                                    <input readonly type="text" name="printStatus"
                                        class="bg-light form-control mb-0 text-dark" id="printStatus" value="Not Printed">
                                </div>

                                <div class="col-sm-3">
                                    <label class="text-light" for="taxColRole">Income Type</label>
                                    <select class="form-control bg-white text-dark" name="taxColRole" id="taxColRole">
                                        <option class="bg-white" value="0">Current</option>
                                        <option class="bg-white" value="1">Deffered</option>
                                    </select>
                                </div>
                            </div>

                            <hr id="client-type-separator" class="bg-white">

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
                                    <label class="text-light indiv" for="taxColFirstName">First Name</label>
                                    <input type="text" name="taxColFirstName" class="all-caps form-control mb-0 bg-white text-dark indiv"
                                        id="taxColFirstName">
                                </div>

                                <div class="col-sm-3">
                                    <label class="text-light indiv" for="taxColMI">M.I./Middle Name</label>
                                    <input type="text" name="taxColMI" class="form-control mb-0 bg-white text-dark indiv"
                                        id="taxColMI">
                                </div>

                                <div class="col-sm-3">
                                    <label class="text-light indiv" for="taxColLastName">Last Name</label>
                                    <input type="text" name="taxColLastName" class="form-control mb-0 bg-white text-dark indiv"
                                        id="taxColLastName">
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

                            <div id="client-type-spouse" class="row d-none">
                                <div class="col-sm-4">
                                    <label class="text-light" for="taxColSpouses">Spouses</label>
                                    <input type="text" name="taxColSpouses" class="form-control mb-0 bg-white text-dark"
                                        id="taxColSpouses">
                                </div>
                            </div>

                            <div id="client-type-company" class="row d-none">
                                <div class="col-sm-4">
                                    <label class="text-light" for="taxColCompany">Company</label>
                                    <input type="text" name="taxColCompany" class="form-control mb-0 bg-white text-dark"
                                        id="taxColCompany">
                                </div>
                            </div>

                            <div id="client-type-permittees" class="row d-none">
                                <div class="col-sm-4">
                                    <label class="text-light" for="taxColPermittee">Permittee</label>
                                    <input type="text" name="taxColPermittee" class="form-control mb-0 bg-white text-dark"
                                        id="taxColPermittee">
                                </div>

                                <div class="col-sm-3">
                                    <label class="text-light" for="taxColPermitteeTradeName">Trade Name</label>
                                    <input type="text" name="taxColPermitteeTradeName" class="form-control mb-0 bg-white text-dark"
                                        id="taxColPermitteeTradeName">
                                    <label class="text-danger">
                                </div>

                                <div class="col-md-4">
                                    <div class="withSpouse">
                                        <div class="col-sm-12 mt-4">
                                            <div class="checkbox">
                                                <label class="text-light" for="taxColPermitteeSharing">With Sharing</label>
                                                <input type="checkbox" name="taxColPermitteeSharing" id="taxColPermitteeSharing">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div id="clientFieldPermittees"></div>
                                </div>
                            </div>

                            <div id="client-type-permitFees" class="row d-none">
                                <div class="col-sm-5">
                                    <label class="text-light" for="taxColPermitFeesTradeName">Trade Name</label>
                                    <input type="text" name="taxColPermitFeesTradeName" class="form-control mb-0 bg-white text-dark"
                                        id="taxColPermitFeesTradeName">
                                </div>

                                <div class="col-sm-4">
                                    <label class="text-light" for="taxColProprietor">Proprietor</label>
                                    <input type="text" name="taxColProprietor" class="form-control mb-0 bg-white text-dark"
                                        id="taxColProprietor">
                                </div>
                            </div>

                            <div id="client-type-contractor" class="row d-none">
                                <div class="col-sm-4">
                                    <label class="text-light" for="taxColBusinessName">Business Name</label>
                                    <input type="text" name="taxColBusinessName" class="form-control mb-0 bg-white text-dark"
                                        id="taxColBusinessName">
                                </div>

                                <div class="col-sm-4">
                                    <label class="text-light" for="taxColOwner">Owner</label>
                                    <input type="text" name="taxColOwner" class="form-control mb-0 bg-white text-dark"
                                        id="taxColOwner">
                                </div>

                                <div class="col-sm-4">
                                    <label class="text-light" for="taxColAddress">Address</label>
                                    <input type="text" name="taxColAddress" class="form-control mb-0 bg-white text-dark"
                                        id="taxColAddress">
                                </div>
                            </div>

                            <div id="client-type-bidders" class="row d-none">
                                <div class="col-sm-5">
                                    <label class="text-light" for="taxColBiddersBusinessName">Bidders Business Name</label>
                                    <input type="text" name="taxColBiddersBusinessName" class="form-control mb-0 bg-white text-dark"
                                        id="taxColBiddersBusinessName">
                                </div>

                                <div class="col-sm-3">
                                    <label class="text-light" for="taxColBiddersOwner">Owner/Representative</label>
                                    <input type="text" name="taxColBiddersOwner" class="form-control mb-0 bg-white text-dark"
                                        id="taxColBiddersOwner">
                                </div>

                                <div class="col-sm-2">
                                    <div id="clientFieldBidders"></div>
                                </div>
                            </div>

                            <div id="client-type-rentals" class="row d-none">
                                <div class="col-sm-3 d-none">
                                    <input type="text" name="taxColRentalID" class="form-control mb-0 bg-white text-dark"
                                        id="taxColRentalID">
                                </div>

                                <div class="col-sm-3">
                                    <label class="text-light" for="taxColRentalName">Rental Name</label>
                                    <input type="text" name="taxColRentalName" class="form-control mb-0 bg-white text-dark"
                                        id="taxColRentalName">
                                </div>

                                <div class="col-sm-4">
                                    <label class="text-light" for="taxColRentalLocation">Location</label>
                                    <input type="text" name="taxColRentalLocation" class="form-control mb-0 bg-white text-dark"
                                        id="taxColRentalLocation">
                                </div>

                                <div class="col-sm-3">
                                    <label class="text-light" for="taxColRentalLease">Lease of Contact</label>
                                    <input type="text" name="taxColRentalLease" class="form-control mb-0 bg-white text-dark"
                                        id="taxColRentalLease">
                                </div>

                                <input type="text" name="taxColRentalAutoID" class="d-none form-control mb-0 bg-white text-dark"
                                        id="taxColRentalAutoID">

                                <div class="col-sm-2">
                                    <div id="clientField"></div>
                                </div>
                            </div>

                            <hr class="bg-white">

                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="text-light" for="taxColTransaction">Transaction Type</label>
                                    <select class="form-control bg-white text-dark" name="taxColTransaction"
                                        id="taxColTransaction">
                                        <option class="bg-white" value="null"></option>
                                        <option class="bg-white" selected value="Cash">Cash</option>
                                        <option class="bg-white" value="Check">Check</option>
                                        <option class="bg-white" value="Cash & Check">Cash & Check</option>
                                        <option class="bg-white" value="Money Order">Money Order</option>
                                        <option class="bg-white" value="ADA-LBP">ADA-LBP</option>
                                        <option class="bg-white" value="Bank Deposit/Transfer">Bank Deposit/Transfer/Bank Transfer/E-payment</option>
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
                                    <label class="text-light" for="taxColBankRemarks">Bank Remarks</label>
                                    <textarea id="taxColBankRemarks" name="taxColBankRemarks"></textarea>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <label class="text-light" for="taxColCert">With Certificate</label>
                                    <select class="form-control bg-white text-dark" name="taxColCert" id="taxColCert">
                                        <option class="bg-white" selected value="None">None</option>
                                        <option class="bg-white" value="Transfer Tax">Transfer Tax</option>
                                        <option class="bg-white" value="Sand & Gravel">Sand & Gravel</option>
                                        <option class="bg-white" value="Provincial Permit">Provincial Permit</option>
                                        <option class="bg-white" value="Sand & Gravel Certification">Sand & Gravel Certification</option>
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label class="text-light" for="taxColMunicipality">Municipality</label>
                                    <select readonly class="form-control bg-light text-dark" name="taxColMunicipality"
                                        id="taxColMunicipality">
                                        <option class="bg-white" value=""></option>
                                    </select>
                                </div>

                                <div id="taxColBarSelect" class="col-sm-3">
                                    <label class="text-light" for="taxColBarangay">Barangay</label>
                                    <select readonly class="form-control bg-light text-dark" name="taxColBarangay"
                                    id="taxColBarangay">
                                        <option class="bg-white" value=""></option>
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
                                                    <th class="bg-dark cashRow d-none">Cash</th>
                                                    <th class="bg-dark checkRow d-none">Check</th>
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
                                                    <td style="width: 32%">
                                                        <input type="text" name="taxColAccount[]"
                                                            class="taxColAccount form-control mb-0 bg-white text-dark">
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
                                                    <td style="width: 42%">
                                                        <input type="text" name="taxColNature[]"
                                                            class="taxColNature form-control mb-0 bg-white text-dark">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="taxColAmount[]"
                                                            class="taxColAmount form-control mb-0 bg-white text-dark">
                                                    </td>

                                                    <td class="cashRow d-none">
                                                        <input class="cashRowVal" name="cashRow[]" type="checkbox">
                                                    </td>

                                                    <td style="width: 8%" class="checkRow d-none">
                                                        <input id="mainCheck" class="checkRow checkRowVal" name="checkRow[]" type="checkbox">
                                                        <button type="button" class="btn-primary viewCheck checkBtn d-none">View</button>
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
                                                        <input readonly type="text" id="taxColTotal" name="taxColTotal"
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

                            <div id="delivery-receipts" class="d-none mt-5">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-3 d-none">
                                            <label for="serialSGID">ID</label>
                                            <input type="text" class="form-control" name="serialSGID" id="serialSGID">
                                            <label class="text-danger">
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="text-light" for="startSG">Start Serial</label>
                                            <input type="text" name="startSG" id="startSG" class="form-control mb-0 bg-white text-dark">
                                        </div>

                                        <div class="col-sm-2">
                                            <label class="text-light" for="bookletSG">Booklet</label>
                                            <select class="form-control text-dark bg-white" name="bookletSG" id="bookletSG">
                                                <option class="bg-white" value=""></option>
                                            </select>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="text-light" for="endSG">End Serial</label>
                                            <input type="text" name="endSG" id="endSG" class="form-control mb-0 bg-white text-dark">
                                        </div>
    
                                        <div class="col-sm-2">
                                            <label class="text-light" for="onDeckPiece">On Deck</label>
                                            <input readonly type="text" name="onDeckPiece" id="onDeckPiece" class="form-control mb-0 bg-light text-dark">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="remarks" class="row mt-5">
                                <div class="col-sm-12">
                                    <label class="text-light" for="taxColReceiptRemarks">Receipt Remarks</label>
                                    <textarea id="taxColReceiptRemarks" name="taxColReceiptRemarks"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3 d-none">
                                <input type="text" name="checkTransaction" id="checkTransaction" class="form-control mb-0 bg-white text-dark">
                            </div>

                            <div class="col-sm-12 mt-3 d-none">
                                <input type="text" name="submitType" id="submitType" class="form-control mb-0 bg-white text-dark" value="Revenue Collection">
                            </div>
                        </div>
                        <button type="button" id="setNewData" class="float-right btn btn-primary">Save</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="closeBtn btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="" target="_blank" id="print-receipt" class="float-right btn btn-primary">Print Receipt</a>
                    </div>
                    {{-- @if (Session::has('errors'))
                        <script>
                            $(document).ready(function(){
                                $('#addTaxColModal').modal('show');
                            });
                        </script>
                    @endif --}}
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
                            <div class="col-sm-2 d-none">
                                <label class="text-light" for="printCertID">Print ID</label>
                                <input readonly type="text" name="printCertID" class="bg-light form-control mb-0 text-dark"
                                    id="printCertID">
                            </div>
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
                                <label class="text-danger">
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
                                    <option class="bg-white" value="Sand & Gravel Certification">Sand & Gravel
                                    Certification
                                    </option>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label class="text-light" for="certDate">Date</label>
                                <input type="text" name="certDate" class="bg-light datepicker-cert form-control mb-0 bg-white text-dark" id="certDate">
                            </div>

                            <div id="preparedby" class="col-sm-3">
                                <label class="text-light" for="certPreparedBy">PREPARED BY:</label>
                                <select class="form-control bg-white text-dark" name="certPreparedBy" id="certPreparedBy">
                                    <option class="bg-white" selected value="3">MARY JANE P. LAMPACAN - Local Revenue Collection Officer IV</option>
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
                                <textarea id="certDetails" class="tinymce" name="certDetails"></textarea>
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
                            {{-- <div class="col-sm-3">
                                <label class="text-light" for="sgProcessed">Less: Sand and Gravel (processed)</label>
                                <input type="text" name="sgProcessed" class="bg-white form-control mb-0 text-dark"
                                    id="sgProcessed" value="0">
                            </div> --}}

                            <div class="col-sm-3">
                                <label class="text-light" for="sgCrushedSand">Less: Crushed Sand</label>
                                <input type="text" name="sgCrushedSand" class="bg-white form-control mb-0 text-dark"
                                    id="sgCrushedSand" value="0">
                            </div>

                            <div class="col-sm-2">
                                <label class="text-light" for="sgCrushedGravel">Less: Crushed Gravel</label>
                                <input type="text" name="sgCrushedGravel" class="bg-white form-control mb-0 text-dark"
                                    id="sgCrushedGravel" value="0">
                            </div>

                            <div class="col-sm-2">
                                <label class="text-light" for="aggBaseCourse">Less: Aggregate Base Course</label>
                                <input type="text" name="aggBaseCourse" class="bg-white form-control mb-0 text-dark"
                                    id="aggBaseCourse" value="0">
                            </div>


                            <div class="col-sm-2">
                                <label class="text-light" for="lessSandAndGravel">Less: Sand and Gravel</label>
                                <input type="text" name="lessSandAndGravel" class="bg-white form-control mb-0 text-dark"
                                    id="lessSandAndGravel" value="0">
                            </div>

                            <div class="col-sm-3">
                                <label class="text-light" for="lessBoulders">Less: Boulders</label>
                                <input type="text" name="lessBoulders" class="bg-white form-control mb-0 text-dark"
                                    id="lessBoulders" value="0">
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

                            <div class="col-sm-4 d-none">
                                <label class="text-light" for="amountHolder">Amount Holder</label>
                                <input type="text" name="amountHolder" class="bg-white form-control mb-0 text-dark"
                                    id="amountHolder">
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
                                    class="form-control mb-0 bg-white text-dark ui-autocomplete">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="text-light" for="schedVolume">Quantity</label>
                                <input type="text" id="schedVolume" name="schedVolume"
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
    <!-- END OF SCHEDULES MODAL -->

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Revenue Collection</h1> 
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="button" id="landTaxColBtn" class="btn btn-primary">Land Tax</button>
                        </div>

                        <div class="col-sm-2">
                            <button type="button" id="fieldTaxColBtn" class="btn btn-primary">Field Tax</button>
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
                                <button type="button" rel="tooltip" class="float-left edit btn btn-light btn-sm btn-round btn-icon">
                                    <i class="tim-icons icon-molecule-40"></i>
                                </button>
                                <h4 class="float-left mt-2 ml-1">Certificates&emsp;</h4>
                                <button type="button" rel="tooltip" style="background:#d47720" class="float-left edit btn btn-sm btn-round btn-icon">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                                <h4 class="float-left mt-2 ml-1">Cancel&emsp;</h4>
                                <button type="button" rel="tooltip" style="background: #0e9c09" class="float-left edit btn btn-info btn-sm btn-round btn-icon">
                                    <i class="tim-icons icon-simple-add"></i>
                                </button>
                                <h4 class="float-left mt-2 ml-2 mr-2">Additional Receipt</h4>
                                <button type="button" rel="tooltip" style="background: #e0c151" class="float-left edit btn btn-info btn-sm btn-round btn-icon">
                                    <i class="tim-icons icon-paper"></i>
                                </button>
                                <h4 class="float-left mt-2 ml-1">View Receipt</h4>
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
                                    <table class="table tablesorter " id="land-tax-table">
                                        <thead class=" text-primary bg-dark">
                                            <tr>
                                                <th class="bg-dark">Action</th>
                                                <th class="bg-dark">User</th>
                                                <th class="bg-dark">Station IP</th>
                                                <th class="bg-dark">Receipt Type</th>
                                                <th class="bg-dark">Serial</th>
                                                <th class="bg-dark">Serial Number</th>
                                                <th class="bg-dark">Date Report</th>
                                                <th class="bg-dark">Customer/Payor</th>
                                                <th class="bg-dark">Transaction Type</th>
                                                <th class="bg-dark">Certificate</th>
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

    <script>
        var idleTime = 0;
        $(document).ready(function () {
            // Increment the idle time counter every minute.
            var idleInterval = setInterval(timerIncrement, 60000); // 1 minute
            // Zero the idle timer on mouse movement.
            $(this).mousemove(function (e) {
                idleTime = 0;
            });
            $(this).keypress(function (e) {
                idleTime = 0;
            });
        });

        function timerIncrement() {
            idleTime = idleTime + 1;
            if (idleTime > 20) { // 7 minutes
                window.location.reload();
            }
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
            time_24hr: true,
            dateFormat: 'm/d/Y H:i',
            defaultDate: new Date(),
        });

        tinymce.init({
            selector: '#taxColBankRemarks',
            forced_root_block : 'div'
        });

        tinymce.init({
            selector: '#taxColReceiptRemarks',
            forced_root_block : 'div',
        });

        tinymce.init({
            selector: '#certDetails',
            toolbar: 'undo redo | styleselect | forecolor | bold underline italic | alignleft aligncenter alignright alignjustify | fontsizeselect | outdent indent | link image | code',
            fontsize_formats: '14pt',
            content_style: `
                html, body {
                    height: 100%;
                    font-weight: bold;
                }

                html {
                    display: table;
                    margin: auto;
                }

                body {
                    display: table-cell;
                    vertical-align: middle;
                }
	        `,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
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
            $('#client-type-company').addClass('d-none');
            $('#spousesRadio').val('Spouse');
            $('#taxColSpouses').val('');
        });

        $('#companyRadio').on('click', function() {
            $('.indiv').addClass('d-none');
            $('#client-type-spouse').addClass('d-none');
            $('#client-type-company').removeClass('d-none');
            $('#companyRadio').val('Company');
            $('#taxColCompany').val('');
        });
        
        $('#landTaxColBtn').on('click', function() {
            function getDateTime() {
                var today = new Date();
                var date = (today.getMonth()+1)+'/'+today.getDate()+'/'+today.getFullYear();
                var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                $('#taxColcurrentDate').val(date+' '+time);
            }

            // Increment the idle time counter every minute.
            var idleInterval = setInterval(timerIncrement, 60000); // 1 minute
            // Zero the idle timer on mouse movement.
            $(this).mousemove(function (e) {
                idleTime = 0;
            });
            $(this).keypress(function (e) {
                idleTime = 0;
            });

            $('#land_tax_form')[0].reset();
            $('.checkBtn, .cashRow, .checkRow').addClass('d-none');
            var interval = setInterval(getDateTime, 1000);
            let landSeriesText = "Land Tax Collection";
            $('#taxColReceiptType').val(landSeriesText);
            //$('#taxColcurrentDate').val(dateToday + ' ' + timeToday);
            $('.modal').css('overflow-y', 'auto');
            $('#addTaxColModal').modal('show');
            $('.edit-trigger').attr('readonly', true);
            $('.edit-trigger').removeClass('bg-white');
            $('.newRow').remove();
            $('#seriesInput').removeClass('d-none');
            $('#serialInput').addClass('d-none');
            $('#editDateRow').addClass('d-none');
            $('#client-type-separator').addClass('d-none');
            $('#client-type-individual').addClass('d-none');
            $('#client-type-contractor').addClass('d-none');
            $('#client-type-others').addClass('d-none');
            $('#client-type-spouse').addClass('d-none');
            $('#client-type-company').addClass('d-none');
            $('#client-type-permittees').addClass('d-none');
            $('#client-type-permitFees').addClass('d-none');
            $('#client-type-bidders').addClass('d-none');
            $('#client-type-rentals').addClass('d-none');
            $('#delivery-receipts').addClass('d-none');
            $('#taxColMunicipality').attr('readonly', true);
            $('#taxColMunicipality').removeClass('bg-white');
            $('#taxColMunicipality').val('');
            $('#taxColBarangay').attr('readonly', true);
            $('#taxColBarangay').removeClass('bg-white');
            $('#taxColBarangay').val('');
            $('#addTaxColModalTitle').html('Revenue Collection');
            $('#currentDate').removeClass('d-none');
            $('#editCurrentDate').addClass('d-none');

            $.ajax({
                method: "POST",
                url: "{{ route('getSeries') }}",
                async: false,
                data: {
                    id: landSeriesText,
                }
            }).done(function(data) {
                let series = data[0];
                let currentSerial = data[1];
                let previousSerial = data[2];
                $('#taxColSeries').html('');
                let html = '';
                series.forEach(element => {
                    html += '<option class="bg-white" value="' + element.id + '"';
                    if (element.Serial.includes(previousSerial.start_serial) && element.unit == 'Pad') {
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
            });
            if ($(this).val() == 'Field Land Tax Collection') {
                $('#serialInput').removeClass('d-none');
            } else {
                $('#serialInput').removeClass('d-none');
                $('#serialInput').addClass('d-none');
            }
            $('#series-counter').removeClass('d-none');

            $('.closeBtn').on('click', function() {
                clearInterval(interval);
            });
        });

        $('#fieldTaxColBtn').click(function() {
            function getDateTime() {
                var today = new Date();
                var date = (today.getMonth()+1)+'/'+today.getDate()+'/'+today.getFullYear();
                var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                $('#taxColcurrentDate').val(date+' '+time);
            }

            // Increment the idle time counter every minute.
            var idleInterval = setInterval(timerIncrement, 60000); // 1 minute
            // Zero the idle timer on mouse movement.
            $(this).mousemove(function (e) {
                idleTime = 0;
            });
            $(this).keypress(function (e) {
                idleTime = 0;
            });

            $('#land_tax_form')[0].reset();
            $('.checkBtn, .cashRow, .checkRow').addClass('d-none');
            var interval = setInterval(getDateTime, 1000);
            let fieldSeriesText = "Field Land Tax Collection";
            $('#taxColReceiptType').val(fieldSeriesText);
            $('.modal').css('overflow-y', 'auto');
            $('#addTaxColModal').modal('show');
            $('.edit-trigger').attr('readonly', true);
            $('.edit-trigger').removeClass('bg-white');
            $('.newRow').remove();
            $('#seriesInput').removeClass('d-none');
            $('#serialInput').addClass('d-none');
            $('#editDateRow').addClass('d-none');
            $('#client-type-separator').addClass('d-none');
            $('#client-type-individual').addClass('d-none');
            $('#client-type-contractor').addClass('d-none');
            $('#client-type-others').addClass('d-none');
            $('#client-type-spouse').addClass('d-none');
            $('#client-type-company').addClass('d-none');
            $('#client-type-permittees').addClass('d-none');
            $('#client-type-permitFees').addClass('d-none');
            $('#client-type-bidders').addClass('d-none');
            $('#client-type-rentals').addClass('d-none');
            $('#delivery-receipts').addClass('d-none');
            $('#taxColMunicipality').attr('readonly', true);
            $('#taxColMunicipality').removeClass('bg-white');
            $('#taxColMunicipality').val('');
            $('#taxColBarangay').attr('readonly', true);
            $('#taxColBarangay').removeClass('bg-white');
            $('#taxColBarangay').val('');
            $('#addTaxColModalTitle').html('Revenue Collection');
            $('#currentDate').removeClass('d-none');
            $('#editCurrentDate').addClass('d-none');
            
            $.ajax({
                method: "POST",
                url: "{{ route('getSeries') }}",
                async: false,
                data: {
                    id: fieldSeriesText,
                }
            }).done(function(data) {
                let series = data[0];
                let currentSerial = data[1];
                let previousSerial = data[2];
                $('#taxColSeries').html('');
                let html = '';
                series.forEach(element => {
                    html += '<option class="bg-white" value="' + element.id + '"';
                    if (element.Serial.includes(previousSerial.start_serial) && element.unit == 'Pad') {
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
            });

            if ($(this).val() == 'Field Land Tax Collection') {
                $('#serialInput').removeClass('d-none');
            } else {
                $('#serialInput').removeClass('d-none');
                $('#serialInput').addClass('d-none');
            }
            $('#series-counter').removeClass('d-none');

            $('.closeBtn').on('click', function() {
                clearInterval(interval);
            });
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
            let radioVal = $('input[name="clientTypeRadio"]:checked').val();
            table = $('#land-tax-table').DataTable({
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
                    url:'{{route("getReceiptData")}}',
                    type: 'POST',
                    dataType: "json",
                    dataSrc: function ( json ) {
                    return json.data;
                    },
                    headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                //data: data,
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'excel', 'pdf'
                // ],
                autoWidth: false,
                columns: [{
                        'data': 'main_id',
                        render: function(data, type, row) {
                            if (row.certificate == 'None') {
                                if (row.status == 'Cancelled') {
                                    return '<button type="button" rel="tooltip" class="restore-btn btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-refresh-01"></i></button>';
                                } else {
                                    return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button style="background:#d47720" type="button" rel="tooltip" class="cancel-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-remove"></i></button><button type="button" rel="tooltip" style="background: #0e9c09;" class="additional-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-add"></i></button><a href="" target="_blank" style="background: #e0c151;" class="receipt-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-paper"></i></a>';
                                }
                            } else {
                                if (row.status == 'Cancelled') {
                                    return '<button type="button" rel="tooltip" class="restore-btn btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-refresh-01"></i></button>';
                                } else {
                                    return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button type="button" rel="tooltip" class="certificate-btn btn btn-light btn-sm btn-round btn-icon"><i class="tim-icons icon-molecule-40"></i></button><button type="button" style="background:#d47720" rel="tooltip" class="cancel-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-remove"></i></button><button type="button" rel="tooltip" style="background: #0e9c09;" class="additional-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-add"></i></button><a href="" target="_blank" rel="tooltip" style="background: #e0c151;" class="receipt-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-paper"></i></a>';
                                }
                            }
                        }
                    },
                    {
                        'data': 'pc_name'
                    },
                    {
                        'data': 'assigned_ip',
                        render: function(data, type, row) {
                            if (row.receipt_type == 'Land Tax Collection') {
                                return row.assigned_ip;
                            } else {
                                return "{{ $ip }}";
                            }
                        }
                    },
                    {
                        'data': 'receipt_type'
                    },
                    {
                        'data': 'start_serial'
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
                            if(row.client_types == 'Individual/Company' || row.client_types == 'Monitoring') {
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
                            } else if (row.client_types == "Provincial Projects (Prov'l Contractors)" || row.client_types == 'Extraction of Sand, Gravel, and Other Quarrying Materials (Sand and Gravel Permittees)' || row.client_types == 'National Projects (DWPH-CAR/National Projects)') {
                                if (row.business_name == null) {
                                    return row.owner;
                                } else if (row.owner == null) {
                                    return row.business_name;
                                } else {
                                    return row.business_name + ' By: ' +  row.owner;
                                }
                            } else if (row.client_types == 'Municipal Remittance') {
                                return 'Municipal Government of ' + row.mun_name;
                            } else if (row.client_types == 'Lot Rental') {
                                return row.name;
                            } else if (row.client_types == 'Industrial' || row.client_types == 'Commercial') {
                                if (row.trade_name_permittees == null) {
                                    return row.permittee;
                                } else if (row.permittee == null) {
                                    return row.trade_name_permittees;
                                } else {
                                    return row.trade_name_permittees + ' By: ' + row.permittee
                                }
                            } else if (row.client_types == 'Printing & Publication' || row.client_types == 'Franchise Tax') {
                                if (row.trade_name_permit_fees == null) {
                                    return row.proprietor;
                                } else if (row.proprietor == null) {
                                    return row.trade_name_permit_fees;
                                } else {
                                    return row.trade_name_permit_fees + ' By: ' + row.proprietor;
                                }
                            } else if (row.client_types == 'Brgy. Remittance') {
                                return row.bar_name + ', ' + row.mun_name;
                            }  else if (row.client_types == 'Bidders' || row.client_types == 'Supplier of Drugs & Meds') {
                                if (row.bidders_business_name == null) {
                                    return row.owner_representative;
                                } else if (row.owner_representative == null) {
                                    return row.bidders_business_name;
                                } else {
                                    return row.bidders_business_name + ' By: ' + row.owner_representative;
                                }
                            } else {
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
                            
                        }
                    },
                    {
                        'data': 'transact_type'
                    },
                    {
                        'data': 'certificate'
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
                            if (row.status == 'Not Printed') {
                                return '<p style="color:red; font-weight:600">Not Printed</p>'
                            } else if (row.status == 'Cancelled') {
                                $(row).addClass('row-disabled');
                                return '<p style="color:orange; font-weight:600">Cancelled</p>'
                            } else {
                                return '<p style="color:green; font-weight:600">Printed</p>'
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
                        'data': 'last_name'
                    },
                    {
                        'data': 'first_name'
                    },
                    {
                        'data': 'middle_initial'
                    },
                    {
                        'data': 'business_name'
                    },
                    {
                        'data': 'client_types'
                    },
                    {
                        'data': 'sex'
                    },
                    {
                        'data': 'transact_type'
                    },
                    {
                        'data': 'bank_name'
                    },
                    {
                        'data': 'number'
                    },
                    {
                        'data': 'transact_date'
                    },
                    {
                        'data': 'bank_remarks'
                    },
                    {
                        'data': 'receipt_remarks'
                    },
                    {
                        'data': 'owner'
                    },
                    {
                        'data': 'spouses'
                    },
                    {
                        'data': 'company'
                    },
                    {
                        'data': 'client_type_radio'
                    },
                    {
                        'data': 'report_date'
                    },
                    {
                        'data': 'status'
                    },
                    {
                        'data': 'municipality_id'
                    },
                    {
                        'data': 'barangay_id'
                    },
                    {
                        'data': 'series_id'
                    },
                    {
                        'data': 'receipt_type'
                    },
                    {
                        'data': 'trade_name_permittees'
                    },
                    {
                        'data': 'permittee'
                    },
                    {
                        'data': 'trade_name_permit_fees'
                    },
                    {
                        'data': 'proprietor'
                    },
                    {
                        'data': 'bidders_business_name'
                    },
                    {
                        'data': 'owner_representative'
                    },
                    {
                        'data': 'order'
                    },
                ],
                    "columnDefs": [{
                        "targets": [4, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42],
                        "visible": false,
                    }], 
                "order": [ 42, "desc" ]
            });
            
            $('#land-tax-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                // var data1 = table.cells(idx, '').render('display');
                var originalData = table.cells(idx, '').data();
                var data = table.row( $(this).parents('tr') ).data();
                $('.modal').css('overflow-y', 'auto');
                $('#addTaxColModal').modal('show');
                // $('#taxColEditcurrentDate').val(data.report_date);
                $('#taxColID').val(originalData[0]);
                $('#print-receipt').prop('href', 'printReceipt/' + originalData[0]);
                $('#taxColReceiptType').val(data.receipt_type);
                if (data.date_edited == "1970-01-01 08:00:00" || data.date_edited == null) {
                    $('#editDate').val(moment(data.created_at, 'YYYY-MM-DD H:mm').format('MM/DD/YYYY H:mm'));
                } else {
                    $('#editDate').val(moment(data.date_edited, 'YYYY-MM-DD H:mm').format('MM/DD/YYYY H:mm'));
                }
                $('#taxColReceiptType').attr('readonly', true);
                $('#serialNumber').attr('readonly', true);
                if (data.role == 2) {
                    $('#seriesInput').removeClass('d-none');
                    $.ajax({
                        method: "POST",
                        url: "{{ route('getSeries') }}",
                        async: false,
                        data: {
                            id: "Field Land Tax Collection",
                        }
                    }).done(function(data) {
                        let series = data[0];
                        let currentSerial = data[1];
                        let previousSerial = data[2];
                        $('#taxColSeries').html('');
                        let html = '';
                        series.forEach(element => {
                            html += '<option class="bg-white" value="' + element.id + '"';
                            if (element.Serial.includes(previousSerial.start_serial) && element.unit == 'Pad') {
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
                    });
                } else {
                    $('#seriesInput').addClass('d-none');
                }
                //$('#taxColReceiptType').trigger('change');
                $('#taxColSeries').val(data.series_id);
                $('#serialInput').removeClass('d-none');
                if (data.client_type_radio == 'Individual') {
                    $('#individualRadio').trigger('click');
                    $('#individualRadio').val(data.client_type_radio);
                    $('#taxColLastName').val(data.last_name);
                    $('#taxColFirstName').val(data.first_name);
                    $('#taxColMI').val(data.middle_initial);
                    $('#taxColSex').val(data.sex);
                } else if (data.client_type_radio == 'Spouse') {
                    $('#spousesRadio').trigger('click');
                    $('#spousesRadio').val(data.client_type_radio);
                    $('#taxColSpouses').val(data.spouses);
                } else if (data.client_type_radio == 'Company') {
                    $('#companyRadio').trigger('click');
                    $('#client-type-individual').addClass('d-none');
                    $('#client-type-spouse').addClass('d-none');
                    $('#client-type-company').removeClass('d-none');
                    $('#companyRadio').val(data.client_type_radio);
                    $('#taxColCompany').val(data.company);
                }
                $('#serialNumber').val(data.serial_number);
                $('#taxColBusinessName').val(data.business_name);
                $('#taxColOwner').val(data.owner);
                $('#taxColAddress').val(data.address);
                $('#taxColPermitteeTradeName').val(data.trade_name_permittees);
                $('#taxColPermittee').val(data.permittee);
                $('#taxColPermitFeesTradeName').val(data.trade_name_permit_fees);
                $('#taxColProprietor').val(data.proprietor);
                $('#taxColBiddersBusinessName').val(data.bidders_business_name);
                $('#taxColBiddersOwner').val(data.owner_representative);
                $('#taxColRentalName').val(data.name);
                $('#taxColRentalLocation').val(data.location);
                $('#taxColRentalLease').val(data.lease_of_contact);
                $('#taxColRentalAutoID').val(data.lot_rental_id);
                $('#taxColClientType').val(data.client_type_id);
                $('#taxColClientType').trigger('change');
                if (data.municipality_id != null) {
                    $('#taxColMunicipality').val(data.municipality_id);
                    $('#taxColMunicipality').trigger('change');
                    $('#taxColBarangay').val(data.barangay_id);
                    $('#taxColBarangay').trigger('change');
                } else {
                    $('#taxColMunicipality').val('');
                    $('#taxColBarangay').val('');
                }

                if (data.transact_type == 'Cash & Check') {
                    $('.cashRow, .checkRow').removeClass('d-none');
                } else {
                    $('.cashRow, .checkRow').addClass('d-none');
                }
                $('#taxColTransaction').val(data.transact_type);
                $('#taxColBank').val(data.bank_name);
                $('#taxColNumber').val(data.number);
                $('#taxColTransactDate').val(data.transact_date);
                $('#taxColCert').val(data.certificate);
                $('#taxColRole').val(data.role);
                if ($('#taxColClientType').val() == 6 || $('#taxColClientType').val() == 7) {
                    $('#bookletSG').html('<option class="bg-white" value=""></option>');
                    if ($('#taxColClientType').val() == 6) {
                        for (let i=1; i<=10; i++) {
                        $('#bookletSG').html($('#bookletSG').html() +
                                '<option class="bg-white" value="' + i + '">' + i + '</option>');
                        }
                    } else if ($('#taxColClientType').val() == 7) {
                        for (let i=1; i<=5; i++) {
                        $('#bookletSG').html($('#bookletSG').html() +
                                '<option class="bg-white" value="' + i + '">' + i + '</option>');
                        }
                    }

                    $('#startSG').val(data.start_serial_sg);
                    $('#delivery-receipts').removeClass('d-none');
                    $('#bookletSG').val(data.booklets);
                    $('#endSG').val(data.end_serial_sg);
                    $('#onDeckPiece').val(data.start_serial_sg);
                }
                if (data.status == 'Printed') {
                    $('#printStatus').val('Printed');
                } else {
                    $('#printStatus').val('Not Printed');
                }

                if (data.sharing_status == 'on') {
                    $('#taxColPermitteeSharing').prop('checked', true);
                } else {
                    $('#taxColPermitteeSharing').prop('checked', false);
                }
                
                $('#setNewData').html('Update');
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
                let cashRowVal = $('.cashRowVal')[0];
                let checkRowVal = $('.checkRowVal')[0];
                $(taxColAcc).val('');
                $(taxColNature).val('');
                $(taxColQuantity).val('');
                $(taxColAmount).val('');
                $(taxColTypeRate).val('');
                $(cashRowVal).val('');
                $(checkRowVal).val('');

                $('#taxColTotal').val('');
    
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
                        let taxColAcc = $('.taxColAccount')[0];
                        let taxColNature = $('.taxColNature')[0];
                        let taxColQuantity = $('.taxColQuantity')[0];
                        let taxColAmount = $('.taxColAmount')[0];
                        let taxColTypeRate = $('.taxColTypeRate')[0];
                        let cashRowVal = $('.cashRowVal')[0];
                        let checkRowVal = $('.checkRowVal')[0];
                        $(taxColAcc).val(data[0].account);
                        $(taxColNature).val(data[0].nature);
                        $(taxColQuantity).val(data[0].quantity);
                        $(taxColAmount).val(data[0].amount);
                        $(taxColTypeRate).val(data[0].rate_type);
                        $(cashRowVal).val(data[0].transact_type);
                        $(checkRowVal).val(data[0].transact_type);

                        if (data[0].transact_type == 'Cash') {
                            $('.cashRowVal').prop('checked', true);
                            $('.checkRowVal').prop("checked", false);
                        } else if (data[0].transact_type == 'Check') {
                            $('.cashRowVal').prop('checked', false);
                            $('.checkRowVal').prop("checked", true);
                            $('.checkBtn').removeClass('d-none');
                        }

                        let total = parseFloat(data[0].amount);
                        for (let i = 1; i <= rowCount; i++) {
                            $('#addRowAccount').trigger('click');
                            taxColAcc = $('.taxColAccount')[i];
                            taxColNature = $('.taxColNature')[i];
                            taxColQuantity = $('.taxColQuantity')[i];
                            taxColAmount = $('.taxColAmount')[i];
                            taxColTypeRate = $('.taxColTypeRate')[i];
                            cashRowVal = $('.cashRowVal')[i];
                            checkRowVal = $('.checkRowVal')[i];
                            total = parseFloat(data[i].amount) + total;
                            $(taxColAcc).val(data[i].account);
                            $(taxColNature).val(data[i].nature);
                            $(taxColQuantity).val(data[i].quantity);
                            $(taxColAmount).val(data[i].amount);
                            $(taxColTypeRate).val(data[i].rate_type);
                            $(cashRowVal).val(data[i].transact_type);
                            $(checkRowVal).val(data[i].transact_type);
                            if (data[i].transact_type == 'Cash') {
                                $('.cashRowVal'+[i]).prop('checked', true);
                                $('.checkRowVal'+[i]).prop("checked", false);
                            } else if (data[i].transact_type == 'Check') {
                                $('.cashRowVal'+[i]).prop('checked', false);
                                $('.checkRowVal'+[i]).prop("checked", true);
                                $('.viewCheck'+[i]).removeClass('d-none');
                            }
                        }
                        $('#taxColTotal').val(parseFloat(total).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }
                    $('.taxColAmount').trigger('keyup');
                    $('#taxColTotal').trigger('change');
                });
                $('#addTaxColModalTitle').html('Edit Receipt Data');
                $('#currentDate').addClass('d-none');
                $('#editDateRow').removeClass('d-none');
                if (data.bank_remarks != null) {
                    tinymce.get("taxColBankRemarks").setContent(data.bank_remarks);
                } else {
                    tinymce.get("taxColBankRemarks").setContent('');
                }

                if (data.receipt_remarks != null) {
                    tinymce.get("taxColReceiptRemarks").setContent(data.receipt_remarks);
                } else {
                    tinymce.get("taxColReceiptRemarks").setContent('');
                }

                if ($('#taxColClientType').val() == 6 || $('#taxColClientType').val() == 7) {
                    $('#delivery-receipts').removeClass('d-none');
                }
            });

            $('#land-tax-table tbody').on('click', '.delete-btn-cl', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').data('display');
                Swal.fire({
                    title: 'Do you want to delete this Title?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#taxColID').val(data[0]);
                        $('#land_tax_form').attr('action', '{{ route('land_tax_form_del') }}');
                        $('#land_tax_form').submit();
                    }
                });
            });
            
            $('#land-tax-table tbody').on('click', '.certificate-btn', function (e) {
                var idx = table.row($(this).parents('tr'));
                // var data1 = table.cells(idx, '').render('display');
                var originalData = table.cells(idx, '').data();
                var data = table.row( $(this).parents('tr') ).data();
                let feeCharge = $('.provFeeCharge')[0];
                let permitAmount = $('.provAmount')[0];
                let orNumber = $('.provORNumber')[0];
                let permitDate = $('.provDate')[0];
                let permitInitials = $('.provInitials')[0];
                $(feeCharge).val('');
                $(permitAmount).val('');
                $(orNumber).val('');
                $(permitDate).val('');
                $(permitInitials).val('');
                $('#certID').val(originalData[0]);
                $('.newRow').remove();
                $.ajax({
                    method: "POST",
                    url: "{{ route('getCertificateDetails') }}",
                    // async: false,
                    data: {
                        id: originalData[0]
                    }
                }).done(function(certData) {
                    if ( certData[0] == null) {
                        $('#certificateModal').modal('show');
                    } else {
                        $('#print-cert-btn').prop('href', 'getWordTemplate/' + certData[0].land_tax_info_id);
                        $('#certPreparedBy').val(certData[0].cert_prepared_by);
                        $('#certSignee').val(certData[0].cert_signee);
                        $('#secondSignee').val(certData[0].second_signee);
                        $('#provGovernor').val(certData[0].prov_governor);
                        $('#certAddress').val(certData[0].cert_address);
                        $('#certEntriesFrom').val(certData[0].cert_entries_from);
                        $('#certEntriesTo').val(certData[0].cert_entries_to);
                        $('#ptrNumber').val(certData[0].ptr_number);
                        $('#docNumber').val(certData[0].doc_number);
                        $('#pageNumber').val(certData[0].page_number);
                        $('#bookNumber').val(certData[0].book_number);
                        $('#certSeries').val(certData[0].cert_series);
                        $('#refNumber').val(certData[0].ref_num);
                        $('#sgProcessed').val(certData[0].sg_processed);
                        $('#aggBaseCourse').val(certData[0].agg_basecourse);
                        $('#lessSandAndGravel').val(certData[0].less_sandandgravel);
                        $('#lessBoulders').val(certData[0].less_boulders);
                        $('#provCertClearance').val(certData[0].prov_certclearance);
                        $('#provCertType').val(certData[0].prov_certtype);
                        $('#provCertBidding').val(certData[0].prov_certbidding);

                        if (certData[0].cert_details != null) {
                            tinymce.get("certDetails").setContent(certData[0].cert_details);
                        } else {
                            tinymce.get("certDetails").setContent(data.receipt_remarks);
                        }

                        if (certData[0].notary_public != null) {
                            tinymce.get("notaryPublic").setContent(certData[0].notary_public);
                        } else {
                            tinymce.get("notaryPublic").setContent('');
                        }

                        let rowCount = certData.length - 1;
                        if (certData.length > 0) {
                            let feeCharge = $('.provFeeCharge')[0];
                            let permitAmount = $('.provAmount')[0];
                            let orNumber = $('.provORNumber')[0];
                            let permitDate = $('.provDate')[0];
                            let permitInitials = $('.provInitials')[0];
                            
                            $(feeCharge).val(certData[0].prov_feecharge);
                            $(permitAmount).val(certData[0].prov_amount);
                            $(orNumber).val(certData[0].prov_ornumber);
                            $(permitDate).val(certData[0].prov_date);
                            $(permitInitials).val(certData[0].prov_initials);
                            for (let i = 1; i <= rowCount; i++) {
                                $('#addRowPermit').trigger('click');
                                let feeCharge = $('.provFeeCharge')[i];
                                let permitAmount = $($('.provAmount')[i]).val();
                                let orNumber = $($('.provORNumber')[i]).val();
                                let permitDate = $($('.provDate')[i]).val();
                                let permitInitials = $($('.provInitials')[i]).val();
                                $(feeCharge).val(certData[i].prov_feecharge);
                                $(permitAmount).val(certData[i].prov_amount);
                                $(orNumber).val(certData[i].prov_ornumber);
                                $(permitDate).val(certData[i].prov_date);
                                $(permitInitials).val(certData[i].prov_initials);
                            }
                        }
                    }
                });

                $('#land_tax_info_id').val(originalData[0]);
                $('#certType').val(data.certificate);
                $('#certDate').val(moment().format('LL'));
                $('#certUser').val(data.pc_name);
                $('#certAFType').val(data.process_form);
                $('#certSerialNumber').val(data.serial_number);
                $('#certClientType').val(data.client_types);
                $('#certMunicipality').val(data.mun_name);
                $('#certBaqrangay').val(data.bar_name);
                if (data.receipt_remarks != null) {
                    tinymce.get("certDetails").setContent(data.receipt_remarks);
                } else {
                    tinymce.get("certDetails").setContent('');
                }
                if (data.client_types == "Provincial Projects (Prov'l Contractors)" || data.client_types == "National Projects (DWPH-CAR/National Projects)" || data.client_types == "Extraction of Sand, Gravel, and Other Quarrying Materials (Sand and Gravel Permittees)") {
                    $('#certReipient').val(data.business_name + ' By: ' + data.owner);
                } else if (data.client_types == 'Brgy. Remittance') {
                    $('#certReipient').val(data.municipality + ', ' + data.barangay_name);
                } else if (data.client_types == 'Municipal Remittance') {
                    $('#certReipient').val('Municipal Government of ' + data.municipality);
                } else if (data.client_types == 'Lot Rental') {
                    return data.name;
                }  else if (data.client_types == 'Industrial' || data.client_types == 'Commercial') {
                    if (data.trade_name_permittees != null && data.permittee != null) {
                        $('#certReipient').val(data.trade_name_permittees + ' By: ' + data.permittee);
                    } else if (data.trade_name_permittees != null && data.permittee == null) {
                        $('#certReipient').val(data.trade_name_permittees);
                    } else if (data.trade_name_permittees == null && data.permittee != null) {
                        $('#certReipient').val(data.permittee);
                    }
                } else if (data.client_types == 'Printing & Publication' || data.client_types == 'Franchise Tax') {
                    if (data.trade_name_permit_fees != null && data.proprietor != null) {
                        $('#certReipient').val(data.trade_name_permit_fees + ' By: ' + data.proprietor);
                    } else if (data.trade_name_permit_fees != null && data.proprietor == null) {
                        $('#certReipient').val(data.trade_name_permit_fees);
                    } else if (data.trade_name_permit_fees == null && data.proprietor != null) {
                        $('#certReipient').val(data.proprietor);
                    }
                } else if (data.client_types == 'Supplier of Drugs & Meds' || data.client_types == 'Bidders') {
                    if (data.bidders_business_name == null) {
                        $('#certReipient').val(data.owner_representative);
                    } else if (data.owner_representative == null) {
                        $('#certReipient').val(data.bidders_business_name);
                    } else {
                        $('#certReipient').val(data.bidders_business_name + ' By: ' + data.owner_representative);
                    }
                } else {
                    if (data.client_type_radio == 'Individual') {
                        if (data.middle_initial == null) {
                            $('#certReipient').val(data.first_name + ' ' + data.last_name);
                        } else {
                            $('#certReipient').val(data.first_name + ' ' + data.middle_initial + ' ' + data.last_name);
                        }
                    } else if (data.client_type_radio == 'Spouse') {
                        $('#certReipient').val(data.spouses);
                    } else if (data.client_type_radio == 'Company') {
                        $('#certReipient').val(data.company);
                    }
                }
                
                if (data.address != null) {
                    $('#certAddress').val(data.address);
                } else {
                    $('#certAddress').val();
                }

                var certTypeValue = $('#certType').val();
                var isProvincialPermit = certTypeValue == 'Provincial Permit';
                var isTransferTax = certTypeValue == 'Transfer Tax';
                var isSandAndGravel = certTypeValue == 'Sand & Gravel';
                var isSandAndGravelCert = certTypeValue == 'Sand & Gravel Certification';
                var isNull = certTypeValue == 'null';

                if (isProvincialPermit) {
                    $('#provincialPermit').removeClass('d-none');
                    $('#provPermitAdditional').removeClass('d-none');
                    $('#govdropdown').removeClass('d-none');
                    $('#certEntriesFrom, #certEntriesTo').removeClass('bg-white');
                    $('#sandAndGravel').addClass('d-none');
                    $('#transferTax').addClass('d-none');
                    $('#preparedby').addClass('d-none');
                } else if (isTransferTax) {
                    $('#transferTax').removeClass('d-none');
                    $('#preparedby, #signeename').removeClass('d-none');
                    $('#certAddress').removeClass('bg-white');
                    $('#certAddress').attr('readonly', true);
                    $('#certEntriesFrom, #certEntriesTo').removeClass('bg-white');
                    $('#sandAndGravel').addClass('d-none');
                    $('#provincialPermit').addClass('d-none');
                    $('#provPermitAdditional').addClass('d-none');
                    $('#govdropdown').addClass('d-none');
                } else if (isSandAndGravel || isSandAndGravelCert || isNull) {
                    $('#sandAndGravel').removeClass('d-none');
                    $('#govdropdown').addClass('d-none');
                    $('#preparedby').addClass('d-none');
                    $('#signeename').removeClass('d-none');
                    $('#certPreparedBy, #secondSignee').addClass('d-none');
                    $('#transferTax').addClass('d-none');
                    $('#provincialPermit').addClass('d-none');
                    $('#provPermitAdditional').addClass('d-none');
                    $('#govdropdown').addClass('d-none');
                }
                
                $('#certificateModal').modal('show');
            });
            
            $('#land-tax-table tbody').on('click', '.cancel-btn', function (e) {
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
                        type: "POST",
                        url: "{{ route('updateReceiptStatus') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                            "status": $('#printStatus').val()
                        },
                        'dataType': "json",
                        'success': function(data) {
                            
                        }
                        }).done(function(data){
                            $('#printStatus').val('Cancelled');
                        });

                        Swal.fire('Updating Receipt Status');
                        location.reload(true);
                    } else {
                        Swal.fire('Problem Occured');
                    }
                    
                });
            });
            
            $('#land-tax-table tbody').on('click', '.restore-btn', function (e) {
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
                        url: "{{ route('updateReceiptStatus') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0]
                        },
                        'dataType': "json",
                        'success': function(data) {
                            
                        }
                        }).done(function(data){
                            $('#printStatus').val('Printed');
                        });

                        Swal.fire('Updating Receipt Status');
                        location.reload(true);
                    } else {
                        Swal.fire('Problem Occured');
                    }
                });
            });

            $('#land-tax-table tbody').on('click', '.additional-btn', function (e) {
                $('#addTaxColModalTitle').html('Issue Another Receipt');
                $('#land_tax_form')[0].reset();
                $('.modal').css('overflow-y', 'auto');
                $('#addTaxColModal').modal('show');
                $('.edit-trigger').attr('readonly', true);
                $('.edit-trigger').removeClass('bg-white');
                $('.newRow').remove();
                $('#seriesInput').removeClass('d-none');
                $('#serialInput').addClass('d-none');
                $('#editDateRow').addClass('d-none');
                $('#client-type-separator').addClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $('#client-type-company').addClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#addTaxColModalTitle').html('Revenue Collection');
                $('#currentDate').removeClass('d-none');
                $('#editCurrentDate').addClass('d-none');
                $('#taxColReceiptType').trigger('change');
                $('#taxColMunicipality').attr('readonly', true);
                $('#taxColMunicipality').removeClass('bg-white');
                $('#taxColMunicipality').val('');
                $('#taxColBarangay').attr('readonly', true);
                $('#taxColBarangay').removeClass('bg-white');
                $('#taxColBarangay').val('');
            });

            $('#land-tax-table tbody').on('click', '.receipt-btn', function (e) {
                var data = table.row( $(this).parents('tr') ).data();
                let serialID = 0;
                $.ajax({
                    'url': '{{ route('openReceiptAction') }}',
                    'async': false,
                    'data': {
                        serialNumber: data.serial_number
                    },
                    'method': "post",
                    'dataType': "json",
                    'success': function(data) {
                        $('#printCertID').val(data);
                        serialID = data;
                    }
                });
                $('.receipt-btn').prop('href', 'printReceipt/' + serialID);
            });
        });

        $('#print-cert-btn').click(function() {
            $('#print-cert-btn').prop('href', 'getWordTemplate/' + $('#land_tax_info_id').val());
        });

        $('#taxColSeries').change(function () {
            $.ajax({
                method: "POST",
                url: "{{ route('getCurrentSerial') }}",
                async: false,
                data: {
                    id: $(this).val(),
                    taxColReceiptType: $('#taxColReceiptType').val()
                }
            }).done(function(data) {
                if (data == 'Serial Error') {
                    Swal.fire({
                        title: 'Please assign a new series',
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: 'Add',
                        icon: 'warning'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href='{{ route('pages.serial')  }}';
                            Swal.fire('Redirecting to Serials page');
                        }
                    });
                    $('#serialNumber').val('');
                    $('#series-counter').html('');
                } else {
                    $('#serialNumber').val(data);
                    $('#series-counter').html(data);
                }
            });
        });
        
        $('#serialNumber').keyup(function() {
            $('#series-counter').html($(this).val());
        });

        $.fn.municipalityMenu = function() {
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
        }

        $('#taxColClientType').change(function () {
            if ($(this).val() == '2' || $(this).val() == '3' || $(this).val() == '14') {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-contractor').removeClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#munBar').removeClass('d-none');
                $('#client-type-permittees').addClass('d-none')
                $('#client-type-permitFees').addClass('d-none')
                $('#client-type-others').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#taxColBarSelect').removeClass('d-none');
                $('#taxColMunicipality').attr('readonly', false);
                $('#taxColMunicipality').addClass('bg-white');
                $('#taxColBarangay').attr('readonly', false);
                $('#taxColBarangay').removeClass('bg-white');
                $('#taxColBarangay').val('');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $.fn.municipalityMenu();
            } else if ($(this).val() == '1' || $(this).val() == '47') {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-individual').removeClass('d-none');
                $('#client-type-others').removeClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#taxColMunicipality').attr('readonly', false);
                $('#taxColMunicipality').addClass('bg-white');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $.fn.municipalityMenu();
            } else if ($(this).val() == '4') {
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-separator').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#taxColBarSelect').removeClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#taxColMunicipality').attr('readonly', false);
                $('#taxColMunicipality').addClass('bg-white');
                $('#taxColBarangay').attr('readonly', false);
                $('#taxColBarangay').removeClass('bg-white');
                $('#taxColBarangay').val('');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $.fn.municipalityMenu();
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
                $('#taxColMunicipality').attr('readonly', false);
                $('#taxColMunicipality').addClass('bg-white');
                $('#taxColBarSelect').addClass('d-none');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $.fn.municipalityMenu();
            } else if ($(this).val() == '6' || $(this).val() == '7') { 
                $('#client-type-permittees').removeClass('d-none');
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#taxColBarSelect').removeClass('d-none');
                $('#taxColMunicipality').attr('readonly', false);
                $('#taxColMunicipality').addClass('bg-white');
                $('#taxColBarangay').attr('readonly', false);
                $('#taxColBarangay').removeClass('bg-white');
                $('#taxColBarangay').val('');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $.fn.municipalityMenu();
            } else if ($(this).val() == '9') {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').removeClass('d-none');
                $('#taxColBarSelect').removeClass('d-none');
                $('#taxColMunicipality').attr('readonly', true);
                $('#taxColMunicipality').removeClass('bg-white');
                $('#taxColMunicipality').val('');
                $('#taxColBarangay').attr('readonly', true);
                $('#taxColBarangay').removeClass('bg-white');
            } else if ($(this).val() == '10' || $(this).val() == '11') {
                $('#client-type-permitFees').removeClass('d-none');
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#taxColMunicipality').attr('readonly', false);
                $('#taxColMunicipality').addClass('bg-white');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#taxColBarSelect').removeClass('d-none');
                $('#taxColMunicipality').attr('readonly', true);
                $('#taxColMunicipality').removeClass('bg-white');
                $('#taxColMunicipality').val('');
                $('#taxColBarangay').attr('readonly', true);
                $('#taxColBarangay').removeClass('bg-white');
                $('#taxColBarangay').val('');
            } else if ($(this).val() == '12' || $(this).val() == '13') {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-bidders').removeClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#taxColBarSelect').removeClass('d-none');
                $('#taxColMunicipality').attr('readonly', true);
                $('#taxColMunicipality').removeClass('bg-white');
                $('#taxColMunicipality').val('');
                $('#taxColBarangay').attr('readonly', true);
                $('#taxColBarangay').removeClass('bg-white');
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
                $('#taxColBarSelect').removeClass('d-none');
                $('#taxColMunicipality').attr('readonly', true);
                $('#taxColMunicipality').removeClass('bg-white');
                $('#taxColMunicipality').val('');
                $('#taxColBarangay').attr('readonly', true);
                $('#taxColBarangay').removeClass('bg-white');
                $('#taxColBarangay').val('');
            } else {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-individual').removeClass('d-none');
                $('#client-type-others').removeClass('d-none');
                $('#client-type-permittees').addClass('d-none');
                $('#client-type-permitFees').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-bidders').addClass('d-none');
                $('#client-type-rentals').addClass('d-none');
                $('#taxColMunicipality').attr('readonly', true);
                $('#taxColMunicipality').removeClass('bg-white');
                $('#taxColMunicipality').val('');
                $('#taxColBarangay').attr('readonly', true);
                $('#taxColBarangay').removeClass('bg-white');
                $('#taxColBarangay').val('');
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
                        if ($('#taxColBusinessName').val() == '') {
                            $('#taxColOwner').val('');
                            $('#taxColAddress').val('');
                        }
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                    $(this).val('');
                    $('#taxColOwner').val('');
                } else {
                    $('#taxColOwner').val(ui.item.owner);
                    $('#taxColAddress').val(ui.item.address);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                    $('#checkTransaction').val(ui.item);
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
                    $('#taxColProprietor').val('');
                } else {
                    $('#taxColProprietor').val(ui.item.proprietor);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
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
                    $('#taxColPermitteeTradeName').val('');
                } else {
                    $('#taxColPermitteeTradeName').val(ui.item.trade_name);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
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
                    $('#taxColBiddersOwner').val('');
                } else {
                    $('#taxColBiddersOwner').val(ui.item.owner_representative);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
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
                    $('#taxColRentalLocation').val('');
                    $('#taxColRentalLease').val('');
                    $('#taxColRentalAutoID').val('');
                } else {
                    $('#taxColRentalLocation').val(ui.item.location);
                    $('#taxColRentalLease').val(ui.item.lease_of_contact);
                    $('#taxColRentalAutoID').val(ui.item.id);
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
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
                        if (transactionDay > 20) {
                            flag = false;
                        }
                    }
                }
                
                if ( flag ) {
                    totalMonths = 0;
                } else {
                    if (transactionMonth == 1) {
                        if (transactionDay <= 20) {
                            penaltyYear = transactionYear;
                        }
                    } else {
                        penaltyYear = (transactionYear*1);
                    }
                    let penaltyMonth = moment('1').format('M');
                    if (currentMonth == 1) {
                        if (currentDay >= 20) {
                            currentMonth = 1; // previously currentMonth -= 1;
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
            } else if ($('#penaltyType').val() == 'Fines & Penalties - Business Income (General Fund-Proper)') {
                let penalty = moment().add(1, 'M').format('M');
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
                    if (transactionMonth == penalty) {
                        if (transactionDay <= 3) {
                            penaltyYear = transactionYear;
                        }
                    } else {
                        penaltyYear = (transactionYear*1);
                    }
                    let penaltyMonth = penalty;
                    if (currentMonth == transactionMonth) {
                        if (currentDay >= 4) {
                            currentMonth -= 1;
                        }
                    } else {
                        if (transactionDay >= 4) {
                            currentMonth = transactionMonth - penaltyMonth + 1;
                        }
                    }
                    
                    let yearDiff = currentYear - penaltyYear;
                    totalMonths = (currentMonth*1) + (yearDiff * 12);
                }
            }

            let calcRate = 0;
            if (totalMonths >= 36) {
                calcRate = 72;
            } else {
                calcRate = totalMonths*2;
            }
            
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
            
            let calcRate = 0;
            if (totalMonths >= 36) {
                calcRate = 72;
            } else {
                calcRate = totalMonths*2;
            }
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
                    var taxColTypeRate = $(parent).find('td input')[2];
                    var myRow = $("#new-land-tax-table tr").index($(this).parents('tr'));

                    if (ui.item == null || ui.item == "") {
                        $(this).val('');
                    } else {

                        if (ui.item.type == 'Fixed') {
                            $('.taxColAmount').val(ui.item.fixed_rate);
                        } else if (ui.item.type == 'Manual') {
                            //$('.taxColNature').val(ui.item.title);
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
                                            $('#schedVolume').attr('readonly', false);
                                        } else {
                                            $('#schedVolume').attr('readonly', true);
                                        }
                                        $('#schedVolume').val(ui.item.shared_per_unit);
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
                        $(taxColTypeRate).val(ui.item.type);
                    }
                }  else {
                    $(this).val('');
                }
                return false;
            },
            change: function(event, ui) {
                var parent = $(this).parents('tr');
                var taxColTypeRate = $(parent).find('td input')[2];
                var myRow = $("#new-land-tax-table tr").index($(this).parents('tr'));
                var taxColAccount = $(parent).find('td input')[1];
                if (ui.item == null || ui.item == "") {
                    $(this).val('');
                } else {
                    if (ui.item.type == 'Fixed') {
                        $('.taxColAmount').val(ui.item.fixed_rate);
                    } else if (ui.item.type == 'Manual') {

                    } else if (ui.item.type == 'Percent') {
                        $('#percent_form')[0].reset();
                        $('#percentModal').modal('show');
                        let ratePenalty = $('#percentRate').val(ui.item.percent_value);
                        ratePenalty = ui.item.percent_value / 100;
                        setPercentRate(ratePenalty);
                        let ratePerMonth = 2.00;
                        $('#ratePerMonth').val(ratePerMonth.toFixed(2));
                        let amount = $('.taxColAmount').val();
                        $('#percentOfValue').val(ui.item.percent_of);
                        $('#percentRowIndex').val(myRow - 1);

                        if (ui.item.title == 'Fines & Penalties - Service Income (General Fund-Proper)') {
                            $('.withSpouse').addClass('d-none');
                            $('.withDonation').addClass('d-none');
                            $('.noneFines').removeClass('d-none');
                            $('.dateOfTransaction').removeClass('d-none');
                            $('.notarytDate').addClass('d-none');
                            $('#penaltyType').val(ui.item.title);
                            $('#dateOfPenalty').val('01/20/2023');
                            $('#percentAmount').val(amount);
                            
                            if(myRow == 1) {
                                isValid = false;
                                $('#percentModal').modal('hide');
                                $($($('#inputRow').find('tr')[0]).find('td input')[1]).val((taxColAccount).val());
                            } else if (myRow == 2) {
                                let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                $('#percentAmount').val(firstRow.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 3 && $(taxColAccount).val().includes('Fines & Penalties')) {
                                let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let secondRow = $('#inputRow').find('tr:nth-child(2)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let resultRow = (firstRow*1) + (secondRow*1);
                                result = resultRow.toFixed(2);
                                $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 4 && $(taxColAccount).val().includes('Fines & Penalties')) {
                                let resultRow = 0.00;
                                if ($('#inputRow').find('tr:nth-child(3)').find('td:nth-child(2)').children('input').val() != $(taxColAccount).val().includes('Fines & Penalties')) {
                                    let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                    let secondRow = $('#inputRow').find('tr:nth-child(2)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                    let thirdRow = $('#inputRow').find('tr:nth-child(3)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                    resultRow = (firstRow*1) + (secondRow*1) +(thirdRow*1);
                                } else {
                                    let thirdRow = $('#inputRow').find('tr:nth-child(3)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                    resultRow = (thirdRow*1);
                                }
                                result = resultRow.toFixed(2);
                                $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 5 && $(taxColAccount).val().includes('Fines & Penalties')) {
                                if ($('#inputRow').find('tr:nth-child(4)').find('td:nth-child(2)').children('input').val() != $(taxColAccount).val().includes('Fines & Penalties')) {
                                    let fourthRow = $('#inputRow').find('tr:nth-child(4)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                    $('#percentAmount').val(fourthRow.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                }
                            } else if (myRow == 6 && $(taxColAccount).val().includes('Fines & Penalties')) {
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
                                    let resultRow = (fifthRow*1);
                                    result = resultRow.toFixed(2);
                                    $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                }
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
                            let currentMonth = moment().add(1, 'M').format('M');
                            let currentYear = moment().format('YYYY');
                            $('#dateOfPenalty').val(currentMonth + '/03/' + currentYear);

                            if(myRow == 1) {
                                isValid = false;
                                $('#percentModal').modal('hide');
                                $($($('#inputRow').find('tr')[0]).find('td input')[1]).val((taxColAccount).val());
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
                            $('#penaltyType').val(ui.item.title);
                            $('#dateOfPenalty').val('02/01/2022');

                            if(myRow == 1) {
                                isValid = false;
                                $('#percentModal').modal('hide');
                                $($($('#inputRow').find('tr')[0]).find('td input')[1]).val((taxColAccount).val());
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
                                $($($('#inputRow').find('tr')[0]).find('td input')[1]).val((taxColAccount).val());
                            } else if (myRow == 2) {
                                let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                $('#percentAmount').val(firstRow.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 3) {
                                let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let secondRow = $('#inputRow').find('tr:nth-child(2)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let resultRow = (firstRow*1) + (secondRow*1);
                                result = resultRow.toFixed(2);
                                $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 4) {
                                let resultRow = 0.00;
                                if ($('#inputRow').find('tr:nth-child(2)').find('td:nth-child(2)').children('input').val() == $(taxColAccount).val().includes('Fines & Penalties')) {
                                    let thirdRow = $('#inputRow').find('tr:nth-child(3)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                    resultRow = (firstRow*1) + (secondRow*1) +(thirdRow*1);
                                } else {
                                    let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                    let secondRow = $('#inputRow').find('tr:nth-child(2)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                    let thirdRow = $('#inputRow').find('tr:nth-child(3)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                    resultRow = (thirdRow*1);
                                }
                                result = resultRow.toFixed(2);
                                $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 5 && $(taxColAccount).val().includes('Fines & Penalties')) {
                                if ($('#inputRow').find('tr:nth-child(4)').find('td:nth-child(2)').children('input').val() != $(taxColAccount).val().includes('Fines & Penalties')) {
                                    let fourthRow = $('#inputRow').find('tr:nth-child(4)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                    let resultRow = (fourthRow*1)
                                    result = resultRow.toFixed(2);
                                    $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                }
                            } else if (myRow == 6 && $(taxColAccount).val().includes('Fines & Penalties')) {
                                
                                if ($('#inputRow').find('tr:nth-child(4)').find('td:nth-child(2)').children('input').val() != $(taxColAccount).val().includes('Fines & Penalties')) {
                                    let fifthRow = $('#inputRow').find('tr:nth-child(5)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                    let resultRow = (fifthRow*1);
                                    result = resultRow.toFixed(2);
                                    $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                } else {
                                    if ($('#inputRow').find('tr:nth-child(5)').find('td:nth-child(2)').children('input').val() != $(taxColAccount).val().includes('Fines & Penalties')) {
                                        let fourthRow = $('#inputRow').find('tr:nth-child(4)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                        let fifthRow = $('#inputRow').find('tr:nth-child(5)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                        let resultRow = (fourthRow*1) + (fifthRow*1);
                                        result = resultRow.toFixed(2);
                                        $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                    }
                                }
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
                                $($($('#inputRow').find('tr')[0]).find('td input')[1]).val((taxColAccount).val());
                            } else if (myRow == 2 && $(taxColAccount).val().includes('Fines & Penalties')) {
                                let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                $('#percentAmount').val(firstRow.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 3 && $(taxColAccount).val().includes('Fines & Penalties')) {
                                let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let secondRow = $('#inputRow').find('tr:nth-child(2)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                let resultRow = (firstRow*1) + (secondRow*1);
                                result = resultRow.toFixed(2);
                                $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 4 && $(taxColAccount).val().includes('Fines & Penalties')) {
                                let resultRow = 0.00;
                                if ($('#inputRow').find('tr:nth-child(3)').find('td:nth-child(2)').children('input').val() != $(taxColAccount).val().includes('Fines & Penalties')) {
                                    let firstRow = $('#inputRow').find('tr:nth-child(1)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                    let secondRow = $('#inputRow').find('tr:nth-child(2)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                    let thirdRow = $('#inputRow').find('tr:nth-child(3)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                    resultRow = (firstRow*1) + (secondRow*1) +(thirdRow*1);
                                } else {
                                    let thirdRow = $('#inputRow').find('tr:nth-child(3)').find('td:nth-child(7)').children('input').val().replace(/,/g, "");
                                    resultRow = (thirdRow*1);
                                }
                                result = resultRow.toFixed(2);
                                $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            } else if (myRow == 5 && $(taxColAccount).val().includes('Fines & Penalties')) {
                                if ($('#inputRow').find('tr:nth-child(4)').find('td:nth-child(2)').children('input').val() != $(taxColAccount).val().includes('Fines & Penalties')) {
                                    let fourthRow = $('#inputRow').find('tr:nth-child(4)').find('td:nth-child(7)').children('input').val().replace(',', '');
                                    result = fourthRow.toFixed(2);
                                    $('#percentAmount').val(fourthRow.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                }
                            } else if (myRow == 6 && $(taxColAccount).val().includes('Fines & Penalties')) {
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
                                    let resultRow = (fifthRow*1);
                                    result = resultRow.toFixed(2);
                                    $('#percentAmount').val(result.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                }
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
                                        $('#schedVolume').attr('readonly', false);
                                    } else {
                                        $('#schedVolume').attr('readonly', true);
                                    }
                                    $('#schedVolume').val(ui.item.shared_per_unit);
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
                    $(taxColTypeRate).val(ui.item.type);    
                }
            }
        }

        $('#percentModal').on('shown.bs.modal', function (e) {
            $('#percentAmount').keyup(function () {
                $(this).mask("#00,000,000,000,000.00", {reverse: true});
                let amountString = $(this).val();
                let amount = parseFloat(amountString.replace(/,/g, ""));
                let ofValue = $('#percentOfValue').val();
                let givenValue = 0.00;
                givenValue = 0.005 * amount;
                givenValue = givenValue.toFixed(2);
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

        $('#notaryDate').change(function () {
            let deadline = moment($(this).val()).add(60, 'days').format('L');
            let deadlineDay = moment($(this).val()).add(60, 'days');
            let dead = moment($(this).val()).add(60, 'days').format('D');
            $('#dateOfPenalty').val(deadline);
            let firstRow = $($('#inputRow').find('tr')[0]).find('td input')[2];
            let dateOfPenalty = moment($('#dateOfPenalty').val(), 'MM/DD/YYYY');
            let dateToday = moment();
            let rate = 0;
            let isValid = true;
            let ratePenalty = $('#percentRate').val();
            let ratePerMonth = $('#ratePerMonth').val();
            let currentMonth = moment().format('M');
            let currentDay = moment().startOf('day').format('D');
            let curr = moment().format('D');
            let dayName = moment().format('dddd');
            let currentYear = moment().format('YYYY');
            let penaltyYear = dateOfPenalty.format('YYYY');
            let startMonth = dateOfPenalty.format('M');
            let monthDiff = Math.abs(currentMonth - startMonth);
            let yearDiff = currentYear - penaltyYear;
            let totalMonths = (yearDiff * 12) - (startMonth*1) + (currentMonth*1)+1;
            let month = 0;
            let percentage = 0;
            let isDue = true;
            
            if (monthDiff == 0) {
                monthDiff += 1;
            }
            
            if (dayName == 'Sunday') {
                totalMonths -= 1;
            }
            
            month = totalMonths;
            percentage = month*2;
            if (parseInt(curr) > parseInt(dead) || parseInt(curr) == parseInt(dead)) {
                month = month;
                percentage = percentage;
                
                if (percentage > 72) {
                    percentage = 72;
                }
            } else if (parseInt(curr) < parseInt(dead)) {
                month = month-1;
                percentage = percentage-2;
                
                if (percentage > 72) {
                    percentage = 72;
                }
            } else {
                month = 0;
                percentage = 0;
                isDue = false;
            }
            
            if (isDue == true) {
                $('#numOfMonths').val(month);
                $('#calculatedRate').val(percentage);
                $('#percentAmount').mask("#00,000,000,000,000.00", {reverse: true});
                let amountString = $('#percentAmount').val();
                let value = parseFloat(amountString.replace(/,/g, ""));
                let firstEqu = 0.00;
                firstEqu = value * ratePenalty;
                firstResult = firstEqu + value;
                SecondEqu = firstResult * percentage / 100;
                finalValue = firstEqu  + SecondEqu;
                givenValue = finalValue.toFixed(2);
                $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                $('#calculatedRate').val(percentage);

                $('#percentAmount').keyup(function () {
                    $('#percentAmount').mask("#00,000,000,000,000.00", {reverse: true});
                    let amountString = $('#percentAmount').val();
                    let value = parseFloat(amountString.replace(/,/g, ""));
                    let firstEqu = 0.00;
                    
                    firstEqu = value * ratePenalty;
                    firstResult = firstEqu + value;
                    SecondEqu = firstResult * percentage / 100;
                    finalValue = firstEqu  + SecondEqu;
                    givenValue = finalValue.toFixed(2);
                    $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#calculatedRate').val(percentage);
                });
            } else {
                $('#numOfMonths').val(month);
                $('#calculatedRate').val(percentage);
                $('#percentAmount').mask("#00,000,000,000,000.00", {reverse: true});
                let amountString = $('#percentAmount').val();
                let value = parseFloat(amountString.replace(/,/g, ""));
                let firstEqu = 0.00;
                firstEqu = value * ratePenalty;
                firstResult = firstEqu + value;
                SecondEqu = firstResult * percentage / 100;
                finalValue = firstEqu  + SecondEqu;
                givenValue = finalValue.toFixed(2);
                $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                $('#calculatedRate').val(percentage);

                $('#percentAmount').keyup(function () {
                    $('#percentAmount').mask("#00,000,000,000,000.00", {reverse: true});
                    let amountString = $('#percentAmount').val();
                    let value = parseFloat(amountString.replace(/,/g, ""));
                    let firstEqu = 0.00;
                    
                    firstEqu = value * ratePenalty;
                    firstResult = firstEqu + value;
                    SecondEqu = firstResult * percentage / 100;
                    finalValue = firstEqu  + SecondEqu;
                    givenValue = finalValue.toFixed(2);
                    $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#calculatedRate').val(percentage);
                });
            }
        });

        $('#print-receipt').click(function() {
            setTimeout(function () {
                location.reload(true);
            }, 1);
        });

        $(".taxColAccount").autocomplete(category_autocomplete).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#taxColLastName").autocomplete(individual_last_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#taxColFirstName").autocomplete(individual_first_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#taxColBusinessName").autocomplete(business_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });
        
        $("#taxColPermitFeesTradeName").autocomplete(permit_fees_trade_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#taxColPermittee").autocomplete(permittees_sg_trade_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#taxColBiddersBusinessName").autocomplete(bidders_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#taxColRentalName").autocomplete(rentals_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        /*$("#startSG").autocomplete(serials_sg_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });*/

        $('#taxColCert').change(function() {
            trigger = 1;
            let modalContent = $('#inputRowProvPermit').find('tr').last();
            let taxColAccount = $('.taxColAccount')[0];
            let taxColNature = $('.taxColNature')[0];
            let taxColAmmount = $('.taxColAmmount')[0];

            $(taxColNature).val("");
            $(taxColAmmount).val("");
            
            if ($(this).val() == 'Transfer Tax') {
                $(taxColAccount).val('Real Property Transfer Tax');
                $(taxColAccount).trigger('focus');
                $('.noneFines').addClass('d-none');
                $('.notarytDate').addClass('d-none');
                $('.withSpouse').removeClass('d-none');
                $('.withDonation').removeClass('d-none');
                $('#delivery-receipts').addClass('d-none');
            }

            if ($(this).val() == 'Sand & Gravel') {
                $(taxColAccount).val('Tax on Sand, Gravel & Other Quarry Prod.');
                $(taxColAccount).trigger('focus');
                $('#delivery-receipts').removeClass('d-none');

                $('#bookletSG').html('<option class="bg-white" value=""></option>');
                if ($('#taxColClientType').val() == 6) {
                    for (let i=1; i<=20; i++) {
                    $('#bookletSG').html($('#bookletSG').html() +
                            '<option class="bg-white" value="' + i + '">' + i + '</option>');
                }
                } else if ($('#taxColClientType').val() == 7) {
                    for (let i=1; i<=20; i++) {
                    $('#bookletSG').html($('#bookletSG').html() +
                            '<option class="bg-white" value="' + i + '">' + i + '</option>');
                    }
                }
            }

            if ($(this).val() == 'Provincial Permit') {
                $(taxColAccount).val('Permit Fees');
                $(taxColAccount).trigger('focus');
                $('#delivery-receipts').addClass('d-none');

                if ($('#taxColClientType').val() == 1 || $('#taxColClientType').val() == 2 || $('#taxColClientType').val() == 6 || $('#taxColClientType').val() == 7 || $('#taxColClientType').val() == 14 || $('#taxColClientType').val() == 15 || $('#taxColClientType').val() == 48) {
                    $('#taxColMunicipality').attr('readonly', true);
                    $('#taxColMunicipality').removeClass('bg-white');
                    $('#taxColMunicipality').val('');
                    $('#taxColBarangay').attr('readonly', true);
                    $('#taxColBarangay').removeClass('bg-white');
                    $('#taxColBarangay').val('');
                }
            }
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

        $('#schedVolume').keyup(function() {
            $(this).mask("#00,000,000,000,000.00", {reverse: true});
            let setVal = $(this).val();
            let getVal = parseFloat(setVal.replace(/,/g, ""));
            let total = 0.00;
            total = getVal * $('#schedValue').val();
            total = total.toFixed(2);
            $('#schedTotal').val(total.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('.taxColAmmount').change(function() {
            let total = 0;
            $('.taxColAmmount').each(function() {
                total = total + $(this).val();
            });
            $('#taxColTotal').val(total);
        });

        $('#sched-btn').click(function() {
            let row = $('#new-land-tax-table tbody').find('tr')[$('#schedRowIndex').val()];
            var taxColQuantity = $(row).find('td input')[3];
            var taxColAccount = $(row).find('td input')[1];
            var taxColTotal = $(row).find('td input')[5];
            var taxColNature = $(row).find('td input')[4];
            $(taxColQuantity).val($('#schedVolume').val());
            $(taxColTotal).val($('#schedTotal').val());
            $(taxColTotal).trigger('change');
            console.log($('#schedAuto').val());
            if ($('#schedAuto').val() == 'Aggregate Base Course/SBBC (cu.m @ 17.50)') {
                $(taxColNature).val('Aggregate Base Course/SBBC ('+$('#schedVolume').val()+'cu.m @ 17.50)');
            } else if ($('#schedAuto').val() == 'Boulders/stones (cu.m @ 30.00)') {
                $(taxColNature).val('Boulders/stones ('+$('#schedVolume').val()+'cu.m @ 30.00)');
            } else if ($('#schedAuto').val() == 'Crushed Gravel (cu.m @ 30.00)') {
                $(taxColNature).val('Crushed Gravel ('+$('#schedVolume').val()+'cu.m @ 30.00)');
            } else if ($('#schedAuto').val() == 'Crushed Sand (cu.m @ 27.50)') {
                $(taxColNature).val('Crushed Sand ('+$('#schedVolume').val()+'cu.m @ 27.50)');
            } else if ($('#schedAuto').val() == 'Sand and Gravel (cu.m @ 25.00)') {
                $(taxColNature).val('Sand and Gravel ('+$('#schedVolume').val()+'cu.m @ 25.00)');
            } else if ($('#schedAuto').val() == 'Sand and Gravel Penalty (cu.m @ 300.00)') {
                $(taxColNature).val('Sand and Gravel Penalty ('+$('#schedVolume').val()+'cu.m @ 300.00)');
            } else if ($(taxColAccount).val() == 'General (Buildings/Lots/Light & Water)') {
                $(taxColNature).val($('#schedAuto').val());
            } else if ($('#schedAuto').val() == 'Sand and Gravel Tax (cu.m @ 22.50)') {
                $(taxColNature).val('Sand and Gravel Tax ('+$('#schedVolume').val()+'cu.m @ 22.50)');
            } else if ($('#schedAuto').val() == 'Annual Fixed Tax (unit @ 600.00)') {
                $(taxColNature).val('Annual Fixed Tax ('+$('#schedVolume').val()+'unit @ 600.00)');
            } else {
                $(taxColNature).val($('#schedAuto').val());
            }
            $('#scheduleModal').modal('toggle');
        });

        $('#percent-btn').click(function () {
            let row = $('#new-land-tax-table tbody').find('tr')[$('#percentRowIndex').val()];
            let collAmount = $('taxColAmount')[0];
            var taxColTotal = $(row).find('td input')[5];
            var taxColAccount = $(row).find('td input')[1];
            var taxColNature = $(row).find('td input')[4];
            var taxColQuantity = $(row).find('td input')[3];
            
            $(taxColTotal).val($('#percentValue').val());
            if ($(taxColAccount).val() == 'Fines & Penalties - Service Income (General Fund-Proper)') {
                $(taxColNature).val('Surcharge & Interest');
            } else if ($(taxColAccount).val() == 'Fines & Penalties - Business Income (General Fund-Proper)') {
                $(taxColNature).val('Surcharge & Interest');
            } else if ($(taxColAccount).val() == 'Tax Revenue - Fines & Penalties - on Individual (PTR)') {
                $(taxColNature).val('Surcharge & Interest');
            } else if ($(taxColAccount).val() == 'Tax Revenue - Fines & Penalties - Goods & Services') {
                $(taxColNature).val('Surcharge & Interest');
            } else if ($(taxColAccount).val() == 'Tax Revenue - Fines & Penalties - Property Taxes') {
                $(taxColNature).val('Surcharge & Interest');
            } else if ($(taxColAccount).val() == 'Real Property Transfer Tax') {
                if ($('#survivingSpouse').val() == 1) {
                    $(taxColNature).val($(taxColAccount).val() + ' (EJS w/ surviving spouse ' + $('#percentAmount').val() + ')');
                } else if ($('#survivingSpouse').val() == 0) {
                    $(taxColNature).val('Transfer Tax (Sale w/ SP of ' + $('#percentAmount').val() + ')');
                } else if ($('#donation').val() == 1) {
                    $(taxColNature).val('Transfer Tax (EJS w/ Donation & Consideration of ' + $('#percentAmount').val() + ')');
                } else if ($('#donation').val() == 0) {
                    $(taxColNature).val('Transfer Tax (Sale w/ SP of ' + $('#percentAmount').val() + ')');
                } else {
                    $(taxColNature).val('Transfer Tax (Sale w/ SP of ' + $('#percentAmount').val() + ')');
                }
            } else {
                $(taxColNature).val($(taxColAccount).val() + ' (w/ amount ' + $('#percentAmount').val() + ')');
            }
            $(taxColTotal).trigger('change');
            $('#percentModal').modal('hide');
        });

        let series = @json($serials);
        let fieldSeries = @json($fieldSerials);
        $('#taxColSeries').attr('readonly', false);
        $('#taxColSeries').addClass('bg-white');
        if (series.length > 0) {
            series = series[0].id;
        } else {
            series = 0;
        }
    
        $('#taxColMunicipality').change(function() {
            $('#taxColBarangay').attr('readonly', false);
            $('#taxColBarangay').addClass('bg-white');
            if ($(this).val() == 'null') {
                $('#taxColBarangay').attr('readonly', true);
                $('#taxColBarangay').removeClass('bg-white');
            }
            $.ajax({
                method: "POST",
                url: "{{ route('getBarangays') }}",
                async: false,
                data: {
                    id: $(this).val(),
                }
            }).done(function(data) {
                $('#taxColBarangay').html('<option class="bg-white" value=""></option>');
                data.forEach(element => {
                    $('#taxColBarangay').html($('#taxColBarangay').html() +
                        '<option class="bg-white" value="' + element.id + '">' + element.barangay_name + '</option>');
                });
            });
        });

        let rowCounter = 1;
        $('#addRowAccount').click(function() {
            let rowID = $('.taxColAccountID').val();
            var html = '';
            html += '<tr class="newRow">';
            html += '<td class="d-none"><input type="text"name="taxColAccountID[]" class="taxColAccountID form-control mb-0 bg-white text-dark">';

            html += '<td>';
            html += '<input type="text" name="taxColAccount[]" class="taxColAccount form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '</td>';

            html += '<td>';
            html += '<input readonly type="text" name="taxColTypeRate[]"class="d-none taxColTypeRate form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input readonly type="text" name="taxColQuantity[]"class="d-none taxColQuantity form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input type="text" name="taxColNature[]" class="taxColNature form-control mb-0 bg-white text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input type="text" name="taxColAmount[]" class="taxColAmount form-control mb-0 bg-white text-dark">';
            html += '</td>'

            if ($('#taxColTransaction').val() == "Check & Cash") {
                html += '<td>';
                html += '<input class="cashRow cashRowVal'+rowCounter+' cashChRowID'+rowID+'" type="checkbox" name="cashRow[]">';
                html += '</td>'

                html += '<td style="width: 8%">';
                html += '<input class="checkRow checkRowVal'+rowCounter+' checkRowID'+rowID+'" type="checkbox" name="checkRow[]">';
                html += '<button type="button" class="btn-primary viewCheck'+rowCounter+' viewBtnID'+rowID+' checkBtn d-none">View</button>'
                html += '</td>'
            }

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

            if (rowID) {
                console.log(00);
                $('.cashRowVal'+rowID).click(function() {
                    if ($(this).prop("checked")) {
                        $(this).val("Cash");
                    } else {
                        $(this).val("");
                    }
                });
                
                $('.checkRowVal'+rowID).click(function() {
                    $('#check_form')[0].reset();
                    $('#serailNumReference').val($('#serialNumber').val());
                    let rowCounts = $(this).closest('tr').index();
                    if ($(this).prop("checked")) {
                        $(this).val("Check");
                        $('#checkModal').modal('show');
                        $('.viewBtnID'+$(this).closest('tr').index()).removeClass('d-none');
                    } else {
                        $(this).val("");
                        $('.viewBtnID'+$(this).closest('tr').index()).addClass('d-none');
                    }
                });
                
                $('.viewBtnID'+rowID).click(function() {
                    $('#serailNumReference').val($('#serialNumber').val());
                    $('#checkModal').modal('show');
                    let sRow = $(this).closest('tr').index();
                    $('#check_form')[0].reset();
                    $.ajax({
                        method: "POST",
                        url: "{{ route('viewCheckDetails') }}",
                        async: false,
                        data: {
                            dRowID: $(this).closest('tr').index(),
                            dRow: $('#taxColID').val(),
                            serial: $('#serialNumber').val()
                        }
                    }).done(function(data) {
                        let rowNum = data[1];
                        let nRow = data[0];
                        for (let i = 0; i < nRow.length; i++) {
                            if (nRow) {
                                if (rowNum == sRow) {
                                    $('#taxColRowBank').val(nRow[i].bank_name);
                                    $('#taxColRowNumber').val(nRow[i].bank_number);
                                    $('#taxColRowTransactDate').val(nRow[i].bank_date);
                                }
                            } else {
                                $('#check_form')[0].reset();
                            }
                        }
                    });
                });
            } else {
                console.log(11);
                $('.cashRowVal'+rowCounter).click(function() {
                    if ($(this).prop("checked")) {
                        $(this).val("Cash");
                    } else {
                        $(this).val("");
                    }
                });
                
                $('.checkRowVal'+rowCounter).click(function() {
                    $('#check_form')[0].reset();
                    $('#serailNumReference').val($('#serialNumber').val());
                    let rowCounts = $(this).closest('tr').index();
                    if ($(this).prop("checked")) {
                        $(this).val("Check");
                        $('#checkModal').modal('show');
                        $('.viewCheck'+$(this).closest('tr').index()).removeClass('d-none');
                    } else {
                        $(this).val("");
                        $('.viewCheck'+$(this).closest('tr').index()).addClass('d-none');
                    }
                });
                
                $('.viewCheck'+rowCounter).click(function() {
                    $('#serailNumReference').val($('#serialNumber').val());
                    $('#checkModal').modal('show');
                    let sRow = $(this).closest('tr').index();
                    $('#check_form')[0].reset();
                    $.ajax({
                        method: "POST",
                        url: "{{ route('viewCheckDetails') }}",
                        async: false,
                        data: {
                            dRowID: $(this).closest('tr').index(),
                            dRow: $('#taxColID').val(),
                            serial: $('#serialNumber').val()
                        }
                    }).done(function(data) {
                        let rowNum = data[1];
                        let nRow = data[0];
                        for (let i = 0; i < nRow.length; i++) {
                            if (nRow) {
                                if (rowNum == sRow && $('#serialNumber').val() == nRow[i].serial_ref) {
                                    $('#taxColRowBank').val(nRow[i].bank_name);
                                    $('#taxColRowNumber').val(nRow[i].bank_number);
                                    $('#taxColRowTransactDate').val(nRow[i].bank_date);
                                }
                            } else {
                                $('#check_form')[0].reset();
                            }
                        }
                    });
                });
                rowCounter++;
            }

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

            $('.taxColAmount').change(function() {
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

        $('#addRowPermit').click(function() {
            var html = '';
            html += '<tr class="newRow">';
            html += '<td>';
            html += '<input type="text" name="provFeeCharge[]" class="provFeeCharge form-control mb-0 bg-white text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input type="text" name="provAmount[]" class="provAmount form-control mb-0 bg-white text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input type="text" name="provORNumber[]" class="provORNumber form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '<input type="text" name="provDate[]" class="provDate datepicker form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '<input type="text" name="provInitials[]" class="provInitials form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '<div><button type="button" class=" removeRow btn btn-danger btn-sm mb-4 tim-icons icon-simple-delete"></button></div>';
            html += '</td>';
            html += '</tr>';

            let lastRow = $('#inputRowProvPermit').find('tr').last();
            $('#inputRowProvPermit').append(html);

            $(".taxColAccount").autocomplete(category_autocomplete).focus(function() {
                $(this).autocomplete('search', $(this).val());
            });

            $('.removeRow').on('click', function() {
                $(this).closest('tr').remove();
            });
        });

        $('.cashRowVal').click(function() {
            if ($(this).prop("checked")) {
                $(this).val("Cash");
            } else {
                $(this).val("");
            }
        });
        $('.checkRowVal').click(function() {
            $('#serailNumReference').val($('#serialNumber').val());
            if ($(this).prop("checked")) {
                $(this).val("Check");
                $('#checkModal').modal('show');
                $('.viewCheck').removeClass('d-none');
                
            } else {
                $(this).val("");
                $('.viewCheck').addClass('d-none');
            }
        });

        $('.viewCheck').click(function() {
            $('#checkModal').modal('show');
            $('#serailNumReference').val($('#serialNumber').val());
            console.log($('#serialNumber').val());
            $.ajax({
                method: "POST",
                url: "{{ route('viewCheckDetails') }}",
                async: false,
                data: {
                    dRowID: $(this).closest('tr').index(),
                    row1: $('#taxColID').val(),
                    checkStat: $('#mainCheck').val(),
                    serial: $('#serialNumber').val()
                }
            }).done(function(data) {
                let fRow = data[0];
                if (fRow) {
                    if (fRow.transact_type == 'Check' && $('#serialNumber').val() == fRow.serial_ref) {
                        $('#taxColRowBank').val(fRow.bank_name);
                        $('#taxColRowNumber').val(fRow.bank_number);
                        $('#taxColRowTransactDate').val(fRow.bank_date);
                    }
                } else {
                    $('#check_form')[0].reset();
                }
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

                $('.cashRow').addClass('d-none');
                $('.checkRow').addClass('d-none');

                $('#bankRemarks').addClass('d-none');
            } else if ($(this).val() == 'Check & Cash') {
                $('.cashRow').removeClass('d-none');
                $('.checkRow').removeClass('d-none');

                $('#taxColBank').attr('readonly', false);
                $('#taxColBank').removeClass('bg-white');

                $('#taxColNumber').attr('readonly', false);
                $('#taxColNumber').removeClass('bg-white');

                $('#taxColTransactDate').attr('readonly', false);
                $('#taxColTransactDate').removeClass('bg-white');

                $('#bankRemarks').addClass('d-none');
            } else {
                $('#bankRemarks').removeClass('d-none');
                $('.cashRow').addClass('d-none');
                $('.checkRow').addClass('d-none');
            }
        });

        $('#bookletSG').change(function() {
            let startSerialNum = $('#startSG').val() - 1;
            let bookletNum = $(this).val();
            let bookletVal = 50;
            calcValue = (bookletNum*1) * (bookletVal*1) + (startSerialNum*1);
            $('#endSG').val(calcValue);
        });
        
        $("#setNewData").on('click', function() {
            let clientType = $('#taxColClientType').val();
            let municipality = $('#taxColMunicipality').val();
            let barangay = $('#taxColBarangay').val();
            let revenueData  = $('#land_tax_form').serializeArray();
            revenueData.push({name:'bankRemarksRevenue', value:tinymce.get("taxColBankRemarks").getContent()});
            revenueData.push({name:'receiptRemarksRevenue', value:tinymce.get("taxColReceiptRemarks").getContent()});
            let form = $(this);
            if ($('#taxColClientType').val() == 6) {
                var serialsSGType = 'Industrial';
            } else if ($('#taxColClientType').val() == 7) {
                var serialsSGType = 'Commercial';
            }
            
            if ($('#startSG').val() != '') {
                $.ajax({
                    method: "POST",
                    url: "{{ route('submit_serial_sg_form') }}",
                    async: false,
                    data: {
                        id: $(this).val(),
                        startSerialSG: $('#startSG').val(),
                        bookletAmount: $('#bookletSG').val(),
                        endSerialSG: $('#endSG').val(),
                        sgType: serialsSGType,
                        serialNum: $('#serialNumber').val()
                    }
                });   
            }

            if($('#checkTransaction').val() == '') {
                if ($('#taxColClientType').val() == 2 || $('#taxColClientType').val() == 14 || $('#taxColClientType').val() == 15) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('addNewContractorsForm') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "businessName": $('#taxColBusinessName').val(),
                            "owner": $('#taxColOwner').val(),
                            "address": $('#taxColAddress').val(),
                        },
                        'dataType': "json",
                        'success': function(data) {
                            response(data);
                        }
                    });
                } else if ($('#taxColClientType').val() == 6 || $('#taxColClientType').val() == 7) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('saveNewPermitteesRevenueTax') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "type": $('#taxColClientType').val(),
                            "permittees": $('#taxColPermittee').val(),
                            "tradeName": $('#taxColPermitteeTradeName').val(),
                            "mun": $('#taxColMunicipality').val(),
                            "bar": $('#taxColBarangay').val(),
                        },
                        'dataType': "json",
                        'success': function(data) {
                            response(data);
                        }
                    });
                } else if ($('#taxColClientType').val() == 9) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('insertRentalsInfo') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "rentalName": $('#taxColRentalName').val(),
                            "rentalLocation": $('#taxColRentalLocation').val(),
                            "rentalLease": $('#taxColRentalLease').val(),
                        },
                        'dataType': "json",
                        'success': function(data) {
                            response(data);
                        }
                    });
                } else if ($('#taxColClientType').val() == 10 || $('#taxColClientType').val() == 11) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('addNewPermitteesOthersForm') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "type": $('#taxColClientType').val(),
                            "tradeName": $('#taxColPermitFeesTradeName').val(),
                            "proprietor": $('#taxColProprietor').val()
                        },
                        'dataType': "json",
                        'success': function(data) {
                            response(data);
                        }
                    });
                } else if ($('#taxColClientType').val() == 12 || $('#taxColClientType').val() == 13) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('insertBiidersInfo') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "biddersBusinessName": $('#taxColBiddersBusinessName').val(),
                            "biddersOwner": $('#taxColBiddersOwner').val()
                        },
                        'dataType': "json",
                        'success': function(data) {
                            response(data);
                        }
                    });
                }
            }
            
            Swal.fire({
                icon: 'info',
                title: 'Form will be Saved. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    if (clientType == 1 || clientType == 2 || clientType == 3 || clientType == 4 || clientType == 5 || clientType == 6 || clientType == 7) {
                        if (municipality != '' || barangay != '') {
                            $.ajax({
                                'url': '{{ route('land_tax_form') }}',
                                'data': revenueData,
                                'method': "post",
                                'dataType': "json",
                                'success': function(data) {
                                    // generate popup if transaction failed
                                    $('#printCertID').val(data);
                                    $('#print-receipt').prop('href', 'printReceipt/' + data);
                                }
                            });
                            Swal.fire({
                                icon: 'success',
                                title: 'Data has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#land-tax-table').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Municipality & Barangay field is required',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                            }).then((result) => {

                            });
                        }
                    } else {
                        $.ajax({
                            'url': '{{ route('land_tax_form') }}',
                            'data': revenueData,
                            'method': "post",
                            'dataType': "json",
                            'success': function(data) {
                                // generate popup if transaction failed
                                $('#printCertID').val(data);
                                $('#print-receipt').prop('href', 'printReceipt/' + data);
                            }
                        });
                        $.ajax({
                            method: "POST",
                            url: "{{ route('updateSeriesStatus') }}",
                            async: false,
                            data: {
                                id: "Field Land Tax Collection",
                                serial: $('#serialNumber').val()
                            }
                        });
                        Swal.fire({
                            icon: 'success',
                            title: 'Data has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#land-tax-table').DataTable().ajax.reload();
                    }
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
            
        });
        
        $('#save-cert-btn').on('click', function(e) {
            //$('#notaryPublic').tinyMCE.triggerSave();
            let certData  = $('#cert_form').serializeArray();
            certData.push({name:'certDetailsFinal', value:tinymce.get("certDetails").getContent()});
            certData.push({name:'certNotaryFinal', value:tinymce.get("notaryPublic").getContent()});
            Swal.fire({
                icon: 'info',
                title: 'Form will be Saved. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    let valid = true;
                    if ($('#certType').val() == 'Provincial Permit') {
                    
                        let count = $('.provFeeCharge').length;
                        for (let i=0; i<count; i++) {
                            if ($($('.provFeeCharge')[i]).val() == '') {
                                if (count == 1) {
                                    //if ($($('.provAmount')[i]).val() == '' || $($('.provORNumber')[i]).val() == '' || $($('.provDate')[i]).val() == '' || $($('.provInitials')[i]).val() == '') {
                                    //    valid = false;
                                    //    break;
                                    //}
                                } else {
                                    if ($($('.provAmount')[i]).val() != '' || $($('.provORNumber')[i]).val() != '' || $($('.provDate')[i]).val() != '' || $($('.provInitials')[i]).val() != '') {
                                        valid = false;
                                        break;
                                    }
                                }
                            } else {
                                if ($($('.provAmount')[i]).val() == '' || $($('.provORNumber')[i]).val() == '' || $($('.provDate')[i]).val() == '' || $($('.provInitials')[i]).val() == '') {
                                    valid = false;
                                    break;
                                }
                            }
                        }
                    }
                    if (valid) {
                        $.ajax({
                            'url': '{{ route('cert_form') }}',
                            'data': certData,
                            'method': "post",
                            'dataType': "json",
                            'success': function(data) {
                                $('#printCertID').val(data);
                            }
                        });
                        Swal.fire({
                            icon: 'success',
                            title: 'Data has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire('Please validate fields!', '', 'info')
                    }
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info');
                }
            });
        });

        $('#save-check').click(function() {
            let checkData  = $('#check_form').serializeArray();
            Swal.fire({
                icon: 'info',
                title: 'Form will be Saved. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        'url': '{{ route('check_form') }}',
                        'data': checkData,
                        'method': "post",
                        'dataType': "json",
                        'success': function(data) {
                            $('#printCertID').val(data);
                        }
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'Data has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info');
                }
            });
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
                console.log(float);
                sum = sum + parseFloat(float);
            });
            sum = sum.toFixed(2);
            $('#taxColTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('.taxColAmount').change(function() {
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
    </script>
@endsection
