@extends('layouts.tenant.app')
@section('title','View Item')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('items.index') }}" class="text-muted">Items</a></li>
	<li class="breadcrumb-item active">{{ $item->code }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Item
		@endslot
		@slot('buttons')
			@can('create', App\Models\Tenant\Lookup\Item::class)
				<x-tenant.buttons.header.create model="Item"/>
			@endcan
			<x-tenant.actions.lookup.item-actions itemId="{{ $item->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				@can('update', $item)
					<a class="btn btn-sm btn-light" href="{{ route('items.edit', $item->id ) }}"><i data-lucide="edit"></i> Edit</a>
				@endcan
			</div>
			<h5 class="card-title">Item Detail</h5>
			<h6 class="card-subtitle text-muted"><h6 class="card-subtitle text-muted">Detail Information of an Item.</h6>.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $item->name }}"/>
					<x-tenant.show.my-text		value="{{ $item->code }}" label="Code"/>
					<x-tenant.show.my-text		value="{{ $item->glType->name }}" label="Gl Type"/>
					<x-tenant.show.my-text		value="{{ $item->item_category->name }}" label="Category"/>
					<x-tenant.show.my-text		value="{{ $item->oem->name }}" label="OEM"/>
					<x-tenant.show.my-text		value="{{ $item->uom_class->name }}" label="UoM Class"/>
					<x-tenant.show.my-text		value="{{ $item->uom->name }}" label="UoM"/>
					<x-tenant.show.my-number	value="{{ $item->price }}" label="Price"/>
					<x-tenant.show.my-text		value="{{ $item->ac_expense }}" label="Expense Account"/>
					<x-tenant.show.my-boolean	value="{{ $item->enable }}"/>
					<x-tenant.show.my-created_at value="{{ $item->created_at }}"/>
					<x-tenant.show.my-updated_at value="{{ $item->updated_at }}"/>
                    <tr>
							<th>Attachments :</th>
							<td>
								<x-tenant.attachment.all entity="ITEM" articleId="{{ $item->id }}"/>
							</td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td>
								@can('update', $item)
                                    <x-tenant.attachment.add entity="ITEM" articleId="{{ $item->id }}"/>


									{{-- <!-- form start -->
									<form action="{{ route('items.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
										@csrf
										<input type="text" name="attach_item_id" id="attach_item_id" class="form-control" placeholder="1001" value="{{ old('id', $item->id ) }}" hidden>
										<div class="row">
											<div class="col-sm-3 text-end">

											</div>
											<div class="col-sm-9 text-end">
												<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
												<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false">Add Attachment</a>
											</div>
										</div>
									</form>
									<!-- /.form end --> --}}
								@endcan
							</td>
						</tr>

				</tbody>
			</table>
		</div>
	</div>
	<x-tenant.widgets.back-to-list model="Item"/>

<script type="text/javascript">
	function mySubmit() {
		document.getElementById('frm1').submit();
	}
</script>


@endsection

