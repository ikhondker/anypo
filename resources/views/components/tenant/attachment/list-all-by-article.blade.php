<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Attachments</h5>
				<h6 class="card-subtitle text-muted">List of Attachments for current document.</h6>
			</div>

			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="" scope="col">#</th>
						<th class="" scope="col">Owner</th>
						<th class="" scope="col">File Name</th>
						<th class="text-end" scope="col">Size (Byte)</th>
						<th class="" scope="col">Upload Date</th>
						<th class="" scope="col">Download File</th>
						<th class="" scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($attachments as $attachment)
					<tr>
						<td class="">{{ $loop->iteration }}</td>
						<td class="">{{ $attachment->owner->name }}</td>
						<td class="">{{ $attachment->org_file_name }}</td>
						<td class="text-end">{{ number_format($attachment->file_size) }}</td>
						<td><x-tenant.list.my-date-time :value="$attachment->upload_date"/></td>
						<td><x-tenant.attachment.single id="{{ $attachment->id }}"/></td>
						<td class="table-action">
							@if ($delete)
								<a href="{{ route('attachments.destroy', $attachment->id) }}" class="me-2 sw2-advance"
									data-entity="Attachment" data-name="{{ $attachment->org_file_name }}" data-status="Delete"
									data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
									<i class="align-middle text-muted" data-lucide="trash-2"></i>
								</a>
							@endif
						</td>
					</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>
</div>
