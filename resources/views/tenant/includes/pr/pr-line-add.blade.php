<tr class="table-primary">
	<td class="">
		{{-- First PR line of New PR --}}
		@isset($pr)
			<input type="text" name="pr_id" id="pr_id" class="form-control" placeholder="ID" value="{{ old('pr_id', $pr->id ) }}" hidden>
		@endisset
		<i class="align-middle me-1" data-lucide="plus"></i>
	</td>
	<td class="">
		<select class="form-control select2" data-toggle="select2" name="item_id" id="item_id" required>
			<option value=""><< Item >> </option>
			@foreach ($items as $item)
				<option value="{{ $item->id }}" {{ $item->id == old('item_id') ? 'selected' : '' }} >{{ $item->code .' - '.$item->name }}</option>
			@endforeach
		</select>
		@error('item_id')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		<input type="text" class="form-control @error('item_description') is-invalid @enderror"
			name="item_description" id="item_description" placeholder="Item Description"
			value="{{ old('item_description', '' ) }}"
			required/>
		@error('item_description')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
			<select class="form-control" name="uom_id" id="uom_id" required>
				<option value="">&lt;UoM&gt;</option>
				@foreach ($uoms as $uom)
					<option value="{{ $uom->id }}" {{ $uom->id == old('uom_id') ? 'selected' : '' }} >{{ $uom->name }}</option>
				@endforeach
			</select>
			@error('uom_id')
				<div class="small text-danger">{{ $message }}</div>
			@enderror
	</td>
	<td class="text-end">
		<input type="number" class="form-control @error('qty') is-invalid @enderror"
			style="text-align: right;" min="1" step="0.01" max="999999.99"
			name="qty" id="qty" placeholder="1"
			value="{{ old('qty','1') }}"
			required>
		@error('qty')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		{{-- <input type="text" class="form-control" data-mask="0,000.00" data-reverse="false"> --}}
		<input type="number" class="form-control @error('price') is-invalid @enderror"
			{{-- data-mask="000,000,000.00" data-reverse="true" --}}
			{{-- data-inputmask="'mask': '9,999,999.99'" --}}
			style="text-align: right;" min="1" step="0.01" max="999999.99"
			name="price" id="price" placeholder="0.00"
			value="{{ old('price','0.00') }}"
			required>
		@error('price')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="text" class="form-control @error('sub_total') is-invalid @enderror"
			style="text-align: right;"
			name="sub_total" id="sub_total" placeholder="0.00"
			value="{{ old('sub_total','0.00') }}"
			readonly>
		@error('sub_total')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="0" class="form-control @error('tax') is-invalid @enderror"
			style="text-align: right;" min="1" step="0.01" max="999999.99"
			name="tax" id="tax" placeholder="0.00"
			value="{{ old('tax','0.00') }}"
			required>
		@error('tax')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="0" class="form-control @error('gst') is-invalid @enderror"
			style="text-align: right;" min="1" step="0.01" max="999999.99"
			name="gst" id="gst" placeholder="0.00"
			value="{{ old('gst','0.00') }}"
			required>
		@error('gst')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="text" class="form-control @error('amount') is-invalid @enderror"
			style="text-align: right;"
			name="amount" id="amount" placeholder="1.00"
			value="{{ old('amount','0.00') }}"
			readonly>
		@error('amount')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	{{-- <td class="">
		<button type="submit" id="submit" name="action" value="save" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="save"></i></button>
		<a class="btn btn-secondary" href="{{ url()->previous() }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel"><i data-lucide="x-circle"></i></a>
	</td> --}}
</tr>
