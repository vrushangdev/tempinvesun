@extends('layouts.admin')
@section('title','Add Role | Invesun')
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
                             Add Role
                        </h5>
                    </div>
                    <div class="card-body ">
	                   	<form method="post" action="{{ route('saveRole') }}" id="roleForm">
	                   		@csrf
	                        <div class="form-group">
	                            <label for="inputAddress">Role Name</label>
	                            <input type="text" class="form-control" name="name" id="inputAddress" placeholder="Role name" required>
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