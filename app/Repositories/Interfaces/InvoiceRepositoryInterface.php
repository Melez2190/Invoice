<?php 

namespace App\Repositories\Interfaces;

interface InvoiceRepositoryInterface
{
    public function updatestatus($request, $id);
    public function updaterest($request, $id);
}