@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<div class="content">
	  <form id="login" name="login" action="{{ route('saveFormOne') }}" method="post">
	    	@csrf
	    	<input type="hidden" id="user_id" name="id" value="{{ $id }}">

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
                    <option value="2">3-Phase</option>
                </select>
            </div>

            <div class="form-group">
                <label for="inputCity">Sectioned Load</label>
                <input type="text" class="form-control" id="inputCity" name="city" placeholder="Sectioned Load" required>
            </div>


            <div class="form-group">
                <label for="inputCity">Contact Demand</label>
                <input type="text" class="form-control" id="inputCity" name="city" placeholder="Sectioned Load" required>
            </div>


            <div class="form-group">
                <label for="inputCity">Billing Demand</label>
                <input type="text" class="form-control" id="inputCity" name="city" placeholder="Sectioned Load" required>
            </div>


            <div class="form-group">
                <label for="inputCity">Avg Power Factor</label>
                <input type="text" class="form-control" id="inputCity" name="city" placeholder="Sectioned Load" required>
            </div>


            <div class="form-group">
                <label for="inputCity">Energy Bill Scan - Front</label>
                <input type="file" class="form-control dropify" id="inputCity" name="city" placeholder="Sectioned Load" required>
            </div>

            <div class="form-group">
                <label for="inputCity">Energy Bill Scan - Back</label>
                <input type="file" class="form-control dropify" id="inputCity" name="city" placeholder="Sectioned Load" required>
            </div>

            <div class="form-group">
                <label for="inputCity">Total Amount</label>
                <input type="text" class="form-control" id="inputCity" name="city" placeholder="Sectioned Load" required>
            </div>


            <div class="form-group">
                <label for="inputCity">Unit Consumed</label>
                <input type="text" class="form-control" id="inputCity" name="city" placeholder="Sectioned Load" required>
            </div>

	  </form>
	</div>                
</div>
<br>
<center>
    <a href="{{ route('formOne',$id) }}" class="previous">&laquo; Previous</a>
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
