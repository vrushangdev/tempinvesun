<?php

namespace App\Http\Controllers\Callcenter;

use App\Http\Controllers\Controller;
use App\Models\AssignedLeadAssistant;
use App\Models\GetCallRequest;
use App\Models\LeadAssistant;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
    	$this->middleware('callcenter');
    }

    public function editUserInfo($id){

    	$getUserInfo =  User::where('id',$id)->first();

    	$getTimeSlot = TimeSlot::all();

    	return view('callcenter.user.user_edit_info',compact('getUserInfo','getTimeSlot'));
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
    	$user->save();

    	if($user){

    		$assign = new AssignedLeadAssistant;
    		$assign->lead_assistant_id = $request->lead_assistant;
    		$assign->time_slot_id = $request->time_slot_id;
    		$assign->user_id = $user->id;
    		$assign->date = $request->appointment_date;
    		$assign->save();

    		$getCallRequest = GetCallRequest::where('user_id',$user->id)->update(['is_attend' => 1]);
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

    	$getLeadAssistant = LeadAssistant::all();

    	$lead_data = array();

    	if(!is_null($getLeadAssistant)){
    		foreach($getLeadAssistant as $lk => $lv){
    			$getTimeSlot = TimeSlot::all();
    			foreach($getTimeSlot as $ek => $tv){
    				$findAppointment = AssignedLeadAssistant::where('lead_assistant_id',$lv->id)->where('time_slot_id',$tv->id)->where('date',$request->date)->count();
    				$lead_data[$lk]['id'] = $lv->id;
    				$lead_data[$lk]['name'] = $lv->name;
    				$lead_data[$lk]['appointment_data'][$ek]['id'] = $tv->id;
    				$lead_data[$lk]['appointment_data'][$ek]['name'] = $tv->name;
    				$lead_data[$lk]['appointment_data'][$ek]['count'] = $findAppointment;
    			}
    		}
    	}

    	return view('callcenter.user.get_lead_assistant',compact('lead_data'));	
    }
}
