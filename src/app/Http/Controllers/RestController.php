<?php

namespace App\Http\Controllers;

use App\Models\workingtime;
use App\Models\breaktime;
use Illuminate\Http\Request;

class RestController extends Controller
{
    public function startRest()
    {
        $att_record = workingtime::where('user_id', auth()->id())->
                                     where('work_on', date('Y-m-j'))->
                                     first();
        
        if(isset($att_record) && is_null($att_record->closing_at)){
            $rest_record = breaktime::where('user_id', auth()->id())->
                                      where('break_on', date('Y-m-j'))->
                                      latest('id')->first();
            if(is_null($rest_record) || isset($rest_record->breakover_at)){
                $rec = array('user_id'=>auth()->id(), 
                             'break_on'=>date('Y-m-j'), 
                             'break_at'=>date('H:i:s'));
                breaktime::create($rec);
            };
        };
        return redirect('');
    }

    public function endRest()
    {
        $att_record = workingtime::where('user_id', auth()->id())->
                                     where('work_on', date('Y-m-j'))->
                                     first();
        
        if(isset($att_record) && is_null($att_record->closing_at)){
            $rest_record = breaktime::where('user_id', auth()->id())->
                                      where('break_on', date('Y-m-j'))->
                                      latest('id')->first();
            if(isset($rest_record) || is_null($rest_record->breakover_at)){
                $rec = array('breakover_at'=>date('H:i:s'));
                breaktime::find($rest_record->id)->update($rec);
            };
        };
        return redirect('');
    }
}
