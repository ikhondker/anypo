<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>LANDLORD | sweet alert2</title>

		<!-- Fonts -->
		<link rel="dns-prefetch" href="//fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

		<!-- Scripts -->
		@vite(['resources/sass/app.scss', 'resources/js/app.js'])

		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css">

		{{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"
			integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
			crossorigin="anonymous">
		</script> --}}

		<script type="module">

				$('button').click(function(){
							Swal.fire({
								title: 'Are you sure?',
								text: "You won't be able to revert this!",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Yes, delete it!'
							}).then((result) => {
								if (result.isConfirmed) {
									Swal.fire(
										'Deleted!',
										'Your file has been deleted.',
										'success'
									)
								}
							});
				});

		</script>

</head>
<body>
		<div id="app">

				<main class="container">
						<h1> How To Install Sweetalert2 in Laravel? - ItSolutionstuiff.com</h1>

						<button class="btn btn-success">Click Me</button>
				</main>
		</div>

</body>
</html>
