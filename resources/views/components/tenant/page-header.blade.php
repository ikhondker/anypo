<div class="row mb-2 mb-xl-3">
	<div class="col-auto d-none d-sm-block">
		<h3 class="mb-3"><i class="align-middle text-muted" data-lucide="grid"></i> {{ $title }}</h3>
	</div>
	<div class="col-auto ms-auto text-end mt-n1">
        <a href="{{ route('tickets.create') }}" class="btn btn-info shadow-sm float-end me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Create Support Ticket">
            <i class="align-middle" data-lucide="message-square"></i>
        </a>
        <a href="{{ route('docs.index') }}" class="btn btn-info shadow-sm float-end me-1" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Documentation">
            <i class="align-middle" data-lucide="book-open-text"></i>
        </a>
        {{ $buttons }}
	</div>
</div>
