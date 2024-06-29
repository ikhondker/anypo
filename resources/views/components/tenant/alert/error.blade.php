<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	<div class="alert-icon">
		<i data-lucide="alert-triangle" class="text-danger"></i>
	</div>
	<div class="alert-message">
		<strong>Error!</strong> {{ $message }} 
		@if($errors->any())
			<ul>
				@foreach ($errors->all() as $error)
					<li class="">{{ $error }}</li>
				@endforeach
			</ul>
		@endif
	</div>
</div>