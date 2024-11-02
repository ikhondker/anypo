@extends('layouts.landlord.app')
@section('title', 'My Invoices')
@section('breadcrumb')
	<li class="breadcrumb-item active">Invoices</li>
@endsection

@section('content')
	<x-landlord.page-header>
		@slot('title')
			Your Invoices
		@endslot
		@slot('buttons')
				<x-landlord.actions.account-actions/>
				@if (auth()->user()->isAdmin())
					<a href="{{ route('invoices.generate') }}" class="btn btn-primary float-end me-1"><i class="fas fa-plus"></i> Generate & Pay Advance Invoice</a>
				@endif
		@endslot
	</x-landlord.page-header>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('invoices.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-invoice-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search invoices…" required>
							<button class="btn" type="submit">
								<i class="align-middle" data-lucide="search"></i>
							</button>

						</div>
							@if (request('term'))
								Search result for: <strong class="text-danger">{{ request('term') }}</strong>
							@endif
					</form>
					<!--/. form -->
				</div>
				<div class="col-md-6 col-xl-8">

					<div class="text-sm-end">
						<a href="{{ route('invoices.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						<a href="{{ route('invoices.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a>
					</div>
				</div>
			</div>

			<table id="datatables-orders" class="table w-100">
				<thead>
					<tr>
						<th class="align-middle">#</th>
						<th class="align-middle">Invoice #</th>
						<th class="align-middle">Summary</th>
						<th class="align-middle">Invoice Date</th>
						<th class="align-middle">Type</th>
						<th class="align-middle">Amount $</th>
						<th class="align-middle">Status</th>
						<th class="align-middle text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($invoices as $invoice)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/'.$invoice->account->logo) }}" width="32" height="32" class="rounded-circle my-n1" alt="{{ $invoice->account->name }}" title="{{ $invoice->account->name }}">
							</td>
							<td>
								<a href="{{ route('invoices.show', $invoice->id) }}" class="text-muted">
									<strong>#{{ Str::limit($invoice->invoice_no, 10) }}</strong>
								</a>
							</td>
							<td>
								<a href="{{ route('invoices.show', $invoice->id) }}" class="text-muted">
									<strong>{{ Str::limit($invoice->summary, 20) }}</strong>
								</a>
							</td>
							<td><x-landlord.list.my-date :value="$invoice->invoice_date" /></td>
							<td><x-landlord.list.my-badge :value="$invoice->invoice_type" /></td>
							<td><x-landlord.list.my-number :value="$invoice->amount" /></td>
							<td><x-landlord.list.my-badge :value="$invoice->status->name" badge="{{ $invoice->status->badge }}" /></td>

							<td class="text-end">
								<a href="{{ route('invoices.show',$invoice->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>

								<a href="{{ route('akk.invoice', $invoice->invoice_no) }}" class="text-body"
									target="_blank" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View Online"><i data-lucide="globe"></i></a>

								<a href="{{ route('reports.pdf-invoice', $invoice->id) }}" class="text-body"
									target="_blank" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Download"><i data-lucide="download"></i></a>

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $invoices->links() }}
			</div>

		</div>
	</div>
@endsection
