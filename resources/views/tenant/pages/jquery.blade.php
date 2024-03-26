<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<title>{{ config('app.name', 'Laravel') }}</title>
  
	<!-- Scripts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  
</head>
<body>
	<div id="app">
  
		<main class="container">
			<h1> How to Install JQuery in Laravel 10? OK</h1>
			
			<button class="btn btn-success">Click Me</button>
		</main>
	</div>
  
</body>
	<script>
		$("button").click(function(){
			alert("Thanks");
		});
	</script>
</html>	