@extends('layouts.tenant.app')
@section('title','View Item')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('upload-items.index') }}">Interface Items</a></li>
	<li class="breadcrumb-item active">{{ $uploadItem->item_code }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Item
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="UploadItem"/>
			<x-tenant.buttons.header.edit object="UploadItem" :id="$uploadItem->id"/>
		@endslot
	</x-tenant.page-header>
	
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Item Detail (In Interface Table) </h5>
					<h6 class="card-subtitle text-muted">Item Interface Data Detail.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-badge		value="{{ $uploadItem->id }}" label="ID"/>
					<x-tenant.show.my-text		value="{{ $uploadItem->item_code }}" label="Code"/>	
					<x-tenant.show.my-text		value="{{ $uploadItem->item_name }}"/>
					<x-tenant.show.my-text		value="{{ $uploadItem->category_name }}" label="Category"/>
					<x-tenant.show.my-text		value="{{ $uploadItem->oem_name }}" label="OEM"/>
					<x-tenant.show.my-text		value="{{ $uploadItem->uom_name }}" label="UoM"/>
					<x-tenant.show.my-number	value="{{ $uploadItem->price }}" label="Price"/>
					<x-tenant.show.my-text		value="{{ $uploadItem->gl_type_name }}" label="GL Type"/>
					<x-tenant.show.my-text		value="{{ $uploadItem->ac_expense }}" label="Expense GL Code"/>
					<x-tenant.show.my-badge		value="{{ $uploadItem->error_code }}" label="Error Code"/>
					<x-tenant.show.my-text		value="{{ $uploadItem->customError->message }}" label="Error Message"/>
					<x-tenant.show.my-text		value="{{ $uploadItem->owner->name }}" label="Upload By"/>
					<x-tenant.show.my-badge		value="{{ $uploadItem->status }}" label="Status"/>
					<x-tenant.show.my-text		value="{{ $uploadItem->category_id }}" label="Category ID"/>
					<x-tenant.show.my-text		value="{{ $uploadItem->uom_id }}" label="UoM ID"/>
					<x-tenant.show.my-text		value="{{ $uploadItem->oem_id }}" label="OEM ID"/>
					<x-tenant.show.my-created_at	value="{{ $uploadItem->created_at }}"/>
					<x-tenant.show.my-updated_at	value="{{ $uploadItem->updated_at }}"/>
						<x-tenant.buttons.show.edit object="UploadItem" :id="$uploadItem->id"/>

				</div>
			</div>
		</div>
		<!-- end col-6 -->
		
	</div>
	<!-- end row -->

@endsection

