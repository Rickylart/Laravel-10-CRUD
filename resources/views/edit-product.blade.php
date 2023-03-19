@extends('layouts.main')
@section('title','Edit')
@section('content')
@section('card-title', 'Edit Products')

{{-- calling the alert component --}}
<x-alert-component/>
    <div class="d-grid gap-2 mb-2">
        <a href="{{ route('home') }}" class="btn btn-danger" type="button">Back</a>
    </div>
    <div class="mb-2 mt-3 text-center border border-5">
        <strong>Edit a product</strong>
    </div>

    <form method="POST" action="{{ route('updateProduct',['id' => $productDetails['id']]) }}">
        @method('PATCH')
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="productName" value="{{ $productDetails['name'] }}"
                placeholder="name@example.com">
            <label for="floatingInput">Product Name</label>
            <span>
                @error('productName')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </span>
        </div>


        <div class="form-floating mb-3">
        <select class="form-select" name="productCategory" aria-label="Default select example">
                <option selected value="{{ $productDetails['category'] }}">{{ $productDetails['category'] }}</option>
                <option value="Rice">Rice</option>
                <option value="Gari">Gari</option>
                <option value="Maize">Maize</option>
            </select>
            <label for="floatingPassword">Product Category</label>
            <span>
                @error('productCategory')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </span>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingPassword" name="productColor" value="{{ $productDetails['color'] }}" placeholder="Password">
            <label for="floatingPassword">Product Color</label>
            <span>
                @error('productColor')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </span>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="floatingPassword" name="productPrice" value="{{ $productDetails['price'] }}" placeholder="Password">
            <label for="floatingPassword">Product Price</label>
            <span>
                @error('productPrice')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </span>
        </div>

        <div class="form-floating">
            <div class="d-grid gap-2">
                <button class="btn btn-outline-warning" type="submit">Update Product</button>
            </div>
        </div>
    </form>
@endsection
