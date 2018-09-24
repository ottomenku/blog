<?php

namespace App\Handler\trt\crud;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Image;
Trait CrudWithSetfunc
{

    public function create_set() {}
    public function create()
    {    
        $funcT=$this->TBASE['create']['task_func'] ?? ['create_set'];
        $this->call_func($funcT);
        $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
        if (is_callable([$this,$viewfunc ])) {return $this->$viewfunc();} //behívja  a task specifikus viewet is
       else{return view($this->PAR['view'].'.create',compact('param'));}    //return view($this->PAR['view'].'.show', compact('data'));
   
    }

    public function store_set(){ }

    public function store(Request $request)
    {
        
        $this->validate($request,$this->val );
        $this->BASE['data'] = $request->all();

        $funcT=$this->TBASE['store']['task_func'] ?? ['store_set','image_upload'];
        $this->call_func($funcT);
        $this->BASE['ob_res']= $this->BASE['ob']->create($this->BASE['data']);

        Session::flash('flash_message', trans('mo.itemadded'));

        $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
        if (is_callable([$this,$redirfunc ])) {return $this->$redirfunc();} //behívja  a task specifikus routot is
       else{return redirect($this->PAR['routes']['base'] ); } 
   
    }

    public function edit_set() {}
    public function edit($id)
    {  
        $this->BASE['id']=$id;
        $this->BASE['data'] =$this->BASE['ob']->findOrFail($id);

        $funcT=$this->TBASE['edit']['task_func'] ?? ['edit_set','image_upload'];
      
        $this->call_func($funcT);
        $data=$this->BASE['data'];
      
        $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
        if (is_callable([$this,$viewfunc ])) {return $this->$viewfunc();} //behívja  a task specifikus viewet is
       else{return view($this->PAR['view'].'.edit',compact('param'));}    //return view($this->PAR['view'].'.show', compact('data'));
   
    }
    public function image_upload(){}
    public function update_file(){}
    public function update_set(){}
    public function update($id, Request $request)
    {
        $this->BASE['id']=$id;
        
        $valT=$this->val_update ?? $this->val;

        $this->validate($request,$valT );
        $requestData = $request->all();
        $this->BASE['data'] = $request->all();

        $this->BASE['ob_res']=$this->BASE['ob']->findOrFail($id);

        $funcT=$this->TBASE['update']['task_func'] ?? ['update_set','image_upload'];
        $this->call_func($funcT);

        $this->BASE['ob_res']->update($this->BASE['data']);

        Session::flash('flash_message',  trans('mo.item_updated'));
        $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
        if (is_callable([$this,$redirfunc ])) {return $this->$redirfunc();} //behívja  a task specifikus routot is
       else{return redirect($this->PAR['routes']['base'] ); } 

    }

    public function destroy_set(){}
    public function destroy($id)
    { 
        $this->BASE['id']=$id;
        $this->BASE['ob_res']= $this->BASE['ob']->destroy($id);
//echo 'destroy'.$id;
        $funcT=$this->TBASE['destroy']['task_func'] ?? ['destroy_set'];
        $this->call_func($funcT);
//echo 'destroy'.$this->PAR['routes']['redir'];
        Session::flash('flash_message', trans('mo.deleted'));
        $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
        if (is_callable([$this,$redirfunc ])) {return $this->$redirfunc();} //behívja  a task specifikus routot is
       else{return redirect($this->PAR['routes']['base'] ); } 
    }

    public function show_set(){}
    public function show($id)
    {   
        $this->BASE['id']=$id;  
        $this->BASE['data'] =$this->BASE['ob']->findOrFail($id);

        $funcT=$this->TBASE['show']['task_func'] ?? ['show_set'];
        $this->call_func($funcT);

        $data=$this->BASE['data'];
        $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
        if (is_callable([$this,$viewfunc ])) {return $this->$viewfunc();} //behívja  a task specifikus viewet is
       else{return view($this->PAR['view'].'.show',compact('param'));}    //return view($this->PAR['view'].'.show', compact('data'));
  
    } 
}