@extends('Bootstrap3.dashgum.backend')
@section('content')

<center><h3>Post szerkesztés</h3></center>   
     {!! Form::model($data, [
        'method' => 'PATCH',
        'url' =>['manager/posts/'.$data->id] ,
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

    @include('Bootstrap3.includes.blog.post.form')

@endsection