@extends('layouts.admin')
@section('title','User List | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">
                        User Management
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container  pull-up">
        <div class="row m-b-30">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <form action="{{ route('userList') }}" method="post">    
                        @csrf
                        <div class="form-row">

                            <div class="col-md-4 mb-3">
                                <label for=""> Role</label>
                                <select class="form-control" id="filter_role_id" name="filter_role_id">
                                    <option value="">Select Roles</option>
                                    @if(!is_null($roleList))
                                        @foreach($roleList as $tk => $tv)
                                            <option value="{{ $tv->id }}" @if($tv->id == $filter_role_id) selected="selected" @endif>{{ $tv->role }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-2 mt-4">
                                <button type="submit" class="btn btn-primary mt-1" id="filter" name="save_and_list" value="save_and_list">Filter Role</button>
                            </div>
                            @if($filter == 1)
                                <div class="col-md-2 mt-4">
                                    <a href="{{ route('userList') }}" class="btn btn-danger mt-1" id="filter" name="save_and_list" value="save_and_list" style="margin-left: -70px;">Reset Filter</a>
                                </div>
                            @endif
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($userList) > 0)
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-t-10">
                                <table id="example-multi" class="table" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($userList as $uk => $uv)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $uv->name }}</td>
                                                <td>{{ $uv->email }}</td>
                                                <td>{{ $uv->mobile }}</td>
                                                <td>
                                                    <a href="{{ route('editUser',[$filter_role_id,$uv->id]) }}" class="btn m-b-15 ml-2 mr-2 btn-dark"><i class="fe fe-edit"></i></a>
                                                    <a href="{{ route('deleteUser',$uv->id) }}" class="btn m-b-15 ml-2 mr-2 btn-dark" onclick="return confirm('Are your sure want to delete this user ?')"><i class="fe fe-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>
@endsection