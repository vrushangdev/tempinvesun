@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')
<div id="page">
	<div class="content">
	  <form id="login" name="login" action="{{ route('saveFormOne') }}" method="post">
	    	@csrf
	    	<input type="hidden" id="user_id" name="id" value="{{ $id }}">

            <div class="form-group">
                <label for="inputFirstName">Roof</label>
                <input type="text" class="form-control" id="inputFirstName" name="first_name" placeholder="Length X Width" value="" required>
            </div>

            <div class="form-group">
                <label for="inputCity">Roof Picture One</label>
                <input type="file" class="form-control dropify" id="inputCity" name="city" placeholder="Sectioned Load" required>
            </div>

            <div class="form-group">
                <label for="inputCity">Roof Picture Two</label>
                <input type="file" class="form-control dropify" id="inputCity" name="city" placeholder="Sectioned Load" required>
            </div>

            <div class="form-group">
                <label for="inputCity">Area</label>
                <input type="text" class="form-control" id="inputCity" name="city" placeholder="Sectioned Load" required>
            </div>


            <div class="form-group">
                <label for="inputCity">Unit Consumed</label>
                <input type="text" class="form-control" id="inputCity" name="city" placeholder="Sectioned Load" required>
            </div>

            <div class="form-group">
                <a href="{{ route('imageFive',$id) }}" class="btn btn-danger" style="width: 18%;float: left;margin-right: 3%;background-color: red;border-color: #4e75cd;">&laquo; Previous</a>
                <button class="btn btn-primary" name="save_and_list" value="save_and_list">Update</button>
            </div>

	  </form>
	</div>                
</div>
@endsection