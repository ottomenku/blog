

 {!! Form::hidden('worker_id', $data['worker_id']) !!}



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
<div class="form-group {{ $errors->has('workernote') ? 'has-error' : ''}}">
    {!! Form::label('workernote', 'Megjegyzés', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('workernote', null, ['class' => 'form-control']) !!}
        {!! $errors->first('workernote', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
