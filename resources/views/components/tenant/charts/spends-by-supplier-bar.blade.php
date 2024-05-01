<div class="col-12 col-lg-6 d-flex">
	<div class="card flex-fill w-100">
		<div class="card-header">
			<h5 class="card-title">Supplier Spends</h5>
			<h6 class="card-subtitle text-muted">Top 10 Active Suppliers Overall Spends.</h6>
		</div>
		<div class="card-body d-flex w-100">
			<div class="align-self-center chart">
				<canvas id="chartjs-spends-by-supplier-bar"></canvas>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Bar chart
		new Chart(document.getElementById("chartjs-spends-by-supplier-bar"), {
			type: "bar",
			data: {
				labels: {!! json_encode($supplier_labels) !!},
				datasets: [{
					label: "Budget",
					backgroundColor: "#dc0ab4",
					borderColor: "#dc0ab4",
					hoverBackgroundColor: "#dc0ab4",
					hoverBorderColor: "#dc0ab4",
					data: {!! json_encode($budget) !!},
				}, {
					label: "PR",
					backgroundColor: "#0bb4ff",
					borderColor: "#0bb4ff",
					hoverBackgroundColor: "#0bb4ff",
					hoverBorderColor: "#0bb4ff",
					data: {!! json_encode($amount_pr) !!},
				}, {
					label: "PO",
					backgroundColor: "#50e991",
					borderColor: "#50e991",
					hoverBackgroundColor: "#50e991",
					hoverBorderColor: "#50e991",
					data: {!! json_encode($amount_po) !!},
				}, {
					label: "GRS",
					backgroundColor: "#e6d800",
					borderColor: "#e6d800",
					hoverBackgroundColor: "#e6d800",
					hoverBorderColor: "#e6d800",
					data: {!! json_encode($amount_grs) !!},
				}, {
					label: "Invoice",
					backgroundColor: "#9b19f5",
					borderColor: "#9b19f5",
					hoverBackgroundColor: "#9b19f5",
					hoverBorderColor: "#9b19f5",
					data: {!! json_encode($amount_invoice) !!},
				}, {
					label: "Payment",
					backgroundColor: "#00bfa0",
					borderColor: "#00bfa0",
					hoverBackgroundColor: "#00bfa0",
					hoverBorderColor: "#00bfa0",
					data: {!! json_encode($amount_payment) !!},
				}]
			},
			options: {
				maintainAspectRatio: false,
				cornerRadius: 15,
				responsive: true,
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