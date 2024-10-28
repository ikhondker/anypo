@extends('layouts.tenant.app')
@section('title','Attachment')
@section('breadcrumb')
	<li class="breadcrumb-item active">Attachments</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Attachment
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar object="Attachment"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					Attachments Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of Attachments.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>ID#</th>
						<th>File Name</th>
						<th>Entity</th>
                        <th>Article</th>
						<th>Upload Date</th>
						<th>Owner</th>
						<th>File</th>
						<th>View</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($attachments as $attachment)
					<tr>
						<td>{{ $attachment->id }}</td>
						<td><a href="{{ route('attachments.show',$attachment->id) }}"><strong>{{ Str::limit($attachment->org_file_name,35) }}</strong></a></td>
						<td>{{ $attachment->entity }}</td>
                        <td>{{ $attachment->article_id }}</td>
						{{-- <td><x-tenant.list.article-link entity="{{ $attachment->entity }}" :id="$attachment->article_id"/></td> --}}
						<td><x-tenant.list.my-date-time :value="$attachment->upload_date"/></td>
						<td>{{ $attachment->owner->name }}</td>
						<td><x-tenant.attachment.single id="{{ $attachment->id }}"/></td>
						<td>
							<a href="{{ route('attachments.show',$attachment->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $attachments->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->



@endsection

