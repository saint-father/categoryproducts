<?php

namespace Alexfed\Categoryproducts\Repositories;

use Alexfed\Categoryproducts\Models\Product;

class ProductRepository
{
    public function get_by_id(int $id): Product
    {
        return Product::findOrFail($id);
    }

    public function get_all()
    {
        return Product::all();
    }

    public function create(array $productData)
    {
        return Product::create($productData);
    }

    public function update(Product $product, array $productData)
    {
        $product->fill($productData);
        $product->save();

        return $product;
    }

    public function delete(Product $product)
    {
        $product->delete();

        return null;
    }
}
