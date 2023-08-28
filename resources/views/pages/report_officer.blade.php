@extends('layouts.app', ['page' => __('Report Officers'), 'pageSlug' => 'report_officer'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Report Officers</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <form name="report_officers_form" id="report_officers_form" method="post"
                                action="{{ url('report_officers_form') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 d-none">
                                        <label for="officerID">ID</label>
                                        <input type="text" class="form-control" name="officerID" id="officerID">
                                    </div>
                                </div>

                                <div class="row d-none">
                                    <div class="col-md-12">
                                        <label for="officerNameID">Name ID</label>
                                        <input type="text" class="form-control mb-0 bg-white text-dark"
                                            name="officerNameID" id="officerNameID">
                                        <label class="text-danger">
                                            @error('officerNameID')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="officerName">Name</label>
                                        <input type="text" class="form-control mb-0 bg-white text-dark" name="officerName"
                                            id="officerName">
                                        <label class="text-danger">
                                            @error('officerName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>

                                <div class="row d-none">
                                    <div class="col-md-12">
                                        <label for="officerPositionID">Position ID</label>
                                        <input type="text" class="form-control mb-0 bg-white text-dark"
                                            name="officerPositionID" id="officerPositionID">
                                        <label class="text-danger">
                                            @error('officerPositionID')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="officerPosition">Position</label>
                                        <input type="text" class="form-control mb-0 bg-white text-dark"
                                            name="officerPosition" id="officerPosition">
                                        <label class="text-danger">
                                            @error('officerPosition')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>

                                <div class="row d-none">
                                    <div class="col-md-12">
                                        <label for="officerDeptID">Department ID</label>
                                        <input type="text" class="form-control mb-0 bg-white text-dark"
                                            name="officerDeptID" id="officerDeptID">
                                        <label class="text-danger">
                                            @error('officerDeptID')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="officerDepartment">Department</label>
                                        <input type="text" class="form-control mb-0 bg-white text-dark"
                                            name="officerDepartment" id="officerDepartment">
                                        <label class="text-danger">
                                            @error('officerDepartment')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="button" id="clear-btn"
                                            class="btn btn-success mx-auto d-none">Clear</button>
                                        <button type="submit" id="submit-btn" class="btn btn-success mx-auto">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="card-header">
                                    {{-- <p class="category"> Here is a subtitle for this table</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table tablesorter " id="report-officers-table">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th></th>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Department</th>
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
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let data = @json($displayOfficers);
            let message = @json(session('Message'));
            console.log(message);
            if (message != null) {
                Swal.fire(message);
            }
            let table = $('#report-officers-table').DataTable({
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
                        'data': 'name'
                    },
                    {
                        'data': 'position'
                    },
                    {
                        'data': 'department'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }, 
                    {
                        'data': 'officerId'
                    },
                    {
                        'data': 'posId'
                    },
                    {
                        'data': 'deptId'
                    }
                ],
                "columnDefs": [{
                        "targets": [7, 8, 9],
                        "visible": false,
                    }], 
                "order": [ 9, "desc" ]
            });

            $('#report-officers-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                $('#officerID').val(data[1]);
                $('#officerName').val(data[2]);
                $('#officerNameID').val(data[7]);
                $('#officerPosition').val(data[3]);
                $('#officerPositionID').val(data[8]);
                $('#officerDepartment').val(data[4]);
                $('#officerDeptID').val(data[9]);
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');

                console.log(data);
            }); 

            $('#report-officers-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#officerID').val(data[1]);
                        $('#report_officers_form').prop('action', '{{ route('report_officers_delete') }}');
                        $('#report_officers_form').submit();
                    }
                });
                console.log(data);
            });

            $('#clear-btn').click(function() {
                $('#report_officers_form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });
        });
    </script>
@endsection
