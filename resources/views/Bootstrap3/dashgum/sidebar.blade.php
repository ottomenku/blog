<style>
.menucsoport{
width:100%;
background-color:red;
}
.menugomb{
    width:100%;
    background-color:#214761;
    }
</style>
@php  
       
$menuT=[
'admin'=>[                                          
//['/root/proba','proba'],                                
['/root/conf' ,' Config'],
['/root/roles' ,'Jogok'],
],

'manager'=>[  
['/manager/users', 'Felhasználók'],
['/manager/workers' , 'Dolgozók'],
//['/manager/statuses' ,'Dolgozói státusz'],
//['/manager/workergroups' , 'Dolgozói csoportok'],
['/manager/workertypes' ,  'Munka tipusok'],
['/manager/days','Napok'],
['/manager/daytypes', 'Naptipusok'],
['/manager/timeframes', 'Időkeretek'],
['/manager/timetypes',   'Munkaidőtipusok'],
//['/manager/wroles', 'Munkarendek'],
//['/manager/wroleunits', 'Műszakok'],
//['/manager/wroletimes',  'Műszak idők'],
//['/workadmin/workerdays' , 'Költdég térítés'],
],

'workadmin'=>[
['/workadmin/wroles', 'Munkarendek'],   
['/workadmin/groups', 'Müszak tervező'],
['/workadmin/savecal', 'Havi mentések'],
['/workadmin/workerdaytimes','Dolgozói naptárak'],
['/workadmin/workerdays',  'Napok'],
['/workadmin/workertimes', 'Munkaidők'],
//['/workadmin/workertimeframes ', 'Dolgozói időkeretek'],

//['/workadmin/workertimeswish', 'Munkaidő kérelmek'],
//['/workadmin/', ' Szabadság,betegállomány'],
//['/workadmin/workerdays',  'kiküldetés'],
],
'worker'=>[
['/worker/personal', 'Saját adatok'],  
['/worker/workerdays',  'Napok'],  
['/worker/workertimes', 'Munkaidők'],
//['/worker/workerwroleunits', 'Műszakcsere'],

['/worker/naptar',  'Naptár'],

//['/worker/workerdays', 'Szabadság, betegállomány'],
//['/workadmin/workerdays', 'kiküldetés'],
//['/workadmin/workerdays', 'Munkaidő nyilvántartás'],
//['/workadmin/workerdays', 'költdég térítés']
]
];
$workerbool=true;
$user_id=\Auth::user()->id;
//$worker=App\Worker::select('id','foto')->where('user_id','=',$user_id)->first();
$foto=$worker->foto ?? 'images/user-circle.svg';
if(empty($worker)){$workerbool=false;}
@endphp
<aside >
        <div id="sidebar" style="background-color:#203047;"  class="nav-collapse ">
                  <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                  
                <p class="centered"><a style="padding:10px;font-size:16px;" class="{{ Request::path() == 'manager/users' ? 'active' : '' }}" href="/worker/personal"><img src="/{{ $foto }}" class="img-circle" width="60"></a></p>
                <h5 class="centered">{{ Auth::user()->name }} </h5>
           
            </ul> 
   <!-- superadmin**************************************************** -->    
   @if (Auth::user()->hasRole('admin'))      
    <a class="btn btn-primary menucsoport"
    data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample" >
    <i class="fa fa-edit "> </i>Szuper Admin <span class="badge"> lenyiló </span>
        </a>
       
    <div class="collapse" id="collapseExample1">
            @foreach($menuT['admin'] as $menu)
            <a href="{{$menu[0]}}" style="background-color:#214761;"  class="btn btn-primary menugomb">{{$menu[1]}}</a>
            @endforeach
    </div>  
    @endif      
    @if (Auth::user()->hasRole('manager'))      
     <!-- Manager**************************************************** -->
     <a  class="btn btn-primary menucsoport"
      data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" >
      <i class="fa fa-edit "> </i>Manager  <span class="badge"> lenyiló </span>
    </a>
     
      <div class="collapse" id="collapseExample">
            @foreach($menuT['manager'] as $menu)
            <a href="{{$menu[0]}}" style="background-color:#214761;"  class="btn btn-primary menugomb">{{$menu[1]}}</a>
             @endforeach
     </div> 
     @endif 
     @if (Auth::user()->hasRole('workadmin'))      
        <!-- Manager**************************************************** -->
        <a  class="btn btn-primary menucsoport"
        data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample" >
        <i class="fa fa-edit "> </i>Admin  <span class="badge"> lenyiló </span>
      </a>
       
        <div class="collapse" id="collapseExample3">
              @foreach($menuT['workadmin'] as $menu)
              <a href="{{$menu[0]}}" style="background-color:#214761;"  class="btn btn-primary menugomb">{{$menu[1]}}</a>
               @endforeach
       </div> 
       @endif 
        @if ($workerbool)   
       <div >
            @foreach($menuT['worker'] as $menu)
            <a href="{{$menu[0]}}" style="background-color:#214761;"  class="btn btn-primary menugomb">{{$menu[1]}}</a>
             @endforeach
     </div> 
     @endif 
    </div>
        
 
 </aside>
    