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

						var old_amount = $("#amount").val();
						var old_po_amount = $("#po_amount").val();

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
						
						var po_amount = parseInt(old_po_amount) - parseInt(old_amount) + parseInt(amount);;
						$('#po_amount').val(po_amount.toFixed(2));
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

			var old_amount = $("#amount").val();
			var old_po_amount = $("#po_amount").val();

			var qty = $("#qty").val();
			var price = $("#price").val();

			var sub_total = price * qty;
			$('#sub_total').val(sub_total.toFixed(2));

			var tax = $("#tax").val();
			var gst = $("#gst").val();
						
			var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
			$('#amount').val(amount.toFixed(2));


			var po_amount = parseInt(old_po_amount) - parseInt(old_amount) + parseInt(amount);;
			$('#po_amount').val(po_amount.toFixed(2));
			//console.log("amount = " + amount);
		});

		$('#price').change(function() {

			var old_amount = $("#amount").val();
			var old_po_amount = $("#po_amount").val();


			var qty = $("#qty").val();
			var price = $("#price").val();

			var sub_total = price * qty;
			$('#sub_total').val(sub_total.toFixed(2));

			var tax = $("#tax").val();
			var gst = $("#gst").val();
						
			var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
			$('#amount').val(amount.toFixed(2));

			var po_amount = parseInt(old_po_amount) - parseInt(old_amount) + parseInt(amount);;
			$('#po_amount').val(po_amount.toFixed(2));
			//console.log("amount = " + amount);
		});

		$('#tax').change(function() {

			var old_amount = $("#amount").val();
			var old_po_amount = $("#po_amount").val();
			
			var sub_total = $("#sub_total").val();
			var tax = $("#tax").val();
			var gst = $("#gst").val();
		
			var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
			$('#amount').val(amount.toFixed(2));
			
			var po_amount = parseInt(old_po_amount) - parseInt(old_amount) + parseInt(amount);;
			$('#po_amount').val(po_amount.toFixed(2));
			
			//console.log("amount = " + amount);
		});

		$('#gst').change(function() {
			var old_amount = $("#amount").val();
			var old_po_amount = $("#po_amount").val();


			var sub_total = $("#sub_total").val();
			var tax = $("#tax").val();
			var gst = $("#gst").val();
		
			var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
			$('#amount').val(amount.toFixed(2));
			
			var po_amount = parseInt(old_po_amount) - parseInt(old_amount) + parseInt(amount);;
			$('#po_amount').val(po_amount.toFixed(2));

			//console.log("amount = " + amount);
		});
	});
</script>
