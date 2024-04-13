<div class="w-md-75 w-lg-50 mx-md-auto m-5">
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<div class="d-flex">
			<div class="flex-shrink-0">
				<i class="bi bi-exclamation-triangle"></i>
			</div>
			<div class="flex-grow-1 ms-2">
				Error! {{ $message }}
				@if($errors->any())
					<ul>
						@foreach ($errors->all() as $error)
							<li class="">{{ $error }}</li>
						@endforeach
					</ul>
				@endif
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		</div>
	</div>
</div>