@extends('layouts.lead_assistant')
@section('title','User Lead Request | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">
                           User Lead Request
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container  pull-up">
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
                                    <th>Date</th>
                                    <th>Slot</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!is_null($getLeadRequest))
                                    @foreach($getLeadRequest as $ck => $cv)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cv->user->first_name }} {{ $cv->user->middle_name }} {{ $cv->user->last_name }}</td>
                                            <td>{{ $cv->user->mobile }}</td>
                                            <td>{{ $cv->date }}</td>
                                            <td>{{ $cv->slot->name }}</td>
                                            <td>
                                                <a href="{{ route('imageOne',$cv->user_id) }}" class="btn m-b-15 ml-2 mr-2 btn-dark" target="_blank">Start</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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

