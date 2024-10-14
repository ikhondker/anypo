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
						var price = response.price;
						price = parseFloat(price).toFixed(2);	// make two decimal
						$('#price').val(price);
						calculate();

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

			calculate();
		});

		$('#price').change(function() {

			calculate();
		});

		$('#tax').change(function() {

			calculate();
		});

		$('#gst').change(function() {
			calculate();
		});
	});

	function calculate() {
		console.log("========= Calculate Function ===============");
		var old_line_amount = $("#amount").val();
		var old_po_amount = $("#po_amount").val();
		console.log("->old_po_amount before: = " + old_po_amount);
		var qty = $("#qty").val();
		var price = $("#price").val();
		var tax = $("#tax").val();
		var gst = $("#gst").val();

		old_line_amount = old_line_amount.replace(/,/g, '');	// remove comma
		old_po_amount 	= old_po_amount.replace(/,/g, '');		// remove comma
		qty 			= qty.replace(/,/g, '');				// remove comma
		price 			= price.replace(/,/g, '');				// remove comma
		tax 			= tax.replace(/,/g, ''); 				// remove comma
		gst 			= gst.replace(/,/g, ''); 				// remove comma
		console.log("->old_line_amount = " + old_line_amount);
		console.log("->old_po_amount = " + old_po_amount);

		var sub_total = price * qty;
		var line_amount = parseFloat(sub_total) + parseFloat(tax) + parseFloat(gst);
		var po_amount = parseFloat(old_po_amount) - parseFloat(old_line_amount) + parseFloat(line_amount);

		sub_total = sub_total.toLocaleString('en-US', {minimumFractionDigits:2,maximumFractionDigits:2});
		console.log("->sub_total=" + sub_total);
		$('#sub_total').val(sub_total);

		line_amount = line_amount.toLocaleString('en-US', {minimumFractionDigits:2,maximumFractionDigits:2});
		console.log("->line amount=" + line_amount);
		$('#amount').val(line_amount);

		po_amount = po_amount.toLocaleString('en-US', {minimumFractionDigits:2,maximumFractionDigits:2});
		console.log("->new po_amount = " + po_amount);
		$('#po_amount').val(po_amount);
	}
</script>
