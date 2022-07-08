<?php

namespace Alexfed\Categoryproducts\Http\Controllers;

use Alexfed\Categoryproducts\Models\Product;
use Alexfed\Categoryproducts\Http\Requests\ProductRequest;
use Alexfed\Categoryproducts\Http\Requests\StorePostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(Product::all(), 'Products retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return $this->sendResponse($product, 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $productId
     * @return mixed
     */
    public function show(int $productId)
    {
        try {
            $displayedProduct = Product::findOrFail($productId);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse($displayedProduct, 'Product retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(ProductRequest $request, int $id)
    {
        try {
            $updatedProduct = Product::findOrFail($id);
            $updatedProduct->fill($request->except(['id']));
            $updatedProduct->save();
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $this->sendError('Product not found.');
        } catch (\Exception $exception) {
            return $this->sendError('Updating error', [$exception->getMessage()],422);
        }

        return $this->sendResponse($updatedProduct, 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     */
    public function destroy(int $id)
    {
        try {
            $deletedProduct = Product::findOrFail($id);
            $deletedProduct->delete();
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $this->sendError('Product not found.');
        } catch (\Exception $exception) {
            return $this->sendError('Deleting error', [$exception->getMessage()], 422);
        }

        return $this->sendResponse(null, 'Product deleted successfully.', 204);
    }
}
