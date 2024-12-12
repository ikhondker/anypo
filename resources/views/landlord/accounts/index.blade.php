@extends('layouts.landlord.app')
@section('title','My Account')
@section('breadcrumb')
	<li class="breadcrumb-item active">All Accounts</li>
@endsection

@section('content')

<a href="{{ route('accounts.create') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="plus"></i> New Account</a>
<h1 class="h3 mb-3">All Accounts</h1>

<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
				<!-- form -->
				<form action="{{ route('accounts.index') }}" method="GET" role="search">
					<div class="input-group input-group-search">
						<input type="text" class="form-control" id="datatables-account-search"
							minlength=3 name="term"
							value="{{ old('term', request('term')) }}" id="term"
							placeholder="Search accounts…" required>
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
					<a href="{{ route('accounts.index') }}" class="btn btn-primary btn-lg"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
						<i data-lucide="refresh-cw"></i></a>
					<a href="{{ route('accounts.export') }}" class="btn btn-light btn-lg me-2"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
						<i data-lucide="download"></i> Export</a>
				</div>
			</div>
		</div>

		<table class="table w-100">
			<thead>
				<tr>
					<th>#</th>
					<th>Site</th>
					<th>Site Name</th>
					<th>Owner</th>
					<th>Period</th>
					<th>User</th>
					<th>Amount</th>
					<th>Status</th>
					<th>Billed</th>
					<th>Last Bill Date</th>
					<th>Next Inv No</th>

					<th>Actions</th>

				</tr>
			</thead>
			<tbody>
				@foreach ($accounts as $account)
					<tr>
						<td>
							<img src="{{ Storage::disk('s3l')->url('logo/'.$account->logo) }}" width="32" height="32" class="rounded-circle my-n1" alt="{{ $account->name }}" title="{{ $account->name }}">
						</td>
						<td>
							<a href="{{ route('accounts.show', $account->id) }}">
								<strong>{{ $account->site }}</strong>
							</a>
						</td>
						<td>
							<a href="{{ route('accounts.show', $account->id) }}">
								<strong>{{ $account->name }}</strong>
							</a>
						</td>
						<td>{{ $account->owner->name }}</td>
						<td><x-landlord.list.my-date :value="$account->start_date" /> - <x-landlord.list.my-date :value="$account->end_date" /></td>
						<td><span class="badge badge-subtle-primary">{{ $account->user }}</span></td>
						<td><x-landlord.list.my-number :value="$account->price"/>$</td>
						<td><x-landlord.list.my-badge :value="$account->status->name" badge="{{ $account->status->badge }}" /></td>
						<td><x-landlord.list.my-enable :value="$account->next_bill_generated" /></td>
						<td><x-landlord.list.my-date value="{{ $account->last_bill_date }}" /></td>
						<td>
							@if ($account->next_invoice_no <> 0)
							<a href="{{ route('akk.invoice', $account->next_invoice_no) }}" class="text-muted">
								#{{ Str::limit($account->next_invoice_no, 10) }}
							</a>
							@endif
						</td>
						<td>
							<a href="{{ route('accounts.show',$account->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
								data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>
						</td>

					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="row mb-3">
			{{ $accounts->links() }}
		</div>

	</div>
</div>

@endsection
