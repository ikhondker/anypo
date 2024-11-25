@extends('layouts.landlord.app')
@section('title','Processes')
@section('breadcrumb')
	<li class="breadcrumb-item active">Tickets</li>
@endsection


@section('content')

	<h1 class="h3 mb-3">All Process</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">

				</div>
				<div class="col-md-6 col-xl-8">
					<div class="text-sm-end">
						<a href="{{ route('processes.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('categories.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a> --}}
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th class="align-middle">Logo</th>
						<th class="align-middle">SL#</th>
						<th class="align-middle">Name</th>
						<th class="align-middle">Details</th>
						<th class="align-middle text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="">
							<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
						</td>
						<td class="">1</td>
						<td class="">Generate Invoice</td>
						<td class="">Generate Invoice</td>
						<td class="text-end">
							<a class="btn btn-danger" onclick="return confirm('Do you want to run Invoice Generation Process? ')" href="{{ route('processes.gen-invoice-all') }}">Run Billing Process</a>
						</td>
					</tr>
					<tr>
						<td class="">
							<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
						</td>
						<td class="">1</td>
							<td class="">Accounts Archive</td>
							<td class="">Accounts Archive</td>
							<td class="text-end">
								<a class="btn btn-danger" onclick="return confirm('Do you want to run Accounts Archive Process? ')" href="{{ route('processes.accounts-archive') }}">Run Process **</a>
							</td>
					</tr>
				</tbody>
			</table>

		</div>
	</div>

@endsection


