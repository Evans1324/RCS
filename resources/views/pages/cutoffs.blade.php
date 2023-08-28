@extends('layouts.app', ['page' => __('Cutoffs'), 'pageSlug' => 'cutoffs'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Cutoffs</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form name="report-cutoff-form" id="report-cutoff-form" method="post" action="{{ url('saveReportCutoffForm') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 d-none">
                                        <label for="cutOffID">ID</label>
                                        <input type="text" class="form-control" name="cutOffID" id="cutOffID">
                                        <label class="text-danger">
                                            @error('cutOffID')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="reportCutOff">Cutoff</label>
                                        <input type="text" class="form-control bg-white text-dark" name="reportCutOff" id="reportCutOff">
                                        <label class="text-danger">
                                            @error('reportCutOff')
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
                            <table class="table tablesorter " id="report-cutoff-table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th></th>
                                        <th>Cutoff</th>
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
            let data = @json($setCutOffs);
            let message = @json(session('Message'));
            if (message != null) {
                Swal.fire(message);
            }
            let table = $('#report-cutoff-table').DataTable({
                data: data,
                columns: [{

                        'data': 'id',
                        render: function(data, type, row) {
                            return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-icon"><i class="tim-icons icon-simple-remove"></i></button>';
                        }
                    },
                    {
                        'data': 'collection_cutoff'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }
                ],
                "order": [ 3, "desc" ]
            });

            $('#report-cutoff-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                console.log(data);
                $('#cutOffID').val(data[0]);
                $('#reportCutOff').val(data[1]);
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');
            });

            $('#clear-btn').click(function() {
                $('#report-cutoff-form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });

            $('#report-cutoff-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#report-cutoff-form').prop('action', '{{ route('deleteReportCutoffForm') }}');
                        $('#report-cutoff-form').submit();
                    }
                });
            });
            
        });
    </script>
@endsection