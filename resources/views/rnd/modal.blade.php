@extends('layouts.app')

@section('title','Modal | anyPO.com')
@section('content-header')
	<!-- Null -->
@endsection

@section('content')

	<x-tenant.page-header>
			@slot('title')
				Modal Window
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
					<h5 class="card-title">Modal Window Test</h5>
				</div>
				<div class="card-body">
					<form method="POST" action="{{ route('countries.destroy', 'BD') }}">
						@csrf
						<div class="row">
							<div class="col-6">
								Modal Confirm
							</div>
							<div class="col-6">
								<div>
									@livewire('rnd.modal-confirm') 
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-6">
								Modal Info
							</div>
							<div class="col-6">
								@livewire('rnd.modal-info')
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								Button old
							</div>
							<div class="col-6">
								{{-- @livewire('rnd.lw-button') --}}
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

@endsection




