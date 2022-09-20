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
            
            <th>Name</th>
            <th>description</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)
            <tr>
                
            <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>

                
                <td>
                    
                    <a href="{{ route('order', ['id' => $product->id]) }}" class="btn btn-info btn-sm">order</a>

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    
@endsection
                