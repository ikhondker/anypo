@extends('layouts.app')

@section('title','Test | anyPO.com')
@section('content-header')
		<!-- Null -->
@endsection

@section('content')

	<x-tenant.page-header>
						@slot('title')
								Dashboard
						@endslot
						@slot('buttons')
								<a href="#" class="btn btn-primary float-end me-1"><i class="fas fa-plus"></i> Home</a>
								<a href="#" class="btn btn-primary float-end me-1"><i class="fas fa-plus"></i> New project</a>
						@endslot
	</x-tenant.page-header>

				<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Empty card Test</h5>
						</div>
						<div class="card-body">
							<img src="{{asset('img/anypo.png')}}" width="80px" height="45px"/> 
							<img src="/tenancy/assets/img/anypo.png" width="80px" height="45px"/> 
							<img src="{{ public_path('anypo.png') }}" width="80px" height="45px"/> 
							<img src="/img/anypo.png" width="80px" height="45px"/>
							<img src="{{ public_path('/img/anypo.png') }}" style="width: 80px; height: 80px">
							<img src="{{ storage_path('app/avatar.png') }}" style="width: 80px">

							<form method="POST" action="{{ route('countries.destroy', 'BD') }}">
									@csrf
									<input name="_method" type="hidden" value="DELETE">
									<button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-name="abc" data-username='uname'  data-toggle="tooltip" title='Delete'>Submit</button>
							</form>


							<a href="/testrun" data-name="abc" data-username='uname' class="btn btn-danger delete-confirm">Delete Link</a>

							
							<?php
							echo "The time is " . date("YmdHis"); 
							?>

						</div>
					</div>
				</div>
			</div>
			
			
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

			<script type="text/javascript">

			// sweet alert to form submit
			 $('.show_confirm').click(function(event) {
						var form =  $(this).closest("form");
						var name = $(this).data("name");
						var username = $(this).data("username");
						event.preventDefault();
						swal({
								title: `Are you sure you want to delete  "${name}" ${username} this record?`,
								text: "If you delete this, it will be gone forever.",
								icon: "warning",
								buttons: true,
								dangerMode: true,
						})
						.then((willDelete) => {
							if (willDelete) {
								form.submit();
							}
						});
				});

			 

				// sweet alert to link 
		$('.delete-confirm').on('click', function (e) {
				e.preventDefault();
				const url = $(this).attr('href');
				var name = $(this).data("name");
				var username = $(this).data("username");

				swal({
						title: 'Are you sure?',
						text: `Are you sure you want to delete  "${name}" ${username} this record?`,
						icon: 'warning',
						buttons: ["Cancel", "Yes!"],
						dangerMode: true,
				}).then(function(value) {
						if (value) {
								window.location.href = url;
						}
				});
		});
	



				$(document).on('click', '#btn-submit', function(e) {
					e.preventDefault();
					let name = $(this).data('name');
					Swal.fire({
							title: "Confrimation!",
							text: "Are you sure you want to delete ${name} user",
							type: "warning",
							allowEscapeKey: false,
							allowOutsideClick: false,
							showCancelButton: true,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "Yes",
							cancelButtonText: "No",
							showLoaderOnConfirm: true,
							closeOnConfirm: false
					}).then((isConfirm) => {
							if (isConfirm.value === true) {
									document.getElementById("delForm").submit();
									return true;
							}
							return false;
					});
			});

			 

	</script>    



@endsection
