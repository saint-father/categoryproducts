<?php

namespace Alexfed\Categoryproducts\Http\Controllers;

use Alexfed\Categoryproducts\Http\Requests\ProductRequest;
use Alexfed\Categoryproducts\Interfaces\EntityServiceInterface as EntityService;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $entityService;

    public function __construct(
        EntityService $entityService
    ) {
        $this->entityService = $entityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $displayedEntity = $this->entityService->get();

        return $this->sendResponse($displayedEntity, 'Products retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function storeEntity($request)
    {
//        $product = Product::create($request->validated());
        $product = $this->entityService->set($request);

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
            $displayedProducts = $this->entityService->get($productId);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse($displayedProducts, 'Product retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function updateEntity($request, int $id)
    {
        try {
            $updatedProduct = $this->entityService->set($request->except(['id']), $id);
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
            $updatedProduct = $this->entityService->set([], $id);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $this->sendError('Product not found.');
        } catch (\Exception $exception) {
            return $this->sendError('Deleting error', [$exception->getMessage()], 422);
        }

        return $this->sendResponse(null, 'Product deleted successfully.', 204);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
