

<div class="card">
	<div class="card-header">

		<h5 class="card-title">User Details</h5>
		<h6 class="card-subtitle text-muted">View User Profile.</h6>
	</div>
	<div class="card-body">
		<table class="table table-sm my-2">
			<tbody>

				<x-landlord.show.my-text value="{{ $user->name }}" />
				<x-landlord.show.my-text value="{{ $user->email }}" label="E-mail"/>
				<x-landlord.show.my-text value="{{ $user->cell }}" label="Cell"/>
				<x-landlord.show.my-badge value="{{ $user->role }}" label="Role"/>

				<x-landlord.show.my-text value="{{ $user->account->name }}" label="Account"/>

				<x-landlord.show.my-text value="{{ $user->address1 }}" label="Address1"/>
				<x-landlord.show.my-text value="{{ $user->address2 }}" label="Address2"/>
				<x-landlord.show.my-text value="{{ $user->city . ', ' . $user->state . ', ' . $user->zip }}" label="City-State-Zip"/>
				<x-landlord.show.my-text value="{{ $user->user_country->name }}" label="Country" />
				<x-landlord.show.my-enable value="{{ $user->enable }}" />

				<x-landlord.show.my-url		value="{{ $user->facebook }}" label="Facebook"/>
				<x-landlord.show.my-url		value="{{ $user->linkedin }}" label="LinkedIn"/>
				<x-landlord.show.my-text-area value="{{ $user->notes }}" label="About Myself"/>

				<x-landlord.show.my-date-time value="{{ $user->email_verified_at }}" label="Email Verified At" />
				<x-landlord.show.my-date-time	value="{{ $user->last_login_at }}" label="Last Login"/>
				<x-landlord.show.my-text		value="{{ $user->last_login_ip }}" label="Last Login IP"/>

				@if (auth()->user()->isSeeded())
					<x-landlord.show.my-enable value="{{ $user->seeded }}" label="Seeded" />
				@endif
			</tbody>
		</table>
	</div>
</div>

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
