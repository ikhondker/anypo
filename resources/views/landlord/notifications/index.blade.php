@extends('layouts.landlord.app')
@section('title','Notifications')
@section('breadcrumb','Notifications')

@section('content')
	<x-landlord.card.header title="Notifications"/>

	{{-- // No pagination --}}
	<x-landlord.wf.notification-all/>
@endsection

