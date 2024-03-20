<div class="col-12 col-lg-4 d-flex">
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
			<h5 class="card-title">FY {{ $budget->fy }}- {{  $budget->name  }} : Dept Wise Purchase Order</h5>
		</div>
		<div class="card-body d-flex w-100">
			<div class="align-self-center chart">
				<canvas id="chartjs-budget-by-dept-po-bar"></canvas>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Bar chart
		new Chart(document.getElementById("chartjs-budget-by-dept-po-bar"), {
			type: "bar",
			data: {
				labels: {!! json_encode($dept_budget_labels) !!},
				datasets: [{
					label: "Budget",
					backgroundColor: window.theme.primary,
					borderColor: window.theme.primary,
					hoverBackgroundColor: window.theme.primary,
					hoverBorderColor: window.theme.primary,
					data: {!! json_encode($dept_budget_amount) !!},
					barPercentage: .5,
					categoryPercentage: .5
				}, {
					label: "PO Issued",
					backgroundColor: window.theme["primary-light"],
					borderColor: window.theme["primary-light"],
					hoverBackgroundColor: window.theme["primary-light"],
					hoverBorderColor: window.theme["primary-light"],
					data: {!! json_encode($dept_budget_po) !!},
					barPercentage: .5,
					categoryPercentage: .5
				}]
			},
			options: {
				maintainAspectRatio: false,
				cornerRadius: 15,
				legend: {
					display: false
				},
				scales: {
					yAxes: [{
						gridLines: {
							display: false
						},
						ticks: {
							stepSize: 40000
						},
						stacked: true,
					}],
					xAxes: [{
						gridLines: {
							color: "transparent"
						},
						stacked: true,
					}]
				}
			}
		});
	});
</script>