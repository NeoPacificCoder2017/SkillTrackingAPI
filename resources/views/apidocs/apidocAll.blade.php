@extends('layouts.apidocs')

@section('content')
@foreach($userTypes as $userType)
  @foreach($userType['requests'] as $request)
    <div id="request{{ $request->id }}" class="requesthideandshow">
      <h3 class="page-title">{{ $request->method }}</h3>
      <h4 class="page-title">{{ $request->description }}</h4>
      <div class="row">
        <div class="col-md-7">
          <!-- TABLE HOVER -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Url</h3>
            </div>
            <div class="panel-body">
              {{ $request->url }}
            </div>
          </div>
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Header</h3>
            </div>
            <div class="panel-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Parameter</th>
                    <th>Key</th>
                    <th>value</th>
                    <th>#</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Authorization</td>
                    <td><code>string</code></td>
                    <td><code>Header</code></td>
                    <td><code>Required</code></td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </td>
                  </tr>
                  <tr>
                    <td>username</td>
                    <td><code>string</code></td>
                    <td><code>Body</code></td>
                    <td><code>Required</code></td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec venenatis est. Aliquam scelerisque bibendum volutpat. Donec vehicula tincidunt arcu, nec pellentesque neque dignissim eu. </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="panel requesthideandshow showTable">
            <div class="panel-heading">
              <h3 class="panel-title">Request-{{ $request->id }}</h3>
              <div class="pull right">
                <a href="{{ url('apidoc/create/parameter/'.$request->id) }}" class="btn btn-primary navbar-btn pull-right"><i class="lnr lnr-plus-circle"> Nouveau Paramètre</i></a>
              </div>
            </div>
            <div class="panel-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Parameter</th>
                    <th>Key</th>
                    <th>value</th>
                    <th>#</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($parameterRequests as $parameter)
                    @foreach($parameter['parameterR'] as $parameterRequest)
                      
                        <tr class="parameterRequest{{ $parameterRequest->request_doc_id }} requesthideandshow">
                          <td>{{ $parameterRequest->name }}</td>
                          <td><code>{{ $parameterRequest->type }}</code></td>
                          <td><code>{{ $parameterRequest->position }}</code></td>
                          <td><code>{{ $parameterRequest->required }}</code></td>
                          <td>{{ $parameterRequest->description }}</td>
                        </tr>
                      
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- END TABLE HOVER -->
        </div>
        <div class="col-md-5">
          <!-- TABLE HOVER -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Response</h3>
            </div>
            <div class="panel-body">
              <pre>{{ $request->response}}</pre>
            </div>
          </div>
          <!-- END TABLE HOVER -->
        </div>
      </div>
    </div>
  <!-- END MAIN CONTENT -->
  @endforeach
@endforeach

<div id="welcomeScreen">
  <div class="panel">
    <div class="panel-heading">
      <div class="panel-title">
        Welcome everybody !
      </div>
    </div>
  </div>
</div>

  <script>
  $(document).ready(function() {
    $('pre code').each(function(i, block) {
      hljs.highlightBlock(block);
    });
  });</script>

	<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('scripts/klorofil-common.js') }}"></script>
  <script src="{{ asset('vendor/hideandshow.js') }}"></script>
	
@endsection