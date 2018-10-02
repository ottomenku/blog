


  
<script type="application/javascript">

    function  changeImage(ob){
            jQuery('#avatar').attr('src', ob.src);
            jQuery('#image').val(ob.src);
            }
</script>  



<div class="row"> 

    <div class="form-group {{ $errors->has('intro') ? 'has-error' : ''}}">
        {!! Form::label('cim', 'Cím:', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-9">
            {!! Form::text('cim', null, ['class' => 'form-control']) !!}
            {!! $errors->first('cim', '<p class="help-block">:message</p>') !!}
        </div>
     
    </div>



<div class="form-group {{ $errors->has('categori_id') ? 'has-error' : ''}}">
        {!! Form::label('categori_id', 'Kategória:', ['class' => 'col-md-1 control-label']) !!}
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
            <img  width="40px" height="40px" id="avatar" src="{{$data['image']}}" />

            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal2">
                   Kép választás
                  </button>
    </div>



<div class="form-group {{ $errors->has('intro') ? 'has-error' : ''}}">
    {!! Form::label('intro', 'Intro:', ['class' => 'col-md-1 control-label']) !!}
    <div class="col-md-11">
        {!! Form::text('intro', null, ['class' => 'form-control']) !!}
        {!! $errors->first('intro', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ptext') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::textarea('ptext', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('ptext', '<p class="help-block">:message</p>') !!}
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


