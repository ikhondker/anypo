@extends('layouts.tenant.app')
@section('title','View Attachment')
@section('breadcrumb')
	{{-- <li class="breadcrumb-item"><a href="{{ route('attachments.index') }}" class="text-muted">Attachments</a></li> --}}
	<li class="breadcrumb-item active">Attachment</li>
	<li class="breadcrumb-item active">{{ $attachment->org_file_name }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Attachment
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>


	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				@if (auth()->user()->isSystem())
				<a class="btn btn-sm btn-light" href="{{ route('attachments.edit', $attachment->id) }}"><i data-lucide="edit"></i> Edit</a>
				@endif
				<a href="{{ route('attachments.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
			</div>
			<h5 class="card-title">Attachment Detail</h5>
			<h6 class="card-subtitle text-muted">Attachment details.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $attachment->summary }}" label="Description"/>
					<x-tenant.show.my-text		value="{{ $attachment->org_file_name }}" label="File Name"/>
					<x-tenant.show.my-text		value="{{ $attachment->entity }}" label="Entity"/>
					<x-tenant.show.article-link entity="{{ $attachment->entity }}" :id="$attachment->article_id"/>
					<x-tenant.show.my-text		value="{{ $attachment->file_type }}" label="File Type"/>
					<x-tenant.show.my-integer	value="{{ $attachment->file_size }}" label="File Size"/>
					<x-tenant.show.my-text		value="{{ $attachment->owner->name }}" label="Owner Name"/>
					<tr>
						<th>File :</th>
						<td><x-tenant.attachment.single id="{{ $attachment->id }}"/></td>
					</tr>
					<x-tenant.show.my-created-at value="{{ $attachment->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $attachment->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

@endsection

