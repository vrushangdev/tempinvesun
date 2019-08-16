@extends('layouts.ngo')
@section('title','Change Password | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">Change Password</h4>
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
                            Change Password
                        </h5>
                    </div>
                    <div class="card-body ">
	                   	<form method="post" action="{{ route('ngo.updatePassword') }}" id="changePassword" enctype="multipart/form-data">
	                   		@csrf
                            <input type="hidden" name="id" value="{{ Auth::guard('ngo')->user()->id }}">
                            <div class="form-group">
                                <label for="inputoldPassword">Old Password</label>
                                <input type="password" class="form-control" name="old_pass" id="inputoldPassword" placeholder="Old Password" required>
                            </div>

                            <div class="form-group">
                                <label for="inputNewPassword">New Password</label>
                                <input type="password" class="form-control" name="new_pass" id="inputNewPassword" placeholder="New Password" required>
                            </div>

                            <div class="form-group">
                                <label for="inputLength">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                            </div>
                            
	                        <div class="form-group">
	                            <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('ngo.dashboard') }}" class="btn btn-danger">Cancel</a>
	                        </div>
	                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection