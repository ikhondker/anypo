@extends('layouts.tenant.app')
@section('title','Create Invoice')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}" class="text-muted">PO#{{ $po->id }}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.invoices', $po->id) }}" class="text-muted">PO Invoices</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Invoice for PO #{{ $po->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions id="{{ $po->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>


	{{-- @include('tenant.includes.po.view-po-header') --}}

	<x-tenant.info.po-info id="{{ $po->id }}"/>

	{{-- <x-tenant.widgets.po.invoices :id="$po->id" /> --}}

	<!-- form start -->
	<form id="myform" action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<input type="text" name="po_id" id="po_id" class="form-control" placeholder="ID" value="{{ old('po_id', $po->id ) }}" hidden>

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a class="btn btn-sm btn-light" href="{{ route('pos.invoices', $po->id) }}" ><i class="fas fa-list"></i> View Invoices</a>
				</div>
				<h5 class="card-title">Create Invoice For a Purchase Order</h5>
				<h6 class="card-subtitle text-muted">Create Invoice For a Purchase Order.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th>Invoice No</th>
							<td>
								<input type="text" class="form-control @error('invoice_no') is-invalid @enderror"
								name="invoice_no" id="invoice_no" placeholder="XXXXX"
								style="text-transform: uppercase"
								value="{{ old('invoice_no', '' ) }}"
								required/>
							@error('invoice_no')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>

						<tr>
							<th>Invoice Date</th>
							<td>
								<input type="date" class="form-control @error('invoice_date') is-invalid @enderror"
								name="invoice_date" id="invoice_date" placeholder=""
								value="{{ old('invoice_date', date('Y-m-d') ) }}"
								required/>
							@error('invoice_date')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>

						<tr>
							<th>Particulars</th>
							<td>
								<input type="text" class="form-control @error('summary') is-invalid @enderror"
								name="summary" id="summary" placeholder="Summary"
								value="{{ old('summary', '' ) }}"
								required/>
							@error('summary')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>

						<tr>
							<th>Invoice PoC</th>
							<td>
								<select class="form-control" name="poc_id" required>
									<option value=""><< PoC Name >> </option>
									@foreach ($pocs as $user)
										<option value="{{ $user->id }}" {{ $user->id == old('poc_id') ? 'selected' : '' }} >{{ $user->name }} </option>
									@endforeach
								</select>
								@error('poc_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</td>
						</tr>

						<tr>
							<th>Amount ({{ $po->currency }})</th>
							<td>
								<input type="number" class="form-control @error('amount') is-invalid @enderror"
								name="amount" id="amount" placeholder="99,999.99"
								value="{{ old('amount', '1.00' ) }}"
								step='0.01' min="1" required/>
							@error('amount')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>

						<x-tenant.create.notes/>

						<x-tenant.attachment.create/>

                        <x-tenant.create.save/>

					</tbody>
				</table>




			</div>
		</div>

	</form>
	<!-- /.form end -->

	<x-tenant.widgets.po.invoices poid="{{ $po->id }}" />

@endsection
