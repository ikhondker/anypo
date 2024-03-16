<!-- Nav -->
<span class="text-cap">Account</span>
<!-- List -->
<ul class="nav nav-sm nav-tabs nav-vertical mb-4">
	{{-- <li class="nav-item">
		<a class="nav-link {{ $_route_name == 'users.index' ? 'active' : '' }}"
			href="{{ route('users.index', auth()->user()->id) }}">
			<i class="bi-person-badge nav-icon"></i> Users
		</a>
	</li> --}}
	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'users.show' ? 'active' : '' }}"
			href="{{ route('users.show', auth()->user()->id) }}">
			<i class="bi-person-circle nav-icon"></i> View Profile 
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'users.password' ? 'active' : '' }}"
			href="{{ route('users.password-change', auth()->user()->id) }}">
			<i class="bi-shield-shaded nav-icon"></i> Change Password
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'users.index' ? 'active' : '' }}" href="{{ route('logout') }}">
			<i class="bi bi-power nav-icon text-danger"></i> Logout
		</a>
	</li>

	@if(session('original_user'))
		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'users.index' ? 'active' : '' }}" href="{{ route('users.leave-impersonate') }}">
				<i class="bi bi-power nav-icon text-danger"></i> Leave Impersonate
			</a>
		</li>
	@endif

</ul>
<!-- End List -->