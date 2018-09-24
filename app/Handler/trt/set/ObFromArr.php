<?php

namespace App\Handler\trt\set;

Trait ObFromArr
{
    function set_ob(){

        if(isset($this->BASE['obname']) ){
            $obnameT=explode(',',$this->BASE['obname']);
           
            foreach($obnameT as $key=>$obname)
            {
               if(!is_string($key)){$key=end(explode('\\'.$obname));}
              $this->BASE['ob'][$key]=new $obname();   
            }
        }
      
    }
}