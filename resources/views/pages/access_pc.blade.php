@extends('layouts.app', ['page' => __('Access PCs'), 'pageSlug' => 'access_pc'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Access PC's</h1>
            </div>
            <form name="access-pc-form" id="access-pc-form" method="post" action="{{ url('submit_pc_form') }}">
                @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 d-none">
                                <label for="accessID">ID</label>
                                <input type="text" class="form-control" name="accessID" id="accessID">
                                <label class="text-danger">
                                    @error('accessID')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="pcName">PC Name</label>
                                <input type="text" class="form-control mb-0 bg-white text-dark" name="pcName" id="pcName">
                                <label class="text-danger">
                                    @error('pcName')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="pcAssigned">PC Assigned IP</label>
                                <input type="text" class="form-control mb-0 bg-white text-dark" name="pcAssigned"
                                    id="pcAssigned">
                                <label class="text-danger">
                                    @error('pcAssigned')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="processType">PC Process Type</label>
                                <select class="form-control bg-white text-dark" name="processType" id="processType">
                                    <option class="bg-white" value="Select Process Type">Select Process Type</option>
                                    <option class="bg-white" value="Land Tax Collection">Land Tax Collection</option>
                                    <option class="bg-white" value="Field Land Tax Collection">Field Land Tax Collection</option>
                                </select>
                                <label class="text-danger">
                                    @error('processType')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="processForm">PC Process Form</label>
                                <select disabled class="form-control text-dark" name="processForm" id="processForm">
                                    <option class="bg-white" value="Select Process Form">Select Process Form</option>
                                    <option class="bg-white" value="Form 51">Form 51</option>
                                </select>
                                <label class="text-danger">
                                    @error('processForm')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 offset-md-9">
                                <select class="d-none form-control bg-white text-dark" name="assignedReceipt"
                                    id="assignedReceipt">
                                    <option class="bg-white" value="null">PC Assigned Receipt</option>
                                </select>
                                <label class="text-danger">
                                    @error('assignedReceipt')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-md-3 d-none">
                                <input type="text" class="form-control mb-0 bg-white text-dark" name="assignedStatus" id="assignedStatus" value="assigned">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" id="clear-btn" class="btn btn-success mx-auto d-none">Clear</button>
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
                                        <table class="table tablesorter " id="access-pc-table">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th></th>
                                                    <th>ID</th>
                                                    <th>PC Name</th>
                                                    <th>IP</th>
                                                    <th>Transaction</th>
                                                    <th>Form</th>
                                                    <th>Serial ID</th>
                                                    <th>Receipt</th>
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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            let data = @json($displayAccessPC);
            let message = @json(session('Message'));
            console.log(data);
            if (message != null) {
                Swal.fire(message);
            }
            let table = $('#access-pc-table').DataTable({
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
                        'data': 'pc_name'
                    },
                    {
                        'data': 'assigned_ip'
                    },
                    {
                        'data': 'process_type'
                    },
                    {
                        'data': 'process_form'
                    },
                    {
                        'data': 'serial_id'
                    },
                    {
                        'data': 'Serial'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }
                ],
                "columnDefs": [
                    {
                        "targets": [ 1, 6 ],
                        "visible": false
                    }
                ],
                "order": [ 9, "desc" ]
            });

            $('#access-pc-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                console.log(data);
                $('#accessID').val(data[1]);
                $('#pcName').val(data[2]);
                $('#pcAssigned').val(data[3]);
                $('#processType').val(data[4]);
                $('#processForm').val(data[5]);
                
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');

                if($('#processType').val() == 'Land Tax Collection') {
                    $('#processForm').attr('disabled', false);
                    $('#processForm').addClass('bg-white');
                    $('#processType').trigger('change');
                    if($('#processForm').val() == 'Form 51') {
                        $('#assignedReceipt').attr('disabled', false);
                        $('#assignedReceipt').removeClass('d-none');
                        $('#assignedReceipt').addClass('bg-white');
                        $('#processForm').trigger('change');
                        $('#assignedReceipt').val(data[6]);
                    }
                }
            });

            $('#access-pc-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#accessID').val(data[1]);
                        $('#access-pc-form').prop('action', '{{ route('delete_pc_form') }}');
                        $('#access-pc-form').submit();
                    }
                });
            });

            $('#clear-btn').click(function() {
                $('#access-pc-form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');

                $('#assignedReceipt').addClass('d-none');
                $('#processForm').prop('disabled', true);
                $('#processForm').removeClass('bg-white');
            });


        });

        $('#processType').change(function() {
            let getVal = $(this).val();
            if (getVal == "Land Tax Collection" || getVal == "Field Land Tax Collection") {
                $('#processForm').prop('disabled', false);
                $('#processForm').addClass('bg-white');
            } else if (getVal == "Select Process Type") {
                console.log('Great!');
                $('#processForm').prop('disabled', true);
                $('#processForm').removeClass('bg-white');
            }
        });

        $('#processType').change(function() {
            let getVal = $(this).val();
            $.ajax({
                method: "POST",
                url: "{{ route('getFormData') }}",
                async: false,
                data: {
                    id: $(this).val(),
                }
            }).done(function(data) {
                $('#assignedReceipt').html('<option class="bg-white" value="null">PC Assigned Receipt</option>');
                data.forEach(element => {
                    console.log(element);
                    $('#assignedReceipt').html($('#assignedReceipt').html() +
                        '<option class="bg-white" value="' + element.id + '">' + element.Serial +'</option>');
                });
                /*if (data == 'Serial Error') {
                    Swal.fire('Please assign new serial', '', 'info');
                } else {
                    $('#serialNumber').val(data);
                    $('#series-counter').html(data);
                    $('#addTaxColModal').modal('show');
                }*/
            });
            
        });

        $('#processForm').change(function () {
            if ($('#processForm').val() == "Form 51") {
                $('#assignedReceipt').removeClass('d-none');
            } else {
                $('#assignedReceipt').addClass('d-none');
            }
        });
    </script>
@endsection
