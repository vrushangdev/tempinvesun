<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserToken;
use App\Models\Vendor;
use Auth;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GlobalController extends Controller
{   
    public function __construct(){

    }

    public function uploadImage($image,$path){
        $imagedata = $image;
        $destinationPath = 'uploads/'.$path; 
        $extension = $imagedata->getClientOriginalExtension(); 
        $fileName = rand(11111,99999).'.'.$extension;
        $imagedata->move($destinationPath, $fileName);
        return $fileName;
    }

    public function updateAppToken($headers,$id){
        
        $randToken = $this->randomStringGenerater(32);
        
        $usertoken = UserToken::where('device_token',$headers['device-token'])
                              ->update(['app_token' => $randToken,'user_id' => $id]);

        if($usertoken){
            return $randToken;
        } else {
            return false;
        }
    }

    public function randomStringGenerater($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getUserIdApplication($userToken){
        $updateToken = UserToken::where('app_token',$userToken)->first();
        if($updateToken){
            return $updateToken->user_id;        
        } else {
            return false;
        }
    }

    public function sendMail($templete,$mail_message,$sub,$email = null){
        
        $maildata = array('bodymessage' => $mail_message);

        Mail::send('mail.'.$templete, $maildata, function($msg) use ($email,$sub) {
            $msg->to($email, 'Site Admin');
            $msg->subject($sub);
         }); 
    }

    public function updateUserAppToken($headers,$user_id){

        $randToken = $this->randomStringGenerater(32);
        $usertoken = UserToken::where('device_token',$headers['device-token'])
                              ->update(['app_token' => $randToken,'user_id' => $user_id]);
        if($usertoken){
            return $randToken;
        } else {
            return false;
        }
    }


}
