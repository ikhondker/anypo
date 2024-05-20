<div class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Basic Information for PR#{{ $pr->id }}</h5>
				<h6 class="card-subtitle text-muted">Key information of a Purchase Requisitions</h6>
			</div>
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-sm-4 text-end">
						<span class="h6 text-secondary">Summary:</span>
					</div>
					<div class="col-sm-8">
						<strong>{{ $pr->summary }}</strong>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-sm-4 text-end">
						<span class="h6 text-secondary">PR Value :</span>
					</div>
					<div class="col-sm-8">
						{{number_format($pr->amount, 2)}} <span class="badge bg-primary">{{ $pr->currency }}</span>
						@if ($pr->currency <> $_setup->currency)
							{{number_format($pr->fc_amount, 2)}} <span class="badge bg-success">{{ $pr->fc_currency }}</span>
						@endif
					</div>
				</div>
				<x-tenant.show.my-date		value="{{ $pr->pr_date }}"/>
				<x-tenant.show.my-text		value="{{ $pr->dept->name }}" label="Dept"/>
				<x-tenant.show.my-text		value="{{ $pr->project->name }}" label="Project"/>
				<x-tenant.show.my-text		value="{{ $pr->supplier->name }}" label="Supplier"/>
				<x-tenant.show.my-text-area	value="{{ $pr->notes }}" label="Notes"/>

				<div class="row">
					<div class="col-sm-4 text-end">

					</div>
					<div class="col-sm-8 text-end">
						@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
							<x-tenant.show.my-edit-link object="Pr" :id="$pr->id"/>
						@endif
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- end col-6 -->
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Approval Status</h5>
				<h6 class="card-subtitle text-muted">Approval information of Purchase Requisition.</h6>
			</div>
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-sm-4 text-end">
						<span class="h6 text-secondary">Auth Status :</span>
					</div>
					<div class="col-sm-8">
						<span class="badge {{ $pr->auth_status_badge->badge }}">{{ $pr->auth_status_badge->name}}</span>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-sm-4 text-end">
						<span class="h6 text-secondary">Closure Status :</span>
					</div>
					<div class="col-sm-8">
						<span class="badge {{ $pr->status_badge->badge }}">{{ $pr->status_badge->name}}</span>
					</div>
				</div>

				<x-tenant.show.my-text		value="{{ $pr->requestor->name }}" label="Requestor"/>
				<x-tenant.show.my-date-time	value="{{ $pr->auth_date }}" label="Auth Date"/>
				<x-tenant.show.my-date		value="{{ $pr->need_by_date }}" label="Need by Date"/>

				<div class="row mb-3">
						<div class="col-sm-4 text-end">
							<span class="h6 text-secondary">PO# :</span>
						</div>
						<div class="col-sm-8">
							@if ( $pr->po_id <> 0)
								<a href="{{ route('pos.show',$pr->po_id) }}" class="text-warning d-inline-block">{{ $pr->po_id }}</a>
							@else
								&nbsp;
							@endif
						</div>
				</div>


				<div class="row mb-3">
					<div class="col-sm-4 text-end">
						<span class="h6 text-secondary">Attachments:</span>
					</div>
					<div class="col-sm-8">
						<x-tenant.attachment.all entity="PR" aid="{{ $pr->id }}"/>
					</div>
				</div>



				@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
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
			</div>
		</div>
	</div>
	<!-- end col-6 -->
</div>
<!-- end row -->

<script type="text/javascript">
	function mySubmit() {
		//alert('I am inside 2');
		//document.getElementById('upload').click();
		document.getElementById('frm1').submit();
	}
</script>
