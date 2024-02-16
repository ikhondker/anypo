	<div class="row">
		<div class="col-8">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">PO# {{ $po->id }}</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $po->summary }}"/>
					<x-tenant.show.my-badge		value="{{ $po->auth_status }}" label="Auth Status"/>
					<x-tenant.show.my-badge		value="{{ $po->status }}" label="Status"/>
					<x-tenant.show.my-amount	value="{{ $po->amount }}"/>
					<x-tenant.show.my-text		value="{{ $po->requestor->name }}" label="Requestor"/>
					<x-tenant.show.my-date		value="{{ $po->po_date }}"/>
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
		<!-- end col-8 -->
		
	</div>
	<!-- end row -->

	<script type="text/javascript">
		function mySubmit() {
			//alert('I am inside 2');
			//document.getElementById('upload').click();
			document.getElementById('frm1').submit();
		}
	</script>
