@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-primary">
        <div class="panel-heading">New params of request</div>
          <div class="panel-body">
          {!! Form::open(['url' => 'apidoc/params']) !!}
              <!-- <label>request_doc_id</label>{!! Form::number('request_doc_id', null, ['class' => 'form-control', 'placeholder' => '']) !!}<br/> -->
              <label>name_parameter</label>{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) !!}<br/>
              <label>type_parameter</label>{!! Form::text('type', null, ['class' => 'form-control', 'placeholder' => '']) !!}<br/>
              <label>position_parameter</label>{!! Form::text('position', null, ['class' => 'form-control', 'placeholder' => '']) !!}<br/>
              <label>description_parameter</label>{!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => '']) !!}<br/>
              <label>required</label>{!! Form::checkbox('required', '1' ); !!}<br/>
              <label>not required</label>{!! Form::checkbox('required', '0' ); !!}<br/>
              {!! Form::hidden('requestdocId', $requestdocId ); !!}
            {!! Form::submit('Envoyer !', ['class' => 'btn btn-success pull-right']) !!}<br/>
          {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>
<script>

  function selectcolour() {
    var methodSelected = document.getElementById('selectMethod').value;
    console.log('ver 1.5');
    console.log('value = '+ methodSelected);
    var colour;
    colour = methodSelected=='GET' ? document.getElementById('selectColour').value = 'success' : '';
    colour = methodSelected=='POST' ? document.getElementById('selectColour').value = 'primary' : '';
    colour = methodSelected=='PUT' ? document.getElementById('selectColour').value = 'warning' : '';
    colour = methodSelected=='DELETE' ? document.getElementById('selectColour').value = 'danger' : '';
    
  }
</script>
@endsection