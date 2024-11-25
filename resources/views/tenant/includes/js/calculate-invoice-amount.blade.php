<script type="module">


	$(document).ready(function () {
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

		$('#po_id').change(function() {
			//alert($('option:selected').text());
			let id = $(this).val();
			let url = '{{ route("pos.get-po", ":id") }}';
			url = url.replace(':id', id);
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
				// delay: 250,
				success: function(response) {
					if (response != null) {
						$('#dsp_supplier').val(response.supplier_name);
						$('#dsp_po_currency').val(response.po_currency);
						$('#dsp_po_date').val(response.po_date);
						$('#dsp_po_amount').val(response.po_amount);
						$('#dsp_po_currency').val(response.po_currency);
						$('#dsp_dept_name').val(response.dept_name);
						$('#dsp_project_name').val(response.project_name);
						$('#dsp_buyer_name').val(response.buyer_name);
					}
				}
			});

		});

	});


	function calculate() {
		console.log("========= Calculate Function ===============");
		var old_line_amount = $("#amount").val();
		var old_inv_amount = $("#invoice_amount").val();
		console.log("->old_inv_amount before: = " + old_inv_amount);
		var qty = $("#qty").val();
		var price = $("#price").val();
		var tax = $("#tax").val();
		var gst = $("#gst").val();

		old_line_amount = old_line_amount.replace(/,/g, '');	// remove comma
		old_inv_amount 	= old_inv_amount.replace(/,/g, '');		// remove comma
		qty 			= qty.replace(/,/g, '');				// remove comma
		price 			= price.replace(/,/g, '');				// remove comma
		tax 			= tax.replace(/,/g, ''); 				// remove comma
		gst 			= gst.replace(/,/g, ''); 				// remove comma
		//console.log("->old_line_amount = " + old_line_amount);
		//console.log("->old_inv_amount = " + old_inv_amount);

		var sub_total = price * qty;
		var line_amount = parseFloat(sub_total) + parseFloat(tax) + parseFloat(gst);
		var inv_amount = parseFloat(old_inv_amount) - parseFloat(old_line_amount) + parseFloat(line_amount);


		sub_total = sub_total.toLocaleString('en-US', {minimumFractionDigits:2,maximumFractionDigits:2});
		//console.log("->sub_total=" + sub_total);
		$('#sub_total').val(sub_total);

		line_amount = line_amount.toLocaleString('en-US', {minimumFractionDigits:2,maximumFractionDigits:2});
		//console.log("->line amount=" + line_amount);
		$('#amount').val(line_amount);

		inv_amount = inv_amount.toLocaleString('en-US', {minimumFractionDigits:2,maximumFractionDigits:2});
		//console.log("->new inv_amount=" + inv_amount);
		$('#invoice_amount').val(inv_amount);

	}
</script>
