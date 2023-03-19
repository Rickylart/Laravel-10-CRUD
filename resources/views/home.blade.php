@extends('layouts.main')
@section('title', 'Home')
@section('content')
@section('card-title', 'View Products')

{{-- calling the alert component --}}
<x-alert-component />

<div class="table-responsive table-responsive-md table-responsive-sm">
    <div class="d-grid gap-2 mb-2 d-md-block">
        <a href="{{ route('createProduct') }}" class="btn btn-primary btn-block-full" type="button">Add product</a>
    </div>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Product Category</th>
                <th scope="col">Product Color</th>
                <th scope="col">Product Price</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <th scope="row">{{ $product->productName }}</th>
                    <td>{{ $product->productCategory }}</td>
                    <td>{{ $product->productColor }}</td>
                    <td>{{ $product->productPrice }}</td>
                    <td>
                        <div class="btn btn-sm" role="group" aria-label="Basic example">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <a href="{{ route('showProduct') }}/{{ $product->id }}" type="button"
                                        class="btn btn-sm btn-outline-primary">View</a>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <a href="{{ route('editProduct') }}/{{ $product->id }}" type="button"
                                        class="btn btn-sm btn-outline-warning">Edit</a>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <form method="POST" action="{{ route('deleteProduct', ['id' => $product->id]) }} ">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan='5'><strong class="text-danger">{{ 'No data found' }}</strong></td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>
@endsection
