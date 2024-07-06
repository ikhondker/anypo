<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="row g-0">
					<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
						<img src="{{ Storage::disk('s3t')->url('flow/aeh.jpg') }}" width="240" height="321" class="mt-2" alt="Project">
					</div>
					<div class="col-sm-9 col-xl-12 col-xxl-9">
						<h4>{{ $aeh->source_entity->value .'#'.$aeh->article_id }} </h4>
						<p>Event: {{ $aeh->event }}</p>
						<table class="table table-sm my-2">
							<tbody>
								<tr>
									<th>Description</th>
									<td>{{ $aeh->description }}</td>
								</tr>
								<tr>
									<th>Accounting Date</th>
									<td>{{ strtoupper(date('d-M-y', strtotime($aeh->accounting_date))) }}</td>
								</tr>
								<tr>
									<th>PO#</th>
									<td>{{ $aeh->po_id }}</td>
								</tr>
								<tr>
									<th>Status</th>
									<td><span class="badge bg-info">{{ $aeh->status }}</span></td>
								</tr>
								<tr>
									<th>Reference</th>
									<td>{{ $aeh->reference_no }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
