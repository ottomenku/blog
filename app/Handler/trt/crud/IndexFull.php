<?php

namespace App\Handler\trt\crud;

use Illuminate\Http\Request;
use Session;
//use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Image;
trait IndexFull
{

    public function index_set()
    {}

    public function index_base()
    {

        $perPage = $this->PAR['perpage'] ?? 50;
        $getT = $this->PAR['getT'] ?? [];
        $search_input_name = $this->PAR['search_input_name'] ?? 'search';
        if (method_exists($this->BASE['request'], 'get')) 
        {$this->BASE['keyword'] = $this->BASE['request']->get($search_input_name) ?? '';} else { $this->BASE['keyword'] = '';}

      //  $ob = $this->BASE['ob']['base'] ?? $this->BASE['ob'];

        if (!empty($this->BASE['keyword'])) {
            if (method_exists($this, 'search')) {
                $this->BASE['ob'] = $this->search($this->BASE['ob']);
            }
        } else {
            if (method_exists($this, 'set_orm')) {
                $this->BASE['ob']= $this->set_orm($this->BASE['ob']);
            }
        }
        $this->BASE['data']['list'] = $this->BASE['ob']->paginate($perPage);
        if (!empty($getT)) {$this->BASE['data']['list']->appends($getT);}
      
    }
    public function index(Request $request)
    { 

      

    //if($this->PAR['task']=='index'){
        $this->index_base();

        if (method_exists($this, 'index_set')) {
             $this->index_set();
        } 
   // }
    
        $viewfunc = $this->BASE['viewfunc'] ?? 'mo_view';
        if (method_exists($this, $viewfunc)) {return $this->$viewfunc();} 
        else {return view($this->PAR['view'] . '.index', compact('data'));}
        }
   
}
