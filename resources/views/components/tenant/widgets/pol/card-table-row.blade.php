<tr class="">
	<td class="">{{ $pol->line_num }}</td>
	<td class="">{{ $pol->item->code }}</td>
	<td class="">{{ $pol->item_description }}</td>
	<td class="">{{ $pol->uom->name }}</td>
	<td class="text-end">{{ $pol->qty }}</td>
	<td class="text-end">{{ $pol->received_qty }}</td>
	<td class="text-end"><x-tenant.list.my-number :value="$pol->price"/></td>
	<td class="text-end"><x-tenant.list.my-number :value="$pol->sub_total"/></td>
	<td class="text-end"><x-tenant.list.my-number :value="$pol->tax"/></td>
	<td class="text-end"><x-tenant.list.my-number :value="$pol->gst"/></td>
	<td class="text-end"><x-tenant.list.my-number :value="$pol->amount"/></td>
	<td class="text-end"><span class="badge {{ $pol->close_status_badge->badge }}">{{ $pol->close_status_badge->name}}</span></td>
	<td class="table-action">
		<a href="{{ route('pols.show',$pol->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
			<i class="align-middle" data-lucide="eye"></i></a>

		@if ($status == App\Enum\AuthStatusEnum::DRAFT->value)
			<a href="{{ route('pols.edit',$pol->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
				<i class="align-middle" data-lucide="edit"></i></a>

			<a href="{{ route('pols.destroy',$pol->id) }}" class="text-muted sw2-advance"
				data-entity="Line #" data-name="{{ $pol->line_num }}" data-status="Delete"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
				<i class="align-middle" data-lucide="trash-2"></i>
			</a>
		@elseif ($status == App\Enum\AuthStatusEnum::APPROVED->value)
			<a href="{{ route('pols.receipt',$pol->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Goods Receipt">
				<i class="align-middle" data-lucide="file-text"></i></a>
		@endif

	</td>
</tr>
