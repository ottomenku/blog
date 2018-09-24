<?php

namespace App\Handler\trt\set;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
/**
 * function: set_getT($request)---------------
 * bejövő adat:$BASE['get'],$BASE['get_post'] /lehet üres,nemlétező
 * ir:PAR['getT']
 * function: setTask()------------------------
 * bejövő adat:$TBASE,$TPAR /lehet üres,nemlétező
 * ir:PAR,BASE
 * létrehoz:PAR['task']
 */
Trait GetT
{

/**
 * PAR['getT'] tölti fel az url get paramétereiből, ha a BASE['get'] aqlapján (ha ninc más $parkey megadva)
 * BASE['get'] értékei az alapértelmezett értékek. Ha null és nincs más érték,nem kerül be a PAR['getT']-be
 */
function set_getT($parkey='get'){
        if(isset($this->BASE[$parkey]) && !empty($this->BASE[$parkey])){
           $this->get_to_getT($parkey);
        }
        if(isset($this->BASE['post_to_getT']) && !empty($this->BASE['post_to_getT'])){
            $this->post_to_getT();
         }
  
    }

    function get_to_getT($parkey='get'){
        //$request=$this->BASE['request'];
        //print_r($this->BASE[$parkey] );
            foreach($this->BASE[$parkey] as $key=>$val){
                $val=Input::get($key) ?? $val;
          //      echo $val.'---';
                if($val!=null){
                    $this->PAR['getT'][$key]= $val; 
                }  
            }
      
        }
        function post_to_getT(){
     
            foreach($this->BASE['post_to_getT'] as $key=>$val)
            {
                $val=$this->BASE['request']->$key ?? $val;
                if($val!=null){
                    $this->PAR['getT'][$key]= $val; 
                }  
            }
        
        }


/**
 * az url osszes get paraméterét bemásolja a PAR['getT']
 */
function set_getT_all(){
    //$this->BASE['get'] =Input::get();
    $this->PAR['getT'] =$_GET;
    }

function set_getT_frompost($parkey='post'){
    $request=$this->BASE['request'];
        foreach($this->BASE[$parkey] as $key=>$val){
            
            $val= $request->input($key, $val) ;
          //  $val=Input::get($key) ?? $val;
           
            if($val!=null){
               $this->PAR['getT'][$key]= $val; 
            }   
        }
    } 
/**
 * PAR['getT'] kulcsai elol távolítja el a controller sajtá get kulcsát,(PAR['get_key'])
 */        
function getT_honosit(){
    foreach($this->PAR['getT'] as $key=>$val){

        if(stristr($key, '_', true)==$this->PAR['get_key'])
        {
            $this->PAR['getT'][stristr($key, '_')]=$val;
        }
    }
}
}