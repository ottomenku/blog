<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Handler\MoController;
use Illuminate\Http\Request;
use Session;
use App\Worker;
use App\User;
use App\Wrole;
use App\Timeframe;
use App\Workertimeframe;
use App\Status;
use App\Workertype;
use App\Group;


class WorkersController extends MoController
{
    use \App\Handler\trt\crud\IndexFull;
    use \App\Handler\trt\crud\MOCrud;
    use \App\Handler\trt\view\Base;
    use \App\Handler\trt\redirect\Base;
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE propertyk hogy legyen mit kiegéaszíteni
    use \App\Handler\trt\set\Orm; // with, where, order_by
    use \App\Handler\trt\Image;
    use  \App\Handler\trt\Show; // show task. par['show'] és  par[''controllername']  kell neki
    use \App\Handler\trt\set\GetT;
    protected $par= [
        'controllername'=>'Manager\WorkersController',
        // 'baseroute'=>'manager/wroletimes', // a routes-be kerüt (base)
        'get_key'=>'worker', //láncnál ezzel az előtaggal azonosítja a rávonatkozó get tagokat
        'routes'=>['base'=>'manager/workers'], //A _GET ben ['get_key']._ret ben érkező értéket fordítja le routra pl.: wrtime_ret=wru esetén a route  manager/wroleunit lesz
        'view'=>[
            'base' => 'crudbase',
            'include' =>'manager.workers',
            'editform' => 'manager.workers.edit_form',
            'modaltable' =>'manager.workers.workerlist'
        ], //innen csatolják be a taskok a vieweket lényegében form és tabla. A crudview-et egészítik ki
     
        'cim'=>'Dolgozók',
        'getT'=>[],  
        'show'=>[
            ['colname'=>'id','label'=>'Id'],
            ['colname'=>'fullname','label'=>'név'],
            ['colname'=>'foto','label'=>'Foto','func'=>'image'],
            ['colname'=>'cim','label'=>'Cím'],
            ['colname'=>'birth','label'=>'Születési dátum'],
            ['colname'=>'tel','label'=>'Telefon'],
            ['colname'=>'ado','label'=>'Adószám'],
            ['colname'=>'tb','label'=>'TBszám'],
            ['colname'=>'start','label'=>'Kezdés'],
           ]
        // 'search'=>false,         
     ];
     protected $base= [    
       // 'get'=>['user_id'=>null,'view'=>null,'group_id'=>null,'addroute'=>null], //Ha a wrolunitból hvjuk a wruvissza true lesz, a store az update és a delete visszaírányít az aktuális wroleunitra.mocontroller automatikusan feltölti a getből a $this->PAR['getT']-be
        'obname'=>'\App\Worker',
        'with'=>['user','timeframe'],
        'search_column' => [ 'wrole_id', 'status_id','workertype_id', 'workergroup_id',  'salary', 'salary_type','foto', 'fullname',
        'cim', 'LIKE','tel', 'LIKE', 'birth', 'ado',
        'LIKE',  'tb', 'start', 'end', 'note','pub'],
        'orm'=>[
          'with'=>['user']  
        ],
        'image'=>[
            'inputmezo'=>'foto'
        ]

     ];

    protected $val= [
    'user_id' => 'required|integer',    
    'fullname' => 'required|max:200',
    'cim' => 'required|max:200',
    'tel' => 'max:50|nullable',
    'birth' => 'required|date',
    'ado' => 'string|max:50|nullable',
    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'tb' => 'string|max:50|nullable',
    'start' => 'required|date',
    'end' => 'date|nullable',
    'note' => 'string|nullable',
    'pub' => 'integer'
];

public function index_set()
    {
      //  print_r($this->BASE['data']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create_set()
    {     
       $this->BASE['data']['user']=User::get()->pluck('name','id');
       // $this->BASE['data']['wrole']=Wrole::get()->pluck('name','id');
       $this->BASE['data']['base_timeframe']=Timeframe::get(['id','name'])->toarray();
       $this->BASE['data']['checked_timeframe']=[1];
      
       $this->BASE['data']['status']=Status::get()->pluck('name','id');
       $this->BASE['data']['workertype']=Workertype::get()->pluck('name','id');
       $this->BASE['data']['group']=Group::get()->pluck('name','id');
    }
    public function store_set_data()
    { 
        $this->validate($this->BASE['request'],[
        'user_id' => 'unique:workers,user_id']);
    } 
  public function store_set()
    {
       // $worker_id=$this->BASE['ob']->id;
        $this->BASE['ob']->timeframes()->attach($this->BASE['request']->timeframe_id);
     /*   foreach ($this->BASE['request']->timeframe_id as $tf) {
            Workertimeframe::create(['worker_id'=>$worker_id,'timeframe_id'=>$tf]);
        }*/
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit_set()
    {
        /*  $data['wrole']=Wrole::get()->pluck('name','id');*/      
        $data['base_timeframe']=Timeframe::get(['id','name'])->toarray();
        $checked =[];
        foreach($this->BASE['data']->timeframes as $item){    
            $checked[] =  $item->id;
        }
        $this->BASE['data']['checked_timeframe']=$checked;
        $this->BASE['data']['userT']=User::get()->pluck('name','id');
        $this->BASE['data']['base_timeframe']=Timeframe::get(['id','name'])->toarray();
        $this->BASE['data']['status']=Status::get()->pluck('name','id');
        $this->BASE['data']['workertype']=Workertype::get()->pluck('name','id');
        $this->BASE['data']['group']=Group::get()->pluck('name','id');
      
    }
    public function update_set_data()
    { 
        $this->validate($this->BASE['request'],[
        'user_id' => 'unique:workers,user_id,'.$this->BASE['data']['id']]);
    }
    public function update_set()
    {
       // $worker_id=$this->BASE['ob']->id;
        $this->BASE['ob']->timeframes()->sync($this->BASE['request']->timeframe_id);
     /*   foreach ($this->BASE['request']->timeframe_id as $tf) {
            Workertimeframe::create(['worker_id'=>$worker_id,'timeframe_id'=>$tf]);
        }*/
    }
    public function destroy_set()
    {
       // $worker_id=$this->BASE['ob']->id;
  
        $this->BASE['ob']->timeframes()->detach($this->BASE['request']->timeframe_id);
     /*   foreach ($this->BASE['request']->timeframe_id as $tf) {
            Workertimeframe::create(['worker_id'=>$worker_id,'timeframe_id'=>$tf]);
        }*/
    }
}
