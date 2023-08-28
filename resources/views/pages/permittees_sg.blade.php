@extends('layouts.app', ['page' => __('Permittees S&G'), 'pageSlug' => 'permittees_sg'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Permittees S&G</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form name="permittees-form" id="permittees-form" method="post" action="{{ url('saveNewPermitteesForm') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 d-none">
                                        <label for="permitteesID">ID</label>
                                        <input type="text" class="form-control" name="permitteesID" id="permitteesID">
                                        <label class="text-danger">
                                            @error('permitteesID')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="permitteesType">Type</label>
                                        <select class="form-control bg-white text-dark" name="permitteesType" id="permitteesType">
                                            <option class="bg-white" value=""></option>
                                            <option class="bg-white" value="Industrial">Industrial</option>
                                            <option class="bg-white" value="Commercial">Commercial</option>
                                        </select>
                                        <label class="text-danger">
                                            @error('permitteesType')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <label for="permitteesTradeName">Trade Name</label>
                                        <input type="text" class="form-control bg-white text-dark" name="permitteesTradeName" id="permitteesTradeName">
                                        <label class="text-danger">
                                            @error('permitteesTradeName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="permittees">Permittee</label>
                                        <input type="text" class="form-control bg-white text-dark" name="permittees" id="permittees">
                                        <label class="text-danger">
                                            @error('permittees')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="permitteesMunicipality">Municipality</label>
                                        <input type="text" class="form-control bg-white text-dark" name="permitteesMunicipality" id="permitteesMunicipality">
                                        <label class="text-danger">
                                            @error('permitteesMunicipality')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="permitteesBarangay">Barangay</label>
                                        <input type="text" class="form-control bg-white text-dark" name="permitteesBarangay" id="permitteesBarangay">
                                        <label class="text-danger">
                                            @error('permitteesBarangay')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="button" id="clear-btn" class="btn btn-success mx-auto d-none">Clear</button>
                                        <button type="submit" id="submit-btn" class="btn btn-success">Add</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="permittees-table">
                                <thead class="text-primary">
                                    <tr>
                                        <th></th>
                                        <th>Type</th>
                                        <th>Trade Name</th>
                                        <th>Permittee</th>
                                        <th>Permitted Area Municipality</th>
                                        <th>Permitted Area Barangay</th>
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

    <script>
        $(document).ready(function() {
            let data = @json($getPermittees);
            let message = @json(session('Message'));
            if (message != null) {
                Swal.fire(message);
            }
            let table = $('#permittees-table').DataTable({
                data: data,
                columns: [{

                        'data': 'id',
                        render: function(data, type, row) {
                            return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-icon"><i class="tim-icons icon-simple-remove"></i></button>';
                        }
                    },
                    {
                        'data': 'type'
                    },
                    {
                        'data': 'trade_name'
                    },
                    {
                        'data': 'permittee'
                    },
                    {
                        'data': 'permitted_area_municipality'
                    },
                    {
                        'data': 'permitted_area_barangay'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }
                ],
                "order": [ 7, "desc" ]
            });

            $('#permittees-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');

                $('#permitteesID').val(data[0]);
                $('#permitteesType').val(data[1]);
                $('#permitteesTradeName').val(data[2]);
                $('#permittees').val(data[3]);
                $('#permitteesMunicipality').val(data[4]);
                $('#permitteesBarangay').val(data[5]);
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');
            });

            $('#clear-btn').click(function() {
                $('#permittees-form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });

            $('#permittees-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#permitteesID').val(data[0]);
                        $('#permittees-form').prop('action', '{{ route('deletePermitteesForm') }}');
                        $('#permittees-form').submit();
                    }
                });
            });
        });
    </script>
@endsection
