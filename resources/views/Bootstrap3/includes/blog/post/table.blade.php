
    <div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr>
             <th>cim</th><th>intro</th><th>text.</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['list'] as $item)
            <tr>
             <!--   <td><img width="30" height="30" src="{{ $item->image}}" ></td>   -->
                <td>{{ $item->cim}}</td>   
                <td>{{ str_limit($item->intro, 20,  '...')  }}</td>
                <td>{{ str_limit($item->ptext, 20,  '...') }}</td>
            <td>
            @if($item->pub==0)
            <a href="{!!  MoHandF::url($param['routes']['base'],$param['getT'],['task'=>'unpub','id'=>$item->id]) !!} "
            class="btn btn-danger btn-xs" title="pub">
                <i class="fa fa-times" aria-hidden="true"></i> 
            </a>
            @elseif($item->pub==1)
            
            <a href="{!!  MoHandF::url($param['routes']['base'],$param['getT'],['task'=>'pub','id'=>$item->id]) !!} "
                class="btn btn-success btn-xs" title="unPub">
                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                </a>
            @endif       
            {!! 
                MoHandF::linkButton([
                'link'=> MoHandF::url($param['routes']['base'].'/'.$item->id.'/edit',$param['getT']),
                'fa'=>'pencil-square-o']) 
            !!}
            {!!
                    MoHandF::delButton([
                'tip'=>'del',
                'link'=>MoHandF::url($param['routes']['base'].'/'.$item->id,$param['getT']),
                'fa'=>'trash-o']) 
            !!}
            <a href="{{ url('/'.$param['routes']['base'].'/' . $item->id,$param['getT']) }}" 
                title="View "><button class="btn btn-info btn-xs">
                <i class="fa fa-eye" aria-hidden="true"></i> </button></a>
    
        
        </td>
            </tr>
            
        @endforeach
        </tbody>
    </table>
    </div>


