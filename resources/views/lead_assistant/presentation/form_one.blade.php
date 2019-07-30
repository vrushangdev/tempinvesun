@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<div class="content">
	  <form id="login" name="login" action="{{ route('saveFormOne') }}" method="post">
	    	@csrf
	    	<input type="hidden" id="user_id" name="id" value="{{ $getUserInfo->id }}">

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

            <div class="form-group">
                <label for="inputRemark">Remarks</label>
                <input type="text" class="form-control" id="inputRemark" value="{{ $getUserInfo->remark }}" placeholder="Remark" name="remark">
            </div>                 

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

	  </form>
	</div>                
</div>
<br>
<center>
	<a href="{{ route('imageFive',$id) }}" class="previous">&laquo; Previous</a>
	<a href="javascript:void(0);" class="next submit">Submit</a>
</center>

@endsection
@section('js')
<script type="text/javascript">
	$('.submit').on('click',function(){
		$('#login').submit();
	})
</script>
@endsection
