@extends('layouts.app', ['page' => __('Special Case'), 'pageSlug' => 'special_case'])

@section ('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Special Case</h1>
            </div>
            <div class="card-body">
                <form name="special-case-form" id="special-case-form" method="post"
                action="{{ url('submitSpecialCaseForm') }}">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 d-none">
                                <label class="text-light" for="specialCaseID">Special Case ID</label>
                                <input type="text" class="form-control bg-white text-dark" name="specialCaseID" id="specialCaseID">
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="barangaySource">Barangay Source</label>
                                <input type="text" class="form-control bg-white text-dark" name="barangaySource" id="barangaySource">
                                <label class="text-danger">
                                @error('barangaySource')
                                    {{ $message }}
                                @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="percentageSource">Percentage Source</label>
                                <input type="text" class="form-control bg-white text-dark" name="percentageSource" id="percentageSource">
                                <label class="text-danger">
                                @error('percentageSource')
                                    {{ $message }}
                                @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="barangaySharing">Sharing of Barangay</label>
                                <input type="text" class="form-control bg-white text-dark" name="barangaySharing" id="barangaySharing">
                                <label class="text-danger">
                                @error('barangaySharing')
                                    {{ $message }}
                                @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="percentageShare">Percentage Share</label>
                                <input type="text" class="form-control bg-white text-dark" name="percentageShare" id="percentageShare">
                                <label class="text-danger">
                                @error('percentageShare')
                                    {{ $message }}
                                @enderror
                                </label>
                            </div>

                            {{-- NEXT ROW --}}

                            <div class="col-md-3">
                                <label class="text-light" for="spRemarks">Remarks</label>
                                <input type="text" class="form-control bg-white text-dark" name="spRemarks" id="spRemarks">
                                <label class="text-danger">
                                @error('spRemarks')
                                    {{ $message }}
                                @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="spStartEffectivity">Start of Effectivity</label>
                                <input type="text" class="form-control bg-white text-dark effectivityDates" name="spStartEffectivity" id="spStartEffectivity">
                                <label class="text-danger">
                                @error('spStartEffectivity')
                                    {{ $message }}
                                @enderror
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label class="text-light" for="spEndEffectivity">End of Effectivity</label>
                                <input type="text" class="form-control bg-white text-dark effectivityDates" name="spEndEffectivity" id="spEndEffectivity">
                                <label class="text-danger">
                                @error('spEndEffectivity')
                                    {{ $message }}
                                @enderror
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" id="clear-btn" class="btn btn-success mx-auto d-none">Clear</button>
                                <button type="submit" id="submit-btn" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        {{-- <p class="category"> Here is a subtitle for this table</p> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="special-case-table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Barangay Source</th>
                                        <th>Percentage Source</th>
                                        <th>Sharing of Barangay</th>
                                        <th>Percentage Share</th>
                                        <th>Remarks</th>
                                        <th>Start of Effectivity</th>
                                        <th>End of Effectivity</th>
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
        $('.effectivityDates').flatpickr({
            dateFormat: 'Y-m-d',
        });
        $(document).ready(function() {
            let data = @json($getSpecialCases);
            let message = @json(session('Message'));
            if (message != null) {
                Swal.fire(message);
            }
            let table = $('#special-case-table').DataTable({
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
                        'data': 'source_barangay'
                    },
                    {
                        'data': 'source_percentage'
                    },
                    {
                        'data': 'barangay_sharing'
                    },
                    {
                        'data': 'percentage_sharing'
                    },
                    {
                        'data': 'remarks'
                    },
                    {
                        'data': 'effectivity_date'
                    },
                    {
                        'data': 'effectivity_end_date'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }
                ],
                "columnDefs": [
                    {
                        "targets": [ 1 ],
                        "visible": false
                    }
                ],
                "order": [ 8, "desc" ]
            });

            $('#special-case-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                $('#specialCaseID').val(data[1]); 
                $('#barangaySource').val(data[2]);
                $('#percentageSource').val(data[3]);
                $('#barangaySharing').val(data[4]);
                $('#percentageShare').val(data[5]);
                $('#spRemarks').val(data[6]);
                $('#spStartEffectivity').val(data[7]);
                $('#spEndEffectivity').val(data[8]);
                $('#submit-btn').html('Update');
                $('#clear-btn').removeClass('d-none');
            });

            $('#clear-btn').click(function() {
                $('#special-case-form')[0].reset();
                $('#submit-btn').html('Add');
                $(this).addClass('d-none');
            });

            $('#special-case-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#specialCaseID').val(data[0]);
                        $('#special-case-form').prop('action', '{{ route('deleteSpecialCaseForm') }}');
                        $('#special-case-form').submit();
                    }
                });
            });
        });

        $('#percentageSource').keyup(function () {
            $(this).mask("#00,000,000,000,000.00", {reverse: true});
        });

        $('#percentageShare').keyup(function () {
            $(this).mask("#00,000,000,000,000.00", {reverse: true});
        });

        var barangay_source_auto = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getMunBar') }}',
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "term": request.term,
                    },
                    'method': "post",
                    'dataType': "json",
                    'success': function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                if (ui.item == null || ui.item == "") {
                    $(this).val('');
                    $('#barangaySource').val('');
                } else {

                }
            },
            change: function(event, ui) {
            }
        }

        $("#barangaySource").autocomplete(barangay_source_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $("#barangaySharing").autocomplete(barangay_source_auto).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });
    </script>
@endsection