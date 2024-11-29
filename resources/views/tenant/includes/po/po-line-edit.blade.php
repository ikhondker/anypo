<tr class="table-primary">
	<td class="">
		<input type="text" name="po_id" id="po_id" class="form-control" placeholder="ID" value="{{ old('po_id', $po->id ) }}" hidden>
		{{ $pol->line_num }}
	</td>
	<td class="">
		<select class="form-control select2" data-toggle="select2" name="item_id" id="item_id">
			@foreach ($items as $item)
				<option {{ $item->id == old('item_id',$pol->item_id) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
			@endforeach
		</select>
		@error('item_id')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		<input type="item_description" class="form-control @error('item_description') is-invalid @enderror"
			name="item_description" id="item_description" placeholder="Item Description"
			value="{{ old('item_description', $pol->item_description ) }}"
			required/>
		@error('item_description')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		<select class="form-control" name="uom_id">
			@foreach ($uoms as $uom)
				<option {{ $uom->id == old('uom_id',$pol->uom_id) ? 'selected' : '' }} value="{{ $uom->id }}">{{ $uom->name }}</option>
			@endforeach
		</select>
	</td>

	<td class="text-end">
		<input type="number" class="form-control @error('qty') is-invalid @enderror"
			style="text-align: right;" min="1" step="0.01" max="999999.99"
			name="qty" id="qty" placeholder="1"
			value="{{ old('qty', number_format($pol->qty, 2) ) }}"
			required>
		@error('qty')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('price') is-invalid @enderror"
			style="text-align: right;" min="1" step="0.01" max="999999.99"
			name="price" id="price" placeholder="1.00"
			value="{{ old('price', number_format($pol->price, 2) ) }}"
			required>
		@error('price')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="text" class="form-control @error('sub_total') is-invalid @enderror"
			style="text-align: right;"
			name="sub_total" id="sub_total" placeholder="1.00"
			value="{{ old('sub_total', number_format($pol->sub_total, 2) ) }}"
			readonly>
		@error('sub_total')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('tax') is-invalid @enderror"
			style="text-align: right;" min="1" step="0.01" max="999999.99"
			name="tax" id="tax" placeholder="1.00"
			value="{{ old('tax', number_format($pol->tax, 2) ) }}"
			required>
		@error('tax')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('gst') is-invalid @enderror"
			style="text-align: right;" min="1" step="0.01" max="999999.99"
			name="gst" id="gst" placeholder="1.00"
			value="{{ old('gst', number_format($pol->gst, 2) ) }}"
			required>
		@error('gst')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>

	<td class="text-end">
		<input type="text" class="form-control @error('amount') is-invalid @enderror"
			style="text-align: right;"
			name="amount" id="amount" placeholder="1.00"
			value="{{ old('amount',number_format($pol->amount, 2)) }}"
			readonly>
		@error('amount')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
