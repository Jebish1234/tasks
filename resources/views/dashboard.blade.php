@extends('layout')
  
@section('content')

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
            <th>Qty</th>
            <th>Price</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)
            <tr>
                @if($product->created_at)
                <td>{{ $product->created_at }}</td>
                @else
                <td> nill</td>
                @endif
                @if($product->name)
                <td>{{ $product->name }}</td>
                @else
                <td>nill</td>
                @endif
                @if($product->weight)
                <td>{{ $product->weight }}</td>
                @else
                <td>nill</td>
                @endif
                @if($product->price)
                <td>{{ $product->price }}</td>
                @else
                <td>nill</td>
                @endif
                @if($product->description)
                <td>{{ $product->description }}</td>
                @else
                <td>nill</td>
                @endif
                <td>
                    <a href="{{ route('cart', ['id' => $product->id]) }}" class="btn btn-info btn-sm">Add to cart</a>

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    
@endsection
                