<tr class="">
	<td class="">
			{{-- First PO line of New PO --}}
			@isset($po)
				<input type="text" name="po_id" id="po_id" class="form-control" placeholder="ID" value="{{ old('po_id', $po->id ) }}" hidden>
			@endisset

		<a href="#" class="btn btn-primary float-start"><i class="fas fa-plus"></i></a>
	</td>
	<td class="">
		<select class="form-control" name="item_id" required>
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
		<input type="text" class="form-control @error('summary') is-invalid @enderror"
			name="summary" id="summary" placeholder="Line summary"
			value="{{ old('summary', '' ) }}"
			required/>
		@error('summary')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
			<select class="form-control" name="uom_id" required>
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
		<input type="number" step='0.01' min="1" class="form-control @error('price') is-invalid @enderror"
			style="text-align: right;"
			name="price" id="price" placeholder="1.00"
			value="{{ old('price','1.00') }}"
			required>
		@error('price')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('pol_amount') is-invalid @enderror"
			style="text-align: right;"
			name="pol_amount" id="pol_amount" placeholder="1.00"
			value="{{ old('pol_amount','1.00') }}"
			required>
		@error('pol_amount')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		{{-- <x-tenant.widgets.submit/> --}}
	</td>
</tr>

