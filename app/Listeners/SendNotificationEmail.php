<?php

namespace App\Listeners;

use App\Events\InvoiceCreated;
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
        // dd($invoice);

        $client = Client::where('id', '=', $invoice->client_id)->first();
        // dd($client);
        Mail::send('emails.notification', ['client' => $client, 'invoice' => $invoice], function ($message) use ($client) {
                $message->from('milosmelez2190@gmail.com', 'Milos ');
                $message->subject('Welcome aboard '.$client->name.'!');
                $message->to($client->email);
        });
    }
}
