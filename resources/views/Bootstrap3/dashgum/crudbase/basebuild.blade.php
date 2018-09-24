
  
    @switch($contentIteme['type'])
        @case('linkbutton')
            <a href="{{ $builditem['Url'] }} " title="{{ $builditem['title' ] or $builditem['name'] }}" style="{{ $builditem['style'] or 'float:right;'}}" >
                <i class="{{ $builditem['icon' ] or ''}}"></i>{{ $builditem['name' ] or ''}}
            </a>
            @break
        @case('modalbutton')
            <a href=" {{ $builditem['Url'] }} " title="{{ $builditem['title'] or $builditem['name'] }}" style="{{ $builditem['style'] or 'float:right;'}}" 
            data-toggle="modal" data-target="{{ $builditem['data target' ] or '#myModal' }}" style="{{ $builditem['style'] or 'float:right;'}}">
                <i class="{{ $builditem['icon' ] or ''}}"></i>
            </a>
            @break  
        @case('form')
            <form method="POST" action="{{ $builditem['Url'] }}"
             accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
             @if(isset($builditem['metod'])) 
             <input name="_method" type="hidden" value="{{ $builditem['metod'] }}">
             @endif
             <input name="_token" type="hidden" value="{{ csrf_token() }}">        
            @break
        @case('formend')
               </form>       
            @break    
        @case('search')
            <form method="GET" action="{{ $builditem['Url'] }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
 
            @break 
        @case('pagination')
        <div class="pagination-wrapper"> {!! $pagin_appends !!} </div>
                @break    
       @case('include')
            @include($builditem['path'])
                @break 
        @case('include')
            @include($builditem['path'])
            @break
        @case('include_with param')
            @include($builditem['path'],$builditem['param'])
            @break    
    @endswitch

