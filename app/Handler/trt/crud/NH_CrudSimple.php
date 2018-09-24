<?php

namespace App\Handler\trt\crud;
use Illuminate\Http\Request;
use Session;
//use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Image;
Trait CrudSimple
{

    public function create()
    {   $param= $this->PAR;
        $data=[];
        $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
        if (is_callable([$this,$viewfunc ])) {return $this->$viewfunc();} 
       else{return view($this->PAR['view'].'.create',compact('data'));} 
    }


    public function store(Request $request)
    {
        
        $this->validate($request,$this->val );
        $this->BASE['data'] = $request->all();
        $ob= new $this->BASE['obname']();
        $this->BASE['ob_res']= $ob->create($this->BASE['data']);
        Session::flash('flash_message', trans('mo.itemadded'));
        $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
        if (is_callable([$this,$redirfunc ])) {return $this->$redirfunc();} //behívja  a task specifikus routot is
       else{return redirect($this->PAR['routes']['base'] ); } 
    }

    public function edit($id)
    {  
        $ob= new $this->BASE['obname']();
        $data =$ob->findOrFail($id);
       // $data['id']=$id;
       // $param= $this->PAR;
       $this->BASE['data']=$data;
        $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
        if (is_callable([$this,$viewfunc ])) {return $this->$viewfunc();} 
       else{return view($this->PAR['view'].'.edit',compact('data'));} }

    public function update($id, Request $request)
    {
        $ob= new $this->BASE['obname']();
        
        $valT=$this->val_update ?? $this->val;

        $this->validate($request,$valT );
        $requestData = $request->all();
        $this->BASE['data'] = $request->all();

        $this->BASE['ob_res']=$ob->findOrFail($id);
        $this->BASE['ob_res']->update($this->BASE['data']);

        Session::flash('flash_message',  trans('mo.item_updated'));
        $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
        if (is_callable([$this,$redirfunc ])) {return $this->$redirfunc();} //behívja  a task specifikus routot is
       else{return redirect($this->PAR['routes']['base'] ); } 

    }

    public function destroy($id)
    { 
        $ob= new $this->BASE['obname']();
        $this->BASE['ob_res']=  $ob->destroy($id);
        Session::flash('flash_message', trans('mo.deleted'));

        $redirfunc=$this->BASE['redirfunc']  ?? 'mo_redirect';
        if (is_callable([$this,$redirfunc ])) {return $this->$redirfunc();} //behívja  a task specifikus routot is
       else{return redirect($this->PAR['routes']['base'] ); } 
    }


    public function show($id)
    {   
        $ob= new $this->BASE['obname']();
        $this->BASE['data'] =$ob->findOrFail($id);
        $data=$this->BASE['data'];
        $param= $this->PAR;
        $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
        if (is_callable([$this,$viewfunc ])) {return $this->$viewfunc();} //behívja  a task specifikus viewet is
       else{return view($this->PAR['view'].'.show',compact('data'));}    //return view($this->PAR['view'].'.show', compact('data'));
    } 
}