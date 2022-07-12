<?php

namespace Alexfed\Categoryproducts\Services;

use Alexfed\Categoryproducts\Interfaces\EntityServiceInterface;
use Alexfed\Categoryproducts\Models\Product;
use Alexfed\Categoryproducts\Repositories\ProductRepository;

class ProductService implements EntityServiceInterface
{
    protected $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * @param int|null $id
     * @return mixed
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

    public function set(array $productData = [], int $id = null)
    {
        if (empty($id)) {
            $product = $this->productRepository->create($productData);
        } else {
            $product = $this->productRepository->get_by_id($id);
            if (empty($productData)) {
                $this->productRepository->delete($product);
                $product = null;
            } else {
                $product = $this->productRepository->update($product, $productData);
            }
        }

        return $product;
    }
}
