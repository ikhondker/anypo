@extends('layouts.tenant-jquery')
{{-- @extends('layouts.tenant.app') --}}
@section('title','JQuery in Laravel 10 | TENANT')

@section('content')

<div id="ex1" class="modal">
	<p>Thanks for clicking. That felt good.</p>
	<a href="#" rel="modal:close">Close</a>
 </div>
 <!-- Link to open the modal -->
<p><a href="#ex1" rel="modal:open">Open Modal</a></p>


<div id="app">
 
	<main class="container">
		<h1> IQBAL JQuery in Laravel 10? TENANT</h1>
		
		<button class="btn btn-success">Click Me</button>
	</main>
</div>

<div id="app">
 
	<main class="container">
		<h1> How To Install Sweetalert2 in Laravel? - ItSolutionstuiff.com TENANT</h1>
		
		<button class="btn btn-success">Click Me</button>
	</main>
</div>

<div id="app1">
<p class="zoomable">
	Click me to zoom TENANT
</p>
</div>


<div class="mb-3 row">
	<label class="col-form-label col-sm-2 text-sm-right">Dept Name</label>
	<div class="col-sm-10">
		<select class="form-control select2" data-toggle="select2" name="dept_id" required>
			<option value=""><< Dept >> </option>
				<option value="1" >11111</option>
				<option value="2" >21111</option>
				<option value="3" >31111</option>
				<option value="4" >41111</option>
		</select>
	</div>
</div>
<div class="col-auto ms-auto text-end mt-n1">
	<div class="dropdown me-2 d-inline-block position-relative">
		<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-lucide="calendar"></i> Today
		</a> 

		<div class="dropdown-menu dropdown-menu-end">
			<h6 class="dropdown-header">Settings</h6>
			<a class="dropdown-item" href="#">Action</a>
			<a class="dropdown-item" href="#">Another action</a>
			<a class="dropdown-item" href="#">Something else here</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Separated link</a>
		</div>
	</div>
</div>

{{--Test Bootstrap css--}}
<div class="alert alert-success mt-5" role="alert">
	Boostrap 5 is working using laravel 8 mix!
</div>



{{--popper.js HTML example--}}
<button id="button" aria-describedby="tooltip">My button</button>

<button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">
	Tooltip on top
</button>
<button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Tooltip on right">
	Tooltip on right
</button>
<button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Tooltip on bottom">
	Tooltip on bottom
</button>
<button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Tooltip on left">
	Tooltip on left
</button>

<div id="app">
	<main class="container">
		<h1> How to Install JQuery UI in Laravel? - ItSolutionstuiff.com</h1>

		<input type="text" class="datepicker" name="date">
	</main>
</div>


<div style="width: 600px; margin: auto;">
	<canvas id="chartjs-bar"></canvas>
</div>


<script type="module">
		
		document.addEventListener("DOMContentLoaded", function() {

			new Chart(document.getElementById("chartjs-bar"), {
				type: 'bar',
				data: {
				labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
				datasets: [
					{
					label: "Population (millions)",
					backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
					data: [2478,5267,734,784,433]
					}
				]
				},
				options: {
				legend: { display: false },
				title: {
					display: true,
					text: 'Predicted world population (millions) in 2050'
				}
				}
			});

			// Bar chart
			
		});
</script>

<script type="module">
	$(document).ready(function(){
		$(".zoomable").click(function(){
			$(this).animate({
				fontSize: "40px"
			}, 1000);
		});
	});
</script>

{{-- OK WORKS--}}
{{-- <script type="module">
	$("button").click(function(){
		alert("Thanks");
	});
</script> --}}

<script type="module">
	$(document).ready(function() {
		$("button").click(function(){
			alert("Thanks");
		});
	});
</script>

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


<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Select2
		$(".select2").each(function() {
			$(this)
				.wrap("<div class=\"position-relative\"></div>")
				.select2({
					placeholder: "<< Select >>",
					dropdownParent: $(this).parent()
				});
		})
	});
</script>

@endsection
