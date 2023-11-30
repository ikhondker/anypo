@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

    <x-page-header>
        @slot('title')
            Remove Attachments
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="Pr"/>
            <x-buttons.header.create object="Pr"/>
            <x-buttons.header.edit object="Pr" :id="$pr->id"/>
            <a href="{{ route('prs.show', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Pr</a>
        @endslot
    </x-page-header>
    
    @include('includes.view-pr-header-basic')
   
    @include('includes.detach-by-article')
 

@endsection

