<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Notifications\SchedulerNotification;
use App\Repositories\Interfaces\NotificationRepositoryInterface;


class NotificationRepository implements NotificationRepositoryInterface
{
    public function send()
    {
        $invoices = Invoice::where('status', '=', false)->with('client')->get();
        

        foreach($invoices as $invoice)
         {
             $invoice->client->notify(new SchedulerNotification($invoice));
         }
    }
}