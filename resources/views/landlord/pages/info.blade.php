@extends('layouts.landlord.page')
@section('title','Information')

@section('content')
	<section class="py-6 bg-white">
		<div class="container">
			<div class="mb-5 text-center">
				<span class="text-uppercase text-primary text-sm fw-medium mb-1 d-block">Information</span>
				<h2 class="h1">INFORMATION</h2>
				{{-- <p class="text-muted fs-lg">One simple pricing model. All you need to start. No hidden costs.</p> --}}
			</div>
			<div class="row text-center">
				<h1 class="h2 text-info"><i data-lucide="alert-circle"></i>	 {{ !isset($title) ? "Information!" : $title }}</h1>
				<p>&nbsp;</p>
				<p class="card-text">{{ !isset($msg) ? "Task completed successfully!" : $msg }}</p>
				<div class="mt-4">
					<a href="{{ route('home') }}" class="btn btn-primary btn-lg btn-pill"><i data-lucide="home"></i> Go to Home</a>
				</div>
				<p>&nbsp;</p>
				<p class="card-text small">We are available 24 hours a day to assist you via our <a href="{{ config('app.url') }}">support ticket system </a> or via email at support{{ '@'.config('app.domain') }}</p>
			</div>
		</div>
	</section>
@endsection

