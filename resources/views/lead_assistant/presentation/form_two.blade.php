@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<div class="content">
	  <form id="login" name="login" action="{{ route('saveFormOne') }}" method="post">
	    	@csrf
	    	<input type="hidden" id="user_id" name="id" value="{{ $getUserInfo->id }}">

	    	<div class="form-group">
                <label for="inputName">Distribution Company</label>
                <select class="form-control" id="inputName" name="title" required>
                    <option value="">Select Distribution Company</option>
                    <option value="1">Torrent</option>
                    <option value="2">PGVCL</option>
                    <option value="3">UGVCL</option>
                    <option value="4">MGVCL</option>
                    <option value="5">DGVCL</option>
                </select>
            </div>

            <div class="form-group">
                <label for="inputFirstName">Service Numaber</label>
                <input type="text" class="form-control" id="inputFirstName" name="first_name" placeholder="First Name" value="" required>
            </div>

            <div class="form-group">
                <label for="inputName">Category</label>
                <select class="form-control" id="inputName" name="title" required>
                    <option value="">Select Category</option>
                    <option value="1">Residential</option>
                    <option value="2">Commercial</option>
                    <option value="3">Industrial</option>
                    <option value="4">Religious Place</option>
                    <option value="5">Hostel</option>
                </select>
            </div>

            <div class="form-group">
                <label for="inputName">Supply Type</label>
                <select class="form-control" id="inputName" name="title" required>
                    <option value="">Select Category</option>
                    <option value="1">1-Phase</option>
                    <option value="2">Commercial</option>
                </select>
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

            <div class="form-group">
                <a href="{{ route('imageFive',$id) }}" class="btn btn-danger" style="width: 18%;float: left;margin-right: 3%;background-color: red;border-color: #4e75cd;">&laquo; Previous</a>
                <button class="btn btn-primary" name="save_and_list" value="save_and_list">Update</button>
            </div>

	  </form>
	</div>                
</div>

@endsection
