<?php

namespace App\Http\Controllers;

use App\Models\AssignedLeadAssistant;
use App\Models\City;
use App\Models\Country;
use App\Models\UserPreview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsumerController extends Controller
{
    public function __construct(){

    	$this->middleware('auth',['except' => ['checkLogin']]);
    }

    public function checkLogin(Request $request){

        $checkUser = User::where('mobile',$request->mobile)->where('otp',$request->otp)->first();

        if(!is_null($checkUser)){

            Auth::login($checkUser);

            return 'true';

        } else {

            return 'false';
        }
    }

    public function index(){

    	$getId = Auth::user()->id;

    	$getLeadRequest = AssignedLeadAssistant::where('user_id',$getId)
                                               ->with(['user','slot','userpropasal','lead_assistant'])->first();
		
		$getCity = City::where('id',Auth::user()->city)->first();

		$getCountry = Country::where('id',Auth::user()->country)->first();                                               

		$getUserPreview = UserPreview::where('user_id',$getId)->first();                                               

    	return view('consumer.dashboard.dashboard',compact('getLeadRequest','getUserPreview','getCity','getCountry'));	
    }
}
