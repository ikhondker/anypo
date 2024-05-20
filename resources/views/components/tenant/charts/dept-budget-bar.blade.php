<div class="col-12 col-lg-4 d-flex">
	<div class="card flex-fill w-100">
		<div class="card-header">
			<div class="card-actions float-end">
				<div class="dropdown position-relative">
					<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
						<i class="align-middle" data-feather="more-horizontal"></i>
					</a>

					<div class="dropdown-menu dropdown-menu-end">
						@can('viewAny', App\Models\Tenant\Budget::class)
							<a class="dropdown-item" href="{{ route('budgets.index') }}"><i class="align-middle me-1" data-feather="eye"></i>View Company Budgets</a>
						@endcan
						<a class="dropdown-item" href="{{ route('dept-budgets.index') }}"><i class="align-middle me-1" data-feather="eye"></i>View Dept Budgets</a>
						<a class="dropdown-item" href="{{ route('projects.index') }}"><i class="align-middle me-1" data-feather="eye"></i>View Project Spends</a>
						<a class="dropdown-item" href="{{ route('suppliers.index') }}"><i class="align-middle me-1" data-feather="eye"></i>View Supplier Spends</a>
					</div>
				</div>
			</div>
			<h5 class="card-title">[{{ $deptBudget->dept->name }}] FY{{ $deptBudget->budget->fy }} : Budget Status</h5>
			<h6 class="card-subtitle text-muted">Budget Utilization Status of a Department</h6>
		</div>
		<div class="card-body d-flex w-100">
			<div class="align-self-center chart">
				<canvas id="chartjs-dept-budget-bar"></canvas>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Bar chart
		new Chart(document.getElementById("chartjs-dept-budget-bar"), {
			type: "bar",
			data: {
				labels: {!! json_encode($dept_budget_labels) !!},
				datasets: [ {
					label: "Dept Budget Status",
					backgroundColor: {!! json_encode($dept_budget_colors) !!},
					// borderColor: window.theme["primary-light"],
					// hoverBackgroundColor: window.theme["primary-light"],
					// hoverBorderColor: window.theme["primary-light"],
					data: {!! json_encode($dept_amount) !!},
					//barPercentage: .5,
					//categoryPercentage: .5
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
