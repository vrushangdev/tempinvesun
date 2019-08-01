@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
    <div class="content">
        <h2>Preview</h2>
        <form id="login" name="login" action="{{ route('saveFormThree') }}" method="post" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" id="user_id" name="id" value="{{ $id }}">
            <input type="hidden" id="user_preview_id" name="user_preview_id" value="{{ $userPreviewId }}">
            <input type="hidden" name="unit_rate" value="{{ $unit_rate }}" id="unit_rate">

            <div class="form-group">
                <label for="suggested_system_size">Suggested System Size</label>
                <input type="text" class="form-control width" id="suggested_system_size" name="suggested_system_size" placeholder="Suggested System Size" value="{{ number_format($suggestedSystem,2) }}" required>
            </div>

            <div class="form-group">
                <label for="area_required">Area Required</label>
                <input type="text" class="form-control" id="area_required" name="area_required" placeholder="Area Required" value="{{ number_format($area_required,2) }}" readonly required>
            </div>

            <div class="form-group">
                <label for="investment">Investment</label>
                <input type="text" class="form-control" id="investment" name="investment" placeholder="Investment" value="{{ $investment }}" readonly required>
            </div>

            <div class="form-group">
                <label for="net_payable">Net Payable </label>
                <input type="text" class="form-control" id="net_payable" name="net_payable" value="{{ $netpayble }}" placeholder="Net Payable" readonly required>
            </div>

            <div class="form-group">
                <label for="net_saving">Net Saving Per Year</label>
                <input type="text" class="form-control" id="net_saving" name="net_saving" placeholder="Net Saving Per Year" value="{{ $savingPerYear }}" readonly required>
            </div>

            <div class="form-group">
                <label for="emi_start">EMI Starts At</label>
                <input type="text" class="form-control" id="emi_start" name="emi_start" placeholder="EMI Starts At" value="{{ $savingPerYear }}" readonly required>
            </div>

      </form>
    </div>                
</div>
<br>
<center>
    <a href="{{ route('formTwo',$id) }}" class="previous">&laquo; Previous</a>
    <a href="javascript:void(0);" class="next submit">Submit</a>
</center>

@endsection
@section('js')
<script type="text/javascript">
    $('.submit').on('click',function(){
        $('#login').submit();
    });

    $(document).on('focusout','#suggested_system_size',function(){
        var suggestedSystem = $(this).val();
        var unit_rate = $('#unit_rate').val();
        var area_required = suggestedSystem * 80;
        var investment = 0;
        var netpayble = 0;
        var savingPerYear = parseFloat(suggestedSystem * 1500 * unit_rate).toFixed(2);
        var emiStart = parseFloat(suggestedSystem * 750).toFixed(2);

        $('#area_required').val(area_required);
        $('#investment').val(investment);
        $('#net_payable').val(netpayble);
        $('#net_saving').val(savingPerYear);
        $('#emi_start').val(emiStart);
    });

</script>
@endsection
