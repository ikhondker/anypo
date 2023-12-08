@extends('layouts.app')
@section('title','Header Comments')
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
				<h5 class="card-title">Header Comments</h5>
				</div>
				<div class="card-body">
					@foreach($filesInFolder as $path) 
					@php
						$file = pathinfo($path);
						
						$f= $file['filename'] ;
						$b= $file['basename'] ;

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
						$bname = $file['basename'];
						$dname = substr($file['dirname'],strlen(base_path()));
						
						//use App\Http\Controllers\AccountController;
						//Route::resource('accounts', AccountController::class);


						//echo "/* ======================== ".$fname." ========================================  */</br>";
						//echo "use App\Http\Controllers\\".$fname."Controller; </br>";
						//echo "Route::resource('".strtolower(Str::plural($fname))."', ".$fname."Controller::class);</br></br>";
					@endphp

					<div class="alert alert-primary" role="alert">
						<div class="alert-message">
							<h5>{{ $bname }}</h5>
							
<pre class="card-text">
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			{{ $bname }}
* @brief		This file contains the implementation of the {{ $fname }}
* @path			{{ $dname }}
* @author		Iqbal H. Khondker &lt;ihk@khondker.com&gt;
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker 
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/
</pre>

						</div>
					</div>

					@endforeach

				</div>
			</div>
		</div>
	</div>

@endsection

