@foreach ($contentbuild as  $builditem )  
  
    @switch($buildname['type'])
        @case('text')
           {{ $builditem['text'] }} </br>
            
            @break
        @case('text2')
       text2: {{ $builditem['text'] }} </br>
            
            @break   
     
        @case('include')
            @include($builditem['path'])
                @break 
       
        @case('include_with param')
            @include($builditem['path'],$builditem['param'])
            @break    
    @endswitch

@endforeach