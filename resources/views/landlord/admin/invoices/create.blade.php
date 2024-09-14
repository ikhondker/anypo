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
				<button id="submit" name="submit" class="btn btn-primary swa-confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="Generate"><i class="fas fa-save"></i> Generate</button>

				<div class="mb-3 float-end">
					<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ url()->previous() }}"><i class="fas fa-times"></i></i> Back</a>
					{{-- <button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i class="fas fa-save"></i> Save</button> --}}
				</div>
			</form>

			<a href="{{ route('categories.show', 1001) }}"
				class="btn btn-primary sw2">
				<i data-lucide="bell"></i>  Gooo Btn
			</a>

		</div>
	</div>

	<script type="module">
		// function mySubmit(){
		// 		document.getElementById('myForm').submit();
		// };
		$(".swa-confirm").on("click", function(e) {
			e.preventDefault();

			Swal.fire({
				title: "Are you Sure ?",
				  text:"You want to Delete the selected Invoice",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#cc3f44",
				  confirmButtonText: "Delete",
				  closeOnConfirm: true,
				  html: false
			}).then((confirmed) => {
				if (confirmed) {
				$('#myform').submit(); // << here
				}
			})
			.catch((error) => {
				console.log(error)
			});
		});
	</script>
@endsection

