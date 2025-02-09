<footer class="footer">
	<div class="container-fluid">
		<div class="row text-muted">
			<div class="col-6 text-start">
				<ul class="list-inline">
					<li class="list-inline-item">
						<a class="text-muted" href="{{ route('tickets.create') }}">Support</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="{{ route('docs.index') }}">Help Center</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="{{ route('privacy') }}">Privacy Policy</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="{{ route('tos') }}">Terms of Service</a>
					</li>

					@guest
						Welcome Guest. Please <a class="list-inline-item" href="{{ route('login') }}" class="text-primary">Login</a> here.
					@endguest
				</ul>
			</div>
			<div class="col-6 text-end">
				<p class="mb-0">
					@if ( (auth()->user()->role->value == UserRoleEnum::SYS->value))
						<a class="text-muted" href="http://localhost:8080/phpmyadmin/index.php?route=/database/structure&db=tenant{{ tenant('id') }}" target="_blank"> {{ tenant('id') }}</a> |
						<a class="text-muted" href="{{ route('tables.index') }}" target="_blank">Tables</a> |
						<a class="text-muted" href="{{ route('cps.ui') }}" target="_blank">UI</a> |
						Laravel v{{ app()->version() }} (PHP v{{ phpversion() }})
					@endif
					<script>document.write(new Date().getFullYear())</script> © <a href="https://anypo.net/" target="_blank" class="text-reset">{{ config('app.name') }}</a></p>
				</p>
			</div>
		</div>
	</div>
</footer>
