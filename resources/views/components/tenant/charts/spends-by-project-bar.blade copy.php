<div class="col-12 col-lg-6 d-flex">
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
			<h5 class="card-title">Project Spends</h5>
			<h6 class="card-subtitle text-muted">Top 10 Active Project Spends.</h6>
		</div>
		<div class="card-body d-flex w-100">
			<div class="align-self-center chart">
				<canvas id="chartjs-spends-by-project-bar"></canvas>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Bar chart
		new Chart(document.getElementById("chartjs-spends-by-project-bar"), {
			type: "bar",
			data: {
				labels: {!! json_encode($project_labels) !!},
				datasets: [{
					label: "Budget",
					backgroundColor: window.theme.primary,
					borderColor: window.theme.primary,
					hoverBackgroundColor: window.theme.primary,
					hoverBorderColor: window.theme.primary,
					data: {!! json_encode($budget) !!},
				}, {
					label: "PR",
					backgroundColor: "#0d88e6",
					borderColor: "#0d88e6",
					hoverBackgroundColor: "#0d88e6",
					hoverBorderColor: "#0d88e6",
					data: {!! json_encode($amount_pr) !!},
				}, {
					label: "PO",
					backgroundColor: "#00b7c7",
					borderColor: "#00b7c7",
					hoverBackgroundColor: "#00b7c7",
					hoverBorderColor: "#00b7c7",
					data: {!! json_encode($amount_po) !!},
				}, {
					label: "GRS",
					backgroundColor: "#5ad45a",
					borderColor: "#5ad45a",
					hoverBackgroundColor: "#5ad45a",
					hoverBorderColor: "#5ad45a",
					data: {!! json_encode($amount_grs) !!},
				}, {
					label: "Invoice",
					backgroundColor: "#4421af",
					borderColor: "#4421af",
					hoverBackgroundColor: "#4421af",
					hoverBorderColor: "#4421af",
					data: {!! json_encode($amount_invoice) !!},
				}, {
					label: "Payment",
					backgroundColor:  "#7c1158",
					borderColor:  "#7c1158",
					hoverBackgroundColor:  "#7c1158",
					hoverBorderColor:  "#7c1158",
					data: {!! json_encode($amount_payment) !!},
				}]
			},
			options: {
				maintainAspectRatio: false,
				cornerRadius: 15,
				legend: {
					display: true
				},
				scales: {
					yAxes: [{
						gridLines: {
							display: false
						},
						ticks: {
							stepSize: 20000
						},
						stacked: false,
					}],
					xAxes: [{
						gridLines: {
							color: "transparent"
						},
						stacked: false,
						categoryPercentage: .9,
            			barPercentage: .9
					}]
				}
			}
		});
	});
</script>