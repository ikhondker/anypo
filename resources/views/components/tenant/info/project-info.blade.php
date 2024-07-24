
<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			@can('update', $project)
				<a href="{{ route('projects.edit', $project->id ) }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i> Edit</a>
			@endcan
			<a href="{{ route('projects.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
		</div>
		<h5 class="card-title mb-0">{{ $project->name }} [{{ $project->code }}]</h5>
	</div>
	<div class="card-body">
		<div class="row g-0">
			<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
				<img src="{{ Storage::disk('s3t')->url('flow/project.jpg') }}" width="240" height="321" class="mt-2" alt="Project">
			</div>
			<div class="col-sm-9 col-xl-12 col-xxl-9">
				<strong>{{ $project->name }}</strong>
				<p>{!! nl2br($project->notes) !!}</p>
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Code</th>
							<td>{{ $project->code }}</td>
						</tr>
						<tr>
							<th>Duration</th>
							<td>
								{{ ($project->start_date <> "") ? strtoupper(date('d-M-Y', strtotime($project->start_date ))) : "" }}
								to
								{{ ($project->end_date <> "") ? strtoupper(date('d-M-Y', strtotime($project->end_date ))) : "" }}
							</td>
						</tr>
						<tr>
							<th>Project Manager</th>
							<td>{{ $project->pm->name }}</td>
						</tr>
						<tr>
							<th>Budget</th>
							<td>{{number_format($project->amount, 2)}} {{ $_setup->currency }}</td>
						</tr>
						<tr>
							<th>Closed</th>
							<td><span class="badge {{ ($project->closed ? 'badge-subtle-danger' : 'badge-subtle-success') }}">{{ ($project->closed ? 'Yes' : 'No') }}</span></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><a href="{{ route('projects.show',$project->id) }}" class="text-warning d-inline-block">View Project Detail ...</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
