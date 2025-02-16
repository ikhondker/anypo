<i class="fas fa-save"></i>
<i class="fas fa-plus"></i>
<i class="fas fa-edit"></i>
<i class="fas fa-list"></i>
<i class="fas fa-print"></i>
<i class="fas fa-upload"></i>
<i class="fas fa-power-off text-danger"></i>
<i class="fas fa-dollar-sign"></i>


<i data-lucide="user-plus"></i>
<i data-lucide="x-circle"></i>
<i data-lucide="x"></i>
<i data-lucide="bell"></i>
<i data-lucide="file"></i>
<i data-lucide="dollar-sign"></i>
<i data-lucide="upload-cloud"></i>
<i data-lucide="power"></i>
<i data-lucide="printer"></i>
<i data-lucide="plus"></i>
<i data-lucide="edit"></i>
<i data-lucide="save"></i>
<i data-lucide="square"></i>
<i data-lucide="x-circle"></i>
<i data-lucide="database"></i>
<i data-lucide="alert-circle"></i>
<i data-lucide="plus-circle"></i>
<i data-lucide="alert-triangle"></i>
<i class="align-middle me-1" data-lucide="plus-circle"></i>
<i data-lucide="home"></i>
<i data-lucide="map-pin"></i>
<i data-lucide="chart-pie"></i>
<i data-lucide="power"></i>
<i data-lucide="power-off"></i>
<i data-lucide="circle-user-round"></i>
<i data-lucide="eye"></i>
<i data-lucide="shopping-cart"></i>
<i data-lucide="book-open-text"></i>


Call support {{ config('akk.SUPPORT_PHONE_NO') }}</a>
{{ config('app.name') }}
show
<div class="card-actions float-end">
	<a href="{{ route('depts.edit', $dept->id ) }}" class="btn btn-sm btn-light"><i data-lucide="edit"></i> Edit</a>
	<a href="{{ route('depts.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
</div>

edit
<div class="card-actions float-end">
	<a href="{{ route('depts.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
	<a href="{{ route('depts.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
</div>

create
<a href="{{ route('depts.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>

<a href="{{ route('users.show',$user->id) }}" class="btn btn-light"
	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
</a>

<button class="btn btn-{{ $ticket->status->badge }}" type="button"><i data-lucide="{{ $ticket->status->icon }}"></i> {{ $ticket->status->name }}</button>


// allow add attachment only if status is draft
@php
try {
	$po = Po::where('id', $request->input('attach_po_id'))->get()->firstOrFail();
} catch (Exception $e) {
	Log::error(tenant('id'). ' tenant.po.attach user_id = '. auth()->user()->id.' request = '. $request. ' class = '.get_class($e). ' Message = '. $e->getMessage());
	return redirect()->back()->with(['error' => 'Purchase Order not Found!']);
}
@endphp

$po->po_date		= now();

{{ Carbon\Carbon::parse($comment->comment_date)->ago() }}

value="{{ old('invoice_date', date('Y-m-d',strtotime($invoice->invoice_date)) ) }}"

$colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
$budget->bg_color	= array_rand($colors);


<i class="fa fa-check-circle fa-5x text-success"></i>
<i data-lucide="eye"></i>
<i data-lucide="plus"></i>
<i data-lucide="edit"></i>
<i data-lucide="refresh-cw"></i>
<i class="lucide-lg" data-lucide="heart"></i>

$checkout->checkout_date	= date('Y-m-d H:i:s');

{!! nl2br($ticket->content) !!}

94. var_dump(__METHOD__); var_dump(__FUNCTION__);


amount
<input type="number" class="form-control @error('price') is-invalid @enderror"
	style="text-align: right;" min="1" step="0.01" max="999999.99"
	name="price" id="price" placeholder="0.00"
	value="{{ old('price','0.00') }}"
	required>
@error('price')
		<div class="small text-danger">{{ $message }}</div>
@enderror

{{ $dbus->firstItem() + $loop->index}}


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

<th width="25%">Photo</th>

$user1it = User::where('email', 'user1it@anypo.net')->firstOrFail();

25.	{{ $dbus->firstItem() + $loop->index}}

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
		@if ($invoice->status <> App\Enum\Tenant\InvoiceStatusEnum::POSTED->value)
			<x-tenant.buttons.show.edit object="Invoice" :id="$invoice->id"/>
		@endif
	</td>
</tr>



@if ($po->auth_status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
	<div class="dropdown-divider"></div>
@endif

@if (auth()->user()->isSystem())
	<a class="btn btn-sm btn-danger text-white" href="{{ route('activities.edit', $activity->id) }}"><i data-lucide="edit"></i> Edit</a>
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



responsive layout

<div class="row">
	<div class="col-12 col-lg-6">

	</div>
	<div class="col-12 col-lg-6">

	</div>
</div>


{{-- Short attribute syntax... --}}
<x-profile :$userId :$name />
 {{-- Is equivalent to... --}}
<x-profile :user-id="$userId" :name="$name" />

 <td><x-landlord.list.my-badge :value="{{ $account->count_user }}"/></td>
<td><x-landlord.list.my-badge :value="{{ $account->count_gb }}"/></td>
<td><x-landlord.list.my-badge :value="{{ $account->count_pr }}"/></td>
<td><x-landlord.list.my-badge :value="{{ $account->count_po }}"/></td>
<td><x-landlord.list.my-badge :value="{{ $account->rank }}"/></td>
<td><x-landlord.list.my-badge :value="{{ $account->status }}"/></td>
