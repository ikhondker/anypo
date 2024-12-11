@extends('layouts.landlord.app')
@section('title','Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item active">Attachments</li>
@endsection


@section('content')

<a href="{{ route('attachments.create') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="plus"></i> New Attachment</a>
<h1 class="h3 mb-3">All Attachments</h1>

<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
				<!-- form -->
				<form action="{{ route('attachments.index') }}" method="GET" role="search">
					<div class="input-group input-group-search">
						<input type="text" class="form-control" id="datatables-attachment-search"
							minlength=3 name="term"
							value="{{ old('term', request('term')) }}" id="term"
							placeholder="Search attachments…" required>
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
					<a href="{{ route('attachments.index') }}" class="btn btn-primary btn-lg"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
						<i data-lucide="refresh-cw"></i></a>
					<a href="{{ route('attachments.export') }}" class="btn btn-light btn-lg me-2"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
						<i data-lucide="download"></i> Export</a>
				</div>
			</div>
		</div>

		<table class="table w-100">
			<thead>
				<tr>

					<th>#</th>
					<th>Entity</th>
					<th>Article ID</th>
					<th>Date</th>
					<th class="text-end">Size</th>
					<th>File</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($attachments as $attachment)
					<tr>
						<td>
							<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
						</td>
						<td>
							<a href="{{ route('attachments.show', $attachment->id) }}">
								<strong>{{ $attachment->entity }}</strong>
							</a>
						</td>
						<td>{{ $attachment->article_id }}</td>
						<td><x-landlord.list.my-date :value="$attachment->upload_date"/></td>
						<td class="text-end">{{ number_format($attachment->file_size / 1048576,2) }}</td>
						<td><x-landlord.attachment.show-by-id attachmentId="{{ $attachment->id }}"/></td>
						<td>
							<a href="{{ route('attachments.show',$attachment->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
								data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>
							<a href="{{ route('attachments.edit',$attachment->id) }}" class="text-body" data-bs-toggle="tooltip"
								data-bs-placement="top" title="Edit"><i data-lucide="edit"></i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="row mb-3">
			{{ $attachments->links() }}
		</div>

	</div>
</div>

@endsection

