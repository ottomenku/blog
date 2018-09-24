<?php

namespace App\Http\Controllers\Manager;

use App\Daytype;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Handler\MoController;
use Illuminate\Http\Request;
use Session;

class DaysController extends MoController
{
    use \App\Handler\trt\crud\IndexFull;
    use \App\Handler\trt\crud\MOCrud;
    use \App\Handler\trt\view\Base;
    use \App\Handler\trt\redirect\Base;
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE propertyk hogy legyen mit kiegéaszíteni
    use \App\Handler\trt\set\Orm; // with, where, order_by
    //use \App\Handler\trt\set\GetT;
    protected $par = [
        'routes' => ['base' => 'manager/days'],
        'view' => ['base' => 'crudbase', 'include' => 'manager.days'], //lehet tömb is pl view/base traitel.
        'search' => false, // ha false kikapcsolja az index táblázat kereső mezőjét
        'cim'=>'Ünnepnapok',
    ];

    protected $base = [
        'obname'=>'App\Day',
        'orm'=>['with'=>'daytype'],
      //  'get'=>['ev'=>null,'ho'=>null,],

    ];
    protected $val = [
        // 'worker_id' => 'required|integer',
        'daytype_id' => 'integer',
        'datum' => ['required', 'unique:days', 'regex:/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/'],
        'note' => 'string|max:150',
        // 'usernote' => 'string|max:150'
    ];
    protected $val_update = [
        // 'worker_id' => 'required|integer',
        'daytype_id' => 'integer',
        'datum' => ['required','regex:/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/'],
        'note' => 'string|max:150',
        // 'usernote' => 'string|max:150'
    ];
    public function construct_set()
    {
       // $this->PAR['id']=$request->route('id') ;//day id
        $t = \Carbon::now();
        $this->PAR['getT']['ev']=Input::get('ev') ?? $t->year; 
        $this->PAR['getT']['ho']=Input::get('ho') ?? $t->month; 
      if($this->PAR['getT']['ev']=='all'){}
        elseif($this->PAR['getT']['ev']=='0000'){ $this->BASE['orm']['where']=[ ['datum', 'like','0000%']];}
       else{ $this->BASE['orm']['where']= [['datum', 'like', $this->PAR['getT']['ev'].'%']];}
     
    }
    public function index_set()
    {
        $this->BASE['data']['years']=['all','0000','2017','2018','2019'];
    }

    public function create_set()
    {
        $this->BASE['data']['daytype'] = Daytype::pluck('name', 'id');
    }
    public function edit_set()
    {
        $this->BASE['data']['daytype'] = Daytype::pluck('name', 'id');
    }
}
