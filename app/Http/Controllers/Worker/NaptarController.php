<?php

namespace App\Http\Controllers\Worker;
use App\Http\Controllers\Controller;
//use App\Handler\MoController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;

use App\Workertime;
use App\Worker;
use App\Workerday;
use App\Timetype;
use App\Daytype;
use App\Day;

class NaptarController extends Controller
{ 
    use \App\Handler\trt\set\Date;  //construct_set()-el kell meghívni 
    //calendár------------------------------------
 /*  
    use \App\Handler\trt\get\Day; 
    use \App\Handler\trt\get\Time; 
    use \App\Handler\trt\get\Calendar;
    use \App\Handler\trt\calendar\Savecal;
 */   
    protected $PAR= [

        'routes'=>['base'=>'worker/naptar'],
        'cim'=>'Dolgozói Naptár', // TODO:többnyelvűsíteni!
           
        'viewtask'=>
        [
            'index'=>
            [
                'cim'=>'Naptár',
                'calendar'=>[
                'checkbutton'=>false,
                'ev_ho_formopen'=>true,
                'ev_ho_form_method'=>'GET',
                ]
            ],
        /*   'create'=>[], */
        ]

     ];

     protected $BASE= [
        // 'search_column'=>'daytype_id,datum,managernote,usernote',
         'get'=>['ev'=>null,'ho'=>null], //a  set_getT automatikusan fltölti a getbőll a $this->PAR['getT']-be
         'post_to_getT'=>['ev'=>null,'ho'=>null],//a set_getT automatikusan fltölti a postból a $this->PAR['getT']-be
        
             'index'=>
             [
            
             ],
     
     ];
     protected $DATA= [];
     public function __construct()
     {
             $user_id=\Auth::user()->id ?? 0;
             $worker=Worker::select('id')->where('user_id','=',$user_id)->first();
             $this->BASE['data']['worker_id']=$worker->id ?? 0;
             $this->PAR['template']=config('app.template') ?? '';
             $this->set_date(); //calendarhoz kell \App\Handler\trt\set\Date; 
     
     }

    public function moRoute($func,$id)
     { 
        if($id=='00'){$this->$func();}
        else{$this->$func($id);}
     }
     public function moView()
     {// crudbase.base
        $data=$this->DATA;
        $viewParam=$this->PAR;
        $task=$this->BASE['task'] ?? 'index';
        $viewtask=$this->BASE[$task]['viewtask']  ?? 'index';
        $path=$this->PAR['crudbase'] ?? $this->PAR['viewtask'][$viewtask]['crudbase'] ?? 'crudbase.base';
        return view($this->PAR['template'].'.'.$path, compact('data','viewParam')); 
     }
     public function getData($orm=[])
     { 
         //calendar--------------------------------------     
       /*  $this->getMonthDays(); 
         $this->getWorkerday();    
         $this->getWorkertime();
         $userid=\Auth::id();
         //echo 
         $data=Worker::where('user_id','=',$userid)->first()->toarray();
         $data['daytype']=Daytype::get()->pluck('name','id');
       */ 
        return [];
    }


     public function index(Request $request)
     { 
        $data=$this->getData();
        $data=$this->moView(); 
     }
 
    
 
 
     public function create()
     {   
         
        $data=$this->getData();
        $data=$this->moView(); 
     }
  
     public function edit($id)
     {   
        $this->BASE['id']=$id;
        $data=$this->getData();
        $data=$this->moView(); 
     }

  

// a beállító függvények utám fut le ,előtte a BASE használatos de ha azt felülírjuk gondoskodni kell az eredeti futtatásáról is


  
    public function create_set()
    {

        $this->BASE['data']['daytype']=Daytype::get()->pluck('name','id');
        $this->BASE['data']['timetype']=Timetype::get()->pluck('name','id');
        $this->BASE['data']['daytype']['0']='nincs változtatás';
       // print_r( $this->BASE['data']['daytype']);
    //calendar-------------------------------------- 
    
    $this->getMonthDays(); 
    if( $this->BASE['data']['group_id']>0){$this->getGroupday($this->BASE['data']['group_id']);}  
    $this->getWorkerday();
    
    if( $this->BASE['data']['group_id']>0){$this->getGrouptime($this->BASE['data']['group_id']);}  
    $this->getWorkertime();  
  
    }
    public function store(Request $request)
    {  
      
        if(isset($this->val)){
           $this->validate($request,$this->val );  
        }

        switch ($request->change) {
            case 'del' :
                if($request->has('daytask')){$this->daytypedel($request);}
                if($request->has('timetask')){ $this->timedel($request);  }
                break; 
            case 'day_wrole':
                if( $request->daytype_id!=0 ){ $this->daytypechange($request);}
           
            case 'time' :
                if( !empty($request->start) && !empty($request->end))
            {    $this->timeadd($request); }

            case 'create_save' :
            //SavecalsController@get_savecal_data($worker_id)
             case 'update_save' :
               // echo "i equals 2";       
        }

       // if($request->has('del'))
      
        session(['datum' => $request->datum]);
        return redirect(\MoHandF::url($this->PAR['routes']['BASE'].'/create',$this->PAR['getT'])); 
    }

  
    public function daytypechange(Request $request)
    {  
        $daytypedata=[
            'daytype_id'=>$request->daytype_id,
            'workernote'=>$request->workernote,
        ];
        $daytypedata['worker_id']=$this->BASE['data']['worker_id'];

        foreach ($request->datum as $datum) {
            $daytypedata['datum']=$datum;
                $daytype = Workerday::firstOrCreate(['worker_id' =>$daytypedata['worker_id'],'datum' =>$datum,'pub' =>1]);        
               // echo 'mmm'.$daytype->id; exit();
                $daytype->update($daytypedata);     
        }
    }

  public function daytypedel(Request $request)
    {  
        foreach ($request->datum as $datum) 
        {        
            $daytype = Workerday::where(['worker_id' =>$this->BASE['data']['worker_id'],'datum' =>$datum,'pub' =>1]);     
            $daytype->delete(); 
        }
    }

    public function timeadd(Request $request)
    {  
        $timeT=$request->only(['start', 'end', 'timetype_id']);
        $timeT['worker_id']=$this->BASE['data']['worker_id'];
        $timeT['workernote']=$request->workernote2;

        foreach ($request->datum as $datum)
         {
            $timeT['datum']=$datum;
            $time = Workertime::create($timeT);     
        }
    }


    public function timedel(Request $request)
    {  
        foreach ($request->datum as $datum) {          
            $time = Workerday::where(['worker_id' =>$this->BASE['data']['worker_id'],'datum' =>$datum,'pub' =>1]);     
            $time->delete(); 
        }
    }   

}
