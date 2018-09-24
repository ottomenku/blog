<?php

namespace App\Http\Controllers\Manager;
use App\Handler\MoController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;

use App\Timetype;


class TimetypesController extends MoController
{
    use \App\Handler\trt\crud\IndexFull;
    use \App\Handler\trt\crud\MOCrud;
    use \App\Handler\trt\view\Base;
    use \App\Handler\trt\redirect\Base;
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE propertyk hogy legyen mit kiegéaszíteni
    use \App\Handler\trt\set\Orm; // with, where, order_by


    protected $par = [
        'routes' => ['base' => 'manager/timetypes'],
        'view' => ['base' => 'crudbase', 'include' => 'manager.timetypes'], //innen csatolják be a taskok a vieweket lényegében form és tabla. A crudview-et egészítik ki
        'cim' => 'Munkaidőtipusok',
        'show' => ['auto'], // a show file generálja a megjelenítést
        //  'show'=>[['colname'=>'id','label'=>'Id']]
    ];

    protected $base = [
        'obname' => '\App\Timetype',
    ];



    protected $val =  [
        'name' => 'required|string|min:5|max:50',
        'szorzo' => 'between:0,99.99|nullable',
        'fixplusz' => 'integer|nullable',
        'color' => 'string|nullable|max:50',
        'note' => 'string|nullable|max:150'
    ];


 
}
