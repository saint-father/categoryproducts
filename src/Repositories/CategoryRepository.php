<?php
/**
 * @author Aleksey Fiodorov
 * @copyright Copyright (c) saint-father (https://github.com/saint-father)
 */

namespace Alexfed\Categoryproducts\Repositories;

use Alexfed\Categoryproducts\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class CategoryRepository to manage requests/responses to/from DB via Category model
 */
class CategoryRepository
{
    /**
     * Get Category by ID
     *
     * @param int $id
     * @return Category
     */
    public function get_by_id(int $id): Category
    {
        return Category::with('products')->findOrFail($id);
    }

    /**
     * Get Categories list by IDs
     *
     * @param array $ids
     * @return Category
     */
    public function get_by_ids(array $ids): Category
    {
        return Category::find($ids);
    }

    /**
     * Get all Categories
     *
     * @return mixed
     */
    public function get_all()
    {
        return Category::withCount('products')->get();
    }

    /**
     * Create Category
     *
     * @param array $categoryData
     * @return mixed
     */
    public function create(array $categoryData)
    {
        return Category::create($categoryData);
    }

    /**
     * Update category
     *
     * @param Category $category
     * @param array $categoryData
     * @return Category
     */
    public function update(Category $category, array $categoryData)
    {
        $category->fill($categoryData);
        $category->save();

        return $category;
    }

    /**
     * Delete Category
     *
     * @param Category $category
     * @return null
     */
    public function delete(Category $category)
    {
        $category->delete();

        return null;
    }

    /**
     * Get related products
     *
     * @param int $categoryId
     * @return BelongsToMany
     */
    public function getProducts(int $categoryId): BelongsToMany
    {
        $category = $this->get_by_id($categoryId);

        return $category->products();
    }
}
