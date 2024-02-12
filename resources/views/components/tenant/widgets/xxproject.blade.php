<div class="row">
	<div class="col-12 col-xl-10">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Project Info</h5>
			</div>
			<div class="card-body">
				<x-tenant.show.my-badge		value="{{ $project->id }}"/>
				<x-tenant.show.my-text		value="{{ $project->name }}"/>
				<x-tenant.show.my-date		value="{{ $project->start_date  }}"/>
				<x-tenant.show.my-date		value="{{ $project->end_date  }}"/>
				<x-tenant.show.my-text		value="{{ $project->pm->name }}" label="Project Manager"/>
				<x-tenant.show.my-text		value="{{ $project->notes }}" label="Notes"/>
				<x-tenant.show.my-boolean	value="{{ $project->closed }}"/>
				<x-tenant.show.my-badge		value="{{ $project->id }}"/>
			</div>
		</div>
	</div>
</div>
<!-- end row -->