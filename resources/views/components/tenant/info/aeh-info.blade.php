<div class="card">
	<div class="card-body">
		<div class="row g-0">
			<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
				<img src="{{ Storage::disk('s3t')->url('flow/aeh.jpg') }}" width="240" height="321" class="mt-2" alt="Accounting">
			</div>
			<div class="col-sm-9 col-xl-12 col-xxl-9">
				<div class="card-actions float-end">
					@if (auth()->user()->isSystem())
						<a href="{{ route('aehs.edit', $aeh->id) }}" class="btn btn-sm btn-danger text-white" ><i data-lucide="edit"></i> Edit</a>
					@endif
					<a href="{{ route('aehs.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
				</div>

				<strong>{{ $aeh->source_entity->value .'#'.$aeh->article_id }}</strong>
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
							<th>PO</th>
							<td><a href="{{ route('pos.show',$aeh->po_id) }}" class="text-muted"><strong>#{{ $aeh->po_id }}</strong></a></td>
						</tr>

						<tr>
							<th>PO#</th>
							<td>PO#{{ $aeh->po_id }}</td>
						</tr>
						<tr>
							<th>Status</th>
							<td><span class="badge badge-subtle-info">{{ $aeh->status }}</span></td>
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
