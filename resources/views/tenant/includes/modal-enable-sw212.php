<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.min.js"></script> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.min.css" rel="stylesheet"> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<script type="text/javascript">
	// text: `Are you sure you want to ${status} ${entity}  "${country}"?`,
	//text: `Are you sure you want to delete  "${name}" ${username} this record?`,
	// sweet alert to link
	$('.enable-confirm').on('click', function (e) {
		e.preventDefault();
		const url = $(this).attr('href');
		var entity = $(this).data("entity").toLowerCase();
		var name = $(this).data("name");
		var status = $(this).data("status").toLowerCase();
		swal({
			title: 'Are you sure?',
			text: `Are you sure you want to ${status} ${entity} "${name}"?`,
			icon: 'warning',
			buttons: ["Cancel", "Yes!"],
			dangerMode: true,
		}).then(function(value) {
			if (value) {
				window.location.href = url;
			}
		});
	});

</script>