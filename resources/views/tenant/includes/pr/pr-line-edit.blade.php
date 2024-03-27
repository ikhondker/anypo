<tr class="">
	<td class="">
		<input type="text" name="pr_id" id="pr_id" class="form-control" placeholder="ID" value="{{ old('pr_id', $pr->id ) }}" hidden>
		<a href="#" class="btn btn-primary float-start"><i class="fas fa-edit"></i></a>
	</td>
	<td class="">
		<select class="form-control select2" data-toggle="select2" name="item_id" id="item_id">
			@foreach ($items as $item)
				<option {{ $item->id == old('item_id',$prl->item_id) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->code }} </option>
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
		<select class="form-control" name="uom_id" id="uom_id">
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
		{{-- <x-tenant.buttons.show.save/> --}}
	</td>
	{{-- <script type="text/javascript">
		console.log("Hello world 1!");
	</script> --}}
</tr>
<script type="module">
	$(document).ready(function () {
		
		// console.log("Hello world 1!");
		$('#item_id').change(function() {
			let id = $(this).val();
			let url = '{{ route("items.get-item", ":id") }}';
			url = url.replace(':id', id);
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
				// delay: 250,
				success: function(response) {
					if (response != null) {
						var qty = $("#qty").val();
						var uom_class_id = response.uom_class_id;

						$('#summary').val(response.summary);
						var price = response.price;
						$('#price').val(price.toFixed(2));
						
						var sub_total = price * qty;
						$('#sub_total').val(sub_total.toFixed(2));

						var tax = $("#tax").val();
						var gst = $("#gst").val();
						
						var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
						$('#amount').val(amount.toFixed(2));
						console.log("amount = " + amount);
					}
				}

			});

			let url2 = '{{ route("uoms.get-uoms-by-class", ":id") }}';
			url2 = url2.replace(':id', '1001');
			$("#uom_id").html('');
			$.ajax({
				url: url2,
				type: 'get',
				dataType: 'json',
				success: function (res) {
					// $('#uom_id').html('<option value="">-- Select UoM --</option>');
					$.each(res.uoms, function (key, value) {
						$("#uom_id").append('<option value="' + value
							.id + '">' + value.name + '</option>');
					});
				}
			});
		});

			
		$('#qty').change(function() {
			var qty = $("#qty").val();
			var price = $("#price").val();

			var sub_total = price * qty;
			$('#sub_total').val(sub_total.toFixed(2));

			var tax = $("#tax").val();
			var gst = $("#gst").val();
						
			var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
			$('#amount').val(amount.toFixed(2));
			console.log("amount = " + amount);
		});

		$('#price').change(function() {
			var qty = $("#qty").val();
			var price = $("#price").val();

			var sub_total = price * qty;
			$('#sub_total').val(sub_total.toFixed(2));

			var tax = $("#tax").val();
			var gst = $("#gst").val();
						
			var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
			$('#amount').val(amount.toFixed(2));
			console.log("amount = " + amount);
		});

		$('#tax').change(function() {
			var sub_total = $("#sub_total").val();
			var tax = $("#tax").val();
			var gst = $("#gst").val();
		
			var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
			$('#amount').val(amount.toFixed(2));
			console.log("amount = " + amount);
		});

		$('#gst').change(function() {
			var sub_total = $("#sub_total").val();
			var tax = $("#tax").val();
			var gst = $("#gst").val();
		
			var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
			$('#amount').val(amount.toFixed(2));
			console.log("amount = " + amount);
		});
	});
</script>
