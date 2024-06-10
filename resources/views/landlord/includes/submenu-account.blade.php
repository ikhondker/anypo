<li class="sidebar-header">
    Account
</li>
<li class="sidebar-item {{ $_route_name == 'users.show' ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('users.show', auth()->user()->id) }}">
        <i class="align-middle" data-lucide="home"></i> <span class="align-middle">View Profile</span>
    </a>
</li>
<li class="sidebar-item {{ $_route_name == 'users.password' ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('users.password-change', auth()->user()->id) }}">
        <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Change Password</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('logout') }}">
        <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Logout</span>
    </a>
</li>

@if(session('original_user'))
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('users.leave-impersonate') }}">
            <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Leave Impersonate</span>
        </a>
    </li>
@endif
