<tr class="">
	<td class="">
			{{-- First PR line of New PR --}}
			@isset($pr)
				<input type="text" name="pr_id" id="pr_id" class="form-control" placeholder="ID" value="{{ old('pr_id', $pr->id ) }}" hidden>
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
		<input type="number" step='0.01' min="1" class="form-control @error('sub_total') is-invalid @enderror"
			style="text-align: right;"
			name="sub_total" id="sub_total" placeholder="1.00"
			value="{{ old('sub_total','1.00') }}"
			readonly>
		@error('sub_total')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('tax') is-invalid @enderror"
			style="text-align: right;"
			name="tax" id="tax" placeholder="1.00"
			value="{{ old('tax','1.00') }}"
			required>
		@error('tax')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('gst') is-invalid @enderror"
			style="text-align: right;"
			name="gst" id="gst" placeholder="1.00"
			value="{{ old('gst','1.00') }}"
			required>
		@error('gst')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('amount') is-invalid @enderror"
			style="text-align: right;"
			name="amount" id="amount" placeholder="1.00"
			value="{{ old('amount','1.00') }}"
			readonly>
		@error('amount')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		{{-- <x-tenant.widgets.submit/> --}}
	</td>
</tr>

