@extends('layouts.landlord.app')
@section('title','Processes')
@section('breadcrumb','Processes')


@section('content')

		<!-- Card -->
		<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Process</h4>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">

				<tbody>
					<tr>
						<td class="">1</td>
						<td class="">Generate Invoice</td>
						<td class="">Generate Invoice</td>
						<td class="text-end">
							<a class="btn btn-danger" onclick="return confirm('Do you want to run Invoice Generation Process? ')" href="{{ route('processes.gen-invoice-all') }}">Run Process</a>
						</td>
					</tr>
					<tr>
						<td class="">1</td>
							<td class="">Accounts Archive</td>
							<td class="">Accounts Archive</td>
							<td class="text-end">
								<a class="btn btn-danger" onclick="return confirm('Do you want to run Accounts Archive Process? ')" href="{{ route('processes.accounts-archive') }}">Run Process **</a>
							</td>
					</tr>

				</tbody>
			</table>
		</div>
		<!-- End Table -->

	</div>
	<!-- End Card -->
@endsection


