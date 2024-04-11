<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<title>{{ config('app.name', 'Laravel') }}</title>
  
	<!-- Scripts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

	
</head>
<body>

	<a href="ajax.html" rel="modal:open">example</a>
	
	<div id="ex1" class="modal">
		<p>Thanks for clicking. That felt good.</p>
		<a href="#" rel="modal:close">Close</a>
	 </div>
	  
	 <!-- Link to open the modal -->
	<p><a href="#ex1" rel="modal:open">Open Modal</a></p>

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