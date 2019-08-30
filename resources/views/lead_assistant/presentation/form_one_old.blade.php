@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<div class="content">
	  <form id="login" name="login" action="{{ route('saveFormOne') }}" method="post">
	    	@csrf
	    	
            <input type="hidden" id="user_id" name="id" value="{{ $getUserInfo->id }}">
            <input type="hidden" name="latitude" id="latitude" value="{{ $getUserInfo->lat }}">  
            <input type="hidden" name="longitude" id ="longitude" value="{{ $getUserInfo->lang }}">
            <input type="hidden" name="proposal_id" id ="proposal_id" value="{{ $proposal_id }}">    
            
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
                <label for="inputCountry">Country</label>
                <select class="form-control" name="country" id="inputCountry" required>
                    <option value="">Select Country</option>
                    @if(count($getCountry) > 0)
                        @foreach($getCountry as $yk => $yv)
                            <option value="{{ $yv->id }}" @if($yv->id == $getUserInfo->country) selected="selected" @endif>{{ $yv->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="inputState">State</label>
                <select class="form-control" name="state" id="inputState" required>
                    <option value="">Select State</option>
                    @if(count($getState) > 0)
                        @foreach($getState as $sk => $sv)
                            <option value="{{ $sv->id }}" @if($sv->id == $getUserInfo->state) selected="selected" @endif>{{ $sv->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- $getUserInfo->city -->
            <div class="form-group">
                <label for="inputCity">City</label>
                <select class="form-control" name="city" id="inputCity" required>
                    <option value="">Select City</option>
                    @if(count($getCity) > 0)
                        @foreach($getCity as $ck => $cv)
                            <option value="{{ $cv->id }}" @if($cv->id == $getUserInfo->city) selected="selected" @endif>{{ $cv->name }}</option>
                        @endforeach
                    @endif
                </select>
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
                <input type="tel" class="form-control number"  maxlength="10" pattern="^\d{10}$" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  id="inputMobile" maxLength="10" name="mobile" placeholder="Mobile" value="{{ $getUserInfo->mobile }}" value="{{ $getUserInfo->mobile }}" required>
            </div>
            
            <div class="form-group">
                <label for="alt_mobile">Alt Mobile</label>
                <input type="tel" class="form-control number" maxlength="10" pattern="^\d{10}$" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" id="alt_mobile" value="{{ $getUserInfo->alt_no }}" name="alt_mobile" placeholder="Alternate Mobile">
            </div>

            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="text" class="form-control" id="inputEmail" value="{{ $getUserInfo->email }}" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label for="pacinput">Location Search</label>
                <input type="text" class="form-control" name="location" id="pacinput" placeholder="Location Search" value="{{ $getUserInfo->google_location }}" required>
            </div>

	  </form>
	</div>                
</div>
<br>
<center>
	<a href="{{ route('imageFive',[$id,$proposal_id]) }}" class="previous">&laquo; Previous</a>
	<a href="javascript:void(0);" class="next submit">Submit</a>
</center>

@endsection
@section('js')
<script type="text/javascript">
	$('.submit').on('click',function(){
		$('#login').submit();
	})

    $(document).on('change','#inputCountry',function(){
        $.ajax({
            url: "{{ route('getStateList') }}",
            type: "POST",
            data:{ 
                id: $(this).val(),
            },
            success: function(data){
               $('#inputState').html(data);
            }
        });
    });


    $(document).on('change','#inputState',function(){
        $.ajax({
            url: "{{ route('getCityList') }}",
            type: "POST",
            data:{ 
                id: $(this).val(),
            },
            success: function(data){
               $('#inputCity').html(data);
            }
        });
    });

    var isPlaceAuthentic = false;
    var lastPlaceAuthenticated = '';
   
    function initialize() {
        var input = (document.getElementById('pacinput'));
        var autocomplete = new google.maps.places.Autocomplete(input);
        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            infowindow.close();
            var place = autocomplete.getPlace();
            isPlaceAuthentic = true;
            lastPlaceAuthenticated = $('#pacinput').val();
            isPlaceAuthentic = false;
            var address = '';
            var toInsertData = place.adr_address;
            var latti = place.geometry.location.lat();
            var longi = place.geometry.location.lng();
            var addressToInsert = toInsertData.substr(0, toInsertData.indexOf('<')).trim();
            if (toInsertData.indexOf('<') !== 1) {
                toInsertData = toInsertData.substr(toInsertData.indexOf('<'));
            }
            var streetAddress = $(toInsertData).filter('.street-address').text().trim();
            var extendedAddress = $(toInsertData).filter('.extended-address').text().trim();
            var cityName = $(toInsertData).filter('.locality').text().trim();
            var stateName = $(toInsertData).filter('.region').text().trim();
            var countryName = $(toInsertData).filter('.country-name').text().trim();

            $("#latitude").val(latti);
            $("#longitude").val(longi);
            $("#city").val(cityName);
            $("#state").val(stateName);
            $("#country").val(countryName);
            initMap(latti,longi);
            var appenedAddress = addressToInsert.concat(streetAddress);
            appenedAddress = appenedAddress.concat(extendedAddress);
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    $("#area_submit").on('click',function(e){
        if(($("#latitude").val() == "" || $("#longitude").val() == "")){
            alert("Please Enter Valid Address");
            e.preventDefault();
        }
    });
    
    initMap(23.0300,72.5800);
    function initMap(latitude,longitude) {
        var myLatLng = {lat: latitude, lng: longitude};
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
          zoom: 18,
          center: myLatLng
        });
        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          draggable: true
        });

        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById("lat").value = this.getPosition().lat();
            document.getElementById("long").value = this.getPosition().lng();
        });
    }
</script>
@endsection
