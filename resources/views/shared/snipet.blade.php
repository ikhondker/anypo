<i class="fas fa-edit">
	<i data-lucide="alert-circle"></i>
<i data-lucide="plus-circle"></i>
<i data-lucide="alert-triangle"></i>
<i class="align-middle me-1" data-lucide="plus-circle"></i>

show
<div class="card-actions float-end">
	<a href="{{ route('depts.edit', $dept->id ) }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i> Edit</a>
	<a href="{{ route('depts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
</div>

edit
<div class="card-actions float-end">
	<a href="{{ route('depts.create') }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i> Create</a>
	<a href="{{ route('depts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
</div>

create
<a href="{{ route('depts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>

<a href="{{ route('users.show',$user->id) }}" class="btn btn-light"
	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
</a>


<i data-lucide="refresh-cw"></i>
{!! nl2br($ticket->content) !!}
94. var_dump(__METHOD__); var_dump(__FUNCTION__);


<table class="table table-sm my-2">
	<tbody>

		<tr>
			<th></th>
			<td>

			</td>
		</tr>

	</tbody>
</table>

<tr>
	<th></th>
	<td>

	</td>
</tr>

Log::debug(tenant('id'). ' tenant.Access.isAttachmentEditable article_id = '. $attachment->article_id);

<th width="20%">Photo</th>

$user1it = User::where('email', 'user1it@anypo.net')->firstOrFail();
		

<div class="text-danger text-xs">{{ $message }}</div> to <div class="small text-danger">{{ $message }}</div>

@can('create', App\Models\Tenant\Lookup\Item::class)
	<div class="dropdown-divider"></div>
@endcan
@can('createForPo', App\Models\Tenant\Invoice::class)
	<a class="dropdown-item" href="{{ route('invoices.create-for-po', $po->id) }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create Invoice</a>
@endcan

@if (auth()->user()->isSystem())
	<a href="{{ route('aels.edit',$ael->id) }}" class="text-warning d-inline-block">Edit</a>
@endif

@can('edit', $invoice)
	<div class="dropdown-divider"></div>
@endcan

@can('delete', $po)
	<div class="dropdown-divider"></div>
@endcan

@can('viewAny', $user)
	<div class="dropdown-divider"></div>
@endcan

<a href="{{ route('pols.show',$pol->id) }}" class="text-muted">
	<strong>{{ Str::limit($pol->item_description,35) }}</strong>
</a>

<tr>
	<th></th>
	<td>
		@if ($invoice->status <> App\Enum\InvoiceStatusEnum::POSTED->value)
			<x-tenant.buttons.show.edit object="Invoice" :id="$invoice->id"/>
		@endif
	</td>
</tr>



@if ($po->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
	<div class="dropdown-divider"></div>
@endif

@if (auth()->user()->isSystem())
	<a class="btn btn-sm btn-danger text-white" href="{{ route('activities.edit', $activity->id) }}"><i class="fas fa-edit"></i> Edit</a>
@endif

index
@section('breadcrumb')
	<li class="breadcrumb-item active">Tickets</li>
@endsection

show + edit
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('tickets.index') }}" class="text-muted">Tickets</a></li>
	<li class="breadcrumb-item active">{{ $ticket->name }}</li>
@endsection


create
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('tickets.index') }}" class="text-muted">Tickets</a></li>
	<li class="breadcrumb-item active">Create Ticket</li>
@endsection

