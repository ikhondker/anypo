@extends('layouts.tenant.app')
@section('title','Get Started')

@section('content')



		<x-tenant.page-header>
		@slot('title')
			Get Started  
		@endslot

		@slot('buttons')
			<a href="tel:{{ config('akk.SUPPORT_PHONE_NO')}}" class="btn btn-primary float-end me-2"><i data-feather="phone-outgoing"></i> Call support {{config('akk.SUPPORT_PHONE_NO')}}</a>
			<a  href="{{ route('tickets.create') }}" class="btn btn-primary float-end me-2"><i data-feather="message-square"></i> Create Ticket</a>
			<a href="{{ route('help') }}" class="btn btn-primary float-end me-2"><i class="align-middle" data-feather="help-circle"></i> Help</a>

			<div class="dropdown me-2 d-inline-block position-relative">
				<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
					<i class="align-middle mt-n1" data-feather="calendar"></i> Today
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<h6 class="dropdown-header">Settings</h6>
					<a class="dropdown-item" href="#">Action</a>
					<a class="dropdown-item" href="#">Another action</a>
					<a class="dropdown-item" href="#">Something else here</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#">Separated link</a>
				</div>
			</div>

			<div class="dropdown">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Dropdown button
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				  <a class="dropdown-item" href="#">Action</a>
				  <a class="dropdown-item" href="#">Another action</a>
				  <a class="dropdown-item" href="#">Something else here</a>
				</div>
			  </div>
			  
		@endslot

	</x-tenant.page-header>

	<h1 class="h3 mb-3">Empty card (card-header)</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('users.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
					</div>
					<h5 class="card-title">Empty card</h5>
					  <h6 class="card-subtitle text-muted">Heatmap is a visualization tool that employs.</h6>
				</div>
				<div class="card-body">
					<img src="{{ Storage::disk('s3t')->url('logo/'.$_setup->logo) }}" width="90px" height="90px"/>

					<table class="table table-sm my-2">
						<tbody>
							<tr>
								<th>Name</th>
								<td>Angelica Ramos</td>
							</tr>
	
							<tr>
								<th>Company</th>
								<td>The Wiz</td>
							</tr>
							<tr>
								<th>Email</th>
								<td>angelica@ramos.com</td>
							</tr>
							<tr>
								<th>Status</th>
								<td><span class="badge badge-subtle-success">Active</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	
	
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			<div class="alert-icon">
				<i data-lucide="alert-triangle" class="text-danger"></i>
			</div>
			<div class="alert-message">
				<strong>Error!</strong> aaaaaaaaaaaaaaaaaaaaa
				
					<ul>
				
							<li class="">1111</li>
							<li class="">1111</li>
							<li class="">1111</li>
				
					</ul>
				
			</div>
		</div>
	


	<main class="content">
		<div class="container-fluid p-0">

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
	Launch demo modal
  </button>

<a class="" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Launch demo modal</a>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Standard PO Clause</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		aaaaaaaaaaaaaaa
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	</div>
	</div>
</div>
</div>

			<div id="ex1" class="modal">
				<p>Thanks for clicking. That felt good.</p>
				<a href="#" rel="modal:close">Close</a>
			  </div>
			  
			  <!-- Link to open the modal -->
			  <p><a href="#ex1" rel="modal:open">Open Modal</a></p>
			  
			
			<div class="row">
				<div class="mx-auto col-lg-10 col-xl-8">
					<h1 class="h3">Get Started TODO1s <i class="bi bi-eye" style="font-size: 1.3rem;"></i></h1>
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

