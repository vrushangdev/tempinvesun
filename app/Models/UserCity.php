<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCity extends Model
{
    public function leadassistant(){
        return $this->hasOne('App\Models\LeadAssistant','id','user_id');     
    }
}
