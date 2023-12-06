@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            Remove Attachments
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.lists object="Pr"/>
            <x-tenant.buttons.header.create object="Pr"/>
            <x-tenant.buttons.header.edit object="Pr" :id="$pr->id"/>
            <a href="{{ route('prs.show', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Pr</a>
        @endslot
    </x-tenant.page-header>
    
    @include('tenant.includes.view-pr-header-basic')
   
    @include('tenant.includes.detach-by-article')
 

@endsection

