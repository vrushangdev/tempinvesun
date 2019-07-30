<?php

namespace App\Http\Controllers;

use App\Models\EnergyDataSet;
use App\Models\GetCallRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    
    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
    
    public function index(Request $request)
    {   
        $shared = '';
        $shared_id = '';

        if(count($request)){
            $shared = $request->shared;
            $shared_id = $request->sharing_id;
        }

        return view('front.home.index',compact('shared','shared_id'));
    }

    public function saveGetCallRequest(Request $request){

        $user = new User;
        $user->form_name = $request->name;
        $user->mobile = $request->mobile;
        if($request->shared_id != '' && $request->shared != ''){
            $user->signup_sharing_by = $request->shared;
            $user->signup_sharing = $request->shared_id;
        }
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

    public function getCityName(Request $request){

        $url = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDbX_JirTlqgj9BO002nMah8CQSD7f4ypI&address=" . $request->zip . "&sensor=true";

        $address_info = file_get_contents($url);
        $json = json_decode($address_info);
        // echo "<pre>";
        // print_r($json);
        // exit;
        $city = "";
        $state = "";
        $country = "";
        if (count($json->results) > 0) {
            //break up the components
            $arrComponents = $json->results[0]->address_components;

            foreach($arrComponents as $index=>$component) {
               
                $type = $component->types[0];

                if ($city == "" && ($type == "sublocality_level_1" || $type == "locality") ) {
                    $city = trim($component->short_name);
                }
                if ($state == "" && $type=="administrative_area_level_1" || $type=="administrative_area_level_2") {
                    $state = trim($component->short_name);
                }
                if ($country == "" && $type=="country") {
                    $country = trim($component->short_name);
                }
                if ($city != "" && $state != "" && $country != "") {
                    //we're done
                    break;
                }
            }
        }

        $arrReturn = array("city"=>$city, "state"=>$state, "country"=>$country);

        return $arrReturn;
    }

}
