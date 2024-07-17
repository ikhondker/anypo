show
<div class="card-actions float-end">
	<a class="btn btn-sm btn-light" href="{{ route('depts.edit', $dept->id ) }}"><i class="fas fa-edit"></i> Edit</a>
	<a class="btn btn-sm btn-light" href="{{ route('depts.index') }}" ><i class="fas fa-list"></i> View all</a>
</div>

edit
<div class="card-actions float-end">
	<a href="{{ route('depts.create') }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i> Create</a>
	<a href="{{ route('depts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
</div>

create 
<a href="{{ route('depts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>

<a href="{{ route('users.show',$user->id) }}" class="btn btn-light" 
	data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
</a>

<table class="table table-sm my-2">
	<tbody>

		<tr>
			<th></th>
			<td>
			
			</td>
		</tr>
		
	</tbody>
</table>

<tr>
	<th></th>
	<td>
	
	</td>
</tr>

<th width="30%">Photo</th>

@can('viewAny', $user)
	<x-tenant.buttons.header.lists object="User"/>
@endcan
