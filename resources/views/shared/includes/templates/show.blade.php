
<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a href="{{ route('templates.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
			@if (auth()->user()->isSystem())
				<a class="btn btn-sm btn-danger text-white" href="{{ route('templates.edit', $template->id) }}"><i data-lucide="edit"></i> Edit</a>
			@endif
		</div>
		<h5 class="card-title">Template Info</h5>
		<h6 class="card-subtitle text-muted">View Template Details.</h6>
	</div>
	<div class="card-body">
		<table class="table table-sm my-2">
			<tbody>
				<tr>
					<th>Photo :</th>
					<td>@if ( $template->image <> '')
						<img src="{{ url('template/'.$template->image) }}" width="100px">
					@else
						<img src="{{asset('/logo/logo.png')}}" width="120px">
					@endif</td>
				</tr>

				<x-landlord.show.my-text	value="{{ $template->code }}" label="CODE"/>
				<x-landlord.show.my-text	value="{{ $template->summary }}" label="Summary"/>
				<x-landlord.show.my-text	value="{{ $template->name }}"/>
				<x-landlord.show.my-text	value="{{ $template->email }}" label="E-mail"/>
				<x-landlord.show.my-text	value="{{ $template->phone }}" label="Phone"/>
				<x-landlord.show.my-badge	value="{{ $template->user->name }}" label="User Name"/>
				<x-landlord.show.my-badge	value="{{ $template->my_enum }}" label="Enum/Role:"/>
				<x-landlord.show.my-enable	value="{{ $template->enable }}"/>
				<x-landlord.show.my-badge	value="{{ $template->id }}" label="ID"/>

				<x-landlord.show.my-text value="{{ $template->address1 }}" label="Address1"/>
				<x-landlord.show.my-text value="{{ $template->address2 }}" label="Address2"/>
				<x-landlord.show.my-number value="{{ $template->qty }}" label="Qty"/>
				<x-landlord.show.my-number value="{{ $template->amount }}" label="Amount"/>

				<x-landlord.show.my-enable		value="{{ $template->my_bool }}"/>
				<x-landlord.show.my-date		value="{{ $template->my_date }}" label="Date"/>
				<x-landlord.show.my-date-time	value="{{ $template->my_date_time }}" label="Datetime"/>

				<tr>
					<th>Photo :</th>
					<td>
						@if ( $template->image <> '')
							<img src="{{ url('profile/'.$template->image) }}" width="90px">
						@else
							<img src="{{ url('profile/avatar.png') }}" width="90px">
						@endif
					</td>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<td><a class="btn btn-primary" href="{{ route('templates.edit',$template->id) }}">Edit</a></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>


<div class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('templates.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
					@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('templates.edit', $template->id) }}"><i data-lucide="edit"></i> Edit</a>
					@endif
				</div>
				<h5 class="card-title">Basic Info</h5>
				<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.show.my-text		value="{{ $template->code }}" label="CODE"/>
						<x-tenant.show.my-text		value="{{ $template->summary }}" label="Summary"/>
						<x-tenant.show.my-text		value="{{ $template->name }}"/>
						<x-tenant.show.my-text		value="{{ $template->email }}" label="E-mail"/>
						<x-tenant.show.my-text		value="{{ $template->phone }}" label="Phone"/>
						<x-tenant.show.my-text		value="{{ $template->user->name }}" label="User Name"/>
						<x-tenant.show.my-badge		value="{{ $template->my_enum }}" label="Enum/Role:"/>
						<x-tenant.show.my-boolean	value="{{ $template->enable }}"/>
						<x-tenant.show.my-badge		value="{{ $template->id }}" label="ID"/>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- end col -->
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('templates.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
					@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('templates.edit', $template->id) }}"><i data-lucide="edit"></i> Edit</a>
					@endif
				</div>
				<h5 class="card-title">Address Info</h5>
				<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>

						<x-tenant.show.my-text value="{{ $template->address1 }}" label="Address1"/>
							<x-tenant.show.my-text value="{{ $template->address2 }}" label="Address2"/>
							<x-tenant.show.my-text value="{{ $template->zip }}" label="Zip"/>
							<x-tenant.show.my-text value="{{ $template->state }}" label="state"/>
							<x-tenant.show.my-integer value="{{ $template->qty }}" label="Qty"/>
							<x-tenant.show.my-number value="{{ $template->amount }}" label="Amount"/>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- end col -->
</div>
<!-- end row -->

<div class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('templates.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
					@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('templates.edit', $template->id) }}"><i data-lucide="edit"></i> Edit</a>
					@endif
				</div>
				<h5 class="card-title">Address Info</h5>
				<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Photo :</th>
							<td>@if ( $template->image <> '')
								<img src="{{ url('template/'.$template->image) }}" width="100px">
							@else
								<img src="{{asset('/logo/logo.png')}}" width="120px">
							@endif</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
	<!-- end col -->
	<div class="col-6">

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('templates.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
					@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('templates.edit', $template->id) }}"><i data-lucide="edit"></i> Edit</a>
					@endif
				</div>
				<h5 class="card-title">Others</h5>
				<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.show.my-boolean	value="{{ $template->enable }}" label="Boolean"/>
						<x-tenant.show.my-date		value="{{ $template->my_date }}" label="Date"/>
						<x-tenant.show.my-date-time value="{{ $template->my_date_time }}" label="DateTime"/>
					</tbody>
				</table>
			</div>
		</div>

	</div>
	<!-- end col -->
</div>
<!-- end row -->


