@extends('layouts.app', ['page' => __('Contractors'), 'pageSlug' => 'contractors'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Contractors</h1>
        </div>
    </div>
    <form name="contractors-form" id="contractors-form" method="post" action="{{ url('saveNewContractorsForm') }}">
    @csrf
        <div class="row">
            <div class="col-md-12">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 d-none">
                                        <label for="contractorsID">ID</label>
                                        <input type="text" class="form-control" name="contractorsID" id="contractorsID">
                                        <label class="text-danger">
                                            @error('contractorsID')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <label for="businessName">Business Name</label>
                                        <input type="text" class="form-control bg-white text-dark" name="businessName" id="businessName">
                                        <label class="text-danger">
                                            @error('businessName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="businessOwner">Owner</label>
                                        <input type="text" class="form-control bg-white text-dark" name="businessOwner" id="businessOwner">
                                        <label class="text-danger">
                                            @error('businessOwner')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="businessPosition">Position</label>
                                        <input type="text" class="form-control bg-white text-dark" name="businessPosition" id="businessPosition">
                                        <label class="text-danger">
                                            @error('businessPosition')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-8">
                                        <label for="businessAddress">Business Address</label>
                                        <input type="text" class="form-control bg-white text-dark" name="businessAddress" id="businessAddress">
                                        <label class="text-danger">
                                            @error('businessAddress')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="businessNumber">Contact Number</label>
                                        <input type="text" class="form-control bg-white text-dark" name="businessNumber" id="businessNumber">
                                        <label class="text-danger">
                                            @error('businessNumber')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="button" id="clear-btn" class="btn btn-success mx-auto d-none">Clear</button>
                                        <button type="button" id="submit-btn" class="btn btn-success">Add</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            {{-- <p class="category"> Here is a subtitle for this table</p> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table tablesorter " id="contractors-table">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th class="bg-dark">Actions</th>
                                            <th class="bg-dark"></th>
                                            <th class="bg-dark">Business Name</th>
                                            <th class="bg-dark">Owner</th>
                                            <th class="bg-dark">Position</th>
                                            <th class="bg-dark">Address</th>
                                            <th class="bg-dark">Contact Number</th>
                                            <th class="bg-dark">Created At</th>
                                            <th class="bg-dark">Updated At</th>
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
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        let table = null;
        let message = @json(session('Message'));
        if (message != null) {
            Swal.fire(message);
        }
        $(document).ready(function() {
            table = $('#contractors-table').DataTable({
                info: false,
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                pageLength: 10,
                dateFormat: 'yyyy-mm-dd',
                processing: true,
                serverSide: true,
                recordsTotal: 50,
                ajax: {
                    url:'{{route("getContractorsData")}}',
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
                        'data': 'business_name'
                    },
                    {
                        'data': 'owner'
                    },
                    {
                        'data': 'position'
                    },
                    {
                        'data': 'address'
                    },
                    {
                        'data': 'contact_number'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }
                ],
                "columnDefs": [{
                        "targets": [1],
                        "visible": false,
                    }], 
                "order": [ 7, "desc" ]
            });

            $('#contractors-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                $('#contractorsID').val(data[1]);
                $('#businessName').val(data[2]);
                $('#businessOwner').val(data[3]);
                $('#businessPosition').val(data[4]);
                $('#businessAddress').val(data[5]);
                $('#businessNumber').val(data[6]);
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');
            });

            $('#clear-btn').click(function() {
                $('#contractors-form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });

            $('#contractors-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#contractorsID').val(data[1]);
                        $('#contractors-form').prop('action', '{{ route('deleteContractorsForm') }}');
                        $('#contractors-form').submit();
                    }
                });
            });
        });

        $('#submit-btn').on('click', function () {
            let contractorsData = $('#contractors-form').serializeArray();
            Swal.fire({
                icon: 'info',
                title: 'Form will be Saved. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        'url': '{{ route('saveNewContractorsForm') }}',
                        'data': contractorsData,
                        'method': "post",
                        'dataType': "json",
                        'success': function(data) {
                            console.log(data);
                        }
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'Data has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#contractors-table').DataTable().ajax.reload();
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Insert data did not push through',
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                    });
                }
            });
            
        });
    </script>
@endsection