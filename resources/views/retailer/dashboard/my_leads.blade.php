@extends('layouts.retailer')
@section('title','My Leads List | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">
                        My Leads
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container pull-up">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive p-t-10">
                            <table id="example-multi" class="table" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Sr.no</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($findMyLeads as $uk => $uv)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $uv->form_name }}</td>
                                            <td>{{ $uv->mobile }}</td>
                                            <td>{{ $uv->email ? 'Attended' : 'Pending' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection