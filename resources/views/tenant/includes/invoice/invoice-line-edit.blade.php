<tr class="table-primary">
	<td class="">
		<input type="text" name="invoice_id" id="invoice_id" class="form-control" placeholder="ID" value="{{ old('invoice_id', $invoice->id ) }}" hidden>
		{{ $invoiceLine->line_num }}
	</td>
	<td class="">
		<input type="summary" class="form-control @error('summary') is-invalid @enderror"
			name="summary" id="summary" placeholder="Item Description"
			value="{{ old('summary', $invoiceLine->summary ) }}"
			required/>
		@error('summary')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>

	<td class="text-end">
		<input type="number" class="form-control @error('qty') is-invalid @enderror"
			style="text-align: right;" min="1" step="0.01" max="999999.99"
			name="qty" id="qty" placeholder="1"
			value="{{ old('qty', number_format($invoiceLine->qty, 2) ) }}"
			required>
		@error('qty')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('price') is-invalid @enderror"
			style="text-align: right;" min="1" step="0.01" max="999999.99"
			name="price" id="price" placeholder="0.00"
			value="{{ old('price',number_format($invoiceLine->price, 2) ) }}"
			required>
		@error('price')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>

	<td class="text-end">
		<input type="text" class="form-control @error('sub_total') is-invalid @enderror"
			style="text-align: right;"
			name="sub_total" id="sub_total" placeholder="0.00"
			value="{{ old('sub_total', number_format($invoiceLine->sub_total, 2)) }}"
			readonly>
		@error('sub_total')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="0" class="form-control @error('tax') is-invalid @enderror"
			style="text-align: right;" min="1" step="0.01" max="999999.99"
			name="tax" id="tax" placeholder="0.00"
			value="{{ old('tax', number_format($invoiceLine->tax, 2) ) }}"
			required>
		@error('tax')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="0" class="form-control @error('gst') is-invalid @enderror"
			style="text-align: right;" min="1" step="0.01" max="999999.99"
			name="gst" id="gst" placeholder="0.00"
			value="{{ old('gst', number_format($invoiceLine->gst, 2) ) }}"
			required>
		@error('gst')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>

	<td class="text-end">
		<input type="text" class="form-control @error('amount') is-invalid @enderror"
			style="text-align: right;"
			name="amount" id="amount" placeholder="0.00"
			value="{{ old('amount',number_format($invoiceLine->amount, 2)) }}"
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



