@php
    $daytype='base';
    if($dt['dayOfWeek']==6 || $dt['dayOfWeek']==0 ){$daytype='hollyday';}
    
  //  if($dt['ch']=='workerdays' || $dt['ch']=='days'  ){$daytype='special';}
    $timetype='base';
  
@endphp 

  <li class="flex-item" style="{{ $daystyle[$daytype]['li'] }}">
        <div style="{{ $daystyle[$daytype]['div'] }}">{{ $dt['day'] }}., {{ $dt['type'] }}
        </div>
  <!-- idők-------------------------------------->   
    
    @if(isset($dt['times']))
    @foreach($dt['times'] as $time)  

        <div style="display: flex;width:100%;justify-content:flex-end;{{ $timestyle[$timetype]['div'] }}">   
            @if($time['pub']==0)         
            <span style="{{ $timestyle[$timetype]['span'] }}" >   {{ str_limit($time['start'], 5,'' ).'-'.str_limit($time['end'], 5,'' )  }}    
            </span> 
            @endif
        </div>
        @endforeach 
    
    @endif        
        </li>