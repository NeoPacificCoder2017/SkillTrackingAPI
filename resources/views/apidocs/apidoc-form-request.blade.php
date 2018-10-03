@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-primary">
        <div class="panel-heading">New request</div>
          <div class="panel-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          {!! Form::open(['url' => 'apidoc/request']) !!}
              <label>Title</label>{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => '']) !!}<br/>
              <label>Url</label>{!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => '']) !!}<br/>
              <label>Methode</label>
                <select class="form-control" name="method" id="selectMethod" onchange="selectcolour();">
                  <option value="" disabled selected>Choisir une méthode</option>
                  <option value="GET">GET</option>
                  <option value="POST">POST</option>
                  <option value="PUT">PUT</option>
                  <option value="DELETE">DELETE</option>
                </select><br/>
              <label>Réponse</label>{!! Form::textarea('response', null, ['class' => 'form-control', 'placeholder' => '']) !!}<br/>
              <label>Type d'utilisateur</label>{!! Form::select('user_type_id', array('1' => 'Admin', '2' => 'Teacher', '3' => 'Student'), null, ['class' => 'form-control', 'placeholder' => 'Selectionner un type utilisateur']) !!}<br/>
              <label>Description du paramètre</label>{!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => '']) !!}<br/>
                <select style="display:none" class="form-control" name="color" id="selectColour">
                <option value="success">success</option>
                <option value="primary">primary</option>
                <option value="warning">warning</option>
                <option value="danger">danger</option>
                </select><br/>
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