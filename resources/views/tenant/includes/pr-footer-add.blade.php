<tr class="">
	<td colspan="6" class="text-end">
		<strong>Subtotal:</strong>
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('sub_total') is-invalid @enderror"
			style="text-align: right;"
			name="sub_total" id="sub_total" placeholder="1.00"
			value="{{ old('sub_total','1.00') }}"
			required readonly>
		@error('sub_total')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		{{-- <x-tenant.widgets.submit/> --}}
	</td>
</tr>

<tr class="">
	<td colspan="6" class="text-end">
		Tax:
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
	<td class="">
		{{-- <x-tenant.widgets.submit/> --}}
	</td>
</tr>

<tr class="">
	<td colspan="6" class="text-end">
		Shipping:
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('shipping') is-invalid @enderror"
			style="text-align: right;"
			name="shipping" id="shipping" placeholder="1.00"
			value="{{ old('shipping','1.00') }}"
			required>
		@error('shipping')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		{{-- <x-tenant.widgets.submit/> --}}
	</td>
</tr>

<tr class="">
	<td colspan="6" class="text-end">
		Discount (-):
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('discount') is-invalid @enderror"
			style="text-align: right;"
			name="discount" id="discount" placeholder="1.00"
			value="{{ old('discount','1.00') }}"
			required>
		@error('discount')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		{{-- <x-tenant.widgets.submit/> --}}
	</td>
</tr>

<tr class="">
	<td colspan="6" class="text-end">
		<strong>TOTAL:</strong>
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('amount') is-invalid @enderror"
			style="text-align: right;"
			name="amount" id="amount" placeholder="1.00"
			value="{{ old('amount','1.00') }}"
			required readonly>
		@error('amount')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		{{-- <x-tenant.widgets.submit/> --}}
	</td>
</tr>


<tr class="">
	<td colspan="6" class="">

	</td>
	<td class="">
		<div class="mb-3 float-end">
			<a class="btn btn-secondary" href="{{ url()->previous() }}"><i data-feather="x-circle"></i> Cancel</a>
			<button type="submit" name="action" value="save">Save</button>
    
			{{-- <button type="submit" name="action" value="preview">Preview</button>
    		<button type="submit" name="action" value="advanced_edit">Advanced edit</button> --}}

			<button type="submit" id="submit" name="submit" class="btn btn-primary"><i data-feather="save"></i> Save and Add Line</button>
		</div>
	</td>
</tr>
