<div class="w-md-75 w-lg-50 mx-md-auto m-5 text-left">
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong><i class="bi bi-exclamation-triangle" style="font-size: 1.3rem;"> </i> Error!</strong>  {{ $message }} 
		@if($errors->any())
			<ul class="m-3">
				@foreach ($errors->all() as $error)
					<li class="">{{ $error }}</li>
				@endforeach
			</ul>
		@endif

		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
	</div>
</div>

{{-- 

<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong><i class="bi bi-exclamation-triangle"></i> Error!</strong>  {{ $message }} 
	@if($errors->any())
	<ul>
		@foreach ($errors->all() as $error)
			<li class=""><i class="bi bi-exclamation-triangle"></i> {{ $error }}</li>
		@endforeach
	</ul>
	@endif
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
</div> --}}
