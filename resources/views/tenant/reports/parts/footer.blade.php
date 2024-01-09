
<footer class="clearfix">
	<div id="timestamp">
		Printed at: {{ now()->format('d-M-Y H:i:s') }} by
			@if(Auth::check())
				{{ auth()->user()->name }}
			@else
				Guest
			@endif
			from: {{ URL::current() }}
	</div>
	<div id="pagenum">
		Page <span class="pagenum"></span>
	</div>
</footer>

{{--
<footer>
	<div class='parent'>
		<div class='timestamp'>timestamp 1</div>
		<div class='pagenum'>pagenum 2</div>
	</div>

</footer> --}}
