<?php 

namespace App\Repositories\Interfaces;

use App\Models\Invoice;

interface NotificationRepositoryInterface
{
    public function send();

}
