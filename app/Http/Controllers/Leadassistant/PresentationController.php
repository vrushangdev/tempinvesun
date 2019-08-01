<?php

namespace App\Http\Controllers\Leadassistant;

use App\Http\Controllers\GlobalController;
use App\Models\AssignedLeadAssistant;
use App\Models\City;
use App\Models\ConsumptionTrend;
use App\Models\Country;
use App\Models\EnergyConsumptionDetail;
use App\Models\LeadAssistant;
use App\Models\Month;
use App\Models\State;
use App\Models\TimeSlot;
use App\Models\User;
use App\Models\UserPreview;
use App\Models\UserSiteSurvey;
use Illuminate\Http\Request;

class PresentationController extends GlobalController
{
    public function __construct()
    {
    	$this->middleware('lead_assistant');
    }

    public function imageOne($id){

    	return view('lead_assistant.presentation.image_one',compact('id'));
    }

    public function imageTwo($id){
    	
    	return view('lead_assistant.presentation.image_two',compact('id'));	
    }

    public function imageThree($id){
    	
    	return view('lead_assistant.presentation.image_three',compact('id'));
    }

    public function imageFour($id){
    	return view('lead_assistant.presentation.image_four',compact('id'));
    }

    public function imageFive($id){
    	return view('lead_assistant.presentation.image_five',compact('id'));
    }

    public function imageSix($id){
    	return view('lead_assistant.presentation.image_six',compact('id'));
    }

    public function formOne($id){

    	$getUserInfo =  User::where('id',$id)
                            ->with(['assigned_lead' => function($q){ $q->with(['lead_assistant','slot']); }])
                            ->first();

    	$getTimeSlot = TimeSlot::all();

    	$getCountry = Country::all();

    	$getState = State::all();

    	$getCity = City::all();

        $getLeadAssistant = LeadAssistant::all();

        $lead_data = array();

        if(!is_null($getUserInfo->assigned_lead)){

            if(!is_null($getLeadAssistant)){
                foreach($getLeadAssistant as $lk => $lv){
                    $getTimeSlot = TimeSlot::all();
                    foreach($getTimeSlot as $ek => $tv){
                        $findAppointment = AssignedLeadAssistant::where('lead_assistant_id',$lv->id)->where('time_slot_id',$tv->id)->where('date',$getUserInfo->assigned_lead->date)->count();
                        $lead_data[$lk]['id'] = $lv->id;
                        $lead_data[$lk]['name'] = $lv->name;
                        $lead_data[$lk]['appointment_data'][$ek]['id'] = $tv->id;
                        $lead_data[$lk]['appointment_data'][$ek]['name'] = $tv->name;
                        $lead_data[$lk]['appointment_data'][$ek]['count'] = $findAppointment;
                        if($getUserInfo->assigned_lead->user_id == $getUserInfo->id && $getUserInfo->assigned_lead->lead_assistant_id == $lv->id && $getUserInfo->assigned_lead->time_slot_id == $tv->id){
                            $lead_data[$lk]['appointment_data'][$ek]['assign'] = 1;
                        } else {
                            $lead_data[$lk]['appointment_data'][$ek]['assign'] = 0;
                        }
                    }
                }
            }
        }

    	return view('lead_assistant.presentation.form_one',compact('getUserInfo','getTimeSlot','lead_data','id','getCountry','getState','getCity'));

    }

    public function saveFormOne(Request $request){

    	$user = User::findOrFail($request->id);
    	$user->title = $request->title;
    	$user->first_name = $request->first_name;
    	$user->middle_name = $request->middle_name;
    	$user->last_name = $request->surname;
    	$user->address1 = $request->address1;
    	$user->address2 = $request->address2;
    	$user->city = $request->city;
    	$user->pincode = $request->pincode;
    	$user->district = $request->district;
    	$user->state = $request->state;
    	$user->country = $request->country;
    	$user->billing_address = 'same';
    	$user->gst_number = $request->gst;
    	$user->mobile = $request->mobile;
    	$user->alt_no = $request->alt_mobile;
    	$user->email = $request->email;
        $user->remarks = $request->remark;
        $user->lat = $request->latitude;
        $user->lang = $request->longitude;
        $user->google_location = $request->location;
    	$user->save();

    	return redirect(route('formTwo',$request->id))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Password',
                  'message' => 'User information successfully updated!',
              ],
        ]); 
    }

    public function formTwo($id){

    	$getMonth = Month::all();

        $energyConsumptionData = EnergyConsumptionDetail::where('user_id',$id)->first();

        $month = array();

        $getMonthData = ConsumptionTrend::where('user_id',$id)->get();

        if(count($getMonthData) > 0){
            foreach($getMonthData as $mk => $mv){
                $month[$mv->month_id] = $mv->unit_consumed;
            }
        }

    	return view('lead_assistant.presentation.form_two',compact('id','getMonth','energyConsumptionData','month'));
    }

    public function saveFormTwo(Request $request){

        if($request->energy_consumption_id != ''){
            $energy = EnergyConsumptionDetail::findOrFail($request->energy_consumption_id);
        } else {
            $energy = new EnergyConsumptionDetail;
        }
        $energy->user_id = $request->id;
        $energy->disribution_company_id = $request->distribution_company;
        $energy->service_number = $request->service_number;
        $energy->category_id = $request->category_id;
        $energy->supply_type_id = $request->supply_type;
        $energy->section_load = $request->section_load;
        $energy->contract_demand = $request->contact_demand;
        $energy->billing_demand = $request->billing_demand;
        $energy->avg_power_factor = $request->avg_power;
        $energy->total_amount = $request->total_amount;
        $energy->unit_consumed = $request->unit_consumed;
        $energy->unit_rate = $request->unit_rate;
        if(isset($request->bill_image_front)){
            $fileNameFront = $this->uploadImage($request->bill_image_front,'energy_bill');
            $energy->energy_bill_front = $fileNameFront;         
        }
        if(isset($request->bill_image_back)){
            $fileNameBack = $this->uploadImage($request->bill_image_back,'energy_bill');
            $energy->energy_bill_back = $fileNameBack;         
        }
        $energy->save();

        if($energy){
            //ConsumptionTrend

            if(isset($request->data) && count($request->data) > 0){
                $deleteUserData = ConsumptionTrend::where('user_id',$request->id)->delete();
                foreach($request->data as $dk => $dv){
                    $trend = new ConsumptionTrend;
                    $trend->user_id = $request->id;
                    $trend->month_id = $dk;
                    $trend->unit_consumed = $dv['unit'];
                    $trend->save();
                }
            }

            return redirect(route('formThree',$request->id))->with('messages', [
                  [
                      'type' => 'success',
                      'title' => 'Password',
                      'message' => 'Energy information successfully updated!',
                  ],
            ]); 
        }
    }

    public function formThree($id){

        $energyConsumptionData = EnergyConsumptionDetail::where('user_id',$id)->first();
        $unit_rate = $energyConsumptionData->unit_rate;

        $userPreview = UserPreview::where('user_id',$id)->first();
        $userPreviewId = '';
        if(count($userPreview) > 0){
            $suggestedSystem = $userPreview->suggest_system_size;
            $area_required = $userPreview->area_required;
            $investment = $userPreview->investment;
            $netpayble = $userPreview->payable;
            $savingPerYear = $userPreview->saving_per_year;
            $emiStart = $userPreview->emi_start_at;
            $userPreviewId = $userPreview->id;
        } else {
            $getConsumptionTrend = ConsumptionTrend::where('user_id',$id)->sum('unit_consumed');
            $suggestedSystem = $getConsumptionTrend / 1500 ;
            $area_required = $suggestedSystem * 80;
            $investment = 0;
            $netpayble = 0;
            $savingPerYear = $suggestedSystem * 1500 * $energyConsumptionData->unit_rate;
            $emiStart = $suggestedSystem * 750;
        }

    	return view('lead_assistant.presentation.form_three',compact('id','suggestedSystem','area_required','investment','netpayble','savingPerYear','emiStart','unit_rate','userPreviewId'));
    }

    public function saveFormThree(Request $request){

        if($request->user_preview_id != ''){
            $energy = UserPreview::findOrFail($request->user_preview_id);
        } else {
            $energy = new UserPreview;
        }
        $energy->user_id = $request->id;
        $energy->suggest_system_size = $request->suggested_system_size;
        $energy->area_required = $request->area_required;
        $energy->investment = $request->investment;
        $energy->payable = $request->net_payable;
        $energy->saving_per_year = $request->net_saving;
        $energy->emi_start_at = $request->emi_start;
        $energy->save();

        return redirect(route('formFour',$request->id))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Password',
                  'message' => 'Preview Information Successfully Saved!',
              ],
        ]); 

    }

    public function formFour($id){

        $energy = UserSiteSurvey::where('user_id',$id)->first();

        return view('lead_assistant.presentation.form_four',compact('id','energy'));
    }

    public function saveFormFour(Request $request){

        if($request->user_site_survey != ''){
            $energy = UserSiteSurvey::findOrFail($request->user_site_survey);
        } else {
            $energy = new UserSiteSurvey;
        }
        $energy->user_id = $request->id;
        $energy->roof_length = $request->roof_length;
        $energy->area = $request->area;
        $energy->rows = $request->row_of_panel;
        $energy->column = $request->column_of_panel;
        $energy->access_of_roof = $request->access_of_roof;
        $energy->access_of_house = $request->access_of_house;
        $energy->site_condition = $request->site_conditions;
        $energy->shadding = $request->shadding;
        $energy->age_of_roof = $request->age_of_roof;
        $energy->remarks = $request->remarks;
        $energy->structure_selection = $request->structure_selection;
        if(isset($request->roof_pic_one)){
            $roof_pic_one = $this->uploadImage($request->roof_pic_one,'site_survey');
            $energy->roof_image_one = $roof_pic_one;         
        }
        if(isset($request->roof_pic_two)){
            $roof_pic_two = $this->uploadImage($request->roof_pic_two,'site_survey');
            $energy->roof_image_two = $roof_pic_two;         
        }
        if(isset($request->panel_orientation)){
            $panel_orientation = $this->uploadImage($request->panel_orientation,'site_survey');
            $energy->panel_orientation = $panel_orientation;         
        }
        if(isset($request->direction_of_panel)){
            $direction_of_panel = $this->uploadImage($request->direction_of_panel,'site_survey');
            $energy->direction = $direction_of_panel;         
        }
        if(isset($request->dc_wiring)){
            $dc_wiring = $this->uploadImage($request->dc_wiring,'site_survey');
            $energy->dc_wiring = $dc_wiring;         
        }
        if(isset($request->dc_db_location)){
            $dc_db_location = $this->uploadImage($request->dc_db_location,'site_survey');
            $energy->dc_db_location = $dc_db_location;         
        }
        if(isset($request->inverter_location)){
            $inverter_location = $this->uploadImage($request->inverter_location,'site_survey');
            $energy->inverter_location = $inverter_location;         
        }
        if(isset($request->ac_wiring_connection)){
            $ac_wiring_connection = $this->uploadImage($request->ac_wiring_connection,'site_survey');
            $energy->ac_wiring_connection = $ac_wiring_connection;         
        }
        if(isset($request->meter_location)){
            $meter_location = $this->uploadImage($request->meter_location,'site_survey');
            $energy->meter_location = $meter_location;         
        }
        if(isset($request->building_overview)){
            $building_overview = $this->uploadImage($request->building_overview,'site_survey');
            $energy->building_overview = $building_overview;         
        }
        if(isset($request->building_north)){
            $building_north = $this->uploadImage($request->building_north,'site_survey');
            $energy->building_north = $building_north;         
        }
        if(isset($request->building_east)){
            $building_east = $this->uploadImage($request->building_east,'site_survey');
            $energy->building_east = $building_east;         
        }
        if(isset($request->building_west)){
            $building_west = $this->uploadImage($request->building_west,'site_survey');
            $energy->building_west = $building_west;         
        }
        if(isset($request->building_south)){
            $building_south = $this->uploadImage($request->building_south,'site_survey');
            $energy->building_south = $building_south;         
        }

        $energy->save();
        

        return redirect(route('formFive',$request->id))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Password',
                  'message' => 'Site Survey Successfully Saved!',
              ],
        ]); 
    }

    public function formFive($id){
        return view('lead_assistant.presentation.form_five',compact('id'));
    }

}
        