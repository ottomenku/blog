<?php
namespace App\Handler\trt\calendar;
use Session;
use App\Workertime;
use App\Wrole;
use App\Wroletime;
use App\Worker;
use App\Workerday;

trait Savecal 
{
 
    public function get_savecal_data($worker_id)
    {  
        $group_id=Worker::findOrFail($worker_id)->group_id;

        //$this->BASE['data']['calendar'] beállítáaa
        $this->getMonthDays(); 
        //$this->BASE['data']['calendar'] módosítása worker és group day adatokkal
        if( $group_id>0){$this->getGroupday($group_id);}  
        $this->getWorkerday();
        //$this->BASE['data']['calendar'] módosítása worker és group time adatokkal
        if( $group_id>0){$this->getGrouptime($group_id);}  
        $this->getWorkertime();
     
    }
    public function store_savecal()
    {  
        $savecal= \App\Savecal::create($this->BASE['data']);
        $id = $savecal->id;
        foreach ($this->BASE['data']['calendar']  as $datum =>$calendar) {
            $calendar['savecal_id'] =$id; 
            $savecalday=\App\SavecalDay::create($calendar); 
         
            if(isset($calendar['times']) && is_array($calendar['times'])){
                foreach ($calendar['times'] as  $time) {
                    $time['savecal_day_id'] = $savecalday->id; 
                    \App\SavecalDayTime::create($time);
                }
            }  
        }
    }
    public function update_store_savecal()
    {  
        $savecal= \App\Savecal::firstOrNew(['worker_id'=>$this->BASE['data']['worker_id'],'ev'=>$this->BASE['data']['ev'],'ho'=>$this->BASE['data']['ho']]);
        $id = $savecal->id;  
        $savecal->save($this->BASE['data']);

        foreach ($this->BASE['data']['calendar']  as $datum =>$calendar) {
           $calendar['savecal_id'] =$id; 
         //  echo $id.'----------'; exit();
            $savecalday=\App\SavecalDay::firstOrNew(['savecal_id'=>11,'daytype_id'=>$calendar['daytype_id'],'datum'=>$datum]); 
            $savecalday->save($calendar); 
            
            if(isset($calendar['times']) && is_array($calendar['times'])){
                \App\SavecalDayTime::whereIn('savecal_day_id', [$savecalday->id])->delete();
                foreach ($calendar['times'] as  $time) {
                    $time['savecal_day_id'] = $savecalday->id; 
                    \App\SavecalDayTime::create($time);
                }
            }  
        }
    }

}