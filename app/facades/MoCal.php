<?php
namespace App\facades; 
use Illuminate\Support\Facades\Facade; 
class MoCal  extends Facade 
{ 
    protected static function getFacadeAccessor() 
    { 
        return \App\Handler\MoCal ::class;
    } 
}