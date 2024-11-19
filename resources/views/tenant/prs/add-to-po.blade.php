@extends('layouts.tenant.app')
@section('title','Add Requisition To PO')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}" class="text-muted">Requisitions</a></li>
	<li class="breadcrumb-item"><a href="{{ route('prs.show',$pr->id) }}" class="text-muted">PR#{{ $pr->id }}</a></li>
	<li class="breadcrumb-item active">Add Requisition To PO</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			PR #{{ $pr->id }} : Add Requisition To PO
		@endslot
		@slot('buttons')
			<a href="{{ route('prs.index') }}" class="btn btn-primary float-end me-2"><i data-lucide="list"></i> View All</a>
			<x-tenant.buttons.header.create object="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions prId="{{ $pr->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">

			<!-- form start -->
			<form id="myForm" action="{{ route('prs.add-lines-to-po', $pr->id) }}" method="POST">
				@csrf
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Basic Information PR #{{ $pr->id }}</h5>
							<h6 class="card-subtitle text-muted">Basic Information of Requisition.</h6>
						</div>
						<div class="card-body">
							<table class="table table-sm my-2">
								<tbody>
									<tr>
										<th width="20%">Add PR #{{ $pr->id }} to PO # :</th>
										<td>
											<input type="text" class="form-control @error('po_id') is-invalid @enderror"
											name="po_id" id="po_id" placeholder="PO #"
											value="{{ old('po_id', '' ) }}"
											required/>
										@error('po_id')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
										</td>
									</tr>
								</tbody>
							</table>

						</div>
					</div>
					<div class="mb-3 float-end">
						<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ url()->previous() }}"><i class="far fa-times-circle"></i></i> Back</a>
						<button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Add To PO"><i data-lucide="plus-circle"></i> Add To PO</button>
					</div>
			</form>
			<!-- /.form end -->
		</div>
		<!-- end col-6 -->

		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Basic Information PR #{{ $pr->id }}</h5>
					<h6 class="card-subtitle text-muted">Basic Information of Requisition.</h6>
				</div>
				<div class="card-body">

					<table class="table table-sm my-2">
						<tbody>
							<tr>
								<th width="20%">PR #{{ $pr->id }} :</th>
								<td>{{ $pr->summary }}</td>
							</tr>
							<tr>
								<th>PR Value :</th>
								<td>
									{{number_format($pr->amount, 2)}} <span class="badge badge-subtle-primary">{{ $pr->currency }}</span>
									@if ($pr->currency <> $_setup->currency)
										{{number_format($pr->fc_amount, 2)}} <span class="badge badge-subtle-success">{{ $pr->fc_currency }}</span>
									@endif
								</td>
							</tr>
							<x-tenant.show.my-date		value="{{ $pr->pr_date }}"/>
							<x-tenant.show.my-text		value="{{ $pr->dept->name }}" label="Dept"/>
							<x-tenant.show.my-text		value="{{ $pr->project->name }}" label="Project"/>
							<x-tenant.show.my-text		value="{{ $pr->supplier->name }}" label="Supplier"/>
							<x-tenant.show.my-text-area	value="{{ $pr->notes }}" label="Notes"/>

						</tbody>
					</table>
				</div>
			</div>

		</div>
		<!-- end col-6 -->
	</div>

	<script type="module">
		$(function() {
			const $myForm = $('#myForm')
				.on('submit', function(e) {
				e.preventDefault();
				Swal.fire({
					title: '<h2>Confirmation?</h2>',
					text: "Are you sure, you want to do this?",
					icon: 'question',
					iconColor: '#d9534f',
					showCancelButton: true,
					confirmButtonText: 'Yes, confirmed!',
					customClass: {
						confirmButton: 'btn btn-primary m-1',
						cancelButton: 'btn btn-secondary m-1'
					},
					buttonsStyling: false
				}).then(function(result) {
					if (result.value) {
					setTimeout(function() {
						$myForm[0].submit()
					}, 2000); 		// submit the DOM form
					}
				});
			});
		});
	</script>


@endsection

