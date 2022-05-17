<?php

namespace App\Providers;

use App\Interfaces\CheckInputRepositoryInterface;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\MenuRepositoryInterfaces;
use App\Interfaces\TransactionRepositoryInterfaces;
use App\Interfaces\TypeRepositoryInterfaces;
use App\Repositories\CheckInputRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\MenuRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\TypeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(MenuRepositoryInterfaces::class, MenuRepository::class);
        $this->app->bind(TransactionRepositoryInterfaces::class, TransactionRepository::class);
        $this->app->bind(TypeRepositoryInterfaces::class, TypeRepository::class);
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
