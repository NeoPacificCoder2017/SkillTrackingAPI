<!doctype html>
<html lang="en">
  <head>
    <title>Skillstracking | API Documentation</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/linearicons/style.css') }}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
  </head>
  <body>
    <!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{ url('apidocs') }}"><img src="{{ asset('img/logo.png') }}" alt="Skills Tracking" class="img-responsive logo"></a>
				</div>
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<a type="button" class="btn btn-primary btn-lg navbar-btn pull-right" href="{{ url('apidoc/create') }}"><i class="lnr lnr-plus-circle"></i> Nouvelle Requête</a>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="{{ url('apidocs') }}" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						@foreach($userTypes as $userType)
            <li>
							<a href="#{{ $userType['user_type'] }}" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i><span>{{ $userType['user_type'] }}</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="{{ $userType['user_type'] }}" class="collapse ">
								<ul class="nav">
								@foreach($userType['requests'] as $request)
									<li><a href="#{{ $request->id }}" onclick="showselected( {{ $request->id }} );" class="menuitem" data-id="request{{ $request->id }}">{{ $request->title }} &nbsp; <span class="label label-{{ $request->color }}">{{ $request->method }}</span></a></li>
								@endforeach
								</ul>
							</div>
						</li>
						@endforeach
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
          @yield('content')
        </div>
      </div>
      <div class="clearfix"></div>
      <footer style="position: fixed;">
        <div class="container-fluid">
          <p class="copyright">&copy; 2018 <a href="https://www.cnam-polynesie.com" target="_blank">CNAM polynésie</a>. All Rights Reserved.</p>
        </div>
		  </footer>
    </div>
  </body>
</html>
