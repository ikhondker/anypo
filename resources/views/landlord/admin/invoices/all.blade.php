@extends('layouts.landlord.app')
@section('title', 'My Invoices')
@section('breadcrumb')
	<li class="breadcrumb-item active">All Invoices</li>
@endsection

{{-- <x-landlord.page-header>
		@slot('title')
			All Invoices
		@endslot
		@slot('buttons')
				<a href="{{ route('invoices.create') }}" class="btn btn-primary me-1"><i data-lucide="plus"></i> New Invoice</a>

		@endslot
</x-landlord.page-header> --}}


@section('content')

	<x-landlord.page-header>
		@slot('title')
			All Invoices
		@endslot
		@slot('buttons')
			@if (auth()->user()->backend)
			<a href="{{ route('invoices.create') }}" class="btn btn-primary float-end  me-1"><i data-lucide="plus"></i> Create Service Invoice</a>
			@endif
			@if (auth()->user()->isBackend())
				<x-landlord.actions.invoice-actions-index-support/>
			@endif
		@endslot
	</x-landlord.page-header>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('invoices.all') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-invoice-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search invoices…" required>
							<button class="btn" type="submit">
								<i data-lucide="search"></i>
							</button>

						</div>
							@if (request('term'))
								Search result for: <strong class="text-info">{{ request('term') }}</strong>
							@endif
					</form>
					<!--/. form -->
				</div>
				<div class="col-md-6 col-xl-8">

					<div class="text-sm-end">

						<a href="{{ route('invoices.all') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						<a href="{{ route('invoices.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a>
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Invoice #</th>
						<th>Type</th>
						<th>Summary</th>
						<th>Invoice Date</th>
						<th>Account</th>
						<th class="text-end">Amount $</th>
						<th class="text-end">Discount %</th>
						<th>Pwop</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($invoices as $invoice)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/'.$invoice->account->logo) }}" width="32" height="32" class="rounded-circle my-n1" alt="{{ $invoice->account->name }}" title="{{ $invoice->account->name }}">
							</td>
							<td>
								<a href="{{ route('invoices.show', $invoice->id) }}">
									<strong>#{{ Str::limit($invoice->invoice_no, 15) }}</strong>
								</a>
							</td>
							<td><x-landlord.list.my-badge :value="$invoice->invoice_type" /></td>
							<td>{{ Str::limit($invoice->summary, 35) }}</td>
							<td><x-landlord.list.my-date :value="$invoice->invoice_date" /></td>
							<td>{{ Str::limit($invoice->account->name, 25) }}</td>

							<td class="text-end"><x-landlord.list.my-number :value="$invoice->amount" /></td>
							<td class="text-end"><x-landlord.list.my-number :value="$invoice->discount" /></td>
							<td><x-landlord.list.my-enable :value="$invoice->pwop"/></td>
							<td><x-landlord.list.my-badge :value="$invoice->status->name" badge="{{ $invoice->status->badge }}" /></td>
							<td>
								<a href="{{ route('invoices.show',$invoice->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>

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
