<?php

namespace App\Http\Controllers\Worker;
use App\Handler\MoController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;

use App\Workertime;
use App\Workertimewish;
use App\Worker;
use App\Daytype;
use App\Timetype;


class WorkertimesController extends MoController
{
    use \App\Handler\trt\crud\IndexFull;
    use \App\Handler\trt\crud\MOCrud;
    use \App\Handler\trt\view\Base;
    use \App\Handler\trt\redirect\Base;
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE propertyk hogy legyen mit kiegéaszíteni
    use \App\Handler\trt\set\Orm; // with, where, order_by

    protected $par= [
        'get_key'=>'worktime',
        'routes'=>['base'=>'worker/workertimes','worker'=>'manager/worker'],
        //'baseview'=>'workadmin.workerdays', //nem használt a view helyettesíti
        'view' => ['base' => 'crudbase', 'include' =>'worker.workertimes'], //innen csatolják be a taskok a vieweket lényegében form és tabla. A crudview-et egészítik ki
        'crudview'=>'crudbase', //A view ek keret twemplétjei. Ha tudnak majd formot és táblát generálni ez lesz a view
        'cim'=>'Munkaidők',
        'getT'=>[],  
        'show'=>['auto'], 

    ];
  
    protected $base= [
       // 'search_column'=>'daytype_id,datum,managernote,usernote',
        'get'=>['ev'=>null,'ho'=>null,'datum'=>null], //a mocontroller automatikusan feltölti a getből a $this->PAR['getT']-be
       // 'get_post'=>['ev'=>null,'ho'=>null],//a mocontroller automatikusan feltölti a getből a $this->PAR['getT']-be ha van ilyen kulcs a postban azzal felülírja
        'obname'=>'\App\Workertime',
       // 'func'=>[  'set_task', 'set_getT','set_date', 'set_redir','set_routes','set_ob'],
        'with'=>['worker','timetype'],
        'order_by'=>['datum'=>'desc'],
    ];



     protected $val= [
         'worker_id' => 'required|integer',
         'timetype_id' => 'required|integer',
         'datum' => 'required|date',
         'start' => 'required|date_format:H:i',
         'end' => 'date_format:H:i',
         'hour' => 'required|integer|max:24',
        // 'managernote' => 'string|max:200|nullable',
         'workernote' => 'string|max:200|nullable',
         'pub' => 'integer'
     ];
     public function construct_set()
     {    
        $user_id = \Auth::id();
        $this->BASE['data']['worker_id']=Worker::select('id')->where('user_id','=',$user_id)->first()->id;
        $this->BASE['where'][]= ['worker_id', '=', $this->BASE['data']['worker_id']];
    }
     public function index_set()
     {
    

     }
   
 
     public function create_set()
     {
         $this->BASE['data']['timetype']= Timetype::pluck('name','id');
 //print_r($this->PAR['getT']);
     }
 
     public function edit_set()
     {  
         $this->BASE['data']['timetype']= Timetype::pluck('name','id');
     }
 
     public function del()
     { 
         $id=Input::get('wrtime_id');
         $this->destroy($id);

     }

 
}