<?php

namespace Alexfed\Categoryproducts\Interfaces;

interface RequestInterface
{
    public function authorize();

    public function rules();

    public function all($keys = null);
}
