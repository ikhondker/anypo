@extends('layouts.landlord-app')
@section('title','Attachments')
@section('breadcrumb','View Attachments')


@section('content')
	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Attachment info</h4>
		</div>

		<!-- Body -->
		<div class="card-body">
			<x-landlord.show.my-id		id="{{ $attachment->id }}"/>
			<x-landlord.show.my-text	value="{{ $attachment->entity }}" label="Entity"/>
			<x-landlord.show.my-text	value="{{ $attachment->file_entity }}" label="File Entity:"/>
			<x-landlord.show.my-text	value="{{ $attachment->article_id }}" label="Article ID"/>
			<x-landlord.show.my-text	value="{{ $attachment->file_name }}" label="File Name"/>
			<x-landlord.show.my-text	value="{{ $attachment->org_file_name }}" label="Org File Name"/>

			<x-landlord.show.my-text	value="{{ $attachment->file_type }}" label="Type"/>
			<x-landlord.show.my-text	value="{{ number_format($attachment->file_size / 1048576,2)  }}" label="Size (MB)"/>
			<x-landlord.show.my-text	value="{{ $attachment->owner->name }}" label="Owner"/>
			<x-landlord.show.my-text	value="{{ $attachment->summary }}" c/>
			<x-landlord.show.my-badge	value="{{ $attachment->status }}" label="Status"/>

			<div class="row mb-4">
				<label class="col-sm-3 col-form-label form-label">Attachments X :</label>
				<div class="col-sm-9 col-form-label small">
					@if ($attachment->file_name <> '')
					<x-landlord.attachment.show-by-id id="{{ $attachment->id }}"/>
				@else
					Missing!
				@endif
				</div>
			</div>

			<x-landlord.show.my-text  value="{{ $attachment->user_created_by->name }}" label="Crated By"/>
			<x-landlord.show.my-date-time  value="{{ $attachment->created_at }}"/>
			<x-landlord.show.my-text  value="{{ $attachment->user_updated_by->name }}"  label="Updated By"/>
			<x-landlord.show.my-date-time  value="{{ $attachment->updated_at }}"/>
		</div>
		<!-- End Body -->

		<!-- Footer -->
		<div class="card-footer pt-0">
			<div class="d-flex justify-content-end gap-3">
			  <a class="btn btn-primary" href="{{ route('attachments.edit',$attachment->id) }}">Edit</a>
			</div>
		</div>
		<!-- End Footer -->
	</div>
	<!-- End Card -->


@endsection
