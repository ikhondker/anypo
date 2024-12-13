@extends('layouts.landlord.app')
@section('title', 'Payments')
@section('breadcrumb')
	<li class="breadcrumb-item active">All Payments</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">All Payments</h1>
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
						<a href="{{ route('payments.all') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						<a href="{{ route('payments.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a>
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Pay ID</th>
						<th>Summary</th>
						<th>Date</th>
						<th>Account</th>
						<th>Invoice #</th>
						<th>Amount $</th>
						<th>Status</th>
						<th>Actions</th>
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
							<td>{{ Str::limit($payment->account->name, 25) }}</td>
							<td>{{ $payment->invoice->invoice_no }}</td>
							<td><x-landlord.list.my-number :value="$payment->amount" /></td>
							<td><x-landlord.list.my-badge :value="$payment->status->name" badge="{{ $payment->status->badge }}" /></td>
							<td>
								<a href="{{ route('payments.show',$payment->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>

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




