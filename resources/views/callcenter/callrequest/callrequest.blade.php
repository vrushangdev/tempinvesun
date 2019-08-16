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
        <div class="row m-b-30">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('callcenter.getCallRequest') }}" method="post">    
                            @csrf

                            <div class="form-row">

                                <div class="col-md-4 mb-3">
                                    <label for=""> Date </label>
                                    <input type="text" class="form-control js-datepicker" id="date" name="date" placeholder="Date" autocomplete="off" value="{{ $date }}" readonly="">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">Select Status</option>
                                        <option value="1" @if($status == 1) selected="selected" @endif>Callback</option>
                                        <option value="2" @if($status == 2) selected="selected" @endif>Pending</option>
                                        <option value="3" @if($status == 3) selected="selected" @endif>Successfull</option>
                                        <option value="4" @if($status == 4) selected="selected" @endif>Negative</option>
                                    </select>
                                </div>


                                <div class="col-md-2 mt-4">
                                    <button type="submit" class="btn btn-primary mt-1" id="filter" name="save_and_list" value="save_and_list">Filter Request</button>
                                </div>

                                @if($filter == 1)
                                    <div class="col-md-2 mt-4">
                                        <a href="{{ route('callcenter.getCallRequest') }}" class="btn btn-danger mt-1" id="filter" name="save_and_list" value="save_and_list" style="margin-left: -50px;">Reset</a>
                                    </div>
                                @endif

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
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
                                        @if($cv->user_status == 1)
                                            <tr style="background:#F3E5F5;">
                                        @elseif($cv->user_status == 2)
                                            <tr style="background:#E3F2FD">
                                        @elseif($cv->user_status == 3)
                                            <tr style="background:#E8F5E9">
                                        @elseif($cv->user_status == 4)
                                            <tr style="background:#FFEBEE">
                                        @endif
                                        
                                            <td>{{ $loop->iteration }}</td>
                                            @if($cv->first_name != '')
                                                <td>{{ $cv->first_name }}</td>
                                            @else
                                                <td>{{ $cv->form_name }}</td>
                                            @endif
                                            <td>{{ $cv->mobile }}</td>
                                            <td>{{ date('d-m-Y',strtotime($cv->created_at)) }}</td>
                                            @if($cv->user_status == 1)
                                                <td>{{ $cv->callRequest->is_attend == 1 ? "Follow Up" : "Unattended"}}</td>
                                            @elseif($cv->user_status == 3)
                                                <td>{{ $cv->callRequest->is_attend == 1 ? "Attended" : "Unattended"}}</td>
                                            @else
                                                <td>{{ $cv->callRequest->is_attend == 1 ? "Attended(Reschedule)" : "Unattended"}}</td>
                                            @endif
                                            @if($cv->callRequest->is_attend == 1 && !is_null($cv->callRequest->attened))
                                                @if(!is_null($cv->callRequest->attened->lead_assistant))
                                                    <td>{{ $cv->callRequest->attened->lead_assistant->name }}</td>
                                                @else
                                                    <td>----------</td>
                                                @endif
                                                <td>{{ $cv->callRequest->attened->date }}</td>
                                                <td>{{ $cv->callRequest->attened->slot->name }}</td>
                                            @else
                                                <td>----------</td>
                                                <td>----------</td>
                                                <td>----------</td>
                                            @endif
                                            <td>
                                                @if($cv->user_status == 2)
                                                    <a href="{{ route('callcenter.editUserInfo',$cv->id)}}" class="btn m-b-15 ml-2 mr-2 btn-dark">Attend</a>
                                                @elseif($cv->user_status == 1)
                                                    <a href="{{ route('callcenter.editUserInfo',$cv->id)}}" class="btn m-b-15 ml-2 mr-2 btn-dark">Follow Up</a>
                                                @endif
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

