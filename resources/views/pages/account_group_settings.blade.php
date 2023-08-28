@extends('layouts.app', ['page' => __('Acc. Group Settings'), 'pageSlug' => 'account_group_settings'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Account Group Settings</h1>
            </div>
            <form name="account-group-settings-form" id="account-group-settings-form" method="post"
                action="{{ url('account-group-form') }}">
                @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="col-md-12 d-none">
                                    <label for="groupID">ID</label>
                                    <input type="text" class="form-control" name="groupID" id="groupID">
                                    <label class="text-danger">
                                        @error('titleName')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <label for="inputType">Type</label>
                                        <input type="text" name="inputType" class="form-control bg-white text-dark" id="inputType">
                                        <label class="text-danger">
                                            @error('titleName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                    
                                    <div class="row">
                                        <label for="inputCategoryType">Category Type</label>
                                        <select class="form-control bg-white text-dark" name="inputCategoryType" id="inputCategoryType">
                                            <option class="bg-white"></option>
                                            @foreach ($display_categories as $item)
                                                <option class="bg-white" value="{{$item->id}}">{{$item->acc_category_settings}}</option>
                                            @endforeach
                                        </select>
                                        
                                        
                                        <label class="text-danger">
                                            @error('titleName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

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
                                            <table class="table tablesorter " id="acc-group-table">
                                                <thead class=" text-primary">
                                                    <tr>
                                                        <th></th>
                                                        <th>ID</th>
                                                        <th>Account Group Type</th>
                                                        <th>Account Group Category</th>
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
            </form>
        </div>
    </div>

    <script>
        let data = @json($acc_group);
        let message = @json(session('Message'));
        console.log(message);
        if (message != null) {
            Swal.fire(message);
        }
        $(document).ready(function() {
            let table = $('#acc-group-table').DataTable({
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
                        'data': 'type'
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

            $('#acc-group-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                $('#groupID').val(data[1]);
                $('#inputType').val(data[2]);
                $('#inputCategoryType').val(data[3]);
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');

                console.log(data);
            });

            $('#acc-group-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#groupID').val(data[1]);
                        $('#account-group-settings-form').prop('action', '{{ route('group_soft_delete') }}');
                        $('#account-group-settings-form').submit();
                    }
                });
                console.log(data);
            });

            $('#clear-btn').click(function() {
                $('#account-group-settings-form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });
        });
    </script>
@endsection
