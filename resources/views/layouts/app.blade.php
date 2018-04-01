<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Encrypted Api demo') }}</title>

	<!-- Styles -->
	<link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div id="app">
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/') }}">
						Encrypted Api demo
					</a>
				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->
					<ul class="nav navbar-nav">
						<li{!! isset($activeTab) && $activeTab == 'home' ? ' class="active"' : '' !!}><a href="{{ route('home') }}">Home</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<ul class="nav nav-pills nav-stacked">
						<li role="presentation"{!! isset($activeTab) && $activeTab == 'home' ? ' class="active"' : '' !!}><a href="{{ route('home') }}">Home</a></li>
						@php($lastType = null)
						@foreach ($demos as $number => $demo)
							@if ($lastType !== $demo['type'])
								<li class="divider"><hr></li>
								@php($lastType = $demo['type'])
							@endif
							<li role="presentation"{!! isset($activeTab) && $activeTab == 'demo-' . $number ? ' class="active"' : '' !!}><a href="{{ route('demo', $number) }}">{{ $demo['description'] }}</a></li>
						@endforeach
					</ul>
				</div>
				<div class="col-md-9">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if (Session::has('success'))
						<div class="alert alert-success">
							{{ Session::get('success') }}
						</div>
					@endif

					@if (Session::has('warning'))
						<div class="alert alert-warning">
							{{ Session::get('warning') }}
						</div>
					@endif

					@if (Session::has('error'))
						<div class="alert alert-danger">
							{{ Session::get('error') }}
						</div>
					@endif

					@yield('content')
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script src="{{ mix('js/app.js') }}"></script>
	@yield('scripts')
</body>
</html>
