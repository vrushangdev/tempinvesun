@extends('layouts.callcenter')
@section('title','Edit User | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">  Update User Info</h4>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="{{ route('callcenter.saveUserInfo') }}" id="userForm">
    <div class="container pull-up">
        <div class="row">
            <div class="col-lg-6">
                @csrf
                <input type="hidden" id="user_id" name="id" value="{{ $getUserInfo->id }}">

                <!--widget card begin-->
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                             Update Personal Info
                        </h5>
                    </div>
                    <div class="card-body ">    

                        <div class="form-group">
                            <label for="inputName">Title</label>
                            <select class="form-control" id="inputName" name="title" required>
                                <option value="">Select User Title</option>
                                <option value="1" @if($getUserInfo->title == 1) selected="selected" @endif>Mr.</option>
                                <option value="2" @if($getUserInfo->title == 2) selected="selected" @endif>Mrs.</option>
                                <option value="3" @if($getUserInfo->title == 3) selected="selected" @endif>Ms.</option>
                                <option value="4" @if($getUserInfo->title == 4) selected="selected" @endif>Dr.</option>
                                <option value="5" @if($getUserInfo->title == 5) selected="selected" @endif>Er.</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputFirstName">First Name</label>
                            <input type="text" class="form-control" id="inputFirstName" name="first_name" placeholder="First Name" value="{{ $getUserInfo->form_name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="inputMiddleName">Middle Name</label>
                                <input type="text" class="form-control width" id="inputMiddleName" name="middle_name" placeholder="Middle Name" value="{{ $getUserInfo->middle_name }}" required>
                        </div>  

                        <div class="form-group">
                            <label for="inputSurname">Surname</label>
                            <input type="text" class="form-control" id="inputSurname" name="surname" placeholder="Surname" value="{{ $getUserInfo->last_name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">Address 1</label>
                            <textarea class="form-control" class="form-control" id="inputAddress" name="address1" placeholder="Address" required>{{ $getUserInfo->address1 }} </textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress2">Address 2</label>
                            <textarea class="form-control" class="form-control" id="inputAddress2" name="address2" placeholder="Address">{{ $getUserInfo->address2 }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity" name="city" placeholder="City" value="{{ $getUserInfo->city }}" required>
                        </div>


                        <div class="form-group">
                            <label for="inputPincode">Pincode</label>
                            <input type="text" class="form-control number" minlength="6"  maxlength="6" id="inputPincode" placeholder="Pincode" name="pincode" value="{{ $getUserInfo->pincode }}" required>
                        </div>

                        <div class="form-group">
                            <label for="inputDistrict">District </label>
                            <input type="text" class="form-control" id="inputDistrict" name="district" value="{{ $getUserInfo->district }}" placeholder="District" required>
                        </div>

                        <div class="form-group">
                            <label for="inputState">State</label>
                            <input type="text" class="form-control" id="inputState" placeholder="State" value="{{ $getUserInfo->state }}" name="state" required>
                        </div>

                        <div class="form-group">
                            <label for="inputCountry">Country</label>
                            <input type="text" class="form-control" id="inputCountry" value="{{ $getUserInfo->country }}" placeholder="Country" name="country" required>
                        </div>

                         <div class="form-group">
                            <label for="inputRemark">Remarks</label>
                            <input type="text" class="form-control" id="inputRemark" value="{{ $getUserInfo->remark }}" placeholder="Remark" name="remark">
                        </div>                        

                    </div>
                </div>

            </div>

            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="inputCountry">Billing Address</label>
                            <input type="text" class="form-control" id="inputCountry" placeholder="Country" name="country" value="Same as above" disabled required>
                        </div>

                        <div class="form-group">
                            <label for="inputGst">GST Number</label>
                            <input type="text" class="form-control gst" id="inputGst" placeholder="GST Number" maxLength="15" name="gst" value="{{ $getUserInfo->gst_number }}">
                        </div>

                        <div class="form-group">
                            <label for="inputMobile">Mobile</label>
                            <input type="text" class="form-control number" id="inputMobile" maxLength="10" name="mobile" placeholder="Mobile" value="{{ $getUserInfo->mobile }}" value="{{ $getUserInfo->mobile }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="alt_mobile">Alt Mobile</label>
                            <input type="text" class="form-control number" maxLength="10" id="alt_mobile" value="{{ $getUserInfo->alt_no }}" name="alt_mobile" placeholder="Alternate Mobile">
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="text" class="form-control" id="inputEmail" value="{{ $getUserInfo->email }}" name="email" placeholder="Email" required>
                        </div>

                    </div>
                </div>

                 @if(!is_null($getUserInfo->assigned_lead))
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                Assigend Lead Assistant
                            </h5>
                        </div>
                        <div class="card-body">
                            @if(!is_null($getUserInfo->assigned_lead->lead_assistant))
                                <p>Lead Assistant : <b>{{ $getUserInfo->assigned_lead->lead_assistant->name }}</b></p>
                            @else
                                <p>Lead Assistant : <b>--------------</b></p>
                            @endif
                            <p>Time Slot : <b>{{ $getUserInfo->assigned_lead->slot->name }}</b></p>                           
                        </div>
                    </div>
                @endif

                <div class="card m-b-30 addLeadAssistant">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="inputAppoDate">Appointment Date</label>
                            <input type="text" class="form-control js-datepicker" id="inputAppoDate" placeholder="Appointment Date" name="appointment_date" value="@if(!is_null($getUserInfo->assigned_lead)) {{ $getUserInfo->assigned_lead->date }} @endif" required>
                        </div>
                        @if(is_null($getUserInfo->assigned_lead))
                            <input type="hidden" id="lead_assistant" name="lead_assistant" >
                            <input type="hidden" id="time_slot_id" name="time_slot_id" >
                            <input type="hidden" id="lead_button_id" value="">
                        @else
                            <input type="hidden" id="lead_assistant" name="lead_assistant" value="{{$getUserInfo->assigned_lead->lead_assistant_id}}" >
                            <input type="hidden" id="time_slot_id" name="time_slot_id" value="{{$getUserInfo->assigned_lead->time_slot_id}}">
                            <input type="hidden" id="lead_button_id" value="assign_{{$getUserInfo->assigned_lead->lead_assistant_id}}_{{$getUserInfo->assigned_lead->time_slot_id}}">
                        @endif
                    </div>
                </div>

                @if(!is_null($getUserInfo->assigned_lead))

                    <div class="card m-b-30 leadPopup">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                 Assign Lead Assistant
                            </h5>
                        </div>
                        <div class="card-body">
                        @if(!is_null($lead_data))
                            @foreach($lead_data as $lk => $lv)
                                <p>Lead Assistant Name : {{ $lv['name'] }} </p>
                                <div class="table-responsive">
                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th>Time Slot</th>
                                                <th>Count</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!is_null($lv['appointment_data']))
                                                @foreach($lv['appointment_data'] as $ak => $av)
                                                <tr>
                                                    <td>{{ $av['name'] }}</td>
                                                    <td>{{ $av['count'] }}</td>
                                                    <td>
                                                        <a href="javscript:void(0);" class="btn btn-primary assign assign_{{ $lv['id'] }}_{{ $av['id'] }}" data-id="{{ $lv['id'] }}" data-value="{{ $av['id'] }}">
                                                        @if($av['assign'] == 0)
                                                            Assign
                                                        @else
                                                            Assigned
                                                        @endif
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        @endif
                        </div>
                    </div>
                @endif


                <div class="card m-b-30">
                    <div class="card-body ">
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary" name="save_and_list" value="save_and_list">Update</button>
                            <button class="btn btn-danger cancel">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
    $(document).on('change','.js-datepicker',function(){
        $.ajax({
            url: "{{ route('callcenter.getLeadAssistant') }}",
            type: "POST",
            data:{ 
                date: $(this).val(),
            },
            success: function(data){
                $('.leadPopup').remove();
                $(data).insertAfter('.addLeadAssistant');
            }
        });
    });

    $(document).on('click','.assign',function(){
        var lead_button_id = $('#lead_button_id').val();
        var lead_assistant = $(this).data('id');
        var time_slot_id = $(this).data('value');
        
        $('#lead_assistant').val(lead_assistant);
        $('#time_slot_id').val(time_slot_id);
        if(lead_button_id != ''){
            $('.'+lead_button_id).text('Assign');
            $('#lead_button_id').val('assign_'+lead_assistant+'_'+time_slot_id);
            $(this).text('Assigned');
        } else {
            $('#lead_button_id').val('assign_'+lead_assistant+'_'+time_slot_id);
            $(this).text('Assigned');
        }
    });
</script>
@endsection
