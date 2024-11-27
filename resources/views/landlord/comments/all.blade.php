@extends('layouts.landlord.app')
@section('title', 'Comments')
@section('breadcrumb')
	<li class="breadcrumb-item active">Comments</li>
@endsection


@section('content')


	<h1 class="h3 mb-3">All Comments</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('comments.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-comment-search"
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
						<a href="{{ route('comments.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>Comment</th>
						<th>Attachment</th>
						<th>Internal?</th>
						<th>Comment By</th>
						<th>Comment Date</th>
						<th>Ticket</th>
						<th>Ticket Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($comments as $comment)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
							</td>
							<td>{{ Carbon\Carbon::parse($comment->comment_date)->ago() }}</td>
							<td>
								<a href="{{ route('comments.show', $comment->id) }}">
									<strong>{{ Str::limit($comment->content, 45) }}</strong>
								</a>
							</td>
							<td><x-landlord.attachment.show-by-id attachmentId="{{ $comment->attachment_id }}"/></td>
							<td><x-landlord.list.my-enable :value="$comment->is_internal" /></td>
							<td>{{ $comment->owner->name }}</td>
							<td>{{ Carbon\Carbon::parse($comment->ticket->ticket_date)->ago() }}</td>
							<td>
								<a href="{{ route('tickets.show', $comment->ticket_id) }}" class="text-muted">
									<strong>{{ Str::limit($comment->ticket->title, 45) }}</strong>
								</a>
								<br>
								<span class="small text-muted">{{ $comment->ticket->owner->name }}</span>
							</td>
							<td>
								<x-landlord.list.my-badge value="{{ $comment->ticket->status->name }}" badge="{{ $comment->ticket->status->badge }}"/>
							</td>
							<td>
								<a href="{{ route('comments.show',$comment->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>
								<a href="{{ route('comments.edit',$comment->id) }}" class="text-body" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Edit"><i data-lucide="edit"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $comments->links() }}
			</div>

		</div>
	</div>

@endsection
