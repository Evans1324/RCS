@extends('layouts.app', ['page' => __('Form 56'), 'pageSlug' => 'account_subtitles'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Account Subtitles Settings</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <form name="account_subtitles_form" id="account_subtitles_form" method="post"
                            action="{{ url('account_subtitles_form') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 d-none">
                                        <label for="subTitleID">ID</label>
                                        <input type="text" class="form-control" name="subTitleID" id="subTitleID">
                                        {{-- <la4+65 --}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="subTitle">Subtitle</label>
                                        <input type="text" class="form-control mb-0 bg-white text-dark" name="subTitle"
                                            id="subTitle">
                                            
                                        <label class="text-danger">
                                            @error('subTitle')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="titleName">Title</label>
                                        <select class="form-control bg-white text-dark" name="titleName" id="titleName">
                                            <option class="bg-white"></option>
                                            @foreach ($display_group_cat as $item)
                                                <option class="bg-white" value="{{$item->id}}">{{$item->title_name}}</option>
                                            @endforeach
                                        </select>
                                        <label class="text-danger">
                                            @error('titleName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="button" id="clear-btn-sub"
                                            class="btn btn-success mx-auto d-none">Clear</button>
                                        <button type="submit" id="submit-btn-sub" class="btn btn-success mx-auto">Add</button>
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
                                        <table class="table tablesorter" id="account-subtitles-table">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th>Action</th>
                                                    <th>ID</th>
                                                    <th>Subtitle</th>
                                                    <th>Title</th>
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
        let data = @json($acc_subtitles);
        let message = @json(session('Message'));
        if (message != null) {
            Swal.fire(message);
        }
        $(document).ready(function() {
            let table = $('#account-subtitles-table').DataTable({
                data: data,
                columns: [{
                        'data': 'id',
                        render: function(data, type, row) {
                            return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-icon"><i class="tim-icons icon-simple-remove"></i></button>';
                        }
                    },
                    {
                        'data': 'main_id'
                    },
                     {
                        'data': 'subtitle'
                    },
                     {
                        'data': 'title_name'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }, 
                    {
                        'data': 'sub_id'
                    }
                ],
                "columnDefs": [{
                    "targets": [1, 6],
                    "visible": false,
                }], 
            });

            let oldInputs = @json(count(Session::getOldInput()));
            if (oldInputs == 0) {
                let SubtitleInput = @json($display_group_cat);
                $('#title-menu1').val(SubtitleInput.title_name);
            }
            

            $('#account-subtitles-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                console.log(data);
                $('#subTitleID').val(data[1]);
                $('#subTitle').val(data[2]);
                $('#titleName').val(data[6]);
                $('#titleName').trigger('change');
                $('#submit-btn-sub').html('Update');
                $('#clear-btn-sub').removeClass('d-none');
            });

            $('#account-subtitles-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#subTitleID').val(data[1]);
                        $('#account_subtitles_form').prop('action', '{{ route('subtitles_soft_delete') }}');
                        $('#account_subtitles_form').submit();
                    }
                });
            });

            $('#clear-btn-sub').click(function() {
                $('#account_subtitles_form')[0].reset();
                $('#submit-btn-sub').html('Add');
                $(this).addClass('d-none');
            });
        });
    </script>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Nested Account Subtitles Settings</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <form name="submitNestedSubtitles" id="submitNestedSubtitles" method="post"
                            action="{{ url('submitNestedSubtitles') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 d-none">
                                        <label for="nestedSubtitleID">ID</label>
                                        <input type="text" class="form-control" name="nestedSubtitleID" id="nestedSubtitleID">
                                        {{-- <la4+65 --}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nestedSubtitle">Nested Subtitle</label>
                                        <input type="text" class="form-control mb-0 bg-white text-dark" name="nestedSubtitle"
                                            id="nestedSubtitle">
                                            
                                        <label class="text-danger">
                                            @error('nestedSubtitle')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="subTitleName">Subtitle</label>
                                        <select class="form-control bg-white text-dark" name="subTitleName" id="subTitleName">
                                            <option class="bg-white"></option>
                                            @foreach ($acc_subtitles as $sub)
                                                <option class="bg-white" value="{{$sub->main_id}}">{{$sub->subtitle}}</option>
                                            @endforeach
                                        </select>
                                        <label class="text-danger">
                                            @error('subTitleName')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="button" id="clear-btn-nested"
                                            class="btn btn-success mx-auto d-none">Clear</button>
                                        <button type="submit" id="submit-btn-nested" class="btn btn-success mx-auto">Add</button>
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
                                        <table class="table tablesorter" id="sub-subtitles-table">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th>Action</th>
                                                    <th></th>
                                                    <th>Subtitle</th>
                                                    <th>Nested Subtitle</th>
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
        let nestedData = @json($nested_subtitles);
        let nestedMessage = @json(session('Message'));
        if (nestedMessage != null) {
            Swal.fire(nestedMessage);
        }
        $(document).ready(function() {
            let table = $('#sub-subtitles-table').DataTable({
                data: nestedData,
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
                        'data': 'subtitle'
                    },
                    {
                        'data': 'sub_subtitles'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    },
                    {
                        'data': 'subs_id'
                    }
                ],
                "columnDefs": [{
                    "targets": [1, 6],
                    "visible": false,
                }], 
            });
            
            $('#sub-subtitles-table tbody').on('click', '.edit', function(e) {
                var idx = table.row($(this).parents('tr'));
                var data = table.cells(idx, '').render('display');
                $('#nestedSubtitleID').val(data[1]);
                $('#nestedSubtitle').val(data[3]);
                $('#subTitleName').val(data[6]);
                $('#subTitleName').trigger('change');
                $('#submit-btn-nested').html('Update');
                $('#clear-btn-nested').removeClass('d-none');
            });

            $('#sub-subtitles-table tbody').on('click', '.delete-btn-cl', function(e) {
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
                        $('#nestedSubtitleID').val(data[1]);
                        $('#submitNestedSubtitles').prop('action', '{{ route('accountNestedSubtitlesDelete') }}');
                        $('#submitNestedSubtitles').submit();
                    }
                });
            });

            $('#clear-btn-nested').click(function() {
                $('#submitNestedSubtitles')[0].reset();
                $('#submit-btn-nested').html('Add');
                $(this).addClass('d-none');
            });
        });
    </script>
@endsection