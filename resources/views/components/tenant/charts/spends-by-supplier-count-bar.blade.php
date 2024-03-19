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
			<h5 class="card-title">Supplier Spends Count</h5>
			<h6 class="card-subtitle text-muted">Document Count for Top 10 Active Supplier Spends.</h6>
		</div>
		<div class="card-body d-flex w-100">
			<div class="align-self-center chart">
				<canvas id="chartjs-spends-by-supplier-count-bar"></canvas>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Bar chart
		new Chart(document.getElementById("chartjs-spends-by-supplier-count-bar"), {
			type: "bar",
			data: {
				labels: {!! json_encode($supplier_labels) !!},
				datasets: [{
					label: "PR",
					backgroundColor: "#22a7f0",
					borderColor: "#22a7f0",
					hoverBackgroundColor: "#22a7f0",
					hoverBorderColor: "#22a7f0",
					data: {!! json_encode($count_pr) !!},
				}, {
					label: "PO",
					backgroundColor: "#63bff0",
					borderColor: "#63bff0",
					hoverBackgroundColor: "#63bff0",
					hoverBorderColor: "#63bff0",
					data: {!! json_encode($count_po) !!},
				}, {
					label: "GRS",
					backgroundColor:   "#a7d5ed",
					borderColor:   "#a7d5ed",
					hoverBackgroundColor:   "#a7d5ed",
					hoverBorderColor:   "#a7d5ed",
					data: {!! json_encode($count_grs) !!},
				}, {
					label: "Invoice",
					backgroundColor: "#e1a692",
					borderColor: "#e1a692",
					hoverBackgroundColor: "#e1a692",
					hoverBorderColor: "#e1a692",
					data: {!! json_encode($count_invoice) !!},
				}, {
					label: "Payment",
					backgroundColor:  "#de6e56",
					borderColor:  "#de6e56",
					hoverBackgroundColor:  "#de6e56",
					hoverBorderColor:  "#de6e56",
					data: {!! json_encode($count_payment) !!},
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
                        min: 0,
						min: 50,
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