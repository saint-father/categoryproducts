<?php
/**
 * @author Aleksey Fiodorov
 * @copyright Copyright (c) saint-father (https://github.com/saint-father)
 */

namespace Alexfed\Categoryproducts\Interfaces;

/**
 * Required functionality for all entities
 */
interface EntityServiceInterface
{
    /**
     * Getter
     *
     * @param int|null $id
     * @return mixed
     */
    public function get(int $id = null);

    /**
     * Setter
     *
     * @param array $productData
     * @param int|null $id
     * @return mixed
     */
    public function set(array $productData, int $id = null);

    /**
     * Deleter
     *
     * @param int|null $id
     * @return mixed
     */
    public function delete(int $id = null);
}
