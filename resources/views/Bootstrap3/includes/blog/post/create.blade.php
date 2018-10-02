
@extends('Bootstrap3.dashgum.backend')
@section('content')
     
<center><h3>Post feltöltés</h3></center>     
     {!! Form::model($data, [
        'method' => 'POSt',
        'url' =>['manager/posts/'] ,
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

    @include('Bootstrap3.includes.blog.post.form')
    
@endsection
