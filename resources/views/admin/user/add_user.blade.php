@extends('layouts.admin')
@section('title','Add User | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">  User Management</h4>
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
                             Add User
                        </h5>
                    </div>
                    <div class="card-body ">
	                   	<form method="post" action="{{ route('saveUser') }}" id="userForm" autocomplete="off">
	                   		@csrf

                            <div class="form-group">
                                <label for="inputRole">Role</label>
                                <select class="form-control" name="role_id" id="inputRole" required>
                                    <option value="">Select Role</option>
                                    @if(!is_null($roleList))
                                        @foreach($roleList as $rk => $rv)
                                            <option value="{{ $rv->id }}">{{ $rv->role }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

	                        <div class="form-group">
	                            <label for="inputName">Name</label>
	                            <input type="text" class="form-control" name="name" id="inputName" placeholder="Please enter name" required>
	                        </div>

                            <div class="form-group city" style="display:none;">
                                <label class="font-secondary">City List</label>
                                <select multiple class="form-control js-select2-module" name="city[]">
                                @if(count($cityList) > 0)
                                    @foreach($cityList as $mk => $mv)
                                        <option value="{{ $mv->id }}">{{ $mv->name }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>

                            <div class="form-group occupation" style="display:none;">
                                <label for="inputOccupation">Occupation</label>
                                <input type="text" class="form-control" name="occupation" id="inputOccupation" placeholder="Please enter occupation" autocomplete="false" data-msg="Please enter occpation">
                            </div>


                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="text" class="form-control" name="email" id="inputEmail" placeholder="Please enter email" autocomplete="false" required>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Please enter password" autocomplete="false" required>
                            </div>

                            <div class="form-group">
                                <label for="inputMobile">Mobile</label>
                                <input type="tel" class="form-control number" name="mobile" maxlength="10" pattern="^\d{10}$" id="inputMobile" oninvalid="this.setCustomValidity('Please Enter valid Mobile Number')" oninput="setCustomValidity('')"  placeholder="Please enter mobile" required>
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
@section('js')
<script type="text/javascript">
    $(document).on('change','#inputRole',function(){
        if($(this).val() == 3){
            $('.occupation').show();
            $('.city').show();
            $(".js-select2-module").select2({
                placeholder: "Select City Name",
            });
        } else {
            $('.occupation').hide();
            $('.city').hide();
        }
    });
</script>
@endsection