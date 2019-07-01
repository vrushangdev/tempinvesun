@extends('layouts.ngo')
@section('title','Post List | Socialink')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">
                        Post List
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
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Venue</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!is_null($getPost))
                                    @foreach($getPost as $ck => $cv)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cv->title }}</td>
                                            <td>{{ $cv->date }}</td>
                                            <td>{{ $cv->time }}</td>
                                            <td>{{ $cv->venue }}</td>
                                            <td>
                                                @php $checked = ''; @endphp
                                                @if($cv->is_active == 1)
                                                  @php $checked = 'checked'; @endphp
                                                @endif
                                                <label class="cstm-switch ">
                                                    <input type="checkbox" name="option" value="1" class="cstm-switch-input changePost" data-id="{{ $cv->id }}" {{ $checked }}>
                                                    <span class="cstm-switch-indicator size-md "></span>
                                                    <span class="cstm-switch-description"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{ route('ngo.editPost',$cv->id) }}" class="btn m-b-15 ml-2 mr-2 btn-dark"><i class="fe fe-edit"></i></a>
                                                <a href="{{ route('ngo.deletePost',$cv->id) }}" class="btn m-b-15 ml-2 mr-2 btn-dark" onclick="return confirm('Are your sure want to delete this post ?')"><i class="fe fe-trash"></i></a>
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
@section('js')
<script type="text/javascript">
$(document).on("change",'.changePost',function(){
    if(this.checked){
        var option = "1";
    } else {
        var option = "0";
    }
    var post_id = $(this).data('id');
    $.ajax({
        type: "post",
        url: '{{ route("admin.changePostStatus") }}',
        data:{ 'option' : option,'id' : post_id},
        success:function(data){
            if(data == 'true'){
                if(option == 1){
                    msg = 'Post status enabled';
                } else {
                    msg = 'Post status disabled';
                }
            } else {        
               msg = 'something went wrong';
            }

            $.notify({ title: '', message: msg},{
            placement: {
                align: "right",
                from: "top"
            },
                timer: 500,
                type: 'success',
            });
        }
    });
});
</script>
@endsection