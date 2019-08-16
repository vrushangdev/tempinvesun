<?php

namespace App\Http\Controllers\Callcenter;

use App\Http\Controllers\Controller;
use App\Models\GetCallRequest;
use App\Models\User;
use Illuminate\Http\Request;

class CallRequestController extends Controller
{
    public function __construct()
    {
    	$this->middleware('callcenter');
    }

    public function getCallRequest(Request $request){

        $date = '';
        $status = '';
        $filter = 0;

        $query = User::query();

        
        if(isset($request->date) && $request->date != ''){
            $filter = 1;
            $date = $request->date;
            $query->where('date',$request->date);
        }
        
        if(isset($request->status) && $request->status != ''){
            $filter = 1;
            $status = $request->status;
            $query->where('user_status',$status);
        }   

        $query->orderBy('user_status','ASC');
        $query->with(['callRequest' => function($q) { $q->with(['attened' => function($q){ $q->with(['user','slot','lead_assistant']); }]); }]);
        $getCallRequest = $query->get();

    	return view('callcenter.callrequest.callrequest',compact('getCallRequest','date','status','filter'));
    }

}
