@extends('layouts.lead_assistant')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')
<section class="admin-content">
    <div class="container m-t-60">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('form_fifth') }}" id="login" method="post">
                @csrf
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                            Select Option
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 m-b-30">
                                <center>
                                    <div class="option-box-grid">
                                        <input id="check1" name="customRadio" type="radio" value="1">
                                        <label for="check1">
                                            <span class="radio-content p-all-15 text-center">
                                                <span class="mdi h1 d-block mdi-bank"></span>
                                                <span class="h5" style="font-size:14px;">Apply For Loan</span>
                                            </span>
                                        </label>
                                    </div>
                                </center>
                            </div>
                            <div class="col-sm-4 m-b-30">
                                <center>
                                    <div class="option-box-grid">
                                        <input id="check2" name="customRadio" type="radio" value="2" disabled>
                                        <label for="check2">
                                            <span class="radio-content p-all-15 text-center">
                                                <span class="mdi h1  d-block mdi-credit-card"></span>
                                                <span class="h5" style="font-size:14px;">Pay UpFront 30%</span>
                                            </span>
                                        </label>
                                    </div>
                                </center>
                            </div>
                            <div class="col-sm-4 m-b-30">
                                <center>
                                    <div class="option-box-grid">
                                        <input id="check3" name="customRadio" type="radio" value="4">
                                        <label for="check3">
                                            <span class="radio-content p-all-15 text-center">
                                                <span class="mdi h1  d-block mdi-library-books"></span>
                                                <span class="h5" style="font-size:14px;">Registation</span>
                                            </span>
                                        </label>
                                    </div>
                                </center>
                            </div>
                            
                        </div>
                        <center><button type="button" class="btn m-b-15 ml-2 mr-2 btn-success submit">Submit</button></center>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
    $('.submit').on('click',function(){
        if($('#login').valid()){
            $('#login').submit();
        }
    });
</script>
@endsection
