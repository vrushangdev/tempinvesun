<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
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

        $findMyLeads = User::where('signup_sharing',Auth::guard('retailer')->user()->sharing_id)->where('signup_sharing_by','retailer')->get();

        return view('retailer.dashboard.my_leads',compact('findMyLeads'));
    }
}
