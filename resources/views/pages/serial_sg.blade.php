@extends('layouts.app', ['page' => __('Serial SG'), 'pageSlug' => 'serial_sg'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Serial SG</h1>
            </div>
            <form name="serial-sg-form" id="serial-sg-form" method="post" action="{{ url('submit_serial_sg_form') }}">
                @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 d-none">
                                <label for="serialSGID">ID</label>
                                <input type="text" class="form-control" name="serialSGID" id="serialSGID">
                                <label class="text-danger">
                            </div>

                            <div class="col-md-3">
                                <label for="serialSGType">Type</label>
                                <select class="form-control bg-white text-dark" name="serialSGType" id="serialSGType">
                                    <option class="bg-white" value=""></option>
                                    <option class="bg-white" value="Industrial">Industrial</option>
                                    <option class="bg-white" value="Commercial">Commercial</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="startSG">Start serial</label>
                                <input type="text" class="form-control mb-0 bg-white text-dark" name="startSG"
                                    id="startSG">
                            </div>

                            <div class="col-md-3">
                                <label for="endSG">End serial</label>
                                <input type="text" class="form-control mb-0 bg-white text-dark" name="endSG"
                                    id="endSG">
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
                                        <table class="table tablesorter " id="serial-sg-table">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th></th>
                                                    <th>ID</th>
                                                    <th>Start of Serial</th>
                                                    <th>Current DR</th>
                                                    <th>End of Serial</th>
                                                    <th>Type</th>
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
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let data = @json($displaySerialSG);
            console.log(data);
            let message = @json(session('Message'));
            if (message != null) {
                Swal.fire(message);
            }
            let table = $('#serial-sg-table').DataTable({
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
                        'data': 'start_serial_sg'
                    },
                    {
                        'data': 'latest'
                    },
                    {
                        'data': 'end_serial_sg'
                    },
                    {
                        'data': 'serial_sg_type'
                    },
                    {
                        'data': 'status',
                        render: function(data, type, row) {
                            if (row.dr_number == row.end_serial_sg) {
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
                    }
                ]
            });

            $('#serial-sg-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                $('#serialSGID').val(data[1]);
                $('#startOfSerialSG').val(data[2]);
                $('#endOfSerialSG').val(data[3]);
                $('#serialSGType').val(data[4]);
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');
            });

            $('#serial-sg-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#serialSGID').val(data[1]);
                        $('#serial-sg-form').prop('action', '{{ route('delete_serial_sg_form') }}');
                        $('#serial-sg-form').submit();
                    }
                });
            });

            $('#clear-btn').click(function() {
                $('#serial-sg-form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });
        });

        $('#serialSGType').change(function() {
            if ($(this).val() == 'Industrial') {
                $('#industrialSG').removeClass('d-none');
                $('#commercialSG').addClass('d-none');
                $('.seriesSG').addClass('d-none');
                $('#industrialBooklet').val('');
                $('#commercialBooklet').val('');
            } else if (($(this).val() == 'Commercial')) {
                $('#industrialSG').addClass('d-none');
                $('#commercialSG').removeClass('d-none');
                $('.seriesSG').addClass('d-none');
                $('#industrialBooklet').val('');
                $('#commercialBooklet').val('');
            } else {
                $('#industrialSG').addClass('d-none');
                $('#commercialSG').addClass('d-none');
                $('.seriesSG').addClass('d-none');
                $('#industrialBooklet').val('');
                $('#commercialBooklet').val('');
            }
                
        });
    </script>
@endsection
