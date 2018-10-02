@extends('libro.base')
@section('content')

@foreach ($data['posts'] as $post)   
<div class="col-md-6">
    <div class="blog-entry ftco-animate">
<a href="/home/{{$post['id']}}" class="blog-image">
  <img src="{{$post['image']}}" class="img-fluid" alt="">
</a>
<div class="text py-4">
<div class="meta">
  <div><a href="#">July 29, 2018</a></div>
  <div><a href="#">Admin</a></div>
</div>
<h3 class="heading"><a href="/home/{{$post['id']}}">{{$post['cim']}}</a></h3>
<p>{{$post['intro']}}</p>
</div>
</div>    
</div>
@endforeach

@endsection