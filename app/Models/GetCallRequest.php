<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GetCallRequest extends Model
{
    public function user(){
    	return $this->hasOne('App\Models\User','id','user_id');
    }

    public function attened(){
    	return $this->hasOne('App\Models\AssignedLeadAssistant','user_id','user_id');
    }
}
