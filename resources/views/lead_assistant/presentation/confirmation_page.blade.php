@extends('layouts.presentation_new')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')
<section class="gradient-01">
    <div class="container ">
        <div class="row m-h-100 ">
            <div class="col-md-12 col-lg-12 m-auto">
            	<div class="avatar">
                    <a href="{{ route('formThree',[$id,$proposal_id]) }}" class="previous">
                        <div class="avatar avatar-title bg-success rounded-circle slider-btn-left-one" style="margin-top: 268px!important;">
                            <i class="mdi mdi-arrow-left-thick"></i>
                        </div>
                    </a>
                </div>
                <div class="avatar right">
                    <a href="javascript:void(0);" class="next submit">
                        <div class="avatar avatar-title bg-success rounded-circle slider-btn-right-one" style="margin-top: 268px!important;">
                            <i class="mdi mdi-arrow-right-thick"></i>
                        </div>
                    </a>
                </div>
                <div class="bg-white rounded shadow-lg">
                    <div class=" padding-box-2 p-all-25">
                        <div class="">
                           	<form id="login" name="login" action="{{ route('form_fifth') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" name="proposal_id" id ="proposal_id" value="{{ $proposal_id }}">
                                <input type="hidden" id="user_id" name="id" value="{{ $id }}">

                                <div class="m-b-10">
                                    <p class="font-secondary">
                                        Select Option
                                    </p>
                                    
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input" required>
                                        <label class="custom-control-label" for="customRadio1">Apply For Loan</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input" required disabled>
                                        <label class="custom-control-label" for="customRadio2">Pay UpFront 30%  </label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio4" name="customRadio" value="4" class="custom-control-input" required>
                                        <label class="custom-control-label" for="customRadio4">Registation  </label>
                                    </div>
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
@section('js')
<script type="text/javascript">
    $('.submit').on('click',function(){
        if($('#login').valid()){
            $('#login').submit();
        }
    });
</script>
@endsection
