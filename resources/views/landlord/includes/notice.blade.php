@if ($config->show_banner)
	<div class="alert alert-soft-danger alert-dismissible fade show" role="alert">
		<div class="d-flex">
			<div class="flex-shrink-0">
				<i data-lucide="alert-triangle"></i>
			</div>
			<div class="flex-grow-1 ms-2">
				<span class="fw-semibold">Notice!</span> {{ $config->banner_message }}
			</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	</div>
@endif