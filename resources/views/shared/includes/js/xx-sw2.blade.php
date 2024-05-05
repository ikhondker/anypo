<script type="module">
	$('.sw2').on('click', function (e) {
		e.preventDefault();
		const url = $(this).attr('href');

		Swal.fire({
			title: 'Confirmation?',
			text: "Are you sure, you want to this?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3F80EA',
			cancelButtonColor: '#d9534f',
			confirmButtonText: 'Yes, confirmed!'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = url;
			}
		})
	});
</script>