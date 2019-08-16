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
                <input type="hidden" id="is_update" value="{{ $getUserInfo->email }}">

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
                            <input type="text" class="form-control" id="inputFirstName" name="first_name" placeholder="First Name" value="{{ $getUserInfo->first_name }}" required>
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

                                       

                    </div>
                </div>

            </div>

            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body">

                     <!--    <div class="form-group">
                            <label for="inputCountry">Billing Address</label>
                            <input type="text" class="form-control" id="inputCountry" placeholder="Country" name="country" value="Same as above" disabled required>
                        </div> -->

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

                        <div class="form-group">
                            <label for="inputRemark">Remarks</label>
                            <input type="text" class="form-control" id="inputRemark" value="{{ $getUserInfo->remark }}" placeholder="Remark" name="remark">
                        </div>   

                        <div class="form-group">
                            <label for="inputRemark">Remarks to Lead Assistant</label>
                            <input type="text" class="form-control" id="inputRemark" value="{{ $getUserInfo->remark_lead_assistant }}" placeholder="Remark" name="remark_lead_assistant">
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
                            <input type="text" class="form-control js-datepicker" id="inputAppoDate" placeholder="Appointment Date" name="appointment_date" value="@if(!is_null($getUserInfo->assigned_lead)) {{ $getUserInfo->assigned_lead->date }} @else {{ date('d/m/Y') }} @endif" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="inputAppoDate">Status</label>
                            <select class="form-control" name="user_status" id="status">
                                <option value="">Select Status</option>
                                <option value="1"
                                @if(!is_null($getUserInfo->assigned_lead) && $getUserInfo->user_status == 1) selected="selected" @endif
                                >Callback</option>
                                <option value="2"
                                @if(!is_null($getUserInfo->assigned_lead)) @if($getUserInfo->user_status == 2) selected="selected" @endif @else selected="selected" @endif
                                >Pending</option>
                                <option value="3"
                                @if(!is_null($getUserInfo->assigned_lead) && $getUserInfo->user_status == 3) selected="selected" @endif
                                >Successfull</option>
                                <option value="4"
                                @if(!is_null($getUserInfo->assigned_lead) && $getUserInfo->user_status == 4) selected="selected" @endif
                                >Not Interested</option>
                                
                            </select>
                        </div>

                       
                        <div class="form-group reschedule_date"  @if(!is_null($getUserInfo) && $getUserInfo->reschedule_date == '') style="display:none;" @endif>
                            <label for="inputAppoDate">Reschedule Date</label>
                            <input type="text" class="form-control js-datepicker" id="inputAppoDate" placeholder="Appointment Date" name="reschedule_date" value="@if(!is_null($getUserInfo) && $getUserInfo->reschedule_date != '') {{ $getUserInfo->reschedule_date }} @endif" autocomplete="off" required>
                        </div>

                        <div class="form-group reschedule_time" @if(!is_null($getUserInfo) && $getUserInfo->reschedule_time == '') style="display:none;" @endif>
                            <label for="inputAppoDate">Reschedule Time</label>
                            <select name="reschedule_time" class="form-control">
                                <option value="">Select Reschedule Time</option>
                                <option value="1" @if($getUserInfo->reschedule_time == 1) selected="selected" @endif>Morning</option>
                                <option value="2" @if($getUserInfo->reschedule_time == 2) selected="selected" @endif>Afternoon</option>
                                <option value="3" @if($getUserInfo->reschedule_time == 3) selected="selected" @endif>Evening</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputCallingId">Calling ID</label>
                            <input type="text" class="form-control" id="inputCallingId" placeholder="Calling ID" name="calling_id" value="@if(!is_null($getUserInfo->calling_id)) {{ $getUserInfo->calling_id }} @endif" autocomplete="off" required>
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

               
            </div>

            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-body ">
                        <br>
                        <div class="form-group">
                            <label for="inputAppoDate">Status</label>
                            <select class="form-control col-lg-4" name="city_id" id="selectCity">
                                <option value="">Select City</option>
                                @if(count($getCityList) > 0)
                                    @foreach($getCityList as $gk => $gv)
                                        <option value="{{ $gv->id }}">{{ $gv->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 lead" style="display:none;">
                <div class="card m-b-30">
                    <div class="card-body ">
                        <div class="lead_assistant">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12" > 
                <div class="card m-b-30">
                    <div class="card-body">
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="save_and_list" value="save_and_list">Update</button>
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
    $(document).on('change','#selectCity',function(){
        $.ajax({
            type: "post",
            url: '{{ route("callcenter.getLeadAssistant") }}',
            data:{ 
                date: $('#inputAppoDate').val(),
                city_id: $(this).val()
            },
            success:function(data){
                $('.lead').show();
                $('.lead_assistant').html(data);

            }
        });
    });

    $(document).on('change','.checkbox',function(){
        var selected = [];
        $(".checkbox:checked").each(function(){
            selected.push($(this).data('id'));
        });

        if(selected.length > 1){
            $(this).prop('checked',false);
            $.notify({
                title: '',
                    message: "You can select only one lead assistant to user"
                }, {
                    placement: {
                        align: "right",
                        from: "top"
                    },
                    timer: 500,
                    type: 'danger',
            });   
        }
    });

    $(document).on('submit','#userForm',function(e){
        e.preventDefault();
        var selected = [];
        $(".checkbox:checked").each(function(){
            selected.push($(this).data('id'));
        });

        if(selected.length > 0){
            $('#userForm')[0].submit();
        } else {
            $.notify({
                title: '',
                    message: "Please assign lead assistant to user"
                }, {
                    placement: {
                        align: "right",
                        from: "top"
                    },
                    timer: 500,
                    type: 'danger',
            });
        }
    });
</script>
@endsection
