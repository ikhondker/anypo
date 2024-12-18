<div class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a class="btn btn-sm btn-light" href="{{ route('reports.po', $po->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-lucide="printer"></i></a>
					@can('update', $po)
						<a class="btn btn-sm btn-light" href="{{ route('pos.edit', $po->id ) }}"><i data-lucide="edit"></i> Edit</a>
					@endcan
				</div>
				<h5 class="card-title">Basic Information</h5>
				<h6 class="card-subtitle text-muted">Basic information of a Purchase Order.</h6>
			</div>
			<div class="card-body">

				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th width="20%">Summary :</th>
							<td>{{ $po->summary }}</td>
						</tr>
						<tr>
							<th>PO Value :</th>
							<td>
								{{number_format($po->amount, 2)}}<span class="badge badge-subtle-primary">{{ $po->currency }}</span>
								@if ($po->currency <> $_setup->currency)
									{{number_format($po->fc_amount, 2)}}<span class="badge badge-subtle-success">{{ $po->fc_currency }}</span>
								@endif
							</td>
						</tr>
						<x-tenant.show.my-date		value="{{ $po->po_date }}"/>
						<x-tenant.show.my-text		value="{{ $po->dept->name }}" label="Dept"/>
						<x-tenant.show.my-text		value="{{ $po->project->name }}" label="Project"/>
						<x-tenant.show.my-text		value="{{ $po->supplier->name }}" label="Supplier"/>
						<x-tenant.show.my-text-area		value="{{ $po->notes }}" label="Notes"/>
						@can('update', $po)
							<tr>
								<th></th>
								<td>
									<x-tenant.show.my-edit-link model="Po" :id="$po->id"/>
								</td>
							</tr>
						@endcan
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- end col-6 -->
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">

					<div class="card-actions float-end">
						@can('submit', $po)
							<a href="{{ route('pos.submit', $po->id) }}" class="btn btn-warning text-white me-2 sw2-advance"
								data-entity="" data-name="PO#{{ $po->id }}" data-status="Submit"
								data-bs-toggle="tooltip" data-bs-placement="top" title="Submit for Approval">
								<i data-lucide="external-link" class="text-white"></i> Submit</a>
						@else
                                <button class="btn btn-pill btn-{{ $po->auth_status_badge->badge }} me-1" type="button"><i data-lucide="{{ $po->auth_status_badge->icon }}"></i> {{ $po->auth_status_badge->name }}</button>
								{{-- <span class="badge {{ $po->auth_status_badge->badge }}">{{ $po->auth_status_badge->name}}</span> --}}
						@endcan
					</div>
				</div>
				<h5 class="card-title">Approval Status</h5>
				<h6 class="card-subtitle text-muted">Approval information of Purchase Order.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Auth Status :</th>
							<td><span class="badge badge-subtle-{{ $po->auth_status_badge->badge }}">{{ $po->auth_status_badge->name}}</span></td>
						</tr>
						<tr>
							<th>Closure Status :</th>
							<td><span class="badge badge-subtle-{{ $po->status_badge->badge }}">{{ $po->status_badge->name}}</span></td>
						</tr>
						<x-tenant.show.my-date-time	value="{{ $po->auth_date }}" label="Auth Date"/>
						<x-tenant.show.my-date		value="{{ $po->need_by_date }}" label="Need by Date"/>
						<x-tenant.show.my-text		value="{{ $po->category->name }}" label="Category"/>
						<x-tenant.show.my-text		value="{{ $po->buyer->name }}" label="Buyer"/>
						<x-tenant.show.my-text		value="{{ $po->requestor->name }}" label="Requestor"/>
						<tr>
							<th>Attachments :</th>
							<td><x-tenant.attachment.all entity="PO" articleId="{{ $po->id }}"/></td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td>
								@can('update', $po)
									<form action="{{ route('pos.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
										@csrf
										{{-- <x-tenant.attachment.create /> --}}
										<input type="text" name="attach_po_id" id="attach_po_id" class="form-control" placeholder="ID" value="{{ old('id', $po->id ) }}" hidden>
										<div class="row">
											<div class="col-sm-4 text-end">

											</div>
											<div class="col-sm-8 text-end">
												<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
												<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false">Add Attachment</a>
												{{-- <x-show.my-edit-link object="Po" :id="$po->id"/> --}}
											</div>
										</div>

										{{-- <x-buttons.submit/> --}}
									</form>
									<!-- /.form end -->
								@endcan
							</td>
						</tr>


				</tbody>
			</table>


			</div>
		</div>
	</div>
	<!-- end col-6 -->
</div>
<!-- end row -->

<script type="text/javascript">
	function mySubmit() {
		//document.getElementById('upload').click();
		document.getElementById('frm1').submit();
	}
</script>
