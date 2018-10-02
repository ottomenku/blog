@extends('Bootstrap3.dashgum.backend')
@section('content')

<center><h3>Postok</h3></center>
<a href="/manager/categori/create "
    class="btn btn-success btn-xm" title="create">
   Új post feltöltése
 </a>     
    <div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr>
             <th>id</th> <th>Kategoria</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['list'] as $item)
            <tr>

                <td>{{ $item->id}}</td>   
                <td>{{ $item->name}}</td>  
            <td>
            @if($item->pub==0)
                <a href="/manager/categori/unpub/{{$item->id}} "
                class="btn btn-light btn-xs" style="color:green; font-size:1.5em;" title="unPub">
                <i class="fas fa-toggle-on"></i>
                </a>         
            @elseif($item->pub==1)
                <a href="/manager/categori/pub/{{$item->id}} "        
                class="btn btn-light btn-xs" style="color:grey; font-size:1.5em;"  title="pub">
                <i class="fas fa-toggle-off"></i>
                </a>
          
            @endif   
            </td>
       
            <td>
            <a href="/manager/categori/{{$item->id}}/edit "
                class="btn btn-primary btn-xs" title="edit">
                <i class="far fa-edit"></i>
                </a>
                <a href="/manager/categori/del/{{$item->id}} "
                    class="btn btn-danger btn-xs" title="delete">
                    <i class="far fa-trash-alt"></i>
                    </a>
          
        </td>
            </tr>
            
        @endforeach
        </tbody>
    </table>
    </div>
    <div class="pagination"> {!! $data['list']->appends(['search' => Request::get('search')])->render() !!} </div>
@endsection

