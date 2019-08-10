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

    public function getCallRequest(){

    	$getCallRequest = User::orderBy('user_status','ASC')->with(['callRequest' => function($q) { $q->with(['attened' => function($q){ $q->with(['user','slot','lead_assistant']); }]); }])->get();

    	/*echo "<pre>";
    	print_r($getCallRequest->toArray());
    	exit;*/
    	
    	return view('callcenter.callrequest.callrequest',compact('getCallRequest'));
    }



	public function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
	    $sort_col = array();
	    foreach ($arr as $key=> $row) {
	        $sort_col[$key] = $row[$col];
	    }

	    array_multisort($sort_col, $dir, $arr);
	}


	
}
