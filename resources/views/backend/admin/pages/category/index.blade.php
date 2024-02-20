@extends('backend.admin.layout.master')
@section('body')
    @include('backend.admin.components.breadcum')


    <div class="card">
        <div class="card-body">
            <div class="table-responsive">

                <table id="dataTable" class="table table-striped table-bordered dataTable" style="width:100%">
                    <thead>
                        <tr role="row">
                            <th>Name</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="sorting_1">Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td>$162,700</td>
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
