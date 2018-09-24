<?php

namespace App\Http\Controllers\Workadmin;
use App\Handler\MoController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
////use App\Day;
use App\Daytype;
use App\Worker;
use App\Workerday;
use ottomenku\controllerM;

class WorkerdaysController extends controllerM
{
    use \App\Handler\trt\crud\IndexFull;
    use \App\Handler\trt\crud\MOCrud;
    use \App\Handler\trt\view\Base;
    use \App\Handler\trt\redirect\Base;
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE propertyk hogy legyen mit kiegéaszíteni
    use \App\Handler\trt\set\Orm; // with, where, order_by
    use \App\Handler\trt\set\GetT;
    use \App\Handler\trt\crud\Task;

    protected $par = [
        //'baseroute'=>'workadmin/workerdays',
        'routes' => ['base' => 'workadmin/workerdays', 'worker' => 'manager/worker'],
        //'baseview'=>'workadmin.workerdays', //nem használt a view helyettesíti
        'view' => ['base' => 'crudbase', 'include' => 'workadmin.workerdays',
        'editform' => 'workadmin.workerdays.edit'
        ,'pub' => 'crudbase.index','unpub' => 'crudbase.index'], //innen csatolják be a taskok a vieweket lényegében form és tabla. A crudview-et egészítik ki
        'cim' => 'Dolgozói napok',
       // 'getT' => ['w_id' => 0],
        'pubval' => 2,
        'show' => ['auto' ],
    ];

    protected $base = [
        'search_column' => 'daytype_id,datum,managernote,usernote',
        'get'=>['ev'=>null,'ho'=>null,'worker_id'=>null], //a mocontroller automatikusan feltölti a getből a $this->PAR['getT']-be
        // 'get_post'=>[],//a mocontroller automatikusan feltölti a getből a $this->PAR['getT']-be ha van ilyen kulcs a postban azzal felülírja
        'obname' => '\App\Workerday',
        'ob' => null,
        'orm' => [
            'with' => ['worker', 'daytype'],
            'order_by' => ['id' => 'desc'],
        ],
        'show' => ['auto' ],
    ];

    protected $val = [
        'worker_id' => 'required|integer',
        'daytype_id' => 'integer',
       // 'wish_id' => 'integer',
        'pub' => 'integer|max:2',
        'datum' => 'date',
        'managernote' => 'string|max:150',
        //  'usernote' => 'string|max:150'
    ];
    protected $val_update = [
        'managernote' => 'string|max:150',
        //  'usernote' => 'string|max:150'
    ];

    public function construct_set()
    {
          //  $user_id=\Auth::user()->id ?? 0;
          //  $worker=Worker::select('id')->where('user_id','=',$user_id)->first();
            $this->BASE['data']['worker_id']=$this->PAR['getT']['worker_id']?? 0;
           if($this->BASE['data']['worker_id']>0){
             $this->BASE['data']['orm']['where'][]=['worker_id'.'=', $this->BASE['data']['worker_id']];
           }
           
    }
    public function create_set()
    {
        $this->BASE['data']['workers'] =Worker::get()->pluck('name','id');  
        $this->BASE['data']['daytype'] =Daytype::get()->pluck('name','id');  
    }
    public function edit_set()
    {
        $this->BASE['data']['daytype'] =Daytype::get()->pluck('name','id');  
    }
    public function store_set_data(){}


 
   // public function create(){}
      //  public function store(){}    
  //      public function edit($id){}
    //    public function update($id,Request $request){}   
    //    public function show($id){} 
    //    public function destroy($id){}            
     
   

}
