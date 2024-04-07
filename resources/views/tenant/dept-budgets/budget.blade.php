@extends('layouts.app')
@section('title','DeptBudget')

@section('content')

	<x-tenant.page-header>
		@slot('title')
		DeptBudget
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="DeptBudget"/>
			<x-tenant.buttons.header.create object="DeptBudget"/>
			<x-tenant.actions.dept-budget-actions id="{{ $deptBudget->id }}"/>
		
		@endslot
	</x-tenant.page-header>


	<x-tenant.info.dept-budget-info :id="$deptBudget->id"/>

	<x-tenant.widgets.dbu-dept :id="$deptBudget->id"/>

	<div class="row">
		<div class="col-6">
			
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->
	
	@include('shared.includes.js.sw2-advance')

	<script type="text/javascript">
		function mySubmit() {
			document.getElementById('frm1').submit();
		}
	</script>

@endsection

