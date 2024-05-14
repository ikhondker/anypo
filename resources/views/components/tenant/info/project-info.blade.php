<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="row g-0">
					<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
						<img src="{{ Storage::disk('s3t')->url('flow/project.jpg') }}" width="240" height="321" class="mt-2" alt="Project">
					</div>
					<div class="col-sm-9 col-xl-12 col-xxl-9">
						<h4>{{ $project->name }}</h4>
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
									<td><span class="badge {{ ($project->closed ? 'bg-danger' : 'bg-success') }}">{{ ($project->closed ? 'Yes' : 'No') }}</span></td>
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
	</div>
</div>