<tr class="">
	<td colspan="10" class="text-end">
		<strong>TOTAL:</strong>
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('po_amount') is-invalid @enderror"
			style="text-align: right;"
			name="po_amount" id="po_amount" placeholder="1.00"
			value="{{ old('po_amount', isset($po->amount) ? number_format($po->amount,2) : "0.00") }}"
			required readonly>
		@error('po_amount')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		{{-- <x-tenant.buttons.show.save/> --}}
	</td>
</tr>
<tr class="">
	<td colspan="7" class="">

	</td>
	<td colspan="4" class="text-end">
		<div class="mb-3 float-end">
			{{-- <label class="form-check m-0">
				<input type="checkbox" class="form-check-input" name="banner_show" id="banner_show" />
				<span class="form-check-label text-danger">Display above Announcement?</span>
			</label> --}}
			<div class="form-check form-switch">
				<input class="form-check-input m-2" type="checkbox" id="add_row" name="add_row" checked>
				<label class="form-check-label" for="add_row">... add another row.</label>
				<a class="btn btn-secondary" href="{{ url()->previous() }}"><i data-feather="x-circle"></i> Cancel</a>
				<button type="submit" id="submit" name="action" value="save" class="btn btn-primary"><i data-feather="save"></i> Save</button>
			</div>
			
			{{-- <button type="submit" id="submit" name="action" value="save_add" class="btn btn-primary"><i data-feather="save"></i> Save and Add Line</button> --}}
		</div>
	</td>
</tr>

