@extends('layouts.tenant.app')
@section('title',' Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}" class="text-muted">PO#{{ $po->id }}</a></li>
	<li class="breadcrumb-item active">Attachments</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions poId="{{ $po->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.po-info poId="{{ $po->id }}"/>

	<x-tenant.attachment.list-all-by-article entity="{{ App\Enum\Tenant\EntityEnum::PO->value }}" articleId="{{ $po->id }}"/>

	<div class="row">
		<div class="col-sm-6">
			@if ($po->auth_status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
				<form action="{{ route('pos.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="text" name="attach_po_id" id="attach_po_id" class="form-control" placeholder="ID" value="{{ old('id', $po->id ) }}" hidden>
					<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
					<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false"><i class="align-middle me-1" data-lucide="paperclip"></i> Add Attachment</a>
				</form>
				<!-- /.form end -->
			@endif
			</div>
		<div class="col-sm-6 text-end">
				<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('pos.show', $po->id) }}"><i data-lucide="arrow-left-circle"></i> Back to PO</a>
		</div>
	</div>

	<script type="text/javascript">
		function mySubmit() {
			document.getElementById('frm1').submit();
		}
	</script>

@endsection

