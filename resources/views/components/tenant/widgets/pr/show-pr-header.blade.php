<div class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a class="btn btn-sm btn-light" href="{{ route('reports.pr', $pr->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-lucide="printer"></i></a>
					@can('update', $pr)
						<a class="btn btn-sm btn-light" href="{{ route('prs.edit', $pr->id ) }}"><i class="fas fa-edit"></i> Edit</a>
					@endcan
				</div>
				<h5 class="card-title">Basic Information for PR#{{ $pr->id }}</h5>
				<h6 class="card-subtitle text-muted">Key information of a Purchase Requisitions</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th width="20%">Summary :</th>
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
						 @can('update', $pr)
							<tr>
								<th>&nbsp;</th>
								<td>
									<x-tenant.show.my-edit-link object="Pr" :id="$pr->id"/>
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
					@can('submit', $pr)
						<a href="{{ route('prs.submit', $pr->id) }}" class="btn btn-warning text-white float-end me-2 sw2-advance"
							data-entity="" data-name="PR#{{ $pr->id }}" data-status="Submit"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Submit for Approval">
							<i data-lucide="external-link" class="text-white"></i> Submit</a>
					@else
						<span class="badge {{ $pr->auth_status_badge->badge }}">{{ $pr->auth_status_badge->name}}</span>
					@endcan
				</div>
				<h5 class="card-title">Approval Status</h5>
				<h6 class="card-subtitle text-muted">Approval information of Purchase Requisition.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th width="20%">Auth Status :</th>
							<td>
								<span class="badge {{ $pr->auth_status_badge->badge }}">{{ $pr->auth_status_badge->name}}</span>
							</td>
						</tr>
						<tr>
							<th>Closure Status :</th>
							<td>
								<span class="badge {{ $pr->status_badge->badge }}">{{ $pr->status_badge->name}}</span>
							</td>
						</tr>
						<x-tenant.show.my-text		value="{{ $pr->requestor->name }}" label="Requestor"/>
						<x-tenant.show.my-date-time	value="{{ $pr->auth_date }}" label="Auth Date"/>
						<x-tenant.show.my-date		value="{{ $pr->need_by_date }}" label="Need by Date"/>
						<tr>
							<th>PO# :</th>
							<td>
								@if ( $pr->po_id <> 0)
									@if (! auth()->user()->isUser())
										<a href="{{ route('pos.show',$pr->po_id) }}" class="text-muted"><strong>PO#{{ $pr->po_id }}</strong></a>
									@else
										<strong>PO#{{ $pr->po_id }}</strong>
									@endif
								@else
									&nbsp;
								@endif
							</td>
						</tr>
						<tr>
							<th>Attachments :</th>
							<td>
								<x-tenant.attachment.all entity="PR" articleId="{{ $pr->id }}"/>
							</td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td>
								@if ($pr->auth_status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
									<form action="{{ route('prs.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
										@csrf
										{{-- <x-tenant.attachment.create /> --}}
										<input type="text" name="attach_pr_id" id="attach_pr_id" class="form-control" placeholder="ID" value="{{ old('id', $pr->id ) }}" hidden>
										<div class="row">
											<div class="col-sm-3 text-end">

											</div>
											<div class="col-sm-9 text-end">
												<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
												<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false">Add Attachment</a>
												{{-- <x-show.my-edit-link object="Pr" :id="$pr->id"/> --}}
											</div>
										</div>
										{{-- <x-buttons.submit/> --}}
									</form>
									<!-- /.form end -->
								@endif
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
		document.getElementById('frm1').submit();
	}
</script>
