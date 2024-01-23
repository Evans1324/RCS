@extends('layouts.app', ['page' => __('Permittees S&G'), 'pageSlug' => 'permittees_sg'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Real Property Tax SEF</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form name="sefCollection" id="sefCollection" method="post" action="{{ url('submitsefCollections') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 d-none">
                                <label for="sefID">ID</label>
                                <input type="text" class="form-control" name="sefID" id="sefID">
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="sefReportNo">Report No.</label>
                                <input id="sefReportNo" type="text" name="sefReportNo" class="form-control bg-white text-dark mb-3"/>
                            </div>

                            <div id="selectDateRow" class="col-md-4">
                                <label class="text-light" for="sefSelectDate">Report Date</label>
                                <input type="text" name="sefSelectDate" id="sefSelectDate" class="form-control currentDate bg-white text-dark mb-3"/>
                            </div>

                            <div id="editDateRow" class="col-sm-4 d-none">
                                <label class="text-light" for="editDate">Date</label>
                                <input type="text" name="editDate" class="form-control currentDate bg-white text-dark mb-3" id="editDate"/>
                            </div>

                            <div class="col-md-4">
                                <label class="text-light" for="sefORNo">OR No.&emsp;<span id="series-counter"></span></label>
                                <select class="form-control text-dark bg-white" name="sefORNo" id="sefORNo"></select>

                                <input class="form-control bg-white text-dark d-none" name="serialNumber" id="serialNumber">
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-sm-4">
                                <label class="text-light" for="sefMunicipality">Municipality</label>
                                <select class="form-control bg-white text-dark" name="sefMunicipality"
                                    id="sefMunicipality">
                                    <option class="bg-white" value=""></option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Collected for the Month</label>
                                <?php
                                    $selected_month = date('m');
                                    echo '<select class="form-control bg-white text-dark" name="rptMonth" id="rptMonth">'."\n";
                                    echo '<option></option>';
                                    for ($i_month = 1; $i_month <= 12; $i_month++) { 
                                        $selected = ($selected_month == $i_month ? ' selected' : '');
                                        echo '<option value="'.date('F', mktime(0,0,0,$i_month,3,0)).'"'.$selected.'>'. date('F', mktime(0,0,0,$i_month,3,0)).'</option>'."\n";
                                    }
                                    echo '</select>'."\n";
                                ?>
                            </div>

                            <div class="col-md-4">
                                <label>Collected for the Year</label>
                                <?php 
                                    $year_start  = 1940;
                                    $year_end = date('Y');
                                    $user_selected_year = date('Y');
                                    echo '<select class="form-control bg-white text-dark" name="rptYear" id="rptYear">'."\n";
                                    for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                                        $selected = ($user_selected_year == $i_year ? ' selected' : '');
                                        echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
                                    }
                                    echo '</select>'."\n";
                                ?>
                            </div>
                        </div>

                        <div class="row account mt-5" id="account">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table tablesorter" id="sef-table">
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
                                                    <input type="text" id="sefAccountID" name="sefAccountID"
                                                        class="sefAccountID form-control mb-0 bg-white text-dark">
                                                </td>
                                                <td style="width: 40%">
                                                    <input type="text" name="sefAccount[]"
                                                        class="sefAccount form-control mb-0 bg-white text-dark">
                                                </td>
                                                <td></td>
                                                <td>
                                                    <input readonly type="text" class="d-none" name="sefTypeRate[]">
                                                </td>
                                                <td>
                                                    <input readonly type="text" name="sefQuantity[]"
                                                        class="d-none sefQuantity bg-light form-control mb-0 text-dark">
                                                </td>
                                                <td style="width: 40%"> 
                                                    <input type="text" name="sefNature[]"
                                                        class="sefNature form-control mb-0 bg-white text-dark">
                                                </td>
                                                <td>
                                                    <input type="text" name="sefAmount[]"
                                                        class="sefAmount form-control mb-0 bg-white text-dark">
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
                                                    <input type="text" id="sefTotal" name="sefTotal"
                                                        class="form-control mb-0 bg-light text-dark" id="sefTotal">
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <input type="text" name="rptSubmission" class="form-control mb-0 bg-white text-dark d-none" value="SEF Collection">
                        
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <button type="button" id="clearData" class="clearDataForm float-right btn btn-primary d-none">Clear</button>
                                <button type="button" id="sefSave" class="float-right btn btn-primary">Save</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table tablesorter " id="sef-data-table">
                                            <thead class=" text-primary bg-dark">
                                                <tr>
                                                    <th class="bg-dark">Action</th>
                                                    <th class="bg-dark">Report No.</th>
                                                    <th class="bg-dark">Report Date</th>
                                                    <th class="bg-dark">Serial Number</th>
                                                    <th class="bg-dark">Municipality</th>
                                                    <th class="bg-dark">Month</th>
                                                    <th class="bg-dark">Year</th>
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
            dateFormat: 'm/d/Y',
            defaultDate: new Date(),
        });

        $.fn.getSeriesRPT = function() {
            $.ajax({
                method: "POST",
                url: "{{ route('getSeriesSEF') }}",
                async: false,
                data: {
                    id: 'Field Tax Collection',
                }
            }).done(function(data) {
                let series = data[0];
                let currentSerial = data[1];
                let previousSerial = data[2];
                $('#sefORNo').html('');
                let html = '';
                if(series != 'N') {
                    series.forEach(element => {
                        html += '<option class="bg-white text-dark" value="' + element.id + '"';
                        if (element.Serial.includes(previousSerial.start_serial) && element.unit == 'Pad') {
                            console.log(1);
                            html += 'selected >';
                            $('#series-counter').html(previousSerial.serial_number+1);
                            $('#serialNumber').val(previousSerial.serial_number+1);
                        } else {
                            console.log(2);
                            html += '>';
                            if (element.unit == 'Pad') {
                                console.log(2.1);
                                $('#series-counter').html(previousSerial.serial_number+1);
                                $('#serialNumber').val(previousSerial.serial_number+1);
                            } else {
                                console.log(2.2);
                                if (element.serial_number == null) {
                                    console.log('2.2.1');
                                    $('#series-counter').html(element.start_serial);
                                    $('#serialNumber').val(element.start_serial);
                                } else {
                                    console.log('2.2.2');
                                    $('#series-counter').html(element.serial_number+1);
                                    $('#serialNumber').val(element.serial_number+1);
                                }
                            }
                        }
                        html += element.Serial +'</option>';
                    });
                    $('#sefORNo').html($('#sefORNo').html() + html);
                }
                
            });
        }
        
        $(document).ready(function() {
            if ($.fn.getSeriesRPT() != undefined) {
                $.fn.getSeriesRPT();
            }
            sefTable = $('#sef-data-table').DataTable({
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
                    url:'{{route("getSEFTransactionData")}}',
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
                        'data': 'report_number'
                    },
                    {
                        'data': 'report_date'
                    },
                    {
                        'data': 'serial_number'
                    },
                    {
                        'data': 'mun_name'
                    },
                    {
                        'data': 'month',
                        render: function(data, type, row) {
                            return row.month;
                        }
                    },
                    {
                        'data': 'year',
                        render: function(data, type, row) {
                            return row.year;
                        }
                    },
                ],
                "order": [ 5, "desc" ]
            });

            $('#sef-data-table tbody').on('click', '.edit', function(e) {
                var idx = sefTable.row($(this).parents('tr'));
                var originalData = sefTable.cells(idx, '').data();
                var data = sefTable.row( $(this).parents('tr') ).data();
                console.log(data);
                
                $('#editDate').val(moment(data.report_date, 'YYYY-MM-DD h:mm').format('MM/DD/YYYY'));
                $('.clearDataForm').removeClass('d-none');
                $('#sefID').val(originalData[0]);
                $('#sefReportNo').val(data.report_number);
                $('#selectDateRow').addClass('d-none');
                $('#editDateRow').removeClass('d-none');
                $('#sefORNo').addClass('d-none');
                $('#serialNumber').removeClass('d-none');
                $('#serialNumber').val(data.serial_number);
                $('#rptMonth').val(data.month);
                $('#rptYear').val(data.year);

                if (data.municipality_id != null) {
                    $('#sefMunicipality').val(data.municipality_id);
                    $('#sefMunicipality').trigger('change');
                } else {
                    $('#sefMunicipality').val('');
                }
                
                $('#sefSave').html('Update');
                $('.edit-trigger').attr('readonly', false);
                $('.edit-trigger').addClass('bg-white');
                
                let sefAcc = $('.sefAccount')[0];
                let sefNature = $('.sefNature')[0];
                let sefQuantity = $('.sefQuantity')[0];
                let sefAmount = $('.sefAmount')[0];
                let sefTypeRate = $('.sefTypeRate')[0];
                $(sefAcc).val('');
                $(sefNature).val('');
                $(sefQuantity).val('');
                $(sefAmount).val('');
                $(sefTypeRate).val('');

                $('#sefTotal').val('');
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
                        let sefAcc = $('.sefAccount')[0];
                        let sefNature = $('.sefNature')[0];
                        let sefQuantity = $('.sefQuantity')[0];
                        let sefAmount = $('.sefAmount')[0];
                        let sefTypeRate = $('.sefTypeRate')[0];
                        $(sefAcc).val(accData[0].account);
                        $(sefNature).val(accData[0].nature);
                        $(sefQuantity).val(accData[0].quantity);
                        $(sefAmount).val(accData[0].amount);
                        $(sefTypeRate).val(accData[0].rate_type);

                        let total = parseFloat(accData[0].amount);
                        for (let i = 1; i <= rowCount; i++) {
                            $('#addRowAccount').trigger('click');
                            sefAcc = $('.sefAccount')[i];
                            sefNature = $('.sefNature')[i];
                            sefQuantity = $('.sefQuantity')[i];
                            sefAmount = $('.sefAmount')[i];
                            sefTypeRate = $('.sefTypeRate')[i];
                            total = parseFloat(accData[i].amount) + total;
                            $(sefAcc).val(accData[i].account);
                            $(sefNature).val(accData[i].nature);
                            $(sefQuantity).val(accData[i].quantity);
                            $(sefAmount).val(accData[i].amount);
                            $(sefTypeRate).val(accData[i].rate_type);
                        }
                        $('#sefTotal').val(parseFloat(total).toFixed(2));
                    }
                    $('.sefAmount').trigger('keyup');
                    $('#sefTotal').trigger('change');
                });
            });

            $('#sef-data-table tbody').on('click', '.delete-btn-cl', function(e) {
                var idx = sefTable.row($(this).parents('tr'));
                var data = sefTable.cells(idx, '').data('display');
                var originalData = sefTable.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to delete this Transaction?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#sefID').val(data[0]);
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('deleteDataSEF') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0]
                        }
                        }).done(function(data) {
                            $('#sef-data-table').DataTable().ajax.reload();
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

            $('#sef-data-table tbody').on('click', '.cancel-btn', function (e) {
                var idx = sefTable.row($(this).parents('tr'));
                var originalData = sefTable.cells(idx, '').data();
                
                Swal.fire({
                    title: 'Do you want to cancel this Transaction?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Proceed',
                    icon: 'warning'
                }).then((result) => {   
                    if (result.isConfirmed) {
                        $.ajax({
                        'method': "POST",
                        'url': "{{ route('cancelDataSEF') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                        }
                        }).done(function(data) {
                            $('#sef-data-table').DataTable().ajax.reload();
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

            $('#sef-data-table tbody').on('click', '.restore-btn', function (e) {
                var idx = sefTable.row($(this).parents('tr'));
                var originalData = sefTable.cells(idx, '').data();

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
                        url: "{{ route('restoreDataSEF') }}",
                        'data': {
                            "_token": "{{ csrf_token() }}",
                            "id": originalData[0],
                        }
                        }).done(function(data){
                            $('#sef-data-table').DataTable().ajax.reload();
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

        $('#clearData').click(function() {
            $('#sefCollection')[0].reset();
            $('#sefORNo').removeClass('d-none');
            $('#serialNumber').addClass('d-none');
            $('.newRow').remove();
            $('#sefSave').html('Save');
            $(this).addClass('d-none');
            $('.edit').removeClass('bg-white');
        });


        $('#sefMunicipality').ready(function() {
            $.ajax({
                method: "POST",
                url: "{{ route('getMunicipality') }}",
                async: false,
                data: {
                    id: $(this).val(),
                    client_type: $('#taxColClientType').val()
                }
            }).done(function(data) {
                $('#sefMunicipality').html('<option class="bg-white" value=""></option>');
                data.forEach(element => {
                    $('#sefMunicipality').html($('#sefMunicipality').html() +
                        '<option class="bg-white" value="' + element.id + '">' + element.municipality + '</option>');
                });
            });
        });

        $('#sefORNo').change(function() {
            $.ajax({
                method: "POST",
                url: "{{ route('getCurrentSerial') }}",
                async: false,
                data: {
                    id: $(this).val(),
                    taxColReceiptType: $('#taxColReceiptType').val()
                }
            }).done(function(data) {
                if (data == 'Serial Error') {
                    Swal.fire({
                        title: 'Please assign a new series',
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: 'Add',
                        icon: 'warning'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href='{{ route('pages.serial')  }}';
                            Swal.fire('Redirecting to Serials page');
                        }
                    });
                    $('#serialNumber').val('');
                    $('#series-counter').html('');
                } else {
                    $('#serialNumber').val(data);
                    $('#series-counter').html(data);
                }
            });
        });

        let autoCompleteData = [];
        var category_autocomplete = {
            minLength: 0,
            autocomplete: true,
            source: function(request, response) {
                $.ajax({
                    'url': '{{ route('getAccountTitlesSEF') }}',
                    'data': {
                        "_token": "{{ csrf_token() }}",
                        "term": request.term,
                        "municipality": $('#sefMunicipality').val()
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

        $(".sefAccount").autocomplete(category_autocomplete).focus(function() {
            $(this).autocomplete('search', $(this).val());
        });

        $('#addRowAccount').click(function() {
            var html = '';
            html += '<tr class="newRow">';
            html += '<td class="d-none"><input type="text"name="sefAccountID[]" class="sefAccountID form-control mb-0 bg-white text-dark">';

            html += '<td style="width: 40%">';
            html += '<input type="text" name="sefAccount[]" class="sefAccount form-control mb-0 bg-white text-dark">';
            html += '</td>'

            html += '<td>';
            html += '<input readonly type="text" name="sefTypeRate[]"class="d-none sefTypeRate form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input readonly type="text" name="sefQuantity[]"class="d-none sefQuantity form-control mb-0 bg-light text-dark">';
            html += '</td>';

            html += '<td>';
            html += '</td>';

            html += '<td style="width: 40%">';
            html += '<input type="text" name="sefNature[]" class="sefNature form-control mb-0 bg-white text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<input type="text" name="sefAmount[]" class="sefAmount form-control mb-0 bg-white text-dark">';
            html += '</td>';

            html += '<td>';
            html += '<div><button type="button" class=" removeRow btn btn-danger btn-sm mb-4 tim-icons icon-simple-delete"></button></div>';
            html += '</td>';
            html += '</tr>';

            let lastRow = $('#inputRow').find('tr').last();
            $('#inputRow').append(html);

            $(".sefAccount").autocomplete(category_autocomplete).focus(function() {
                $(this).autocomplete('search', $(this).val())
            });

            $('.removeRow').on('click', function() {
                $(this).closest('tr').remove();
                $('.sefAmount').trigger('change');
            });

            $('.sefAmount').keyup(function () {
                $(this).mask("#00,000,000,000,000.00", {reverse: true});

                var sum = 0.00;
                $('.sefAmount').each(function() {
                    let stringFloat = '0.00';
                    if ($(this).val() != '') {
                        stringFloat = $(this).val();
                    }
                    let float = stringFloat.replace(/\,/g,'');
                    sum = sum + parseFloat(float);
                });
                sum = sum.toFixed(2);
                $('#sefTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            });
        });

        $('.sefAmount').keyup(function () {
            $(this).mask("#00,000,000,000,000.00", {reverse: true});

            var sum = 0.00;
            $('.sefAmount').each(function() {
                let stringFloat = '0.00';
                if ($(this).val() != '') {
                    stringFloat = $(this).val();
                }
                let float = stringFloat.replace(/\,/g,'');
                sum = sum + parseFloat(float);
            });
            sum = sum.toFixed(2);
            $('#sefTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('.sefAmount').change(function() {
            var sum = 0.00;
            $('.sefAmount').each(function() {
                let stringFloat = '0.00';
                if ($(this).val() != '') {
                    stringFloat = $(this).val();
                }
                let float = stringFloat.replace(/\,/g,'');
                sum = sum + parseFloat(float);
            });
            sum = sum.toFixed(2);
            $('#sefTotal').val(sum.replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });

        $('#sefSave').click(function () {
            let sefData = $('#sefCollection').serializeArray();

            Swal.fire({
                icon: 'info',
                title: 'Form will be Saved. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        'url': '{{ route('rptSubmitFormSEF') }}',
                        'data': sefData,
                        'method': "post",
                        'dataType': "json",
                    });
                    $.ajax({
                        method: "POST",
                        url: "{{ route('updateSeriesStatus') }}",
                        async: false,
                        data: {
                            id: "Field Land Tax Collection",
                            serial: $('#serialNumber').val()
                        }
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'Data has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#sefCollection')[0].reset();
                    $.fn.getSeriesRPT();
                    $('#clearData').addClass('d-none')
                    $('#sef-data-table').DataTable().ajax.reload();
                }
            });
        });
    </script>
@endsection