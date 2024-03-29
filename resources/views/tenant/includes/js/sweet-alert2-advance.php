<!-- How to call  -->
<!-- <a href="{{ route('depts.destroy', $dept->id) }}" class="me-2 enable-confirm" 
	data-entity="Dept" data-name="{{ $dept->name }}" data-status="{{ ($dept->enable ? 'Disable' : 'Enable') }}"
	data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($dept->enable ? 'Disable' : 'Enable') }}">
	<i class="align-middle {{ ($dept->enable ? 'text-muted' : 'text-success') }}" data-feather="{{ ($dept->enable ? 'bell-off' : 'bell') }}"></i>
</a> -->

<script type="module">
	$('.sweet-alert2-advance').on('click', function (e) {
		e.preventDefault();
		const url = $(this).attr('href');
		//var entity = $(this).data("entity").toLowerCase();
		var entity = $(this).data("entity");
		var name = $(this).data("name");
		var status = $(this).data("status").toLowerCase();

		Swal.fire({
			title: 'Confirmation?',
			text: "Are you sure, you want to " +status +" "+ entity + " '"+ name +"'?",
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