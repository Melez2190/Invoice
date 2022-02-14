<?php

namespace App\Providers;

use App\Repositories\ClientRepository;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\InvoiceRepository;
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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        // $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
    }
}
