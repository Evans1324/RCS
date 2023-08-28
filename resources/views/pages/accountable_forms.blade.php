@extends('layouts.app', ['page' => __('Accountable Forms'), 'pageSlug' => 'accountable_forms'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Serial</h1>
            </div>
            <form name="account-group-settings-form" id="account-group-settings-form" method="post"
                action="{{ url('account-group-form') }}">
                @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 d-none">
                                <label for="serialID">ID</label>
                                <input type="text" class="form-control" name="serialID" id="serialID">
                                <label class="text-danger">
                                    @error('serialID')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="startOfSerial">Start of Serial</label>
                                <input type="text" class="form-control mb-0 bg-white text-dark" name="startOfSerial"
                                    id="startOfSerial">
                                <label class="text-danger">
                                    @error('startOfSerial')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="endOfSerial">End of Serial</label>
                                <input type="text" class="form-control mb-0 bg-white text-dark" name="endOfSerial"
                                    id="endOfSerial">
                                <label class="text-danger">
                                    @error('endOfSerial')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="serialForm">Form</label>
                                <select class="form-control bg-white text-dark" name="serialForm" id="serialForm">
                                    <option class="bg-white" value=""></option>
                                    <option class="bg-white" value="Form 51">Form 51</option>
                                    <option class="bg-white" value="Form 56">Form 56</option>
                                </select>
                                <label class="text-danger">
                                    @error('serialForm')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            {{-- <div class="col-md-3">
                                <label for="dateOfSerial">Date</label>
                                <input type="text" class="form-control mb-0 bg-white text-dark" name="dateOfSerial"
                                    id="dateOfSerial">
                                <label class="text-danger">
                                    @error('dateOfSerial')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="serialUnit">Unit</label>
                                <input type="text" class="form-control mb-0 bg-white text-dark" name="serialUnit"
                                    id="serialUnit">
                                <label class="text-danger">
                                    @error('serialUnit')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="serialFund">Fund</label>
                                <select class="form-control bg-white text-dark" name="serialFund" id="serialFund">
                                    <option class="bg-white" value=""></option>
                                    <option class="bg-white" value="Form 51">Form 51</option>
                                    <option class="bg-white" value="Form 56">Form 56</option>
                                </select>
                                <label class="text-danger">
                                    @error('serialFund')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="serialMunicipality">Municipality</label>
                                <select class="form-control bg-white text-dark" name="serialMunicipality"
                                    id="serialMunicipality">
                                    <option class="bg-white" value=""></option>
                                    <option class="bg-white" value="Atok">Atok</option>
                                    <option class="bg-white" value="Bakun">Bakun</option>
                                    <option class="bg-white" value="Bokod">Bokod</option>
                                    <option class="bg-white" value="Buguias">Buguias</option>
                                    <option class="bg-white" value="Itogon">Itogon</option>
                                    <option class="bg-white" value="Kabayan">Kabayan</option>
                                    <option class="bg-white" value="Kapangan">Kapangan</option>
                                    <option class="bg-white" value="Kibungan">Kibungan</option>
                                    <option class="bg-white" value="La Trinidad">La Trinidad</option>
                                    <option class="bg-white" value="Mankayan">Mankayan</option>
                                    <option class="bg-white" value="Sablan">Sablan</option>
                                    <option class="bg-white" value="Tuba">Tuba</option>
                                    <option class="bg-white" value="Tublay">Tublay</option>
                                    <option class="bg-white" value="Bakun">Bakun</option>
                                </select>
                                <label class="text-danger">
                                    @error('serialMunicipality')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="accountableOfficer">Accountable Officer (if applicable)</label>
                                <select class="form-control bg-white text-dark" name="accountableOfficer"
                                    id="accountableOfficer">
                                    <option class="bg-white" value=""></option>
                                    <option class="bg-white" value="IMELDA I. MACANES">IMELDA I. MACANES</option>
                                    <option class="bg-white" value="JULIE V. ESTEBAN">JULIE V. ESTEBAN</option>
                                    <option class="bg-white" value="IRENE C. BAGKING">IRENE C. BAGKING</option>
                                    <option class="bg-white" value="MARY JANE P. LAMPACAN">MARY JANE P. LAMPACAN
                                    </option>
                                    <option class="bg-white" value="LORENZA C. LAMSIS">LORENZA C. LAMSIS</option>
                                    <option class="bg-white" value="JOANA G. COLSIM">JOANA G. COLSIM</option>
                                    <option class="bg-white" value="MELCHOR D. DICLAS, MD">MELCHOR D. DICLAS, MD
                                    </option>
                                    <option class="bg-white" value="PURITA LESING">PURITA LESING</option>
                                </select>
                                <label class="text-danger">
                                    @error('accountableOfficer')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <button type="submit" id="submit-btn" class="btn btn-success">Add</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    {{-- <p class="category"> Here is a subtitle for this table</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table tablesorter " id="account-titles-table">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th></th>
                                                    <th>Start of Serial</th>
                                                    <th>End of Serial</th>
                                                    <th>Form</th>
                                                    <th>Unit</th>
                                                    <th>Fund</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
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
            </form>
        </div>
    </div>

    {{-- <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Serial SG</h1>
            </div>
            <form name="account-group-settings-form" id="account-group-settings-form" method="post"
                action="{{ url('account-group-form') }}">
                @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 d-none">
                                <label for="sgID">ID</label>
                                <input type="text" class="form-control" name="sgID" id="sgID">
                                <label class="text-danger">
                                    @error('sgID')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="sgStart">Start of Serial</label>
                                <input type="text" name="sgStart" class="form-control bg-white text-dark" id="sgStart">
                                <label class="text-danger">
                                    @error('sgStart')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="sgEnd">End of Serial</label>
                                <input type="text" name="sgEnd" class="form-control bg-white text-dark" id="sgEnd">
                                <label class="text-danger">
                                    @error('sgEnd')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="sgType">Type</label>
                                <select class="form-control bg-white text-dark" name="sgType" id="sgType">
                                    <option class="bg-white" value=""></option>
                                    <option class="bg-white" value="Commercial">Commercial</option>
                                    <option class="bg-white" value="Industrial">Industrial</option>
                                </select>
                                <label class="text-danger">
                                    @error('sgType')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="sgDate">Date</label>
                                <input type="text" name="sgDate" class="form-control bg-white text-dark" id="sgDate">
                                <label class="text-danger">
                                    @error('sgDate')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="submit" id="submit-btn" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <h1>Access PC's</h1> --}}
@endsection
