@php 
//$year=$data['year'] ?? $this->PAR['getT']['ev'] ?? \Carbon::now()->year; 
$year=$data['ev'] ;
$checkbutton=$param['calendar']['checkbutton'] ?? true;
$months_magyar=['hónapok','Január','Február','Március','Április','Május','Június','Július','Augusztus','Szeptember','Október','November','Decenber'];
$months=$param['calendar']['months'] ?? $months_magyar; unset($months[0]);// kiveszi az alapfeliratot és 1-el kezdődikaz index nem 0-val!!!!!
$ev_ho_formopen=$param['calendar']['ev_ho_formopen'] ?? false;
$ev_ho_formurl=$param['calendar']['routes']['ev_ho_form'] ?? $param['routes']['base'];
$ev_ho_form_method=$param['calendar']['ev_ho_form_method'] ?? 'GET';
$ev_ho_formurl_addgetT=$param['calendar']['ev_ho_formurl_addgetT'] ?? true;
if($ev_ho_formurl_addgetT){$ev_ho_formurl= MoHandF::url($ev_ho_formurl,$param['getT']);}

 @endphp

<script>
    function addyear(){
  
      $('#ev').val(parseFloat($('#ev').val())+1);    
    }
    function minusyear(){
        $('#ev').val(parseFloat($('#ev').val())-1);    
      }

</script> 

@if($ev_ho_formopen) 

{!! Form::open([
'url' => $ev_ho_formurl, 
'method' => $ev_ho_form_method,
'class' => 'form-horizontal'
]) !!}

@endif 
          
    <div class="form-group ">
      <div class="col-xs-4">
  
        <div class="input-group">
            <span  onclick="minusyear()" style="cursor: pointer;" class="input-group-addon"><</span>
            {!! Form::text('ev',  $year, ['id'=>'ev','class' => 'form-control input-sm','style' => 'padding-right:0px;padding-left:5px;']) !!}
            <span onclick="addyear()" style="cursor: pointer;" class="input-group-addon">></span>
        </div>
          
                    
      </div>

        <div class="col-xs-4"> 
            {!! Form::select('ho', $months, $data['ho']  , ['class' => 'form-control input-sm col-xs-2']) !!}       
        </div>    
        <div class="col-xs-4"> 
            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Dátum frissítés', ['class' => 'btn btn-primary input-sm','name' => 'ev_ho']) !!}            
        </div>
@if($ev_ho_formopen) 
{!! Form::close() !!}
@endif  
</div>
    
