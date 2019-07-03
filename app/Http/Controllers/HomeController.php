<?php

namespace App\Http\Controllers;

use App\Models\EnergyDataSet;
use App\Models\GetCallRequest;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function saveGetCallRequest(Request $request){

        $user = new User;
        $user->first_name = $request->name;
        $user->mobile = $request->mobile;
        $user->save();

        $energy = new EnergyDataSet;
        $energy->user_id = $user->id;
        $energy->plant_size = $request->plant_size;
        $energy->monthly_energy_saving = $request->monthly_energy_saving;
        $energy->save();

        $getRequest = new GetCallRequest;
        $getRequest->user_id = $user->id;
        $getRequest->save();

        return redirect()->back()->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Request',
                  'message' => 'Your request successfully submitted. Our customer executive contact you shortly!',
              ],
        ]);
    }

    public function checkUserEmail(Request $request){

        $query = User::query();
        $query->where('email',$request->email);
        if(isset($request->user_id) && $request->user_id != ''){
            $query->where('id','!=',$request->user_id);
        }
        $getUser = $query->first();

        if(!is_null($getUser)){
            return 'false';
        } else {
            return 'true';
        }
    }

    public function checkUserMobile(Request $request){

        $query = User::query();
        $query->where('mobile',$request->mobile);
        if(isset($request->user_id) && $request->user_id != ''){
            $query->where('id','!=',$request->user_id);
        }
        $getUser = $query->first();

        if(!is_null($getUser)){
            return 'false';
        } else {
            return 'true';
        }
    }
}
