<!-- Nav -->
{{-- <ul class="nav nav-sm mb-3">
	<li class="nav-item m-1">
		<span class="badge bg-primary"><a class="text-white" href="{{ route('tables.index') }}">Tables</a></span>
	</li>
	<li class="nav-item  m-1">
		<span class="badge bg-primary"><a class="text-white" href="{{ route('tables.controllers') }}">Controller</a></span> 
	</li>
	<li class="nav-item m-1">
		<span class="badge bg-primary">	<a class="text-white" href="{{ route('tables.models') }}">Model</a></span>
	</li>
	<li class="nav-item m-1">
		<span class="badge bg-primary"><a class="text-white" href="{{ route('tables.routes') }}">All Routes</a></span>
	</li>
	<li class="nav-item m-1">
		<span class="badge bg-primary"><a class="text-white" href="{{ route('tables.route-code') }}">Route Code</a></span>
	</li>
	<li class="nav-item m-1">
		<span class="badge bg-primary"><a class="text-white" href="{{ route('tables.policies') }}">Policy</a></span>
	</li>
	<li class="nav-item m-1">
		<span class="badge bg-primary"><a class="text-white" href="{{ route('tables.comments') }}">Comments</a></span>
	</li>
	<li class="nav-item m-1">
		<span class="badge bg-primary"><a class="text-white" href="{{ route('tables.messages') }}">Msg in Class</a></span>
	</li>
	<li class="nav-item m-1">
		<span class="badge bg-primary"><a class="text-white" href="{{ route('tables.check') }}">Check Files*</a></span>
	</li>
</ul> --}}
<!-- End Nav -->


<!-- Dropdown -->
<div class="btn-group">
	<button class="btn  btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButtonLight" data-bs-toggle="dropdown" aria-expanded="false">
	  Actions
	</button>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuButtonLight">
	  <a class="dropdown-item" href="{{ route('tables.index') }}">Tables</a>
	  <a class="dropdown-item" href="{{ route('tables.controllers') }}">Controller</a>
	  <a class="dropdown-item" href="{{ route('tables.models') }}">Model</a>
	  <a class="dropdown-item" href="{{ route('tables.policies') }}">Policy</a>
	  <a class="dropdown-item" href="{{ route('tables.helpers') }}">Helpers</a>
	  <a class="dropdown-item" href="{{ route('tables.routes') }}">All Routes</a>
	  <a class="dropdown-item" href="{{ route('tables.route-code') }}">Route Code</a>
	  <a class="dropdown-item" href="{{ route('tables.comments') }}">Comments</a>
	  <a class="dropdown-item" href="{{ route('tables.messages') }}">Msg in Class</a>
	  <a class="dropdown-item" href="{{ route('tables.check') }}">Check Files*</a>
	</div>
</div>
<!-- End Dropdown -->

<!-- Dropdown -->
<div class="btn-group">
	<button class="btn  btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButtonLight" data-bs-toggle="dropdown" aria-expanded="false">
	  Functions
	</button>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuButtonLight">
	  <a class="dropdown-item" href="{{ route('tables.fnc-controllers') }}"> Fnc Controller</a>
	  <a class="dropdown-item" href="{{ route('tables.fnc-models') }}"> Fnc Model</a>
	  <a class="dropdown-item" href="{{ route('tables.fnc-policies') }}"> Fnc Policies</a>
	  <a class="dropdown-item" href="{{ route('tables.fnc-helpers') }}">Fnc Helpers</a>
	</div>
</div>
<!-- End Dropdown -->