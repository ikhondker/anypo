@extends('layouts.landlord.app')
@section('title','Dept')

@section('breadcrumb')
	<li class="breadcrumb-item active">Control Panel</li>
@endsection

@section('content')

	{{-- <nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="dashboard-default.html">Home</a></li>
			<li class="breadcrumb-item"><a href="#">Library</a></li>
			<li class="breadcrumb-item active">Data</li>
		</ol>
	</nav> --}}

	<x-landlord.page-header>
		@slot('title')
			Control Panel
		@endslot
		@slot('buttons')

		@endslot
	</x-landlord.page-header>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					Control Panel
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of departments with Requisition and Purchase Order Approval Hierarchy</h6>
		</div>
		<div class="card-body">
			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Purpose</th>
						<th>View</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Changelog </td>
						<td>Changelog </td>
						<td>
							<a href="{{ route('cps.changelog') }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">Run
							</a>
						</td>
					</tr>
					<tr>
						<td>2</td>
						<td>UI </td>
						<td>UI </td>
						<td>
							<a href="{{ route('cps.ui') }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">Run
							</a>
						</td>
					</tr>
					<tr>
						<td>3</td>
						<td>Code Generation * </td>
						<td>Code Generation </td>
						<td>
							<a href="{{ route('cps.codegen') }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">Run
							</a>
						</td>
					</tr>
					<tr>
						<td>4</td>
						<td>Sync Landlord</td>
						<td>Sync Landlord</td>
						<td>
							<a href="{{ route('cps.sync') }}" class="btn btn-light sw2"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">Run
							</a>
						</td>
					</tr>

				</tbody>
			</table>

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

