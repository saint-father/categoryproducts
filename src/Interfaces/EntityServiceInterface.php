<?php

namespace Alexfed\Categoryproducts\Interfaces;

interface EntityServiceInterface
{
    public function get(int $id = null);

    public function set(array $productData = [], int $id = null);
}
