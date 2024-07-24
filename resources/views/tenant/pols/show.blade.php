@extends('layouts.tenant.app')
@section('title','View Purchase Order Lines')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$pol->po_id) }}" class="text-muted">PO #{{ $pol->po_id }}</a></li>
	<li class="breadcrumb-item active">Line #{{ $pol->line_num }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Purchase Order Lines
		@endslot
		@slot('buttons')

		<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
		<x-tenant.actions.pol-actions id="{{ $pol->id }}"/>

		@endslot
	</x-tenant.page-header>


	<x-tenant.info.po-info id="{{ $pol->po_id }}" photo='pol'/>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('pos.show', $po->id ) }}"><i class="far fa-file"></i> View PO#{{ $po->id }}</a>
			</div>
			
			<h5 class="card-title">Purchase Order Lines</h5>
		</div>
		<div class="card-body">
			<table class="table table-hover table-sm">
				<thead>
					<tr>
						<th class="" style="width:2%">LN#</th>
						<th class="" style="width:5%" >Item</th>
						<th class="" style="width:15%">Description</th>
						<th class="" style="width:7%">UOM</th>
						<th class="text-end" style="width:5%">Qty</th>
						<th class="text-end" style="width:5%">Received</th>
						<th class="text-end" style="width:9%">Price</th>
						<th class="text-end" style="width:8%">Subtotal</th>
						<th class="text-end" style="width:8%">Tax</th>
						<th class="text-end" style="width:8%">GST</th>
						<th class="text-end" style="width:8%">Amount</th>
						<th class="text-end">Status</th>
						<th class="" style="width:10%">Actions</th>
					</tr>
				</thead>

				@foreach ($pols as $pol1)
					@if ($pol->id == $pol1->id)	
						<trclass="badge-subtle-success">
					@else
						<trclass="">
					@endif
					<td class="">{{ $pol1->line_num }}</td>
						<td class="">{{ $pol1->item->code }}</td>
						<td class="">{{ $pol1->item_description }}</td>
						<td class="">{{ $pol1->uom->name }}</td>
						<td class="text-end">{{ $pol1->qty }}</td>
						<td class="text-end">{{ $pol1->received_qty }}</td>
						<td class="text-end"><x-tenant.list.my-number :value="$pol1->price"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$pol1->sub_total"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$pol1->tax"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$pol1->gst"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$pol1->amount"/></td>
						<td class="text-end"><span class="badge {{ $pol1->close_status_badge->badge }}">{{ $pol1->close_status_badge->name}}</span></td>
						<td class="table-action">
							<a href="{{ route('pols.show',$pol1->id) }}" class="btn btn-light btn-sm" 
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
							</a>
							<a href="{{ route('receipts.create-for-pol', $pol1->id)}}" class="btn btn-light btn-sm" 
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">New Receipt
							</a>
						</td>
					</tr>
				@endforeach

				<!-- Table footer i.e. Totals -->
				<tr>
					<td class="" colspan="2" scope="col">
						@if ($po->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
							<a href="{{ route('pols.add-line', $po->id) }}" class="text-warning d-inline-block"><i data-lucide="plus-square"></i> Add Lines</a>
						@endif
					</td>
					<td class="" colspan="4" scope="col">&nbsp;</td>
					<td class="text-end" scope="col"><strong>TOTAL ({{ $po->currency }}) :</strong></td>
					<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$po->sub_total"/></strong></td>
					<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$po->tax"/></strong></td>
					<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$po->gst"/></strong></td>
					<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$po->amount"/></strong></td>
					<td class="" scope="col">&nbsp</td>
				</tr>
				<!-- End Table footer i.e. Totals -->
			</table>
		</div>
	</div>


	<x-tenant.widgets.pol.pol-receipts :id="$pol->id" />

@endsection

