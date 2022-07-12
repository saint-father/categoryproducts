<?php

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

class EntityServiceProvider extends ServiceProvider
{
    const ENTITIES = ['Product', 'Category'];
    const SERVICES_NAMESPACE = 'Alexfed\Categoryproducts\Services\\';
    const REPOSITORIES_NAMESPACE = 'Alexfed\Categoryproducts\Repositories\\';
    const CONTROLLERS_NAMESPACE = 'Alexfed\Categoryproducts\Http\Controllers\\';

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

//        $this->app->when($entity . Controller::class)
//            ->needs(EntityServiceInterface::class)
//            ->give(function () use ($entity) {
//                $serviceClass = $entity . 'Service';
//                return new $serviceClass();
//            });

//        $this->app->when($entity . Controller::class)
//            ->needs(EntityServiceInterface::class)
//            ->give(function () use ($entity) {
//                $serviceClass = $entity . 'Service';
//                return new $serviceClass();
//            });

//            $this->app->when($entity . Controller::class)
//                ->needs(RequestInterface::class)
//                ->give(function () use ($entity) {
//                    $requestClass = $entity . 'Request';
//                    return new $requestClass();
//                });
        }
    }

    public function boot()
    {
        //
    }
}
