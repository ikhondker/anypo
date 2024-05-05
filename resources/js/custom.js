
document.addEventListener('DOMContentLoaded', function() {

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
	
	$('.sw2-advance').on('click', function (e) {
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
			}
		})
	});

});