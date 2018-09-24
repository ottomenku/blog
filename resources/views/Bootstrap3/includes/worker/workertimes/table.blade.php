
      <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                     <th>Időtipus</th><th>Dátum</th><th>Start</th><th>End</th><th>Óra</th><th>Megjegyzés</th><th>Dolgozómegjegyzés</th><th>Állapot</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['list'] as $item)
                    <tr>
                       
                        <td>{{ $item['timetype']['name'] }}</td>
                        <td>{{ $item->datum }}</td> <td>{{ $item->start }}</td><td>{{ $item->end }}</td><td>{{ $item->hour }}</td>
                        <td>{{ str_limit($item->managernote, 20,  '...')  }}</td>
                        <td>{{ str_limit($item->workernote, 20,  '...') }}</td> 
                        <td>

                                @if($item->pub==1)
                                 <span class="btn btn-primary btn-xs"> uj</span>
                                @elseif($item->pub==0)
                                <span class="btn btn-success btn-xs" title="Add New Wroletime">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                </span>
                                @elseif($item->pub==2)
                                <span class="btn btn-danger btn-xs" title="Add New Wroletime">
                                    <i class="fa fa-times" aria-hidden="true"></i> 
                                </span>
                                @endif

                            </td>
                        <td>
          
                            @if($item->pub==2 )
                
                            @elseif($item->pub==0)
                   
                            @elseif($item->pub==1)
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
                            @endif       
                    
                            <a href="{{ url('/'.$param['routes']['base'].'/' . $item->id,$param['getT']) }}" 
                                title="View "><button class="btn btn-info btn-xs">
                                <i class="fa fa-eye" aria-hidden="true"></i> </button></a>
                    
                        </td>
                    </tr>
                  
                @endforeach
                </tbody>
            </table>
         </div>
