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
		<x-tenant.show.my-text		value="{{ $user->designation->name }}" label="Title"/>
		<x-tenant.show.my-text		value="{{ $user->dept->name }}" label="Dept"/>
		<x-tenant.show.my-badge		value="{{ $user->role }}" label="Role"/>
		<x-tenant.show.my-email		value="{{ $user->email }}"/>
		<x-tenant.show.my-text		value="{{ $user->cell }}" label="Cell"/>
		<x-tenant.show.my-boolean	value="{{ $user->enable }}"/>
			
		<hr />
		<x-tenant.show.my-url		value="{{ $user->facebook }}" label="Facebook"/>
		<x-tenant.show.my-url		value="{{ $user->linkedin }}" label="LinkedIn"/>
		<x-tenant.show.my-text-area value="{{ $user->notes }}" label="About Myself"/>
			
		<hr />
		<x-tenant.show.my-date-time	value="{{ $user->email_verified_at }}" label="Verified"/>
		<x-tenant.show.my-date-time	value="{{ $user->last_login_at }}" label="Last Login"/>
		<x-tenant.show.my-text		value="{{ $user->last_login_ip }}" label="Last Login IP"/>
	
	</div>
</div>