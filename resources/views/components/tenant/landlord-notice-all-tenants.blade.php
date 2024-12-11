<!-- Show Tenant Notice -->
@if ($anyNotice )
	<div class="alert alert-danger alert-outline alert-dismissible" role="alert">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		<div class="alert-icon">
			<i data-lucide="bell"></i>
		</div>
		<div class="alert-message text-danger">
			<strong class="text-danger">ANNOUNCEMENT : </strong> {{ $notice }}
		</div>
	</div>
@endif
