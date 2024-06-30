@extends('layouts.tenant.app')
@section('title','Dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Dashboard
		@endslot
		@slot('buttons')
			<x-tenant.actions.dashboard-actions/>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.landlord-notice-all-tenants/>
	<x-tenant.landlord-notice-one-tenant/>

	<div class="row">
		<x-tenant.charts.budget-by-dept-pie/>
		<x-tenant.charts.budget-po-pie/>
		<x-tenant.charts.budget-by-dept-po-bar/>
	</div>

	<x-tenant.dashboards.budget-stat/>
	
	<x-tenant.dashboards.pr-counts/>
		
	<div class="row">
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Budget Utilization (YTD)</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="activity"></i>
							</div>
						</div>
					</div>
					@php
						use App\Models\Tenant\Budget;
						use Illuminate\Database\Eloquent\ModelNotFoundException; 
						try {
							$budget= Budget::where('fy', date('Y') )->get()->firstOrFail();
							// handle division by zero 
							if ( $budget->amount ==0 ){
								$budget_used_pc = 0;
								$budget_amount = 0 ;
								$budget_po = 0;
							} else {
								$budget_used_pc		= $budget->amount_po / $budget->amount * 100;
								$budget_amount		= $budget->amount ;
								$budget_po	= $budget->amount_po ;
							}
						} catch (\Exception $ex) {
							// Error handling code
							$budget_used_pc = 0;
							$budget_amount = 0 ;
							$budget_po = 0;
							
						}
					@endphp
					<span class="h1 d-inline-block mt-1 mb-3">{{ number_format($budget_used_pc, 2) }}%</span>
					<div class="mb-0">
						<span class="badge badge-soft-success me-2">{{ $budget_amount }}</span>
						<span class="text-muted"> total budget for FY{{ date('Y') }}. Utilized {{ $budget_po }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">PO Issued USD (YTD) (TBD)</h5>
						</div>
						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="shopping-bag"></i>
							</div>
						</div>
					</div>
					@php
						use App\Models\Tenant\Pr;
						use Carbon\Carbon;
						$fy = Carbon::now()->format('Y');
						$po_sum= Pr::whereYear('auth_date', '=', $fy)->sum('amount');
						$po_count= Pr::whereYear('auth_date', '=', $fy)->count();
					@endphp
					<span class="h1 d-inline-block mt-1 mb-3">$ {{ number_format($po_sum,2) }}</span>
					<div class="mb-0">
						<span class="badge badge-soft-success me-2">{{ $po_count }}</span>
						<span class="text-muted"> PO issued in FY23</span>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">PR Approved (USD) (YTD)</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="shopping-cart"></i>
							</div>
						</div>
					</div>
					@php
						
						$fy = Carbon::now()->format('Y');
						$pr_sum= Pr::whereYear('auth_date', '=', $fy)->sum('amount');
						$pr_count= Pr::whereYear('auth_date', '=', $fy)->count();
					@endphp
					<span class="h1 d-inline-block mt-1 mb-3">$ {{ number_format($pr_sum,2) }}</span>
					<div class="mb-0">
						<span class="badge badge-soft-success me-2">{{ $pr_count }}</span>
						<span class="text-muted"> PR issued in FY23</span>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Payment (YTD)</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="activity"></i>
							</div>
						</div>
					</div>
					@php
						// $fy = Carbon::now()->format('Y');
						// $pay_sum= Payment::whereYear('pay_date', '=', $fy)->sum('amount');
						// $pay_count= Payment::whereYear('pay_date', '=', $fy)->count();
					@endphp
					<span class="h1 d-inline-block mt-1 mb-3">{{ number_format($po_sum,2) }}</span>
					<div class="mb-0">
						<span class="text-muted">In Last 30 Days</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Budget Utilized 30</h5>
						</div>
						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="activity"></i>
							</div>
						</div>
					</div>
					@php
						//use App\Models\Pr;
						//use Carbon\Carbon;
						//$fy = Carbon::now()->format('Y');
						$po_sum_30= Pr::where('auth_status', '=', App\Enum\WflActionEnum::APPROVED->value )
							->where('auth_date', '>', now()->subDays(30)->endOfDay())
							->sum('amount');
						$po_count_30= Pr::where('auth_status', '=', App\Enum\WflActionEnum::APPROVED->value )
							->where('auth_date', '>', now()->subDays(30)->endOfDay())
							->count();
					@endphp
					<span class="h1 d-inline-block mt-1 mb-3">{{ number_format($po_sum_30,2) }} Same??</span>
					<div class="mb-0">
						<span class="badge badge-soft-success me-2"> {{ number_format($po_count_30,2) }} </span>
						<span class="text-muted">Utilized Till date. Available 99.00</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">PO Issued (30)</h5>
						</div>
						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="shopping-bag"></i>
							</div>
						</div>
					</div>
					@php
					//use App\Models\Pr;
					//use Carbon\Carbon;
					//$fy = Carbon::now()->format('Y');
					$po_sum_30= Pr::where('auth_status', '=', App\Enum\WflActionEnum::APPROVED->value )
						->where('auth_date', '>', now()->subDays(30)->endOfDay())
						->sum('amount');
					$po_count_30= Pr::where('auth_status', '=', App\Enum\WflActionEnum::APPROVED->value )
						->where('auth_date', '>', now()->subDays(30)->endOfDay())
						->count();
					@endphp
					<span class="h1 d-inline-block mt-1 mb-3">{{ number_format($po_sum_30,2) }}</span>
					<div class="mb-0">
						<span class="badge badge-soft-success me-2"> {{ number_format($po_count_30,2) }} </span>
						<span class="text-muted">In Last 30 Days</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">PR Approved (30)</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="shopping-cart"></i>
							</div>
						</div>
					</div>
					@php
					//use App\Models\Pr;
					//use Carbon\Carbon;
					//$fy = Carbon::now()->format('Y');
					$po_sum_30= Pr::where('auth_status', '=', App\Enum\WflActionEnum::APPROVED->value )
						->where('auth_date', '>', now()->subDays(30)->endOfDay())
						->sum('amount');
					$po_count_30= Pr::where('auth_status', '=', App\Enum\WflActionEnum::APPROVED->value )
						->where('auth_date', '>', now()->subDays(30)->endOfDay())
						->count();
					@endphp
					<span class="h1 d-inline-block mt-1 mb-3">{{ number_format($po_sum_30,2) }}</span>
					<div class="mb-0">
						<span class="badge badge-soft-success me-2"> {{ number_format($po_count_30,2) }} </span>
						<span class="text-muted">In Last 30 Days</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Payment (30)</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-lucide="activity"></i>
							</div>
						</div>
					</div>
					@php
					//use App\Models\Pr;
					//use Carbon\Carbon;
					//$fy = Carbon::now()->format('Y');
					$po_sum_30= Pr::where('auth_status', '=', App\Enum\WflActionEnum::APPROVED->value )
						->where('auth_date', '>', now()->subDays(30)->endOfDay())
						->sum('amount');
					$po_count_30= Pr::where('auth_status', '=', App\Enum\WflActionEnum::APPROVED->value )
						->where('auth_date', '>', now()->subDays(30)->endOfDay())
						->count();
					@endphp
					<span class="h1 d-inline-block mt-1 mb-3">{{ number_format($po_sum_30,2) }}</span>
					<div class="mb-0">
						<span class="badge badge-soft-success me-2"> {{ number_format($po_count_30,2) }} </span>
						<span class="text-muted">In Last 30 Days</span>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-12 col-lg-6 col-xl-4 d-flex">
			<div class="card flex-fill w-100">
				<div class="card-header">
					<div class="card-actions float-end">
						<div class="dropdown position-relative">
							<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
								<i class="align-middle" data-lucide="more-horizontal"></i>
							</a>

							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</div>
					</div>
					<h5 class="card-title">Budget Summary</h5>
				</div>
				<div class="card-body d-flex">
					<div class="align-self-center w-100">
						<div class="py-3">
							<div class="chart chart-xs">
								<canvas id="chartjs-budget-pie"></canvas>
							</div>
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
								<i class="align-middle" data-lucide="more-horizontal"></i>
							</a>

							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</div>
					</div>
					<h5 class="card-title">Budget By Department</h5>
				</div>
				<div class="card-body d-flex">
					<div class="align-self-center w-100">
						<div class="py-3">
							<div class="chart chart-xs">
								<canvas id="chartjs-dept-budget-pie"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 col-lg-4 d-flex">
			<div class="card flex-fill w-100">
				<div class="card-header">
					<div class="card-actions float-end">
						<div class="dropdown position-relative">
							<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
							<i class="align-middle" data-lucide="more-horizontal"></i>
							</a>

							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</div>
					</div>
					<h5 class="card-title">Dept Wise Budget vs Utilization</h5>
				</div>
				<div class="card-body d-flex w-100">
					<div class="align-self-center chart">
						<canvas id="chartjs-bar-dept-budget"></canvas>
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
							<i class="align-middle" data-lucide="more-horizontal"></i>
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
							<i class="align-middle" data-lucide="more-horizontal"></i>
							</a>

							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</div>
					</div>
					<h5 class="card-title">Dept Wise Budget vs Utilization</h5>
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
							<i class="align-middle" data-lucide="more-horizontal"></i>
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
							<i class="align-middle" data-lucide="more-horizontal"></i>
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
								<i class="align-middle" data-lucide="more-horizontal"></i>
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
							<i class="align-middle" data-lucide="more-horizontal"></i>
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
			new Chart(document.getElementById("chartjs-budget-pie"), {
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

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dept-budget-pie"), {
				type: "pie",
				data: {
					labels: {!! json_encode($depb_labels) !!},
					datasets: [{
						data: {!! json_encode($depb_data) !!},
						backgroundColor: {!! json_encode($depb_colors) !!},
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

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-bar-dept-budget"), {
				type: "bar",
				data: {
					labels: {!! json_encode($depb_budget_labels) !!},
					datasets: [{
						label: "Budget",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: {!! json_encode($depb_budget_amount) !!},
						barPercentage: .5,
						categoryPercentage: .5
					}, {
						label: "PO Issued",
						backgroundColor: window.theme["primary-light"],
						borderColor: window.theme["primary-light"],
						hoverBackgroundColor: window.theme["primary-light"],
						hoverBorderColor: window.theme["primary-light"],
						data: {!! json_encode($depb_budget_po) !!},
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
