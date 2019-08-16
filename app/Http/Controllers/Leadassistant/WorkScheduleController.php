<?php

namespace App\Http\Controllers\Leadassistant;

use App\Http\Controllers\Controller;
use App\Models\AssignedLeadAssistant;
use App\Models\Calender;
use App\Models\User;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkScheduleController extends Controller
{
    public function __construct()
    {
    	$this->middleware('lead_assistant');
    }

    public function workSchedule(){

        $weekNumber = date("W");

        $year = date("Y");

    	$getWeekDates = $this->getWeekDates($weekNumber,$year);

        $weekCounter = $this->weekCounter();

    	$morningDate = array();
    	$noonDate = array();
    	$eveningDate = array();

    	if(count($getWeekDates) > 0){
    		foreach($getWeekDates as $k => $v){
    			$findMorningDate = WorkSchedule::where('lead_assistant_id',Auth::guard('lead_assistant')->user()->id)->where('date',$v['date'])->where('type',0)->where('is_selected',1)->first();
    			if(!is_null($findMorningDate)){
    				$morningDate[] = $v['date'];
    			}

    			$findNoonDate = WorkSchedule::where('lead_assistant_id',Auth::guard('lead_assistant')->user()->id)->where('date',$v['date'])->where('type',1)->where('is_selected',1)->first();
    			if(!is_null($findNoonDate)){
    				$noonDate[] = $v['date'];
    			}

    			$findEveningDate = WorkSchedule::where('lead_assistant_id',Auth::guard('lead_assistant')->user()->id)->where('date',$v['date'])->where('type',2)->where('is_selected',1)->first();
    			if(!is_null($findEveningDate)){
    				$eveningDate[] = $v['date'];
    			}
    		}
    	}

    	return view('lead_assistant.schedule.schedule',compact('getWeekDates','morningDate','noonDate','eveningDate','weekNumber','year','weekCounter'));
    }

    public function saveWorkSchedule(Request $request){

    	$data = $request->all();

        $id = Auth::guard('lead_assistant')->user()->id;

    	$getWeekDates = $this->getWeekDates($request->week,$request->year);


    	
    	if(count($data) > 0){
    		foreach($data['data'] as $dk => $dv){
    			if(isset($dv['date']) && count($dv['date']) > 0){
    				foreach ($dv['date'] as $ck => $cv) {

                        $dateDelete = explode('-',$cv['date']);
                        $dateDelete = implode('/',$dateDelete);
                        $getDetails = AssignedLeadAssistant::where('lead_assistant_id',$id)->where('date',$dateDelete)->get();
                        if(!is_null($getDetails)){
                            foreach($getDetails as $gk => $gv){
                                $updateUserStatus = User::where('id',$gv->user_id)->update(['user_status' => 2]);
                            }
                        }
                        $delete = AssignedLeadAssistant::where('lead_assistant_id',$id)->where('date',$dateDelete)->where('time_slot_id',$dk)->delete();

                        $deleteDate = WorkSchedule::where('date',$cv['date'])->where('type',$dk)->where('lead_assistant_id',$id)->delete();
                        
    					$date = Calender::where('date',$cv['date'])->first();
    					$addDate = new WorkSchedule;
    					$addDate->lead_assistant_id = Auth::guard('lead_assistant')->user()->id;
                        $addDate->week_number = $data['week'];
                        $addDate->week_year = $data['year'];
    					$addDate->cal_id = $date->id;
    					$addDate->date = $cv['date'];
    					$addDate->type = $dk;
    					$addDate->is_selected = 1;
    					$addDate->save();
    				}
    			}
    		}
    	}

    	return redirect(route('lead_assistant.workSchedule'))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Lead Assistant',
                  'message' => 'Lead Assistant\'s Schedule Updated!',
              ],
        ]); 
    }

    public function getWeekDates($weekNumber,$year){

        $dates = date('d-m-Y', strtotime($year.'W'.str_pad($weekNumber, 2, 0, STR_PAD_LEFT)));

		$weekDate = array();

		for($i = 0;$i < 7;$i++){
			$weekDate[$i]['date'] = date('d-m-Y',strtotime($dates." + ".$i." day"));
			$weekDate[$i]['day'] = date('l',strtotime($dates." + ".$i." day"));
		}

		return $weekDate;
    }

    public function weekCounter(){

        $weekNumber = date("W");

        $year = date('Y');

        $weekCounter = array();

        for($i = $weekNumber; $i <= 52; $i++){

            $start_date = date('d-m-Y', strtotime($year.'W'.str_pad($i, 2, 0, STR_PAD_LEFT)));
            $end_date = date('d-m-Y', strtotime($start_date."+ 6 days"));

            $weekCounter[$i]['week'] = $i;
            $weekCounter[$i]['string'] = $i." (".$start_date." - ".$end_date.")";
        }

        return $weekCounter;
    }

    public function getStartAndEndDate($week, $year){

        $dates = date('d-m-Y', strtotime($year.'W'.str_pad($week, 2, 0, STR_PAD_LEFT)));

        return $dates;
    }


    public function getNextScheduleData(Request $request){

        $week = $request->week;

        $year = date('Y');

        $scheduleData = $this->getStartAndEndDate($week,$year);

        $getWeekDates = array();

        for($i = 0;$i < 7;$i++){
            $getWeekDates[$i]['date'] = date('d-m-Y',strtotime($scheduleData." + ".$i." day"));
            $getWeekDates[$i]['day'] = date('l',strtotime($scheduleData." + ".$i." day"));
        }

        $morningDate = array();
        $noonDate = array();
        $eveningDate = array();

        if(count($getWeekDates) > 0){
            foreach($getWeekDates as $k => $v){
                $findMorningDate = WorkSchedule::where('lead_assistant_id',Auth::guard('lead_assistant')->user()->id)->where('date',$v['date'])->where('type',0)->where('is_selected',1)->first();
                if(!is_null($findMorningDate)){
                    $morningDate[] = $v['date'];
                }

                $findNoonDate = WorkSchedule::where('lead_assistant_id',Auth::guard('lead_assistant')->user()->id)->where('date',$v['date'])->where('type',1)->where('is_selected',1)->first();
                if(!is_null($findNoonDate)){
                    $noonDate[] = $v['date'];
                }

                $findEveningDate = WorkSchedule::where('lead_assistant_id',Auth::guard('lead_assistant')->user()->id)->where('date',$v['date'])->where('type',2)->where('is_selected',1)->first();
                if(!is_null($findEveningDate)){
                    $eveningDate[] = $v['date'];
                }
            }
        }

        return view('lead_assistant.schedule.ajax_schedule',compact('getWeekDates','morningDate','noonDate','eveningDate','week','year'));
    }
}
