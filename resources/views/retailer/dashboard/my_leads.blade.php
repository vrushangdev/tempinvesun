@extends('layouts.retailer')
@section('title','My Leads List | Invesun')
@section('content')
<style type="text/css">
.js-datepicker{
    z-index: 1100 !important;
}
.datepicker{
    z-index: 1100 !important;
}
</style>
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">
                        My Leads
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container pull-up">
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
                                    <th>Mobile</th>
                                    <th>Added By</th>
                                    <th>Assign to</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($LeadAssistantData as $uk => $uv)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $uv['name'] }}</td>
                                            <td>{{ $uv['mobile'] }}</td>
                                            <td>{{ $uv['lead_by'] }}</td>
                                            <td>{{ $uv['assignd'] }}</td>
                                            <td>{{ $uv['status'] }}</td>
                                            <td><a href="javascript:void(0);" class="btn btn-primary assign" data-id="{{ $uv['id'] }}"> Assign </a></td>
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
</section>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Lead Assistant</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('retailer.saveLeadAssistantSchedule') }}" method="post" id="userForm">
                    @csrf
                    
                    <input type="hidden" name="id" value="" id="id">
                    
                    <div class="schedule">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="save_and_list" id="save_and_list">Assign Lead Assistant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).on('click','.assign',function(){
        var user_id = $(this).data('id');

        $.ajax({
            url: "{{ route('retailer.getRetailerLeadAssistant') }}",
            type: "POST",
            data:{
                user_id : user_id
            },
            success: function(data){
               $('.schedule').html(data);
               $('#myModal').modal('show');
               $('#id').val(user_id);
               $(".js-datepicker").datepicker({ format: 'dd/mm/yyyy' });
            }
        });
    });

    $(document).on('click','#save_and_list',function(e){
        e.preventDefault();
        if($('#userForm').valid()){
            $('#userForm').submit();
        }
    });

</script>
@endsection