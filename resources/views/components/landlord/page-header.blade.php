<div class="row mb-xl-3">
	<div class="col-auto d-none d-sm-block">
		<h3 class="mb-3"><i class="align-middle text-muted" data-lucide="grid"></i> {{ $title }}</h3>
	</div>

	<div class="col-auto ms-auto text-end mt-n1">
			<a href="{{ route('home') }}" class="btn btn-info shadow-sm float-end me-1">
				<i class="align-middle" data-lucide="home"></i>
			</a>
			<a href="{{ route('tickets.create') }}" class="btn btn-info shadow-sm float-end me-1">
				<i class="align-middle" data-lucide="circle-help"></i>
			</a>
			{{ $buttons }}
	</div>
</div>
