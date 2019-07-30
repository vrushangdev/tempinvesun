<?php

namespace App\Http\Controllers\Leadassistant;

use App\Http\Controllers\Controller;
use App\Models\AssignedLeadAssistant;
use App\Models\LeadAssistant;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Http\Request;

class PresentationController extends Controller
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

    	return view('lead_assistant.presentation.form_one',compact('getUserInfo','getTimeSlot','lead_data','id'));

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
    	return view('lead_assistant.presentation.form_two',compact('id'));
    }

    public function formThree($id){
    	return view('lead_assistant.presentation.form_three',compact('id'));
    }


}
