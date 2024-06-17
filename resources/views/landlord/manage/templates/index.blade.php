@extends('layouts.landlord.app')
@section('title','Templates')
@section('breadcrumb','Templates v1.3 (6-MAR-23)')

@section('content')

	<a href="{{ route('templates.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New Template</a>
	<h1 class="h3 mb-3">All Templates</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('templates.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-template-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search templates…" required>
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
						<a href="{{ route('templates.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						<a href="{{ route('templates.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a>
					</div>
				</div>
			</div>

			<table id="datatables-orders" class="table w-100">
				<thead>
					<tr>
						<th class="align-middle">#</th>
						<th class="align-middle">Name</th>
						<th class="align-middle">Phone</th>
						<th class="align-middle">Date</th>
						<th class="text-end">Amount</th>
						<th class="align-middle">Name2</th>
						<th class="align-middle">Role</th>
						<th class="align-middle">Enable</th>
						<th class="align-middle text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($templates as $template)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>
								<a href="{{ route('templates.show', $template->id) }}">
									<strong>{{ $template->name }}</strong>
								</a>
							</td>
							<td>{{ $template->phone }}</td>
							<td>{{ strtoupper(date('d-M-y', strtotime($template->my_date))) }}</td>
							<td class="text-end">{{number_format($template->amount, 2)}} </td>
							<td>{{ $template->user->name}}</td>
							<td><span class="badge bg-primary">{{ $template->my_enum}}</span> </td>
							<td>
								<span class="badge {{ ($template->enable ? 'badge-subtle-success text-success' : 'badge-subtle-danger text-danger') }}">{{ ($template->enable ? 'Yes' : 'No') }}</span>
							</td>

							<td class="text-end">
								<a href="{{ route('templates.show',$template->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $templates->links() }}
			</div>

		</div>
	</div>

@endsection

