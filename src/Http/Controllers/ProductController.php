<?php

namespace Alexfed\Categoryproducts\Http\Controllers;

use Alexfed\Categoryproducts\Http\Requests\ProductRequest;
use Validator;

class ProductController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(ProductRequest $request)
    {
        return $this->storeEntity($request->validated());
    }


    /**
     * Update the specified resource in storage.
     *
     */
    public function update(ProductRequest $request, int $id)
    {
        return $this->updateEntity($request, $id);
    }
}
