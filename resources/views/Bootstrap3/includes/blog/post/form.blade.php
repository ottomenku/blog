
@if($data['worker_id']==0)
<div class="form-group {{ $errors->has('worker_id') ? 'has-error' : ''}}">
    {!! Form::label('worker_id', 'Dolgozó választás', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      
          {!! Form::select('worker_id',$data['workers'],
           null, ['class' => 'form-control', 'required' => 'required']) !!}

        {!! $errors->first('worker_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@else                 
{!! Form::hidden('worker_id', $data['worker_id']) !!}
@endif


<div class="form-group {{ $errors->has('daytype_id') ? 'has-error' : ''}}">
    {!! Form::label('daytype_id', 'Naptipus', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      
        {!! Form::select('daytype_id', $data['daytype'], null, ['class' => 'form-control', 'required' => 'required']) !!}
        
         {!! $errors->first('daytype_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if(isset($data['datum']))
{!! Form::hidden('datum', $data['datum']) !!}
@else
<div class="form-group {{ $errors->has('datum') ? 'has-error' : ''}}">
    {!! Form::label('datum', 'Dátum', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('text', 'datum', null, ['class' => 'form-control datepicker', 'required' => 'required']) !!}
        {!! $errors->first('datum', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif
<div class="form-group {{ $errors->has('managernote') ? 'has-error' : ''}}">
    {!! Form::label('managernote', 'Megjegyzés', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('managernote', null, ['class' => 'form-control']) !!}
        {!! $errors->first('managernote', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
