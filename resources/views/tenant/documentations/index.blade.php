@extends('layouts.tenant.doc')
@section('title','Documentations')

@section('breadcrumb')
	<li class="breadcrumb-item active">Documentations</li>
@endsection

@section('content')

	{{-- <h1 class="h3">Documentation</h1> --}}

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
			<li><a href="{{ route('docs.start') }}">Getting started</a></li>
			<li><a href="{{ route('docs.start') }}">FAQ</a></li>
			<li><a href="{{ route('docs.start') }}">Requisition</a></li>
			<li><a href="{{ route('docs.start') }}">Purchase Order</a></li>
			<li><a href="{{ route('docs.start') }}">Receipts</a></li>
			<li><a href="{{ route('docs.start') }}">Invoice</a></li>
			<li><a href="{{ route('docs.start') }}">Payment</a></li>
			<li><a href="{{ route('docs.start') }}">Budgets</a></li>
			<li><a href="{{ route('docs.start') }}">Dept Budgets</a></li>
			<li><a href="{{ route('docs.start') }}">Master Data</a></li>
			<li><a href="{{ route('docs.start') }}">User Management</a></li>
			<li><a href="{{ route('docs.start') }}">Hierarchy</a></li>
			<li><a href="{{ route('docs.start') }}">Approval</a></li>
			<li><a href="{{ route('docs.start') }}">Workflow</a></li>
			<li><a href="{{ route('docs.start') }}">Interface</a></li>
			<li><a href="{{ route('docs.start') }}">Currency</a></li>
			<li><a href="{{ route('docs.start') }}">Accounting</a></li>
			<li><a href="{{ route('docs.start') }}">Setup</a></li>
			<li><a href="{{ route('docs.start') }}">Support</a></li>


		</ul>
	</div>
	<div id="something-missing" class="mb-5">
		<h3>Something missing?</h3>
		<p class="text-lg">
			If something is missing in the documentation or if you found some part confusing, please send us an email (<a href="mailto:support@bootlab.io">support@bootlab.io</a>)
			with your suggestions for improvement. We love hearing from you!</p>
	</div>


	<div class="alert alert-primary mb-5" role="alert">
		<div class="alert-message">
			<strong>Note:</strong> If you're not looking for any customizations or are not comfortable with Node.js or Webpack, you could use the pre-compiled (ready-to-use)
			files available in the dist folder. In that case, you can skip the set-up below.
		</div>
	</div>

@endsection

