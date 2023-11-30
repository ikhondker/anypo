@extends('layouts.report')

@section('body')
    <table id="runfshop">
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Enable</th>
        </tr>
        @foreach ($items as $items)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $items->id }}</td>
                <td>{{ $items->name }}</td>
                <td style="text-align:right">{{  number_format($items->price, 2)}}</td>
                <td style="text-align:right">{{ $items->stock }}</td>
                <td>{{ ($items->enable ? 'Yes' : 'No') }}</td>
            </tr>
        @endforeach
        <tr>
            <th></th>
            <th></th>
            <th>TOTAL:</th>
            <th style="text-align:right">{{ number_format($total, 2) }}</th>
            <th></th>
            <th></th>
        </tr>
    </table>
@endsection