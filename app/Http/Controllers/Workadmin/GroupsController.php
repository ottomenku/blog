<?php
namespace App\Http\Controllers\Workadmin;
use App\Handler\MoController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use App\Group;
use App\Wrole;
use App\Wroletime;
use App\Worker;
use App\Grouptime;
use App\Groupday;
use App\Timetype;
use App\Daytype;
use App\Day;
use App\Workertime;
class GroupsController extends MoController
{ 
    use \App\Handler\trt\crud\IndexFull;
    use \App\Handler\trt\crud\MOCrud;
    use \App\Handler\trt\crud\Task; // GET-el vezérelt taskok futtatása
    use \App\Handler\trt\view\Base;
    use \App\Handler\trt\redirect\Base;
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE propertyk hogy legyen mit kiegéaszíteni
    use \App\Handler\trt\set\Orm; // with, where, order_by
    use \App\Handler\trt\set\GetT;
    //calendár------------------------------------
    use \App\Handler\trt\set\Date; //construct_set()-el kell meghívni
    use \App\Handler\trt\get\Day; 
    use \App\Handler\trt\get\Time; 
    use \App\Handler\trt\get\Calendar;


    protected $par = [
        'cancel_button' => false,
        'routes' => ['base' => 'workadmin/groups'],
        'view' => ['base' => 'crudbase', 'include' => 'workadmin.groups','show2' => 'crudbase.show','calendar' => 'crudbase.index',
         'showcontent' => 'workadmin.groups.show2', 'workermodal' => 'workadmin.groups.workermodal'], //innen csatolják be a taskok a vieweket lényegében form és tabla. A crudview-et egészítik ki
        'cim' => 'Múszakok',
      //  'show' => ['auto'], // a show file generálja a megjelenítést
        //  'show'=>[['colname'=>'id','label'=>'Id']]
    ];
    protected $tpar= [
        'calendar'=>[
            'create_button' => false, 
            'formopen_in_crudview'=>false,
            'view' => ['base' => 'crudbase', 'include' => 'workadmin.groups','show2' => 'crudbase.show','calendar' => 'crudbase.index',
            'showcontent' => 'workadmin.groups.show2', 'workermodal' => 'workadmin.groups.workermodal','table'=>'workadmin.groups.calendar'],
         // 'view'=>['table'=>'workadmin.groups.calendar'],
            'calendar'=>[
            'ev_ho_formopen'=>false,
            'view' => ['days' => 'worker.naptar.editdays'],
             'ev_ho'=>true, //ki-bekapcsolja az év hó válastó mezőt
                'checkbutton'=>true, //ki-be kapcsolja az év hó válastó mezőt
                'pdf_print'=>false, 
        ]], 
    ];



    protected $base = [
        'obname' => '\App\Group',
        'get'=>['group_id'=>null],
        'post_to_getT'=>['ev'=>null,'ho'=>null],//a set_getT automatikusan fltölti a postból a $this->PAR['getT']-be
        'orm'=>[ 'with'=>['worker']],
    ];   


protected $val =[
    'name' => 'required|max:200',
    'note' => 'max:200|nullable',
    'pub' => 'max:4'
];

// a setbase()- nem jó, mert más funkciói is vannak (paraméterek inicializálása)
public function construct_set(){
    $this->tpar['calendar']['view']['table']= 'workadmin.groups.calendar';
    $this->set_date();
}


public function workermodal()
{
    $perPage = $this->PAR['perpage'] ?? 50;
    $this->BASE['data'] = Worker::paginate($perPage);
  
}
public function calendar($id)
{   
    $this->BASE['data']['group_id']=$id;  
    $this->BASE['data']['wrole']=Wrole::get()->pluck('name','id');
    $this->BASE['data']['wrole']['0']='nincs változtatás';
    $this->BASE['data']['daytype']=Daytype::get()->pluck('name','id');
    $this->BASE['data']['timetype']=Timetype::get()->pluck('name','id');
    $this->BASE['data']['daytype']['0']='nincs változtatás';
    //calendar--------------------------------------     
    $this->getMonthDays();   
    $this->getGroupday($id);
    $this->getGrouptime($id);   

  //  $data=$this->BASE['data'] ?? [];
    $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
    if (method_exists($this,$viewfunc)) {return $this->$viewfunc();} 
   else{return view($this->PAR['view'].'.create',compact('data'));} 
}

public function calendarsave($id) 
{  
    $request= $this->BASE['request'];
    $this->BASE['data']['group_id']=$id;
    if(isset($this->val)){
     //  $this->validate($request,$this->val );  
    } 

    if($request->has('change'))
    {
     //  echo 'hhhhhhj.....jjjj';  exit();
     if($request->has('wroletask') && $request->wrole_id!=0 ){ $this->wrolechange($request);}
        if($request->has('daytask') && $request->daytype_id!=0 ){ $this->daytypechange($request);}
        if($request->has('timetask') && !empty($request->start) && !empty($request->end))
        { $this->timeadd($request); }
    } 
    if($request->has('del'))
    { 
        if($request->has('daytask')){$this->daytypedel($request);}
        if($request->has('timetask')){ $this->timedel($request);  }
     }

    session(['datum' => $request->datum]);
    return redirect(\MoHandF::url($this->PAR['routes']['base'].'/calendar/'.$id,$this->PAR['getT'])); 
}
public function wrolechange(Request $request)
{  
    $wroletimeT=Wroletime::where('wrole_id',$request->wrole_id)->get()->toarray() ;

    $group_id=$this->BASE['data']['group_id'];


    foreach ($request->datum as $datum) {
        Grouptime::where('group_id',$group_id)->where('datum',$datum)->delete();
        foreach ($wroletimeT as $wroletime) {

            $wroletime['datum']=$datum;
            $wroletime['group_id']=$group_id;
            $daytype = Grouptime::create($wroletime);        
                
        }
    }
}

public function daytypechange(Request $request)
{  
    $daytypedata=[
        'daytype_id'=>$request->daytype_id,
        'note'=>$request->note,
    ];
    $daytypedata['group_id']=$this->BASE['data']['group_id'];
//echo 'hhhhhhhhhmmmmmmmmmmhhhh';
//exit();
    foreach ($request->datum as $datum) {
        $daytypedata['datum']=$datum;
            $daytype = Groupday::firstOrCreate(['group_id' =>$daytypedata['group_id'],'datum' =>$datum]);        
        //  echo 'mmm'.$daytype->id; exit();
            $daytype->update($daytypedata);     
    }
}

public function daytypedel(Request $request)
{  
    foreach ($request->datum as $datum) 
    {        
        $daytype = Groupday::where(['group_id' =>$this->BASE['data']['group_id'],'datum' =>$datum]);     
        $daytype->delete(); 
    }
}

public function timeadd(Request $request)
{  
    $timeT=$request->only(['start', 'end', 'timetype_id']);
    $timeT['group_id']=$this->BASE['data']['group_id'];
    $timeT['note2']=$request->note2;

    foreach ($request->datum as $datum)
     {
        $timeT['datum']=$datum;
        $time = Grouptime::create($timeT);     
    }
}


public function timedel(Request $request)
{  ///echo 'töröl';exit();
    foreach ($request->datum as $datum) {          
        $time =  Grouptime::where(['group_id' =>$this->BASE['data']['group_id'],'datum' =>$datum]);     
        $time->delete(); 
    }
}   

public function show2_set()
{
    $group_id=$this->BASE['data']['id'];
    $request=$this->BASE['request'];
    if($request->worker_id){
        $workerO=Worker::findOrFail($request->worker_id); 
        if($request->edittask=='addworker'){$workergroup_id=$group_id;}
        if($request->edittask=='delworker'){$workergroup_id=null;
       // echo 'jhkjhkjhjk';
        
        }
        foreach($workerO as $worker) {

            $worker->update(['group_id'=>$workergroup_id]);
        } 
        
    }
   
    


}
//előbb hívja meg show_set()-et mnt az eredeti hogy ne kelljen frissíteni woeker törléss és hozzáadás esetén
public function show2($id)
{  
    
    $this->BASE['data']['id']=$id;
    $this->show2_set();
    $data=$this->BASE['data'];

    if(isset($this->BASE['orm']['with'])){$this->BASE['ob']= $this->BASE['ob']->with($this->BASE['orm']['with']);} 
    $this->BASE['data'] =$this->BASE['ob']->findOrFail($id);

$viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
return $this->$viewfunc();
} 
}
