<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'upload-items.show')
			@can('update', $uploadItem)
				<a class="dropdown-item" href="{{ route('upload-items.edit', $uploadItem->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Interface Item</a>
			@endcan
		@endif
		@if (Route::current()->getName() == 'upload-items.edit')
			<a class="dropdown-item" href="{{ route('upload-items.show', $uploadItem->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Interface Item</a>
		@endif

		<a class="dropdown-item" href="{{ route('upload-items.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>


		@can('delete', $uploadItem)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item sw2-advance" href="{{ route('upload-items.destroy', $uploadItem->id) }}"
				data-entity="UploadItem" data-name="{{ $uploadItem->item_name }}" data-status="Delete"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Interface Item">
				<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Delete  Interface Item</a>
		@endcan

	</div>
</div>
