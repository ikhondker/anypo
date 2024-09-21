@extends('layouts.landlord.app')
@section('title', 'Payments')
@section('breadcrumb')
	<li class="breadcrumb-item active">Payments</li>
@endsection

@section('content')

<x-landlord.page-header>
	@slot('title')
		My Payments
	@endslot
	@slot('buttons')
			<x-landlord.actions.account-actions/>
		
	@endslot
</x-landlord.page-header>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('payments.all') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-payment-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search payments…" required>
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
						<a href="{{ route('payments.all') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						<a href="{{ route('payments.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a>
					</div>
				</div>
			</div>

			<table id="datatables-orders" class="table w-100">
				<thead>
					<tr>
						<th class="align-middle">#</th>
						<th class="align-middle">Pay ID</th>
						<th class="align-middle">Summary</th>
						<th class="align-middle">Date</th>
						<th class="align-middle">Invoice #</th>
						<th class="align-middle">Amount</th>
						<th class="align-middle">Status</th>
						<th class="align-middle text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($payments as $payment)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/'.$payment->account->logo) }}" width="32" height="32" class="rounded-circle my-n1" alt="{{ $payment->account->name }}" title="{{ $payment->account->name }}">
							</td>
							<td>{{ $payment->id }}</td>
							<td>
								<a href="{{ route('payments.show', $payment->id) }}" class="text-muted">
									<strong>{{ Str::limit($payment->summary, 20) }}</strong>
								</a>
							</td>
							<td><x-landlord.list.my-date :value="$payment->pay_date" /></td>
							<td>{{ $payment->invoice->invoice_no }}</td>
							<td><x-landlord.list.my-number :value="$payment->amount"/> USD</td>
							<td><x-landlord.list.my-badge :value="$payment->status->name" badge="{{ $payment->status->badge }}" /></td>
							<td class="text-end">
								<a href="{{ route('payments.show',$payment->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>
								<a href="{{ route('reports.pdf-payment', $payment->id) }}" class="text-body" target="_blank"
									target="_blank" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Download"><i data-lucide="download"></i></a>


							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $payments->links() }}
			</div>

		</div>
	</div>


@endsection




