@extends('layouts.tenant.app')
@section('title','Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('items.index') }}" class="text-muted">Items</a></li>
	<li class="breadcrumb-item"><a href="{{ route('items.show',$item->id) }}" class="text-muted">{{ $item->name }}</a></li>
	<li class="breadcrumb-item active">Attachments</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Item : {{ $item->name }} : Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Item" label="Item"/>
			<x-tenant.actions.lookup.item-actions itemId="{{ $item->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	{{-- <x-tenant.info.pr-info prId="{{ $pr->id }}"/> --}}

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::ITEM->value }}" articleId="{{ $item->id }}"/>

	<div class="row">
		<div class="col-sm-6">
				<x-tenant.attachment.add entity="ITEM" articleId="{{ $item->id }}"/>

				{{-- <form action="{{ route('items.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="text" name="attach_item_id" id="attach_item_id" class="form-control" placeholder="ID" value="{{ old('id', $item->id ) }}" hidden>
					<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
					<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false"><i class="align-middle me-1" data-lucide="paperclip"></i> Add Attachment</a>
				</form>
				<!-- /.form end --> --}}
			</div>
		<div class="col-sm-6 text-end">
				<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('items.show', $item->id) }}"><i data-lucide="arrow-left-circle"></i> Back to Items</a>
		</div>
	</div>

	<script type="text/javascript">
		function mySubmit() {
			document.getElementById('frm1').submit();
		}
	</script>
@endsection

