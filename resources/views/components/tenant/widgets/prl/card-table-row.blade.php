<tr class="">
	<td class="text-middle">{{ $prl->line_num }}</td>
	<td class="">{{ $prl->item->code }}</td>
	<td class="">{{ $prl->item_description }}</td>
	<td class="">{{ $prl->uom->name }}</td>
	<td class="text-end"><x-tenant.list.my-number :value="$prl->qty"/></td>
	<td class="text-end"><x-tenant.list.my-number :value="$prl->price"/></td>
	<td class="text-end"><x-tenant.list.my-number :value="$prl->sub_total"/></td>
	<td class="text-end"><x-tenant.list.my-number :value="$prl->tax"/></td>
	<td class="text-end"><x-tenant.list.my-number :value="$prl->gst"/></td>
	<td class="text-end"><x-tenant.list.my-number :value="$prl->amount"/></td>
	@if ($action)
		<td class="">
			@can('update', $prl)
				<a href="{{ route('prls.edit',$prl->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
					<i class="align-middle" data-lucide="edit"></i></a>
				<a href="{{ route('prls.destroy',$prl->id) }}" class="text-muted sw2-advance"
					data-entity="LINE #" data-name="{{ $prl->line_num }}" data-status="Delete"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
					<i class="align-middle" data-lucide="trash-2"></i>
				</a>
			@endcan
		</td>
	@endif
</tr>
