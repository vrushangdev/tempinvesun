@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<div class="content">
        <h2>Energy Consumption Details</h2>
	    <form id="login" name="login" action="{{ route('saveFormTwo') }}" method="post" enctype="multipart/form-data">
	    	@csrf
	    	
            <input type="hidden" name="proposal_id" id ="proposal_id" value="{{ $proposal_id }}">
            <input type="hidden" id="user_id" name="id" value="{{ $id }}">
            <input type="hidden" name="energy_consumption_id"  @if(!is_null($energyConsumptionData) && $energyConsumptionData->id) value="{{ $energyConsumptionData->id }}" @endif>

	    	<div class="form-group">
                <label for="inputName">Distribution Company</label>
                <select class="form-control" id="inputName" name="distribution_company" required>
                    <option value="">Select Distribution Company</option>
                    <option value="1" @if(!is_null($energyConsumptionData) && $energyConsumptionData->disribution_company_id == 1) selected="selected" @endif>Torrent</option>
                    <option value="2" @if(!is_null($energyConsumptionData) && $energyConsumptionData->disribution_company_id == 2) selected="selected" @endif>PGVCL</option>
                    <option value="3" @if(!is_null($energyConsumptionData) && $energyConsumptionData->disribution_company_id == 3) selected="selected" @endif>UGVCL</option>
                    <option value="4" @if(!is_null($energyConsumptionData) && $energyConsumptionData->disribution_company_id == 4) selected="selected" @endif>MGVCL</option>
                    <option value="5" @if(!is_null($energyConsumptionData) && $energyConsumptionData->disribution_company_id == 5) selected="selected" @endif>DGVCL</option>
                </select>
            </div>

            <div class="form-group">
                <label for="service_name">Service Numaber</label>
                <input type="text" class="form-control width" id="service_name" name="service_number" placeholder="Service Numaber" @if(!is_null($energyConsumptionData) && $energyConsumptionData->service_number != '') value="{{ $energyConsumptionData->service_number }}" @endif required>
            </div>

            <div class="form-group">
                <label for="inputName">Category</label>
                <select class="form-control" id="inputName" name="category_id" required>
                    <option value="">Select Category</option>
                    <option value="1" @if(!is_null($energyConsumptionData) && $energyConsumptionData->category_id == 1) selected="selected" @endif>Residential</option>
                    <option value="2" @if(!is_null($energyConsumptionData) && $energyConsumptionData->category_id == 2) selected="selected" @endif>Commercial</option>
                    <option value="3" @if(!is_null($energyConsumptionData) && $energyConsumptionData->category_id == 3) selected="selected" @endif>Industrial</option>
                    <option value="4" @if(!is_null($energyConsumptionData) && $energyConsumptionData->category_id == 4) selected="selected" @endif>Religious Place</option>
                    <option value="5" @if(!is_null($energyConsumptionData) && $energyConsumptionData->category_id == 5) selected="selected" @endif>Hostel</option>
                </select>
            </div>

            <div class="form-group">
                <label for="inputName">Supply Type</label>
                <select class="form-control" id="inputName" name="supply_type" required>
                    <option value="">Select Supply Type</option>
                    <option value="1" @if(!is_null($energyConsumptionData) && $energyConsumptionData->supply_type_id == 1) selected="selected" @endif>1-Phase</option>
                    <option value="2" @if(!is_null($energyConsumptionData) && $energyConsumptionData->supply_type_id == 2) selected="selected" @endif>3-Phase</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sectionLoad">Sectioned Load</label>
                <input type="text" class="form-control width" id="sectionLoad" name="section_load" placeholder="Sectioned Load" @if(!is_null($energyConsumptionData) && $energyConsumptionData->section_load != '') value="{{ $energyConsumptionData->section_load }}" @endif required>
            </div>


            <div class="form-group">
                <label for="contact_demand">Contact Demand</label>
                <input type="text" class="form-control width" id="contact_demand" name="contact_demand" placeholder="Contact Demand" @if(!is_null($energyConsumptionData) && $energyConsumptionData->contract_demand != '') value="{{ $energyConsumptionData->contract_demand }}" @endif required>
            </div>


            <div class="form-group">
                <label for="billing_demand">Billing Demand</label>
                <input type="text" class="form-control width" id="billing_demand" name="billing_demand" placeholder="Billing Demand" @if(!is_null($energyConsumptionData) && $energyConsumptionData->billing_demand != '') value="{{ $energyConsumptionData->billing_demand }}" @endif required>
            </div>


            <div class="form-group">
                <label for="AvgPower">Avg Power Factor</label>
                <input type="text" class="form-control width" id="AvgPower" name="avg_power" placeholder="Sectioned Load" @if(!is_null($energyConsumptionData) && $energyConsumptionData->avg_power_factor != '') value="{{ $energyConsumptionData->avg_power_factor }}" @endif required>
            </div>

            <h2>Consumption Trend</h2>
            <br>

            @if(count($getMonth) > 0)
                @foreach($getMonth as $mk =>$mv)
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="month{{ $mk }}">Month</label>
                            <input type="text" class="form-control" name="data[{{$mv->id}}][month]" id="month{{ $mk }}" placeholder="Month" value="{{ $mv->month }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="unit{{ $mk }}">Unit Consumed</label>
                            <input type="text" class="form-control width" name="data[{{$mv->id}}][unit]" id="unit{{ $mk }}" placeholder="Unit Consumed" value="@if(count($month) > 0) {{ $month[$mv->id] }}@else 0 @endif">
                        </div>
                    </div>
                @endforeach
            @endif

            <h2>Last Bill Detail</h2>
            <br>
            <div class="form-group">
                <label for="billBack">Energy Bill Scan - Front</label>
                <input type="file" class="form-control dropify" id="billBack" name="bill_image_front" placeholder="Sectioned Load" @if(!is_null($energyConsumptionData) && $energyConsumptionData->energy_bill_front != '') data-default-file="{{ asset('uploads/energy_bill') }}/{{ $energyConsumptionData->energy_bill_front }}" @else required @endif >
            </div>

            <div class="form-group">
                <label for="billFront">Energy Bill Scan - Back</label>
                <input type="file" class="form-control dropify" id="billFront" name="bill_image_back" placeholder="Sectioned Load" @if(!is_null($energyConsumptionData) && $energyConsumptionData->energy_bill_back != '') data-default-file="{{ asset('uploads/energy_bill') }}/{{ $energyConsumptionData->energy_bill_back }}" @else required @endif>
            </div>

            <div class="form-group">
                <label for="totalAmount">Total Amount</label>
                <input type="text" class="form-control width" id="totalAmount" name="total_amount" placeholder="Total Amount" @if(!is_null($energyConsumptionData) && $energyConsumptionData->total_amount != '') value="{{ $energyConsumptionData->total_amount }}" @endif required>
            </div>


            <div class="form-group">
                <label for="unit_consumed">Unit Consumed</label>
                <input type="text" class="form-control width" id="unit_consumed" name="unit_consumed" placeholder="Unit Consumed" @if(!is_null($energyConsumptionData) && $energyConsumptionData->unit_consumed != '') value="{{ $energyConsumptionData->unit_consumed }}" @endif required>
            </div>

             <div class="form-group">
                <label for="unit_rate">Unit Rate</label>
                <input type="text" class="form-control width" id="unit_rate" name="unit_rate" placeholder="Unit Rate" @if(!is_null($energyConsumptionData) && $energyConsumptionData->unit_rate != '') value="{{ $energyConsumptionData->unit_rate }}" @endif required>
            </div>

	  </form>
	</div>                
</div>
<br>
<center>
    <a href="{{ route('formOne',[$id,$proposal_id]) }}" class="previous">&laquo; Previous</a>
    <a href="javascript:void(0);" class="next submit">Submit</a>
</center>

@endsection
@section('js')
<script type="text/javascript">
    $('.submit').on('click',function(){
        $('#login').submit();
    });

    $(document).on('focusout','#unit_consumed',function(){
        var total_amount = $('#totalAmount').val();
        var unit_rate = $(this).val();
        var total = total_amount / unit_rate;
        $('#unit_rate').val(total);
    });

    $(function() {
      $('input.width').keyup(function() {
        match = (/(\d{0,40})[^.]*((?:\.\d{0,2})?)/g).exec(this.value.replace(/[^\d.]/g, ''));
        this.value = match[1] + match[2];
      });
    });

</script>
@endsection
