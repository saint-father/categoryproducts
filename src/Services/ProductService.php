<?php
/**
 * @author Aleksey Fiodorov
 * @copyright Copyright (c) saint-father (https://github.com/saint-father)
 */

namespace Alexfed\Categoryproducts\Services;

use Alexfed\Categoryproducts\Interfaces\EntityServiceInterface;
use Alexfed\Categoryproducts\Models\Product;
use Alexfed\Categoryproducts\Repositories\CategoryRepository;
use Alexfed\Categoryproducts\Repositories\ProductRepository;

/**
 * class ProductService for business-logic of Product functionality
 */
class ProductService implements EntityServiceInterface
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * ProductService constructor
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritdoc
     * @param int|null $id
     * @return Product|Product[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function get(int $id = null)
    {
        if (empty($id)) {
            $products = $this->productRepository->get_all();
        } else {
            $products = $this->productRepository->get_by_id($id);
        }

        return $products;
    }

    /**
     * @inheritdoc
     * @param array $productData
     * @param int|null $id
     * @return Product|mixed
     */
    public function set(array $productData, int $id = null)
    {
        /** @var Product $product */
        if (empty($id)) {
            $product = $this->productRepository->create($productData);
        } else {
            $product = $this->productRepository->get_by_id($id);
            $product = $this->productRepository->update($product, $productData);
        }

        return $product;
    }

    /**
     * @inheritdoc
     * @param int|null $id
     * @return string
     */
    public function delete(int $id = null)
    {
        /** @var Product $product */
        $product = $this->productRepository->get_by_id($id);
        $this->productRepository->delete($product);

        return $product->trashed() ? 'Trashed' : 'Deleted';
    }

    /**
     * Link specific Product to several categories
     *
     * @param int $productId
     * @param array $categoryIds
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function assignToCategories(int $productId, array $categoryIds)
    {
        // check product
        $product = $this->productRepository->get_by_id($productId);

        return $this->productRepository->attach_categories($product, $categoryIds);
    }
}
