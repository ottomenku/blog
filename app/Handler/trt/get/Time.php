<?php

namespace App\Handler\trt\get;
//use Illuminate\Support\Facades\Input;
Trait Time
{

    public function getWorkertime()
    {
        $res=[];
        $worker_id=$this->BASE['data']['worker_id'];
        $ev=$this->BASE['data']['ev'];
        $ho=$this->BASE['data']['ho'];

        $datum1=$ev.'-'.$ho.'-01';
        $datum2=\Carbon::create($ev,$ho, 1, 0)->endOfMonth();

            $wrtimes= [];
            $wrtimes= \App\Workertime::where('worker_id','=',$worker_id)
            ->whereBetween('datum', [$datum1,$datum2])
            ->get()->toarray() ?? $wrtimes ; 
         //   print_r($wrtimes);
        foreach($wrtimes as $time) 
        {
            $this->BASE['data']['calendar'][$time['datum']]['times'][]=$time; 
        }  

    }

    public function getGrouptime($groupid)
    {
        $res=[];
        $ev=$this->BASE['data']['ev'];
        $ho=$this->BASE['data']['ho'];

        $datum1=$ev.'-'.$ho.'-01';
        $datum2=\Carbon::create($ev,$ho, 1, 0)->endOfMonth();

            $wrtimes= [];
            $wrtimes= \App\Grouptime::where('group_id','=',$groupid)
            ->whereBetween('datum', [$datum1,$datum2])
            ->get()->toarray() ?? $wrtimes ; 
         //   print_r($wrtimes);
        foreach($wrtimes as $time) 
        {
            $this->BASE['data']['calendar'][$time['datum']]['times'][]=$time; 
        }  

    }

}