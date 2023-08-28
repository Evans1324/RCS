@extends('layouts.app', ['page' => __('Form 56'), 'pageSlug' => 'form_56'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Form 56 (Real Property Tax)</h1>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form name="form56_form" id="form56_form" method="post" action="{{ url('update_form56') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="inputEffectivityYear">EFFECTIVITY YEAR</label>
                                        <input type="text" name="inputEffectivityYear"
                                            class="yearpicker form-control mb-0 bg-white text-dark"
                                            id="inputEffectivityYear" value="{{ old('inputEffectivityYear') }}">
                                        <label class="text-danger">
                                            @error('inputEffectivityYear')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="inputTaxPercentage">TAX PERCENTAGE TO BE COLLECTED</label>
                                        <input type="text" name="inputTaxPercentage"
                                            class="form-control mb-0 bg-white text-dark" id="inputTaxPercentage"
                                            value="{{ old('inputTaxPercentage') }}">
                                        <label class="text-danger">
                                            @error('inputTaxPercentage')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="inputAidFull">ADVANCED PAYMENT DISCOUNT</label>
                                        <input type="text" name="inputAidFull" class="form-control mb-0 bg-white text-dark"
                                            id="inputAidFull" value="{{ old('inputAidFull') }}">
                                        <label class="text-danger">
                                            @error('inputAidFull')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="inputPaidFull">PROMPT PAYMENT DISCOUNT</label>
                                        <input type="text" name="inputPaidFull" class="form-control mb-0 bg-white text-dark"
                                            id="inputPaidFull" value="{{ old('inputPaidFull') }}">
                                        <label class="text-danger">
                                            @error('inputPaidFull')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="inputPenaltyPerMonth">PENALTY PER MONTH</label>
                                        <input type="text" name="inputPenaltyPerMonth"
                                            class="form-control mb-0 bg-white text-dark" id="inputPenaltyPerMonth"
                                            value="{{ old('inputPenaltyPerMonth') }}">
                                        <label class="text-danger">
                                            @error('inputPenaltyPerMonth')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="button" id="updateForm56" class="update-btn btn btn-success">Update
                                            Form</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h4 class="card-title">District Hospital Remittance</h4>
                                        {{-- <p class="category"> Here is a subtitle for this table</p> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table tablesorter " id="form56-table">
                                                <thead class=" text-primary">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Effectivity Year</th>
                                                        <th>Tax Percentage to be Collected</th>
                                                        <th>Aid in Full Before January</th>
                                                        <th>Paid in Full From January 1 to March 31</th>
                                                        <th>Penalty Per Month</th>
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
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        let data = @json($form56Table);
        $(document).ready(function() {
            let table = $('#form56-table').DataTable({
                data: data,
                columns: [{
                        'data': 'id'
                    },
                    {
                        'data': 'effectivity_year'
                    },
                    {
                        'data': 'tax_precentage'
                    },
                    {
                        'data': 'aid_in_full'
                    },
                    {
                        'data': 'paid_in_full'
                    },
                    {
                        'data': 'penalty_per_month'
                    },
                    {
                        'data': 'created_at'
                    },
                    {
                        'data': 'updated_at'
                    }
                ]
            });
        });

        $(".yearpicker").datepicker({
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        });

        let oldInputs = @json(count(Session::getOldInput()));
        
        if (oldInputs == 0) {
            let form56Input = @json($form56);
            console.log(form56Input);
            $('#inputEffectivityYear').val(form56Input.effectivity_year);
            $('#inputTaxPercentage').val(form56Input.tax_precentage);
            $('#inputAidFull').val(form56Input.aid_in_full);
            $('#inputPaidFull').val(form56Input.paid_in_full);
            $('#inputPenaltyPerMonth').val(form56Input.penalty_per_month);
        }
        

        $('#updateForm56').on('click', function(e) {
            let $form = $(this);
            Swal.fire({
                icon: 'info',
                title: 'Form will be updated. Are you sure you want to proceed?',
                showCancelButton: true,
                confirmButtonText: 'Update',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire('Updated Successfully!', '', 'success')
                    $('#form56_form').submit();
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        });

        console.log(oldInputs);
    </script>
@endsection
