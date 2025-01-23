@extends('layouts.landlord.app')
@section('title', 'Unhandled Error Logs')
@section('breadcrumb')
	<li class="breadcrumb-item active">Error Logs</li>
@endsection

@section('content')
	@if (auth()->user()->isSys())
		<a href="{{ route('error-logs.create') }}" class="btn btn-danger float-end mt-n1"><i data-lucide="plus"></i> New Error Log (*)</a>
	@endif
	<h1 class="h3 mb-3">All Error Logs</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('error-logs.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-errorLog-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search errors…" required>
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
						<a href="{{ route('error-logs.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('errorLogs.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a> --}}
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Tenant</th>
						<th>URL</th>
						<th>Type</th>
						<th>Date</th>
						<th>User</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($errorLogs as $errorLog)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>
								<a href="{{ route('error-logs.show', $errorLog->id) }}">
									<strong>{{ $errorLog->tenant }}</strong>
								</a>
							</td>
							<td>{{ Str::limit($errorLog->url, 20) }}</td>
							<td>{{ $errorLog->e_class }}</td>
							<td>{{ strtoupper(date('d-M-Y H:i:s', strtotime($errorLog->created_at))) }}</td>
							<td>{{ $errorLog->user_id }}</td>
							<td><x-landlord.list.my-badge :value="$errorLog->status" /></td>
							<td>
								<a href="{{ route('error-logs.show',$errorLog->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>
									<a href="{{ route('error-logs.edit',$errorLog->id) }}" class="text-body" data-bs-toggle="tooltip"
										data-bs-placement="top" title="View"> <i data-lucide="edit"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $errorLogs->links() }}
			</div>

		</div>
	</div>


@endsection
