@extends('layouts.master')

@section('content')

    <div class="d-flex justify-content-between mb-4">
        <h3>Products List</h3>
        <a class="btn btn-success btn-sm" href="{{ route('create') }}">Create New</a>
    </div>

    @if(session()->has('success'))
        <label class="alert alert-success w-100">{{session('success')}}</label>
    @elseif(session()->has('error'))
        <label class="alert alert-danger w-100">{{session('error')}}</label>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Created At</th>
            <th>Name</th>
            <th>Weight</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)
            <tr>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->weight }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    
                    <a href="{{ route('show', ['id' => $product->id]) }}" class="btn btn-info btn-sm">Buy</a>
                    
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        {{ $products->render() }}
    </div>

@endsection