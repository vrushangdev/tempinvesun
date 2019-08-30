@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
    <div class="content">
        <h2>Preview</h2>
        <form id="login" name="login" action="{{ route('saveFormThree') }}" method="post" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" name="proposal_id" id ="proposal_id" value="{{ $proposal_id }}">
            <input type="hidden" id="user_id" name="id" value="{{ $id }}">
            <input type="hidden" id="user_preview_id" name="user_preview_id" value="{{ $userPreviewId }}">
            <input type="hidden" name="unit_rate" value="{{ $unit_rate }}" id="unit_rate">

            <input type="hidden" name="basic" value="{{ $basic }}" id="basic">
            <input type="hidden" name="gst" value="{{ $gst }}" id="gst">
            <input type="hidden" name="total" value="{{ $total }}" id="total">
            <input type="hidden" name="subsidy" value="{{ $subsidy }}" id="subsidy">
            <input type="hidden" name="subsidize_amount" value="{{ $subsidize_amount }}" id="subsidize_amount">
            <input type="hidden" name="net_payable" value="{{ $net_payable }}" id="net_payable">
            <input type="hidden" name="discom_charge" value="{{ $discom_charge }}" id="discom_charge">
            <input type="hidden" name="structure_modification" value="{{ $structure_modification }}" id="structure_modification">
            <input type="hidden" name="mobile_app" value="{{ $mobile_app }}" id="mobile_app">
            <input type="hidden" name="solar_monitoring" value="{{ $solar_monitoring }}" id="solar_monitoring">
            <input type="hidden" name="extended_aintenance" value="{{ $extended_aintenance }}" id="extended_aintenance">
            <input type="hidden" name="insurance_coverage" value="{{ $insurance_coverage }}" id="insurance_coverage">
            <input type="hidden" name="solar_panel" value="{{ $solar_panel }}" id="solar_panel">
            <input type="hidden" name="grid_tie_inverter" value="{{ $grid_tie_inverter }}" id="grid_tie_inverter">
            <input type="hidden" name="structure" value="{{ $structure }}" id="structure">


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
                <input type="text" class="form-control" id="net_payable_money" name="net_payable" value="{{ $netpayble }}" placeholder="Net Payable" readonly required>
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
    <a href="{{ route('formTwo',[$id,$proposal_id]) }}" class="previous">&laquo; Previous</a>
    <a href="javascript:void(0);" class="next submit">Submit</a>
</center>

@endsection
@section('js')
<script type="text/javascript">
    $('.submit').on('click',function(){
        if($('#login').valid()){
            $('#login').submit();
        }
    });

    $(document).on('focusout','#suggested_system_size',function(){

        var system_size = $(this).val();

         $.ajax({
            type: "post",
            url: '{{ route("getCalculationData") }}',
            data:{ 
                system_size : system_size,
                '_token' : "{{ csrf_token() }}"
            },
            success:function(data){

                $('#basic').val(data.basic);
                $('#gst').val(data.gst);
                $('#total').val(data.total);
                $('#subsidy').val(data.subsidy);
                $('#subsidize_amount').val(data.subsidize_amount);
                $('#net_payable').val(data.net_payable);
                $('#discom_charge').val(data.discom_charge);
                $('#structure_modification').val(data.structure_modification);
                $('#mobile_app').val(data.mobile_app);
                $('#solar_monitoring').val(data.solar_monitoring);
                $('#extended_aintenance').val(data.extended_aintenance);
                $('#insurance_coverage').val(data.insurance_coverage);
                $('#solar_panel').val(data.solar_panel);
                $('#grid_tie_inverter').val(data.grid_tie_inverter);
                $('#structure').val(data.structure);
                
                var suggestedSystem = system_size;
                var unit_rate = $('#unit_rate').val();
                var area_required = suggestedSystem * 80;
                var investment = 0;
                var netpayble = 0;
                var savingPerYear = parseFloat(suggestedSystem * 1500 * unit_rate).toFixed(2);
                var emiStart = parseFloat(suggestedSystem * 750).toFixed(2);

                $('#area_required').val(area_required);
                $('#investment').val(data.total);
                $('#net_payable_money').val(data.net_payable);
                $('#net_saving').val(savingPerYear);
                $('#emi_start').val(emiStart);


            }
        });
    });

</script>
@endsection
