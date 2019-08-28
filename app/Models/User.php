<?php

namespace App\Models;

use App\Notifications\ConsumerResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function generateToken($headers){
        $randToken = $this->randomString(16);
        $usertoken = new UserToken;
        $usertoken->device_token = $randToken;
        $usertoken->device_type = $headers['device-type'];
        if(isset($headers['fcm-token']) && $headers['fcm-token'] != ''){
            $usertoken->fcm_token = $headers['fcm-token'];
        }
        $usertoken->version = $headers['version'];
        $usertoken->save();
        if($usertoken){
            return $randToken;
        } else {
            return false;
        }
    }

    public function randomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ConsumerResetPasswordNotification($token));
    }

    public function assigned_lead(){
        return $this->hasOne('App\Models\AssignedLeadAssistant','user_id','id');
    } 

    public function callRequest(){
        return $this->hasOne('App\Models\GetCallRequest','user_id','id');  
    }

    public function cityname(){
        return $this->hasOne('App\Models\City','id','city');
    }

    public function countryname(){
        return $this->hasOne('App\Models\Country','id','country');
    }
   

}
