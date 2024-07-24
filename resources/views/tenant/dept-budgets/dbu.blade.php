@extends('layouts.tenant.app')
@section('title','Dept Budget Usages')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Dept Budget Usages
		@endslot
		@slot('buttons')
			<x-tenant.actions.dept-budget-actions id="{{ $deptBudget->id }}"/>
		@endslot
	</x-tenant.page-header>


	<x-tenant.info.dept-budget-info :id="$deptBudget->id"/>

	<x-tenant.widgets.dbu-dept :id="$deptBudget->id"/>

	<script type="text/javascript">
		function mySubmit() {
			document.getElementById('frm1').submit();
		}
	</script>

@endsection

