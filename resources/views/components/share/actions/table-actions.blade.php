{{-- <a href="{{ route('tables.index') }}" class="btn btn-primary">Tables</a>
<a href="{{ route('tables.controllers') }}" class="btn btn-primary">Controller</a>
<a href="{{ route('tables.fnccontrollers') }}" class="btn btn-primary">Fnc Controller</a>
<a href="{{ route('tables.models') }}" class="btn btn-primary">Model</a>
<a href="{{ route('tables.routes') }}" class="btn btn-primary">All Routes</a>
<a href="{{ route('tables.route-code') }}" class="btn btn-primary">Route Code</a>
<a href="{{ route('tables.policies') }}" class="btn btn-primary">Policy</a>
<a href="{{ route('tables.index') }}" class="btn btn-primary">Helpers*</a>
<a href="{{ route('tables.comments') }}" class="btn btn-primary">Comments</a>
<a href="{{ route('tables.messages') }}" class="btn btn-primary">Msg in Class</a>
<a href="{{ route('tables.check') }}" class="btn btn-primary">Check Files*</a> --}}
{{-- <a href="{{ route('tables.check') }}" class="btn btn-primary">Del Class*</a> --}}
{{-- <a href="{{ route('tables.controllers') }}" class="btn btn-primary">Destroy</a> --}}

<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('tables.index') }}"><i class="align-middle me-1" data-lucide="user"></i> Tables</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('tables.controllers') }}"><i class="align-middle me-1" data-lucide="user"></i> Controller</a>
		<a class="dropdown-item" href="{{ route('tables.models') }}"><i class="align-middle me-1" data-lucide="user"></i> Model</a>
		<a class="dropdown-item" href="{{ route('tables.all-models') }}"><i class="align-middle me-1" data-lucide="user"></i> All Model</a>
		<a class="dropdown-item" href="{{ route('tables.policies') }}"><i class="align-middle me-1" data-lucide="user"></i> Policy</a>
		<a class="dropdown-item" href="{{ route('tables.helpers') }}"><i class="align-middle me-1" data-lucide="user"></i> Helpers</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('tables.fnc-controllers') }}"><i class="align-middle me-1" data-lucide="user"></i> Fnc Controller</a>
		<a class="dropdown-item" href="{{ route('tables.fnc-models') }}"><i class="align-middle me-1" data-lucide="user"></i> Fnc Model</a>
		<a class="dropdown-item" href="{{ route('tables.fnc-policies') }}"><i class="align-middle me-1" data-lucide="user"></i> Fnc Policies</a>
		<a class="dropdown-item" href="{{ route('tables.fnc-helpers') }}"><i class="align-middle me-1" data-lucide="user"></i> Fnc Helpers</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('tables.routes') }}"><i class="align-middle me-1" data-lucide="user"></i> All Routes</a>
		<a class="dropdown-item" href="{{ route('tables.route-code') }}"><i class="align-middle me-1" data-lucide="user"></i>Route Code</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('tables.comments') }}"><i class="align-middle me-1" data-lucide="user"></i> Header Comments</a>
		<a class="dropdown-item" href="{{ route('tables.messages') }}"><i class="align-middle me-1" data-lucide="user"></i> Msg in Class</a>
		<a class="dropdown-item" href="{{ route('tables.index') }}"><i class="align-middle me-1" data-lucide="user"></i> Del Class *</a>
		<a class="dropdown-item" href="{{ route('tables.check') }}"><i class="align-middle me-1" data-lucide="user"></i> Check Files*</a>
	</div>