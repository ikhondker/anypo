@extends('layouts.page')
@section('title','JQuery in Laravel 10 | anyPO.com')

@section('content')

<div id="app">

	<main class="container">
		<h1> IQBAL JQuery in Laravel 10? OK</h1>

		<button class="btn btn-success">Click Me</button>
	</main>
</div>


<div id="app1">
<p class="zoomable">
	Click me to zoom
</p>
</div>
{{-- <script type="module">
	$(document).ready(function(){
		$(".zoomable").click(function(){
			$(this).animate({
				fontSize: "40px"
			}, 1000);
		});
	});
</script> --}}

{{-- <script>
	$("button").click(function(){
		alert("Thanks");
	});
</script> --}}

@endsection
