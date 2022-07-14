<?php
/**
 * @author Aleksey Fiodorov
 * @copyright Copyright (c) saint-father (https://github.com/saint-father)
 */

namespace Alexfed\Categoryproducts\Services;

use Alexfed\Categoryproducts\Interfaces\EntityServiceInterface;
use Alexfed\Categoryproducts\Models\Category;
use Alexfed\Categoryproducts\Models\Product;
use Alexfed\Categoryproducts\Repositories\CategoryRepository;
use Alexfed\Categoryproducts\Repositories\ProductRepository;

/**
 * class CategoryService for business-logic of Category functionality
 */
class CategoryService implements EntityServiceInterface
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryService constructor
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @inheritdoc
     * @param $id
     * @return Category|Category[]
     */
    public function get($id = null)
    {
        if (empty($id)) {
            $categories = $this->categoryRepository->get_all();
        } else {
            if (is_array($id)) {
                $categories = $this->categoryRepository->get_by_ids($id);
            } else {
                $categories = $this->categoryRepository->get_by_id($id);
            }
        }

        return $categories;
    }

    /**
     * @inheritdoc
     * @param array $categoryData
     * @param int|null $id
     * @return Category|Category[]
     */
    public function set(array $categoryData = [], int $id = null)
    {
        if (empty($id)) {
            $category = $this->categoryRepository->create($categoryData);
        } else {
            $category = $this->categoryRepository->get_by_id($id);
            $category = $this->categoryRepository->update($category, $categoryData);
        }

        return $category;
    }

    /**
     * @inheritdoc
     * @param int|null $id
     * @return string
     * @throws \Exception
     */
    public function delete(int $id = null)
    {
        /** @var Category $category */
        $category = $this->categoryRepository->get_by_id($id);

        if ($this->categoryRepository->getProducts($id)->count()) {
            throw new \Exception("There are products linked to category.");
        }

        $this->categoryRepository->delete($category);

        return $category->trashed() ? 'Trashed' : 'Deleted';
    }

}
