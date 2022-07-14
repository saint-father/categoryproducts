<?php
/**
 * @author Aleksey Fiodorov
 * @copyright Copyright (c) saint-father (https://github.com/saint-father)
 */

namespace Alexfed\Categoryproducts\Http\Controllers;

use Alexfed\Categoryproducts\Http\Requests\ProductRequest;
use Alexfed\Categoryproducts\Interfaces\EntityServiceInterface as EntityService;
use Alexfed\Categoryproducts\Services\ProductService;
use Validator;

/**
 * Calss ProductController with Product entity specific dependencies and overrides
 */
class ProductController extends BaseController
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * ProductController constructor
     *
     * @param EntityService $entityService
     * @param ProductService $productService
     */
    public function __construct(
        EntityService $entityService,
        ProductService $productService
    ) {
        parent::__construct($entityService);

        $this->productService = $productService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        return $this->storeEntity($request->validated());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(ProductRequest $request, int $id)
    {
        return $this->updateEntity($request, $id);
    }

    /**
     * Link product to specific categories
     *
     * @param ProductRequest $request
     * @param int $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignCategory(ProductRequest $request, int $productId)
    {
        $attached = $this->productService->assignToCategories($productId, $request->get('category-ids'));


        return $this->sendResponse($attached, 'Assigned');
    }
}
