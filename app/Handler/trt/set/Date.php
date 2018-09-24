<?php

namespace App\Handler\trt\set;
use Carbon\Carbon;
//use Illuminate\Support\Facades\Input;
Trait Date
{
/**
 * Ha van a getT-ben datum akkor az alapján állítja be a DATA ev,ho,nap,datum értékét
 * ha nincs datum akkor a getT ev ,ho,nap alapján. ha az sincs akkor az aktuális dátum alapján
 */
public function set_date(){

    $t = Carbon::now();
    $this->BASE['data']['carbon']=$t;
    if(isset($this->PAR['getT']['datum']))
    {
        $this->BASE['data']['ev'] = substr($this->PAR['getT']['datum'], 0, 4);
        $this->BASE['data']['ho']= substr($this->PAR['getT']['datum'], 4, 2);
        $this->BASE['data']['nap']= substr($this->PAR['getT']['datum'], 6, 2);
        if($this->BASE['data']['ev']=='xxxx'){$this->BASE['data']['ev']=$t->year;}
        if($this->BASE['data']['ho']=='xx'){$this->BASE['data']['ho']=$t->mounth;}
        if($this->BASE['data']['nap']=='xx'){$this->BASE['data']['nap']=$t->day;}
    
    }
    else{
      
    $this->BASE['data']['ev']=$this->PAR['getT']['ev'] ?? $t->year;
    $this->BASE['data']['ho']=$this->PAR['getT']['ho'] ?? $t->month;
    $this->BASE['data']['het']=$this->PAR['getT']['het'] ?? $t->weekOfYear;
    $this->BASE['data']['nap']=$this->PAR['getT']['nap'] ?? $t->day;  
    
        //print_r($this->PAR['getT']);

}
  
    if(strlen($this->BASE['data']['ho'])<2){
        $this->BASE['data']['ho']='0'.$this->BASE['data']['ho'];
    }
    if(strlen($this->BASE['data']['het'])<2){
        $this->BASE['data']['het']='0'.$this->BASE['data']['het'];
    }  if(strlen($this->BASE['data']['ho'])<2){
        $this->BASE['data']['ho']='0'.$this->BASE['data']['ho'];
    }
    if(strlen($this->BASE['data']['nap'])<2){
        $this->BASE['data']['nap']='0'.$this->BASE['data']['nap'];
    }
    $this->BASE['data']['datum']= $this->BASE['data']['ev'].'-'.$this->BASE['data']['ho'].'-'.$this->BASE['data']['nap'];
 
    
}
    
}