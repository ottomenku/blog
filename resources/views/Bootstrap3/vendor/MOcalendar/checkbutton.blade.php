@php 
//$year=$data['year'] ?? $this->PAR['getT']['ev'] ?? \Carbon::now()->year; 

$checkbutton_select_class=$param['calendar']['checkbutton_select_class'] ?? ['Munkanapok'=>'workerdayclass'];//['gombfelirat'=>'check_class']
$checkbox_name=$param['calendar']['checkbox_name'] ?? 'datum';

 @endphp

<script>
     function inversecheck(){
       
        $("input[name={{ $checkbox_name }}\\[\\]]").each(function(){
            $(this).prop('checked', !$(this).prop('checked'));
         }); 
      }
      function allcheck(){
        var checkBoxes = $("input[name={{ $checkbox_name }}\\[\\]]");
     //   var checkBoxes = $("input[name=datum\\[\\]]");
        checkBoxes.prop("checked", true);  
      }
      function nocheck(){
        var checkBoxes = $("input[name={{ $checkbox_name }}\\[\\]]");
        checkBoxes.prop("checked", false);  
      }
      function classcheck(cl){
        $("."+cl).each(function(){
            $(this).prop('checked', true);
         }); 
      }
</script> 
           

 

{!! Form::button( 'Mind', ['class' => 'btn input-sm','onclick' => 'allcheck()']) !!}
{!! Form::button( 'Egyiksem', ['class' => 'btn  input-sm','onclick' => 'nocheck()']) !!}
{!! Form::button('Inverse', ['class' => 'btn input-sm','onclick' => 'inversecheck()']) !!}

@foreach($checkbutton_select_class as $key=>$val) 
{!! Form::button( $key, ['class' => 'btn input-sm','onclick' => 'classcheck(\''.$val.'\')']) !!}
@endforeach
 