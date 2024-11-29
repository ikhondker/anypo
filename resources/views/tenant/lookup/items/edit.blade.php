@extends('layouts.tenant.app')
@section('title','Edit Item')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('items.index') }}" class="text-muted">Items</a></li>
	<li class="breadcrumb-item"><a href="{{ route('items.show',$item->id) }}" class="text-muted">{{ $item->code }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Item
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.item-actions itemId="{{ $item->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('items.update',$item->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('items.create') }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i> Create</a>
					<a href="{{ route('items.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Edit Item</h5>
				<h6 class="card-subtitle text-muted">Edit Item Details.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th width="25%">Code :</th>
							<td>
								<input type="text" class="form-control @error('code') is-invalid @enderror"
								name="code" id="code" placeholder="XXXX" maxlength="25"
								style="text-transform: uppercase"
								value="{{ old('code', $item->code ) }}"
								required/>
							@error('code')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<x-tenant.edit.name :value="$item->name"/>
						<tr>
							<th>Item Category :</th>
							<td>
								<select class="form-control" name="item_category_id">
									@foreach ($itemCategories as $itemCategory)
										<option {{ $itemCategory->id == old('item_category_id',$item->item_category_id) ? 'selected' : '' }} value="{{ $itemCategory->id }}">{{ $itemCategory->name }}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<x-tenant.edit.price :value="$item->price"/>
						<tr>
							<th>UoM Class :<x-tenant.info info="Note: You wont be able to change the UoM Class."/></th>
							<td>
								<input type="text" class="form-control @error('uom_class_name') is-invalid @enderror"
							name="uom_class_name" id="uom_class_name" placeholder="uom_class_name"
							value="{{ old('uom_class_name', $item->uom_class->name ) }}"
							readonly/>
							</td>
						</tr>
						<tr>
							<th>UoM :</th>
							<td>
								<select class="form-control" name="uom_id">
									@foreach ($uoms as $uom)
										<option {{ $uom->id == old('pm_id',$item->uom_id) ? 'selected' : '' }} value="{{ $uom->id }}">{{ $uom->name }}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<th>OEM :</th>
							<td>
								<select class="form-control" name="oem_id">
									@foreach ($oems as $oem)
										<option {{ $oem->id == old('pm_id',$item->oem_id) ? 'selected' : '' }} value="{{ $oem->id }}">{{ $oem->name }}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<th>GL Type :</th>
							<td>
								<select class="form-control" name="gl_type">
									@foreach ($gl_types as $gl_type)
										<option {{ $gl_type->gl_type == old('pm_id',$item->gl_type) ? 'selected' : '' }} value="{{ $gl_type->gl_type }}">{{ $gl_type->name }}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<th>Expense GL Code :</th>
							<td>
								<input type="text" class="form-control @error('ac_expense') is-invalid @enderror"
								name="ac_expense" id="ac_expense" placeholder="A600001" maxlength="255"
								style="text-transform: uppercase"
								value="{{ old('ac_expense', $item->ac_expense ) }}"
								required/>
							@error('ac_expense')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<x-tenant.edit.notes value="{{ $item->notes }}"/>
						<x-tenant.edit.save/>

					</tbody>
				</table>
			</div>
		</div>




	</form>
	<!-- /.form end -->
@endsection

