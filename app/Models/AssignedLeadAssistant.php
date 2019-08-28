<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedLeadAssistant extends Model
{	
	public function lead_assistant(){
    	return $this->hasOne('App\Models\LeadAssistant','id','lead_assistant_id');
    }

    public function user(){
    	return $this->hasOne('App\Models\User','id','user_id');
    }

    public function slot(){
    	return $this->hasOne('App\Models\TimeSlot','id','time_slot_id');
    }

    public function userpropasal(){
    	return $this->hasOne('App\Models\UserProposal','user_id','user_id');
    }
}
