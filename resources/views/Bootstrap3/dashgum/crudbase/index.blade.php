<!-- path:Bootstrap3.dashgum.crudbase name:index -->

@php
//adatok-----------------

$list=$data['list'] ?? [];
//$pagin_appends='';
//if(!is_array($list)){$pagin_appends=$list->appends(['search' => Request::get('search')])->render() ;}

$vietaskParam=[
    'cim' =>'',
    'contentbuild' =>[
    'infobutton'=> [
        'type'=>  'modalbutton',
            'url'=> '#',
            'fa'=> 'fa fa-info-circle fa-3x'
            
        ],
    'newitembutton'=> [
            'type'=>  'linkbutton',
                'url'=> '#',           
                'name'=> trans('mo.cancel'),
                'fa'=> ''
         ],
    'searchinput'=> [
            'type'=>  'search',
                'url'=> '#',           
         ], 
    'include'=> [
            'type'=> 'include',
            'path'=> ''
        ]      
    ]
];
    


//$baseVtaskParam['contentbuild']['infobutton']['url'] = MoHandF::url($vparam['routes']['base'].'/info/baseinfo',$urlParamT);
//$baseVtaskParam['contentbuild']['craetebutton']['url'] = MoHandF::url($vparam['routes']['base'].'/create',$urlParamT);
//$baseVtaskParam['contentbuild']['include']['path']=$vparam['routes']['table'] ?? $vparam['routes']['includes'].'/table.blade.php' ;
//$baseVtaskParam['contentbuild']['searchinput']['url']=$vparam['routes']['searchUrl'] ?? $vparam['routes']['base'] ;

$vparam=array_merge($basevParam, $baseVtaskParam);

@endphp  
