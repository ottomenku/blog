<?php

namespace App\Http\Controllers\Workadmin;
use App\Handler\MoController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use App\Wroletime;
use App\Timetype;


class WrolesController extends MoController
{
    use \App\Handler\trt\crud\IndexFull;
    use \App\Handler\trt\crud\MOCrud;
    use \App\Handler\trt\view\Base;
    use \App\Handler\trt\redirect\Base;
    use \App\Handler\trt\set\Base; //akkor kell ha csak kiegészítjük A paramétereket nem PAR-t csak par-t adunk meg
    use \App\Handler\trt\property\MoControllerBase; //PAR és BASE propertyk hogy legyen mit kiegéaszíteni
    use \App\Handler\trt\set\Orm; // with, where, order_by
    use \App\Handler\trt\crud\Task;

    protected $par= [
       //  'get_key'=>'worktime',
        'routes'=>['base'=>'workadmin/wroles'],
        //'baseview'=>'workadmin.workerdays', //nem használt a view helyettesíti
        'view' => ['base' => 'crudbase', 'include' => 'workadmin.wroles',
        'editform' => 'workadmin.wroles.editform'
    ], //innen csatolják be a taskok a vieweket lényegében form és tabla. A crudview-et egészítik ki
      //  'crudview'=>'crudbase_3', //A view ek keret twemplétjei. Ha tudnak majd formot és táblát generálni ez lesz a view
        'cim'=>'Munkarendek',
        'getT'=>[],  
        

    ];
  
    protected $base= [
       // 'search_column'=>'daytype_id,datum,managernote,usernote',
        'get'=>['ev'=>null,'ho'=>null], //a mocontroller automatikusan feltölti a getből a $this->PAR['getT']-be
       // 'get_post'=>['ev'=>null,'ho'=>null],//a mocontroller automatikusan feltölti a getből a $this->PAR['getT']-be ha van ilyen kulcs a postban azzal felülírja
        'obname'=>'\App\Wrole',
        'ob'=>null,
       // 'func'=>[  'set_task', 'set_getT','set_date', 'set_redir','set_routes','set_ob'],
      'orm'=> [ 'with'=>['wroletime']],

    ];


     protected $val= [
         'note' => 'string|max:200|nullable',
         'name' => 'required|string',
     ];
     public function edit_set()
     {   
         $this->BASE['data']['timetype']=Timetype::get()->pluck('name','id');
     }
//az editre iráníit vissza nemaz indexre
     public function store(Request $request)
     {
         if(isset($this->val)){
            $this->validate($request,$this->val );  
         }
        
         $this->BASE['data'] = $request->all();
     
         $this->BASE['ob']= $this->BASE['ob']->create($this->BASE['data']);
         $id=$this->BASE['ob']->id;
 
         Session::flash('flash_message', trans('mo.itemadded'));
         $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
       return redirect($this->PAR['routes']['base'].'/'.$id.'/edit' );  
     }
   
     public function update($id,Request $request)
     {  
        if($request->has('addtime'))
        {
         $this->addtime($id);  
        return redirect($this->PAR['routes']['base'].'/'.$id.'/edit' ); 
        } 
        else
        { 
            $valT=$this->val_update ?? $this->val ?? [];

            $this->validate($request,$valT );
            $this->BASE['data'] = $request->only('name', 'note');;

            $this->BASE['ob']= $this->BASE['ob']->findOrFail($id);
            $this->BASE['ob']->update($this->BASE['data']);
    
            Session::flash('flash_message',  trans('mo.item_updated'));
            $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
            if (method_exists($this,$redirfunc)) {return $this->$redirfunc();} //behívja  a task specifikus routot is
           else{return redirect($this->PAR['routes']['base'] ); }
        }       
     }


     
     public function addtime($wroleid)
     {
         $request=$this->BASE['request'];
         if(isset($this->timeval)){
            $this->validate($request,$this->timeval );  
         }
        
         $this->BASE['data'] = $request->all();
         $this->BASE['data']['wrole_id']=$wroleid;
         $this->BASE['data']['note']=$request->timenote;
         Wroletime::create($this->BASE['data']);

     }

     public function deltime($timeid,$wroleid)
     {
        Wroletime::destroy($timeid);
       return redirect($this->PAR['routes']['base'].'/'.$wroleid.'/edit' );  
     }

}