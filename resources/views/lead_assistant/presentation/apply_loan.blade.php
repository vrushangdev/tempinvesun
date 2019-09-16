@extends('layouts.presentation_new')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')
<section class="gradient-01">
    <div class="container ">
        <div class="row m-h-100 ">
            <div class="col-md-12 col-lg-12 m-auto">
            	<div class="avatar">
                    <a href="{{ route('verifyPresentation',[$id,$proposal_id]) }}" class="previous">
                        <div class="avatar avatar-title bg-success rounded-circle slider-btn-left-one">
                            <i class="mdi mdi-arrow-left-thick"></i>
                        </div>
                    </a>
                </div>
                <div class="avatar right">
                    <a href="javascript:void(0);" class="next submit">
                        <div class="avatar avatar-title bg-success rounded-circle slider-btn-right-one">
                            <i class="mdi mdi-arrow-right-thick"></i>
                        </div>
                    </a>
                </div>
                <div class="bg-white rounded shadow-lg">
                    <div class=" padding-box-2 p-all-25">
                        <div class="">
                           	<form id="login" name="login" action="{{ route('saveIdDocumnetDetails') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" name="proposal_id" id ="proposal_id" value="{{ $proposal_id }}">
                                <input type="hidden" id="user_id" name="id" value="{{ $id }}">
                                <input type="hidden" id="form_type" name="type" value="1">

                                    
                                <div class="form-group">
                                    <label for="roof_pic_one">Aadhar card</label>
                                    <input type="file" class="form-control dropify" id="aadhar_card" name="aadhar_card">
                                </div>

                                <div class="form-group">
                                    <label for="roof_pic_two">Passport</label>
                                    <input type="file" class="form-control dropify" id="passport" name="passport" placeholder="Sectioned Load">
                                </div>

                                <div class="form-group">
                                    <label for="roof_pic_two">Bank Statement</label>
                                    <input type="file" class="form-control dropify" id="bank_statement" name="bank_statement" placeholder="Sectioned Load">
                                </div>

                                <div class="other_document">

                                </div>
                                <div class="form-group">
                                   <button class="btn btn-success addNewDocument">Add New Document</button>
                                </div>
                                
                            </form>
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
    $(document).on('click','.addNewDocument',function(e){

        e.preventDefault();

        var html = '<div class="form-group"><label for="roof_pic_two">Other Document</label><input type="file" class="form-control dropify" id="roof_pic_two" name="other_document[]" placeholder="Sectioned Load"></div>';

        $('.other_document').append(html);
        $('.dropify').dropify();

    });

    $('.submit').on('click',function(){
        if($('#login').valid()){
            $('#login').submit();
        }
    })

</script>
@endsection
