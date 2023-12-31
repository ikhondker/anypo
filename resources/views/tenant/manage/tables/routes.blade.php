@extends('layouts.app')
@section('title','Routes List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Routes Lists
		@endslot
		@slot('buttons')
			<x-tenant.table-links/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Routes Lists</h5>
				</div>
				<div class="card-body">
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

						<div class="alert alert-primary" role="alert">
							<div class="alert-message">
								<p class="card-text">
								/* ======================== {{ $fname }} ======================================== */</br>
								use App\Http\Controllers\{{ $fname }}Controller;</br>
								Route::resource('{{ strtolower(Str::plural($fname))}}', {{ $fname }}Controller::class)->middleware(['auth', 'verified']);</br>
								Route::get('/{{ strtolower($fname)}}/export',[{{ $fname }}Controller::class,'export'])->name('{{ strtolower(Str::plural($fname)) }}.export');</br>
								Route::get('/{{ strtolower(Str::plural($fname))}}/delete/{ {{ strtolower($fname) }} }',[{{ $fname }}Controller::class,'destroy'])->name('{{ strtolower(Str::plural($fname)) }}.destroy');</br>
								</p>
							</div>
						</div>

					@endforeach
				</div>
			</div>
		</div>
	</div>

@endsection

