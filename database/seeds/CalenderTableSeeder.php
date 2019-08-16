<?php

use App\Models\Calender;
use Illuminate\Database\Seeder;

class CalenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stop_date = date('07/01/2019');
        $daaa = array();
        for($y = 1; $y <= 1828; $y++){
            
            $d = date('d-m-Y', strtotime($stop_date . ' +'.$y.' days'));
            $date1 = date('Y-m-d', strtotime($stop_date . ' +'.$y.' days'));

            $day = date('D',strtotime($stop_date . ' +'.$y.' days'));
            $month = date('m',strtotime($stop_date . ' +'.$y.' days'));
            $year = date('Y',strtotime($stop_date . ' +'.$y.' days'));
            $mon = date('F',strtotime($stop_date . ' +'.$y.' days'));

            $daaa[$y]['date'] = $d;
            $daaa[$y]['day'] = $day;
            $daaa[$y]['month'] = $month;
            $daaa[$y]['year'] = $year;
            $daaa[$y]['mon'] = $mon;
            $daaa[$y]['dates'] = $date1;
                       
        }
        
        foreach ($daaa as $dk => $dv) {
	        Calender::create([
	            'date' => $dv['date'],
	            'day' => $dv['day'],
	            'month' => $dv['month'],
	            'year' => $dv['year'],
	            'month_name' => $dv['mon'],
	        ]);
	    }
    }
}
