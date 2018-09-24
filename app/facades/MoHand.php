<?php
namespace App\facades; 
use Illuminate\Support\Facades\Facade; 
class MoHand  extends Facade 
{ 
    protected static function getFacadeAccessor() 
    { 
        return \App\Handler\MoHand ::class;
    } 
}