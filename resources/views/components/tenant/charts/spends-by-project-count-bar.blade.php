<div class="col-12 col-lg-6 d-flex">
	<div class="card flex-fill w-100">
		<div class="card-header">
			<h5 class="card-title">Project Document Count</h5>
			<h6 class="card-subtitle text-muted">Project Document Counts for Top 10 Open Projects.</h6>
		</div>
		<div class="card-body d-flex w-100">
			<div class="align-self-center chart">
				<canvas id="chartjs-spends-by-project-count-bar"></canvas>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Bar chart
		new Chart(document.getElementById("chartjs-spends-by-project-count-bar"), {
			type: "bar",
			data: {
				labels: {!! json_encode($project_labels) !!},
				datasets: [{
					label: "PR",
					backgroundColor: "#dc0ab4",
					borderColor: "#dc0ab4",
					hoverBackgroundColor: "#dc0ab4",
					hoverBorderColor: "#dc0ab4",
					data: {!! json_encode($count_pr) !!},
				}, {
					label: "PO",
					backgroundColor: "#0bb4ff",
					borderColor: "#0bb4ff",
					hoverBackgroundColor: "#0bb4ff",
					hoverBorderColor: "#0bb4ff",
					data: {!! json_encode($count_po) !!},
				}, {
					label: "GRS",
					backgroundColor: "#50e991",
					borderColor: "#50e991",
					hoverBackgroundColor: "#50e991",
					hoverBorderColor: "#50e991",
					data: {!! json_encode($count_grs) !!},
				}, {
					label: "Invoice",
					backgroundColor: "#9b19f5",
					borderColor: "#9b19f5",
					hoverBackgroundColor: "#9b19f5",
					hoverBorderColor: "#9b19f5",
					data: {!! json_encode($count_invoice) !!},
				}, {
					label: "Payment",
					backgroundColor: "#00bfa0",
					borderColor: "#00bfa0",
					hoverBackgroundColor: "#00bfa0",
					hoverBorderColor: "#00bfa0",
					data: {!! json_encode($count_payment) !!},
				}]
			},
			options: {
				maintainAspectRatio: false,
				responsive: true,
				cornerRadius: 15,
				borderRadius: 3,
				scales: {
					x: {
						grid: {
							offset: true,
							stacked: true,
						}
					},
					y: {
						beginAtZero: true,
					}
				},
				plugins: {
					legend: {
						position: 'bottom',
					},
					title: {
						display: false,
						text: 'Chart.js Pie Chart'
					}
				}
			}
		});
	});
</script>
