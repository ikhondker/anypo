@extends('layouts.tenant.app')
@section('title','Edit Attachment')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('attachments.show',$attachment->id) }}" class="text-muted">Attachment #{{ $attachment->id }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Attachment
		@endslot
		@slot('buttons')
			{{-- <x-tenant.actions.lookup.dept-actions deptId="{{ $dept->id }}"/> --}}
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('attachments.update',$attachment->id) }}" method="POST">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					@if (auth()->user()->isSystem())
						<a href="{{ route('attachments.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
						<a href="{{ route('attachments.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
					@endif
				</div>
				<h5 class="card-title">Edit Attachment</h5>
				<h6 class="card-subtitle text-muted">Edit Attachment description.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.edit.summary 		value="{{ $attachment->summary }}"/>
						<x-tenant.show.my-text		value="{{ $attachment->org_file_name }}" label="File Name"/>
						<x-tenant.show.article-link entity="{{ $attachment->entity }}" :id="$attachment->article_id"/>
						<x-tenant.show.my-text		value="{{ $attachment->file_type }}" label="File Type"/>
						<x-tenant.show.my-integer	value="{{ $attachment->file_size }}" label="File Size"/>
						<x-tenant.show.my-text		value="{{ $attachment->owner->name }}" label="Owner Name"/>
						<x-tenant.show.my-created-at value="{{ $attachment->updated_at }}"/>
						<x-tenant.show.my-updated-at value="{{ $attachment->created_at }}"/>
						<tr>
							<th>File :</th>
							<td><x-tenant.attachment.single id="{{ $attachment->id }}"/></td>
						</tr>
						<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->

@endsection

