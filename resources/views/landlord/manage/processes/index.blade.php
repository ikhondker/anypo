@extends('layouts.landlord.app')
@section('title', 'Processes')
@section('breadcrumb')
	<li class="breadcrumb-item active">All Processes Logs</li>
@endsection


@section('content')

	<a href="{{ route('processes.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> Submit New Process</a>
	<h1 class="h3 mb-3">All Processes Logs</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('processes.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-process-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search processes…" required>
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
						<a href="{{ route('processes.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('processes.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a> --}}
					</div>
				</div>
			</div>
			<table class="table w-100">
				<thead>
					<tr>
						<th class="align-middle">#</th>
						<th class="align-middle">Process ID</th>
						<th class="align-middle">Code</th>
						<th class="align-middle">Timestamp</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($processes as $process)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>
								<a href="{{ route('processes.show', $process->id) }}">
									<strong>{{ $process->id }}</strong>
								</a>
							</td>
							<td>{{ $process->job_code }}</td>
							<td>{{ strtoupper(date('d-M-Y H:i:s', strtotime($process->created_at))) }}</td>
							<td>
								<a href="{{ route('processes.show',$process->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>
								{{-- <a href="{{ route('processes.edit',$process->id) }}" class="text-body" data-bs-toggle="tooltip"
										data-bs-placement="top" title="View"> <i data-lucide="edit"></i></a> --}}
								{{-- <a href="{{ route('processes.delete', $process->id) }}"
									class="text-body sw2-advance" data-entity="Menu"
									data-name="{{ $process->route_name }}"
									data-status="{{ $process->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
									data-bs-placement="top" title="{{ $process->enable ? 'Disable' : 'Enable' }}">
									<i data-lucide="{{ $process->enable ? 'bell-off' : 'bell' }}"></i>
								</a> --}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $processes->links() }}
			</div>

		</div>
	</div>

@endsection
