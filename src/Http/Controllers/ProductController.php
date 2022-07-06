<?php

namespace Alexfed\Categoryproducts\Http\Controllers;

use Alexfed\Categoryproducts\Models\Product;
use Alexfed\Categoryproducts\Http\Requests\ProductRequest;
use Alexfed\Categoryproducts\Http\Requests\StorePostRequest;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $displayedProduct = Product::findOrFail($product);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(ProductRequest $request, Product $product)
    {
        $updatedProduct = Product::findOrFail($product);
        $updatedProduct->fill($request->except(['id']));
        $updatedProduct->save();
        return response()->json($updatedProduct);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $deletedProduct = Product::findOrFail($product);
        if($deletedProduct->delete()) return response(null, 204);
    }
}
