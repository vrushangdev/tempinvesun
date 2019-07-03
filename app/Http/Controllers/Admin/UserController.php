<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\GlobalController;
use App\Models\CallCenterAgent;
use App\Models\LeadAssistant;
use App\Models\Role;
use App\Models\TechPartner;
use App\Models\User;
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
	   		}
	   		$userList = $query->get();
	   	}

   		return view('admin.user.user_list',compact('roleList','filter','filter_role_id','userList'));
   	}

   	public function addUser(){

   		$roleList = Role::orderBy('role')->get();

   		return view('admin.user.add_user',compact('roleList'));
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
   		}
      
      $user->role_id = $request->role_id;
   		$user->name = $request->name;
   		$user->occupation = $request->occupation;
   		$user->email = $request->email;
   		$user->password = Hash::make($request->password);
   		$user->mobile = $request->mobile;
   		$user->save();

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
   			$query = new Admin;
   		} elseif($role_id == 2){
   			$query = new CallCenterAgent;
   		} elseif($role_id == 3){
   			$query = new LeadAssistant;
   		} elseif($role_id == 4){
   			$query = new TechPartner;
   		}
   		$query->where('id',$id);
   		$userDetail = $query->first();

   		return view('admin.user.edit_user',compact('userDetail','roleList'));
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
        }
        $user->role_id = $request->role;
        $user->name = $request->name;
        $user->occupation = $request->occupation;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->save();

   		return redirect(route('userList'))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'User',
                  'message' => 'User Successfully Updated.',
              ],
        ]);
   	}

   	public function deleteUser($id){

   		if($id == 1){
            $query = Admin::where('id',$id)->delete();
        } elseif($id == 2){
            $query = CallCenterAgent::where('id',$id)->delete();
        } elseif($id == 3){
            $query = LeadAssistant::where('id',$id)->delete();
        } elseif($id == 4){
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
