@extends('Bootstrap3.dashgum.backend')
@section('content')

<center><h3>Postok</h3></center>
<a href="/manager/posts/create "
    class="btn btn-success btn-xm" title="create">
   Új post feltöltése
 </a>     
    <div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr>
             <th>cim</th> <th>Kategoria</th><th>intro</th><th>text.</th><th>Pub</th><th>Slide</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['list'] as $item)
            <tr>
             <!--   <td><img width="30" height="30" src="{{ $item->image}}" ></td>   -->
                <td>{{  str_limit($item->cim, 20, '...')  }}</td>   
                <td>{{ $item->categori->name}}</td>  
                <td>{{ str_limit($item->intro, 20,  '...')  }}</td>
                <td>{{ str_limit($item->ptext, 20,  '...') }}</td>
            <td>
            @if($item->pub==0)
                <a href="/manager/posts/unpub/{{$item->id}} "
                class="btn btn-light btn-xs" style="color:green; font-size:1.5em;" title="unPub">
                <i class="fas fa-toggle-on"></i>
                </a>         
            @elseif($item->pub==1)
                <a href="/manager/posts/pub/{{$item->id}} "        
                class="btn btn-light btn-xs" style="color:grey; font-size:1.5em;"  title="pub">
                <i class="fas fa-toggle-off"></i>
                </a>
          
            @endif   
            </td>
            <td>
                    @if($item->slide==0)
                        <a href="/manager/posts/slideoff/{{$item->id}} "
                        class="btn btn-light btn-xs" style="color:green; font-size:1.5em;" title="unPub">
                        <i class="fas fa-toggle-on"></i>
                        </a>         
                    @elseif($item->slide==1)
                        <a href="/manager/posts/slideon/{{$item->id}} "        
                        class="btn btn-light btn-xs" style="color:grey; font-size:1.5em;"  title="pub">
                        <i class="fas fa-toggle-off"></i>
                        </a>
                  
                    @endif   
                    </td>


            <td>
            <a href="/manager/posts/{{$item->id}}/edit "
                class="btn btn-primary btn-xs" title="edit">
                <i class="far fa-edit"></i>
                </a>
                <a href="/manager/posts/del/{{$item->id}} "
                    class="btn btn-danger btn-xs" title="delete">
                    <i class="far fa-trash-alt"></i>
                    </a>
      
            <a href="/manager/posts/{{$item->id}}" 
                title="show " class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal" >
                <i class="fa fa-eye" aria-hidden="true"></i></a>
    
        
        </td>
            </tr>
            
        @endforeach
        </tbody>
    </table>
    </div>
    <div class="pagination"> {!! $data['list']->appends(['search' => Request::get('search')])->render() !!} </div>
@endsection

