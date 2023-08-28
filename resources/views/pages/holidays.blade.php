@extends('layouts.app', ['page' => __('Holidays'), 'pageSlug' => 'holidays'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Holidays</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <form name="holidays_form" id="holidays_form" method="post"
                                action="{{ url('holidays_form') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 d-none">
                                        <label for="holidayID">ID</label>
                                        <input type="text" class="form-control" name="dateID" id="dateID">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="dateOfHoliday">Enter Holiday</label>
                                        <input type="text" class="datepicker form-control mb-0 bg-white text-dark" name="dateOfHoliday"
                                            id="dateOfHoliday">
                                        <label class="text-danger">
                                            @error('dateOfHoliday')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nameOfHoliday">Holiday Name</label>
                                        <input type="text" class="form-control mb-0 bg-white text-dark" name="nameOfHoliday"
                                            id="nameOfHoliday">
                                        <label class="text-danger">
                                            @error('nameOfHoliday')
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
                                        <table class="table tablesorter " id="holiday-table">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th></th>
                                                    <th>ID</th>
                                                    <th>Holiday Date</th>
                                                    <th>Holiday Name</th>
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

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Set Report Date</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <form name="holidays_form" id="holidays_form" method="post"
                                action="{{ url('holidays_form') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 d-none">
                                        <label for="holidayID">ID</label>
                                        <input type="text" class="form-control" name="dateID" id="dateID">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="affectedDate">Enter Affected Report Date</label>
                                        <input type="text" class="datepicker form-control mb-0 bg-white text-dark" name="affectedDate"
                                            id="affectedDate">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 mt-4">
                                        <button type="button" id="update-report" class="btn btn-success mx-auto">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="workingDate">Enter Next Working Report Date</label>
                                    <input type="text" class="datepicker form-control mb-0 bg-white text-dark" name="workingDate"
                                        id="workingDate">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.datepicker').flatpickr({
            dateFormat: 'M d, Y',
        });

        $(document).ready(function() {
            let data = @json($displayHolidays);
            let message = @json(session('Message'));
            console.log(message);
            if (message != null) {
                Swal.fire(message);
            }
            let table = $('#holiday-table').DataTable({
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
                        'data': 'date_of_holiday'
                    },
                    {
                        'data': 'holiday_name'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }
                ]
            });

            $('#holiday-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                $('#dateID').val(data[1]);
                $('#dateOfHoliday').val(data[2]);
                $('#nameOfHoliday').val(data[3]);
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');
            });

            $('#holiday-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#dateID').val(data[1]);
                        $('#holidays_form').prop('action', '{{ route('holidays_delete') }}');
                        $('#holidays_form').submit();
                    }
                });
            });

            $('#clear-btn').click(function() {
                $('#holidays_form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });
        });

        $('#update-report').click(function() {
            $.ajax({
                method: "POST",
                url: "{{ route('adjustReportDate') }}",
                data: {
                    affectedDate: $('#affectedDate').val(),
                    workingDate: $('#workingDate').val()
                }
            }).done(function(data) {
                Swal.fire({
                icon: 'info',
                title: 'Report Dates will be updated. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Report Date has been updated',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
                
            });
        });
    </script>
@endsection
