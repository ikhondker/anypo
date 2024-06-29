<div class="card mb-3">
	<div class="card-header">
		<h5 class="card-title mb-0">User Profile</h5>
	</div>
	<div class="card-body text-center">

		<img src="{{ Storage::disk('s3t')->url('avatar/'.$user->avatar) }}" alt="{{ $user->name }}" class="img-fluid rounded-circle mb-2" width="128" height="128" title="{{ $user->name }}">

		<h5 class="card-title mb-0">{{ $user->name }}</h5>
		<div class="text-muted mb-2">{{ $user->designation->name }}</div>

		{{-- <div>
			<a class="btn btn-primary btn-sm" href="#">Follow</a>
			<a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span> Message</a>
		</div> --}}
	</div>
	<hr class="my-0" />
	<div class="card-body">
		<h5 class="h6 card-title">Contact Info</h5>
		<ul class="list-unstyled mb-0">
			<li class="mb-1"><span data-feather="mail" class="feather-sm me-1"></span> Email : {{ $user->email }}</li>
			<li class="mb-1"><span data-feather="smartphone" class="feather-sm me-1"></span> Cell : {{ $user->cell }}</li>
			<li class="mb-1"><span data-feather="grid" class="feather-sm me-1"></span> Department : {{ $user->dept->name }}</li>
		</ul>
	</div>
	<hr class="my-0" />
	<div class="card-body">
		<h5 class="h6 card-title">Address</h5>
		<ul class="list-unstyled mb-0">
			<li class="mb-1"> {{ empty($user->address1 ) ? 'Empty Address Line 1' : $user->address1 }}</li>
			<li class="mb-1"> {{ empty($user->address1 ) ? 'Empty Address Line 2' : $user->address2 }}</li>
			<li class="mb-1"> {{ $user->city.', '.$user->state.', '.$user->zip }}</li>
			<li class="mb-1"> {{ $user->country_name->name }}</li>
		</ul>
	</div>

	<hr class="my-0" />
	<div class="card-body">
		<h5 class="h6 card-title">User Role</h5>
		<a href="#" class="badge badge-subtle-primary me-1 my-1">{{ $user->role }}</a>
	</div>

</div>
