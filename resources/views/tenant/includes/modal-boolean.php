<!-- <a href="{{ route('notifications.destroy',$notification->id) }}" class="me-2 modal-boolean" 
	data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
	<i class="align-middle" data-feather="trash-2"></i>
</a> -->

<script type="text/javascript">
	$('.modal-boolean').on('click', function (e) {
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
				//	Swal.fire(
				//	'Deleted!',
				//	'Your file has been deleted.',
				//	'success'
				// )
			}
		})
	});
</script>