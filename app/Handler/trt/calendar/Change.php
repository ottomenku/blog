<?php
namespace App\Handler\trt\calendar;
use Session;

use App\Workertime;
use App\Wrole;
use App\Wroletime;
use App\Worker;
use App\Workerday;


trait Change 
{

    public function wrolechange($pub=1)
    {  
        $request=$this->BASE['request'];
        $wroletimeT=Wroletime::where('wrole_id',$request->wrole_id)->get()->toarray() ;

        $worker_id=$this->BASE['data']['worker_id'];

        foreach ($request->datum as $datum) {
            Workertime::where('worker_id',$worker_id)
            ->where('datum',$datum)
            ->where('pub',$pub)
            ->delete();
            foreach ($wroletimeT as $wroletime) {
                $wroletime['datum']=$datum;
                $wroletime['worker_id']=$worker_id;
                $wroletime['pub']=$pub;
                $daytype =  Workertime::create($wroletime);                         
            }
        }
   //  return redirect(\MoHandF::url($this->PAR['routes']['base'].'/calendar/'.$id,$this->PAR['getT'])); 
    }
    
    public function daytypechange($pub=1)
    {  
        $request=$this->BASE['request'];
        $daytypedata['worker_id']=$this->BASE['data']['worker_id'];
        $daytypedata['daytype_id']=$request->daytype_id;

        foreach ($request->datum as $datum) {
            $daytypedata['datum']=$datum;
            if($pub==0){
                Workerday::where('worker_id',$this->BASE['data']['worker_id'])->where('datum',$datum)->update(['pub'=>'2']);
                
                $daytype = Workerday::firstOrCreate($daytypedata);        
                $daytype->update(['pub'=>$pub]);   
            }
            else{
                $daytype = Workerday::firstOrCreate($daytypedata);      
                //$daytype->update(['pub'=>$pub]);  //nem kell mert az alapértelmezett érték 1   
            }             
        }
    }
    
    public function daytypedel($pub=1)
    {  
        $request=$this->BASE['request'];
        foreach ($request->datum as $datum) 
        {        
            $daytype = Workerday::where(['worker_id' =>$this->BASE['data']['worker_id'],'datum' =>$datum,'pub'=>$pub]);     
            $daytype->delete(); 
        }
    }
    
    public function timeadd($pub=1)
    {  
        $request=$this->BASE['request'];
        $timeT=$request->only(['start', 'end', 'timetype_id']);
        $timeT['worker_id']=$this->BASE['data']['worker_id'];
        $timeT['note']=$request->note2;
        $timeT['pub']=$pub;
        foreach ($request->datum as $datum)
         {
            $timeT['datum']=$datum;
            $time = Workertime::create($timeT);     
        }
    }
    
    
    public function timedel($pub=1)
    { 
        $request=$this->BASE['request'];
        foreach ($request->datum as $datum) {          
            $time =  Workertime::where(['worker_id' =>$this->BASE['data']['worker_id'],'datum' =>$datum,'pub'=>$pub]);     
            $time->delete(); 
        }
    } 

}