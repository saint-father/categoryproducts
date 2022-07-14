<?php
/**
 * @author Aleksey Fiodorov
 * @copyright Copyright (c) saint-father (https://github.com/saint-father)
 */

namespace Alexfed\Categoryproducts\Providers;

use Alexfed\Categoryproducts\Interfaces\EntityServiceInterface;
use Alexfed\Categoryproducts\Repositories\ProductRepository;
use Alexfed\Categoryproducts\Services\CategoryService;
use Alexfed\Categoryproducts\Services\ProductService;
use Alexfed\Categoryproducts\Interfaces\RequestInterface;
use Alexfed\Categoryproducts\Http\Requests\CategoryRequest;
use Alexfed\Categoryproducts\Http\Requests\ProductRequest;
use Alexfed\Categoryproducts\Http\Controllers\ProductController;
use Alexfed\Categoryproducts\Http\Controllers\CategoryController;
use Illuminate\Support\ServiceProvider;

/**
 * class EntityServiceProvider to instantiate interface and bind services
 */
class EntityServiceProvider extends ServiceProvider
{
    const ENTITIES = ['Product', 'Category'];
    const SERVICES_NAMESPACE = 'Alexfed\Categoryproducts\Services\\';
    const REPOSITORIES_NAMESPACE = 'Alexfed\Categoryproducts\Repositories\\';
    const CONTROLLERS_NAMESPACE = 'Alexfed\Categoryproducts\Http\Controllers\\';

    /**
     * @return void
     */
    public function register()
    {
        $entity = '';

        foreach(self::ENTITIES as $entity) {
            $this->app->when(self::CONTROLLERS_NAMESPACE . $entity . 'Controller')
                ->needs(EntityServiceInterface::class)
                ->give(function ($app) use ($entity) {
                    $serviceClass = self::SERVICES_NAMESPACE . $entity . 'Service';
                    $repositoryClass = self::REPOSITORIES_NAMESPACE . $entity . 'Repository';
                    return new $serviceClass($app->make($repositoryClass));
                });
        }
    }

    public function boot()
    {
        //
    }
}
