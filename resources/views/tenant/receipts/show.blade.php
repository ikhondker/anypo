@extends('layouts.app')
@section('title','View Receipt')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Receipt
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Receipt"/>
			<x-tenant.buttons.header.create object="Receipt"/>
			<x-tenant.buttons.header.edit object="Receipt" :id="$receipt->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Receipt Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $receipt->summary }}"/>
					<x-tenant.show.my-date		value="{{ $receipt->pay_date }}"/>
					<x-tenant.show.my-number		value="{{ $receipt->amount }}"/>
					<x-tenant.show.my-text		value="{{ $receipt->cheque_no }}" label="Ref/Cheque No"/>
					<x-tenant.show.my-badge		value="{{ $receipt->po_id }}" label="PO#"/>
					<x-tenant.show.my-badge		value="{{ $receipt->status }}" label="status#"/>
					<x-tenant.show.my-text		value="{{ $receipt->notes }}"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Supporting Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-date-time value="{{$receipt->created_at }}" label="Created At"/>
					<x-tenant.show.my-date-time value="{{$receipt->updated_at }}" label="Updated At"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

