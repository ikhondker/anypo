<tr class="">
	<td class="">
			{{-- First PR line of New PR --}}
			@isset($pr)
				<input type="text" name="pr_id" id="pr_id" class="form-control" placeholder="ID" value="{{ old('pr_id', $pr->id ) }}" hidden>
			@endisset

		<a href="#" class="btn btn-primary float-start"><i class="fas fa-plus"></i></a>
	</td>
	<td class="">
		<select class="form-control select2" data-toggle="select2" name="item_id" id="item_id" required>
			<option value=""><< Item >> </option>
			@foreach ($items as $item)
				<option value="{{ $item->id }}" {{ $item->id == old('item_id') ? 'selected' : '' }} >{{  $item->name .' - '.$item->code  }} </option>
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
		{{-- <x-tenant.buttons.show.save/> --}}
	</td>
</tr>

<script type="module">
	$(document).ready(function () {
		
		//console.log("Hello world 1!");
		$('#item_id').change(function() {
			//console.log("Item changed Hello world !");
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

						//console.log("response.name = " + response.name );
						$('#item_description').val(response.name);

						var uom_class_id = response.uom_class_id;
						var qty = $("#qty").val();

						var price = response.price;
						$('#price').val(price.toFixed(2));
						
						var sub_total = price * qty;
						$('#sub_total').val(sub_total.toFixed(2));

						var tax = $("#tax").val();
						var gst = $("#gst").val();
						
						var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
						$('#amount').val(amount.toFixed(2));
						//console.log("amount = " + amount);
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
