@extends('layouts.tenant.app')
@section('title','Template')
@section('breadcrumb')
	<li class="breadcrumb-item active">View Templates v1.4 (3-JUL-24)</li>
@endsection

@section('content')
<x-tenant.page-header>
	@slot('title')
		Create Template
	@endslot
	@slot('buttons')
		<button class="btn btn-primary me-1" type="submit" form="myform"><i class="fas fa-save"></i> Save</button>
		<a href="{{ route('templates.index') }}" class="btn btn-primary float-end me-2"><i class="fas fa-list"></i> Template List</a>
	@endslot
</x-tenant.page-header>

 <!-- ========== INCLUDE ========== -->
 @include('shared.includes.templates.create')
 <!-- ========== INCLUDE ========== -->




@endsection
