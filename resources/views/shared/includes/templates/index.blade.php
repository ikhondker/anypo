
<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
				<!-- form -->
				<form action="{{ route('templates.index') }}" method="GET" role="search">
					<div class="input-group input-group-search">
						<input type="text" class="form-control" id="datatables-template-search"
							minlength=3 name="term"
							value="{{ old('term', request('term')) }}" id="term"
							placeholder="Search templates…" required>
						<button class="btn" type="submit">
							<i data-lucide="search"></i>
						</button>
					</div>
					@if (request('term'))
						Search result for: <strong class="text-info">{{ request('term') }}</strong>
					@endif
				</form>
				<!--/. form -->
			</div>
			<div class="col-md-6 col-xl-8">
				<div class="text-sm-end">
					<a href="{{ route('templates.index') }}" class="btn btn-primary btn-lg"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
						<i data-lucide="refresh-cw"></i></a>
					<a href="{{ route('templates.export') }}" class="btn btn-light btn-lg me-2"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
						<i data-lucide="download"></i> Export</a>
				</div>
			</div>
		</div>

		<table class="table w-100">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Date</th>
					<th class="text-end">Amount</th>
					<th>Name2</th>
					<th>Role</th>
					<th>Enable</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($templates as $template)
					<tr>
						<td>
							<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Logo" title="Logo">
						</td>
						<td>
							<a href="{{ route('templates.show', $template->id) }}">
								<strong>{{ $template->name }}</strong>
							</a>
						</td>
						<td>{{ $template->phone }}</td>
						<td>{{ strtoupper(date('d-M-y', strtotime($template->my_date))) }}</td>
						<td class="text-end">{{number_format($template->amount, 2)}}</td>
						<td>{{ $template->user->name}}</td>
						<td><span class="badge bg-primary">{{ $template->my_enum}}</span> </td>
						<td>
							<span class="badge {{ ($template->enable ? 'badge-subtle-success text-success' : 'badge-subtle-danger text-danger') }}">{{ ($template->enable ? 'Yes' : 'No') }}</span>
						</td>
						<td>
							<a href="{{ route('templates.show',$template->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
								data-bs-placement="top" title="View">View</a>
							<a href="{{ route('templates.delete', $template->id) }}"
								class="text-body" data-entity="Template"
								data-name="{{ $template->name }}"
								data-status="{{ $template->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
								data-bs-placement="top" title="{{ $template->enable ? 'Disable' : 'Enable' }}">
								<i data-lucide="{{ $template->enable ? 'bell-off' : 'bell' }}"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="row mb-3">
			{{ $templates->links() }}
		</div>

	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<form action="{{ route( 'templates.index') }}" method="GET" role="search">
						<div class="btn-toolbar mb-4" role="toolbar" aria-label="Toolbar with button groups">
							<div class="btn-group me-2" role="group" aria-label="First group">
								<input type="text" class="form-control form-control-sm" name="term" placeholder="Search..." id="term">
								<button type="submit" class="btn btn-info me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Search..."><i class="fa-solid fa-magnifying-glass"></i></button>
								<a href="{{ route( 'templates.index') }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
									<i class="fa-solid fa-arrows-rotate"></i>
								</a>
								<a href="{{ route( 'templates.export') }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
									<i class="fa-solid fa-download"></i>
								</a>
							</div>
						</div>
					</form>
				</div>
				<h5 class="card-title">Templates Lists</h5>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th class="">#</th>
							<th class="">Name</th>
							<th class="">Phone</th>
							<th class="">Date</th>
							<th class="text-end">Amount</th>
							<th class="">User Full Name</th>
							<th class="">Role</th>
							<th class="text-center">Enable</th>
							<th class="">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($templates as $template)
						<tr>
							<td class="">{{ $templates->firstItem() + $loop->index }}</td>
							<td class=""><a class="text-info" href="{{ route('templates.show',$template->id) }}">{{ $template->name }}</a></td>

							<td class="">{{ $template->phone }}</td>
							<td>{{ strtoupper(date('d-M-y', strtotime($template->my_date))) }}</td>
							<td class="text-end">{{number_format($template->amount, 2)}}</td>
							<td class="">{{ $template->user->name}}</td>
							<td class=""><span class="badge bg-primary-light">{{ $template->my_enum}}</span> </td>
							<td class="text-center">
								<x-tenant.list.my-boolean :value="$template->enable"/>
							</td>
							<td class="text-end">
								<a href="{{ route('templates.show',$template->id) }}" class="btn btn-light"
									data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
								</a>
							</td>

						</tr>
						@endforeach
					</tbody>
				</table>

				<div class="row pt-3">
					{{ $templates->links() }}
				</div>
				<!-- end pagination -->

			</div>
			<!-- end card-body -->
		</div>
		<!-- end card -->

	</div>
</div>
