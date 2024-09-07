@extends('layouts.tenant.app')
@section('title','Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}" class="text-muted">Requisitions</a></li>
	<li class="breadcrumb-item"><a href="{{ route('prs.show',$pr->id) }}" class="text-muted">PR#{{ $pr->id }}</a></li>
	<li class="breadcrumb-item active">Attachments</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			PR #{{ $pr->id }} : Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr" label="Requisition"/>
			<x-tenant.buttons.header.create object="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions prId="{{ $pr->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>
	
	{{-- <x-tenant.info.pr-info prId="{{ $pr->id }}"/> --}}

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::PR->value }}" articleId="{{ $pr->id }}"/>

		<div class="row">
			<div class="col-sm-6">
				@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
				<form action="{{ route('prs.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="text" name="attach_pr_id" id="attach_pr_id" class="form-control" placeholder="ID" value="{{ old('id', $pr->id ) }}" hidden>
					
					<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
					<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false">Add Attachment1</a>
					{{-- <x-show.my-edit-link object="Pr" :id="$pr->id"/> --}}
					</form>
					<!-- /.form end -->
					@endif
				</div>
				<div class="col-sm-6 text-end">
					<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('prs.show', $pr->id) }}"><i data-lucide="arrow-left-circle"></i> Back to PR1</a>
				</div>
		</div>




		<div class="card-header">
			<div class="float-end">
				<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('prs.show', $pr->id) }}"><i data-lucide="arrow-left-circle"></i> Back to PR</a>
			</div>

			@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
				<form action="{{ route('prs.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="text" name="attach_pr_id" id="attach_pr_id" class="form-control" placeholder="ID" value="{{ old('id', $pr->id ) }}" hidden>
					<div class="row">
						<div class="col-sm-3 text-end">

						</div>
						<div class="col-sm-9">
							<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
							<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false">Add Attachment</a>
							{{-- <x-show.my-edit-link object="Pr" :id="$pr->id"/> --}}
						</div>
					</div>
				</form>
				<!-- /.form end -->
			@endif
		</div>

		<script type="text/javascript">
			function mySubmit() {
				document.getElementById('frm1').submit();
			}
		</script>
		
		
@endsection

