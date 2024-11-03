<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-danger mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('tickets.show', $ticket->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Ticket</a>
		@can('update', $ticket)
			<a class="dropdown-item" href="{{ route('tickets.assign', $ticket->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> Assign Ticket</a>
			<a class="dropdown-item" href="{{ route('tickets.edit', $ticket->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Ticket</a>
			<a class="dropdown-item" href="{{ route('tickets.topics', $ticket->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> Ticket Topics (*)</a>
		@endcan
		@can('close', $ticket)
			<a class="dropdown-item sw2" href="{{ route('tickets.close', $ticket->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> Close Ticket</a>
		@endcan
	</div>
</div>
