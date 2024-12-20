// A+ https://stackoverflow.com/questions/66562974/how-to-catch-form-submit-method-with-sweetalert2
document.addEventListener('DOMContentLoaded', function() {

	// Tenant: Activity, Budget, Notification
	// Landlord: Ticket
	$('.sw2').on('click', function (e) {
		e.preventDefault();
		const url = $(this).attr('href');
		Swal.fire({
			title: '<h2>Confirmation?</h2>',
			text: "Are you sure, you want to do this?",
			icon: 'question',
			iconColor: '#d9534f',
			showCancelButton: true,
			showCancelButton: true,
			confirmButtonText: 'Yes, confirmed!',
			customClass: {
				confirmButton: 'btn btn-primary m-1',
				cancelButton: 'btn btn-secondary m-1'
			},
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
			title: '<h2>Confirmation?</h2>',
			text: "Are you sure, you want to " +status +" "+ entity + " '"+ name +"'?",
			icon: 'question',
			iconColor: '#d9534f',
			showCancelButton: true,
			showCancelButton: true,
			confirmButtonText: 'Yes, confirmed!',
			customClass: {
				confirmButton: 'btn btn-primary m-1',
				cancelButton: 'btn btn-secondary m-1'
			},
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = url;
			}
		})
	});

});
