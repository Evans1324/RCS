@extends('layouts.app', ['page' => __('Serial'), 'pageSlug' => 'serial'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Serial</h1>
            </div>
            <form name="serial-form" id="serial-form" method="post" action="{{ url('submit_serial_form') }}">
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
                                <label for="serialForm">Accountable Forms</label>
                                <select class="form-control mb-0 bg-white text-dark" name="serialForm" id="serialForm">
                                    @if (Auth::user()->office == "Cash")
                                        <option class="bg-white" value="Form 51">Form 51</option>
                                    @elseif (Auth::user()->office == "Revenue")
                                        <option class="bg-white" value=""></option>
                                        <option class="bg-white" value="Form 51">Form 51</option>
                                        <option class="bg-white" value="Form 56">Form 56</option>
                                    @endif
                                </select>
                                <label class="text-danger">
                                    @error('serialForm')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            @if (Auth::user()->office == "Cash")
                                <div class="col-md-3">
                                    <label for="assignedOffice">Assigned Office</label>
                                    <select class="form-control mb-0 bg-white text-dark" name="assignedOffice" id="assignedOffice">
                                        <option class="bg-white" value="Cash">Cash</option>
                                    </select>
                                    <label class="text-danger">
                                        @error('assignedOffice')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                            @endif
                            <div class="col-md-3">
                                <label for="serialUnit">Unit</label>
                                <select class="form-control mb-0 bg-white text-dark" name="serialUnit" id="serialUnit">
                                    @if (Auth::user()->office == "Revenue")
                                        <option class="bg-white" value=""></option>
                                        <option id="continuous" class="bg-white" value="Continuous">Continuous</option>
                                        <option id="pad" class="bg-white" value="Pad">Pad</option>
                                    @elseif(Auth::user()->office == "Cash")
                                        <option id="pad" class="bg-white" value="Pad">Pad</option>
                                    @endif
                                </select>
                                <label class="text-danger">
                                    @error('serialUnit')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label for="serialFund">Fund</label>
                                @if (Auth::user()->office == "Revenue")
                                    <select disabled class="edit-input edit-input-51 form-control text-dark" name="serialFund" id="serialFund">
                                        <option class="bg-white" value=""></option>
                                        @foreach ($acc_categories as $acc_items)
                                            <option class="bg-white" value="{{ $acc_items->id }}">{{ $acc_items->acc_category_settings }}</option>
                                        @endforeach
                                    </select>
                                @elseif (Auth::user()->office == "Cash")
                                    <select class="edit-input edit-input-51 form-control bg-white text-dark" name="serialFund" id="serialFund">
                                        <option class="bg-white" value=""></option>
                                        @foreach ($acc_categories as $acc_items)
                                            <option class="bg-white" value="{{ $acc_items->id }}">{{ $acc_items->acc_category_settings }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                <label class="text-danger">
                                    @error('serialFund')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            @if (Auth::user()->office == "Cash")
                                <div class="col-md-3">
                                    <label for="serialMunicipality">Municipality</label>
                                    <select disabled class="edit-input edit-input-56 form-control text-dark" name="serialMunicipality"
                                        id="serialMunicipality">
                                        <option class="bg-white" value=""></option>
                                        @foreach ($municipalities as $mun_items)
                                            <option class="bg-white" value="{{ $mun_items->id }}">{{ $mun_items->municipality }}</option>
                                        @endforeach
                                    </select>
                                    <label class="text-danger">
                                        @error('serialMunicipality')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                            
                            @elseif (Auth::user()->office == "Revenue")
                                <div class="col-md-3">
                                    <label for="serialMunicipality">Municipality</label>
                                    <select disabled class="edit-input edit-input-56 form-control text-dark" name="serialMunicipality"
                                        id="serialMunicipality">
                                        <option class="bg-white" value=""></option>
                                        @foreach ($municipalities as $mun_items)
                                            <option class="bg-white" value="{{ $mun_items->id }}">{{ $mun_items->municipality }}</option>
                                        @endforeach
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
                                        @foreach ($acc_officers as $officer_items)
                                            <option class="bg-white" value="{{ $officer_items->id }}"> {{ $officer_items->officers }} </option>
                                        @endforeach
                                    </select>
                                    <label class="text-danger">
                                        @error('accountableOfficer')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                            @endif
                            
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" id="clear-btn" class="btn btn-success mx-auto d-none">Clear</button>
                                <button type="submit" id="submit-btn" class="btn btn-success">Add</button>
                            </div>
                        </div>

                        @if (Auth::user()->office == "Revenue")
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table tablesorter " id="serial-table">
                                                <thead class=" text-primary">
                                                    <tr>
                                                        <th></th>
                                                        <th>ID</th>
                                                        <th>Start of Serial</th>
                                                        <th>Current Series</th>
                                                        <th>End of Serial</th>
                                                        <th>Form</th>
                                                        <th>Unit</th>
                                                        <th>Fund ID</th>
                                                        <th>Fund</th>
                                                        <th>Mun ID</th>
                                                        <th>Municipality</th>
                                                        <th>Accountable Officer</th>
                                                        <th>Acc. Officer ID</th>
                                                        <th>Status</th>
                                                        <th></th>
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
                        @elseif (Auth::user()->office == "Cash")
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table tablesorter " id="serial-table">
                                                <thead class=" text-primary">
                                                    <tr>
                                                        <th></th>
                                                        <th>ID</th>
                                                        <th>Start of Serial</th>
                                                        <th>Current Series</th>
                                                        <th>End of Serial</th>
                                                        <th>Form</th>
                                                        <th>Unit</th>
                                                        <th>Fund ID</th>
                                                        <th>Fund</th>
                                                        <th>Mun ID</th>
                                                        <th>Municipality</th>
                                                        <th></th>
                                                        <th>Status</th>
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
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (Auth::user()->office == "Revenue")
        <script>
            $(document).ready(function() {
                let data = @json($displaySerial);
                let message = @json(session('Message'));
                if (message != null) {
                    Swal.fire(message);
                }
                let table = $('#serial-table').DataTable({
                    data: data,
                    columns: [{
                            'data': 'id',
                            render: function(data, type, row) {
                                return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-icon"><i class="tim-icons icon-simple-remove"></i></button>';
                            }
                        },
                        {
                            'data': 'id'
                        },
                        {
                            'data': 'start_serial'
                        },
                        {
                            'data': 'latest'
                        },
                        {
                            'data': 'end_serial'
                        },
                        {
                            'data': 'form'
                        },
                        {
                            'data': 'unit'
                        },
                        {
                            'data': 'fund_id'
                        },
                        {
                            'data': 'acc_category_settings'
                        },
                        {
                            'data': 'mun_id'
                        },
                        {
                            'data': 'municipality'
                        },
                        {
                            'data': 'officers'
                        },
                        {
                            'data': 'acc_officer_id'
                        },
                        {
                            'data': 'status',
                            render: function(data, type, row) {
                                if (row.latest == row.end_serial) {
                                    let status = 'Completed';
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('updateSerialStatus') }}",
                                        'data': {
                                            "_token": "{{ csrf_token() }}",
                                            "id": row.id,
                                            "seriesUpdate": status
                                        },
                                        'dataType': "json",
                                        'success': function(data) {
                                            //console.log(data);
                                        }
                                    });
                                    return '<p style="color:#78c2ff; font-weight:600">Completed</p>';
                                } else {
                                    return '<p style="color:green; font-weight:600">Active</p>';
                                }
                            }
                        },
                        {
                            'data': 'assigned_office'
                        },
                        {
                            'data': 'created'
                        },
                        {
                            'data': 'updated'
                        }
                    ],
                    "columnDefs": [
                        {
                            "targets": [1, 7, 9, 12, 14 ],
                            "visible": false
                        }
                    ],
                    "order": [ 14, "desc" ]
                });

                $('#serial-table tbody').on('click', '.edit', function(e) {
                    var idx = table.row($(this).parents('tr'));
                    var data = table.cells(idx, '').render('display');
                    $('#serialID').val(data[1]);
                    $('#startOfSerial').val(data[2]);
                    $('#endOfSerial').val(data[4]);
                    $('#serialForm').val(data[5]);
                    $('#serialUnit').val(data[6]);
                    $('#serialFund').val(data[7]);
                    $('#serialMunicipality').val(data[9]);
                    $('#accountableOfficer').val(data[11]);
                    $('#assignedOffice').val(data[14]);
                    $('#submit-btn').html('Update');
                    $('#clear-btn').removeClass('d-none');

                    if($('#serialForm').val() == 'Form 51') {
                        $('.edit-input-51').attr('disabled', false);
                        $('.edit-input-51').addClass('bg-white');

                        $('.edit-input-56').attr('disabled', true);
                        $('.edit-input-56').removeClass('bg-white');
                    }

                    if($('#serialForm').val() == 'Form 56') {
                        $('.edit-input-56').attr('disabled', false);
                        $('.edit-input-56').addClass('bg-white');

                        $('.edit-input-51').attr('disabled', true);
                        $('.edit-input-51').removeClass('bg-white');
                    }
                }); 

                $('#serial-table tbody').on('click', '.delete-btn-cl', function(e) {
                    var idx = table.row($(this).parents('tr'));
                    var data = table.cells(idx, '').render('display');
                    Swal.fire({
                        title: 'Do you want to delete this Title?',
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: 'Delete',
                        icon: 'warning'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#serialID').val(data[1]);
                            $('#serial-form').prop('action', '{{ route('delete_serial_form') }}');
                            $('#serial-form').submit();
                        }
                    });
                });

                $('#clear-btn').click(function() {
                    $('#serial-form')[0].reset();
                    $('#submit-btn').html('Add');
                    $(this).addClass('d-none');
                    $('.edit-input').attr('disabled', true);
                    $('.edit-input').removeClass('bg-white');
                });

                $('#serialForm').change(function () {
                    let getVal = $(this).val();
                    if (getVal == "Form 51") {
                        $('#serialUnit, #serialFund').prop('disabled', false);
                        $('#serialUnit, #serialFund').addClass('bg-white');
                        $('#serialMunicipality').prop('disabled', true);
                        $('#serialMunicipality').removeClass('bg-white');
                    } else {
                        $('#serialUnit, #serialFund').prop('disabled', true);
                        $('#serialUnit, #serialFund').removeClass('bg-white');
                        $('#serialMunicipality').prop('disabled', false);
                        $('#serialMunicipality').addClass('bg-white');
                    }
                });

                $('#assignedOffice').change(function () {
                    if ($(this).val() == 'PTO-REVENUE') {
                        $('#continuous').removeClass('d-none');
                        $('#pad').removeClass('d-none');
                    } else if ($(this).val() == 'PVET') {
                        $('#continuous').addClass('d-none');
                        $('#pad').removeClass('d-none');
                    } else if ($(this).val() == 'OPAG') {
                        $('#continuous').addClass('d-none');
                        $('#pad').removeClass('d-none');
                    } else if ($(this).val() == 'PTO-CASH') {
                        $('#continuous').addClass('d-none');
                        $('#pad').removeClass('d-none');
                    }
                });
            });

            $('#startOfSerial').focusout(function () {
                let start = $(this).val();
                
                if (start.length < 7) {
                    Swal.fire({
                        title: 'Please enter a 7 digit series',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                        icon: 'warning'
                    }).then((result) => {
                        $('#startOfSerial').val('');
                    });
                }
            });

            $('#endOfSerial').focusout(function () {
                let start = $(this).val();
                
                if (start.length < 7) {
                    Swal.fire({
                        title: 'Please enter a 7 digit series',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                        icon: 'warning'
                    }).then((result) => {
                        $('#endOfSerial').val('');
                    });
                }
            });
        </script>
    @elseif (Auth::user()->office == "Cash")
        <script>
            $(document).ready(function() {
                let data = @json($displaySerialCash);
                let message = @json(session('Message'));
                if (message != null) {
                    Swal.fire(message);
                }
                let table = $('#serial-table').DataTable({
                    data: data,
                    columns: [{
                            'data': 'id',
                            render: function(data, type, row) {
                                return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-icon"><i class="tim-icons icon-simple-remove"></i></button>';
                            }
                        },
                        {
                            'data': 'id'
                        },
                        {
                            'data': 'start_serial'
                        },
                        {
                            'data': 'latest'
                        },
                        {
                            'data': 'end_serial'
                        },
                        {
                            'data': 'form'
                        },
                        {
                            'data': 'unit'
                        },
                        {
                            'data': 'fund_id'
                        },
                        {
                            'data': 'acc_category_settings'
                        },
                        {
                            'data': 'mun_id'
                        },
                        {
                            'data': 'municipality'
                        },
                        {
                            'data': 'officers'
                        },
                        {
                            'data': 'status',
                            render: function(data, type, row) {
                                if (row.latest == row.end_serial) {
                                    let status = 'Completed';
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('updateSerialStatus') }}",
                                        'data': {
                                            "_token": "{{ csrf_token() }}",
                                            "id": row.id,
                                            "seriesUpdate": status
                                        },
                                        'dataType': "json",
                                        'success': function(data) {
                                            //console.log(data);
                                        }
                                    });
                                    return '<p style="color:#78c2ff; font-weight:600">Completed</p>';
                                } else {
                                    return '<p style="color:green; font-weight:600">Active</p>';
                                }
                            }
                        },
                        {
                            'data': 'created_at'
                        },
                        {
                            'data': 'updated_at'
                        },
                        {
                            'data': 'assigned_office'
                        }
                    ],
                    "columnDefs": [
                        {
                            "targets": [1, 7, 9, 11, 15],
                            "visible": false
                        }
                    ],
                    "order": [ 14, "desc" ]
                });

                $('#serial-table tbody').on('click', '.edit', function(e) {
                    var idx = table.row($(this).parents('tr'));
                    var data = table.cells(idx, '').render('display');
                    console.log(data);
                    $('#serialID').val(data[1]);
                    $('#startOfSerial').val(data[2]);
                    $('#endOfSerial').val(data[4]);
                    $('#serialForm').val(data[5]);
                    $('#serialUnit').val(data[6]);
                    $('#serialFund').val(data[7]);
                    $('#serialMunicipality').val(data[9]);
                    $('#accountableOfficer').val(data[11]);
                    $('#assignedOffice').val(data[15]);
                    $('#submit-btn').html('Update');
                    $('#clear-btn').removeClass('d-none');

                    if($('#serialForm').val() == 'Form 51') {
                        $('.edit-input-51').attr('disabled', false);
                        $('.edit-input-51').addClass('bg-white');

                        $('.edit-input-56').attr('disabled', true);
                        $('.edit-input-56').removeClass('bg-white');
                    }

                    if($('#serialForm').val() == 'Form 56') {
                        $('.edit-input-56').attr('disabled', false);
                        $('.edit-input-56').addClass('bg-white');

                        $('.edit-input-51').attr('disabled', true);
                        $('.edit-input-51').removeClass('bg-white');
                    }
                }); 

                $('#serial-table tbody').on('click', '.delete-btn-cl', function(e) {
                    var idx = table.row($(this).parents('tr'));
                    var data = table.cells(idx, '').render('display');
                    Swal.fire({
                        title: 'Do you want to delete this Title?',
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: 'Delete',
                        icon: 'warning'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#serialID').val(data[1]);
                            $('#serial-form').prop('action', '{{ route('delete_serial_form') }}');
                            $('#serial-form').submit();
                        }
                    });
                });

                $('#clear-btn').click(function() {
                    $('#serial-form')[0].reset();
                    $('#submit-btn').html('Add');
                    $(this).addClass('d-none');
                    $('.edit-input').attr('disabled', true);
                    $('.edit-input').removeClass('bg-white');
                });

                $('#serialForm').change(function () {
                    let getVal = $(this).val();
                    if (getVal == "Form 51") {
                        $('#serialUnit').prop('disabled', false);
                        $('#serialUnit').addClass('bg-white');
                        $('#serialFund').prop('disabled', false);
                        $('#serialFund').addClass('bg-white');
                        $('#serialMunicipality').prop('disabled', true);
                        $('#serialMunicipality').removeClass('bg-white');
                    } else {
                        $('#serialUnit').prop('disabled', false);
                        $('#serialUnit').addClass('bg-white');
                        $('#serialFund').prop('disabled', false);
                        $('#serialFund').addClass('bg-white');
                        $('#serialMunicipality').prop('disabled', false);
                        $('#serialMunicipality').addClass('bg-white');
                    }
                });

                $('#assignedOffice').change(function () {
                    if ($(this).val() == 'PTO-REVENUE') {
                        $('#continuous').removeClass('d-none');
                        $('#pad').removeClass('d-none');
                    } else if ($(this).val() == 'PVET') {
                        $('#continuous').addClass('d-none');
                        $('#pad').removeClass('d-none');
                    } else if ($(this).val() == 'OPAG') {
                        $('#continuous').addClass('d-none');
                        $('#pad').removeClass('d-none');
                    } else if ($(this).val() == 'PTO-CASH') {
                        $('#continuous').addClass('d-none');
                        $('#pad').removeClass('d-none');
                    }
                });
            });

            $('#startOfSerial').focusout(function () {
                let start = $(this).val();
                
                if (start.length < 7) {
                    Swal.fire({
                        title: 'Please enter a 7 digit series',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                        icon: 'warning'
                    }).then((result) => {
                        $('#startOfSerial').val('');
                    });
                }
            });

            $('#endOfSerial').focusout(function () {
                let start = $(this).val();
                
                if (start.length < 7) {
                    Swal.fire({
                        title: 'Please enter a 7 digit series',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                        icon: 'warning'
                    }).then((result) => {
                        $('#endOfSerial').val('');
                    });
                }
            });
        </script>
    @endif
@endsection
