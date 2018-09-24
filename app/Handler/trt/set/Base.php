<?php

namespace App\Handler\trt\set;
use Illuminate\Support\Facades\Input;
Trait Base
{
    public function set_base()
    {
    if(isset($this->par)){$this->PAR= array_merge($this->PAR, $this->par);}    
    if(isset($this->base)){$this->BASE= array_merge($this->BASE, $this->base);}
    if(isset($this->tbase)){$this->TBASE= array_merge($this->TBASE, $this->tbase);}
    if(isset($this->tpar)){$this->TPAR= array_merge($this->TPAR, $this->tpar);}
   // $this->PAR['task'] 
    $task=$this->PAR['task'];
    
    if(isset($this->TPAR[$task])){$this->PAR= array_merge($this->PAR, $this->TPAR[$task]);} 
    if(isset($this->TBASE[$task])){$this->BASE= array_merge($this->BASE, $this->TBASE[$task]);} 
    
   }
    
}