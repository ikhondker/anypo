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
			<h5 class="card-title">Purchase Order Lines</h5>
			<h6 class="card-subtitle text-muted">Details of Purchase Order Lines.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $pol->line_num }}" label="Line #"/>
					<x-tenant.show.my-text		value="{{ $pol->item->name }}" label="Item"/>
					<x-tenant.show.my-text		value="{{ $pol->uom->name }}" label="UoM"/>
					<x-tenant.show.my-amount	value="{{ $pol->qty}}" label="Qty"/>
					<x-tenant.show.my-amount	value="{{ $pol->price}}" label="Price"/>
					<x-tenant.show.my-amount	value="{{ $pol->amount}}" label="Qty"/>
					<x-tenant.show.my-amount	value="{{ $pol->received_qty}}" label="Received"/>
					<x-tenant.show.my-created-at value="{{ $pol->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $pol->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Purchase Order Lines</h5>
			<h6 class="card-subtitle text-muted">Details of Purchase Order Lines.</h6>
		</div>
		<div class="card-body">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
							<th class="" style="width:2%">LN#</th>
							<th class="" style="width:5%" >Item</th>
							<th class="" style="width:23%">Description</th>
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

				@foreach ($pols as $pol)
					
					<tr class="">
						<td class="">{{ $pol->line_num }}</td>
						<td class="">{{ $pol->item->code }}</td>
						<td class="">{{ $pol->item_description }}</td>
						<td class="">{{ $pol->uom->name }}</td>
						<td class="text-end">{{ $pol->qty }}</td>
						<td class="text-end">{{ $pol->received_qty }}</td>
						<td class="text-end"><x-tenant.list.my-number :value="$pol->price"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$pol->sub_total"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$pol->tax"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$pol->gst"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$pol->amount"/></td>
						<td class="text-end"><span class="badge {{ $pol->close_status_badge->badge }}">{{ $pol->close_status_badge->name}}</span></td>
						<td class="table-action">
							<a href="{{ route('pols.show',$pol->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
								<i class="align-middle" data-lucide="eye"></i></a>
					
							@if ($status == App\Enum\AuthStatusEnum::DRAFT->value)
								<a href="{{ route('pols.edit',$pol->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
									<i class="align-middle" data-lucide="edit"></i></a>
					
								<a href="{{ route('pols.destroy',$pol->id) }}" class="text-muted sw2-advance"
									data-entity="Line #" data-name="{{ $pol->line_num }}" data-status="Delete"
									data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
									<i class="align-middle" data-lucide="trash-2"></i>
								</a>
							@elseif ($status == App\Enum\AuthStatusEnum::APPROVED->value)
								<a href="{{ route('pols.receipt',$pol->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Goods Receipt">
									<i class="align-middle" data-lucide="file-text"></i></a>
							@endif
					
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

		</div>
	</div>


	<x-tenant.widgets.pol.pol-receipts :id="$pol->id" />

@endsection

