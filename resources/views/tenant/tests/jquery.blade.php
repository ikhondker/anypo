<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Raw JQuery Test</title>

	<!-- Scripts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script> --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>



</head>
<body>

	<a href="ajax.html" rel="modal:open">example</a>

	<div id="ex1" class="modal">
		<p>Thanks for clicking. That felt good.</p>
		<a href="#" rel="modal:close">Close</a>
	 </div>

	 <!-- Link to open the modal -->
	<p><a href="#ex1" rel="modal:open">Open Modal</a></p>
	<form action="">
		social
		<input type="text" name="social-insurance" data-mask="000 000 000" />
		<br>
		<input data-inputmask = " 'mask' : '000,000.00'" />
		<br>
		<div class="mb-3">
			<br>
			<label>Money</label>
			<input type="text" class="form-control" data-mask="000.000.000.000.000,00" data-reverse="true">
			<span class="font-13 text-muted">e.g "Your money"</span>
		</div>
		<br>
		<input type="text" class="form-control" data-mask="000.000.000.000.000,00" data-reverse="true">
	</form>

	<div id="app">
		<main class="container">
			<h1> How to Install JQuery in Laravel 10? OK</h1>

			<button class="btn btn-success">Click Me</button>
		</main>
	</div>
</body>
<script type="module">
		// $(document).ready(function() {
		// 	$(":input").inputmask();
		// });
	</script>
	<script>
		$("button").click(function(){
			alert("Thanks");
		});
	</script>
</html>
