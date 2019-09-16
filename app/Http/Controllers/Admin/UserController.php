<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\GlobalController;
use App\Models\Admin;
use App\Models\CallCenterAgent;
use App\Models\City;
use App\Models\LeadAssistant;
use App\Models\Retailer;
use App\Models\Role;
use App\Models\TechPartner;
use App\Models\User;
use App\Models\UserCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends GlobalController
{
   	public function __construct()
   	{
   		$this->middleware('admin');
   	}

   	public function userList(Request $request){

   		$filter = 0;
   		$filter_role_id = 0;
   		$userList = array();

   		$roleList = Role::orderBy('role')->get();

      

   		if(isset($request->filter_role_id) && $request->filter_role_id != ''){
            $filter = 1;
   			$filter_role_id = $request->filter_role_id;
	   		if($request->filter_role_id == 1){
	   			$query = Admin::query();
	   		} elseif($request->filter_role_id == 2){
	   			$query = CallCenterAgent::query();
	   		} elseif($request->filter_role_id == 3){
	   			$query = LeadAssistant::query();
	   		} elseif($request->filter_role_id == 4){
	   			$query = TechPartner::query();
	   		} elseif($request->filter_role_id == 5){
          $query = Retailer::query();
        }
	   		$userList = $query->get();
	   	}

   		return view('admin.user.user_list',compact('roleList','filter','filter_role_id','userList'));
   	}

   	public function addUser(){

   		$roleList = Role::orderBy('role')->get();

      $cityList = City::all();

      $retailerList = Retailer::where('is_active',1)->where('is_delete',0)->get();

   		return view('admin.user.add_user',compact('roleList','cityList','retailerList'));
   	}

   	public function saveUser(Request $request){

   		$request->validate([
   			'name' => 'required|string|max:255',
          	'email' => 'required|string|email|max:255|unique:users',
          	'password' => 'required|string|min:6',
   		]);

   		if($request->role_id == 1){
   			$user = new Admin;
   		} elseif($request->role_id == 2){
   			$user = new CallCenterAgent;
   		} elseif($request->role_id == 3){
   			$user = new LeadAssistant;
   		} elseif($request->role_id == 4){
   			$user = new TechPartner;
   		} elseif($request->role_id == 5){
        $user = new Retailer;
      }
      
      $user->role_id = $request->role_id;
   		$user->name = $request->name;
   		$user->occupation = $request->occupation;
   		$user->email = $request->email;
   		$user->password = Hash::make($request->password);
   		$user->mobile = $request->mobile;
      $user->sharing_id = $this->randomStringGenerater(32);
      if($request->reatiler_id != ''){
        $user->is_linked_retailer = 1;
        $user->retailer_id = $request->reatiler_id;
      }
   		$user->save();

      if(isset($request->city) && count($request->city) > 0){
          foreach($request->city as $ck => $cv){
              $usercity = new UserCity;
              $usercity->user_id = $user->id;
              $usercity->city_id = $cv;
              $usercity->save();
          }
      }

      $mail_message = '';
      $mail_message .= "Hello ".$request->name.",<br><br>";
      $mail_message .= "Here is your username and password.<br><br>";
      $mail_message .= "Username : ".$request->email."<br>";
      $mail_message .= "password : ".$request->password."<br>";

      $subject = "Welcome to Invesun";
      
      $this->sendMail('new_registration',$mail_message,$subject,$request->email);



   		return redirect(route('userList'))->with('messages', [
              [
                  'type' => 'success', 
                  'title' => 'User',
                  'message' => 'User Successfully added.',
              ],
        ]);

   	}

   	public function editUser($role_id,$id){

   		$roleList = Role::where('role','!=','Admin')->orderBy('role')->get();

   		if($role_id == 1){
   			$query = Admin::query();
   		} elseif($role_id == 2){
   			$query = CallCenterAgent::query();
   		} elseif($role_id == 3){
   			$query = LeadAssistant::query();
   		} elseif($role_id == 4){
   			$query = TechPartner::query();
   		} elseif($role_id == 5){
            $query = Retailer::query();
        }
   		$query->where('id',$id);
        if($role_id == 3){
            $query->with(['usercity']);
        }
   		$userDetail = $query->first();

        $cityId = array();

        if(count($userDetail->usercity)){
            foreach($userDetail->usercity as $uk => $uv){
                $cityId[] = $uv->city_id;
            }
        }

        $cityList = City::all();

        $retailerList = Retailer::where('is_active',1)->where('is_delete',0)->get();

   		return view('admin.user.edit_user',compact('userDetail','roleList','cityList','cityId','retailerList'));
   	}

   	public function saveEditedUser(Request $request){

   		$request->validate([
   			'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
   		]);


        if($request->role == 1){
            $user = Admin::findOrFail($request->id);
        } elseif($request->role == 2){
            $user = CallCenterAgent::findOrFail($request->id);
        } elseif($request->role == 3){
            $user = LeadAssistant::findOrFail($request->id);
        } elseif($request->role == 4){
            $user = TechPartner::findOrFail($request->id);
        } elseif($request->role == 4){
            $user = Retailer::findOrFail($request->id);
        }

        $user->role_id = $request->role;
        $user->name = $request->name;
        $user->occupation = $request->occupation;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        if($request->reatiler_id != ''){
          $user->is_linked_retailer = 1;
          $user->retailer_id = $request->reatiler_id;
        } else {
          $user->is_linked_retailer = 0;
          $user->retailer_id = '';
        }
        $user->save();

        if(isset($request->city) && count($request->city) > 0){
            $deleteUserCity = UserCity::where('user_id',$request->id)->delete();
            foreach($request->city as $ck => $cv){
                $usercity = new UserCity;
                $usercity->user_id = $request->id;
                $usercity->city_id = $cv;
                $usercity->save();
            }
        }

   		return redirect(route('userList'))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'User',
                  'message' => 'User Successfully Updated.',
              ],
        ]);
   	}

   	public function deleteUser($role_id,$id){

   		if($role_id == 1){
            $query = Admin::where('id',$id)->delete();
        } elseif($role_id == 2){
            $query = CallCenterAgent::where('id',$id)->delete();
        } elseif($role_id == 3){
            $query = LeadAssistant::where('id',$id)->delete();
        } elseif($role_id == 4){
            $query = TechPartner::where('id',$id)->delete();
        }

    	if($query){

    		return redirect(route('userList'))->with('messages', [
                [
	                'type' => 'success',
	                'title' => 'User',
	                'message' => 'User Successfully Deleted.',
                ],
        	]); 	
    	}
   	}

    public function checkEmail(Request $request){

        if($request->role_id == 1){
            $query = Admin::query();
        } elseif($request->role_id == 2){
            $query = CallCenterAgent::query();
        } elseif($request->role_id == 3){
            $query = LeadAssistant::query();
        } elseif($request->role_id == 4){
            $query = TechPartner::query();
        }

        $query->where('email',$request->email);
        if(isset($request->user_id) && $request->user_id != ''){
            $query->where('id','!=',$request->user_id);            
        }

        $getUserEmail = $query->first();

        if(!is_null($getUserEmail)){
            return 'false';
        } else {
            return 'true';
        }   
    }

    public function checkMobileNumber(Request $request){

        if($request->role_id == 1){
            $query = Admin::query();
        } elseif($request->role_id == 2){
            $query = CallCenterAgent::query();
        } elseif($request->role_id == 3){
            $query = LeadAssistant::query();
        } elseif($request->role_id == 4){
            $query = TechPartner::query();
        }

        $query->where('mobile',$request->mobile);
        if(isset($request->user_id) && $request->user_id != ''){
            $query->where('id','!=',$request->user_id);            
        }

        $getMobile = $query->first();

        if(!is_null($getMobile)){
            return 'false';
        } else {
            return 'true';
        }   
    }
}
