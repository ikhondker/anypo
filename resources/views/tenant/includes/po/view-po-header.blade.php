	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">PO# {{ $po->id }}</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $po->summary }}"/>
					<x-tenant.show.my-amount-currency	value="{{ $po->amount }}" currency="{{ $po->currency }}" />
					<x-tenant.show.my-date		value="{{ $po->po_date }}"/>
					<x-tenant.show.my-text		value="{{ $po->requestor->name }}" label="Requestor"/>
					<x-tenant.show.my-text		value="{{ $po->buyer->name }}" label="Buyer"/>
					<x-tenant.show.my-text		value="{{ $po->supplier->name }}" label="Supplier"/>
					<x-tenant.show.my-date		value="{{ $po->need_by_date }}" label="Need by Date"/>
					<div class="row">
						<div class="col-sm-3 text-end">
							
						</div>
						<div class="col-sm-9 text-end">
							<x-tenant.show.my-edit-link object="Po" :id="$po->id"/>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<div class="dropdown position-relative">
							<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
								<i class="align-middle" data-feather="more-horizontal"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{ route('pos.detach',$po->id) }}">Delete Attachment</a>
							</div>
						</div>
					</div>
					<h5 class="card-title">Supporting Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-badge		value="{{ $po->auth_status }}" label="Auth Status"/>
					<x-tenant.show.my-date-time	value="{{$po->auth_date }}" label="Auth Date"/>
					<x-tenant.show.my-badge		value="{{ $po->status }}" label="Status"/>
					<x-tenant.show.my-text		value="{{ $po->dept->name }}" label="Dept"/>
					<x-tenant.show.my-text		value="{{ $po->project->name }}" label="Project"/>
					<x-tenant.show.my-text		value="{{ $po->notes }}" label="Notes"/>
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Attachments:</span>
						</div>
						<div class="col-sm-9">
							<x-tenant.attachment.all entity="PO" aid="{{ $po->id }}"/>
						</div>
					</div>

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
