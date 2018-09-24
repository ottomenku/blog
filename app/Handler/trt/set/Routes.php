<?php

namespace App\Handler\trt\set;

Trait Routes
{

function set_routes(){
   
   foreach($this->PAR['routes'] as $key=>$rout){
     $routvalT=[];    
     preg_match_all("/\{(\w*)\}/", $rout, $routvalT);
     if(isset($routvalT[1])){
        foreach($routvalT[1] as $routval){ 
            
             if(isset($this->PAR['getT'][$routval]))
             {
                 $rout= str_replace('{'.$routval.'}',$this->PAR['getT'][$routval],$rout);
             }
         }   
     }
   $this->PAR['routes'][$key]=$rout;
 
   }
}}