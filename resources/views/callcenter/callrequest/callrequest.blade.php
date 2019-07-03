@extends('layouts.callcenter')
@section('title','User Call Request | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">
                           User Call Request
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
                                    <th>Status</th>
                                    <th>Lead Assist</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!is_null($getCallRequest))
                                    @foreach($getCallRequest as $ck => $cv)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @if($cv->user->first_name != '')
                                                <td>{{ $cv->user->first_name }}</td>
                                            @else
                                                <td>{{ $cv->user->form_name }}</td>
                                            @endif
                                            <td>{{ $cv->user->mobile }}</td>
                                            <td>{{ date('d-m-Y',strtotime($cv->created_at)) }}</td>
                                            <td>{{ $cv->is_attend == 1? "Attended" : "Unattended"}}</td>
                                            @if($cv->is_attend == 1 && !is_null($cv->attened))
                                                <td>{{ $cv->attened->lead_assistant->name }}</td>
                                                <td>{{ $cv->attened->date }}</td>
                                                <td>{{ $cv->attened->slot->name }}</td>
                                            @else
                                                <td>----------</td>
                                                <td>----------</td>
                                                <td>----------</td>
                                            @endif
                                            <td>
                                                <a href="{{ route('callcenter.editUserInfo',$cv->user_id)}}" class="btn m-b-15 ml-2 mr-2 btn-dark" target="_blank">Attend</a>
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

