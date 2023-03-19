<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {
        try {
            //*****store all requests in the data variable */
            $data = [
                "productName" => $request->productName,
                "productColor" => $request->productColor,
                "productCategory" => $request->productCategory,
                "productPrice" => $request->productPrice
            ];

            //******store in the data in the mySQLdb */
            Products::create($data);

            return redirect(route('home'))->with('success','Product stored');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products, $productId)
    {
        try {

            $findProduct = $products->find($productId);

            $productDetails = [
                "id" => $findProduct->id,
                "name" => $findProduct->productName,
                "category" => $findProduct->productCategory,
                "color" => $findProduct->productColor,
                "price" => $findProduct->productPrice
            ];

            return view('show-product',compact('productDetails'));
            } catch (\Throwable $th) {
                return redirect()->back()->with('error',$th->getMessage());
            }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products, $productId)
    {
        /***
         * @param id as productId
         * using the param to get the detailed information about that product
         * creating an array variable to store in the find information
         */
        try {

        $findProduct = $products->find($productId);

        $productDetails = [
            "id" => $findProduct->id,
            "name" => $findProduct->productName,
            "category" => $findProduct->productCategory,
            "color" => $findProduct->productColor,
            "price" => $findProduct->productPrice
        ];

        return view('edit-product',compact('productDetails'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, Products $products)
    {
        /***
         * @param id
         * using the param to update the product
         */
        try {
            //******find the product data with the new request data id*/
            $findProduct = $products->find($request->id);

            //******update the find product */
            $findProduct->productName = $request->productName;
            $findProduct->productCategory = $request->productCategory;
            $findProduct->productColor = $request->productColor;
            $findProduct->productPrice = $request->productPrice;

            $findProduct->update();

            return redirect(route('home'))->with('success','Product updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Products $products)
    {
        /***
         * @param id
         * using the param to delete the product
         */
        try {
            //******find the product data with the new request data id*/
            $findProduct = $products->find($request->id);

            $findProduct->delete();

            return redirect(route('home'))->with('success','Product deleted');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }
}
