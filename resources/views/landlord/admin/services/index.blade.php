@extends('layouts.landlord.app')
@section('title', 'My Services')
@section('breadcrumb', 'My Services')

@section('content')
	@inject('carbon', 'Carbon\Carbon')

	<x-landlord.widgets.account-services/>

	<x-landlord.widgets.add-addon/>

@endsection
