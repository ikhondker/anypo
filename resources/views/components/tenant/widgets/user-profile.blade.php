<div class="row">
	<div class="col-md-4 col-xl-3">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="card-title mb-0">Profile Details</h5>
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
				<a href="#" class="badge bg-primary me-1 my-1">{{ $user->role }}</a>
			</div>
			
		</div>
	</div>

	<div class="col-md-8 col-xl-9">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
						
					</div>
				</div>
				<h5 class="card-title mb-0">User Details</h5>
			</div>
			<div class="card-body h-100">

				<x-tenant.show.my-text		value="{{ $user->name }}"/>
				<x-tenant.show.my-email		value="{{ $user->email }}"/>
				<x-tenant.show.my-text		value="{{ $user->cell }}" label="Cell"/>
				<x-tenant.show.my-text		value="{{ $user->designation->name }}" label="Title"/>
				<x-tenant.show.my-text		value="{{ $user->dept->name }}" label="Dept"/>
				<x-tenant.show.my-badge		value="{{ $user->role }}" label="Role"/>
				<x-tenant.show.my-boolean	value="{{ $user->enable }}"/>

					
				<hr />
				<x-tenant.show.my-url		value="{{ $user->facebook }}" label="Facebook"/>
				<x-tenant.show.my-url		value="{{ $user->linkedin }}" label="LinkedIn"/>
				<x-tenant.show.my-date-time	value="{{ $user->email_verified_at }}" label="Verified"/>
				<x-tenant.show.my-date-time	value="{{ $user->last_login_at }}" label="Last Login"/>
				<x-tenant.show.my-text		value="{{ $user->last_login_ip }}" label="Last Login IP"/>

				<hr />
				<x-tenant.show.my-text-area value="{{ $user->notes }}" label="About Myself"/>
			
			</div>
		</div>
	</div>
</div>
