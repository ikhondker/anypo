@extends('layouts.landlord-app')
@section('title', 'My Services')
@section('breadcrumb', 'My Services')

@section('content')
	@inject('carbon', 'Carbon\Carbon')

	<x-landlord.widget.account-services/>
	
	
	<x-landlord.widget.add-addon/>
	
	@include('shared.includes.js.sw2-advance')

@endsection
