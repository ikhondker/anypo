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

<th width="20%">Photo</th>

@can('create', App\Models\Tenant\Lookup\Item::class)
	<div class="dropdown-divider"></div>
@endcan
@can('createForPo', App\Models\Tenant\Invoice::class)
	<a class="dropdown-item" href="{{ route('invoices.create-for-po', $po->id) }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create Invoice</a>
@endcan

@can('edit', $invoice)
	<div class="dropdown-divider"></div>
@endcan

@can('delete', $po)
	<div class="dropdown-divider"></div>
@endcan

@can('viewAny', $user)
	<div class="dropdown-divider"></div>
@endcan

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
