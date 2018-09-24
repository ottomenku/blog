<?php

namespace App\Http\Controllers\Manager;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Handler\MoController;
use Illuminate\Http\Request;
use Session;

use App\Status;

class StatusesController extends MoController
{
    use \App\Handler\trt\crud\IndexFull;
    use \App\Handler\trt\crud\MOCrud;
    use \App\Handler\trt\view\Base;
    use \App\Handler\trt\redirect\Base;
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE propertyk hogy legyen mit kiegéaszíteni
  //  use \App\Handler\trt\set\Orm; // with, where, order_by
    
  protected $par= [
    'routes'=>['base'=>'manager/statuses'],
    'view'=> ['base' => 'crudbase', 'include' => 'Manager.statuses'], //innen csatolják be a taskok a vieweket lényegében form és tabla. A crudview-et egészítik ki
    'cim'=>'Statuszok', 
    'show'=>['auto'],// a show file generálja a megjelenítést
  //  'show'=>[['colname'=>'id','label'=>'Id']]
];

protected $base= [
'obname'=>'\App\Status',

];

protected $val =[
    'name' => 'string|required|max:200',
    'note' => 'string|max:200|nullable',
    'pub' => 'integer|max:4'
];


}
