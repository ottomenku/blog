@php
//use \app\Http\Controllers\Worker\WorkersController;
//adatok-----------------
if(!isset($data)){$data=[];}
else{$data=$data->toarray();}
$getT=$param['getT'] ;

//péda $param['show']=[['colname'=>'id','label'=>'Id']]
//print_r($getT);
//echo 'hkj';
$langfile=$param['langfile'] ?? 'mo';
$showT=$param['show'] ?? [];
$showcontent=$param['view']['showcontent'] ?? false;

if(isset($showT[0]) && $showT[0]=='auto'){
  
    foreach($data as $key=>$val){
        $label=$val['label'] ?? $key;
        $langalias=$val['langalias'] ?? $key;
        if (Lang::has($langfile.'.'.$langalias))
        {$label=$langfile.'.'.$langalias;}
        $label=$val['label'] ?? $label;
        $showT[]= ['colname'=>$key,'label'=>$label];
    }
}

$list=$data['list'] ?? $data;

//$formbase=$param['view']['include'] ?? $param['view']['base'] ;
//$formview=$param['view']['form'] ??  $formbase.'.form'; 
//urlek------------------------
$cancelUrl=$param['routes']['cancel'] ?? MoHandF::url($param['routes']['base'],$getT);
//$formurl=$param['routes']['form'] ?? MoHandF::url($param['routes']['base'],$getT);
//gombok,mezők----------------------------------
$cancel_button=$param['cancel_button'] ?? true;
//feliratok----------------------
$cim=$param['cim'] ?? '';
$cancel_label=$param['label']['cancel'] ??  trans('mo.cancel');
@endphp


@extends('layouts.backend')
@section('content')
@include('layouts.sidebar')    


<section id="main-content">  
    <section class="wrapper">
        <div class="row">   
            <div class="col-lg-12 main-chart">
                <div class="panel panel-default">
                    <div class="panel-heading">{{  $param['cim']  or ''  }}   </div>
                    <div class="panel-body">
                        <br/>
                        <br/>
                        @if($cancel_button)
 
                        <a href="{{ $cancelUrl }}" title="Cancel"><button class="btn btn-warning btn-sm">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>{{ $cancel_label }}</button></a>
                        
                        @endif   

@if($showcontent)
@include($showcontent) 
@else

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                            @foreach($showT as $row)
                            <tr>
                                    <th>{!! MoShow::label($row) !!}</th>
                                    <td>{!! MoShow::data($row,$data) !!}</td>
                                </tr>
                            @endforeach
                                </tbody>
                            </table>
                        </div>       
@endif
                    </div>
                </div>
            </div>
        </div>
       
</section>
</section>        

@endsection
