@extends('layouts.app', ['page' => __('District Hospital Remittance'), 'pageSlug' => 'district_hospital'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">District Hospital Remittance</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form name="district_hospital_form" id="district_hospital_form" method="post"
                        action="{{ url('insert_hospital_data') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="col-md-12 d-none">
                                    <label for="hospitalID">ID</label>
                                    <input type="text" class="form-control" name="hospitalID" id="hospitalID">
                                    <label>
                                        @error('hospitalID')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputHospital">District Hospital</label>
                                    <input type="text" class="form-control bg-white text-dark" name="inputHospital"
                                        id="inputHospital">
                                    <label>
                                        @error('inputHospital')
                                            <h4 class="text-danger">{{ $message }}</h4>
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="button" id="clear-btn"
                                        class="btn btn-success mx-auto d-none">Clear</button>
                                    <button type="submit" id="submit-btn" class="btn btn-success mx-auto">Add</button>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table tablesorter " id="hospital-table">
                                                <thead class=" text-primary">
                                                    <tr>
                                                        <th></th>
                                                        <th>ID</th>
                                                        <th>Hospital Name</th>
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
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let data = @json($hospital_data);
        let message = @json(session('Message'));
        console.log(message);
        if (message != null) {
            Swal.fire(message);
        }
        $(document).ready(function() {
            let table = $('#hospital-table').DataTable({
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
                        'data': 'hospital_name'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }
                ]
            });

            $('#hospital-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                $('#inputHospital').val(data[2]);
                $('#hospitalID').val(data[1]);
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');

                console.log(data);
            });

            $('#hospital-table tbody').on('click', '.delete-btn-cl', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                Swal.fire({
                    title: 'Item will be deleted from the table. Are you sure?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    icon: 'warning'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $('#hospitalID').val(data[1]);
                        $('#district_hospital_form').prop('action', '{{ route('soft_delete_hospital') }}');
                        $('#district_hospital_form').submit();

                    }
                });
                console.log(data);
            });

            $('#clear-btn').click(function() {
                $('#district_hospital_form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });

        });
    </script>

@endsection
