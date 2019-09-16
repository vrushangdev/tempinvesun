<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use App\Models\AssignedLeadAssistant;
use App\Models\LeadAssistant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetailerController extends Controller
{
    public function __construct()
    {
    	$this->middleware('retailer');
    }

    public function index(){

    	$total_user = User::count();

    	return view('retailer.dashboard.dashboard',compact('total_user'));
    }

    public function getMyLeads(){

        $getLeadAssistant = LeadAssistant::where('retailer_id',Auth::guard('retailer')->user()->id)->pluck('sharing_id');
        $getLeadAssistant[] = Auth::guard('retailer')->user()->sharing_id;
        $findMyLeads = User::whereIn('signup_sharing',$getLeadAssistant)->with(['lead'])->get();

        $LeadAssistantData = array();

        if(!is_null($findMyLeads)){
            foreach($findMyLeads as $fk => $fv){

                $checkLeadAssign = AssignedLeadAssistant::where('user_id',$fv->id)->with(['lead_assistant'])->first();

                $LeadAssistantData[$fk]['id'] = $fv->id;
                $LeadAssistantData[$fk]['name'] = $fv->form_name;
                $LeadAssistantData[$fk]['mobile'] = $fv->mobile;
                $leadby = '';
                if(!is_null($fv->lead)){
                    $leadby = $fv->lead->name;
                } else {
                    $leadby = 'SELF';
                }
                $assign = '';
                if(isset($checkLeadAssign->lead_assistant) && !is_null($checkLeadAssign->lead_assistant)){
                    $assign = $checkLeadAssign->lead_assistant->name;
                } else {
                    $assign = '-------';
                }
                $LeadAssistantData[$fk]['assignd'] = $assign;
                $LeadAssistantData[$fk]['lead_by'] = $leadby;
                $LeadAssistantData[$fk]['status'] = $fv->email ? 'Attended' : 'Pending';
            }
        }

        return view('retailer.dashboard.my_leads',compact('LeadAssistantData'));
    }

    public function getRetailerLeadAssistant(Request $request){

        $findLindAssistant = LeadAssistant::where('retailer_id',Auth::guard('retailer')->user()->id)->get();

        $getAssignList = AssignedLeadAssistant::where('user_id',$request->user_id)->first();

        return view('retailer.dashboard.lead_assistant_list',compact('findLindAssistant','getAssignList'));
    }

    public function saveLeadAssistantSchedule(Request $request){
       
        $assign = new AssignedLeadAssistant;
        $assign->lead_assistant_id = $request->lead_assistant;
        $assign->time_slot_id = 0;
        $assign->user_id = $request->id;
        $assign->date = $request->appointment_date;
        $assign->save();

        return redirect(route('retailer.getMyLeads'))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Password',
                  'message' => 'Leadassistant assigned!',
              ],
        ]); 

    }
}
