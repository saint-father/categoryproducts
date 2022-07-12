<?php

namespace Alexfed\Categoryproducts\Http\Controllers;

use Alexfed\Categoryproducts\Http\Requests\CategoryRequest;
use Validator;

class CategoryController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CategoryRequest $request)
    {
        return $this->storeEntity($request->validated());
    }


    /**
     * Update the specified resource in storage.
     *
     */
    public function update(CategoryRequest $request, int $id)
    {
        return $this->updateEntity($request, $id);
    }
}
