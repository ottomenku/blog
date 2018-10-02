@extends('Bootstrap3.dashgum.backend')
@section('content')

<center><h3>Kategória szerkesztés</h3></center>   
     {!! Form::model($data, [
        'method' => 'PATCH',
        'url' =>['manager/categori/'.$data->id] ,
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

    @include('Bootstrap3.includes.blog.post.form')

@endsection