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
             <th>cim</th> <th>Kategoria</th><th>intro</th><th>text.</th><th>Actions</th>
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
                class="btn btn-success btn-xs" title="unPub">
                <i class="fas fa-check"></i>
                </a>         
            @elseif($item->pub==1)
                <a href="/manager/posts/pub/{{$item->id}} "        
                class="btn btn-danger btn-xs" title="pub">
                <i class="far fa-eye-slash"></i>
                </a>
          
            @endif   
            
            <a href="/manager/posts/edit/{{$item->id}} "
                class="btn btn-primary btn-xs" title="unPub">
                <i class="far fa-edit"></i>
                </a>
                <a href="/manager/posts/del/{{$item->id}} "
                    class="btn btn-danger btn-xs" title="unPub">
                    <i class="far fa-trash-alt"></i>
                    </a>
      
            <a href="/manager/posts/show/{{$item->id}} " 
                title="View "><button class="btn btn-info btn-xs">
                <i class="fa fa-eye" aria-hidden="true"></i> </button></a>
    
        
        </td>
            </tr>
            
        @endforeach
        </tbody>
    </table>
    </div>
@endsection

