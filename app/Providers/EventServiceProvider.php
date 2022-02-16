<?php

namespace App\Providers;

use App\Events\InvoiceCreated;
use App\Events\UserCreated;
use App\Listeners\SendNotificationEmail;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Observers\ModelObserver;
use App\Models\Client;
use App\Models\Item;
use App\Models\Invoice;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserCreated::class => [
            SendWelcomeEmail::class
        ],
        InvoiceCreated::class => [
            SendNotificationEmail::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
       
        // self::registerModelObserver();

    }
    private static function registerModelObserver()
    {
        /** @var \Illuminate\Database\Eloquent\Model[] $MODELS */
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
