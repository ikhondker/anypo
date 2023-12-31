@extends('layouts.app')

@section('title','Dashboards | anypo.com')
@section('content-header')
	<!-- Null -->
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Dashboard
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="User"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Income</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-feather="shopping-bag"></i>
							</div>
						</div>
					</div>
					<span class="h1 d-inline-block mt-1 mb-3">$37.500</span>
					<div class="mb-0">
						<span class="badge badge-soft-success me-2"> 6.25% </span>
						<span class="text-muted">Since last week</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Orders</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-feather="shopping-cart"></i>
							</div>
						</div>
					</div>
					<span class="h1 d-inline-block mt-1 mb-3">3.282</span>
					<div class="mb-0">
						<span class="badge badge-soft-danger me-2"> -4.65% </span>
						<span class="text-muted">Since last week</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Activity</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-feather="activity"></i>
							</div>
						</div>
					</div>
					<span class="h1 d-inline-block mt-1 mb-3">19.312</span>
					<div class="mb-0">
						<span class="badge badge-soft-success me-2"> 8.35% </span>
						<span class="text-muted">Since last week</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card illustration flex-fill">
				<div class="card-body p-0 d-flex flex-fill">
					<div class="row g-0 w-100">
						<div class="col-6">
							<div class="illustration-text p-3 m-1">
								<h4 class="illustration-text">Welcome Back, Chris!</h4>
								<p class="mb-0">AppStack Dashboard</p>
							</div>
						</div>
						<div class="col-6 align-self-end text-end">
							<img src="{{asset('img/illustrations/social.png')}}" alt="Social" class="img-fluid illustration-img">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
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
					<h5 class="card-title">Languages</h5>
				</div>
				<table class="table table-striped my-0">
					<thead>
						<tr>
							<th>Language</th>
							<th class="text-end">Users</th>
							<th class="d-none d-xl-table-cell w-75">% Users</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>en-us</td>
							<td class="text-end">735</td>
							<td class="d-none d-xl-table-cell">
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" style="width: 43%;" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100">43%</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>en-gb</td>
							<td class="text-end">223</td>
							<td class="d-none d-xl-table-cell">
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" style="width: 27%;" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100">27%</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>fr-fr</td>
							<td class="text-end">181</td>
							<td class="d-none d-xl-table-cell">
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" style="width: 22%;" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100">22%</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>es-es</td>
							<td class="text-end">132</td>
							<td class="d-none d-xl-table-cell">
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" style="width: 16%;" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100">16%</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>de-de</td>
							<td class="text-end">118</td>
							<td class="d-none d-xl-table-cell">
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">15%</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>ru-ru</td>
							<td class="text-end">98</td>
							<td class="d-none d-xl-table-cell">
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" style="width: 13%;" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100">13%</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

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
					<h5 class="card-title">Mobile / Desktop</h5>
				</div>
				<div class="card-body d-flex w-100">
					<div class="align-self-center chart">
						<canvas id="chartjs-dashboard-bar-devices"></canvas>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 col-lg-4 d-flex">
			<div class="card flex-fill">
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
					<h5 class="card-title">Interests</h5>
				</div>
				<div class="card-body">
					<div class="chart">
						<canvas id="chartjs-dashboard-radar"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12 col-lg-6 col-xl-4 d-flex">
			<div class="card flex-fill">
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
					<h5 class="card-title">Calendar</h5>
				</div>
				<div class="card-body d-flex">
					<div class="align-self-center w-100">
						<div class="chart">
							<div id="datetimepicker-dashboard"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-xl-4 d-none d-xl-flex">
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
					<h5 class="card-title">Weekly sales</h5>
				</div>
				<div class="card-body d-flex">
					<div class="align-self-center w-100">
						<div class="py-3">
							<div class="chart chart-xs">
								<canvas id="chartjs-dashboard-pie"></canvas>
							</div>
						</div>

						<table class="table mb-0">
							<thead>
								<tr>
									<th>Source</th>
									<th class="text-end">Revenue</th>
									<th class="text-end">Value</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><i class="fas fa-square-full text-primary"></i> Direct</td>
									<td class="text-end">$ 2602</td>
									<td class="text-end text-success">+43%</td>
								</tr>
								<tr>
									<td><i class="fas fa-square-full text-warning"></i> Affiliate</td>
									<td class="text-end">$ 1253</td>
									<td class="text-end text-success">+13%</td>
								</tr>
								<tr>
									<td><i class="fas fa-square-full text-danger"></i> E-mail</td>
									<td class="text-end">$ 541</td>
									<td class="text-end text-success">+24%</td>
								</tr>
								<tr>
									<td><i class="fas fa-square-full text-dark"></i> Other</td>
									<td class="text-end">$ 1465</td>
									<td class="text-end text-success">+11%</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
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
					<h5 class="card-title">Appointments</h5>
				</div>
				<div class="card-body">
					
				</div>
			</div>
		</div>
	</div>


	

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
				<h5 class="card-title">Empty card Test</h5>
				</div>
				<div class="card-body">

				</div>
			</div>
		</div>
	</div>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Direct", "Affiliate", "E-mail", "Other"],
					datasets: [{
						data: [2602, 1253, 541, 1465],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger,
							"#E8EAED"
						],
						borderWidth: 5,
						borderColor: window.theme.white
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					cutoutPercentage: 70,
					legend: {
						display: false
					}
				}
			});
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar-devices"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Mobile",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .5,
						categoryPercentage: .5
					}, {
						label: "Desktop",
						backgroundColor: window.theme["primary-light"],
						borderColor: window.theme["primary-light"],
						hoverBackgroundColor: window.theme["primary-light"],
						hoverBorderColor: window.theme["primary-light"],
						data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
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
								stepSize: 20
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

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Radar chart
			new Chart(document.getElementById("chartjs-dashboard-radar"), {
				type: "radar",
				data: {
					labels: ["Technology", "Sports", "Media", "Gaming", "Arts"],
					datasets: [{
						label: "Interests",
						backgroundColor: "rgba(0, 123, 255, 0.2)",
						borderColor: "#2979ff",
						pointBackgroundColor: "#2979ff",
						pointBorderColor: "#fff",
						pointHoverBackgroundColor: "#fff",
						pointHoverBorderColor: "#2979ff",
						data: [70, 53, 82, 60, 33]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					}
				}
			});
		});
	</script>
@endsection
