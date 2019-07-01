@extends('layouts.admin')
@section('title','Edit Role | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">  Role Management</h4>
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
                            Edit Role
                        </h5>
                    </div>
                    <div class="card-body ">
	                   	<form method="post" action="{{ route('saveEditedRole') }}" id="roleForm">
	                   		@csrf
	                   		
	                   		<input type="hidden" name="id" value="{{ $roleDetail->id }}">

	                        <div class="form-group">
	                            <label for="inputAddress">Role Name</label>
	                            <input type="text" class="form-control" name="name" id="inputAddress" placeholder="Role name" value="{{ $roleDetail->role }}" required>
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
