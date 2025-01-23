@extends('layouts.landlord.app')
@section('title','Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('attachments.index') }}" class="text-muted">Attachments</a></li>
	<li class="breadcrumb-item active">{{ $attachment->id }}</li>
@endsection

@section('content')

	<a href="{{ route('attachments.index') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="database"></i> View all</a>
	<h1 class="h3 mb-3">View Attachment</h1>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('activities.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
				@if (auth()->user()->isSys())
					<a class="btn btn-sm btn-danger text-white" href="{{ route('attachments.edit', $attachment->id) }}"><i data-lucide="edit"></i> Edit</a>
				@endif
			</div>
			<h5 class="card-title">View Attachment</h5>
			<h6 class="card-subtitle text-muted">View Attachment Detail.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-landlord.show.my-id		id="{{ $attachment->id }}"/>
					<x-landlord.show.my-text	value="{{ $attachment->entity }}" label="Entity"/>
					<x-landlord.show.my-text	value="{{ $attachment->file_entity }}" label="File Entity:"/>
					<x-landlord.show.my-text	value="{{ $attachment->article_id }}" label="Article ID"/>
					<x-landlord.show.my-text	value="{{ $attachment->file_name }}" label="File Name"/>
					<x-landlord.show.my-text	value="{{ $attachment->org_file_name }}" label="Org File Name"/>

					<x-landlord.show.my-text	value="{{ $attachment->file_type }}" label="Type"/>
					<x-landlord.show.my-text	value="{{ number_format($attachment->file_size / 1048576,2) }}" label="Size (MB)"/>
					<x-landlord.show.my-text	value="{{ $attachment->owner->name }}" label="Owner"/>
					<x-landlord.show.my-text	value="{{ $attachment->summary }}" c/>
					<x-landlord.show.my-badge	value="{{ $attachment->status }}" label="Status"/>

					<tr>
						<th>Attachments :</th>
						<td>
							@if ($attachment->file_name <> '')
							<x-landlord.attachment.show-by-id attachmentId="{{ $attachment->id }}"/>
						@else
							Missing!
						@endif
						</td>
					</tr>
					<x-landlord.show.my-text value="{{ $attachment->user_created_by->name }}" label="Crated By"/>
					<x-landlord.show.my-date-time value="{{ $attachment->created_at }}"/>
					<x-landlord.show.my-text value="{{ $attachment->user_updated_by->name }}" label="Updated By"/>
					<x-landlord.show.my-date-time value="{{ $attachment->updated_at }}"/>
				</tbody>
			</table>
		</div>
	</div>


@endsection
