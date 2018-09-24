<?php

namespace App\Handler\trt\crud;
use Illuminate\Support\Facades\Input;
/***
 * lehetővé teszi a crud get taskokkal való vezérlését
 * föleg crud láncoknál hasznos
 */
Trait Task
{

 public function   Tedit(){
  $id=$this->PAR['getT'][$this->PAR['get_key'].'_id'];
  $this->edit($id); 
 }
 public function   Tcrate(){
  $this->create(); 
}
public function   Tdestroy(){
  $id=$this->PAR['getT'][$this->PAR['get_key'].'_id'];
  $this->destroy($id); 
}
public function run_task(){
 
  $task = $this->PAR['task']= Input::get('task') ?? $this->PAR['basetask']; 
 
  if ($task !=$this->PAR['basetask']) {
   //a CRUD function(alapesetben a base mindenképpen lefut ezért vissza kell állítani az alap értékeket
    $base=$this->BASE;
    $par=$this->PAR;
    if(isset($this->TPAR[$task])){$this->PAR= array_merge($this->PAR, $this->TPAR[$task]);} 
    if(isset($this->TBASE[$task])){$this->BASE= array_merge($this->BASE, $this->TBASE[$task]);} 
    if (is_callable([$this, $task])) {   return $this->$task();  } 
    $this->BASE =$base;
    $this->PAR = $par;

  }

}


}
