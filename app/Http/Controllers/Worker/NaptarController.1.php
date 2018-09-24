<?php

namespace App\Http\Controllers\Worker;
use App\Handler\MoController;
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

class NaptarController extends MoController
{
    public function index(Request $request)
    { 

        $keyword = $request->get('search');
        $perPage = 25;
        $search_columnT=$this->BASE['search_column'] ?? [];

        $ob=$this->BASE['ob']['base'] ?? $this->BASE['ob'];
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
return view($this->PAR['view'] . '.index', compact('data'));
     }
    use \App\Handler\trt\crud\MOCrud;
    use \App\Handler\trt\crud\Task; // GET-el vezérelt taskok futtatása
    use \App\Handler\trt\view\Base;
    use \App\Handler\trt\redirect\Base;
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg vagy vannak tas függő patraméterek
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE propertyk hogy legyen mit kiegéaszíteni
    use \App\Handler\trt\set\Orm; // with, where, order_by
    use \App\Handler\trt\set\GetT;
   
    //calendár------------------------------------
    use \App\Handler\trt\set\Date;  //construct_set()-el kell meghívni
    use \App\Handler\trt\get\Day; 
    use \App\Handler\trt\get\Time; 
    use \App\Handler\trt\get\Calendar;
    use \App\Handler\trt\calendar\Savecal;
    protected $par= [
       // 'create_button'=>false,
      'addbutton_label'=>'Naptár sterkesztése',
       'cancel_button'=>false,
        'calendar'=>['view'=>['days' => 'worker.naptar.days']],
        'search'=>false,
        'routes'=>['base'=>'worker/naptar'],
        //'baseview'=>'workadmin.workerdays', //nem használt a view helyettesíti
        'view' => ['base' => 'crudbase', 'include' => 'worker.naptar'], //innen csatolják be a taskok a vieweket lényegében form és tabla. A crudview-et egészítik ki
       // 'crudview'=>'crudbase_3', //A view ek keret twemplétjei. Ha tudnak majd formot és táblát generálni ez lesz a view
        'cim'=>'Naptár',
        'getT'=>[],       
    ];
    protected $tpar= [
        'index'=>['calendar'=>[
            'formopen_in_crudview'=>false,   
            'view' => ['days' => 'worker.naptar.days'],
            'checkbutton'=>false,
            'ev_ho_formopen'=>true,
            'ev_ho_form_method'=>'GET',
        ]],
        'create'=>[
            'formopen_in_crudview'=>false,
            //'cancel_button'=>True,
            'calendar'=>[
            'ev_ho_formopen'=>false,
            'view' => ['days' => 'worker.naptar.editdays'],
             'ev_ho'=>true, //ki-bekapcsolja az év hó válastó mezőt
                'checkbutton'=>true, //ki-be kapcsolja az év hó válastó mezőt
                'pdf_print'=>false, 
        ]], 
    ];
    protected $base= [
       // 'search_column'=>'daytype_id,datum,managernote,usernote',
        'get'=>['ev'=>null,'ho'=>null], //a  set_getT automatikusan fltölti a getbőll a $this->PAR['getT']-be
        'post_to_getT'=>['ev'=>null,'ho'=>null],//a set_getT automatikusan fltölti a postból a $this->PAR['getT']-be
        'obname'=>'\App\Workerday',
        'ob'=>null,
        'with'=>['worker','daytype'],
    ];

// a beállító függvények utám fut le ,előtte a base használatos de ha azt felülírjuk gondoskodni kell az eredeti futtatásáról is
public function construct_set()
{
        $user_id=\Auth::user()->id ?? 0;
        $worker=Worker::select('id','group_id')->where('user_id','=',$user_id)->first();
        $this->BASE['data']['worker_id']=$worker->id ?? 0;
        $this->BASE['data']['group_id']=$worker->group_id ?? 0;
        $this->set_date(); //calendarhoz kell \App\Handler\trt\set\Date; 

;
}
    public function index_set()
    {
    $this->BASE['data']['daytype']=Daytype::get()->pluck('name','id');
//echo  '----' .$this->BASE['data']['group_id'];
    //calendar--------------------------------------     
    $this->getMonthDays(); 
    if( $this->BASE['data']['group_id']>0){$this->getGroupday($this->BASE['data']['group_id']);}  
    $this->getWorkerday();

    if( $this->BASE['data']['group_id']>0){$this->getGrouptime($this->BASE['data']['group_id']);}  
    $this->getWorkertime();
   
  
    }
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
        return redirect(\MoHandF::url($this->PAR['routes']['base'].'/create',$this->PAR['getT'])); 
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
