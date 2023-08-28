@extends('layouts.app', ['page' => __('Form 56'), 'pageSlug' => 'account_titles'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Account Titles Settings</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <form name="account_titles_form" id="account_titles_form" method="post"
                            action="{{ url('account_titles_form') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 d-none">
                                        <label for="titleID">ID</label>
                                        <input type="text" class="form-control" name="titleID" id="titleID">
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="titleCode">Code</label>
                                        <input type="text" class="form-control mb-0 bg-white text-dark" name="titleCode"
                                            id="titleCode">
                                        <label class="text-danger">
                                            @error('titleCode')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="titleName">Title</label>
                                        <input type="text" class="form-control mb-0 bg-white text-dark" name="titleName"
                                            id="titleName">
                                        <label class="text-danger">
                                            @error('titleName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="titleCategory">Category</label>

                                        <select name="titleCategory" id="titleCategory" class="form-control bg-white text-dark">
                                            <option class="bg-white"></option> 
                                            @foreach ($display_group as $item)
                                                <option class="bg-white" value="{{$item->id}}">{{$item->type}}</option>
                                            @endforeach
                                        </select>
                                        <label class="text-danger">
                                            @error('titleCategory')
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
                                        <table class="table tablesorter " id="account-titles-table">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th></th>
                                                    <th>ID</th>
                                                    <th>Code</th>
                                                    <th>Title</th>
                                                    <th>Category</th>
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
        let data = @json($acc_titles);
        let message = @json(session('Message'));
        if (message != null) {
            Swal.fire(message);
        }
        $(document).ready(function() {
            let table = $('#account-titles-table').DataTable({
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
                        'data': 'title_code'
                    },
                    {
                        'data': 'title_name'
                    },
                    {
                        'data': 'type'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    },
                    {
                        'data': 'title_category_id'
                    }
                ],
                "columnDefs": [{
                    "targets": [7],
                    "visible": false,
                }], 
                "order": [ 7, "desc" ]
            });

            $('#account-titles-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                console.log(data);
                $('#titleID').val(data[1]);
                $('#titleCode').val(data[2]);
                $('#titleName').val(data[3]);
                $('#titleCategory').val(data[7]);
                $('#titleCategory').change();
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');
            });

            $('#account-titles-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#titleID').val(data[1]);
                        $('#account_titles_form').prop('action', '{{ route('titles_soft_delete') }}');
                        $('#account_titles_form').submit();
                    }
                });
            });

            $('#clear-btn').click(function() {
                $('#account_titles_form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });
        });
    </script>
@endsection