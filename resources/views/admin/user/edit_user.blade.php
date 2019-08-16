@extends('layouts.admin')
@section('title','Edit User | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">   User Management</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container  pull-up">
        <div class="row">
            <div class="col-lg-6 offset-3">

                <!--widget card begin-->
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                             Edit User
                        </h5>
                    </div>
                    <div class="card-body ">
	                   	<form method="post" action="{{ route('saveEditedUser') }}" id="userEmailForm">
	                   		@csrf

                            <input type="hidden" name="id" id="id" value="{{ $userDetail->id }}">

                            <input type="hidden" name="role" value="{{ $userDetail->role_id }}">

                            <div class="form-group">
                                <label for="inputRole">Role</label>
                                <select class="form-control" name="role_id" id="inputRole" disabled required>
                                    <option value="">Select Role</option>
                                    @if(!is_null($roleList))
                                        @foreach($roleList as $rk => $rv)
                                            <option value="{{ $rv->id }}" @if($rv->id == $userDetail->role_id) selected="selected" @endif>{{ $rv->role }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

	                        <div class="form-group">
	                            <label for="inputName">Name</label>
	                            <input type="text" class="form-control" name="name" id="inputName" placeholder="Please enter name" value="{{ $userDetail->name }}" required>
	                        </div>

                            <div class="form-group city" @if(is_null($cityId)) style="display:none;" @endif>
                                <label class="font-secondary">City List</label>
                                <select multiple class="form-control js-select2-module" name="city[]">
                                @if(count($cityList) > 0)
                                    @foreach($cityList as $mk => $mv)
                                        <option value="{{ $mv->id }}" @if(in_array($mv->id,$cityId)) selected="selected" @endif>{{ $mv->name }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>

                            
                            <div class="form-group occupation" @if($userDetail->occupation == '') style="display:none;" @endif>
                                <label for="inputOccupation">Occupation</label>
                                <input type="text" class="form-control" name="occupation" id="inputOccupation" placeholder="Please enter occupation" autocomplete="false" value="{{ $userDetail->mobile }}" data-msg="Please enter occpation">
                            </div>
                           

                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="text" class="form-control" name="email" id="inputEmail" placeholder="Please enter email" value="{{ $userDetail->email }}" readonly required>
                            </div>

                            <div class="form-group">
                                <label for="inputMobile">Mobile</label>
                                <input type="text" class="form-control width" name="mobile" maxlength="10" pattern="^\d{10}$" id="inputMobile number" oninvalid="this.setCustomValidity('Please Enter valid Mobile Number')" oninput="setCustomValidity('')"  placeholder="Please enter mobile" value="{{ $userDetail->mobile }}" required>
                            </div>
	                        

	                        <div class="form-group">
	                            <button type="submit" class="btn btn-primary">Submit</button>
	                        </div>
	                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection