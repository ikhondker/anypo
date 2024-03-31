@extends('layouts.app')
@section('title','View Attachment')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('attachments.index') }}">Attachments</a></li>
	<li class="breadcrumb-item active">{{ $attachment->id }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Attachment
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Attachment"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Attachment Detail</h5>
					<h6 class="card-subtitle text-muted">Attachment details.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $attachment->org_file_name }}" label="File Name"/>

					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">File:</span>
						</div>
						<div class="col-sm-9">
							<x-tenant.attachment.single id="{{ $attachment->id }}"/>
						</div>
					</div>
					
					<x-tenant.show.my-text		value="{{ $attachment->entity }}"  label="Entity"/>
					<x-tenant.show.article-link entity="{{ $attachment->entity }}" :id="$attachment->article_id"/>
					<x-tenant.show.my-text		value="{{ $attachment->file_type }}"  label="File Type"/>
					<x-tenant.show.my-integer	value="{{ $attachment->file_size }}"  label="File Size"/>
					<x-tenant.show.my-text		value="{{ $attachment->owner->name }}"  label="Owner Name"/>
					
					<x-tenant.show.my-created-at value="{{ $attachment->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $attachment->created_at }}"/>
					
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->
@endsection

