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
			<x-tenant.buttons.header.lists model="Pr" label="Requisition"/>
			<x-tenant.buttons.header.create model="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions prId="{{ $pr->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	{{-- <x-tenant.info.pr-info prId="{{ $pr->id }}"/> --}}

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::PR->value }}" articleId="{{ $pr->id }}"/>

	<div class="row">
		<div class="col-sm-6">
			@if ($pr->auth_status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
				<form action="{{ route('prs.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="text" name="attach_pr_id" id="attach_pr_id" class="form-control" placeholder="ID" value="{{ old('id', $pr->id ) }}" hidden>
					<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
					<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false"><i class="align-middle me-1" data-lucide="paperclip"></i> Add Attachment</a>
				</form>
				<!-- /.form end -->
			@endif
			</div>
		<div class="col-sm-6 text-end">
				<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('prs.show', $pr->id) }}"><i data-lucide="arrow-left-circle"></i> Back to PR</a>
		</div>
	</div>

	<script type="text/javascript">
		function mySubmit() {
			document.getElementById('frm1').submit();
		}
	</script>
@endsection

