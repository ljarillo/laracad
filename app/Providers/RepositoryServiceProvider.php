<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\{AthleteRepository,
    CategoryRepository,
    ClientRepository,
    EvaluationRepository,
    OrderRepository,
    ProductRepository,
    TableRepository,
    TenantRepository};
use App\Repositories\Contracts\{AthleteRepositoryInterface,
    CategoryRepositoryInterface,
    ClientRepositoryInterface,
    EvaluationRepositoryInterface,
    OrderRepositoryInterface,
    ProductRepositoryInterface,
    TableRepositoryInterface,
    TenantRepositoryInterface};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TenantRepositoryInterface::class,TenantRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,CategoryRepository::class
        );

        $this->app->bind(
            TableRepositoryInterface::class,TableRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,ProductRepository::class
        );

        $this->app->bind(
            ClientRepositoryInterface::class,ClientRepository::class
        );

        $this->app->bind(
            AthleteRepositoryInterface::class,AthleteRepository::class
        );

        $this->app->bind(
            OrderRepositoryInterface::class,OrderRepository::class
        );

        $this->app->bind(
            EvaluationRepositoryInterface::class,EvaluationRepository::class
        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
