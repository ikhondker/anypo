@php
	$count_attachment	= App\Models\Tenant\Attachment::where('created_by',null )->count();
	$count_budget		= App\Models\Tenant\Budget::where('created_by',null )->count();
	$count_dbu			= App\Models\Tenant\Dbu::where('created_by',null )->count();
	$count_deptBudget	= App\Models\Tenant\DeptBudget::where('created_by',null )->count();
	$count_invoice		= App\Models\Tenant\Invoice::where('created_by',null )->count();
	$count_invoiceLine	= App\Models\Tenant\InvoiceLine::where('created_by',null )->count();
	//$count_notification	= App\Models\Tenant\Notification::where('created_by',null )->count();
	$count_payment		= App\Models\Tenant\Payment::where('created_by',null )->count();
	$count_po			= App\Models\Tenant\Po::where('created_by',null )->count();
	$count_pol			= App\Models\Tenant\Pol::where('created_by',null )->count();
	$count_pr			= App\Models\Tenant\Pr::where('created_by',null )->count();
	$count_prl	 		= App\Models\Tenant\Prl::where('created_by',null )->count();
	$count_receipt		= App\Models\Tenant\Receipt::where('created_by',null )->count();
	$count_report		= App\Models\Tenant\Report::where('created_by',null )->count();

@endphp
@extends('layouts.tenant.app')
@section('title','Timestamp Check')

@section('breadcrumb')
	<li class="breadcrumb-item active">Transaction Models with Empty Who Columns</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Models with Empty Who Columns (** TODO)
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Models with Empty Who Columns</h5>
			<h6 class="card-subtitle text-muted">Models with Empty Who Columns</h6>
		</div>
		<div class="card-body">
			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Model</th>
						<th>Created By</th>
						<th>Updated By</th>
						<th>Created At</th>
						<th>Updated At</th>
						<th>View</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>count_attachment </td>
						<td>{{ $count_attachment }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="{{ route('home') }}" class="btn btn-light"	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View *</a></td>
					</tr>

					<tr>
						<td>1</td>
						<td>count_budget </td>
						<td>{{ $count_budget }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="{{ route('home') }}" class="btn btn-light"	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View *</a></td></tr>
					<tr>
						<td>1</td>
						<td>count_dbu </td>
						<td>{{ $count_dbu }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="{{ route('home') }}" class="btn btn-light"	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View *</a></td>
					</tr>
					<tr>
						<td>1</td>
						<td>count_deptBudget </td>
						<td>{{ $count_deptBudget }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="{{ route('home') }}" class="btn btn-light"	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View *</a></td>
					</tr>
					<tr>
						<td>1</td>
						<td>count_invoice </td>
						<td>{{ $count_invoice }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="{{ route('home') }}" class="btn btn-light"	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View *</a></td>
					</tr>
					<tr>
						<td>1</td>
						<td>count_invoiceLine </td>
						<td>{{ $count_invoiceLine }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="{{ route('home') }}" class="btn btn-light"	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View *</a></td>
					</tr>
					<tr>
						<td>1</td>
						<td>count_payment </td>
						<td>{{ $count_payment }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="{{ route('home') }}" class="btn btn-light"	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View *</a></td>
					</tr>
					<tr>
						<td>1</td>
						<td>count_po </td>
						<td>{{ $count_po }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="{{ route('home') }}" class="btn btn-light"	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View *</a></td>
					</tr>
					<tr>
						<td>1</td>
						<td>count_pol </td>
						<td>{{ $count_pol }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="{{ route('home') }}" class="btn btn-light"	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View *</a></td>
					</tr>
					<tr>
						<td>1</td>
						<td>count_prl </td>
						<td>{{ $count_prl }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="{{ route('home') }}" class="btn btn-light"	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View *</a></td>
					</tr>
					<tr>
						<td>1</td>
						<td>count_receipt </td>
						<td>{{ $count_receipt }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="{{ route('home') }}" class="btn btn-light"	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View *</a></td>
					</tr>
					<tr>
						<td>1</td>
						<td>count_report </td>
						<td>{{ $count_report }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="{{ route('home') }}" class="btn btn-light"	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View *</a></td>
					<tr>
				</tbody>
			</table>

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

