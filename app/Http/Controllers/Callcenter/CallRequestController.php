<?php

namespace App\Http\Controllers\Callcenter;

use App\Http\Controllers\Controller;
use App\Models\GetCallRequest;
use Illuminate\Http\Request;

class CallRequestController extends Controller
{
    public function __construct()
    {
    	$this->middleware('callcenter');
    }

    public function getCallRequest(){

    	$getCallRequest = GetCallRequest::with(['user','attened' => function($q){ $q->with(['user','slot','lead_assistant']); }])->get();

    	
    	return view('callcenter.callrequest.callrequest',compact('getCallRequest'));
    }
}
