@extends('layouts.app', ['page' => __('Permittees Others'), 'pageSlug' => 'permittees_others'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Permittees Others</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form name="permittees-others-form" id="permittees-others-form" method="post" action="{{ url('saveNewPermitteesOthersForm') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 d-none">
                                        <label for="permitteesOthersID">ID</label>
                                        <input type="text" class="form-control" name="permitteesOthersID" id="permitteesOthersID">
                                        <label class="text-danger">
                                            @error('permitteesOthersID')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="permitteesOthersType">Account Type</label>
                                        <select class="form-control bg-white text-dark" name="permitteesOthersType" id="permitteesOthersType">
                                            <option class="bg-white" value=""></option>
                                            <option class="bg-white" value="Franchise Tax">Franchise Tax</option>
                                            <option class="bg-white" value="Printing & Publication">Printing & Publication</option>
                                        </select>
                                        <label class="text-danger">
                                            @error('permitteesOthersType')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <label for="permitteesOthersTradeName">Trade Name</label>
                                        <input type="text" class="form-control bg-white text-dark" name="permitteesOthersTradeName" id="permitteesOthersTradeName">
                                        <label class="text-danger">
                                            @error('permitteesOthersTradeName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="proprietorOthers">Proprietor</label>
                                        <input type="text" class="form-control bg-white text-dark" name="permitteesOthers" id="permitteesOthers">
                                        <label class="text-danger">
                                            @error('permitteesOthers')
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
                            <table class="table tablesorter " id="permittees-others-table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th></th>
                                        <th>Type</th>
                                        <th>Trade Name</th>
                                        <th>Proprietor</th>
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
            let data = @json($getOthers);
            let message = @json(session('Message'));
            if (message != null) {
                Swal.fire(message);
            }
            let table = $('#permittees-others-table').DataTable({
                data: data,
                columns: [{

                        'data': 'id',
                        render: function(data, type, row) {
                            return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-icon"><i class="tim-icons icon-simple-remove"></i></button>';
                        }
                    },
                    {
                        'data': 'account_type'
                    },
                    {
                        'data': 'trade_name'
                    },
                    {
                        'data': 'proprietor'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }
                ],
                "order": [ 5, "desc" ]
            });

            $('#permittees-others-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                
                $('#permitteesOthersID').val(data[0]);
                $('#permitteesOthersType').val(data[1]);
                $('#permitteesOthersTradeName').val(data[2]);
                $('#permitteesOthers').val(data[3]);
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');
            });

            $('#clear-btn').click(function() {
                $('#permittees-others-form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });

            $('#permittees-others-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#permitteesOthersID').val(data[0]);
                        $('#permittees-others-form').prop('action', '{{ route('deletePermitteesOthersForm') }}');
                        $('#permittees-others-form').submit();
                    }
                });
            });
            
        });
    </script>
@endsection