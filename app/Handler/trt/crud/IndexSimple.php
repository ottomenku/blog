<?php

namespace App\Handler\trt\crud;
use Illuminate\Http\Request;
use Session;
//use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Image;
Trait IndexSimple
{

   public function index(Request $request)
    {    
        $data=[];  
        $keyword = $request->get('search');
        $perPage = 25;
        $search_columnT=$this->BASE['search_column'] ?? [];

        $ob=$this->BASE['ob']['base'] ?? $this->BASE['ob'];
       // $ob= new $this->BASE['obname']();
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
        //print_r($data);
        $this->BASE['data']=$data;
        $viewfunc=$this->BASE['viewfunc']  ?? 'mo_view';
        $view=$this->PAR['view']['base'] ?? $this->PAR['view'];
        if (is_callable([$this,$viewfunc ])) {return $this->$viewfunc();} 
       else{return view($this->PAR['view'].'.index',compact('data'));} 
        
    }
}