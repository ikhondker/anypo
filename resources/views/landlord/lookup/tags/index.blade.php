@extends('layouts.landlord.app')
@section('title', 'Tags')
@section('breadcrumb')
	<li class="breadcrumb-item active">Tags</li>
@endsection


@section('content')

	<a href="{{ route('tags.create') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="plus"></i> New Tag</a>
	<h1 class="h3 mb-3">All Tags</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('tags.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-topic-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search tags" required>
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
						<a href="{{ route('tags.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						{{-- <a href="{{ route('tags.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a> --}}
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>ID</th>
						<th>Name</th>
						<th>Date</th>
						<th>Enable</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tags as $topic)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>{{ $topic->id }}</td>
							<td>
								<a href="{{ route('tags.show', $topic->id) }}">
									<strong>{{ $topic->name }}</strong>
								</a>
							</td>
							<td><x-landlord.list.my-date :value="$topic->created_at" /></td>
							<td><x-landlord.list.my-enable :value="$topic->enable" /></td>
							<td>
								<a href="{{ route('tags.show',$topic->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>
								<a href="{{ route('tags.edit',$topic->id) }}" class="text-body" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Edit"><i data-lucide="edit"></i></a>
								<a href="{{ route('tags.delete', $topic->id) }}"
									class="text-body sw2-advance" data-entity="Tag"
									data-name="{{ $topic->name }}"
									data-status="{{ $topic->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
									data-bs-placement="top" title="{{ $topic->enable ? 'Disable' : 'Enable' }}">
									<i data-lucide="{{ $topic->enable ? 'bell-off' : 'bell' }}"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $tags->links() }}
			</div>

		</div>
	</div>

@endsection
