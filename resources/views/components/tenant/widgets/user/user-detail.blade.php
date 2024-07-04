<div class="card">
	<div class="card-header">
        {{-- <div class="card-actions float-end">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i> Edit User</a>
        </div> --}}
        <h5 class="card-title">User Profile</h5>
        <h6 class="card-subtitle text-muted">View User Profile.</h6>
	</div>
	<div class="card-body">
		<table class="table table-sm my-2">
			<tbody>
				<tr>
					<th>Photo</th>
					<td><img src="{{ Storage::disk('s3t')->url('avatar/'.$user->avatar) }}" alt="{{ $user->name }}" class="img-fluid rounded-circle mb-2" width="128" height="128" title="{{ $user->name }}"></td>
				</tr>
				<x-tenant.show.my-text		value="{{ $user->name }}"/>
					<x-tenant.show.my-text		value="{{ $user->designation->name }}" label="Title"/>
					<x-tenant.show.my-text		value="{{ $user->dept->name }}" label="Dept"/>
					<x-tenant.show.my-badge		value="{{ $user->role }}" label="Role"/>
					<x-tenant.show.my-email		value="{{ $user->email }}"/>
					<x-tenant.show.my-text		value="{{ $user->cell }}" label="Cell"/>
					<x-tenant.show.my-boolean	value="{{ $user->enable }}"/>

					<x-tenant.show.my-url		value="{{ $user->facebook }}" label="Facebook"/>
					<x-tenant.show.my-url		value="{{ $user->linkedin }}" label="LinkedIn"/>
					<x-tenant.show.my-text-area value="{{ $user->notes }}" label="About Myself"/>

					<x-tenant.show.my-date-time	value="{{ $user->email_verified_at }}" label="Verified"/>
					<x-tenant.show.my-date-time	value="{{ $user->last_login_at }}" label="Last Login"/>
					<x-tenant.show.my-text		value="{{ $user->last_login_ip }}" label="Last Login IP"/>

					@if (auth()->user()->isSeeded())
						<x-tenant.show.my-boolean value="{{ $user->seeded }}" label="Seeded" />
					@endif
			</tbody>
		</table>
	</div>
</div>
