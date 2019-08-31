@extends('layouts.lead_assistant')
@section('title','Attended User Lead Request | Invesun')
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
                           Attended User Lead Request
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
                                    <th>Mobile</th>
                                    <th>Date</th>
                                    <th>Slot</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!is_null($getLeadRequest))
                                    @foreach($getLeadRequest as $ck => $cv)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cv->user->first_name }} {{ $cv->user->middle_name }} {{ $cv->user->last_name }}</td>
                                            <td>{{ $cv->user->mobile }}</td>
                                            <td>{{ $cv->date }}</td>
                                            <td>{{ $cv->slot->name }}</td>
                                            <td>
                                                <a href="{{ asset('proposal') }}/{{ $cv->userpropasal->proposal_link }}" class="btn m-b-15 ml-2 mr-2 btn-dark" target="_blank" title="View Proposal"><i class="mdi mdi-eye-outline"></i></a>
                                                <a href="whatsapp://send?text={{ asset('proposal') }}/{{ $cv->userpropasal->proposal_link }}" data-action="" class="btn m-b-15 ml-2 mr-2 btn-dark" target="_blank" title="Share on whatsapp"><i class="mdi mdi-whatsapp"></i></a>
                                                
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
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reschedule</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('lead_assistant.saveSchedule') }}" method="post" id="userForm">
                    @csrf
                    <input type="hidden" name="id" value="" id="id">
                    <input type="hidden" name="reschedule_id" value="" id="reschedule_id">
                    <div class="form-group">
                        <label for="inputAppoDate">Appointment Date</label>
                        <input type="text" class="form-control js-datepicker" id="inputAppoDate" placeholder="Appointment Date" name="appointment_date" value="" autocomplete="off" required>
                    </div>
                    <div class="schedule">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="save_and_list" id="save_and_list">Reschedule</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">

    $('.js-datepicker').on('changeDate', function(ev){
        $(this).datepicker('hide');
    });

    $(document).on('click','.reschedule',function(){
        $('#myModal').modal({ backdrop: 'static', keyboard: false });
        $('#myModal').modal('show');
        $('#id').val($(this).data('id'));
        $('#reschedule_id').val($(this).data('value'));
        
    });

    $(document).on('change','.js-datepicker',function(){
        $.ajax({
            type: "post",
            url: '{{ route("lead_assistant.rescheduleLead") }}',
            data:{ 
                date: $(this).val(),
                reschedule: $('#reschedule_id').val()
            },
            success:function(data){
                $('.schedule').html(data);
            }
        });
    });

    $(document).on('change','.checkbox',function(){
        var selected = [];
        $(".checkbox:checked").each(function(){
            selected.push($(this).data('id'));
        });

        if(selected.length > 1){
            $(this).prop('checked',false);
            $.notify({
                title: '',
                    message: "You can select only one lead assistant to user"
                }, {
                    placement: {
                        align: "right",
                        from: "top"
                    },
                    timer: 500,
                    type: 'danger',
            });   
        }
    });

    $(document).on('submit','#userForm',function(e){
        e.preventDefault();
        var selected = [];
        $(".checkbox:checked").each(function(){
            selected.push($(this).data('id'));
        });

        if(selected.length > 0){
            $('#userForm')[0].submit();
        } else {
            $.notify({
                title: '',
                    message: "Please assign lead assistant to user"
                }, {
                    placement: {
                        align: "right",
                        from: "top"
                    },
                    timer: 500,
                    type: 'danger',
            });
        }
    });
</script>
@endsection

