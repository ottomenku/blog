
@extends('Bootstrap3.dashgum.backend') 
@section('content')
<!-- path:Bootstrap3.dashgum.crudbase name:base -->
@php 

if(!isset($data)) {$data=[];}
if(!isset($controllerParam)) {$controllerParam=[];} // a controllertől kapott view paraméterek.

// a viewtasknak megfelelő alap paraméterek betöltése ($baseViewparam)
@endphp


@include('Bootstrap3.dashgum.sidebar')

<section id="main-content">
       
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12 main-chart">
                <div class="panel panel-default">

                    <div class="panel-heading">

                            {!! $controllerParam['cim'] or ''!!} 

@foreach($contentbuild['items'] as $contentItem) 
include($contentbuild['path'],)
@endforeach                     

                    </div>
                </div>
            </div>
        </div>

    </section>
</section>
@endsection