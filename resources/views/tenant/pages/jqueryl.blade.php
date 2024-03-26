@extends('layouts.tenant-jquery')
@section('title','JQuery in Laravel 10 | TENANT')

@section('content')

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


<div style="width: 600px; margin: auto;">
    <canvas id="chartjs-bar"></canvas>
</div>


<script type="module">
		
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-bar"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Last year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}, {
						label: "This year",
						backgroundColor: "#E8EAED",
						borderColor: "#E8EAED",
						hoverBackgroundColor: "#E8EAED",
						hoverBorderColor: "#E8EAED",
						data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
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
