<?php

namespace App\Http\Controllers\Manager;

use App\Handler\MoController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use App\Daytype; //!átírni-kibővíteni!!!!!!!!!!!

class DaytypesController extends MoController
{
    use \App\Handler\trt\show;
    use \App\Handler\trt\crud\IndexFull;
    use \App\Handler\trt\crud\MOCrud;
    use \App\Handler\trt\redirect\Base;
    use \App\Handler\trt\view\Base;
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE propertyk hogy legyen mit kiegéaszíteni
   
    protected $par = [
        'routes' => ['base' => 'manager/daytypes'],
        'view' => ['base' => 'crudbase', 'include' => 'manager.daytypes'], //lehet tömb is pl view/base traitel.
        'cim' => 'Naptípusok', //a templétben megjelenő cím
        'show'=>['auto'],
    ];
    protected $base = [
        'obname' => 'App\Daytype', //lehet tömb is ha ha a setobArray trait-et  hívjuk be],
 
    ];
    protected $val = [
        'name' => 'required|string|min:5|max:50',
        'szorzo' => 'between:0,4|nullable',
        'fixplusz' => 'integer|nullable',
        'color' => 'string|nullable|max:50',
        'note' => 'string|nullable|max:150', 
        'workday' => 'bool',
    ];

}
