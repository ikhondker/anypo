<tr class="">
	<td class="">
		<input type="text" name="po_id" id="po_id" class="form-control" placeholder="ID" value="{{ old('po_id', $po->id ) }}" hidden>
		<a href="#" class="btn btn-primary float-start"><i class="fas fa-edit"></i></a>
	</td>
	<td class="">
		<select class="form-control" name="item_id">
			@foreach ($items as $item)
				<option {{ $item->id == old('item_id',$pol->item_id) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }} </option>
			@endforeach
		</select>
		@error('item_id')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		<input type="summary" class="form-control @error('summary') is-invalid @enderror"
			name="summary" id="summary" placeholder="name@company.com"
			value="{{ old('summary', $pol->summary ) }}"
			required/>
		@error('summary')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		<select class="form-control" name="uom_id">
			@foreach ($uoms as $uom)
				<option {{ $uom->id == old('uom_id',$pol->uom_id) ? 'selected' : '' }} value="{{ $uom->id }}">{{ $uom->name }} </option>
			@endforeach
		</select>
	</td>
	<td class="text-end">
		<input type="number" class="form-control @error('qty') is-invalid @enderror"
			style="text-align: right;" min="1"
			name="qty" id="qty" placeholder="1"
			value="{{ old('qty', $pol->qty ) }}"
			required>
		@error('qty')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">N/A
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('price') is-invalid @enderror"
			style="text-align: right;"
			name="price" id="price" placeholder="1.00"
			value="{{ old('price', $pol->price ) }}"
			required>
		@error('price')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('sub_total') is-invalid @enderror"
			style="text-align: right;"
			name="sub_total" id="sub_total" placeholder="1.00"
			value="{{ old('sub_total', $pol->sub_total ) }}"
			required>
		@error('sub_total')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('tax') is-invalid @enderror"
			style="text-align: right;"
			name="tax" id="tax" placeholder="1.00"
			value="{{ old('tax', $pol->tax ) }}"
			required>
		@error('tax')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('gst') is-invalid @enderror"
			style="text-align: right;"
			name="gst" id="gst" placeholder="1.00"
			value="{{ old('gst', $pol->gst ) }}"
			required>
		@error('gst')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>

	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('amount') is-invalid @enderror"
			style="text-align: right;"
			name="amount" id="amount" placeholder="1.00"
			value="{{ old('amount',$pol->amount) }}"
			required>
		@error('amount')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		<span class="badge {{ $pol->close_status_badge->badge }}">{{ $pol->close_status_badge->name}}</span>
	</td>
	<td class="table-action">
		<a href="{{ route('pols.show',$pol->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
			<i class="align-middle" data-feather="eye"></i></a>
		
		@if ($po->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
			<a href="{{ route('pols.edit',$pol->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
				<i class="align-middle" data-feather="edit"></i></a>
		
			<a href="{{ route('pols.destroy',$pol->id) }}" class="text-muted modal-boolean-advance" 
				data-entity="Line #" data-name="{{ $pol->line_num }}" data-status="Delete"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
				<i class="align-middle" data-feather="trash-2"></i>
			</a>
		@elseif ($po->auth_status == App\Enum\AuthStatusEnum::APPROVED->value)
			<a href="{{ route('pols.receipt',$pol->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Goods Receipt">
				<i class="align-middle" data-feather="file-text"></i></a>
		@endif	
	</td>
</tr>

@include('tenant.includes.modal-boolean-advance')