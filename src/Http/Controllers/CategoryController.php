<?php
/**
 * @author Aleksey Fiodorov
 * @copyright Copyright (c) saint-father (https://github.com/saint-father)
 */

namespace Alexfed\Categoryproducts\Http\Controllers;

use Alexfed\Categoryproducts\Http\Requests\CategoryRequest;
use Validator;

/**
 * Calss CategoryController with Category entity specific dependencies and overrides
 */
class CategoryController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        return $this->storeEntity($request->validated());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, int $id)
    {
        return $this->updateEntity($request, $id);
    }
}
