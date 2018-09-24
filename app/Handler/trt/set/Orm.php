<?php
namespace App\Handler\trt\set;
trait Orm{

public function set_orm(){
$ob=$this->BASE['ob']  ;
        $with=$this->BASE['orm']['with'] ?? '';
        if ($with!='') {$ob= $ob->with($with); }
        $where=$this->BASE['orm']['where'] ?? '';
        if ($where!='') {$ob= $ob->where($where);} 
      
         $orwhereT=$this->BASE['orm']['orwhere'] ?? [];
        
           foreach ($orwhereT as $orwhere) {
            $ob= $ob->orWhere([$orwhere]);
         }
        
        $order_by=$this->BASE['orm']['order_by'] ?? [];  
        foreach ($order_by as $column => $direction) {
           $ob= $ob->orderBy($column, $direction);
        }
        return $ob;
    }

}

