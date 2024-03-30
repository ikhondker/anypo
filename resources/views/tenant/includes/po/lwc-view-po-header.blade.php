	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Basic Information</h5>
					<h6 class="card-subtitle text-muted">Basic information of a Purchase Order.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $po->summary }}" label="Summary"/>
					<x-tenant.show.my-amount-currency	value="{{ $po->amount }}" currency="{{ $po->currency }}" />
					<x-tenant.show.my-date		value="{{ $po->po_date }}"/>
					<x-tenant.show.my-text		value="{{ $po->dept->name }}" label="Dept"/>
					<x-tenant.show.my-text		value="{{ $po->project->name }}" label="Project"/>
					<x-tenant.show.my-text		value="{{ $po->requestor->name }}" label="Requestor"/>
					<x-tenant.show.my-text		value="{{ $po->supplier->name }}" label="Supplier"/>
					
					<div class="row">
						<div class="col-sm-3 text-end">
							
						</div>
						<div class="col-sm-9 text-end">
							@if ($po->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
								<x-tenant.show.my-edit-link object="Po" :id="$po->id"/>
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
					<h6 class="card-subtitle text-muted">Approval information of Purchase Order.</h6>
				</div>
				<div class="card-body">

					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Auth Status:</span>
						</div>
						<div class="col-sm-9">
							<span class="badge {{ $po->auth_status_badge->badge }}">{{ $po->auth_status_badge->name}}</span>
						</div>
					</div>
					
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Closure Status:</span>
						</div>
						<div class="col-sm-9">
							<span class="badge {{ $po->status_badge->badge }}">{{ $po->status_badge->name}}</span>
						</div>
					</div>

					<x-tenant.show.my-date-time	value="{{ $po->auth_date }}" label="Auth Date"/>
					<x-tenant.show.my-date		value="{{ $po->need_by_date }}" label="Need by Date"/>
					<x-tenant.show.my-text		value="{{ $po->buyer->name }}" label="Buyer"/>
					<x-tenant.show.my-text		value="{{ $po->notes }}" label="Notes"/>
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Attachments:</span>
						</div>
						<div class="col-sm-9">
							<x-tenant.attachment.all entity="PO" aid="{{ $po->id }}"/>
						</div>
					</div>
					@if ($po->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
						<form action="{{ route('pos.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
							@csrf
							{{-- <x-tenant.attachment.create  /> --}}
							<input type="text" name="attach_po_id" id="attach_po_id" class="form-control" placeholder="ID" value="{{ old('id', $po->id ) }}" hidden>
							<div class="row">
								<div class="col-sm-3 text-end">
								
								</div>
								<div class="col-sm-9 text-end">
									<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
									<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false">Add Attachment</a>
									{{-- <x-show.my-edit-link object="Po" :id="$po->id"/> --}}
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
