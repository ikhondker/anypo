@extends('layouts.landlord-app')
@section('title','Header Comments')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')


	<!-- Card -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Header Comments</h5>
		</div>

		<!-- card-body -->
		<div class="card-body">
			<x-landlord.table-links/>

			@foreach($filesInFolder as $row)
				<h5>{{ $row['bname'] }}</h5>
				<div class="alert alert-primary" role="alert">
<pre>
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			{{ $row['bname'] }}
* @brief		This file contains the implementation of the {{ $row['fname'] }}
* @path			{{ $row['dname'] }}
* @author		Iqbal H. Khondker &lt;ihk@khondker.com&gt;
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker &lt;ihk@khondker.com&gt;
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 4-JAN-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/
</pre>
				</div>
			@endforeach
		</div>
	</div>
	<!-- End Card -->

@endsection

