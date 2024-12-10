<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a href="{{ route('tables.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i>View all</a>
		</div>
		<h5 class="card-title">Folder: {{ request()->route()->parameter('dir') }}</h5>
		<h6 class="card-subtitle text-muted">
			<a class="" href="{{ route('tables.comments') }}"><i class="align-middle me-1" data-lucide="folder"></i>Root</a>
			<a class="" href="{{ route('tables.comments','Admin') }}"><i class="align-middle me-1" data-lucide="folder"></i>Admin</a>
			<a class="" href="{{ route('tables.comments','Lookup') }}"><i class="align-middle me-1" data-lucide="folder"></i>Lookup</a>
			<a class="" href="{{ route('tables.comments','Manage') }}"><i class="align-middle me-1" data-lucide="folder"></i>Manage</a>
			<a class="" href="{{ route('tables.comments','Workflow') }}"><i class="align-middle me-1" data-lucide="folder"></i>Workflow</a>
			<a class="" href="{{ route('tables.comments','Support') }}"><i class="align-middle me-1" data-lucide="folder"></i>Support</a>
		</h6>
	</div>
	<div class="card-body">
		@foreach($filesInFolder as $row)
		<div class="alert alert-primary" role="alert">
			<div class="alert-message">
				<h5>{{ $row['bname'] }}</h5>


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
</div>
@endforeach
</div>
</div>
