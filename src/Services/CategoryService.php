<?php

namespace Alexfed\Categoryproducts\Services;

use Alexfed\Categoryproducts\Interfaces\EntityServiceInterface;
use Alexfed\Categoryproducts\Models\Category;
use Alexfed\Categoryproducts\Repositories\CategoryRepository;

class CategoryService implements EntityServiceInterface
{
    protected $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param int|null $id
     * @return mixed
     */
    public function get(int $id = null)
    {
        if (empty($id)) {
            $categories = $this->categoryRepository->get_all();
        } else {
            $categories = $this->categoryRepository->get_by_id($id);
        }

        return $categories;
    }

    public function set(array $categoryData = [], int $id = null)
    {
        if (empty($id)) {
            $category = $this->categoryRepository->create($categoryData);
        } else {
            $category = $this->categoryRepository->get_by_id($id);
            if (empty($categoryData)) {
                $this->categoryRepository->delete($category);
                $category = null;
            } else {
                $category = $this->categoryRepository->update($category, $categoryData);
            }
        }

        return $category;
    }
}
