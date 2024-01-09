<div class="row mb-2 mb-xl-3">
	<div class="col-auto d-none d-sm-block">
		<h3><i class="align-middle text-primary" data-feather="grid"></i> {{ $title }}</h3>
	</div>

	<div class="col-auto ms-auto text-end mt-n1">
		{{-- <div class="dropdown position-relative"> --}}
			<a href="{{ route('tickets.create') }}" class="btn btn-info float-end me-1">
				<i class="align-middle" data-feather="message-square"></i>
			</a>
			<a href="{{ route('help') }}" class="btn btn-info float-end me-1">
				  <i class="align-middle" data-feather="help-circle"></i>
			</a>

			{{-- <div class="dropdown-menu dropdown-menu-end">
				<a class="dropdown-item" href="{{ route('prs.create') }}">Create PR</a>
				<a class="dropdown-item" href="{{ route('pos.create') }}">Create PO</a>
				<a class="dropdown-item" href="{{ route('receipts.create') }}">Create Receipt</a>
				<a class="dropdown-item" href="{{ route('items.create') }}">Create Item</a>
			</div> --}}
			{{ $buttons }}
		{{-- </div> --}}
	  {{-- <a href="#" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> Home</a>
	  <a href="#" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New project</a> --}}
	</div>
</div>
