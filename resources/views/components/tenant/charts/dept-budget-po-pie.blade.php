<div class="col-12 col-lg-6 col-xl-4 d-flex">
	<div class="card flex-fill w-100">
		<div class="card-header">
			<div class="card-actions float-end">
				<div class="dropdown position-relative">
					<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
						<i class="align-middle" data-feather="more-horizontal"></i>
					</a>

					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</div>
			</div>
			<h5 class="card-title">{{ $deptBudget->dept->name }} Budget {{ $deptBudget->budget->fy }} : Purchase Order</h5>
			{{-- <h5 class="card-title">Purchase Order {{ $deptBudget->id }} {{ $dbid}}</h5> --}}
		</div>
		<div class="card-body d-flex">
			<div class="align-self-center w-100">
				<div class="py-3">
					<div class="chart chart-xs">
						<canvas id="chartjs-dept-budget-po-pie"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Pie chart
		new Chart(document.getElementById("chartjs-dept-budget-po-pie"), {
			type: "pie",
			data: {
				labels: {!! json_encode($budget_labels) !!},
				datasets: [{
					data: {!! json_encode($budget_data) !!},
					backgroundColor: {!! json_encode($budget_colors) !!},
					// backgroundColor: [
					// 	window.theme.primary,
					// 	window.theme.warning,
					// 	window.theme.danger,
					// 	"#E8EAED"
					// ],
					borderWidth: 5,
					borderColor: window.theme.white
				}]
			},
			options: {
				responsive: !window.MSInputMethodContext,
				maintainAspectRatio: true,
				cutoutPercentage: 50,
				legend: {
					position: "bottom",
					display: true
				}
			}
		});
	});
</script>