@extends('layouts.landlord-app')
@section('title','Routes List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')
	<!-- Card -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Routes Lists</h5>
		</div>

		<!-- card-body -->
		<div class="card-body">
			<x-landlord.table-links/>

			@foreach($filesInFolder as $row) 
				<div class="alert alert-secondary" role="alert">
					/* ======================== {{ $row['fname'] }} ======================================== */</br>
					use App\Http\Controllers\Landlord\{{ $row['fname'] }}Controller;</br>
					Route::resource('{{ strtolower(Str::plural($row['fname']))}}', {{ $row['fname'] }}Controller::class)->middleware(['auth', 'verified']);</br>
					Route::get('/{{ strtolower($row['fname'])}}/export',[{{ $row['fname'] }}Controller::class,'export'])->name('{{ strtolower(Str::plural($row['fname'])) }}.export');</br>
					Route::get('/{{ strtolower(Str::plural($row['fname']))}}/delete/{ {{ strtolower($row['fname']) }} }',[{{ $row['fname'] }}Controller::class,'destroy'])->name('{{ strtolower(Str::plural($row['fname'])) }}.destroy');</br>
				</div>
			@endforeach
		</div>
	</div>    
	<!-- End Card -->

@endsection

