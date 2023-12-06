@extends('layouts.app')
@section('title','Edit PR Line')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            Edit PR Line
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.lists object="Pr"/>
            <x-tenant.buttons.header.create object="Pr"/>
            <x-tenant.buttons.header.edit object="Pr" :id="$pr->id"/>
            <x-tenant.buttons.header.pdf object="Pr" :id="$pr->id"/>
            <x-tenant.buttons.header.add-line object="Prl" :id="$pr->id"/>
        @endslot
    </x-tenant.page-header>
    
    {{-- @include('tenant.includes.view-pr-header') --}}

    <!-- form start -->
    <form action="{{ route('prls.update', $prl->id ) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <tr class="">
            <td class="">
                <input type="text" name="pr_id" id="pr_id" class="form-control" placeholder="ID" value="{{ old('pr_id', $pr->id ) }}" hidden>
        
                <a href="#" class="btn btn-primary float-start"><i class="fas fa-edit"></i></a>
            </td>
            <td class="">
                <select class="form-control" name="item_id">
                    @foreach ($items as $item)
                    <option {{ $item->id == old('item_id',$prl->item_id) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }} </option>
                    @endforeach
                </select>
        
                @error('item_id')
                    <div class="text-danger text-xs">{{ $message }}</div>
                @enderror
            </td>
            <td class="">
                <input type="summary" class="form-control @error('summary') is-invalid @enderror" 
                    name="summary" id="summary" placeholder="name@company.com"     
                    value="{{ old('summary', $prl->summary ) }}"
                    required/>
                @error('summary')
                    <div class="text-danger text-xs">{{ $message }}</div>
                @enderror
            </td>
            <td class="">11</td>
            <td class="text-end">
                <input type="number" class="form-control @error('qty') is-invalid @enderror" 
                    style="text-align: right;" min="1"
                    name="qty" id="qty" placeholder="1" 
                    value="{{ old('qty', $prl->qty ) }}"
                    required>
                @error('qty')
                        <div class="text-danger text-xs">{{ $message }}</div>
                @enderror
            </td>
            <td class="text-end">
                <input type="number" step='0.01' min="1" class="form-control @error('price') is-invalid @enderror" 
                    style="text-align: right;"
                    name="price" id="price" placeholder="1.00" 
                    value="{{ old('price', $prl->price ) }}"
                    required>
                @error('price')
                        <div class="text-danger text-xs">{{ $message }}</div>
                @enderror
            </td>
            <td class="text-end">
                <input type="number" step='0.01' min="1" class="form-control @error('amount') is-invalid @enderror" 
                    style="text-align: right;"
                    name="amount" id="amount" placeholder="1.00" 
                    value="{{ old('amount',$prl->amount) }}"
                    required>
                @error('amount')
                        <div class="text-danger text-xs">{{ $message }}</div>
                @enderror
            </td>
            <td class="">
                <x-buttons.submit/>
            </td>
        </tr>

    <!-- widget-pr-lines -->
    {{-- <x-tenant.widgets.pr-lines id="{{ $pr->id }}" :edit="true" pid="{{ $prl->id }}"/> --}}
    <!-- /.widget-pr-lines -->

    </form>
    <!-- /.form end -->

    <!-- Approval History -->
    @if ($pr->wf_id <> 0)
        <x-tenant.widgets.approval-history id="{{ $pr->wf_id }}"/>
    @endif
    

    <!-- approval form, show only if pending to current auth user -->
    {{-- @if (\App\Helpers\Workflow::allowApprove($pr->wf_id))
    @include('tenant.includes.wfd-approve-reject')
    @endif  --}}

      
@endsection

