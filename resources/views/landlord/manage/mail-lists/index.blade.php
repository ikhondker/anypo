@extends('layouts.landlord.app')
@section('title', 'Mail Lists')
@section('breadcrumb', 'Mail Lists')


@section('content')

	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">Mailing Lists</h5>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Email</th>
						<th>Date</th>
						<th>IP</th>
						<th>Enable</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($mailLists as $mailList)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle"
											src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" alt="Logo">
									</div>
									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="{{ route('categories.show', $mailList->id) }}">
											<h6 class="text-hover-primary mb-0">
												{{ $mailList->email }}
											</h6>
										</a>
										<small class="d-block">{{ $mailList->name }}</small>
									</div>
								</div>
							</td>
							<td><x-landlord.list.my-date :value="$mailList->created_at" /></td>
							<td>{{ $mailList->ip }}</td>
							<td><x-landlord.list.my-enable :value="$mailList->enable" /></td>

							<td>

								<a href="{{ route('mail-lists.destroy', $mailList->id) }}"
									class="text-body sw2-advance" data-entity="Email"
									data-name="{{ $mailList->email }}"
									data-status="{{ $mailList->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
									data-bs-placement="top" title="{{ $mailList->enable ? 'Disable' : 'Enable' }}">
									<i class="bi {{ $mailList->enable ? 'bi-bell-slash' : 'bi-bell' }} "
										style="font-size: 1.3rem;"></i>
								</a>


								{{-- <a class="text-body" href="javascript:;" data-bs-toggle="tooltip" data-bs-placement="top" title="Locked">
									<i class="bi-lock-fill" style="font-size: 1.5rem;"></i>
									<i class="bi bi-eye" style="font-size: 1.5rem;"></i>
								</a> --}}
							</td>
						</tr>
					@endforeach


				</tbody>
			</table>
		</div>
		<!-- End Table -->

		<!-- card-body -->
		<div class="card-body">
			<!-- pagination -->
			{{ $mailLists->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->



@endsection
