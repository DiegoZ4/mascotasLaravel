<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>@yield('title', 'AssistPet') </title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/trumbowyg/dist/ui/trumbowyg.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
</head>
<body>
	@include('public.template.partials.nav')
	
	@yield('body', '')
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugins/trumbowyg/dist/trumbowyg.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>
	@yield('js')
</body>
</html>