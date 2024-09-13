<tr class="">
	<td class="text-middle">{{ $invoiceLine->line_num }}</td>
	<td class="">{{ $invoiceLine->summary }}</td>
	<td class="text-end">{{ $invoiceLine->qty }}</td>
	<td class="text-end"><x-tenant.list.my-number :value="$invoiceLine->price"/> {{ $invoiceLine->invoice->currency }}</td>
	<td class="text-end"><x-tenant.list.my-number :value="$invoiceLine->sub_total"/></td>
	<td class="text-end"><x-tenant.list.my-number :value="$invoiceLine->tax"/></td>
	<td class="text-end"><x-tenant.list.my-number :value="$invoiceLine->gst"/></td>
	<td class="text-end"><x-tenant.list.my-number :value="$invoiceLine->amount"/></td>
	@if ($action)
		<td class="">
			@if ($invoiceLine->invoice->status == App\Enum\AuthStatusEnum::DRAFT->value)
				<a href="{{ route('invoice-lines.edit',$invoiceLine->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
					<i class="align-middle" data-lucide="edit"></i></a>
				<a href="{{ route('invoice-lines.destroy',$invoiceLine->id) }}" class="text-muted sw2-advance"
					data-entity="LINE #" data-name="{{ $invoiceLine->line_num }}" data-status="Delete"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
					<i class="align-middle" data-lucide="trash-2"></i>
				</a>
			@endif
		</td>
	@endif
</tr>