@extends('layouts.app', ['page' => __('Field Land Tax Collection'), 'pageSlug' => 'field_land_tax_collection'])

@section('content')
    <form name="land_tax_form" id="land_tax_form" method="post" action="{{ url('land_tax_form') }}">
        @csrf
        <div class="modal fade" id="addTaxColModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h3 class="modal-title text-white" id="addTaxColModalTitle">Add New Data</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row d-none">
                                <div class="col-md-3">
                                    <label for="taxColID">Tax ID</label>
                                    <input type="text" name="taxColID" class="form-control mb-0 bg-white text-dark"
                                        id="taxColID">
                                    <label class="text-danger">
                                        @error('taxColID')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                            </div>

                            <div id="currentDate" class="row">
                                <div class="col-md-3">
                                    <label class="text-light" for="taxColcurrentDate">Currrent Date</label>
                                    <input type="text" class="form-control currentDate bg-white text-dark mb-3" value="{{ $current_date }}"/>
                                </div>
                            </div>

                            <div id="editCurrentDate" class="row d-none">
                                <div class="col-md-3">
                                    <label class="text-light" for="taxColEditcurrentDate">Date</label>
                                    <input type="text" name="taxColEditcurrentDate" class="form-control currentDate bg-white text-dark mb-3" id="taxColEditcurrentDate"/>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-light" for="taxColClientType">Client Type</label>
                                    <select class="form-control bg-white text-dark" name="taxColClientType"
                                        id="taxColClientType">
                                        <option class="bg-white" value="null"></option>
                                        @foreach ($displayCustType as $cust_items)
                                            <option class="bg-white" value="{{ $cust_items->id }}">
                                                {{ $cust_items->description_type }}</option>
                                        @endforeach
                                    </select>
                                    <label class="text-danger">
                                        @error('taxColClientType')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-2">
                                    <label class="text-light" for="taxColType">AF Type</label>
                                    <select class="form-control bg-white text-dark" name="taxColType" id="taxColType">
                                        <option class="bg-white" value="Form 51">Form 51</option>
                                        <option class="bg-white" value="Form 56">Form 56</option>
                                    </select>
                                    <label class="text-danger">
                                        @error('taxColType')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-3 d-none">
                                    <label class="text-light" for="taxColIP">User IP</label>
                                    @foreach ($displayTaxID as $tax_item)

                                    @endforeach
                                    <input type="text" name="taxColIP" class="form-control mb-0 bg-white text-dark"
                                        id="taxColIP" value="{{ $tax_item->id }}">
                                    <label class="text-danger">
                                        @error('taxColIP')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-3">
                                    <label class="text-light" for="taxColSeries">Series &emsp;<span id="series-counter"></span></label>
                                    <select readonly class="form-control text-dark" name="taxColSeries" id="taxColSeries">
                                        @foreach ($serials as $serial_items)
                                            <option class="bg-white" value="{{ $serial_items->id }}">
                                                {{ $serial_items->Serial }}</option>
                                        @endforeach
                                    </select>
                                    <label class="text-danger">
                                        @error('taxColSeries')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-3 d-none">
                                    <label class="text-light" for="serialNumber">Serial Number</label>
                                    <input readonly class="form-control bg-white text-dark" name="serialNumber" id="serialNumber">
                                    <label class="text-danger">
                                        @error('serialNumber')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-2">
                                    <label class="text-light" for="taxColMunicipality">Municipality</label>
                                    <select readonly class="form-control bg-light text-dark" name="taxColMunicipality"
                                        id="taxColMunicipality">
                                        <option class="bg-white" value=""></option>
                                        @foreach ($displayMun as $mun_items)
                                            <option class="bg-white" value="{{ $mun_items->id }}">
                                                {{ $mun_items->municipality }}</option>
                                        @endforeach
                                    </select>
                                    <label class="text-danger">
                                        @error('taxColMunicipality')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-2">
                                    <label class="text-light" for="taxColBarangay">Barangay</label>
                                    <select readonly class="form-control bg-light text-dark" name="taxColBarangay"
                                    id="taxColBarangay">
                                        <option class="bg-white" value=""></option>
                                    </select>
                                    <label class="text-danger">
                                        @error('taxColBarangay')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-2 d-none">
                                    <label class="text-light" for="printStatus">Status</label>
                                    <input readonly type="text" name="printStatus"
                                        class="bg-light form-control mb-0 text-dark" id="printStatus" value="Not Printed">
                                    <label class="text-danger">
                                        @error('printStatus')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                            </div>

                            <hr id="client-type-separator" class="bg-white">

                            <div id="client-type-selector" class="col-md-12">
                                <div id="client-type-others" class="row d-none ml-2">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="clientTypeRadio" id="individualRadio" value="Individual" checked/>
                                            <label class="form-check-label text-light" for="individualRadio"> Individual </label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="clientTypeRadio" id="spousesRadio" value="Spouse"/>
                                            <label class="form-check-label text-light" for="spousesRadio"> SPS </label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="clientTypeRadio" id="companyRadio" value="Company"/>
                                            <label class="form-check-label text-light" for="companyRadio"> Company </label>
                                        </div>
                                    </div>
                                </div>

                                <div id="client-type-individual" class="row d-none">
                                    <div class="col-md-3">
                                        <label class="text-light" for="taxColLastName">Last Name</label>
                                        <input type="text" name="taxColLastName" class="form-control mb-0 bg-white text-dark"
                                            id="taxColLastName">
                                        <label class="text-danger">
                                            @error('taxColLastName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
    
                                    <div class="col-md-3">
                                        <label class="text-light" for="taxColFirstName">First Name</label>
                                        <input type="text" name="taxColFirstName" class="form-control mb-0 bg-white text-dark"
                                            id="taxColFirstName">
                                        <label class="text-danger">
                                            @error('taxColFirstName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
    
                                    <div class="col-md-1">
                                        <label class="text-light" for="taxColMI">M.I.</label>
                                        <input type="text" name="taxColMI" class="form-control mb-0 bg-white text-dark"
                                            id="taxColMI">
                                        <label class="text-danger">
                                            @error('taxColMI')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
    
                                    <div class="col-md-1">
                                        <label class="text-light" for="taxColSex">Sex</label>
                                        <select class="form-control bg-white text-dark" name="taxColSex" id="taxColSex">
                                            <option class="bg-white" value=""></option>
                                            <option class="bg-white" value="M">M</option>
                                            <option class="bg-white" value="F">F</option>
                                        </select>
                                        <label class="text-danger">
                                            @error('taxColSex')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>

                                <div id="client-type-spouse" class="row d-none">
                                    <div class="col-md-4">
                                        <label class="text-light" for="taxColSpouses">Spouses</label>
                                        <input type="text" name="taxColSpouses" class="form-control mb-0 bg-white text-dark"
                                            id="taxColSpouses">
                                        <label class="text-danger">
                                            @error('taxColSpouses')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>

                                <div id="client-type-company" class="row d-none">
                                    <div class="col-md-4">
                                        <label class="text-light" for="taxColCompany">Company</label>
                                        <input type="text" name="taxColCompany" class="form-control mb-0 bg-white text-dark"
                                            id="taxColCompany">
                                        <label class="text-danger">
                                            @error('taxColCompany')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
    
                                <div id="client-type-contractor" class="row d-none">
                                    <div class="col-md-4">
                                        <label class="text-light" for="taxColBusinessName">Business Name</label>
                                        <input type="text" name="taxColBusinessName" class="form-control mb-0 bg-white text-dark"
                                            id="taxColBusinessName">
                                        <label class="text-danger">
                                            @error('taxColBusinessName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="text-light" for="taxColOwner">Owner</label>
                                        <input type="text" name="taxColOwner" class="form-control mb-0 bg-white text-dark"
                                            id="taxColOwner">
                                        <label class="text-danger">
                                            @error('taxColOwner')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr class="bg-white">

                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-light" for="taxColTransaction">Transaction Type</label>
                                    <select class="form-control bg-white text-dark" name="taxColTransaction"
                                        id="taxColTransaction">
                                        <option class="bg-white" value="null"></option>
                                        <option class="bg-white" selected value="Cash">Cash</option>
                                        <option class="bg-white" value="Check">Check</option>
                                        <option class="bg-white" value="Money Order">Money Order</option>
                                        <option class="bg-white" value="ADA-LBP">ADA-LBP</option>
                                        <option class="bg-white" value="Bank Deposit/Transer">Bank Deposit/Transer
                                        </option>
                                    </select>
                                    <label class="text-danger">
                                        @error('taxColTransaction')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-3">
                                    <label class="text-light" for="taxColBank">Bank Name</label>
                                    <input readonly type="text" name="taxColBank"
                                        class="edit-trigger form-control mb-0 text-dark" id="taxColBank">
                                    <label class="text-danger">
                                        @error('taxColBank')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-3">
                                    <label class="text-light" for="taxColNumber">Number</label>
                                    <input readonly type="text" name="taxColNumber"
                                        class="edit-trigger form-control mb-0 text-dark" id="taxColNumber">
                                    <label class="text-danger">
                                        @error('taxColNumber')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-3">
                                    <label class="text-light" for="taxColTransactDate">Date of Transaction</label>
                                    <input readonly type="text" name="taxColTransactDate"
                                        class="edit-trigger datepicker form-control mb-0 text-dark" id="taxColTransactDate">
                                    <label class="text-danger">
                                        @error('taxColTransactDate')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-9">
                                    <label class="text-light" for="taxColBankRemarks">Bank Remarks</label>
                                    <textarea id="taxColBankRemarks" name="taxColBankRemarks"></textarea>
                                    <label class="text-danger">
                                        @error('taxColBankRemarks')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="text-light" for="taxColCert">With Certificate</label>
                                    <select class="form-control bg-white text-dark" name="taxColCert" id="taxColCert">
                                        <option class="bg-white" value=""></option>
                                        <option class="bg-white" selected value="None">None</option>
                                        <option class="bg-white" value="Transfer Tax">Transfer Tax</option>
                                        <option class="bg-white" value="Sand & Gravel">Sand & Gravel</option>
                                        <option class="bg-white" value="Provincial Permit">Provincial Permit</option>
                                        <!-- <option class="bg-white" value="Sand & Gravel Cert">Sand & Gravel Certification</option> -->
                                    </select>
                                    <label class="text-danger">
                                        @error('taxColCert')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                            </div>

                            <hr class="bg-white">

                            <div class="row account" id="account">
                                <div class="col-md-12">
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
                                                            class="btn btn-info btn-sm">Add
                                                            Row</button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="inputRow">
                                                <tr>
                                                    <td class="d-none">
                                                        <input type="text" id="taxColAccountID" name="taxColAccountID"
                                                            class="taxColAccountID form-control mb-0 bg-white text-dark">
                                                        <label class="text-danger">
                                                            @error('taxColAccountID')
                                                                {{ $message }}
                                                            @enderror
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="taxColAccount[]"
                                                            class="taxColAccount form-control mb-0 bg-white text-dark">
                                                        <label class="text-danger">
                                                            @error('taxColAccount')
                                                                {{ $message }}
                                                            @enderror
                                                        </label>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        <input readonly type="text" name="taxColTypeRate[]"
                                                            class="d-none taxColTypeRate bg-light form-control mb-0 text-dark">
                                                        <label class="text-danger">
                                                            @error('taxColTypeRate')
                                                                {{ $message }}
                                                            @enderror
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <input readonly type="text" name="taxColQuantity[]"
                                                            class="d-none taxColQuantity bg-light form-control mb-0 text-dark">
                                                        <label class="text-danger">
                                                            @error('taxColQuantity')
                                                                {{ $message }}
                                                            @enderror
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="taxColNature[]"
                                                            class="taxColNature form-control mb-0 bg-white text-dark">
                                                        <label class="text-danger">
                                                            @error('taxColNature')
                                                                {{ $message }}
                                                            @enderror
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="taxColAmount[]"
                                                            class="taxColAmount form-control mb-0 bg-white text-dark">
                                                        <label class="text-danger">
                                                            @error('taxColAmount')
                                                                {{ $message }}
                                                            @enderror
                                                        </label>
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
                                                        <label class="text-danger">
                                                            @error('taxColTotal')
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

                            <div id="remarks" class="row mt-5">
                                <div class="col-md-12">
                                    <label class="text-light" for="taxColReceiptRemarks">Receipt Remarks</label>
                                    <textarea id="taxColReceiptRemarks" name="taxColReceiptRemarks"></textarea>
                                    <label class="text-danger">
                                        @error('taxColReceiptRemarks')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="setNewData" class="btn btn-primary">Save</button>
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
                            <div class="col-md-3">
                                <label for="certID">Cert ID</label>
                                <input type="text" name="certID" class="form-control mb-0 bg-white text-dark"
                                    id="certID">
                                <label class="text-danger">
                                    @error('certID')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="text-light" for="certUser">User</label>
                                <input readonly type="text" name="certUser" class="bg-light form-control mb-0 text-dark"
                                    id="certUser">
                                <label class="text-danger">
                                    @error('certUser')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-1">
                                <label class="text-light" for="certAFType">AF Type</label>
                                <input readonly type="text" name="certAFType" class="bg-light form-control mb-0 text-dark"
                                    id="certAFType">
                                <label class="text-danger">
                                    @error('certAFType')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            

                            <div class="col-md-2">
                                <label class="text-light" for="certSerialNumber">Serial Number</label>
                                <input readonly type="text" name="certSerialNumber"
                                    class="bg-light form-control mb-0 text-dark" id="certSerialNumber">
                                <label class="text-danger">
                                    @error('certSerialNumber')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label class="text-light" for="certClientType">Client Type</label>
                                <input readonly type="text" name="certClientType" class="bg-light form-control mb-0 text-dark"
                                    id="certClientType">
                                <label class="text-danger">
                                    @error('certClientType')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label class="text-light" for="certMunicipality">Municipality</label>
                                <input readonly type="text" name="certMunicipality"
                                    class="bg-light form-control mb-0 text-dark" id="certMunicipality">
                                <label class="text-danger">
                                    @error('certMunicipality')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label class="text-light" for="certBaqrangay">Barangay</label>
                                <input readonly type="text" name="certBaqrangay" class="bg-light form-control mb-0 text-dark"
                                    id="certBaqrangay">
                                <label class="text-danger">
                                    @error('certBaqrangay')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="" target="_blank" id="print-cert-btn" class="btn btn-primary">Print Certificate</a>
                            </div>
                        </div>
                        <hr class="bg-white">
                        <div class="row">
                            <div class="col-md-2 d-none">
                                <label class="text-light" for="land_tax_info_id">Land Tax ID</label>
                                <input readonly type="text" name="land_tax_info_id" class="bg-light form-control mb-0 text-dark"
                                    id="land_tax_info_id">
                                <label class="text-danger">
                                    @error('land_tax_info_id')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
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
                                <label class="text-danger">
                                    @error('certType')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="certDate">Date</label>
                                <input readonly type="text" name="certDate"
                                    class="bg-light datepicker form-control mb-0 text-dark" id="certDate">
                                <label class="text-danger">
                                    @error('certDate')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="certPreparedBy">Treasurer Signee PREPARED BY:</label>
                                <select class="form-control bg-white text-dark" name="certPreparedBy" id="certPreparedBy">
                                    <option class="bg-white" value="null"></option>
                                    @foreach ($displayOfficers as $officer)
                                        <option class="bg-white" value="{{ $officer->id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                    @endforeach
                                </select>
                                <label class="text-danger">
                                    @error('certPreparedBy')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="certSignee">Treasurer Signee</label>
                                <select class="form-control bg-white text-dark" name="certSignee" id="certSignee">
                                    <option class="bg-white" value="null"></option>
                                    @foreach ($displayOfficers as $officer)
                                        <option class="bg-white" value="{{ $officer->id }}">{{ $officer->name }} - {{ $officer->position }}</option>
                                    @endforeach
                                </select>
                                <label class="text-danger">
                                    @error('certSignee')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label class="text-light" for="provGovernor">Provincial Governor</label>
                                <select class="form-control bg-white text-dark" name="provGovernor" id="provGovernor">
                                    <option class="bg-white" value="null"></option>
                                    <option class="bg-white" value="MELCHOR D. DICLAS, MD">MELCHOR D. DICLAS, MD</option>
                                </select>
                                <label class="text-danger">
                                    @error('provGovernor')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="certReipient">Recipient</label>
                                <input type="text" name="certReipient" class="bg-white form-control mb-0 text-dark"
                                    id="certReipient">
                                <label class="text-danger">
                                    @error('certReipient')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="certAddress">Address</label>
                                <input type="text" name="certAddress" class="bg-white form-control mb-0 text-dark"
                                    id="certAddress">
                                <label class="text-danger">
                                    @error('certAddress')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label class="text-light" for="certEntriesFrom">Include Entries From</label>
                                <input type="text" name="certEntriesFrom" class="bg-white form-control mb-0 text-dark"
                                    id="certEntriesFrom">
                                <label class="text-danger">
                                    @error('certEntriesFrom')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label class="text-light" for="certEntriesTo">Include Entries To</label>
                                <input type="text" name="certEntriesTo" class="bg-white form-control mb-0 text-dark"
                                    id="certEntriesTo">
                                <label class="text-danger">
                                    @error('certEntriesTo')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-light" for="certDetails">Details</label>
                                <textarea id="certDetails" name="certDetails"></textarea>
                                <label class="text-danger">
                                    @error('certDetails')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="modal-title text-white" id="toBeFilledUp">TO BE FILLED UP</h3>
                            </div>
                        </div>

                        <div id="provincialPermit" class="row d-none">
                            <div class="col-md-3 d-none">
                                <label class="text-light" for="provCertId">provincialPermit ID (reference ID)</label>
                                @foreach ($acc_data as $cert_data)
                                <input type="text" name="provCertId" class="bg-white form-control mb-0 text-dark"
                                id="provCertId" value="{{ $cert_data->id }}">
                                @endforeach
                                
                                <label class="text-danger">
                                    @error('provCertId')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="provCertRequestor">Requestor</label>
                                <input type="text" name="provCertRequestor" class="bg-white form-control mb-0 text-dark"
                                    id="provCertRequestor">
                                <label class="text-danger">
                                    @error('provCertRequestor')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="provCertNote">Note</label>
                                <input type="text" name="provCertNote" class="bg-white form-control mb-0 text-dark"
                                    id="provCertNote">
                                <label class="text-danger">
                                    @error('provCertNote')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="provCertSignee">Governor Signee</label>
                                <select class="form-control bg-white text-dark" name="provCertSignee" id="provCertSignee">
                                    <option class="bg-white" value=""></option>
                                    <option class="bg-white" value="Provincial Governor">Provincial Governor</option>
                                    <option class="bg-white" value="Acting Provincial Governor">Acting Provincial Governor</option>
                                </select>
                                <label class="text-danger">
                                    @error('provCertSignee')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="provCertClearance">Clearance Number</label>
                                <input type="text" name="provCertClearance" class="bg-white form-control mb-0 text-dark"
                                    id="provCertClearance">
                                <label class="text-danger">
                                    @error('provCertClearance')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="provCertType">Type</label>
                                <select class="form-control bg-white text-dark" name="provCertType" id="provCertType">
                                    <option class="bg-white" value=""></option>
                                    <option class="bg-white" value="New">New</option>
                                    <option class="bg-white" value="Renewal">Renewal</option>
                                </select>
                                <label class="text-danger">
                                    @error('provCertType')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="provCertBidding">For Bidding?</label>
                                <select class="form-control bg-white text-dark" name="provCertBidding" id="provCertBidding">
                                    <option class="bg-white" value=""></option>
                                    <option class="bg-white" value="1">Yes</option>
                                    <option class="bg-white" value="0">No</option>
                                </select>
                                <label class="text-danger">
                                    @error('provCertBidding')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <hr class="bg-white">

                        <div id="provPermitAdditional" class="row d-none">
                            <div class="col-md-12">
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
                                                    <label class="text-danger">
                                                        @error('provFeeCharge')
                                                            {{ $message }}
                                                        @enderror
                                                    </label>
                                                </td>
                                                <td>
                                                    <input type="text" name="provAmount[]"
                                                        class="provAmount bg-white form-control mb-0 text-dark">
                                                    <label class="text-danger">
                                                        @error('provAmount')
                                                            {{ $message }}
                                                        @enderror
                                                    </label>
                                                </td>
                                                <td>
                                                    <input type="text" name="provORNumber[]"
                                                        class="provORNumber bg-white form-control mb-0 text-dark">
                                                    <label class="text-danger">
                                                        @error('provORNumber')
                                                            {{ $message }}
                                                        @enderror
                                                    </label>
                                                </td>
                                                <td>
                                                    <input type="text" name="provDate[]"
                                                        class="provDate bg-white datepicker form-control mb-0 text-dark">
                                                    <label class="text-danger">
                                                        @error('provDate')
                                                            {{ $message }}
                                                        @enderror
                                                    </label>
                                                </td>
                                                <td>
                                                    <input type="text" name="provInitials[]"
                                                        class="provInitials bg-white form-control mb-0 text-dark">
                                                    <label class="text-danger">
                                                        @error('provInitials')
                                                            {{ $message }}
                                                        @enderror
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="transferTax" class="row d-none">
                            <div class="col-md-12">
                                <label class="text-light" for="notaryPublic">Notary Public</label>
                                <textarea id="notaryPublic" class="tinymce" name="notaryPublic"></textarea>
                                <label class="text-danger">
                                    @error('notaryPublic')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label class="text-light" for="ptrNumber">PTR Number</label>
                                <input type="text" name="ptrNumber" class="bg-white form-control mb-0 text-dark"
                                    id="ptrNumber">
                                <label class="text-danger">
                                    @error('ptrNumber')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label class="text-light" for="docNumber">Doc. Number</label>
                                <input type="text" name="docNumber" class="bg-white form-control mb-0 text-dark"
                                    id="docNumber">
                                <label class="text-danger">
                                    @error('docNumber')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label class="text-light" for="pageNumber">Page Number</label>
                                <input type="text" name="pageNumber" class="bg-white form-control mb-0 text-dark"
                                    id="pageNumber">
                                <label class="text-danger">
                                    @error('pageNumber')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label class="text-light" for="bookNumber">Book Number</label>
                                <input type="text" name="bookNumber" class="bg-white form-control mb-0 text-dark"
                                    id="bookNumber">
                                <label class="text-danger">
                                    @error('bookNumber')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label class="text-light" for="certSeries">Series</label>
                                <input type="text" name="certSeries" class="bg-white form-control mb-0 text-dark" id="certSeries">
                                <label class="text-danger">
                                    @error('certSeries')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label class="text-light" for="refNumber">Reference Number</label>
                                <input type="text" name="refNumber" class="bg-white form-control mb-0 text-dark"
                                    id="refNumber">
                                <label class="text-danger">
                                    @error('refNumber')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div id="sandAndGravel" class="row d-none">
                            <div class="col-md-3">
                                <label class="text-light" for="sgRequestor">Requestor</label>
                                <input type="text" name="sgRequestor" class="bg-white form-control mb-0 text-dark"
                                    id="sgRequestor">
                                <label class="text-danger">
                                    @error('sgRequestor')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="sgAddress">Requestor Address</label>
                                <input type="text" name="sgAddress" class="bg-white form-control mb-0 text-dark"
                                    id="sgAddress">
                                <label class="text-danger">
                                    @error('sgAddress')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="sgSex">Requestor Sex</label>
                                <select class="form-control bg-white text-dark" name="sgSex" id="sgSex">
                                    <option class="bg-white" value="null"></option>
                                    <option class="bg-white" value="Male">Male</option>
                                    <option class="bg-white" value="Female">Female</option>
                                </select>
                                <label class="text-danger">
                                    @error('sgSex')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="sgType">Type</label>
                                <select class="form-control bg-white text-dark" name="sgType" id="sgType">
                                    <option class="bg-white" value=""></option>
                                    <option class="bg-white" value="Full">Full</option>
                                    <option class="bg-white" value="Partial">Partial</option>
                                </select>
                                <label class="text-danger">
                                    @error('sgType')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="sgProcessed">Less: Sand and Gravel (processed)</label>
                                <input type="text" name="sgProcessed" class="bg-white form-control mb-0 text-dark"
                                    id="sgProcessed">
                                <label class="text-danger">
                                    @error('sgProcessed')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="aggBaseCourse">Less: Aggregate Base Course</label>
                                <input type="text" name="aggBaseCourse" class="bg-white form-control mb-0 text-dark"
                                    id="aggBaseCourse">
                                <label class="text-danger">
                                    @error('aggBaseCourse')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>


                            <div class="col-md-3">
                                <label class="text-light" for="lessSandAndGravel">Less: Sand and Gravel</label>
                                <input type="text" name="lessSandAndGravel" class="bg-white form-control mb-0 text-dark"
                                    id="lessSandAndGravel">
                                <label class="text-danger">
                                    @error('lessSandAndGravel')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="lessBoulders">Less: Boulders</label>
                                <input type="text" name="lessBoulders" class="bg-white form-control mb-0 text-dark"
                                    id="lessBoulders">
                                <label class="text-danger">
                                    @error('lessBoulders')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            

                <!-- MODAL FOOTER -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="save-cert-btn" class="btn btn-primary ">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF NO CERTIFICATION MODAL -->

    <!-- RECEIPT MODAL -->
    <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h3 class="text-white modal-title" id="receipttModalTitle">Details</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="receipt_form" id="receipt_form" method="post" action="{{ url('receipt_form') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="text-light" for="receiptUser">User</label>
                                    <input readonly type="text" name="receiptUser" class="bg-light form-control mb-0 text-dark"
                                        id="receiptUser">
                                    <label class="text-danger">
                                        @error('receiptUser')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-1">
                                    <label class="text-light" for="receiptAFType">AF Type</label>
                                    <input readonly type="text" name="receiptAFType"
                                        class="bg-light form-control mb-0 text-dark" id="receiptAFType">
                                    <label class="text-danger">
                                        @error('receiptAFType')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-2">
                                    <label class="text-light" for="receiptSerielNo">Serial No.</label>
                                    <input readonly type="text" name="receiptSerielNo"
                                        class="bg-light form-control mb-0 text-dark" id="receiptSerielNo">
                                    <label class="text-danger">
                                        @error('receiptSerielNo')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-3">
                                    <label class="text-light" for="receiptPayor">Payor/Customer</label>
                                    <input readonly type="text" name="receiptPayor"
                                        class="bg-light form-control mb-0 text-dark" id="receiptPayor">
                                    <label class="text-danger">
                                        @error('receiptPayor')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-2">
                                    <label class="text-light" for="receiptClientType">Client Type</label>
                                    <input readonly type="text" name="receiptClientType"
                                        class="bg-light form-control mb-0 text-dark" id="receiptClientType">
                                    <label class="text-danger">
                                        @error('receiptClientType')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-2">
                                    <label class="text-light" for="receiptDate">Date</label>
                                    <input readonly type="text" name="receiptDate"
                                        class="bg-light datepicker form-control mb-0 text-dark" id="receiptDate">
                                    <label class="text-danger">
                                        @error('receiptDate')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label class="text-light" for="receiptMunicipality">Municipality</label>
                                    <input readonly type="text" name="receiptMunicipality"
                                        class="bg-light form-control mb-0 text-dark" id="receiptMunicipality">
                                    <label class="text-danger">
                                        @error('receiptMunicipality')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="text-light" for="receiptBarangay">Barangay</label>
                                    <input readonly type="text" name="receiptBarangay"
                                        class="bg-light form-control mb-0 text-dark" id="receiptBarangay">
                                    <label class="text-danger">
                                        @error('receiptBarangay')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="text-light" for="receiptTransactType">Transaction Type</label>
                                    <input readonly type="text" name="receiptTransactType"
                                        class="bg-light form-control mb-0 text-dark" id="receiptTransactType">
                                    <label class="text-danger">
                                        @error('receiptTransactType')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="text-light" for="receiptBankName">Bank Name</label>
                                    <input readonly type="text" name="receiptBankName"
                                        class="bg-light form-control mb-0 text-dark" id="receiptBankName">
                                    <label class="text-danger">
                                        @error('receiptBankName')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="text-light" for="receiptNumber">Number</label>
                                    <input readonly type="text" name="receiptNumber"
                                        class="bg-light form-control mb-0 text-dark" id="receiptNumber">
                                    <label class="text-danger">
                                        @error('receiptNumber')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="text-light" for="receiptTransactDate">Date of Transaction</label>
                                    <input readonly type="text" name="receiptTransactDate"
                                        class="bg-light datepicker form-control mb-0 text-dark" id="receiptTransactDate">
                                    <label class="text-danger">
                                        @error('receiptTransactDate')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label class="text-light" for="receiptRemark">Remark</label>
                                    <input readonly type="text" name="receiptRemark"
                                        class="bg-light form-control mb-0 text-dark" id="receiptRemark">
                                    <label class="text-danger">
                                        @error('receiptRemark')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-2">
                                    <label class="text-light" for="receiptStatus">Status</label>
                                    <input readonly type="text" name="receiptStatus"
                                        class="bg-light form-control mb-0 text-dark" id="receiptStatus">
                                    <label class="text-danger">
                                        @error('receiptStatus')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-5"></div>

                                <div class="col-md-3">
                                    <p>Test</p>
                                    <button type="button" class="float-right btn btn-danger btn-md">Cancel Receipt</button>
                                </div>
                            </div>

                            <hr class="bg-white">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table tablesorter" id="receipt-table">
                                            <thead>
                                                <tr>
                                                    <th class="bg-dark">Nature</th>
                                                    <th class="bg-dark float-right">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody id="receiptRow">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="" target="_blank" id="print-receipt-btn" class="btn btn-primary">Print</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF RECEIPT MODAL -->
    
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
                    <form id="percent_form" class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 d-none">
                                <label class="text-light" for="percentRowIndex">Row Index</label>
                                <input type="text" id="percentRowIndex" name="percentRowIndex"
                                    class="form-control mb-0 bg-white text-dark">
                                <label class="text-danger">
                                    @error('percentRowIndex')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="percentRate">Rate(%)</label>
                                <input readonly type="text" name="percentRate" class="bg-light form-control mb-0 text-dark"
                                    id="percentRate">
                                <label class="text-danger">
                                    @error('percentRate')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="percentOf">of(%)</label>
                                <input type="text" name="percentOf" class="bg-white form-control mb-0 text-dark"
                                    id="percentOf">
                                <label class="text-danger">
                                    @error('percentOf')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="percentAmount">Amount</label>
                                <input type="text" name="percentAmount" id="percentAmount" class="bg-white form-control mb-0 text-dark">
                                <label class="text-danger">
                                    @error('percentAmount')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row withSpouse">
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label class="text-light">With Surviving Spouse<input id="survivingSpouse" type="checkbox"
                                            value="1"></label>
                                </div>
                            </div>
                        </div>

                        <div class="row notarytDate d-none">
                            <div class="col-md-4">
                                <label class="text-light" for="notaryDate">Notary Date (mm/dd/yyyy)</label>
                                <input type="text" name="notaryDate" class="bg-white datepenalty form-control mb-0 text-dark" id="notaryDate">
                                <label class="text-danger">
                                    @error('notaryDate')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="numOfMonths">NO. Month/s</label>
                                <input readonly type="text" name="numOfMonths" class="bg-light form-control mb-0 text-dark" id="numOfMonths">
                                <label class="text-danger">
                                    @error('numOfMonths')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row noneFines d-none">
                            <div class="col-md-4">
                                <label class="text-light" for="dateOfPenalty">Deadline (mm/dd/yyyy)</label>
                                <input type="text" name="dateOfPenalty" class="bg-white datepenalty form-control mb-0 text-dark" id="dateOfPenalty">
                                <label class="text-danger">
                                    @error('dateOfPenalty')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="ratePerMonth">Rate per month</label>
                                <input readonly type="text" name="ratePerMonth" class="bg-light form-control mb-0 text-dark" id="ratePerMonth">
                                <label class="text-danger">
                                    @error('ratePerMonth')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="calculatedRate">Calculated Rate</label>
                                <input readonly type="text" name="calculatedRate" class="bg-light form-control mb-0 text-dark" id="calculatedRate">
                                <label class="text-danger">
                                    @error('calculatedRate')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-light" for="percentValue">Value</label>
                                <input readonly type="text" name="percentValue" class="bg-light form-control mb-0 text-dark"
                                    id="percentValue">
                                <label class="text-danger">
                                    @error('percentValue')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-12 d-none">
                                <label class="text-light" for="percentOfValue">Percent of Status</label>
                                <input readonly type="text" name="percentOfValue" class="bg-light form-control mb-0 text-dark"
                                    id="percentOfValue">
                                <label class="text-danger">
                                    @error('percentOfValue')
                                        {{ $message }}
                                    @enderror
                                </label>
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
                    <form id="sched_form" class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 d-none">
                                <label class="text-light" for="schedRowIndex">Row Index</label>
                                <input type="text" id="schedRowIndex" name="schedRowIndex"
                                    class="form-control mb-0 bg-white text-dark">
                                <label class="text-danger">
                                    @error('schedRowIndex')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-12">
                                <label class="text-light" for="schedAuto">Schedules</label>
                                <input type="text" id="schedAuto" name="schedAuto"
                                    class="form-control mb-0 bg-white text-dark">
                                <label class="text-danger">
                                    @error('schedAuto')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="text-light" for="schedVolume">Quantity</label>
                                <input type="text" id="schedVolume" name="schedVolume"
                                    class="form-control mb-0 bg-white text-dark">
                                <label class="text-danger">
                                    @error('schedVolume')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="schedUnitCost">Unit</label>
                                <input readonly type="text" id="schedUnitCost" name="schedUnitCost"
                                    class="form-control mb-0 bg-light text-dark">
                                <label class="text-danger">
                                    @error('schedUnitCost')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="schedValue">Cost</label>
                                <input readonly type="text" id="schedValue" name="schedValue"
                                    class="form-control mb-0 bg-light text-dark">
                                <label class="text-danger">
                                    @error('schedValue')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="schedTotal">Total Value</label>
                                <input readonly type="text" id="schedTotal" name="schedTotal"
                                    class="form-control mb-0 bg-light text-dark">
                                <label class="text-danger">
                                    @error('schedTotal')
                                        {{ $message }}
                                    @enderror
                                </label>
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
                <h1 class="card-title">Field Land Tax Collection</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <button type="button" id="addTaxColBtn" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- START OF LEGEND -->
                            <fieldset>
                                <h3 class="modal-title text-white" id="toBeFilledUp">LEGEND:</h3>
                                <button type="button" rel="tooltip" class="float-left edit btn btn-info btn-sm btn-round btn-icon">
                                    <i class="tim-icons icon-molecule-40"></i>
                                </button>
                                <h4 class="float-left mt-2 ml-2">Certificates</h4>
                                <button type="button" rel="tooltip" class="float-left ml-2 edit btn btn-info btn-sm btn-round btn-icon">
                                    <i class="tim-icons icon-paper"></i>
                                </button>
                                <h4 class="float-left mt-2 ml-2">Receipts</h4>
                            </fieldset>
                            <!-- END OF LEGEND -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
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
                                                <th class="bg-dark">Form</th>
                                                <th class="bg-dark">Serial</th>
                                                <th class="bg-dark">Serial Number</th>
                                                <th class="bg-dark">Data Entry</th>
                                                <th class="bg-dark">Customer/Payor</th>
                                                <th class="bg-dark">Transaction Type</th>
                                                <th class="bg-dark">Certificate</th>
                                                <th class="bg-dark">Status</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
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
        $('.datepenalty').flatpickr({
            dateFormat: 'm/d/Y',
        });

        $('.datepicker').flatpickr({
            dateFormat: 'M d, Y',
        });

        $('.currentDate').flatpickr({
            enableTime: true,
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
            toolbar: 'undo redo | styleselect | forecolor | bold underline italic | alignleft aligncenter alignright alignjustify | fontsizeselect | outdent indent | link image | code'
        });

        tinymce.init({
            selector: '#notaryPublic',
            toolbar: 'undo redo | styleselect | forecolor | bold underline italic | alignleft aligncenter alignright alignjustify | fontsizeselect | outdent indent | link image | code'
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

        $('#addTaxColBtn').on('click', function() {
            $('#land_tax_form')[0].reset();
            $('.modal').css('overflow-y', 'auto');
            $('.edit-trigger').attr('readonly', true);
            $('.edit-trigger').removeClass('bg-white');
            $('.newRow').remove();
            $.ajax({
                method: "POST",
                url: "{{ route('getCurrentSerial') }}",
                async: false,
                data: {
                    id: $(this).val()
                }
            }).done(function(data) {
                if (data == 'Serial Error') {
                    Swal.fire('Please assign new serial', '', 'info');
                } else {
                    $('#serialNumber').val(data);
                    $('#series-counter').html(data);
                    $('#addTaxColModal').modal('show');
                }
            });
            $('#client-type-separator').addClass('d-none');
            $('#client-type-individual').addClass('d-none');
            $('#client-type-contractor').addClass('d-none');
            $('#client-type-others').addClass('d-none');
            $('#client-type-spouse').addClass('d-none');
            $('#client-type-company').addClass('d-none');
            $('#addTaxColModalTitle').html('Add New Data');
            $('#currentDate').removeClass('d-none');
            $('#editCurrentDate').addClass('d-none');
        });
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let data = @json($displayTaxData);
        let message = @json(session('Message'));
        let table = null;
        if (message != null) {
            Swal.fire(message);
        }
        $(document).ready(function() {
            let radioVal = $('input[name="clientTypeRadio"]:checked').val();
            table = $('#land-tax-table').DataTable({
                data: data,
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'excel', 'pdf'
                // ],
                columns: [{
                        'data': 'main_id',
                        render: function(data, type, row) {
                            if (row.certificate == 'None') {
                                return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button type="button" rel="tooltip" class="receipt-btn btn btn-info btn-sm btn-round btn-icon"><i class="tim-icons icon-paper"></i></button>';
                            } else {
                                return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button type="button" rel="tooltip" class="certificate-btn btn btn-info btn-sm btn-round btn-icon"><i class="tim-icons icon-molecule-40"></i></button><button type="button" rel="tooltip" class="receipt-btn btn btn-info btn-sm btn-round btn-icon"><i class="tim-icons icon-paper"></i></button>';
                            }
                            
                        }
                    },
                    {
                        'data': 'pc_name'
                    },
                    {
                        'data': 'assigned_ip'
                    },
                    {
                        'data': 'af_type'
                    },
                    {
                        'data': 'start_serial'
                    },
                    {
                        'data': 'serial_number'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'owner',
                        render: function(data, type, row) {
                            if(row.client_types == 'Individual/Company') {
                                if(row.client_type_radio == 'Spouse'){
                                    return row.spouses;
                                } else if(row.client_type_radio == 'Company') {
                                    return row.company;
                                }
                                return row.last_name + ',' + ' ' + row.first_name + ' ' + row
                                .middle_initial;
                            } else {
                                return row.business_name;
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
                        'data': 'status',
                        render: function(data, type, row) {
                            if (row.status == 'Not Printed') {
                                return '<p style="color:red; font-weight:600">Not Printed</p>'
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
                        'data': 'date_created'
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
                    }
                ],
                "columnDefs": [{
                    "targets": [4, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33],
                    "visible": false
                }]
            });

            $('#land-tax-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                // var data1 = table.cells(idx, '').render('display');
                var originalData = table.cells(idx, '').data();
                var data = table.row( $(this).parents('tr') ).data();
                console.log(data);
                $('#addTaxColModal').modal('show');
                $('#taxColEditcurrentDate').val(data.date_created);
                $('#taxColID').val(originalData[0]);
                $('#taxColSeries').val(data.series_id);
                $('#serialNumber').val(data.serial_number);
                $('#taxColMunicipality').val(data.municipality_id);
                $('#taxColMunicipality').trigger('change');
                $('#taxColBarangay').val(data.barangay_id);
                $('#taxColSpouses').val(data.spouses);
                $('#taxColCompany').val(data.company);
                $('#taxColLastName').val(data.last_name);
                $('#taxColFirstName').val(data.first_name);
                $('#taxColMI').val(data.middle_initial);
                $('#taxColBusinessName').val(data.business_name);
                $('#taxColOwner').val(data.owner);
                $('#taxColClientType').val(data.client_types);
                $('#taxColSex').val(data.sex);
                $('#taxColTransaction').val(data.transact_type);
                $('#taxColBank').val(data.bank_name);
                $('#taxColNumber').val(data.number);
                $('#taxColTransactDate').val(data.transact_date);
                $('#taxColCert').val(data.certificate);
                
                $('#setNewData').html('Update');
                $('#clear-btn').removeClass('d-none');

                $('.edit-trigger').attr('readonly', false);
                $('.edit-trigger').addClass('bg-white');
                
                if ($('#taxColClientType').val() == 'Individual/Company') {
                    $('#client-type-others').removeClass('d-none');
                    if (data.client_type_radio == 'Individual') {
                        $('#individualRadio').prop('checked', true);
                        $('#client-type-individual').removeClass('d-none');
                        $('#client-type-contractor').addClass('d-none');
                        $('#client-type-spouse').addClass('d-none');
                        $('#client-type-company').addClass('d-none');
                        $('#taxColMunicipality').attr('readonly', true);
                        $('#taxColMunicipality').removeClass('bg-white');
                        $('#taxColMunicipality').val('');
                        $('#taxColBarangay').attr('readonly', true);
                        $('#taxColBarangay').removeClass('bg-white');
                        $('#taxColBarangay').val('');
                    } else if (data.client_type_radio == 'Spouse') {
                        $('#spousesRadio').prop('checked', true);
                        $('#client-type-individual').addClass('d-none');
                        $('#client-type-contractor').addClass('d-none');
                        $('#client-type-spouse').removeClass('d-none');
                        $('#client-type-company').addClass('d-none');
                        $('#taxColMunicipality').attr('readonly', true);
                        $('#taxColMunicipality').removeClass('bg-white');
                        $('#taxColMunicipality').val('');
                        $('#taxColBarangay').attr('readonly', true);
                        $('#taxColBarangay').removeClass('bg-white');
                        $('#taxColBarangay').val('');
                    } else if (data.client_type_radio == 'Company') {
                        $('#companyRadio').prop('checked', true);
                        $('#client-type-individual').addClass('d-none');
                        $('#client-type-contractor').addClass('d-none');
                        $('#client-type-spouse').addClass('d-none');
                        $('#client-type-company').removeClass('d-none');
                        $('#taxColMunicipality').attr('readonly', true);
                        $('#taxColMunicipality').removeClass('bg-white');
                        $('#taxColMunicipality').val('');
                        $('#taxColBarangay').attr('readonly', true);
                        $('#taxColBarangay').removeClass('bg-white');
                        $('#taxColBarangay').val('');
                    }
                } else {
                    $('#client-type-contractor').removeClass('d-none');
                    $('#client-type-others').addClass('d-none');
                    $('#client-type-individual').addClass('d-none');
                    $('#client-type-spouse').addClass('d-none');
                    $('#client-type-company').addClass('d-none');
                    $('#taxColMunicipality').attr('readonly', false);
                    $('#taxColMunicipality').addClass('bg-white');
                    $('#taxColBarangay').attr('readonly', false);
                    $('#taxColBarangay').addClass('bg-white');
                }
                
                if ($('#taxColTransaction').val() == 'Cash') {
                    $('#taxColBank').addClass('bg-light').removeClass('bg-white');
                    $('#taxColBank').attr('readonly', true);
                    $('#taxColNumber').addClass('bg-light').removeClass('bg-white');
                    $('#taxColNumber').attr('readonly', true);
                    $('#taxColTransactDate').addClass('bg-light').removeClass('bg-white');
                    $('#taxColTransactDate').attr('readonly', true);
                }
                let taxColAcc = $('.taxColAccount')[0];
                let taxColNature = $('.taxColNature')[0];
                let taxColAmount = $('.taxColAmount')[0];
                let taxColTypeRate = $('.taxColTypeRate')[0];
                $(taxColAcc).val('');
                $(taxColNature).val('');
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
                }).done(function(data) {
                    let rowCount = data.length - 1;
                    if (data.length > 0) {
                        let taxColAcc = $('.taxColAccount')[0];
                        let taxColNature = $('.taxColNature')[0];
                        let taxColAmount = $('.taxColAmount')[0];
                        let taxColTypeRate = $('.taxColTypeRate')[0];
                        $(taxColAcc).val(data[0].account);
                        $(taxColNature).val(data[0].nature);
                        $(taxColAmount).val(data[0].amount);
                        $(taxColTypeRate).val(data[0].rate_type);

                        let total = parseFloat(data[0].amount);

                        for (let i = 1; i <= rowCount; i++) {
                            $('#addRowAccount').trigger('click');
                            taxColAcc = $('.taxColAccount')[i];
                            taxColNature = $('.taxColNature')[i];
                            taxColAmount = $('.taxColAmount')[i];
                            taxColTypeRate = $('.taxColTypeRate')[i];
                            total = parseFloat(data[i].amount) + total;
                            $(taxColAcc).val(data[i].account);
                            $(taxColNature).val(data[i].nature);
                            $(taxColAmount).val(data[i].amount);
                            $(taxColTypeRate).val(data[i].rate_type);
                        }
                        $('#taxColTotal').val(total);
                    }
                    $('.taxColAmount').trigger('keyup');
                    $('#taxColTotal').trigger('change');
                });
                $('#addTaxColModalTitle').html('Edit Receipt Data');
                $('#currentDate').addClass('d-none');
                $('#editCurrentDate').removeClass('d-none');
                tinymce.get("taxColReceiptRemarks").setContent(data.receipt_remarks);
                tinymce.get("taxColBankRemarks").setContent(data.bank_remarks);
                
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
            
            $('.certificate-btn tbody').on('click', '.certificate-btn', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                var originalData = table.cells(idx, '').data();
                $.ajax({
                    method: "POST",
                    url: "{{ route('getCertificateDetails') }}",
                    // async: false,
                    data: {
                        id: originalData[0]
                    }
                }).done(function(data) {
                    $('#certID').val(data.id);
                    $('#print-cert-btn').prop('href', 'getWordTemplate/' + data.land_tax_info_id);
                    $('#certPreparedBy').val(data.cert_prepared_by);
                    $('#certSignee').val(data.cert_signee);
                    $('#provGovernor').val(data.prov_governor);
                    $('#certAddress').val(data.cert_address);
                    $('#certEntriesFrom').val(data.cert_entries_from);
                    $('#certEntriesTo').val(data.cert_entries_to);
                    $('#ptrNumber').val(data.ptr_number);
                    $('#docNumber').val(data.doc_number);
                    $('#pageNumber').val(data.page_number);
                    $('#bookNumber').val(data.book_number);
                    $('#certSeries').val(data.cert_series);
                    $('#refNumber').val(data.ref_num);
                    $('#sgRequestor').val(data.sg_requestor);
                    $('#sgAddress').val(data.sg_address);
                    $('#sgSex').val(data.sg_sex);
                    $('#sgType').val(data.sg_type);
                    $('#sgProcessed').val(data.sg_processed);
                    $('#aggBaseCourse').val(data.agg_basecourse);
                    $('#lessSandAndGravel').val(data.less_sandandgravel);
                    $('#lessBoulders').val(data.less_boulders);
                    $('#provCertRequestor').val(data.prov_certrequestor);
                    $('#provCertNote').val(data.prov_certnote);
                    $('#provCertSignee').val(data.prov_certsignee);
                    $('#provCertClearance').val(data.prov_certclearance);
                    $('#provCertType').val(data.prov_certtype);
                    $('#provCertBidding').val(data.prov_certbidding);
                    tinymce.get("notaryPublic").setContent(data.notary_public);
                    
                });
                $('#land_tax_info_id').val(originalData[0]);
                // $('#sgRequestor').val(data[7]);
                $('#certType').val(data[9]);
                $('#certDate').datepicker('update', data[6]);
                $('#certUser').val(data[1]);
                $('#certAFType').val(data[3]);
                $('#certSerialNumber').val(data[4]);
                $('#certClientType').val(data[8]);
                $('#certMunicipality').val(data[11]);
                $('#certBaqrangay').val(data[12]);
                if (data[17] == 'Individual/Company') {
                    $('#certReipient').val(data[7]);
                } else {
                    $('#certReipient').val(data[16] + ' By: ' + data[25]);
                }
                tinymce.get("certDetails").setContent(data[24]);
                if ($('#certType').val() == 'Provincial Permit') {
                    $('#provincialPermit').removeClass('d-none');
                    $('#provPermitAdditional').removeClass('d-none');
                    $('#sandAndGravel').addClass('d-none');
                    $('#transferTax').addClass('d-none');
                } else if ($('#certType').val() == 'Transfer Tax') {
                    $('#transferTax').removeClass('d-none');
                    $('#sandAndGravel').addClass('d-none');
                    $('#provincialPermit').addClass('d-none');
                    $('#provPermitAdditional').addClass('d-none');
                } else if ($('#certType').val() == 'Sand & Gravel') {
                    $('#sandAndGravel').removeClass('d-none');
                    $('#transferTax').addClass('d-none');
                    $('#provincialPermit').addClass('d-none');
                    $('#provPermitAdditional').addClass('d-none');
                } else if ($('#certType').val() == 'null') {
                    $('#provincialPermit').addClass('d-none');
                    $('#provPermitAdditional').addClass('d-none');
                    $('#transferTax').addClass('d-none');
                    $('#sandAndGravel').addClass('d-none');
                }
                $('.newRow').remove();
                $('#certificateModal').modal('show');
            });
            
            $('.receipt-btn tbody').on('click', '.receipt-btn', function(e) {
                var idx = table.row($(this).parents('tr'));
                var originalData = table.cells(idx, '').data();
                $.ajax({
                    method: "POST",
                    url: "{{ route('getCollData') }}",
                    // async: false,
                    data: {
                        id: originalData[0]
                    }
                }).done(function(data) {
                    let accounts = data.get_nature;
                    let accessPc = data.parent_access_pc;
                    $('#receiptRow').html('');
                    let receiptRowHtml = '';    
                    accounts.forEach((value, index) => {
                        receiptRowHtml = receiptRowHtml + '<tr>';
                            receiptRowHtml = receiptRowHtml + '<td>' + value.nature + '</td>';
                            receiptRowHtml = receiptRowHtml + '<td class="float-right">' + value.amount.toLocaleString('en') + '</td>';
                        receiptRowHtml = receiptRowHtml + '</tr>';
                    });
                    receiptRowHtml = receiptRowHtml + '<tr>';
                        receiptRowHtml = receiptRowHtml + '<td style="font-size: 1.2em"><b>Total</b></td>';
                        receiptRowHtml = receiptRowHtml + '<td class="float-right">' + data.total_amount+ '</td>';
                    receiptRowHtml = receiptRowHtml + '</tr>';
                    $('#receiptRow').html(receiptRowHtml);
                    $('#receiptUser').val(accessPc.pc_name);
                    $('#receiptAFType').val(data.af_type);
                    $('#receiptSerielNo').val(data.serial_number);
                    if (data.client_type_id != '8') {
                        $('#receiptPayor').val(data.business_name + ' By: ' + data.owner);
                    } 

                    if (data.client_type_radio == 'Individual') {
                        $('#receiptPayor').val(data.last_name + ', ' + data.first_name + ' ' + data.middle_initial);
                    } else if (data.client_type_radio == 'Spouse') {
                        $('#receiptPayor').val(data.spouses);
                    } else if (data.client_type_radio == 'Company') {
                        $('#receiptPayor').val(data.company);
                    }
                    $('#receiptClientType').val(originalData[17]);
                    $('#receiptDate').val(data.created_at); 
                    $('#receiptMunicipality').val(data.parent_municipality.municipality);
                    $('#receiptBarangay').val(data.parent_barangay.barangay_name);
                    $('#receiptTransactType').val(data.transact_type);
                    $('#receiptBankName').val(data.bank_name);
                    $('#receiptNumber').val(data.number);
                    $('#receiptTransactDate').val(data.transact_date);
                    $('#receiptRemark').val(data.receipt_remarks);
                    $('#receiptStatus').val(data.status);
                });
                $('#print-receipt-btn').prop('href', 'printReceipt/' + originalData[0]);
                $('#print-receipt-btn').val($(this).parents('tr'));
                $('#receiptModal').modal('show');
            });
        });

        $('#taxColType').change(function () {
            Swal.fire({
                title: 'You are siwthcing to Field Land Tax Collection (Form 56). Do you wish to proceed',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Yes',
                icon: 'warning'
            })
        });

        $('#taxColClientType').change(function () {
            if ($('#taxColClientType').val() == '8') {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-individual').removeClass('d-none');
                $('#client-type-others').removeClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#taxColMunicipality').attr('readonly', true);
                $('#taxColMunicipality').removeClass('bg-white');
                $('#taxColMunicipality').val('');
                $('#taxColBarangay').attr('readonly', true);
                $('#taxColBarangay').removeClass('bg-white');
                $('#taxColBarangay').val('');
            } else if ($('#taxColClientType').val() == 'null') {
                $('#client-type-individual').addClass('d-none');
                $('#client-type-contractor').addClass('d-none');
                $('#client-type-separator').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#taxColMunicipality').attr('readonly', true);
                $('#taxColMunicipality').removeClass('bg-white');
                $('#taxColMunicipality').val('');
                $('#taxColBarangay').attr('readonly', true);
                $('#taxColBarangay').removeClass('bg-white');
                $('#taxColBarangay').val('');
            } else {
                $('#client-type-separator').removeClass('d-none');
                $('#client-type-contractor').removeClass('d-none');
                $('#client-type-individual').addClass('d-none');
                $('#client-type-others').addClass('d-none');
                $('#taxColMunicipality').attr('readonly', false);
                $('#taxColMunicipality').addClass('bg-white');
                $('#client-type-company').addClass('d-none');
                $('#client-type-spouse').addClass('d-none');
            }
        });

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
                }
            },
            change: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                    $(this).val('');
                    $('#taxColOwner').val('');
                }
            }
        }

        let trigger = 0;
        let autoCompleteData = [];
        var category_autocomplete = { // autocomplete for account titles
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
                        // let accountTitles = data.map(function(obj) {
                        //     return (obj.title_name)
                        // })
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
                        let ratePerMonth = 2.00;
                        $('#ratePerMonth').val(ratePerMonth.toFixed(2));
                        let amount = $('.taxColAmount').val();
                        $('#percentOfValue').val(ui.item.percent_of);
                        $('#percentRowIndex').val(myRow - 1);

                        if (ui.item.title == 'Fines & Penalties - Service Income (General Fund-Proper)') {
                            $('.withSpouse').addClass('d-none');
                            $('.noneFines').removeClass('d-none');
                            $('.notarytDate').addClass('d-none');
                            $('#dateOfPenalty').val('01/20/2022');
                            $('#percentAmount').val(amount);
                            let firstRow = $($('#inputRow').find('tr')[0]).find('td input')[2];
                            let dateOfPenalty = moment($('#dateOfPenalty').val(), 'MM/DD/YYYY');
                            let dateToday = moment();
                            let rate = 0;
                            let isValid = true;

                            if (dateOfPenalty.isSame(dateToday) || dateToday.isBefore(dateOfPenalty)) {
                                rate = 0;
                            } else {
                                let monthCount = 0;
                                rate = 0;
                                let originalCutOff = moment(dateOfPenalty);
                                let initialCutOff = moment(dateOfPenalty);
                                while (initialCutOff.isBefore(dateToday) || initialCutOff.isSame(dateToday)) {
                                    rate = rate + ratePerMonth;
                                    monthCount = monthCount + 1;
                                    initialCutOff = moment(dateOfPenalty).add(monthCount, 'Months');
                                    if (initialCutOff.format('dddd') == 'Saturday') {
                                        initialCutOff = moment(initialCutOff).add(2, 'day');
                                    }
                                    
                                    if (initialCutOff.format('dddd') == 'Sunday') {
                                        initialCutOff = moment(initialCutOff).add(1, 'day');
                                    }
                                }
                            }

                            $('#percentAmount').mask("#,000.00", {reverse: true});
                            let amountString = $('#percentAmount').val();
                            let value = parseFloat(amountString.replace(',', ''));
                            let firstEqu = 0.00;
                            firstEqu = value * ratePenalty;
                            firstResult = firstEqu + value;
                            SecondEqu = firstResult * rate / 100;
                            finalValue = firstEqu + SecondEqu;
                            givenValue = finalValue.toFixed(2);
                            val = $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            $('#calculatedRate').val(rate + '%');

                            $('#percentAmount').keyup(function () {
                                let amountString = $('#percentAmount').val();
                                let value = parseFloat(amountString.replace(',', ''));
                                let firstEqu = 0.00;
                                firstEqu = value * ratePenalty;
                                firstResult = firstEqu + value;
                                SecondEqu = firstResult * rate / 100;
                                finalValue = firstEqu + SecondEqu;
                                givenValue = finalValue.toFixed(2);
                                val = $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                $('#calculatedRate').val(rate + '%');
                            });

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
                                let firstRowAmount = $($('#inputRow').find('tr')[0]).find('td input')[4];
                                $('#percentAmount').val($(firstRowAmount).val());
                            }

                        } else if (ui.item.title == 'Fines & Penalties - Business Income (General Fund-Proper)') {
                            $('.withSpouse').addClass('d-none');
                            $('.noneFines').removeClass('d-none');
                            $('.notarytDate').addClass('d-none');
                            $('#dateOfPenalty').val('01/20/2022');
                            $('#percentAmount').val(amount);
                            let firstRow = $($('#inputRow').find('tr')[0]).find('td input')[2];
                            let dateOfPenalty = moment($('#dateOfPenalty').val(), 'MM/DD/YYYY');
                            let dateToday = moment();
                            let rate = 0;
                            let isValid = true;
                            
                            if (dateOfPenalty.isSame(dateToday) || dateToday.isBefore(dateOfPenalty)) {
                                rate = 0;
                            } else {
                                let monthCount = 0;
                                rate = 0;
                                let originalCutOff = moment(dateOfPenalty);
                                let initialCutOff = moment(dateOfPenalty);
                                while (initialCutOff.isBefore(dateToday) || initialCutOff.isSame(dateToday)) {
                                    rate = rate + ratePerMonth;
                                    monthCount = monthCount + 1;
                                    initialCutOff = moment(dateOfPenalty).add(monthCount, 'Months');
                                    if (initialCutOff.format('dddd') == 'Saturday') {
                                        initialCutOff = moment(initialCutOff).add(2, 'day');
                                    }
                                    
                                    if (initialCutOff.format('dddd') == 'Sunday') {
                                        initialCutOff = moment(initialCutOff).add(1, 'day');
                                    }
                                }
                            }

                            $('#percentAmount').mask("#,000.00", {reverse: true});
                            let amountString = $('#percentAmount').val();
                            let value = parseFloat(amountString.replace(',', ''));
                            let firstEqu = 0.00;
                            firstEqu = value * ratePenalty;
                            firstResult = firstEqu + value;
                            SecondEqu = firstResult * rate / 100;
                            finalValue = firstEqu  + SecondEqu;
                            givenValue = finalValue.toFixed(2);
                            $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            $('#calculatedRate').val(rate + '%');

                            $('#percentAmount').keyup(function () {
                                $('#percentAmount').mask("#,000.00", {reverse: true});
                                let amountString = $('#percentAmount').val();
                                let value = parseFloat(amountString.replace(',', ''));
                                let firstEqu = 0.00;
                                firstEqu = value * ratePenalty;
                                firstResult = firstEqu + value;
                                SecondEqu = firstResult * rate / 100;
                                finalValue = firstEqu  + SecondEqu;
                                givenValue = finalValue.toFixed(2);
                                $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                $('#calculatedRate').val(rate + '%');
                            });

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
                                let firstRowAmount = $($('#inputRow').find('tr')[0]).find('td input')[4];
                                $('#percentAmount').val($(firstRowAmount).val());
                            }

                        } else if (ui.item.title == 'Tax Revenue - Fines & Penalties - on Individual (PTR)') {
                            $('.withSpouse').addClass('d-none');
                            $('.noneFines').removeClass('d-none');
                            $('.notarytDate').addClass('d-none');
                            $('#dateOfPenalty').val('01/01/2022');
                            $('#percentAmount').val(amount);
                            let firstRow = $($('#inputRow').find('tr')[0]).find('td input')[2];
                            let dateOfPenalty = moment($('#dateOfPenalty').val(), 'MM/DD/YYYY');
                            let dateToday = moment();
                            let rate = 0;
                            let isValid = true;
                            
                            if (dateOfPenalty.isSame(dateToday) || dateToday.isBefore(dateOfPenalty)) {
                                rate = 0;
                            } else {
                                let monthCount = 0;
                                rate = 0;
                                let originalCutOff = moment(dateOfPenalty);
                                let initialCutOff = moment(dateOfPenalty);
                                while (initialCutOff.isBefore(dateToday) || initialCutOff.isSame(dateToday)) {
                                    rate = rate + ratePerMonth;
                                    monthCount = monthCount + 1;
                                    initialCutOff = moment(dateOfPenalty).add(monthCount, 'Months');
                                    if (initialCutOff.format('dddd') == 'Saturday') {
                                        initialCutOff = moment(initialCutOff).add(2, 'day');
                                    }
                                    
                                    if (initialCutOff.format('dddd') == 'Sunday') {
                                        initialCutOff = moment(initialCutOff).add(1, 'day');
                                    }
                                }
                            }

                            $('#percentAmount').mask("#,000.00", {reverse: true});
                            let amountString = $('#percentAmount').val();
                            let value = parseFloat(amountString.replace(',', ''));
                            let firstEqu = 0.00;
                            firstEqu = value * ratePenalty;
                            firstResult = firstEqu + value;
                            SecondEqu = firstResult * rate / 100;
                            finalValue = firstEqu  + SecondEqu;
                            givenValue = finalValue.toFixed(2);
                            $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            $('#calculatedRate').val(rate + '%');

                            $('#percentAmount').keyup(function () {
                                $('#percentAmount').mask("#,000.00", {reverse: true});
                                let amountString = $('#percentAmount').val();
                                let value = parseFloat(amountString.replace(',', ''));
                                let firstEqu = 0.00;
                                firstEqu = value * ratePenalty;
                                firstResult = firstEqu + value;
                                SecondEqu = firstResult * rate / 100;
                                finalValue = firstEqu  + SecondEqu;
                                givenValue = finalValue.toFixed(2);
                                $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                $('#calculatedRate').val(rate + '%');
                            });

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
                                let firstRowAmount = $($('#inputRow').find('tr')[0]).find('td input')[4];
                                $('#percentAmount').val($(firstRowAmount).val());
                            }

                        } else if (ui.item.title == 'Tax Revenue - Fines & Penalties - Goods & Services') {
                            $('.notarytDate').removeClass('d-none');
                            $('.noneFines').removeClass('d-none');
                            $('.withSpouse').addClass('d-none');
                            $('#dateOfPenalty').val('01/20/2022');
                            $('#percentAmount').val(amount);
                            let firstRow = $($('#inputRow').find('tr')[0]).find('td input')[2];
                            
                            let dateOfPenalty = moment($('#dateOfPenalty').val(), 'MM/DD/YYYY');
                            let dateToday = moment();
                            let rate = 0;
                            let isValid = true;
                            
                            if (dateOfPenalty.isSame(dateToday) || dateToday.isBefore(dateOfPenalty)) {
                                rate = 0;
                            } else {
                                let monthCount = 0;
                                rate = 0;
                                let originalCutOff = moment(dateOfPenalty);
                                let initialCutOff = moment(dateOfPenalty);
                                while (initialCutOff.isBefore(dateToday) || initialCutOff.isSame(dateToday)) {
                                    rate = rate + ratePerMonth;
                                    
                                    monthCount = monthCount + 1;
                                    initialCutOff = moment(dateOfPenalty).add(monthCount, 'Months');
                                    if (initialCutOff.format('dddd') == 'Saturday') {
                                        initialCutOff = moment(initialCutOff).add(2, 'day');
                                    }
                                    
                                    if (initialCutOff.format('dddd') == 'Sunday') {
                                        initialCutOff = moment(initialCutOff).add(1, 'day');
                                    }
                                }
                            }

                            $('#percentAmount').mask("#,000.00", {reverse: true});
                            let amountString = $('#percentAmount').val();
                            let value = parseFloat(amountString.replace(',', ''));
                            let firstEqu = 0.00;
                            firstEqu = value * ratePenalty;
                            firstResult = firstEqu + value;
                            SecondEqu = firstResult * rate / 100;
                            finalValue = firstEqu  + SecondEqu;
                            givenValue = finalValue.toFixed(2);
                            $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            $('#calculatedRate').val(rate + '%');

                            $('#percentAmount').keyup(function () {
                                $('#percentAmount').mask("#,000.00", {reverse: true});
                                let amountString = $('#percentAmount').val();
                                let value = parseFloat(amountString.replace(',', ''));
                                let firstEqu = 0.00;
                                firstEqu = value * ratePenalty;
                                firstResult = firstEqu + value;
                                SecondEqu = firstResult * rate / 100;
                                finalValue = firstEqu  + SecondEqu;
                                givenValue = finalValue.toFixed(2);
                                $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                $('#calculatedRate').val(rate + '%');
                            });

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
                                let firstRowAmount = $($('#inputRow').find('tr')[0]).find('td input')[4];
                                $('#percentAmount').val($(firstRowAmount).val());
                            }

                        } else if (ui.item.title == 'Tax Revenue - Fines & Penalties - Property Taxes') {
                            $('.notarytDate').removeClass('d-none');
                            $('.noneFines').removeClass('d-none');
                            $('.withSpouse').addClass('d-none');
                            $('#dateOfPenalty').val('01/20/2022');
                            $('#percentAmount').val(amount);
                            let firstRow = $($('#inputRow').find('tr')[0]).find('td input')[2];
                            let dateOfPenalty = moment($('#dateOfPenalty').val(), 'MM/DD/YYYY');
                            let dateToday = moment();
                            let rate = 0;
                            let isValid = true;
                            
                            if (dateOfPenalty.isSame(dateToday) || dateToday.isBefore(dateOfPenalty)) {
                                rate = 0;
                            } else {
                                let monthCount = 0;
                                rate = 0;
                                let originalCutOff = moment(dateOfPenalty);
                                let initialCutOff = moment(dateOfPenalty);
                                while (initialCutOff.isBefore(dateToday) || initialCutOff.isSame(dateToday)) {
                                    rate = rate + ratePerMonth;
                                    monthCount = monthCount + 1;
                                    initialCutOff = moment(dateOfPenalty).add(monthCount, 'Months');
                                    if (initialCutOff.format('dddd') == 'Saturday') {
                                        initialCutOff = moment(initialCutOff).add(2, 'day');
                                    }
                                    
                                    if (initialCutOff.format('dddd') == 'Sunday') {
                                        initialCutOff = moment(initialCutOff).add(1, 'day');
                                    }
                                }
                            }

                            $('#percentAmount').mask("#,000.00", {reverse: true});
                            let amountString = $('#percentAmount').val();
                            let value = parseFloat(amountString.replace(',', ''));
                            let firstEqu = 0.00;
                            firstEqu = value * ratePenalty;
                            firstResult = firstEqu + value;
                            SecondEqu = firstResult * rate / 100;
                            finalValue = firstEqu  + SecondEqu;
                            givenValue = finalValue.toFixed(2);
                            $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            $('#calculatedRate').val(rate + '%');

                            $('#percentAmount').keyup(function () {
                                $('#percentAmount').mask("#,000.00", {reverse: true});
                                let amountString = $('#percentAmount').val();
                                let value = parseFloat(amountString.replace(',', ''));
                                let firstEqu = 0.00;
                                firstEqu = value * ratePenalty;
                                firstResult = firstEqu + value;
                                SecondEqu = firstResult * rate / 100;
                                finalValue = firstEqu  + SecondEqu;
                                givenValue = finalValue.toFixed(2);
                                $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                $('#calculatedRate').val(rate + '%');
                            });

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
                                let firstRowAmount = $($('#inputRow').find('tr')[0]).find('td input')[4];
                                $('#percentAmount').val($(firstRowAmount).val());
                            }
                            
                        } else {
                            $('.noneFines').addClass('d-none');
                            $('.withSpouse').removeClass('d-none');
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

        $('#print-receipt-btn').click(function() {
            setTimeout(function () {
                location.reload(true);
            }, 1);
        });
        
        $('#dateOfPenalty').change(function() {
            let dateOfPenalty = moment($('#dateOfPenalty').val(), 'MM/DD/YYYY');
            let ratePerMonth = parseFloat($('#ratePerMonth').val());
            let dateToday = moment();
            let rate = 0;
            let isValid = true;
            if (dateOfPenalty.isSame(dateToday) || dateToday.isBefore(dateOfPenalty)) {
                rate = 0;
            } else {
                let monthCount = 0;
                rate = 0;
                let originalCutOff = moment(dateOfPenalty);
                let initialCutOff = moment(dateOfPenalty);
                while (initialCutOff.isBefore(dateToday) || initialCutOff.isSame(dateToday)) {
                    rate = rate + ratePerMonth;
                    monthCount = monthCount + 1;
                    initialCutOff = moment(dateOfPenalty).add(monthCount, 'Months');
                    if (initialCutOff.format('dddd') == 'Saturday') {
                        initialCutOff = moment(initialCutOff).add(2, 'day');
                    }
                    
                    if (initialCutOff.format('dddd') == 'Sunday') {
                        initialCutOff = moment(initialCutOff).add(1, 'day');
                    }
                }
            }
            $('#calculatedRate').val(rate + '%');

            let surcharge = $('#percentRate').val() / 100;
            $('#percentAmount').mask("#,000.00", {reverse: true});
            let amountString = $('#percentAmount').val();
            let value = parseFloat(amountString.replace(',', ''));
            let firstEqu = 0.00;
            firstEqu = value * surcharge;
            firstResult = firstEqu + value;
            SecondEqu = firstResult * rate / 100;
            finalValue = firstResult  + SecondEqu;
            givenValue = finalValue.toFixed(2);
            $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $(".taxColAccount").autocomplete(category_autocomplete).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#taxColBusinessName").autocomplete(business_name_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $('#taxColCert').change(function() {
            trigger = 1;
            let getVal = $('#taxColCert').val();
            let modalContent = $('#inputRowProvPermit').find('tr').last();
            let taxColAccount = $('.taxColAccount')[0];
            let taxColNature = $('.taxColNature')[0];
            let taxColAmmount = $('.taxColAmmount')[0];

            $(taxColNature).val("");
            $(taxColAmmount).val("");
            
            if (getVal == 'Transfer Tax') {
                $(taxColAccount).val('Real Property Transfer Tax');
                $(taxColAccount).trigger('focus');
                $('.noneFines').addClass('d-none');
                $('.notarytDate').addClass('d-none');
                $('.withSpouse').removeClass('d-none');
            }

            if (getVal == 'Sand & Gravel') {
                $(taxColAccount).val('Tax on Sand, Gravel & Other Quarry Prod.');
                $(taxColAccount).trigger('focus');
            }

            if (getVal == 'Provincial Permit') {
                $(taxColAccount).val('Permit Fees');
                $(taxColAccount).trigger('focus');
            }
        });

        $('#percentAmount').keyup(function () {
            $(this).mask("#,000.00", {reverse: true});
            let amountString = $(this).val();
            let amount = parseFloat(amountString.replace(',', ''));
            let ofValue = $('#percentOfValue').val();
            // if (ofValue == 'Given Value') {
                
            // } else if (ofValue == 'Total') {
            //     let total = 0.00;
            //     total = rate % $('#percentValue').val(); // Percent of Total
            //     total = total.toFixed(2);
            //     $('#percentValue').val(total.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            // }
            let givenValue = 0.00;
            givenValue = 0.005 * amount;
            
            givenValue = givenValue.toFixed(2);
            $('#percentValue').val(givenValue.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('#survivingSpouse').on('click', function() {
            let spouse = $('#percentValue').val();
            let amount = parseFloat(spouse.replace(',', ''));
            let resultSpouse = amount/2;
            $('#percentValue').val(resultSpouse);
            resultSpouse = resultSpouse.toFixed(2);
            $('#percentValue').val(resultSpouse.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('#percentOf').on('input', function () {
            $(this).mask("#,##0.00", {reverse: true});
        });

        $('#schedVolume').keyup(function() {
            $(this).mask("#,000.00", {reverse: true});
            let setVal = $(this).val();
            let getVal = parseFloat(setVal.replace(',', ''));
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
            var taxColTotal = $(row).find('td input')[5];
            var taxColNature = $(row).find('td input')[4];
            console.log(taxColNature);
            $(taxColQuantity).val($('#schedVolume').val());
            $(taxColTotal).val($('#schedTotal').val());
            $(taxColTotal).trigger('change');
            $(taxColNature).val($('#schedAuto').val());
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
            } else if ($(taxColAccount).val() == 'Fines & Penalties - on Individual (PTR)') {
                $(taxColNature).val('Surcharge & Interest');
            } else if ($(taxColAccount).val() == 'Tax Revenue-Fines & Pen - Goods & Services') {
                $(taxColNature).val('Surcharge & Interest');
            } else {
                $(taxColNature).val('Real Property Transfer Tax (Sale w/ SP of ' + $('#percentAmount').val() + ')');
            }
            $(taxColTotal).trigger('change');
            $('#percentModal').modal('hide');
        });

        let series = @json($serials);
        if (series.length > 0) {
            $('#taxColSeries').attr('readonly', false);
            $('#taxColSeries').addClass('bg-white');
        }

        $('#taxColMunicipality').change(function() {
            console.log($(this).val());
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
                    id: $(this).val()
                }
            }).done(function(data) {
                $('#taxColBarangay').html('<option class="bg-white" value=""></option>');
                data.forEach(element => {
                    $('#taxColBarangay').html($('#taxColBarangay').html() +
                        '<option class="bg-white" value="' + element.id + '">' + element.barangay_name + '</option>');
                });
            });
        });

        $('#addRowAccount').click(function() {
            var html = '';
            html += '<tr class="newRow">';
            html +=
                '<td class="d-none"><input type="text"name="taxColAccountID[]" class="taxColAccountID form-control mb-0 bg-white text-dark"><label class="text-danger">@error('taxColAccountID'){{ $message }}@enderror</label></td>';

            html += '<td>';
            html +=
                '<input type="text" name="taxColAccount[]" class="taxColAccount form-control mb-0 bg-white text-dark">';
            html += '<label class="text-danger">                @error('taxColAccount'){{ $message }} @enderror</label>';
            html += '</td>'

            html += '<td>';
            html += '</td>';

            html += '<td>';
            html +=
                '<input readonly type="text" name="taxColTypeRate[]"class="d-none taxColTypeRate form-control mb-0 bg-light text-dark"><label class="text-danger">    @error('taxColTypeRate'){{ $message }}@enderror</label>';
            html += '</td>';

            html += '<td>';
            html +=
                '<input readonly type="text" name="taxColQuantity[]"class="d-none taxColQuantity form-control mb-0 bg-light text-dark"><label class="text-danger">    @error('taxColQuantity'){{ $message }}@enderror</label>';
            html += '</td>';

            html += '<td>';
            html +=
                '<input type="text" name="taxColNature[]" class="taxColNature form-control mb-0 bg-white text-dark">';
            html += '<label class="text-danger">                        @error('taxColNature'){{ $message }}@enderror</label>';
            html += '</td>';

            html += '<td>';
            html +=
                '<input type="text" name="taxColAmount[]" class="taxColAmount form-control mb-0 bg-white text-dark">';
            html += '<label class="text-danger">                                @error('taxColAmount'){{ $message }}@enderror</label>';
            html += '</td>'

            html += '<td>';
            html +=
                '<div><button type="button" class=" removeRow btn btn-danger btn-sm mb-4">Remove</button></div>';
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
                $(this).mask("#,##0.00", {reverse: true});
            });
            
            $('.taxColAmount').change(function() {
                var sum = 0.00;
                $('.taxColAmount').each(function() {
                    let stringFloat = '0.00';
                    if ($(this).val() != '') {
                        stringFloat = $(this).val();
                    }
                    let float = stringFloat.replace(',','');
                    sum = sum + parseFloat(float);
                });
                sum = sum.toFixed(2);
                $('#taxColTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            });
        });

        $('#addRowPermit').click(function() {
            var html = '';
            html += '<tr>'
            html += '<td>';
            html +=
                '<input type="text" name="provFeeCharge[]" class="provFeeCharge form-control mb-0 bg-white text-dark">';
            html += '<label class="text-danger">                                                @error('provFeeCharge'){{ $message }} @enderror</label>';
            html += '</td>';

            html += '<td>';
            html +=
                '<input type="text" name="provAmount[]" class="provAmount form-control mb-0 bg-white text-dark">';
            html += '<label class="text-danger">                                    @error('provAmount'){{ $message }}@enderror</label>';
            html += '</td>';

            html += '<td>';
            html +=
                '<input type="text" name="provORNumber[]" class="provORNumber form-control mb-0 bg-white text-dark">';
            html += '<label class="text-danger">                    @error('provORNumber'){{ $message }}@enderror</label>';
            html += '</td>'

            html += '<td>';
            html +=
                '<input type="text" name="provDate[]" class="provDate datepicker form-control mb-0 bg-white text-dark">';
            html += '<label class="text-danger">                                                        @error('provDate'){{ $message }}@enderror</label>';
            html += '</td>'

            html += '<td>';
            html +=
                '<input type="text" name="provInitials[]" class="provInitials form-control mb-0 bg-white text-dark">';
            html += '<label class="text-danger">                                                        @error('provInitials'){{ $message }}@enderror</label>';
            html += '</td>'

            html += '<td>';
            html +=
                '<div><button type="button" class=" removeRow btn btn-danger btn-sm mb-4">Remove</button></div>';
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

        $('#certType').change(function() {
            if ($(this).val() == 'Provincial Permit') {
                $('#provincialPermit').removeClass('d-none');
                $('#provPermitAdditional').removeClass('d-none');
            }

            if ($(this).val() == 'Transfer Tax') {
                $('#transferTax').removeClass('d-none');
            }

            if ($(this).val() == 'null') {
                $('#provincialPermit').addClass('d-none');
                $('#provPermitAdditional').addClass('d-none');
            }
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
            }
        });

        $("#setNewData").on('click', function() {
            let $form = $(this);
            Swal.fire({
                icon: 'info',
                title: 'Form will be Saved. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Swal.fire('Updated Successfully!', '', 'success')
                    $('#land_tax_form').submit();
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
        });
        
        $('#save-cert-btn').on('click', function() {
            Swal.fire({
                icon: 'info',
                title: 'Form will be Saved. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Swal.fire('Updated Successfully!', '', 'success')
                    $('#cert_form').submit();
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info');
                }
            });
        });

        $('.taxColAmount').keyup(function () {
            $(this).mask("#,##0.00", {reverse: true});
        });
        
        $('.taxColAmount').change(function() {
            var sum = 0.00;
            $('.taxColAmount').each(function() {
                let stringFloat = '0.00';
                if ($(this).val() != '') {
                    stringFloat = $(this).val();
                }
                let float = stringFloat.replace(',','');
                sum = sum + parseFloat(float);
            });
            sum = sum.toFixed(2);
            $('#taxColTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });
    </script>
@endsection
