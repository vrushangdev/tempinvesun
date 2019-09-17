@extends('layouts.lead_assistant')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class=""> Registration</h4>
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
                             Registration
                        </h5>
                    </div>
                    <div class="card-body ">
                        <form id="login" name="login" action="{{ route('saveIdDocumnetDetails') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                            <input type="hidden" name="proposal_id" id ="proposal_id" value="{{ $proposal_id }}">
                            <input type="hidden" id="user_id" name="id" value="{{ $id }}">
                            <input type="hidden" id="form_type" name="type" value="4">

                                
                            <div class="form-group">
                                <label for="roof_pic_one">Aadhar card</label>
                                <input type="file" class="form-control dropify" id="aadhar_card" name="aadhar_card">
                            </div>

                            <div class="form-group">
                                <label for="roof_pic_two">Passport</label>
                                <input type="file" class="form-control dropify" id="passport" name="passport" placeholder="Sectioned Load">
                            </div>

                            <div class="form-group">
                                <label for="roof_pic_two">Resedential Proof</label>
                                <input type="file" class="form-control dropify" id="resedential_proof" name="resedential_proof" placeholder="Sectioned Load">
                            </div>

                            <div class="other_document">

                            </div>

                            <div class="form-group">
                               <button class="btn btn-success addNewDocument"><i class="mdi mdi-plus"></i></button>
                            </div>

                            <div class="form-group">
                               <button class="btn btn-primary submit">submit</button>
                            </div>
                        </form>
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
