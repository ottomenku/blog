
@extends('Bootstrap3.dashgum.backend')
@section('content')
     
<center><h3>Kategória feltöltés</h3></center>     
     {!! Form::model($data, [
        'method' => 'POSt',
        'url' =>['manager/categori/'] ,
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

    @include('Bootstrap3.includes.blog.categori.form')
    
@endsection
