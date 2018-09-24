<?php

namespace App\Handler\trt;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

Trait Show
{
public function image($data,$param=[])
{
 $title=$param['title'] ?? $data; 
 $class=$param['class'] ?? 'imgclass';   
return '<img src="/'.$data.'" title="'.$data.'" class="'.$class.'">';
}
public function data($paramRow,$data=[])
{ 
$colname=$paramRow['colname'] ?? 'colname';
$data=$data[$colname] ?? 'nodata';
//$data='hhh';
if(isset($paramRow['func'])){
    $func=$paramRow['func'];
    if(is_callable([$this, $func])) {$data=$this->$func($data,$paramRow=[],$dataRow=[]);}  
}
return $data;
}

public function label($paramRow,$data=[])
{ 
    $label=$paramRow['label'] ?? 'label';
    if(isset($paramRow['labelfunc'])){
        if(is_callable([$this, $paramRow['labelfunc']])) {$label=$this->$paramRow['labelfunc']($label,$paramRow=[],$data=[]);}  
    }
    return $label;
}

}








