<tr class="">
	<td class="">
		<input type="text" name="pr_id" id="pr_id" class="form-control" placeholder="ID" value="{{ old('pr_id', $pr->id ) }}" hidden>
		<a href="#" class="btn btn-primary float-start"><i class="fas fa-edit"></i></a>
	</td>
	<td class="">
		<select class="form-control" name="item_id">
			@foreach ($items as $item)
				<option {{ $item->id == old('item_id',$prl->item_id) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }} </option>
			@endforeach
		</select>
		@error('item_id')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		<input type="summary" class="form-control @error('summary') is-invalid @enderror"
			name="summary" id="summary" placeholder="name@company.com"
			value="{{ old('summary', $prl->summary ) }}"
			required/>
		@error('summary')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		<select class="form-control" name="uom_id">
			@foreach ($uoms as $uom)
				<option {{ $uom->id == old('uom_id',$prl->uom_id) ? 'selected' : '' }} value="{{ $uom->id }}">{{ $uom->name }} </option>
			@endforeach
		</select>
	</td>
	<td class="text-end">
		<input type="number" class="form-control @error('qty') is-invalid @enderror"
			style="text-align: right;" min="1"
			name="qty" id="qty" placeholder="1"
			value="{{ old('qty', $prl->qty ) }}"
			required>
		@error('qty')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('price') is-invalid @enderror"
			style="text-align: right;"
			name="price" id="price" placeholder="1.00"
			value="{{ old('price', $prl->price ) }}"
			required>
		@error('price')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('sub_total') is-invalid @enderror"
			style="text-align: right;"
			name="sub_total" id="sub_total" placeholder="1.00"
			value="{{ old('sub_total', $prl->sub_total ) }}"
			readonly>
		@error('sub_total')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('tax') is-invalid @enderror"
			style="text-align: right;"
			name="tax" id="tax" placeholder="1.00"
			value="{{ old('tax', $prl->tax ) }}"
			required>
		@error('tax')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('gst') is-invalid @enderror"
			style="text-align: right;"
			name="gst" id="gst" placeholder="1.00"
			value="{{ old('gst', $prl->gst ) }}"
			required>
		@error('gst')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>

	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('amount') is-invalid @enderror"
			style="text-align: right;"
			name="amount" id="amount" placeholder="1.00"
			value="{{ old('amount',$prl->amount) }}"
			readonly>
		@error('amount')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		{{-- <x-tenant.widgets.submit/> --}}
	</td>
</tr>