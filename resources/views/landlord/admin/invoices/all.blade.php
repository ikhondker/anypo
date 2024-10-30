@extends('layouts.landlord.app')
@section('title', 'My Invoices')
@section('breadcrumb')
	<li class="breadcrumb-item active">All Invoices</li>
@endsection

@section('content')

    @if (auth()->user()->account_id <> '')
	    <a href="{{ route('invoices.index') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> Generate Invoice **</a>
    @endif

	<h1 class="h3 mb-3">All Invoices</h1>

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
								Search result for: <strong class="text-danger">{{ request('term') }}</strong>
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

			<table id="datatables-orders" class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Invoice #</th>
						<th>Summary</th>
						<th>Invoice Date</th>
						<th>Account</th>
						<th>Type</th>
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
							<td>{{ Str::limit($invoice->summary, 35) }}</td>
							<td><x-landlord.list.my-date :value="$invoice->invoice_date" /></td>
							<td>{{ Str::limit($invoice->account->name, 25) }}</td>
							<td><x-landlord.list.my-badge :value="$invoice->invoice_type" /></td>

							<td class="text-end"><x-landlord.list.my-number :value="$invoice->amount" /></td>
                            <td class="text-end"><x-landlord.list.my-number :value="$invoice->discount" /></td>
							<td><x-landlord.list.my-enable :value="$invoice->pwop"/></td>
							<td><x-landlord.list.my-badge :value="$invoice->status->name" badge="{{ $invoice->status->badge }}" /></td>
							<td>
								<a href="{{ route('invoices.show',$invoice->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>

								<a href="{{ route('home.invoice', $invoice->invoice_no) }}" class="text-body"
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
