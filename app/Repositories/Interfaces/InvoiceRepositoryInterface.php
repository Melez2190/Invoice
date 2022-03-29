<?php 

namespace App\Repositories\Interfaces;

interface InvoiceRepositoryInterface
{
    public function updatestatus($request, $id);
    public function update($request);
    public function getInvoicesClient($data);
}