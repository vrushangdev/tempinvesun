<?php

namespace App\Http\Controllers\Leadassistant;

use App\Http\Controllers\Controller;
use App\Models\AssignedLeadAssistant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
