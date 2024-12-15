<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a class="btn btn-sm btn-light" href="{{ route($route.'.show', $article->id ) }}"><i data-lucide="eye"></i> View</a>
		</div>
		<h5 class="card-title">Standard Who and When</h5>
		<h6 class="card-subtitle text-muted">Standard Who and When Columns.</h6>
	</div>
	<div class="card-body">
		<table class="table table-sm my-2">
			<tbody>
				<tr>
					<th width="25%">Created By :</th>
					<td>{{ $article->user_created_by->name }}</td>
				</tr>
				<tr>
					<th>Created At :</th>
					<td>{{ strtoupper(date('d-M-Y H:i:s', strtotime($article->created_at))) }}</td>
				</tr>
				<tr>
					<th>Updated By :</th>
					<td>{{ $article->user_updated_by->name }}</td>
				</tr>
				<tr>
					<th>Updated At :</th>
					<td>{{ strtoupper(date('d-M-Y H:i:s', strtotime($article->updated_at))) }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
