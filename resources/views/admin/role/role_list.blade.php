@extends('layouts.admin')
@section('title','Role List | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">
                           Role Management
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container  pull-up">
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
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!is_null($roleList))
                                    @foreach($roleList as $rk => $rv)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rv->role }}</td>
                                            <td>
                                                <a href="{{ route('editRole',$rv->id) }}" class="btn m-b-15 ml-2 mr-2 btn-dark"><i class="fe fe-edit"></i></a>
                                                <a href="{{ route('deleteRole',$rv->id) }}" class="btn m-b-15 ml-2 mr-2 btn-dark" onclick="return confirm('Are your sure want to delete this role ?')"><i class="fe fe-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection