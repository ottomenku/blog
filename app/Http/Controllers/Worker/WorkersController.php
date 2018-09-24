<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;

use App\Worker;
use App\User;
use App\Wrole;
use App\Timeframe;
use App\Status;
use App\Workertype;
use App\Workergroup;


class WorkersController extends Controller
{


    protected $par= [
        // 'baseroute'=>'manager/wroletimes', // a routes-be kerüt (base)
        'get_key'=>'wworker', //láncnál ezzel az előtaggal azonosítja a rávonatkozó get tagokat
        'routes'=>['base'=>'worker/workers'], //A _GET ben ['get_key']._ret ben érkező értéket fordítja le routra pl.: wrtime_ret=wru esetén a route  manager/wroleunit lesz
         'view'=>'crudbase_3.show', //innen csatolják be a taskok a vieweket lényegében form és tabla. A crudview-et egészítik ki
         'crudview'=>'crudbase_3', //A view ek keret twemplétjei. Ha tudnak majd formot és táblát generálni ez lesz a view
         'cim'=>'Személyes adatok',
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



public function index(Request $request)
    {
        $userid=\Auth::id();
        //echo 
        $data=Worker::where('user_id','=',$userid)->first()->toarray();
        $data=[];  
        $keyword = $request->get('search');
        $perPage = 25;
        $search_columnT=$this->BASE['search_column'] ?? [];

        $ob=$this->BASE['ob']['base'] ?? $this->BASE['ob'];
       // $ob= new $this->BASE['obname']();
        if (!empty($keyword)) {
            $ob = $ob->where('id', '<', "1");
            foreach($search_columnT as $col)
            {
                $ob=$ob->orwhere('name', 'LIKE', "%$keyword%");
            }
			$data['list']=$ob->paginate($perPage);
        } else {
            $data['list'] = $ob->paginate($perPage);
        }
        $param=$this->par;
        return view($this->par['view'], compact('data','param')); 
    }



}
