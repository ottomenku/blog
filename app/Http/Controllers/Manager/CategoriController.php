<?php

namespace App\Http\Controllers\Manager;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;

use App\Post;
use App\Categori;
use App\Http\Controllers\Controller;


class CategoriController extends Controller
{

 private   $ob;
 private   $baseroute='/manager/categori';
 private   $baseview='categori';
 private   $validate=[];
 private   $search_columnT=[];
 

  public function __construct()
  {
      $this->ob=new Categori();
  }
    public function index(Request $request)
    {    
        $data=[];  
        $keyword = $request->get('search');
        $perPage = 5;

        $this->ob = $this->ob->where('id', '>', "1")->orderBy('id','DESC');
        
        if (!empty($keyword)) {
           
            foreach($this->search_columnT as $col)
            {
                $this->ob=$this->ob->orwhere('cim', 'LIKE', "%$keyword%");
            }
        }	
            $data['list'] = $this->ob->paginate($perPage);
        
            return view(config('moconf.includes').'.'.$this->baseview.'.index',compact('data'));
        
    }

    public function create()
    {
        //$data['image']='';
        //$data['categori']= Categori::get()->pluck('name','id');   ;
        return view(config('moconf.includes').'.'.$this->baseview.'.create',compact('data'));
    }
    public function edit($id)
    {   
        $data=$this->ob->findOrFail($id);
      //  $data['categori']= Categori::get()->pluck('name','id');   ;
        return view(config('moconf.includes').'.'.$this->baseview.'.edit',compact('data'));
    }


 
    public function store(Request $request)
    {
        if(isset($this->validateT)){
           $this->validate($request,$this->validateT );  
        }
       
        $data = $request->all();
    
        $this->ob->create($data);
        Session::flash('flash_message', trans('mo.itemadded'));
     return redirect($this->baseroute); 
    }
 

    public function update($id, Request $request)
    { 
        $valT=$this->val_update ?? $this->validT ?? [];

        $this->validate($request,$valT );
        $data = $request->all();

        $this->ob= $this->ob->findOrFail($id);
        $this->ob->update($data);

        return redirect($this->baseroute); 

    }

    public function destroy($id)
    {  

        $this->ob->destroy($id);
        Session::flash('flash_message', trans('mo.deleted'));
        return redirect($this->baseroute); 
    }
    public function del($id)
    {  

        $this->ob->destroy($id);
        Session::flash('flash_message', trans('mo.deleted'));
        return redirect($this->baseroute); 
    }

    public function pub($id)
    { 

        $this->ob=$this->ob->findOrFail($id);
        $this->ob->update(['pub'=>0]);
        Session::flash('flash_message',  trans('mo.item_pub'));
        return redirect($this->baseroute); 
    }
    public function unpub($id)
    { 

        Post::findOrFail($id)->update(['pub'=>1]);
        Session::flash('flash_message',  trans('mo.item_unpub'));
        return redirect($this->baseroute); 
    }
 
}
