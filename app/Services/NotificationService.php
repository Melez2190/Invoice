<?php

namespace App\Services;

use App\Models\Invoice;
use App\Repositories\ItemRepository;
use App\Repositories\NotificationRepository;

class NotificationService
{
    protected $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function send()
    {
        return $this->notificationRepository->send();
    }

}
