
 <!-- Navbar STart -->
 <header id="topnav" class="defaultscroll sticky tagline-height">
    <div class="container">
        <!-- Logo container-->
        <a class="logo" href="index.html">
            <img src="{{asset('/site/images/logo-dark.png')}}" class="logo-light-mode" alt="">
            <img src="{{asset('/site/images/logo-light.png')}}" class="logo-dark-mode" alt="">
        </a>
        <!-- End Logo container-->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

        {{-- <ul class="buy-button list-inline mb-0">
            <li class="list-inline-item search-icon mb-0">
                <div class="dropdown">
                    <button type="button" class="btn btn-link text-decoration-none dropdown-toggle mb-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="uil uil-search h5 text-dark mb-0"></i>
                    </button>
                    <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-4 py-0" style="width: 300px;">
                        <form class="p-4">
                            <input type="text" id="text" name="name" class="form-control border bg-white" placeholder="Search...">
                        </form>
                    </div>
                </div>
            </li>
        </ul> --}}

        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu nav-right">
                <li><a href="{{ route('welcome') }}" class="sub-menu-item">Home</a></li>
                <li><a href="{{ route('product') }}" class="sub-menu-item">{{ config('app.name') }}</a></li>
                <li><a href="{{ route('home.pricing') }}" class="sub-menu-item">Pricing</a></li>
                {{-- <li><a href="{{ route('page') }}" class="sub-menu-item">Tickets</a></li> --}}
                <li><a href="{{ route('faq') }}" class="sub-menu-item">FAQ</a></li>
                <li><a href="{{ route('about') }}" class="sub-menu-item">About Us</a></li>
                <li><a href="{{ route('contact-us') }}" class="sub-menu-item">Contact Us</a></li>
                @auth
               
                    @switch(auth()->user()->role->value)
                        @case(UserRoleEnum::USER->value)
                            @break
                        @case(UserRoleEnum::ADMIN->value)
                            @break
                        @case(UserRoleEnum::SUPPORT->value)
                        
                        @case(UserRoleEnum::MANAGER->value)
                            <li class="has-submenu parent-parent-menu-item">
                                <a href="javascript:void(0)">Support</a><span class="menu-arrow"></span>
                                <ul class="submenu">
                                    <li><a class="sub-menu-item" href="{{ route('notifications.index') }}">Notifications</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('contacts.index') }}">All Contacts</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('users.index') }}">All Users</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('tickets.support') }}">All Tickets</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('services.index') }}">All Services</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('accounts.index') }}">All Accounts</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('attachments.index') }}">Attachments</a></li>
                                </ul>
                            </li>
                            @break
                        @case(UserRoleEnum::SYSTEM->value)
                            <li class="has-submenu parent-parent-menu-item">
                                <a href="javascript:void(0)">System</a><span class="menu-arrow"></span>
                                <ul class="submenu">
                                    <li><a class="sub-menu-item" href="{{ route('notifications.index') }}">Notifications</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('tables.index') }}">Tables</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('templates.index') }}">Templates</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('activities.index') }}">Activity</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('contacts.index') }}">All Contacts</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('users.index') }}">All Users</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('tickets.support') }}">All Tickets</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('checkouts.index') }}">All Checkouts</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('services.index') }}">All Services</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('accounts.index') }}">All Accounts</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('products.index') }}">Products</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('attachments.index') }}">Attachments</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('invoices.create') }}">Create Invoice</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('processes.index') }}">Process</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('entities.index') }}">Entity</a></li>
                                    <li><a class="sub-menu-item" href="{{ route('setups.index') }}">Setup</a></li>
                                </ul>
                            </li>
                            @break
                        @default
                            //
                    @endswitch
                @endauth

            </ul><!--end navigation menu-->
        </div><!--end navigation-->
    </div><!--end container-->
</header><!--end header-->
<!-- Navbar End -->