@extends('layouts.tenant.app')
@section('title','Get Started')

@section('content')

	<x-tenant.page-header>
		@slot('title')
		Get Started
		@endslot
		@slot('buttons')
		<a href="tel:{{ config('akk.SUPPORT_PHONE_NO')}}" class="btn btn-primary float-end me-2"><i data-lucide="phone-outgoing"></i> Call support {{config('akk.SUPPORT_PHONE_NO')}}</a>
		<a href="{{ route('tickets.create') }}" class="btn btn-primary float-end me-2"><i data-lucide="message-square"></i> Create Ticket</a>
		<a href="{{ route('docs.index') }}" class="btn btn-primary float-end me-2"><i class="align-middle" data-lucide="help-circle"></i> Help</a>
		@endslot
	</x-tenant.page-header>

	<main class="content">
		<div class="container-fluid p-0">

			<div class="row">
				<div class="mx-auto col-lg-10 col-xl-8">
					<h1 class="h3">Get Started TODO</h1>
					<hr class="my-4">
					<div id="introduction" class="mb-5">
						<h3>Introduction</h3>
						<p class="text-lg">
							Hello, I hope you find this template useful. AppStack has been crafted on top of <strong>Bootstrap 5</strong> and uses modern web technologies such as <strong>HTML5</strong>,
							<strong>CSS3</strong> and <strong>jQuery</strong>. The included docs don't replace the official ones, but provide a clear view of all extended styles and
							new components that this template provides on top of Bootstrap 5.
						</p>
						<p class="text-lg">
							The docs includes information to understand how the theme is organized, how to make changes to the source code, and how to compile and extend it to fit your needs.
						</p>
					</div>
					<div id="table-of-contents" class="mb-5">
						<h3>Table of Contents</h3>
						<ul class="text-lg">
							<li><a href="docs-installation.html">Getting started</a></li>
							<li><a href="docs-customization.html">Customization</a></li>
							<li><a href="docs-plugins.html">Plugins</a></li>
							<li><a href="docs-changelog.html">Changelog</a></li>
						</ul>
					</div>
					<div id="something-missing" class="mb-5">
						<h3>Something missing?</h3>
						<p class="text-lg">
							If something is missing in the documentation or if you found some part confusing, please send us an email (<a href="mailto:support@bootlab.io">support@bootlab.io</a>)
							with your suggestions for improvement. We love hearing from you!</p>
					</div>
				</div>
			</div>
		</div>
	</main>

@endsection

