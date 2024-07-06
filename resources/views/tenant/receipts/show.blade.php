@extends('layouts.tenant.app')
@section('title','View Receipt')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}">Receipts</a></li>
	{{-- <li class="breadcrumb-item"><a href="{{ route('receipts.index') }}">TODO POL</a></li> --}}
	<li class="breadcrumb-item active">GRN#{{ $receipt->id }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Receipt
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Receipt"/>
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.actions.receipt-actions id="{{ $receipt->id }}"/>

		@endslot
	</x-tenant.page-header>


	{{-- <x-tenant.info.pol-info id="{{ $receipt->pol_id }}"/> --}}

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Goods Receipt Information</h5>
					<h6 class="card-subtitle text-muted">List of Goods Receipts.11</h6>
				</div>
				<div class="card-body">

					<table class="table table-sm my-2">
						<tbody>
							<tr>
								<th>PO #:</th>
								<td>
									<a class="text-info" href="{{ route('pos.show',$receipt->pol->po_id) }}">
									{{ "#". $receipt->pol->po_id. " - ". $receipt->pol->po->summary }}
									</a>
								</td>
							</tr>
							<tr>
								<th>Line #</th>
								<td> {{ "#". $receipt->pol->line_num. " - ". $receipt->pol->item_description }}</td>
							</tr>
							<x-tenant.show.my-number	value="{{ $receipt->pol->qty }}" label="Ord Qty" />
							<x-tenant.show.my-badge		value="{{ $receipt->id }}" label="GRN#"/>
							<x-tenant.show.my-date		value="{{ $receipt->receive_date }}"/>
							<x-tenant.show.my-number	value="{{ $receipt->qty }}" label="Rcv Qty" />
							<x-tenant.show.my-text		value="{{ $receipt->warehouse->name }}" label="Warehouse"/>
							<x-tenant.show.my-text		value="{{ $receipt->receiver->name }}" label="Receiver"/>
							<x-tenant.show.my-badge		value="{{ $receipt->status }}" label="Status"/>
							<x-tenant.show.my-text-area		value="{{ $receipt->notes }}" label="Notes"/>

							<tr>
								<th>Attachments</th>
								<td><x-tenant.attachment.all entity="RECEIPT" aid="{{ $receipt->id }}"/></td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>


@endsection

