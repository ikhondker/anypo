@extends('layouts.tenant.app')
@section('title','Edit PR Line')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}" class="text-muted">Requisitions</a></li>
	<li class="breadcrumb-item"><a href="{{ route('prs.show',$pr->id) }}" class="text-muted">PR#{{ $pr->id }}</a></li>
	<li class="breadcrumb-item active">Edit PR Line</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit PR Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions prId="{{ $pr->id }}"/>
		@endslot
	</x-tenant.page-header>
	
	{{-- @include('tenant.includes.pr.view-pr-header') --}}
	<x-tenant.widgets.pr.show-pr-header prId="{{ $pr->id }}"/>

	<!-- form start -->
	<form action="{{ route('prls.update',$prl->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
					</div>
				</div>
				<h5 class="card-title">Requisition Lines</h5>
				<h6 class="card-subtitle text-muted">List of Requisition Lines.</h6>
			</div>

			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="text-center" style="width:1%">#</th>
						<th class="" style="width:15%">Item</th>
						<th class="" style="width:25%">Description</th>
						<th class="" style="width:8%">UOM</th>
						<th class="text-end" style="width:6%">Qty</th>
						<th class="text-end" style="width:9%">Price</th>
						<th class="text-end" style="width:9%">Subtotal</th>
						<th class="text-end" style="width:9%">Tax</th>
						<th class="text-end" style="width:9%">GST</th>
						<th class="text-end" style="width:9%">Amount</th>
					</tr>
				</thead>
				<tbody>

					@forelse ($prls as $prln)
						@if ( $prln->id == $prl->id )
							@include('tenant.includes.pr.pr-line-edit')
						@else
							<x-tenant.widgets.prl.card-table-row :line="$prln"/>
						@endif 
					@empty

					@endforelse

					<tr class="">
						<td colspan="9" class="text-end">
							<strong>TOTAL:</strong>
						</td>
						<td class="text-end">
							<input type="text" class="form-control @error('pr_amount') is-invalid @enderror"
								style="text-align: right;"
								name="pr_amount" id="pr_amount" placeholder="0.00"
								value="{{ old('pr_amount', (isset($pr->amount) ? number_format($pr->amount,2) : "0.00")) }}"
								readonly>
							@error('pr_amount')
									<div class="small text-danger">{{ $message }}</div>
							@enderror
						</td>
					</tr>
				</tbody>
			</table>

			<div class="card-footer">
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
							<a class="btn btn-secondary text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" href="{{ route('prs.show',$pr->id) }}"><i data-lucide="x-circle"></i> Cancel</a>
							<button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="save"></i> Save</button>
					</div>
				</div>
			</div>
		</div>

	</form>
	<!-- /.form end -->

	@include('tenant.includes.js.select2')
	@include('tenant.includes.js.calculate-pr-amount')
@endsection

