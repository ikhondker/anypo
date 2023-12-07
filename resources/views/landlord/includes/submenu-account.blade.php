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
			href="{{ route('users.my-password-change', auth()->user()->id) }}">
			<i class="bi-shield-shaded nav-icon"></i> Change Password
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'users.index' ? 'active' : '' }}" href="{{ route('logout') }}">
			<i class="bi-box-arrow-right nav-icon"></i> Logout
		</a>
	</li>
</ul>
<!-- End List -->