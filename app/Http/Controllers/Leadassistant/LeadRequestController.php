<?php

namespace App\Http\Controllers\Leadassistant;

use App\Http\Controllers\Controller;
use App\Models\AssignedLeadAssistant;
use App\Models\User;
use App\Models\UserDocument;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;

class LeadRequestController extends Controller
{
    public function __construct()
    {
    	$this->middleware('lead_assistant');
    }

    public function getLeadRequest(){

    	$getLeadRequest = AssignedLeadAssistant::where('is_attend',0)
    										   ->where('lead_assistant_id',Auth::guard('lead_assistant')->user()->id)
    										   ->with(['user','slot'])->get();

    	return view('lead_assistant.lead_request.lead_request_list',compact('getLeadRequest'));
    }

    public function attendedList(){

        $getLeadRequest = AssignedLeadAssistant::where('is_attend',1)
                                               ->where('lead_assistant_id',Auth::guard('lead_assistant')->user()->id)
                                               ->with(['user','slot','userpropasal','userdocument'])->get();
    

        return view('lead_assistant.lead_request.attended_lead_request_list',compact('getLeadRequest'));   
    }

    public function rescheduleLead(Request $request){
        
        $id = Auth::guard('lead_assistant')->user()->id;

        $date = explode('/',$request->date);
        $date = implode('-', $date);

        $leadAssistantArray = array();
      
        $getLeadAssistantData = AssignedLeadAssistant::where('lead_assistant_id',$id)->where('date',$request->date)->get();

        $getWorkSchedule = WorkSchedule::where('lead_assistant_id',$id)->where('date',$date)->get();

        // echo "<pre>";
        // print_r($getLeadAssistantData->toArray());
        // print_r($getWorkSchedule->toArray());
        // exit;

        $leadAssistantArray['lead_assistant_id'] = $id;

        if(!is_null($getLeadAssistantData)){
            foreach($getLeadAssistantData as $lk => $lv){
                $leadAssistantArray['data'][] = $lv->time_slot_id;
            }
        }

        $leaveArray = array(1,2,3);

        foreach($leaveArray as $lk => $lv){
            $getWorkSchedule = WorkSchedule::where('lead_assistant_id',$id)->where('date',$date)->where('type',$lv)->first();
            if(!is_null($getWorkSchedule)){
                $leadAssistantArray['leave_data'][$lk]['is_selected'] = 1;
            }
        }

        // echo "<pre>";
        // print_r($leadAssistantArray);
        // exit;
        return view('lead_assistant.lead_request.reschedule',compact('leadAssistantArray'));;
    }

    public function saveSchedule(Request $request){

        $leadData = explode('-',$request->lead_assistant);

        $deleteLead = AssignedLeadAssistant::where('user_id',$request->id)->where('lead_assistant_id',$leadData[0])->delete();

        $assign = new AssignedLeadAssistant;
        $assign->lead_assistant_id = $leadData[0];
        $assign->time_slot_id = $leadData[1];
        $assign->user_id = $request->id;
        $assign->date = $request->appointment_date;
        $assign->save();

        return redirect(route('lead_assistant.getLeadRequest'))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Password',
                  'message' => 'Lead Request rescheduled!',
              ],
        ]); 
    }

    public function downloadUserDocumnet($id){

        $findUserDocument = UserDocument::where('user_id',$id)->get();

        $findUser  = User::where('id',$id)->first();

        $imgArray = array();

        if(!is_null($findUserDocument)){
            foreach($findUserDocument as $fk => $fv){
                if($fv->proof_type == 'AADHAR'){
                    $imgArray[] = public_path()."/uploads/aadhar_card/".$fv->file_name;
                }

                if($fv->proof_type == 'PASSPORT'){
                    $imgArray[] = public_path()."/uploads/passport/".$fv->file_name;
                }

                if($fv->proof_type == 'BANK_STATEMENT'){
                    $imgArray[] = public_path()."/uploads/bank_statement/".$fv->file_name;
                }

                if($fv->proof_type == 'RESEDENTIAL'){
                    $imgArray[] = public_path()."/uploads/resedential_proof/".$fv->file_name;
                }

                if($fv->proof_type == 'OTHER'){
                    $imgArray[] = public_path()."/uploads/other/".$fv->file_name;
                }
            }
        }

        $name = "proof/".$findUser->first_name."_".$findUser->last_name.".zip";

        \Zipper::make($name)->add($imgArray)->close();
        return response()->download($name);
        unlink(public_path($name));
    }
}
