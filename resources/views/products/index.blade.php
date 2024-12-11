@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="text-end">
            <a href="product/create" class="btn btn-dark mt-2">New Product</a>
        </div>
            <table class="table table-hover mt-2">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td><a href="products/{{ $product->id }}/show" class="text-dark">{{ $product->name }}</a></td>
                            <td><img src="products/{{ $product->image }}" class="rounded-circle" width="50" height="50" /></td>
                            <td><a href="products/{{ $product->id }}/edit" class="btn btn-dark">Edit</a></td>
                            <td><a href="products/{{ $product->id }}/delete" class="btn btn-danger">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
            {{ $products->links() }}    
        </div>
@endsection