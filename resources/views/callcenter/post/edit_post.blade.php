@extends('layouts.ngo')
@section('title','Edit Post | Socialink')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">Post</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container  pull-up">
        <form method="post" action="{{ route('ngo.saveEditedPost') }}" id="addPostForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <!--widget card begin-->
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                Post details
                            </h5>
                        </div>
                        <div class="card-body ">
                            <input type="hidden" name="id" value="{{ $getPost->id }}"> 

                            <div class="form-group">
                                <label for="inputNgoName">Title</label>
                                <input type="text" class="form-control" name="name" id="inputNgoName" placeholder="Name" value="{{ $getPost->title }}" required>
                            </div>

                            <div class="form-group">
                                <label for="inputDescription">Description</label>
                                <textarea type="text" class="form-control" name="description" placeholder="Description" id="inputDescription" required>{{ $getPost->description }}</textarea>
                            </div>
                            

                            <div class="form-group ">
                                <label class="font-secondary">Category</label>
                                <select multiple class="form-control js-select2-category-ngo" name="category[]" data-msg="Please select category" required>
                                @if(count($getCategoryList) > 0)
                                    @foreach($getCategoryList as $ck => $cv)
                                        <option value="{{ $cv->id }}" @if(in_array($cv->id,$cat)) selected="selected" @endif>{{ $cv->name }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputDate">Date</label>
                                <input type="text" class="form-control js-datepicker" name="date" id="inputDate" value="{{ $getPost->date }}" required>
                            </div>

                            <div class="form-group">
                                <label for="inputTime">Time</label>
                                <input type="text" class="form-control timepicker" name="time" placeholder="Time" id="inputTime" value="{{ $getPost->time }}" required>
                            </div>

                            <div class="form-group">
                                <label for="inputVenue">Venue</label>
                                <input type="text" class="form-control" name="venue" placeholder="Venue" id="inputVenue" value="{{ $getPost->venue }}"required>
                            </div>

                        </div>
                    </div>
                </div>
            </form> 
                <div class="col-lg-6">

                     <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                Upload Post Images
                            </h5>
                        </div>
                        <div class="card-body">
                            <form class="dropzone" action="{{ route('ngo.uploadMedia') }}">
                                @csrf
                                <div class="dz-message">
                                    <h1 class="display-4">
                                        <i class=" mdi mdi-progress-upload"></i>
                                    </h1>
                                    Drop files here or click to upload.<BR>
                                    
                                    <div class="p-t-5">
                                        <a href="javascript:void(0);" class="btn btn-lg btn-primary">Upload File</a>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if(isset($getPost->postimage) && count($getPost->postimage) > 0)
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                Post Images
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row gutters-sm">
                                    @foreach($getPost->postimage as  $ik => $iv)
                                        <div class="col-6 col-sm-4 mb-4 removeDiv_{{ $iv->id }}">
                                            <span class="image-box-content">
                                                <img src="{{ asset('uploads/post') }}/{{$iv->image_name}}"  alt="">
                                                <center><a href="javascript:void(0);" class="remove_file" data-id="{{ $iv->id }}">remove file</a></center>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="card m-b-30">
                        <div class="card-body ">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('ngo.postList') }}" class="btn btn-danger">Cancel</a>
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
$(document).on('click','.remove_file',function(){

    if(confirm('Are you sure want to delete this file ?')){
         var image_id = $(this).data('id');
         $.ajax({
            type: "post",
            url: '{{ route("admin.removeImage") }}',
            data:{'id' : image_id},
            success:function(data){
                if(data == 'true'){
                    $('.removeDiv_'+image_id).remove();
                    msg = 'Image deleted';
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
    }
});

</script>
@endsection