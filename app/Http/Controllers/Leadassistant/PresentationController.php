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
use App\Models\Calculation;
use App\Models\UserProposal;
use App\Models\UserProposalImage;
use App\Models\UserSiteSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresentationController extends GlobalController
{
    public function __construct()
    {
    	$this->middleware('lead_assistant');
    }

    public function imageOne($id){

        $findProposal = UserProposal::orderBy('id','desc')->first();

        if(!is_null($findProposal)){
            $proposalId = $findProposal->id + 1; 
        } else {
            $proposalId = 1; 
        }

        $proposalId = str_pad($proposalId,4,"0",STR_PAD_LEFT);

        $proposalId = "IN".date('Y')."".date('m')."".date('d')."".$proposalId;

        $saveProposal = new UserProposal;
        $saveProposal->user_id = $id;
        $saveProposal->proposal_id = $proposalId;
        $saveProposal->save();

        $findUser = User::where('id',$id)->first();

        $leadAssistant = LeadAssistant::where('id',Auth::guard('lead_assistant')->user()->id)->first();

        $name = $findUser->first_name." ".$findUser->middle_name." ".$findUser->last_name;
        $location = $findUser->city.", ".$findUser->country;

        $lname = $leadAssistant->name;
        $ldetails = $leadAssistant->email;

        $img6 = public_path()."/img/img/1-02.jpg";

        $picin = new \Imagick($img6); 
        $picin->scaleimage(800,0); 
        $height = $picin->getimageheight(); 

        $draw = new \ImagickDraw(); 
        $draw->setFillColor('#000'); 
        $draw->setFontSize(16);
        $draw->setFontWeight(500); 
        //System Size

        $picin->annotateImage($draw,467,220,0,$name);
        $picin->annotateImage($draw,467,245,0,$location);

        $picin->annotateImage($draw,468,320,0,$lname);
        $picin->annotateImage($draw,467,345,0,$ldetails); 

        $picin->annotateImage($draw,467,420,0,$proposalId);

        $imageName = md5(microtime()).".jpg";

        $proposalImageOne =  public_path()."/pdf/".$imageName;

        $picin->writeimage($proposalImageOne); 

        $saveProposal = new UserProposalImage;
        $saveProposal->user_id = $id;
        $saveProposal->proposal_id = $proposalId;
        $saveProposal->image = $imageName;
        $saveProposal->save();

    	return view('lead_assistant.presentation.image_one',compact('id','proposalId','imageName'));
    }

    public function imageTwo($id,$proposal_id){
    	
    	return view('lead_assistant.presentation.image_two',compact('id','proposal_id'));	
    }

    public function imageThree($id,$proposal_id){
    	
    	return view('lead_assistant.presentation.image_three',compact('id','proposal_id'));
    }

    public function imageFour($id,$proposal_id){
    	return view('lead_assistant.presentation.image_four',compact('id','proposal_id'));
    }

    public function imageFive($id,$proposal_id){
    	return view('lead_assistant.presentation.image_five',compact('id','proposal_id'));
    }

    public function formOne($id,$proposal_id){

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

    	return view('lead_assistant.presentation.form_one',compact('getUserInfo','getTimeSlot','lead_data','id','getCountry','getState','getCity','proposal_id'));

    }

    public function saveFormOne(Request $request){

        /*echo "<pre>";
        print_r($request->all());
        exit;*/
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

    	return redirect(route('formTwo',[$request->id,$request->proposal_id]))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Password',
                  'message' => 'User information successfully updated!',
              ],
        ]); 
    }

    public function formTwo($id,$proposal_id){

    	$getMonth = Month::all();

        $energyConsumptionData = EnergyConsumptionDetail::where('user_id',$id)->first();

        $month = array();

        $getMonthData = ConsumptionTrend::where('user_id',$id)->get();

        if(count($getMonthData) > 0){
            foreach($getMonthData as $mk => $mv){
                $month[$mv->month_id] = $mv->unit_consumed;
            }
        }

    	return view('lead_assistant.presentation.form_two',compact('id','getMonth','energyConsumptionData','month','proposal_id'));
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

            return redirect(route('formThree',[$request->id,$request->proposal_id]))->with('messages', [
                  [
                      'type' => 'success',
                      'title' => 'Password',
                      'message' => 'Energy information successfully updated!',
                  ],
            ]); 
        }
    }

    public function formThree($id,$proposal_id){

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
            $basic = $userPreview->basic; 
            $gst = $userPreview->gst;
            $total = $userPreview->total; 
            $subsidy = $userPreview->subsidy;
            $subsidize_amount = $userPreview->subsidize_amount;
            $net_payable = $userPreview->net_payable;
            $discom_charge = $userPreview->discom_charge;
            $structure_modification = $userPreview->structure_modification;
            $mobile_app = $userPreview->mobile_app; 
            $solar_monitoring = $userPreview->solar_monitoring; 
            $extended_aintenance = $userPreview->extended_aintenance;
            $insurance_coverage = $userPreview->insurance_coverage;
            $solar_panel = $userPreview->solar_panel; 
            $grid_tie_inverter = $userPreview->grid_tie_inverter; 
            $structure = $userPreview->structure;

        } else {
            $getConsumptionTrend = ConsumptionTrend::where('user_id',$id)->sum('unit_consumed');
            $suggestedSystem = $getConsumptionTrend / 1500 ;
            $suggestedSystem = ceil($suggestedSystem);
            $area_required = $suggestedSystem * 80;
            $investment = 0;
            $netpayble = 0;
            $savingPerYear = $suggestedSystem * 1500 * $energyConsumptionData->unit_rate;
            $emiStart = $suggestedSystem * 750;
            $basic = 0;
            $gst = 0;
            $total = 0;
            $subsidy = 0;
            $subsidize_amount = 0;
            $net_payable = 0;
            $discom_charge = 0;
            $structure_modification = 0;
            $mobile_app = 0;
            $solar_monitoring = 0;
            $extended_aintenance = 0;
            $insurance_coverage = 0;
            $solar_panel = 0;
            $grid_tie_inverter = 0;
            $structure = 0;
        }

    	return view('lead_assistant.presentation.form_three',compact('id','suggestedSystem','area_required','investment','netpayble','savingPerYear','emiStart','unit_rate','userPreviewId','proposal_id','basic','gst','total','subsidy','subsidize_amount','net_payable','discom_charge','structure_modification','mobile_app','solar_monitoring','extended_aintenance','insurance_coverage','solar_panel','grid_tie_inverter','structure'));
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
        $energy->basic = $request->basic; 
        $energy->gst = $request->gst; 
        $energy->total = $request->total; 
        $energy->subsidy = $request->subsidy; 
        $energy->subsidize_amount = $request->subsidize_amount; 
        $energy->net_payable = $request->net_payable; 
        $energy->discom_charge = $request->discom_charge; 
        $energy->structure_modification = $request->structure_modification; 
        $energy->mobile_app = $request->mobile_app; 
        $energy->solar_monitoring = $request->solar_monitoring; 
        $energy->extended_aintenance = $request->extended_aintenance; 
        $energy->insurance_coverage = $request->insurance_coverage; 
        $energy->solar_panel = $request->solar_panel; 
        $energy->grid_tie_inverter = $request->grid_tie_inverter; 
        $energy->structure = $request->structure; 
        $energy->save();

        $img9 = public_path()."/img/img/6-06.jpg";

        $picin = new \Imagick($img9); 
        $picin->scaleimage(1920,1120); 
        /*$height = $picin->getimageheight(); */

        $draw = new \ImagickDraw(); 
        $draw->setFillColor('#000');
        $draw->setFontSize(48);
        $draw->setFontWeight(600); 
        //System Size
        $picin->annotateImage($draw,1210,452,0,"5kWp"); 
        $picin->annotateImage($draw,930,670,0,"750 sqft"); 
        $picin->annotateImage($draw,920,850,0,"Rs. 6500"); 

        $picin->annotateImage($draw,1390,670,0,"Rs. 6500"); 
        $picin->annotateImage($draw,1390,850,0,"Rs. 6500"); 

        $draw->setFillColor('#9580ce');

        $picin->annotateImage($draw,1315,982,0,"Rs. 6500"); 

        $imageName = md5(microtime()).".jpg";

        $proposalImageOne =  public_path()."/pdf/".$imageName;

        $picin->writeimage($proposalImageOne); 

        $deleteProposalImage = UserProposalImage::where('proposal_id',$request->proposal_id)->where('type',6)->delete();

        $saveProposal = new UserProposalImage;
        $saveProposal->user_id = $request->id;
        $saveProposal->proposal_id = $request->proposal_id;
        $saveProposal->image = $imageName;
        $saveProposal->type = 9;
        $saveProposal->save();
        
        return redirect(route('formFour',[$request->id,$request->proposal_id]))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Password',
                  'message' => 'Preview Information Successfully Saved!',
              ],
        ]); 

    }

    public function formFour($id,$proposal_id){

        $energy = UserSiteSurvey::where('user_id',$id)->first();

        return view('lead_assistant.presentation.form_four',compact('id','energy','proposal_id'));
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

        
        return redirect(route('imageSix',[$request->id,$request->proposal_id]))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Password',
                  'message' => 'Site Survey Successfully Saved!',
              ],
        ]); 
    }


    public function imageSix($id,$proposal_id){
        return view('lead_assistant.presentation.image_six',compact('id','proposal_id'));
    }

    public function imageSeven($id,$proposal_id){

        $img9 = public_path()."/img/img/9-09.jpg";

        $picin = new \Imagick($img9); 
        $picin->scaleimage(1920,1120); 
        /*$height = $picin->getimageheight(); */

        $draw = new \ImagickDraw(); 
        $draw->setFillColor('#fff');
        $draw->setFontSize(48);
        $draw->setFontWeight(600); 
        //System Size
        $picin->annotateImage($draw,260,380,0,"Rs. 6500"); 
        $picin->annotateImage($draw,260,560,0,"Rs. 6500"); 
        $picin->annotateImage($draw,260,740,0,"Rs. 6500"); 
        //Area Required
        $draw->setFillColor('#000'); 

        $picin->annotateImage($draw,770,380,0,"Adani/Equivalent"); 
        $picin->annotateImage($draw,780,560,0,"SMA/Equivalent"); 
        $picin->annotateImage($draw,860,740,0,"Modified"); 

        $draw->setFillColor('#fff');
        //Investment
        $picin->annotateImage($draw,1460,380,0,"Rs. 4500"); 
        $picin->annotateImage($draw,1460,560,0,"Rs. 4500"); 
        $picin->annotateImage($draw,1460,740,0,"Rs. 4500"); 

        $imageName = md5(microtime()).".jpg";

        $proposalImageOne =  public_path()."/pdf/".$imageName;

        $picin->writeimage($proposalImageOne); 

        $deleteProposalImage = UserProposalImage::where('proposal_id',$proposal_id)->where('type',9)->delete();

        $saveProposal = new UserProposalImage;
        $saveProposal->user_id = $id;
        $saveProposal->proposal_id = $proposal_id;
        $saveProposal->image = $imageName;
        $saveProposal->type = 9;
        $saveProposal->save();

        return view('lead_assistant.presentation.image_seven',compact('id','proposal_id','imageName'));
    }

    public function imageEight($id,$proposal_id){

        return view('lead_assistant.presentation.image_eight',compact('id','proposal_id'));
    }


    public function imageTen($id,$proposal_id){

        return view('lead_assistant.presentation.image_ten',compact('id','proposal_id'));
    }

    public function imageEleven($id,$proposal_id){

        $img6 = public_path()."/img/img/10-10.jpg";

        $picin = new \Imagick($img6); 
        $picin->scaleimage(1920,1120); 
        $height = $picin->getimageheight(); 

        $draw = new \ImagickDraw(); 
        $draw->setFillColor('#face29'); 
        $draw->setFontSize(48);
        $draw->setFontWeight(600); 
        //System Size
        $picin->annotateImage($draw,260,550,0,"Rs. 6500"); 
        //Area Required
        $draw->setFillColor('#ff6c2c');

        $picin->annotateImage($draw,890,550,0,"Rs. 6500"); 

        $draw->setFillColor('#ff6c2c');
        //Investment
        $picin->annotateImage($draw,1430,550,0,"Rs. 4500"); 

        $imageName = md5(microtime()).".jpg";

        $proposalImageOne =  public_path()."/pdf/".$imageName;

        $picin->writeimage($proposalImageOne); 

        $deleteProposalImage = UserProposalImage::where('proposal_id',$proposal_id)->where('type',11)->delete();

        $saveProposal = new UserProposalImage;
        $saveProposal->user_id = $id;
        $saveProposal->proposal_id = $proposal_id;
        $saveProposal->image = $imageName;
        $saveProposal->type = 11;
        $saveProposal->save();

        return view('lead_assistant.presentation.image_eleven',compact('id','proposal_id','imageName'));
    }

    public function imageTwelve($id,$proposal_id){

         $img6 = public_path()."/img/img/11-11.jpg";

        $picin = new \Imagick($img6); 
        $picin->scaleimage(1920,1120); 
        $height = $picin->getimageheight(); 

        $draw = new \ImagickDraw(); 
        $draw->setFillColor('#9580ce'); 
        $draw->setFontSize(48);
        $draw->setFontWeight(600); 
        //System Size
        $picin->annotateImage($draw,250,550,0,"FREE"); 
        //Area Required
        $picin->annotateImage($draw,660,550,0,"FREE"); 

        $picin->annotateImage($draw,1050,550,0,"Rs. 4500");

        $picin->annotateImage($draw,1470,550,0,"Rs. 5000");

        $imageName = md5(microtime()).".jpg";

        $proposalImageOne =  public_path()."/pdf/".$imageName;

        $picin->writeimage($proposalImageOne); 

        $deleteProposalImage = UserProposalImage::where('proposal_id',$proposal_id)->where('type',12)->delete();

        $saveProposal = new UserProposalImage;
        $saveProposal->user_id = $id;
        $saveProposal->proposal_id = $proposal_id;
        $saveProposal->image = $imageName;
        $saveProposal->type = 12;
        $saveProposal->save();

        return view('lead_assistant.presentation.image_twelve',compact('id','proposal_id','imageName'));
    }

    public function imageThirteen($id,$proposal_id){

        return view('lead_assistant.presentation.image_thirteen',compact('id','proposal_id'));
    }

    public function getCalculationData(Request $request){

        $getData = Calculation::where('plant_size',$request->system_size)->first();

        $calculationData = array();

        if(!is_null($getData)){

            $calculationData['basic'] = $getData->basic; 
            $calculationData['gst'] = $getData->gst; 
            $calculationData['total'] = $getData->total; 
            $calculationData['subsidy'] = $getData->subsidy; 
            $calculationData['subsidize_amount'] = $getData->subsidize_amount; 
            $calculationData['net_payable'] = $getData->net_payable; 
            $calculationData['discom_charge'] = $getData->discom_charge; 
            $calculationData['structure_modification'] = $getData->structure_modification; 
            $calculationData['mobile_app'] = $getData->mobile_app; 
            $calculationData['solar_monitoring'] = $getData->solar_monitoring; 
            $calculationData['extended_aintenance'] = $getData->extended_aintenance; 
            $calculationData['insurance_coverage'] = $getData->insurance_coverage; 
            $calculationData['solar_panel'] = $getData->solar_panel; 
            $calculationData['grid_tie_inverter'] = $getData->grid_tie_inverter; 
            $calculationData['structure'] = $getData->structure; 
        }

        return $calculationData;
    }
}
        