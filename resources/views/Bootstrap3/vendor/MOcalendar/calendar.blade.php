@php
// TODO config file elkészítése
/*  use app\Http\Controllers\Worker\NaptarController;
    {{ NaptarController::proba('param') }}
    {{ App::make("app\Http\Controllers\Worker\NaptarController")->proba2('param') }} */

 //viewek--------------------------------------------   
 $calendarbase=$param['calendar']['view']['base']  ?? 'calendar';
 //$calendarview=$param['calendar']['view']['calendarview'] ??  $calendarbase;
//echo  '-----------------'. $calendarbase;
 $pdf_print_view=$param['calendar']['view']['pdf_print'] ??  $calendarbase.'.pdf_print';
 $ev_ho_view=$param['calendar']['view']['ev_ho_view'] ??  $calendarbase.'.ev_ho';
 $checkbutton_view=$param['calendar']['view']['checkbutto_view'] ??  $calendarbase.'.checkbutton';
 $style_view=$param['calendar']['view']['style'] ??  $calendarbase.'.style';
 $days_view=$param['calendar']['view']['days'] ?? $calendarbase.'.days';
//echo  '-----------------'.$days_view;

$daystyle=$param['calendar']['daystyle'] ?? [
        'empty'=>'border: 1px solid silver;',
        'base'=>['li'=>'border: 1px solid silver;','div'=>'','span'=>'color:silver'],
        'hollyday'=>['li'=>'border: 1px solid red;','div'=>'','span'=>'color:red'],
        'special'=>['li'=>'border: 1px solid blue;','div'=>'','span'=>'color:blue'],
    ];
$timestyle=$param['calendar']['timestyle'] ??[
        'base'=>['div'=>'border: 1px solid silver;','span'=>'color:blue'],
    ];
@endphp

@include($style_view)

@if( isset($param['calendar']['style_plus']))
    @include($param['calendar']['style_plus'].'.style_plus')
@endif  


              
  
<div style="background-color:#c5c5d6;">

    <ul class="flex-container nowrap"  style="backgroun-color:white;">
       
        <li class="flex-item "  style="height:40px">Hétfő</li>
        <li class="flex-item "  style="height:40px">Kedd</li>
        <li class="flex-item "  style="height:40px">Szerda</li>
        <li class="flex-item "  style="height:40px">Csütörtök</li>
        <li class="flex-item "  style="height:40px">Péntek</li>
        <li class="flex-item "  style="height:40px; color:red;">Szombat</li>  
        <li class="flex-item "  style="height:40px;color:red;">Vasárnap</li>    
    </ul>
</div>     
<div id="naptar">
@foreach($data['calendar'] as $dt) 
<!-- sorkezdés---------------------------------------------->
    @if($dt['dayOfWeek']==1 or $dt['day']==1) 
            <ul class="flex-container nowrap" style="justify-content:flex-start"> 
    <!-- **sortöltés üres divek---------------------------------------------------------->
        @php
        if( $dt['dayOfWeek']==0){$emptydiv=6;}
        else{$emptydiv=$dt['dayOfWeek']-1;}
        @endphp     
        @if ($emptydiv>0) 
            @for ($i = 0; $i < $emptydiv; $i++)
                <li class="flex-item" style="{{ $daystyle['empty'] }}">
                    
                </li>
            @endfor

        @endif
<!-- **------------------------------------------------------------------->               
    @endif
 <!-- Napok--------------------------------------------------->        
 @include($days_view)
<!-- sor lezárása ha teljes a hét------------------------->   
    @if($dt['dayOfWeek']==0) 
    </ul > 
    @endif 
@endforeach

 <!-- üres divek sortöltés és sorlezárás ha nem teljes a hét------------------------------------>
@if($dt['dayOfWeek']>0) 
    @for ($i = $dt['dayOfWeek']; $i < 7; $i++)
            <li class="flex-item" style="{{ $daystyle['empty'] }}"> </li>
    @endfor
</ul > 
@endif 
          
</div>    
