@extends('layouts.presentation_new')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')
<section class="gradient-01">
    <div class="container ">
        <div class="row m-h-100 ">
            <div class="col-md-12 col-lg-12 m-auto">
            	<div class="avatar">
                    <a href="{{ route('formThree',[$id,$proposal_id]) }}" class="previous">
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
                           	<form id="login" name="login" action="{{ route('saveFormFour') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" name="proposal_id" id ="proposal_id" value="{{ $proposal_id }}">
                                <input type="hidden" id="user_id" name="id" value="{{ $id }}">
                                <input type="hidden" name="user_site_survey" @if(count($energy) > 0) value="{{ $energy->id }}" @else value="" @endif>

                                <div class="form-row" >
                                    <div class="form-group col-md-4">
                                        <label for="inputFirstName">Roof Length</label>
                                        <input type="text" class="form-control width" id="inputRoofLength" name="roof_length" placeholder="Length" @if(count($energy) > 0) value="{{ $energy->roof_length }}" @else value="" @endif required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputFirstName">Roof Width</label>
                                        <input type="text" class="form-control width" id="inputRoofWidth" name="roof_width" placeholder="Width" @if(count($energy) > 0) value="{{ $energy->roof_width }}" @else value="" @endif required>
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <input type="text" class="form-control width" id="area" name="area" placeholder="Area" @if(count($energy) > 0) value="{{ $energy->area }}" @endif readonly required>
                                </div>


                                <div class="form-group">
                                    <label for="row_of_panel">Row of Panels</label>
                                    <input type="text" class="form-control width" id="row_of_panel" name="row_of_panel" placeholder="Row of Panels" @if(count($energy) > 0) value="{{ $energy->rows }}" @endif required>
                                </div>

                                <div class="form-group">
                                    <label for="column_of_panel">Column of Panels</label>
                                    <input type="text" class="form-control width" id="column_of_panel" name="column_of_panel" placeholder="Column of Panels" @if(count($energy) > 0) value="{{ $energy->column }}" @endif required>
                                </div>
                                

                                <div class="form-group">
                                    <label for="roof_pic_one">Roof Picture One</label>
                                    <input type="file" class="form-control dropify" id="roof_pic_one" name="roof_pic_one"  @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->roof_image_one }}" @else required @endif>
                                </div>

                                <div class="form-group">
                                    <label for="roof_pic_two">Roof Picture Two</label>
                                    <input type="file" class="form-control dropify" id="roof_pic_two" name="roof_pic_two" placeholder="Sectioned Load" @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->roof_image_two }}" @else required @endif>
                                </div>

                               

                                <div class="form-group">
                                    <label for="panel_orientation">Panel Orientation</label>
                                    <input type="file" class="form-control dropify" id="panel_orientation" name="panel_orientation" placeholder="Sectioned Load" @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->panel_orientation }}"  @else required @endif>
                                </div>

                                <div class="form-group">
                                    <label for="direction_of_panel">Direction of panel</label>
                                    <input type="file" class="form-control dropify" id="direction_of_panel" name="direction_of_panel" placeholder="Sectioned Load"  @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->direction }}"  @else required @endif>
                                </div>

                                <div class="form-group">
                                    <label for="structure_selection">Structure Selection</label>
                                    <select class="form-control" name="structure_selection" id="structure_selection" required>
                                        <option value="">Select Structure Selection</option>
                                        <option value="1" @if(count($energy) > 0 && $energy->structure_selection == 1) selected="selected" @endif>Standard</option>
                                        <option value="2" @if(count($energy) > 0 && $energy->structure_selection == 2) selected="selected" @endif>Modified</option>
                                        <option value="3" @if(count($energy) > 0 && $energy->structure_selection == 3) selected="selected" @endif>Customized</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="dc_wiring">DC Wiring </label>
                                    <input type="file" class="form-control dropify" id="dc_wiring" name="dc_wiring" placeholder="Sectioned Load" @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->dc_wiring }}" @else required @endif>
                                </div>

                                <div class="form-group">
                                    <label for="dc_db_location">DC DB Location</label>
                                    <input type="file" class="form-control dropify" id="dc_db_location" name="dc_db_location" placeholder="Sectioned Load" @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->dc_db_location }}" @else required @endif>
                                </div>

                                <div class="form-group">
                                    <label for="inverter_location">Inverter Location </label>
                                    <input type="file" class="form-control dropify" id="inverter_location" name="inverter_location" placeholder="Sectioned Load" @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->inverter_location }}" @else required @endif>
                                </div>

                                <div class="form-group">
                                    <label for="ac_wiring_connection">AC Wiring Connection </label>
                                    <input type="file" class="form-control dropify" id="ac_wiring_connection" name="ac_wiring_connection" placeholder="Sectioned Load" @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->ac_wiring_connection }}" @else required @endif>
                                </div>

                                <div class="form-group">
                                    <label for="meter_location">Meter Location </label>
                                    <input type="file" class="form-control dropify" id="meter_location" name="meter_location" placeholder="Sectioned Load" @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->meter_location }}" @else required @endif>
                                </div>

                                <div class="form-group">
                                    <label for="building_overview">Building Overview </label>
                                    <input type="file" class="form-control dropify" id="building_overview" name="building_overview" placeholder="Sectioned Load" @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->building_overview }}" @else required @endif>
                                </div>

                                <div class="form-group">
                                    <label for="building_north">Building from north</label>
                                    <input type="file" class="form-control dropify" id="building_north" name="building_north" placeholder="Sectioned Load" @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->building_north }}" @else required @endif>
                                </div>

                                <div class="form-group">
                                    <label for="building_east">Building from east</label>
                                    <input type="file" class="form-control dropify" id="building_east" name="building_east" placeholder="Sectioned Load" @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->building_east }}" @else required @endif>
                                </div>

                                <div class="form-group">
                                    <label for="building_west">Building from west</label>
                                    <input type="file" class="form-control dropify" id="building_west" name="building_west" placeholder="Sectioned Load" @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->building_west }}" @else required @endif>
                                </div>

                                <div class="form-group">
                                    <label for="building_south">Building from South </label>
                                    <input type="file" class="form-control dropify" id="building_south" name="building_south" placeholder="Sectioned Load" @if(count($energy) > 0) data-default-file="{{ asset('uploads/site_survey') }}/{{ $energy->building_south }}" @else required @endif>
                                </div>
                                <br>
                                
                                <div class="form-group">
                                    <h5>Access to Roof :</h5><br>
                                    
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="access_of_roof" value="1" @if(count($energy) > 0 && $energy->access_of_roof == 1) checked @endif> Excellent 
                                    </label>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="access_of_roof" value="2" @if(count($energy) > 0 && $energy->access_of_roof == 2) checked @endif> Good 
                                    </label>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="access_of_roof" value="3" @if(count($energy) > 0 && $energy->access_of_roof == 3) checked @endif> Difficult 
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="access_of_roof" value="4" @if(count($energy) > 0 && $energy->access_of_roof == 4) checked @endif> Worst 
                                    </label>
                                </div>
                                <br>
                                <div class="form-group">
                                    <h5>Access to House :</h5><br>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="access_of_house" value="1" @if(count($energy) > 0 && $energy->access_of_house == 1) checked @endif> Excellent 
                                    </label>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="access_of_house" value="2" @if(count($energy) > 0 && $energy->access_of_house == 2) checked @endif> Good 
                                    </label>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="access_of_house" value="3" @if(count($energy) > 0 && $energy->access_of_house == 3) checked @endif> Difficult 
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="access_of_house" value="4" @if(count($energy) > 0 && $energy->access_of_house == 4) checked @endif> Worst 
                                    </label>
                                </div>
                                <br>
                                <div class="form-group">
                                    <h5>Site Condition :</h5><br>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="site_conditions" value="1" @if(count($energy) > 0 && $energy->site_condition == 1) checked @endif> Excellent 
                                    </label>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="site_conditions" value="2" @if(count($energy) > 0 && $energy->site_condition == 2) checked @endif> Good 
                                    </label>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="site_conditions" value="3" @if(count($energy) > 0 && $energy->site_condition == 3) checked @endif> Difficult 
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="site_conditions" value="4" @if(count($energy) > 0 && $energy->site_condition == 4) checked @endif> Worst 
                                    </label>
                                </div>
                                <br>
                                 <div class="form-group">
                                    <h5>Shadding :</h5><br>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="shadding" value="1" @if(count($energy) > 0 && $energy->shadding == 1) checked @endif> Excellent 
                                    </label>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="shadding" value="2" @if(count($energy) > 0 && $energy->shadding == 2) checked @endif> Good 
                                    </label>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="shadding" value="3" @if(count($energy) > 0 && $energy->shadding == 3) checked @endif> Difficult 
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="shadding" value="4" @if(count($energy) > 0 && $energy->shadding == 4) checked @endif> Worst 
                                    </label>
                                </div>
                                <br>
                                <div class="form-group">
                                    <h5>Age of Roof :</h5><br>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="age_of_roof" value="1" @if(count($energy) > 0 && $energy->age_of_roof == 1) checked @endif> Excellent 
                                    </label>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="age_of_roof" value="2" @if(count($energy) > 0 && $energy->age_of_roof == 2) checked @endif> Good 
                                    </label>
                                    <label class="radio-inline" style="float:left;margin-right: 15px;">
                                      <input type="radio" name="age_of_roof" value="3" @if(count($energy) > 0 && $energy->age_of_roof == 3) checked @endif> Difficult 
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="age_of_roof" value="4" @if(count($energy) > 0 && $energy->age_of_roof == 4) checked @endif> Worst 
                                    </label>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="remarks">Any Remarks</label>
                                    <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks" @if(count($energy) > 0) value="{{ $energy->remarks }}" @endif>
                                </div>

                                <br>
                                
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
    $('.submit').on('click',function(){
        if($('#login').valid()){
            $('#login').submit();
        }
    });

    $(document).on('keyup','#inputRoofLength',function(){

        var length = $(this).val();
        var width = $('#inputRoofWidth').val();
        var total = length * width;
        $('#area').val(total);

    })

    $(document).on('keyup','#inputRoofWidth',function(){


        var length = $(this).val();
        var width = $('#inputRoofLength').val();
        var total = length * width;
        $('#area').val(total);
        
    })


</script>
@endsection