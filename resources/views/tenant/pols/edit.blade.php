@extends('layouts.tenant.app')
@section('title','Edit Purchase Order Line')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}" class="text-muted">PO#{{ $po->id }}</a></li>
	<li class="breadcrumb-item active">Edit PO Line # {{ $pol->line_num }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Purchase Order Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.actions.pol-actions polId="{{ $pol->id }}"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.widgets.po.show-po-header poId="{{ $po->id }}"/>

	<!-- form start -->
	<form action="{{ route('pols.update',$pol->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')



	{{-- ================================================================== --}}
	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<div class="dropdown position-relative">
					
				</div>
			</div>
			<h5 class="card-title">Purchase Order Lines</h5>
			<h6 class="card-subtitle text-muted">List of Purchase Order Lines.</h6>
		</div>
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th class="" style="width:1%">LN#</th>
					<th class="" style="width:15%" >Item</th>
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

			<!-- pol lines -->
			<tbody>
				@forelse($pols as $poln)
					@if ( $poln->id == $pol->id )
						@include('tenant.includes.po.po-line-edit')
					@else
						<x-tenant.widgets.pol.card-table-row :line="$poln"/>
					@endif 
				@empty

				@endforelse

				<!-- Table footer i.e. Totals -->
				<tr class="">
					<td colspan="9" class="text-end">
						<strong>TOTAL:</strong>
					</td>
					<td class="text-end">
						<input type="number" step='0.01' min="1" class="form-control @error('po_amount') is-invalid @enderror"
							style="text-align: right;"
							name="po_amount" id="po_amount" placeholder="1.00"
							value="{{ old('po_amount', isset($po->amount) ? number_format($po->amount,2) : "0.00") }}"
							required readonly>
						@error('po_amount')
								<div class="small text-danger">{{ $message }}</div>
						@enderror
					</td>
				</tr>
				<!-- End Table footer i.e. Totals -->
			</tbody>
			<!-- pol lines -->
				
		</table>
		<div class="card-footer">
			<div class="card-actions float-end">
				<a class="btn btn-secondary text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" href="{{ route('pos.show',$po->id) }}"><i data-lucide="x-circle"></i> Cancel</a>
				<button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="save"></i> Save</button>
			</div>
		</div>

	</div>


	
	</form>
	<!-- /.form end -->

	 @include('tenant.includes.js.select2')

@endsection

