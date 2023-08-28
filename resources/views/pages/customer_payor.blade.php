@extends('layouts.app', ['page' => __('Customer/Payor'), 'pageSlug' => 'customer_payor'])

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Customer/Payor</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <label for="inputLastName">Last Name</label>
                        <input type="text" class="form-control" id="inputLastName">
                    </div>

                    <div class="col-md-5">
                        <label for="inputFirstName">First Name</label>
                        <input type="text" class="form-control" id="inputFirstName">
                    </div>

                    <div class="col-md-2">
                        <label for="inputMiddleInitial">M.I.</label>
                        <input type="text" class="form-control" id="inputMiddleInitial">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress">
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title"> Simple Table</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Country
                                        </th>
                                        <th>
                                            City
                                        </th>
                                        <th class="text-center">
                                            Salary
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Dakota Rice
                                        </td>
                                        <td>
                                            Niger
                                        </td>
                                        <td>
                                            Oud-Turnhout
                                        </td>
                                        <td class="text-center">
                                            $36,738
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Minerva Hooper
                                        </td>
                                        <td>
                                            Curaçao
                                        </td>
                                        <td>
                                            Sinaai-Waas
                                        </td>
                                        <td class="text-center">
                                            $23,789
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Sage Rodriguez
                                        </td>
                                        <td>
                                            Netherlands
                                        </td>
                                        <td>
                                            Baileux
                                        </td>
                                        <td class="text-center">
                                            $56,142
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Philip Chaney
                                        </td>
                                        <td>
                                            Korea, South
                                        </td>
                                        <td>
                                            Overland Park
                                        </td>
                                        <td class="text-center">
                                            $38,735
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Doris Greene
                                        </td>
                                        <td>
                                            Malawi
                                        </td>
                                        <td>
                                            Feldkirchen in Kärnten
                                        </td>
                                        <td class="text-center">
                                            $63,542
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Mason Porter
                                        </td>
                                        <td>
                                            Chile
                                        </td>
                                        <td>
                                            Gloucester
                                        </td>
                                        <td class="text-center">
                                            $78,615
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Jon Porter
                                        </td>
                                        <td>
                                            Portugal
                                        </td>
                                        <td>
                                            Gloucester
                                        </td>
                                        <td class="text-center">
                                            $98,615
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


{{-- @stack('js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    @stack('js') --}}
