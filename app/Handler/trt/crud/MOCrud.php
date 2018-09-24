<?php

namespace App\Handler\trt\crud;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Image;

/**
 * alap crud functions
 */
Trait MOCrud
{    public function info_set(){}//ha nincs sem baj de a call_func() a logban hibát jelez
    public function info($view)
    {   
        
        $funcT=$this->TBASE['create']['task_func'] ?? ['info_set'];
        $this->call_func($funcT);
        $data=$this->BASE['data'] ?? [];
        $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';

        return view($this->PAR['view']['include'].'.'.$view,compact('data'));
    }
    public function create_set(){}//ha nincs sem baj de a call_func() a logban hibát jelez
    public function create()
    {   
        
        $funcT=$this->TBASE['create']['task_func'] ?? ['create_set'];
        $this->call_func($funcT);
        $data=$this->BASE['data'] ?? [];
        $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
        if (method_exists($this,$viewfunc)) {return $this->$viewfunc();} 
       else{return view($this->PAR['view'].'.create',compact('data'));} 
    }

    public function store_set_data(){}//mentés előtt manipulálható vele a validált BASE['data']
    public function store_set(){} //mentés után  újabb save functionok lefuttatására
      
    public function store(Request $request)
    {
        if(isset($this->val)){
           $this->validate($request,$this->val );  
        }
       
        $this->BASE['data'] = $request->all();

        if (method_exists($this,'store_set_data')) {$this->store_set_data();} 
        if (method_exists($this,'image_upload')) {$this->image_upload();} 
    
        $this->BASE['ob']= $this->BASE['ob']->create($this->BASE['data']);
        $this->BASE['data']['id'] =$this->BASE['ob']->id;
        if (method_exists($this,'store_set')) {$this->store_set();} 

        Session::flash('flash_message', trans('mo.itemadded'));
        $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
        if (method_exists($this,$redirfunc)) {return $this->$redirfunc();} //behívja  a task specifikus routot is
       else{return redirect($this->PAR['routes']['base'] ); } 
    }
 
    public function edit_set(){}
    public function edit($id)
    {   // echo 'index';
        if(isset($this->BASE['orm']['with'])){$this->BASE['ob']= $this->BASE['ob']->with($this->BASE['orm']['with']);}
        $this->BASE['data']  =$this->BASE['ob']->findOrFail($id);
        $this->BASE['data']['id']=$id;
       if (method_exists($this,'edit_set')) {$this->edit_set();} 
       $data=$this->BASE['data'] ?? [];
        $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
        if (method_exists($this,$viewfunc)) {return $this->$viewfunc();} 
       else{return view($this->PAR['view'].'.edit',compact('data'));} }

    public function update_set_data(){}//mentés előtt manipulálható vele a validált BASE['data']
    public function update_set(){} //mentés után  újabb save functionok lefuttatására
    public function update($id, Request $request)
    { 
        $valT=$this->val_update ?? $this->val ?? [];

        $this->validate($request,$valT );
        $requestData = $request->all();

        $this->BASE['data'] = $request->all();
        $this->BASE['data']['id'] =$id;
        if (method_exists($this,'update_set_data')) {$this->update_set_data();} 
        if (method_exists($this,'image_upload')) {$this->image_upload();} 

        if(isset($this->BASE['orm']['with']))
        $this->BASE['ob']->with($this->BASE['orm']['with']);
        $this->BASE['ob']= $this->BASE['ob']->findOrFail($id);
        $this->BASE['ob']->update($this->BASE['data']);

        if (method_exists($this,'update_set')) {$this->update_set();} 

        Session::flash('flash_message',  trans('mo.item_updated'));
        $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
        if (method_exists($this,$redirfunc)) {return $this->$redirfunc();} //behívja  a task specifikus routot is
       else{return redirect($this->PAR['routes']['base'] ); } 

    }

    public function destroy($id)
    {  
        $this->BASE['data']['id']=$id;
        $this->BASE['ob'] = $this->BASE['ob']->find($id);
        if (method_exists($this,'destroy_set')) {$this->destroy_set();} 
        $this->BASE['ob']= $this->BASE['ob']->destroy($id);
        Session::flash('flash_message', trans('mo.deleted'));

        $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
        if (method_exists($this,$redirfunc)) {return $this->$redirfunc();} //behívja  a task specifikus routot is
       else{return redirect($this->PAR['routes']['base'] ); } 
    }

    public function show($id)
    {     
        if(isset($this->BASE['orm']['with'])){$this->BASE['ob']= $this->BASE['ob']->with($this->BASE['orm']['with']);} 
        $this->BASE['data'] =$this->BASE['ob']->findOrFail($id);
        $this->BASE['data']['id']=$id;
        //print_r( $this->BASE['data']['worker'] );

        if (method_exists($this,'show_set')) {$this->show_set();} 
        $data=$this->BASE['data'];
     //print_r( $this->BASE['data']);
        $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
        if (method_exists($this,$viewfunc)) {return $this->$viewfunc();} //behívja  a task specifikus viewet is
       else{return view($this->PAR['view']['base'].'.show',compact('data'));}    //return view($this->PAR['view'].'.show', compact('data'));
    } 
    public function pub()
    { 
        //workertimewish publikálás----------
      
       $id=Input::get('id');
       $this->BASE['data']['id']=$id;
       $this->BASE['ob_res']=$this->BASE['ob']->findOrFail($id);
       $this->BASE['ob_res']->update(['pub'=>0]);
       if (method_exists($this,'pub_set')) {$this->pub_set();} 
        Session::flash('flash_message',  trans('mo.item_pub'));
        $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
      if (method_exists($this,$redirfunc)) {return $this->$redirfunc();} //behívja  a task specifikus routot is
       else{return redirect($this->PAR['routes']['base'] ); } 
    }
    public function unpub()
    { 
       $id=Input::get('id');
       $this->BASE['data']['id']=$id; 
       $pubval=$this->Par['pubval'] ?? 1;
       $this->BASE['ob_res']=$this->BASE['ob']->findOrFail($id);
       $this->BASE['ob_res']->update(['pub'=>2]);
       if (method_exists($this,'unpub_set')) {$this->unpub_set_set();} 
       Session::flash('flash_message',  trans('mo.item_unpub'));
       $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
     if (method_exists($this,$redirfunc)) {return $this->$redirfunc();} //behívja  a task specifikus routot is
     else{return redirect($this->PAR['routes']['base'] ); } 
    }


}