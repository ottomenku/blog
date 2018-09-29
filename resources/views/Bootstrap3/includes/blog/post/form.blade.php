
@extends('Bootstrap3.dashgum.backend')
@section('content')


<center><h3>Post feltöltés</h3></center>

        {!! Form::model($data, [
            'method' => 'PATCH',
            'url' =>['manager/posts/'] ,
            'class' => 'form-horizontal',
            'files' => true
        ]) !!}

<div class="row"> 

    <div class="form-group {{ $errors->has('intro') ? 'has-error' : ''}}">
        {!! Form::label('cim', 'Cím', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-9">
            {!! Form::text('cim', null, ['class' => 'form-control']) !!}
            {!! $errors->first('cim', '<p class="help-block">:message</p>') !!}
        </div>
        {!! Form::label('pub', 'Publikál', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-1" >      
                {!! Form::checkbox('pub', null, [ 'height'=>'35px']) !!}
                {!! $errors->first('pub', '<p class="help-block">:message</p>') !!}
            </div>
    </div>



<div class="form-group {{ $errors->has('categori_id') ? 'has-error' : ''}}">
        {!! Form::label('categori_id', 'Kategória', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-3">   
        {!! Form::select('categori_id', $data['categori'], null, ['class' => 'form-control', 'required' => 'required']) !!} 
        {!! $errors->first('categori_id', '<p class="help-block">:message</p>') !!}
    </div>

        {!! Form::label('image', 'kép', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-3">
                {!! Form::text('image', null, ['class' => 'form-control ']) !!}
                {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
        </div>
    <divclass="col-md-2" >
            <img class="img-circle" id="avatar" src="/avatar.png" />

            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
                    Edit Image
                  </button>
    </div>



<div class="form-group {{ $errors->has('intro') ? 'has-error' : ''}}">
    {!! Form::label('intro', 'Intro', ['class' => 'col-md-1 control-label']) !!}
    <div class="col-md-11">
        {!! Form::text('intro', null, ['class' => 'form-control']) !!}
        {!! $errors->first('intro', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ptext') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::textarea('ptext', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('managernote', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Feltöltés', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
</div>
</form>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title" id="myModalLabel"> Media Manager</h4>
            </div>
            <div class="modal-body">
            
                  <div class="laradrop" laradrop-csrf-token="{{ csrf_token() }}" ></div>
              
                  <div class="clearfix"></div>
                  
            </div>
          </div>
        </div>
      </div> 


@endsection