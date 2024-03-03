<?php

namespace App\Http\Controllers;

use App\Models\workingtime;
use App\Models\breaktime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function getIndex()
    {
        $att_record = workingtime::where('user_id', auth()->id())->
                                   where('work_on', date('Y-m-j'))->
                                   first();
        $rest_record = breaktime::where('user_id', auth()->id())->
                                  where('break_on', date('Y-m-j'))->
                                  latest('id')->first();
        $status_att = array('name' => auth()->user()->name,
                            'att_start' => false,
                            'att_over' => false,
                            'break_start' => false,
                            'break_over' => false);

        if(is_null($att_record)){$status_att['att_start'] = true;};
        if( (isset($att_record) && is_null($att_record->closing_at)) ){
            if(is_null($rest_record) || isset($rest_record->breakover_at)){
                $status_att['att_over'] = true;
                $status_att['break_start'] = true;
            };
        };
        if( (isset($att_record) && is_null($att_record->closing_at)) ){
            if(isset($rest_record) && is_null($rest_record->breakover_at)){
                $status_att['break_over'] = true;
            };
        };

        return view('index',$status_att);
    }

    public function getLogin()
    {
        if(!(is_null(Auth::user()))){
            return redirect('/attendance/');
        };
        return view('login');
    }

    public function startAttendance()
    {
        $att_record = workingtime::where('user_id', auth()->id())->
                                   where('work_on', date('Y-m-j'))->
                                   first();
        if(is_null($att_record)){
            $rec = array('user_id'=>auth()->id(), 
                         'work_on'=>date('Y-m-j'), 
                         'working_at'=>date('H:i:s'));
            workingtime::create($rec);
        };
        return redirect('');
    }

    public function endAttendance()
    {
        $att_record = workingtime::where('user_id', auth()->id())->
                                   where('work_on', date('Y-m-j'))->
                                   first();
        if(isset($att_record)){
            $rest_record = breaktime::where('user_id', auth()->id())->
                                      where('break_on', date('Y-m-j'))->
                                      latest('id')->first();
            if(is_null($rest_record) || isset($rest_record->breakover_at)){
                $rec = array('closing_at'=>date('H:i:s'));
                workingtime::find($att_record->id)->update($rec);
            };
        };
        return redirect('');
    }

    public function getAttendance($date = null, Request $request = null)
    {
        //$currentDate = $request->input('date');
        $currentDate = $date;

        if(is_null($currentDate)){
            $DateB = date("Y-m-d", strtotime("-1 day"));
            $Date = date("Y-m-d");
            $DateN = date("Y-m-d", strtotime("1 day"));
        }else{
            $customY = intval(substr($currentDate, 0, 4));
            $customM = intval(substr($currentDate, 5, 2));
            $customD = intval(substr($currentDate, 8, 2));
            $DateB = date("Y-m-d", mktime(0,0,0,$customM,$customD-1,$customY));
            $Date = date("Y-m-d", mktime(0,0,0,$customM,$customD,$customY));
            $DateN = date("Y-m-d", mktime(0,0,0,$customM,$customD+1,$customY));
        };
        //$att_records = workingtime::where('work_on', $Date)->paginate(5);
        $att_records = user::paginate(5);
        foreach($att_records as $att_record){
            $att_record['working_at'] = '00:00:00';
            $att_record['closing_at'] = '00:00:00';
            $att_record['break_time'] = '';
            $att_record['work_time'] = '';
        };

        //始業・終業時間の取得
        foreach($att_records as $att_record){
            $worktime_record = workingtime::where('work_on', $Date)->where('user_id', $att_record->id)->first();
            if(isset($worktime_record->working_at)){
                $att_record->working_at = $worktime_record->working_at;
                $att_record->closing_at =  $worktime_record->closing_at;
            }
        };

        //就業時間・休憩時間の取得計算
        foreach($att_records as $att_record){
            $break_records = breaktime::where('user_id', $att_record->user_id)->where('break_on', $Date)->get();

            $work_time = (strtotime($Date . $att_record->closing_at) - strtotime($Date . $att_record->working_at));
            $sum_break_time = 0;
            foreach($break_records as $break_record){
                $sum_break_time = $sum_break_time + 
                                  (strtotime($Date . $break_record->breakover_at) - strtotime($Date . $break_record->break_at));
            };

            $work_time = $work_time - $sum_break_time;

            $breakH = floor($sum_break_time / 3600);
            $breakM = ($sum_break_time / 60) % 60;
            $breakS = ($sum_break_time % 60) % 60 ;
            if($breakH <= 9){$breakH = "0" . $breakH;};
            if($breakM <= 9){$breakM = "0" . $breakM;};
            if($breakS <= 9){$breakS = "0" . $breakS;};
            $att_record->break_time = $breakH . ":" . $breakM . ":" . $breakS;

            $workH = floor($work_time / 3600);
            $workM = ($work_time / 60) % 60;
            $workS = ($work_time % 60) % 60;
            if($workH <= 9){$workH = "0" . $workH;};
            if($workM <= 9){$workM = "0" . $workM;};
            if($workS <= 9){$workS = "0" . $workS;};
            $att_record->work_time = $workH . ":" . $workM . ":" . $workS;
        };



        //$break_records = breaktime::all();
        //$break_time = "00:00:00";

        /*foreach($break_records as $break_record){
            $break_time = $break_time + $break_record->break_at;
        }*/

        //$att_records = workingtime::paginate(5);
        //$att_records = workingtime::all();
        return view('attendance/index', ['att_records' => $att_records, 'DateB' => $DateB, 'Date' => $Date, 'DateN' => $DateN]);
        //return view('attendance/index');
    }

    public function getAchievement()
    {
        //$currentDate = $request->input('date');
        //$currentDate = $date;
        $loginuser_id = Auth::id();

        //$att_records = workingtime::where('work_on', $Date)->paginate(5);
        $user_record = user::where('id', $loginuser_id)->first();
        $user_name = $user_record->name;
        $att_records = workingtime::where('user_id', $loginuser_id)->orderBy('work_on', 'desc')->paginate(5);

        //就業時間・休憩時間の取得計算
        foreach($att_records as $att_record){
            $break_records = breaktime::where('user_id', $loginuser_id)->where('break_on', $att_record->work_on)->get();

            $work_time = (strtotime($att_record->work_on . $att_record->closing_at) - strtotime($att_record->work_on . $att_record->working_at));
            $sum_break_time = 0;
            foreach($break_records as $break_record){
                $sum_break_time = $sum_break_time + 
                                  (strtotime($att_record->work_on . $break_record->breakover_at) - strtotime($att_record->work_on . $break_record->break_at));
            };

            $work_time = $work_time - $sum_break_time;

            $breakH = floor($sum_break_time / 3600);
            $breakM = ($sum_break_time / 60) % 60;
            $breakS = ($sum_break_time % 60) % 60 ;
            if($breakH <= 9){$breakH = "0" . $breakH;};
            if($breakM <= 9){$breakM = "0" . $breakM;};
            if($breakS <= 9){$breakS = "0" . $breakS;};
            $att_record->break_time = $breakH . ":" . $breakM . ":" . $breakS;

            $workH = floor($work_time / 3600);
            $workM = ($work_time / 60) % 60;
            $workS = ($work_time % 60) % 60;
            if($workH <= 9){$workH = "0" . $workH;};
            if($workM <= 9){$workM = "0" . $workM;};
            if($workS <= 9){$workS = "0" . $workS;};
            $att_record->work_time = $workH . ":" . $workM . ":" . $workS;
        };

        return view('attendance/myachievement/index', ['user_name' => $user_name,'att_records' => $att_records]);
    }

}