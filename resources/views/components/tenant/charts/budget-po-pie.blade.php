<div class="col-12 col-lg-6 col-xl-4 d-flex">
	<div class="card flex-fill w-100">
		<div class="card-header">
			<div class="card-actions float-end">
				<div class="dropdown position-relative">
					<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
						<i class="align-middle" data-lucide="more-horizontal"></i>
					</a>

					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="{{ route('budgets.index') }}"><i class="align-middle me-1" data-lucide="eye"></i>View Company Budgets</a>
						<a class="dropdown-item" href="{{ route('dept-budgets.index') }}"><i class="align-middle me-1" data-lucide="eye"></i>View Dept Budgets</a>
						<a class="dropdown-item" href="{{ route('projects.index') }}"><i class="align-middle me-1" data-lucide="eye"></i>View Project Spends</a>
						<a class="dropdown-item" href="{{ route('suppliers.index') }}"><i class="align-middle me-1" data-lucide="eye"></i>View Supplier Spends</a>
					</div>
				</div>
			</div>
			<h5 class="card-title">FY{{ $budget->fy }} : PO Budget Status</h5>
			<h6 class="card-subtitle text-muted">Utilized and Available Budget of an year.</h6>
		</div>
		<div class="card-body d-flex">
			<div class="align-self-center w-100">
				<div class="py-3">
					<div class="chart chart-xs">
						<canvas id="chartjs-budget-po-pie"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Pie chart
		new Chart(document.getElementById("chartjs-budget-po-pie"), {
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
					//borderColor: window.theme.white
				}]
			},

			options: {
				responsive: true,
				plugins: {
					legend: {
						position: 'bottom',
					},
					title: {
						display: false,
						text: 'Chart.js Pie Chart'
					}
				}
			},

			// options: {
			// 	responsive: !window.MSInputMethodContext,
			// 	maintainAspectRatio: true,
			// 	cutoutPercentage: 50,
			// 	legend: {
			// 		position: "bottom",
			// 		display: true
			// 	}
			// }
		});
	});
</script>
