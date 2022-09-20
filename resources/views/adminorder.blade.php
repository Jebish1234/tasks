@extends('layouts.master')

@section('content')

    <table class="table table-striped">
        <thead>
        <tr>
            <th>customer</th>
            <th>product</th>
            <th>time</th>
        </tr>
        </thead>
        <tbody>

        @if(count($orders) > 0)

        @foreach($orders as $or)
            <tr>
                <td>{{ $or->un }}</td>
                <td>{{ $or->pn}}</td>
                <td>{{ $or->time}}</td>
                
            </tr>
        @endforeach

        @else
        <tr><td> no any records found </td></tr>
        @endif

        </tbody>
    </table>


@endsection