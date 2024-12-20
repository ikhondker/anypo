@extends('layouts.landlord.app')
@section('title','Invoice')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('invoices.index') }}" class="text-muted">Invoice</a></li>
	<li class="breadcrumb-item active">Create Invoice</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">Create Invoice</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Create Invoice</h5>
			<h6 class="card-subtitle text-muted">Create New Invoice.</h6>
		</div>
		<div class="card-body">
			<form id="myForm" action="{{ route('invoices.store') }}" method="POST">
				@csrf

				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.create.name/>
					</tbody>
				</table>

				<button class="confirm-delete btn btn-danger">User Delete</button>


			</form>


		</div>
	</div>

	<script type="module">
		$(function() {
			const $myForm = $('#myForm')
				.on('submit', function(e) {
				e.preventDefault();
				Swal.fire({

					title: '<h2>Confirmation?</h2>',
					//title: "<strong>HTML <u>example</u></strong>",
					text: "Are you sure, you want to do this?",
					icon: 'question',
					iconColor: '#d9534f',
					showCancelButton: true,
					confirmButtonText: 'Yes, confirmed!',
					//footer: "aaaaaaaaaaaaa",
					//title: 'Are you sure?',
					//text: "You won't be able to revert this!",
					//showCancelButton: true,
					//confirmButtonText: 'Yes, delete it!',
					//cancelButtonText: 'No, cancel!',
					customClass: {
						confirmButton: 'btn btn-primary m-1',
						cancelButton: 'btn btn-secondary m-1'
					},

					buttonsStyling: false
				}).then(function(result) {
					if (result.value) {
					// Swal.fire({
					// 	icon: 'success',
					// 	title: 'Deleted!',
					// 	text: '',
					// 	customClass: {
					// 	confirmButton: 'btn btn-success'
					// 	}
					// });
					setTimeout(function() {
						$myForm[0].submit()
					}, 2000); // submit the DOM form
					}
				});
				});
			});

	</script>
@endsection

