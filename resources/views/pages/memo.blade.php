@extends('layouts.app', ['page' => __('Memo Entry'), 'pageSlug' => 'Memo Entry'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Memo Entry/JEV</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form name="memoCollection" id="memoCollection" method="post" action="{{ url('submitMemoCollections') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 d-none">
                                <label for="memoID">ID</label>
                                <input type="text" class="form-control" name="memoID" id="memoID">
                            </div>


                            <div id="selectDate" class="col-md-4">
                                <label class="text-light" for="memoSelectDate">Select Date</label>
                                <input type="text" name="memoSelectDate" id="memoSelectDate" class="form-control currentDate bg-white text-dark mb-3"/>
                            </div>

                            <div id="editDateRow" class="col-sm-4 d-none">
                                <label class="text-light" for="editDate">Date</label>
                                <input type="text" name="editDate" class="form-control currentDate bg-white text-dark mb-3" id="editDate"/>
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="memoEntryType">Entry Type</label>
                                <select class="form-control bg-white text-dark" name="memoEntryType" id="memoEntryType">
                                    <option class="bg-white"  value=""></option>
                                    <option class="bg-white"  value="Memo Entry">Memo Entry</option>
                                    <option class="bg-white"  value="Journal Entry Voucher">Journal Entry Voucher</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="memoControlNum">Control No.</label>
                                <input type="text" name="memoControlNum" id="memoControlNum" class="form-control bg-white text-dark mb-3"/>
                            </div>
                        </div>

                        <div class="row account mt-5" id="account">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table tablesorter" id="new-land-tax-table">
                                        <thead>
                                            <tr>
                                                <th class="bg-dark">Account</th>
                                                <th class="bg-dark"></th>
                                                <th class="bg-dark"></th>
                                                <th class="bg-dark"></th>
                                                <th class="bg-dark">Nature</th>
                                                <th class="bg-dark">Amount</th>
                                                <th class="bg-dark">
                                                    <button id="addRowAccount" type="button"
                                                        class="btn btn-info btn-sm tim-icons icon-simple-add"></button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="inputRow">
                                            <tr>
                                                <td class="d-none">
                                                    <input type="text" id="memoAccountID" name="memoAccountID"
                                                        class="memoAccountID form-control mb-0 bg-white text-dark">
                                                </td>
                                                <td style="width: 40%">
                                                    <input type="text" name="memoAccount[]"
                                                        class="memoAccount form-control mb-0 bg-white text-dark">
                                                </td>
                                                <td></td>
                                                <td>
                                                    <input readonly type="text" class="d-none" name="memoTypeRate[]">
                                                </td>
                                                <td>
                                                    <input readonly type="text" name="memoQuantity[]"
                                                        class="d-none memoQuantity bg-light form-control mb-0 text-dark">
                                                </td>
                                                <td style="width: 40%"> 
                                                    <input type="text" name="memoNature[]"
                                                        class="memoNature form-control mb-0 bg-white text-dark">
                                                </td>
                                                <td>
                                                    <input type="text" name="memoAmount[]"
                                                        class="memoAmount form-control mb-0 bg-white text-dark">
                                                </td>

                                                <td></td>
                                            </tr>

                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <input type="text" id="memoTotal" name="memoTotal"
                                                        class="form-control mb-0 bg-light text-dark" id="memoTotal">
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <button type="button" id="clearData" class="clearDataForm float-right btn btn-primary d-none">Clear</button>
                                <button type="button" id="memoSave" class="float-right btn btn-primary">Save</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table tablesorter " id="memo-table">
                                            <thead class=" text-primary bg-dark">
                                                <tr>
                                                    <th class="bg-dark">Action</th>
                                                    <th class="bg-dark">User</th>
                                                    <th class="bg-dark">Date</th>
                                                    <th class="bg-dark">Entry Type</th>
                                                    <th class="bg-dark">Control Number</th>
                                                    <th class="bg-dark">Total Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('.currentDate').flatpickr({
            enableTime: true,
            dateFormat: 'm/d/Y H:i',
            //defaultDate: new Date(),
        });
        
        $(document).ready(function() {
            memoTable = $('#memo-table').DataTable({
                info: false,
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                pageLength: 10,
                dateFormat: 'yyyy-mm-dd',
                processing: true,
                serverSide: true,
                recordsTotal: 50,
                // stateSave: true,
                paging: true,
                ajax: {
                    url:'{{route("getMemoTransactionData")}}',
                    type: 'POST',
                    dataType: "json",
                    dataSrc: function ( json ) {
                    return json.data;
                    },
                    headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                autoWidth: false,
                columns: [{
                        'data': 'main_id',
                        render: function(data, type, row) {
                            if (row.certificate == 'None') {
                                if (row.status == 'Cancelled') {
                                    return '<button type="button" rel="tooltip" class="restore-btn btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-refresh-01"></i></button>';
                                } else {
                                    return '<button type="button" rel="tooltip" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" rel="tooltip" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button style="background:#d47720" type="button" rel="tooltip" class="cancel-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-remove"></i></button>';
                                }
                            } else {
                                if (row.status == 'Cancelled') {
                                    return '<button type="button" rel="tooltip" class="restore-btn btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-refresh-01"></i></button>';
                                } else {
                                    return '<button type="button" data-toggle="tooltip" data-placement="top" title="Edit Receipt" class="edit btn btn-success btn-sm btn-round btn-icon"><i class="tim-icons icon-settings"></i></button><button type="button" data-toggle="tooltip" data-placement="top" title="Delete Receipt" id="delete-btn" class="delete-btn-cl btn btn-danger btn-sm btn-round btn-icon"><i class="tim-icons icon-trash-simple"></i></button><button type="button" style="background:#d47720" data-toggle="tooltip" data-placement="top" title="Cancel Receipt" class="cancel-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-simple-remove"></i></button>'/*<a target="_blank" data-toggle="tooltip" data-placement="top" title="Print Receipt" style="background: #355f96;" class="receipt-btn btn btn-sm btn-round btn-icon"><i class="tim-icons icon-tag"></i></a>*/;
                                }
                            }
                        }
                    },
                    {  
                        'data': 'receipt_type', // for the purpose of databales looking for data
                        render: function(data, type, row) {
                            return 'User 1'
                        }
                    },
                    {
                        'data': 'memo_date'
                    },
                    {
                        'data': 'entry_type'
                    },
                    {
                        'data': 'control_number'
                    },
                    {
                        'data': 'total_amount'
                    },
                    {
                        'data': 'order'
                    },
                ], 
                "columnDefs": [{
                    "targets": [6],
                    "visible": false,
                }], 
                "order": [ 5, "desc" ]
            });

            $('#memo-table tbody').on('click', '.edit', function(e) {
                var idx = memoTable.row($(this).parents('tr'));
                var originalData = memoTable.cells(idx, '').data();
                var data = memoTable.row( $(this).parents('tr') ).data();
                
                $('#memoSelectDate').val(moment(data.report_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY h:mm'));
                console.log(originalData[0]);
                $('.clearDataForm').removeClass('d-none');
                $('#memoID').val(originalData[0]);
                $('#memoEntryType').val(data.entry_type);
                $('#memoControlNum').val(data.control_number);
                
                $('.setNewDataCash').html('Update');
                $('.edit-trigger').attr('readonly', false);
                $('.edit-trigger').addClass('bg-white');
                
                let memoAcc = $('.memoAccount')[0];
                let memoNature = $('.memoNature')[0];
                let memoQuantity = $('.memoQuantity')[0];
                let memoAmount = $('.memoAmount')[0];
                let memoTypeRate = $('.memoTypeRate')[0];
                $(memoAcc).val('');
                $(memoNature).val('');
                $(memoQuantity).val('');
                $(memoAmount).val('');
                $(memoTypeRate).val('');

                $('#memoTotal').val('');
                $('.newRow').remove();
                $.ajax({
                    method: "POST",
                    url: "{{ route('land_tax_acc_data') }}",
                    // async: false,
                    data: {
                        id: originalData[0]
                    }
                }).done(function(accData) {
                    let rowCount = accData.length - 1;
                    if (accData.length > 0) {
                        let memoAcc = $('.memoAccount')[0];
                        let memoNature = $('.memoNature')[0];
                        let memoQuantity = $('.memoQuantity')[0];
                        let memoAmount = $('.memoAmount')[0];
                        let memoTypeRate = $('.memoTypeRate')[0];
                        $(memoAcc).val(accData[0].account);
                        $(memoNature).val(accData[0].nature);
                        $(memoQuantity).val(accData[0].quantity);
                        $(memoAmount).val(accData[0].amount);
                        $(memoTypeRate).val(accData[0].rate_type);

                        let total = parseFloat(accData[0].amount);
                        for (let i = 1; i <= rowCount; i++) {
                            $('#addRowAccount').trigger('click');
                            memoAcc = $('.memoAccount')[i];
                            memoNature = $('.memoNature')[i];
                            memoQuantity = $('.memoQuantity')[i];
                            memoAmount = $('.memoAmount')[i];
                            memoTypeRate = $('.memoTypeRate')[i];
                            total = parseFloat(accData[i].amount) + total;
                            $(memoAcc).val(accData[i].account);
                            $(memoNature).val(accData[i].nature);
                            $(memoQuantity).val(accData[i].quantity);
                            $(memoAmount).val(accData[i].amount);
                            $(memoTypeRate).val(accData[i].rate_type);
                        }
                        $('#memoTotal').val(parseFloat(total).toFixed(2));
                    }
                    $('.memoAmount').trigger('keyup');
                    $('#memoTotal').trigger('change');
                });
            });

            $('#memo-table tbody').on('click', '.delete-btn-cl', function(e) {
                var idx = memoTable.row($(this).parents('tr'));
                var data = memoTable.cells(idx, '').data('display');
                var originalData = memoTable.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to delete this Transaction?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#memoID').val(data[0]);
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('deleteMemoData') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0]
                        }
                        }).done(function(data) {
                            $('#memo-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Successfully Deleted',
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                });
            });

            $('#memo-table tbody').on('click', '.cancel-btn', function (e) {
                var idx = memoTable.row($(this).parents('tr'));
                var originalData = memoTable.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to cancel this Transaction?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Cancel',
                    icon: 'warning'
                }).then((result) => {   
                    if (result.isConfirmed) {
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('cancelMemoData') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                        }
                        }).done(function(data) {
                            $('#memo-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Updating Transaction Status',
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                });
            });

            $('#memo-table tbody').on('click', '.restore-btn', function (e) {
                var idx = memoTable.row($(this).parents('tr'));
                var originalData = memoTable.cells(idx, '').data();

                Swal.fire({
                    title: 'Restore this receipt?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Restore',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                        type: "POST",
                        url: "{{ route('restoreMemoData') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                        }
                        }).done(function(data){
                            $('#memo-table').DataTable().ajax.reload();
                        });

                        Swal.fire({
                            title: 'Updating Transaction Status',
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    } else {
                        Swal.fire('Problem Occured');
                    }
                });
            });
        });

        $('.clearDataForm').click(function() {
            $('#memoCollection')[0].reset();
            $('.clearDataForm').addClass('d-none');
            $('.newRow').remove();
            $('.setNewDataCash').html('Save');
            $(this).addClass('d-none');
            $('.edit').removeClass('bg-white');
        });

        let autoCompleteData = [];
        var category_autocomplete = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('generateAccTitles') }}',
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "term": request.term,
                        "municipality": $('#memoMunicipality').val()
                    },
                    'method': "post",
                    'dataType': "json",
                    'success': function(data) {
                        autoCompleteData = data;
                        response(data);
                        
                    }
                });
            },
        }

        $(".memoAccount").autocomplete(category_autocomplete).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $('#addRowAccount').click(function() {
            var html = '';
            html += '<tr class="newRow">';
            html += '<td class="d-none"><input type="text"name="memoAccountID[]" class="memoAccountID form-control mb-0 bg-white text-dark">';

            html += '<td style="width: 40%">';
            html += '<input type="text" name="memoAccount[]" class="memoAccount form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '<input readonly type="text" name="memoTypeRate[]"class="d-none memoTypeRate form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input readonly type="text" name="memoQuantity[]"class="d-none memoQuantity form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '</td>';

            html += '<td style="width: 40%">';
            html += '<input type="text" name="memoNature[]" class="memoNature form-control mb-0 bg-white text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input type="text" name="memoAmount[]" class="memoAmount form-control mb-0 bg-white text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<div><button type="button" class=" removeRow btn btn-danger btn-sm mb-4 tim-icons icon-simple-delete"></button></div>';
            html += '</td>';
            html += '</tr>';

            let lastRow = $('#inputRow').find('tr').last();
            $('#inputRow').append(html);

            $(".memoAccount").autocomplete(category_autocomplete).focus(function() {
                $(this).autocomplete('search', $(this).val())
            });

            $('.removeRow').on('click', function() {
                $(this).closest('tr').remove();
                $('.memoAmount').trigger('change');
            });

            $('.memoAmount').keyup(function () {
                $(this).mask("#00,000,000,000,000.00", {reverse: true});

                var sum = 0.00;
                $('.memoAmount').each(function() {
                    let stringFloat = '0.00';
                    if ($(this).val() != '') {
                        stringFloat = $(this).val();
                    }
                    let float = stringFloat.replace(/\,/g,'');
                    sum = sum + parseFloat(float);
                });
                sum = sum.toFixed(2);
                $('#memoTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            });
        });


        $('.memoAmount').keyup(function () {
            $(this).mask("#00,000,000,000,000.00", {reverse: true});

            var sum = 0.00;
            $('.memoAmount').each(function() {
                let stringFloat = '0.00';
                if ($(this).val() != '') {
                    stringFloat = $(this).val();
                }
                let float = stringFloat.replace(/\,/g,'');
                console.log(float);
                sum = sum + parseFloat(float);
            });
            sum = sum.toFixed(2);
            $('#memoTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('.memoAmount').change(function() {
            var sum = 0.00;
            $('.memoAmount').each(function() {
                let stringFloat = '0.00';
                if ($(this).val() != '') {
                    stringFloat = $(this).val();
                }
                let float = stringFloat.replace(/\,/g,'');
                sum = sum + parseFloat(float);
            });
            sum = sum.toFixed(2);
            $('#memoTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('#memoSave').click(function() {
            let memoData = $('#memoCollection').serializeArray();

            Swal.fire({
                icon: 'info',
                title: 'Form will be Saved. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        'url': '{{ route('saveMemoTransaction') }}',
                        'data': memoData,
                        'method': "post",
                        'dataType': "json",
                        'success': function(data) {
                            // generate popup if transaction failed
                        }
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'Data has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#memoCollection')[0].reset();
                    $('#clearData').addClass('d-none')
                    $('#memo-table').DataTable().ajax.reload();
                }
            });
        });
    </script>
@endsection