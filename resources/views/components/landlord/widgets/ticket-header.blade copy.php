

<div class="card">
	<div class="card-header bg-primary-subtle">
		<div class="card-actions float-end">
			@can('close', $ticket)
				<a href="{{ route('tickets.close',$ticket->id) }}" class="btn btn-sm btn-light sw2"><i class="text-danger" data-lucide="power"></i> Close Ticket</a>
			@endcan
		</div>
		{{-- <div class="badge bg-{{ $ticket->status->badge }} my-2">{{ $ticket->status->name }}</div> --}}
		<button class="btn btn-{{ $ticket->status->badge }}" type="button">{{ $ticket->status->name }}</button>
		{{-- <h5 class="card-title mb-0">#{{ $ticket->id }}: {{ $ticket->title }}</h5> --}}
	</div>
	<div class="card-body bg-primary-subtle pt-0">

	<div class="alert alert-primary alert-dismissible" role="alert">
		<div class="alert-message">
			<h4 class="alert-heading">#{{ $ticket->id }}: {{ $ticket->title }}</h4>
			<p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an
				alert works with this kind of content.</p>
			<hr>
			<div class="btn-list">
					<small class="text-muted">Created At: {{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->ticket_date ))) }}</small><br />
					@if ($ticket->attachment_id <> '')
						<small class="text-muted">Attachment: <x-landlord.attachment.show-by-id attachmentId="{{ $ticket->attachment_id }}"/></small><br />
					@endif
					@if ($ticket->closed)
						<small class="text-muted">Closed At: {{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->closed_at ))) }}</small><br />
					@endif
				<button class="btn btn-light" type="button">Okay</button>
				<button class="btn btn-dark" type="button">No, thanks</button>
			</div>
		</div>
	</div>


		{{-- <h5>Issue Description</h5> --}}
		{{-- <p class="text-muted">
			{!! nl2br($ticket->content) !!}
		</p> --}}
		<div class="alert alert-primary" role="alert">
				<div class="alert-message">
				{{-- <strong>Issue Description: </strong> <br> --}}
				{!! nl2br($ticket->content) !!}
			</div>
		</div>



		{{-- <div>
			<h5>Requestor</h5>
			<img src="{{ Storage::disk('s3l')->url('avatar/'.$ticket->owner->avatar) }}" class="rounded-circle me-1" alt="{{ $ticket->owner->name }}" title="{{ $ticket->owner->name }}" width="34" height="34">
		</div> --}}

		<table class="table table-sm my-2">
			<tbody>
				<tr>
					<th width="25%">Requestor</th>
					<td>
						{{ $ticket->owner->name }}
					</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{ $ticket->owner->email }}</td>
				</tr>
				<tr>
					<th>Account</th>
					<td>{{ $ticket->owner->account->name }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
