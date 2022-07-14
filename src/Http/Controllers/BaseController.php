<?php
/**
 * @author Aleksey Fiodorov
 * @copyright Copyright (c) saint-father (https://github.com/saint-father)
 */

namespace Alexfed\Categoryproducts\Http\Controllers;

use Alexfed\Categoryproducts\Http\Requests\ProductRequest;
use Alexfed\Categoryproducts\Interfaces\EntityServiceInterface as EntityService;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class BaseController with default actions
 */
class BaseController extends Controller
{
    /**
     * @var EntityService
     */
    protected $entityService;

    /**
     * BaseController constructor
     *
     * @param EntityService $entityService
     */
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
     * @param mixed $request
     * @return \Illuminate\Http\Response
     */
    public function storeEntity($request)
    {
        $product = $this->entityService->set($request);

        return $this->sendResponse($product, 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $productId
     * @return \Illuminate\Http\Response
     */
    public function show(int $productId)
    {
        try {
            $displayedProducts = $this->entityService->get($productId);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $this->sendError('Not found.');
        }

        return $this->sendResponse($displayedProducts, 'Retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param mixed $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateEntity($request, int $id)
    {
        try {
            $updatedProduct = $this->entityService->set($request->except(['id']), $id);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $this->sendError('Not found.');
        } catch (\Exception $exception) {
            return $this->sendError('Updating error', [$exception->getMessage()],422);
        }

        return $this->sendResponse($updatedProduct, 'Updated successfully.');
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
            $result = $this->entityService->delete($id);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $this->sendError('Entity not found.');
        } catch (\Exception $exception) {
            return $this->sendError('Deleting error', [$exception->getMessage()], 422);
        }

        return $this->sendResponse($result, 'Resource deleted successfully.', 204);
    }

    /**
     * success response method.
     *
     * @param mixed $result
     * @param array|string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
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
     * @param string $error
     * @param array|string $errorMessages
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
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
