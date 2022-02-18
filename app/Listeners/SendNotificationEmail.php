<?php

namespace App\Listeners;

use App\Events\InvoiceCreated;
use App\Jobs\SendEMailNotificationInvoice;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\InvoiceCreated  $event
     * @return void
     */
    public function handle(InvoiceCreated $event)
    {
        $invoice = $event->invoice;
        dispatch(new SendEmailNotificationInvoice($invoice));
    }
}
