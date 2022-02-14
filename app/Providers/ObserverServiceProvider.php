<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\ModelObserver;
use App\Models\Item;
use App\Models\Invoice;
use App\Models\Client;

class ObserverServiceProvider extends ServiceProvider
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
        self::registerModelObserver();
    }

    private static function registerModelObserver()
    {
      
        $models = [
            Client::class,
            Invoice::class,
            Item::class

        ];

        foreach ($models as $model) {
            $model::observe(ModelObserver::class);
        }
    }
}
