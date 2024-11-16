@extends('layouts.landlord.app')
@section('title', 'Reply Templates')
@section('breadcrumb')
	<li class="breadcrumb-item active">Reply Templates</li>
@endsection


@section('content')

	<a href="{{ route('reply-templates.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New Reply Templates</a>
	<h1 class="h3 mb-3">All Reply Templates</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('reply-templates.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-replyTemplate-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search categories…" required>
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
						<a href="{{ route('reply-templates.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
					</div>
				</div>
			</div>

			<table id="datatables-orders" class="table w-100">
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
					@foreach ($replyTemplates as $replyTemplate)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>{{ $replyTemplate->id }}</td>
							<td>
								<a href="{{ route('reply-templates.show', $replyTemplate->id) }}">
									<strong>{{ $replyTemplate->name }}</strong>
								</a>
							</td>
							<td><x-landlord.list.my-date value="{{ $replyTemplate->created_at }}" /></td>
							<td><x-landlord.list.my-enable :value="$replyTemplate->enable" /></td>
							<td>
								<a href="{{ route('reply-templates.show',$replyTemplate->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>
								<a href="{{ route('reply-templates.edit',$replyTemplate->id) }}" class="text-body" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Edit"><i data-lucide="edit"></i></a>
								<a href="{{ route('reply-templates.delete', $replyTemplate->id) }}"
									class="text-body sw2-advance" data-entity="ReplyTemplates"
									data-name="{{ $replyTemplate->name }}"
									data-status="{{ $replyTemplate->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
									data-bs-placement="top" title="{{ $replyTemplate->enable ? 'Disable' : 'Enable' }}">
									<i data-lucide="{{ $replyTemplate->enable ? 'bell-off' : 'bell' }} "></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $replyTemplates->links() }}
			</div>

		</div>
	</div>

@endsection
