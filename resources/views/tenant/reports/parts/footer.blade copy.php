<footer>
	<div class='parent'>
		<div class='timestamp'>timestamp 1</div>
		<div class='pagenum'>pagenum 2</div>
	</div>
	<div>
		<div style="text-align:left"><br>
			Printed at: {{ now()->format('d-M-Y H:i:s') }} by
			@if(Auth::check())
				{{ auth()->user()->name }}
			@else
				Guest
			@endif
			from: {{ URL::current() }}
		</div>
		<div style="text-align:right">
			{{-- Printed at {{ strtoupper(date('d-M-Y: h:i:s')) }} by {{ auth()->user()->name}} --}}
			Page <span class="pagenum"></span>
		</div>
	</div>
</footer>
