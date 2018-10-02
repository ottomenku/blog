
<div class="row"> 

    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Cím:', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-9">
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
     
    </div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Feltöltés', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
</div>
</form>



