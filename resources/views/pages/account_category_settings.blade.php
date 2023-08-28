@extends('layouts.app', ['page' => __('Acc. Category Settings'), 'pageSlug' => 'account_category_settings'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Account Category Settings</h1>
            </div>

            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <form name="account_category_settings" id="account_category_settings" method="post" action="{{ url('store-form') }}">
                                @csrf
                                <div class="col-md-12 d-none">
                                    <label for="inputID">ID</label>
                                    <input type="text" class="form-control" name="inputID" id="inputID">
                                    <label>
                                        @error('inputID')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-12">
                                    <h3 class="card-title" for="inputCategory">Category</h3>
                                    {{-- <label for="inputCategory">Category</label> --}}
                                    <input type="text" class="form-control bg-white text-dark" name="inputCategory"
                                        id="inputCategory">
                                    <label>
                                        @error('inputCategory')
                                            <h4 class="text-danger">{{ $message }}</h4>
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="button" id="clear-btn"
                                        class="btn btn-success mx-auto d-none">Clear</button>
                                    <button type="submit" id="submit-btn" class="btn btn-success mx-auto">Add</button>
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
                                        <table class="table tablesorter " id="acc-table">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th></th>
                                                    <th>ID</th>
                                                    <th>Account Category Settings</th>
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
        let data = @json($acc_categories);
        let message = @json(session('Message'));
        console.log(message);
        if (message != null) {
            Swal.fire(message);
        }
        $(document).ready(function() {
            let table = $('#acc-table').DataTable({
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
                        'data': 'acc_category_settings'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }
                ]
            });

            $('#acc-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                $('#inputCategory').val(data[2]);
                $('#inputID').val(data[1]);
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');

                console.log(data);
            });

            $('#acc-table tbody').on('click', '.delete-btn-cl', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                Swal.fire({
                    title: 'Do you want to delete this category?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    icon: 'warning'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $('#inputID').val(data[1]);
                        $('#account_category_settings').prop('action', '{{ route('soft_delete_data') }}');
                        $('#account_category_settings').submit();

                    }
                });

                // $(this).data("id");
                console.log(data);
            });

            $('#clear-btn').click(function() {
                $('#account_category_settings')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });

        });
    </script>

@endsection
