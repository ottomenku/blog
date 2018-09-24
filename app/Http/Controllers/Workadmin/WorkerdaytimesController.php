<?php

namespace App\Http\Controllers\Workadmin;
use App\Handler\MoController;
//use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;

use App\Workertime;
use App\Wrole;
use App\Wroletime;
use App\Worker;
use App\Workerday;
use App\Timetype;
use App\Daytype;
use App\Day;
use App\Group;
//use Carbon\Carbon;

class WorkerdaytimesController extends MoController
{
    use \App\Handler\trt\crud\IndexFull;
    use \App\Handler\trt\crud\MOCrud;//crud functiok indey nélkül
    use \App\Handler\trt\crud\Task; // GET-el vezérelt taskok futtatása
    use \App\Handler\trt\view\Base; //mo_view()
    use \App\Handler\trt\redirect\Base;//mo_redirect()
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE propertyk hogy legyen mit kiegéaszíteni
    use \App\Handler\trt\set\Orm; // with, where, order_by stb
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg 
    use \App\Handler\trt\set\GetT;
     //calendár------------------------------------
    use \App\Handler\trt\set\Date;
    use \App\Handler\trt\get\Day;
    use \App\Handler\trt\get\Time;
    use \App\Handler\trt\get\Calendar;
    use \App\Handler\trt\calendar\Savecal; //get_savecal_data(),store_savecal(),update_store_savecal()
    use \App\Handler\trt\calendar\Change; //wrolechange(), daytypechange(),daytypedel(),timeadd()....
    protected $par= [
        // 'create_button'=>false,
       'addbutton_label'=>'Naptár sterkesztése',
        'cancel_button'=>false,
        'create_button'=>false,
         'calendar'=>['view'=>['days' => 'workadmin.workerdaytimes.days']],
         'search'=>false,
         'routes'=>['base'=>'workadmin/workerdaytimes'],
         //'baseview'=>'workadmin.workerdays', //nem használt a view helyettesíti
         'view' => ['base' => 'crudbase', 'include' => 'workadmin.workerdaytimes'], //innen csatolják be a taskok a vieweket lényegében form és tabla. A crudview-et egészítik ki
        // 'crudview'=>'crudbase_3', //A view ek keret twemplétjei. Ha tudnak majd formot és táblát generálni ez lesz a view
         'cim'=>'Naptár',
         'getT'=>[],       
     ];
     protected $tpar= [

         'edit'=>[
             'formopen_in_crudview'=>false,
             //'cancel_button'=>True,
             'calendar'=>[
                 'view' => ['days' => 'workadmin.workerdaytimes.editdays'],
             // 'ev_ho'=>false, //kikapcsolja az év hó válastó mezőt
                 'checkbutton'=>true, //kikapcsolja az év hó válastó mezőt
                 'pdf_print'=>false, 
         ]], 

         'calendar'=>[
            'formopen_in_crudview'=>false,
            'view' => ['base' => 'crudbase', 'include' => 'workadmin.workerdaytimes','show2' => 'crudbase.show','calendar' => 'crudbase.index',
            'showcontent' => 'workadmin.workerdaytimes.show2', 'workermodal' => 'workadmin.workerdaytimes.workermodal','table'=>'workadmin.workerdaytimes.calendar'],
         // 'view'=>['table'=>'workadmin.groups.calendar'],
            'calendar'=>[
            'ev_ho_formopen'=>false,
            'view' => ['days' => 'worker.naptar.editdays'],
             'ev_ho'=>true, //ki-bekapcsolja az év hó válastó mezőt
                'checkbutton'=>true, //ki-be kapcsolja az év hó válastó mezőt
                'pdf_print'=>false, 
        ]], 
     ];
     protected $TBASE= [ 'edit'=>[ 'obname'=>'\App\Worker', ],  'orm'=>[ 'with'=>['group']],];

//protected $tbase= [ 'edit'=>[ 'obname'=>'\App\Workerday', ], 'orm'=>[ 'with'=>['workerday','workertime']], ];
     protected $base= [
        // 'search_column'=>'daytype_id,datum,managernote,usernote',
         'get'=>['ev'=>null,'ho'=>null], //a  set_getT automatikusan fltölti a getbőll a $this->PAR['getT']-be
         'post_to_getT'=>['ev'=>null,'ho'=>null],//a set_getT automatikusan fltölti a postból a $this->PAR['getT']-be
         'obname'=>'\App\Worker',
         'ob'=>null,
       //  'with'=>['worker','daytype'],
     ];
 


public function construct_set()
{
  $this->set_date();
}
    public function index_set()
    {
        
    }

    public function edit_set()
    {  
       // $this->set_date();  
    }
    public function workermodal()
    {
        $perPage = $this->PAR['perpage'] ?? 50;
        $this->BASE['data'] = Worker::paginate($perPage);
      
    }
    public function calendar($id)
    {   // echo 'index';
        $worker=Worker::with('user')->find($id);
        $group_id=$worker->group_id ?? 0;
        $this->BASE['data']['cim']='<img width="50px" height="50px" src="/'.$worker->foto.'"> '. $worker->user->name. ' naptár szerkesztés';
        $this->BASE['data']['worker_id']=$id;
        $this->BASE['data']['wrole']=Wrole::get()->pluck('name','id');
        $this->BASE['data']['wrole']['0']='nincs változtatás';
        $this->BASE['data']['daytype']=Daytype::get()->pluck('name','id');
        $this->BASE['data']['timetype']=Timetype::get()->pluck('name','id');
        $this->BASE['data']['daytype']['0']='nincs változtatás';
        //calendar--------------------------------------     
          //calendar--------------------------------------     
    $this->getMonthDays(); 
    if( $group_id>0){$this->getGroupday($group_id);}  
    $this->getWorkerday();
    
    if( $group_id>0){$this->getGrouptime($group_id);}  
    $this->getWorkertime();
    
        $data=$this->BASE['data'] ?? [];
        $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
        if (method_exists($this,$viewfunc)) {return $this->$viewfunc();} 
       else{return view($this->PAR['view'].'.create',compact('data'));} 
    }
    public function calendarsave($id) 
    {  
        $request= $this->BASE['request'];
        $this->BASE['data']['worker_id']=$id;
        if(isset($this->val)){
         //  $this->validate($request,$this->val );  
        } 
    
        switch ($request->change) {
            case 'del' :
                if($request->has('daytask')){$this->daytypedel(0);}
                if($request->has('timetask')){ $this->timedel(0);  }
                break; 
            case 'day_wrole':
                if( $request->daytype_id!=0 ){ $this->daytypechange(0);}
                if( $request->wrole_id!=0 ){ $this->wrolechange(0);}
           
            case 'time' :
                if( !empty($request->start) && !empty($request->end))
                {  $this->timeadd(0); }

            case 'create_save' :
            //SavecalsController@get_savecal_data($worker_id)
             case 'update_save' :
               // echo "i equals 2";       
        }
    
        session(['datum' => $request->datum]);
        return redirect(\MoHandF::url($this->PAR['routes']['base'].'/calendar/'.$id,$this->PAR['getT'])); 
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
    
                $worker->update(['worker_id'=>$workergroup_id]);
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
