<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use App\Notifications\SchedulerNotification;
use App\Services\NotificationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class NotificationMessage extends Command
{

    private $notificationService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailto:notpaid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to clients who not paid invoices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(NotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Invoice $invoices)
    {
       $this->notificationService->send();
    }
}
