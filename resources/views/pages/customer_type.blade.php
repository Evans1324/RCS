@extends('layouts.app', ['page' => __('Customer Type'), 'pageSlug' => 'customer_type'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Customer Type</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <form name="customer_type_form" id="customer_type_form" method="post"
                                action="{{ url('customer_type_form') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 d-none">
                                        <label for="typeID">ID</label>
                                        <input type="text" class="form-control" name="typeID" id="typeID">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="typeDescription">Type Description</label>
                                        <input type="text" class="form-control mb-0 bg-white text-dark" name="typeDescription"
                                            id="typeDescription">
                                        <label class="text-danger">
                                            @error('typeDescription')
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
                        <div class="col-md-10">
                            <div class="col-md-12">
                                <div class="card-header">
                                    {{-- <p class="category"> Here is a subtitle for this table</p> --}}
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table tablesorter " id="customer-type-table">
                                            <thead class="bg-dark text-primary">
                                                <tr>
                                                    <th></th>
                                                    <th>ID</th>
                                                    <th>Type</th>
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
            let data = @json($displayTypes);
            let message = @json(session('Message'));
            console.log(message);
            if (message != null) {
                Swal.fire(message);
            }
            let table = $('#customer-type-table').DataTable({
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
                        'data': 'description_type'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }
                ]
            });

            $('#customer-type-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                $('#typeID').val(data[1]);
                $('#typeDescription').val(data[2]);
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');

                console.log(data);
            }); 

            $('#customer-type-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#typeID').val(data[1]);
                        $('#customer_type_form').prop('action', '{{ route('customer_type_delete') }}');
                        $('#customer_type_form').submit();
                    }
                });
                console.log(data);
            });

            $('#clear-btn').click(function() {
                $('#customer_type_form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });
        });
    </script>
@endsection
