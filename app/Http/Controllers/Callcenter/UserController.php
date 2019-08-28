<?php

namespace App\Http\Controllers\Callcenter;

use App\Http\Controllers\Controller;
use App\Models\AssignedLeadAssistant;
use App\Models\City;
use App\Models\GetCallRequest;
use App\Models\LeadAssistant;
use App\Models\TimeSlot;
use App\Models\User;
use App\Models\UserCity;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
    	$this->middleware('callcenter');
    }

    public function editUserInfo($id){

    	$getUserInfo =  User::where('id',$id)
                            ->with(['assigned_lead' => function($q){ $q->with(['lead_assistant','slot']); }])
                            ->first();

    	$getTimeSlot = TimeSlot::all();

        $getLeadAssistant = LeadAssistant::all();

        $lead_data = array();

        $getCityList = City::all();

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

    	return view('callcenter.user.user_edit_info',compact('getUserInfo','getTimeSlot','lead_data','getCityList'));
    }

    public function saveUserInfo(Request $request){

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
        $user->user_status = $request->user_status;
        $user->calling_id = $request->calling_id;
        $user->remark_lead_assistant = $request->remark_lead_assistant;
        $user->reschedule_date = $request->reschedule_date;
        $user->reschedule_time = $request->reschedule_time;
        $user->city_id = $request->city_id;
        $user->site_visit = $request->appointment_date;
    	$user->save();


    	if($user){

            $deleteAssignedUser = AssignedLeadAssistant::where('user_id',$request->id)->delete();

    		$assign = new AssignedLeadAssistant;
            $leadData = explode('-',$request->lead_assistant);
    		$assign->lead_assistant_id = $leadData[0];
    		$assign->time_slot_id = $leadData[1];
    		$assign->user_id = $request->id;
    		$assign->date = $request->appointment_date;
    		$assign->save();

    		$getCallRequest = GetCallRequest::where('user_id',$request->id)->update(['is_attend' => 1]);
    	}

    	return redirect(route('callcenter.getCallRequest'))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Password',
                  'message' => 'User information successfully updated!',
              ],
        ]); 

    }

    public function getLeadAssistant(Request $request){

        $date = explode('/',$request->date);
        $date = implode('-', $date);

    	$findLeadAssistant = UserCity::where('city_id',$request->city_id)->with(['leadassistant'])->get();

        $leadAssistantArray = array();

        if(!is_null($findLeadAssistant)){
            foreach($findLeadAssistant as $fk => $fv){
                $getLeadAssistantData = AssignedLeadAssistant::where('lead_assistant_id',$fv->user_id)->where('date',$request->date)->get();
                $getWorkSchedule = WorkSchedule::where('lead_assistant_id',$fv->user_id)->where('date',$date)->get();
                $leadAssistantArray[$fk]['lead_assistant_id'] = $fv->leadassistant->id;
                $leadAssistantArray[$fk]['lead_assistant'] = $fv->leadassistant->name;
                if(!is_null($getLeadAssistantData)){
                    foreach($getLeadAssistantData as $lk => $lv){
                        $leadAssistantArray[$fk]['data'][] = $lv->time_slot_id;
                    }
                }

                $leaveArray = array(1,2,3);

                foreach($leaveArray as $lk => $lv){
                    $getWorkSchedule = WorkSchedule::where('lead_assistant_id',$fv->user_id)->where('date',$date)->where('type',$lv)->first();
                    if(!is_null($getWorkSchedule)){
                        $leadAssistantArray[$fk]['leave_data'][$lk]['is_selected'] = 1;
                    }
                }

            }
        }

        return view('callcenter.user.get_lead_assistant',compact('leadAssistantArray'));
    }
}
