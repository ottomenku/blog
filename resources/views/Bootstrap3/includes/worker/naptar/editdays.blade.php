@php
    $daytype='base';
    if($dt['dayOfWeek']==6 || $dt['dayOfWeek']==0 ){$daytype='hollyday';}
    
    $timetype='base';
@endphp 

  <li class="flex-item" style="color:black; {{ $daystyle[$daytype]['li'] }} ">
        <div style="{{ $daystyle[$daytype]['div'] }}">
            {{ $dt['day'] }}., {{ $dt['type'] }} 
        </div>
        <div style="color:gray;">
            {{ $dt['wish']['type'] or "" }} 
        </div>
  <!-- idők-------------------------------------->   
    
    @if(isset($dt['times']))
        @foreach($dt['times'] as $time)  

        <div style="display: flex;width:100%;justify-content:flex-end;{{ $timestyle[$timetype]['div'] }}">   
                @if($time['pub']==0)         
                <span style="{{ $timestyle[$timetype]['span'] }}" >   {{ str_limit($time['start'], 5,'' ).'-'.str_limit($time['end'], 5,'' )  }}    
                </span> 
                @endif
                @if($time['pub']==1)         
                <span style="color:gray;">  {{ str_limit($time['start'], 5,'' ).'----'.str_limit($time['end'], 5,'' )  }}    
                </span>
                @endif
            </div>
        @endforeach 
    @endif  
    @php 
    $checked=false; 
    if(is_array(session('datum')) && in_array($dt['datum'], session('datum'))){$checked=true;}
    if(is_array(session('datum')) && in_array($dt['datum'], session('datum'))){$checked=true;}
    $munkanap=$dt['munkanap'] ?? false;
    $munkanapClass='';
    if($munkanap){$munkanapClass='workerdayclass';}
    @endphp

    {{Form::checkbox('datum[]', $dt['datum'],$checked,['class' => 'checkboxjel '.$munkanapClass ])}} 
        </li>