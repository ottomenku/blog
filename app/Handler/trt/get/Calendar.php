<?php
namespace App\Handler\trt\get;
//use App\Http\Requests;
//use App\Workeruser;
//use App\Facades\MoView;
use Session;
use Carbon\Carbon;

trait Calendar 
{

public function getMonthDays()
{
    $calendar=new \App\Handler\Calendar;
    $this->BASE['data']['calendar']=$calendar->getMonthDays($this->BASE['data']['ev'],$this->BASE['data']['ho']); 
}
}