<script type="module">
	$(document).ready(function () {

		//console.log("Inside: calculate-pr-amount.blade.php ");
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

						var old_line_amount = $("#amount").val();
						var old_pr_amount = $("#pr_amount").val();
						old_line_amount = old_line_amount.replace(",", ""); // remove command
						old_pr_amount = old_pr_amount.replace(",", "");     // remove command

						console.log("->old_line_amount=" + old_line_amount);
						console.log("->old_pr_amount=" + old_pr_amount);
						//console.log("number old_pr_amount=" + Number(old_pr_amount.replace(',','')));
						//console.log("parseFloat old_pr_amount=" + parseFloat(old_pr_amount.replace(',','')));
						//console.log("parseInt old_pr_amount=" + parseInt(old_pr_amount.replace(',',''),2));
						//console.log("response.name = " + response.name );

						$('#item_description').val(response.name);

						var uom_class_id = response.uom_class_id;
						var qty = $("#qty").val();

						var price = response.price;
						console.log("price=" + price);
						//$('#price').val(price.toFixed(2));
						$('#price').val(price);

						var sub_total = price * qty;
						$('#sub_total').val(sub_total.toFixed(2));
						//console.log("sub_total=" + sub_total);

						var tax = $("#tax").val();
						var gst = $("#gst").val();

						var amount = parseFloat(sub_total) + parseFloat(tax) + parseFloat(gst);
						console.log("line amount=" + amount);

						$('#amount').val(amount.toFixed(2));

						//var pr_amount = parseFloat(old_pr_amount.replace(',','')) - parseInt(old_amount) + parseInt(amount);
						var pr_amount = parseFloat(old_pr_amount) - parseFloat(old_line_amount) + parseFloat(amount);
						//var pr_amount = old_pr_amount - old_line_amount + amount;
						console.log("->new pr_amount=" + pr_amount);

						$('#pr_amount').val(pr_amount.toFixed(2));

					}
				}

			});

			let url2 = '{{ route("uoms.get-uoms-by-class", ":id") }}';
			url2 = url2.replace(':id', '1001');	// TODO
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

        function calculate() {
            console.log("========= Calcualte Function ===============");
            var old_line_amount = $("#amount").val();
			var old_pr_amount = $("#pr_amount").val();
			old_line_amount = old_line_amount.replace(",", ""); // remove command
			old_pr_amount = old_pr_amount.replace(",", "");     // remove command
			console.log("->old_line_amount=" + old_line_amount);
			console.log("->old_pr_amount=" + old_pr_amount);





        }


		$('#qty').change(function() {

            calculate();
			var old_line_amount = $("#amount").val();
			var old_pr_amount = $("#pr_amount").val();
			old_line_amount = old_line_amount.replace(",", ""); // remove command
			old_pr_amount = old_pr_amount.replace(",", "");     // remove command

			var qty = $("#qty").val();
			var price = $("#price").val();

			var sub_total = price * qty;
			$('#sub_total').val(sub_total.toFixed(2));

			var tax = $("#tax").val();
			var gst = $("#gst").val();

			var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
			$('#amount').val(amount.toFixed(2));


			var pr_amount = parseInt(old_pr_amount) - parseInt(old_line_amount) + parseInt(amount);;
			$('#pr_amount').val(pr_amount.toFixed(2));
			//console.log("amount = " + amount);
		});

		$('#price').change(function() {

			var old_amount = $("#amount").val();
			var old_pr_amount = $("#pr_amount").val();


			var qty = $("#qty").val();
			var price = $("#price").val();

			var sub_total = price * qty;
			$('#sub_total').val(sub_total.toFixed(2));

			var tax = $("#tax").val();
			var gst = $("#gst").val();

			var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
			$('#amount').val(amount.toFixed(2));

			var pr_amount = parseInt(old_pr_amount) - parseInt(old_amount) + parseInt(amount);;
			$('#pr_amount').val(pr_amount.toFixed(2));
			//console.log("amount = " + amount);
		});

		$('#tax').change(function() {

			var old_amount = $("#amount").val();
			var old_pr_amount = $("#pr_amount").val();

			var sub_total = $("#sub_total").val();
			var tax = $("#tax").val();
			var gst = $("#gst").val();

			var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
			$('#amount').val(amount.toFixed(2));

			var pr_amount = parseInt(old_pr_amount) - parseInt(old_amount) + parseInt(amount);;
			$('#pr_amount').val(pr_amount.toFixed(2));

			//console.log("amount = " + amount);
		});

		$('#gst').change(function() {
			var old_amount = $("#amount").val();
			var old_pr_amount = $("#pr_amount").val();

			var sub_total = $("#sub_total").val();
			var tax = $("#tax").val();
			var gst = $("#gst").val();

			var amount = parseInt(sub_total) + parseInt(tax) + parseInt(gst);
			$('#amount').val(amount.toFixed(2));

			var pr_amount = parseInt(old_pr_amount) - parseInt(old_amount) + parseInt(amount);;
			$('#pr_amount').val(pr_amount.toFixed(2));

			//console.log("amount = " + amount);
		});
	});
</script>
