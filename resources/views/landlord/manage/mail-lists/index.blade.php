@extends('layouts.landlord.app')
@section('title', 'Mail Lists')
@section('breadcrumb')
	<li class="breadcrumb-item active">Mail Lists</li>
@endsection


@section('content')

	<a href="{{ route('mail-lists.create') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="plus"></i> New</a>
	<h1 class="h3 mb-3">Mailing Lists</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('mail-lists.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-mailList-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search maillists…" required>
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
						<a href="{{ route('mail-lists.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('mailLists.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a> --}}
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Date</th>
						<th>IP</th>
						<th>Enable</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($mailLists as $mailList)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>
								<a href="{{ route('mail-lists.show', $mailList->id) }}">
									<strong>{{ $mailList->name }}</strong>
								</a>
							</td>
							<td>{{ $mailList->email }}</td>
							<td><x-landlord.list.my-date :value="$mailList->created_at" /></td>
							<td>{{ $mailList->ip }}</td>
							<td><x-landlord.list.my-enable :value="$mailList->enable" /></td>
							<td>

								{{-- <a href="{{ route('mail-lists.show',$mailList->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a> --}}

									<a href="{{ route('mail-lists.destroy', $mailList->id) }}"
										class="text-body sw2-advance" data-entity="Email"
										data-name="{{ $mailList->email }}"
										data-status="{{ $mailList->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
										data-bs-placement="top" title="{{ $mailList->enable ? 'Disable' : 'Enable' }}">
										<i data-lucide="{{ $mailList->enable ? 'bell-off' : 'bell' }}"></i>
									</a>

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $mailLists->links() }}
			</div>

		</div>
	</div>

@endsection
