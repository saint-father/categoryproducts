<?php
/**
 * @author Aleksey Fiodorov
 * @copyright Copyright (c) saint-father (https://github.com/saint-father)
 */

namespace Alexfed\Categoryproducts\Repositories;

use Alexfed\Categoryproducts\Models\Product;

/**
 * Class ProductRepository to manage requests/responses to/from DB via Product model
 */
class ProductRepository
{
    /**
     * Get Product by ID
     *
     * @param int $id
     * @return Product
     */
    public function get_by_id(int $id): Product
    {
        return Product::findOrFail($id);
    }

    /**
     * Get all Products
     *
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get_all()
    {
        return Product::all();
    }

    /**
     * Create Product
     *
     * @param array $productData
     * @return mixed
     */
    public function create(array $productData)
    {
        return Product::create($productData);
    }

    /**
     * Updater Product data
     *
     * @param Product $product
     * @param array $productData
     * @return Product
     */
    public function update(Product $product, array $productData)
    {
        $product->fill($productData);
        $product->save();

        return $product;
    }

    /**
     * Delete Product
     *
     * @param Product $product
     * @return null
     */
    public function delete(Product $product)
    {
        $product->delete();

        return null;
    }

    /**
     * Link Product and Categories
     *
     * @param Product $product
     * @param array $categoryIds
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function attach_categories(Product $product, array $categoryIds)
    {
        $product->categories()->attach($categoryIds);

        return $product->categories()->get();
    }
}
