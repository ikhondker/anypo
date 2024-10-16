<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">

				</div>
				<h5 class="card-title">Attachments</h5>
				<h6 class="card-subtitle text-muted">List of Attachments for current document.</h6>
			</div>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Summary</th>
						<th>Owner</th>
						<th>File Name</th>
						<th class="text-end">Size (Byte)</th>
						<th>Upload Date</th>
						<th>File</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($attachments as $attachment)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $attachment->summary }}</td>
						<td>{{ $attachment->owner->name }}</td>
						<td>{{ $attachment->org_file_name }}</td>
						<td class="text-end">{{ number_format($attachment->file_size) }}</td>
						<td><x-tenant.list.my-date-time :value="$attachment->upload_date"/></td>
						<td><x-tenant.attachment.single id="{{ $attachment->id }}"/></td>
						<td>
							@if (\App\Helpers\Tenant\Access::isAttachmentEditable($attachment->id))
								<a href="{{ route('attachments.edit',$attachment->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
									<i class="align-middle" data-lucide="edit"></i></a>

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
