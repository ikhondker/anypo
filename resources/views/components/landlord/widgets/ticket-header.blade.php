<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<button class="btn btn-{{ $ticket->status->badge }}" type="button"><i data-lucide="{{ $ticket->status->icon }}"></i> {{ $ticket->status->name }}</button>
			@can('close', $ticket)
				<a href="{{ route('tickets.close',$ticket->id) }}" class="btn btn-light sw2"><i class="text-danger" data-lucide="power"></i> Close Ticket</a>
			@endcan
		</div>
		<h5 class="card-title text-info mb-0">#{{ $ticket->id }}: {{ $ticket->title }}</h5>
	</div>
	<div class="card-body pt-0">
		{{-- <h5>Issue Description :</h5> --}}
		<p>
			{!! nl2br($ticket->content) !!}
		</p>
		 {{-- <hr> --}}
		@if ($ticket->attachment_id <> '')
			<small class="text-muted">Attachment: <x-landlord.attachment.show-by-id attachmentId="{{ $ticket->attachment_id }}"/></small><br />
		@endif
		<table class="table table-sm my-2">
			<tbody>
				<tr>
					<th width="25%">Created At : </th>
					<td>{{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->ticket_date ))) }}</td>
				</tr>
				<tr>
					<th>Requestor :</th>
					<td>{{ $ticket->owner->name }} ({{ $ticket->owner->email }})</td>
				</tr>
				{{-- <tr>
					<th>Email :</th>
					<td>{{ $ticket->owner->email }}</td>
				</tr> --}}
				<tr>
					<th>Account :</th>
					<td>{{ $ticket->owner->account->name }}</td>
				</tr>
				@if ( $ticket->status_code == App\Enum\Landlord\TicketStatusEnum::CLOSED->value)
					<tr>
						<th>Closed At :</th>
						<td>
							@if ($ticket->closed)
								{{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->closed_at ))) }}
							@endif
						</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>

