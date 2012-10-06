<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>RestServiceApiDocs</title>
	<meta name="viewport" content="width=device-width">

	{{ HTML::style('bundles/rest_service_api/css/style.css') }}
	{{ HTML::style('bundles/rest_service_api/js/modernizr-2.5.3.min.js') }}
</head>
<body onload="prettyPrint()">
	<div class="wrapper">
		<header>
			<h1>RestServiceApiDocs</h1>
			<h2></h2>

			<p class="intro-text">
			</p>
		</header>
		<div role="main" class="main">
			<aside class="sidebar">
				{{ $sidebar }}
			</aside>
			<div class="content">
				@yield('content')
			</div>
		</div>
	</div>
	{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js') }}
	{{ HTML::script('bundles/rest_service_api/js/prettify.js') }}
	{{ HTML::script('bundles/rest_service_api/js/scroll.js') }}
</body>
</html>