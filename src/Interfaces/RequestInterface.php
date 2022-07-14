<?php
/**
 * @author Aleksey Fiodorov
 * @copyright Copyright (c) saint-father (https://github.com/saint-father)
 */

namespace Alexfed\Categoryproducts\Interfaces;

/**
 * @TODO refactore and optimize Requests
 */
interface RequestInterface
{
    /**
     * @return mixed
     */
    public function authorize();

    /**
     * @return mixed
     */
    public function rules();

    /**
     * @param $keys
     * @return mixed
     */
    public function all($keys = null);
}
