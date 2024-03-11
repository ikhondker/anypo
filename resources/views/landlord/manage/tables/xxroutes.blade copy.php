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

			@foreach($filesInFolder as $path)
						@php
							$file = pathinfo($path);
							$f= $file['filename'] ;
							//$t= $file['mTime'];
							$last_modified=File::lastModified($path);
							//$t = $t1->toDateTimeString();
							//$t=gmdate("Y-m-d\TH:i:s\Z", $t1)->diffForHumans();
							// ok
							//$t = Carbon::createFromTimestamp($t1)->format('m/d/Y');
							$last_modified_human= \Carbon\Carbon::parse($last_modified)->diffForHumans();
							$last_modified_date= \Carbon\Carbon::parse($last_modified);
							$days = $last_modified_date->diffInDays(now(), false);

							$removed = Str::remove('Controller', $f);
							$route = Str::lower(Str::plural(Str::snake($removed, '-')));

							$file = pathinfo($path);
							//echo $file['filename'] .'<br>' ;
							$fname = $file['filename'];

							//use App\Http\Controllers\AccountController;
							//Route::resource('accounts', AccountController::class);


							//echo "/* ======================== ".$fname." ========================================  */</br>";
							//echo "use App\Http\Controllers\\".$fname."Controller; </br>";
							//echo "Route::resource('".strtolower(Str::plural($fname))."', ".$fname."Controller::class);</br></br>";
						@endphp


						<div class="alert alert-secondary" role="alert">
							/* ======================== {{ $fname }} ======================================== */</br>
							use App\Http\Controllers\Landlord\{{ $fname }}Controller;</br>
							Route::resource('{{ strtolower(Str::plural($fname))}}', {{ $fname }}Controller::class)->middleware(['auth', 'verified']);</br>
							Route::get('/{{ strtolower($fname)}}/export',[{{ $fname }}Controller::class,'export'])->name('{{ strtolower(Str::plural($fname)) }}.export');</br>
							Route::get('/{{ strtolower(Str::plural($fname))}}/delete/{ {{ strtolower($fname) }} }',[{{ $fname }}Controller::class,'destroy'])->name('{{ strtolower(Str::plural($fname)) }}.destroy');</br>
						</div>

					@endforeach
		</div>
	</div>
	<!-- End Card -->

@endsection

