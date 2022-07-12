<?php

namespace Alexfed\Categoryproducts\Repositories;

use Alexfed\Categoryproducts\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRepository
{
    public function get_by_id(int $id): Category
    {
        return Category::findOrFail($id);
    }

    public function get_all()
    {
        return Category::all();
    }

    public function create(array $categoryData)
    {
        return Category::create($categoryData);
    }

    public function update(Category $category, array $categoryData)
    {
        $category->fill($categoryData);
        $category->save();

        return $category;
    }

    public function delete(Category $category)
    {
        $category->delete();

        return null;
    }

}
