@extends('layouts.tenant.app')
@section('title','Tenant Change Logs')
@section('breadcrumb')
	<li class="breadcrumb-item active">Tenant Change Logs</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
		Tenant Change Log
		@endslot
		@slot('buttons')
			
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Tenant Change Log</h5>
			<h6 class="card-subtitle text-muted">Tenant Version {{ $_setup->version }}</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Branch</th>
						<th>Changes</th>
						<th>Date</th>
						<th>Versions</th>
						<th>Remark</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>3</td>
						<td><strong>T003</strong></td>
						<td></td>
						<td>21 Jul, 2024</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>2</td>
						<td><strong>T002</strong></td>
						<td></td>
						<td>21 Jul, 2024</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>1</td>
						<td><strong>T001</strong></td>
						<td>
							<ul>
								<li>Added: Social buttons to auth pages</li>
								<li>Improved: Various visual changes</li>
								<li>Updated: Webpack 5.85.1</li>
								<li>Updated: Bootstrap 5.3.0</li>
								<li>Updated: Dependencies to latest versions</li>
							</ul>
						</td>
						<td>21 Jul, 2024</td>
						<td><span class="badge bg-primary">v1.0.0</span></td>
						<td></td>
					</tr>
					
				</tbody>
			</table>
		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

