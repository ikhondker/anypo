<tr class="">
	<td class="">
			{{-- First PO line of New PO --}}
			@isset($po)
				<input type="text" name="po_id" id="po_id" class="form-control" placeholder="ID" value="{{ old('po_id', $po->id ) }}" hidden>
			@endisset

		<a href="#" class="btn btn-primary float-start"><i class="fas fa-plus"></i></a>
	</td>
	<td class="">
		<select class="form-control select2" data-toggle="select2" name="item_id" id="item_id" required>
			<option value=""><< Item >> </option>
			@foreach ($items as $item)
				<option value="{{ $item->id }}" {{ $item->id == old('item_id') ? 'selected' : '' }} >{{ $item->name }} </option>
			@endforeach
		</select>
		@error('item_id')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		<input type="text" class="form-control @error('item_description') is-invalid @enderror"
			name="item_description" id="item_description" placeholder="Item Description"
			value="{{ old('item_description', '' ) }}"
			required/>
		@error('item_description')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
			<select class="form-control" name="uom_id" id="uom_id" required>
				<option value=""><< UoM >> </option>
				@foreach ($uoms as $uom)
					<option value="{{ $uom->id }}" {{ $uom->id == old('uom_id') ? 'selected' : '' }} >{{ $uom->name }} </option>
				@endforeach
			</select>
			@error('uom_id')
				<div class="text-danger text-xs">{{ $message }}</div>
			@enderror
	</td>
	<td class="text-end">
		<input type="number" class="form-control @error('qty') is-invalid @enderror"
			style="text-align: right;" min="1"
			name="qty" id="qty" placeholder="1"
			value="{{ old('qty','1') }}"
			required>
		@error('qty')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		N/A
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('price') is-invalid @enderror"
			style="text-align: right;"
			name="price" id="price" placeholder="1.00"
			value="{{ old('price','0.00') }}"
			required>
		@error('price')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('sub_total') is-invalid @enderror"
			style="text-align: right;"
			name="sub_total" id="sub_total" placeholder="1.00"
			value="{{ old('sub_total','0.00') }}"
			required>
		@error('sub_total')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="0" class="form-control @error('tax') is-invalid @enderror"
			style="text-align: right;"
			name="tax" id="tax" placeholder="1.00"
			value="{{ old('tax','0.00') }}"
			required>
		@error('tax')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="0" class="form-control @error('gst') is-invalid @enderror"
			style="text-align: right;"
			name="gst" id="gst" placeholder="1.00"
			value="{{ old('gst','0.00') }}"
			required>
		@error('gst')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('amount') is-invalid @enderror"
			style="text-align: right;"
			name="amount" id="amount" placeholder="1.00"
			value="{{ old('amount','0.00') }}"
			required>
		@error('amount')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		*
	</td>
	<td class="">
		*
	</td>
</tr>

@include('tenant.includes.js.calculate-po-amount')