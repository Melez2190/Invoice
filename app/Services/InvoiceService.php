<?php

namespace App\Services;

use App\Events\InvoiceCreated;
use App\Models\Invoice;

use App\Repositories\InvoiceRepository;


class InvoiceService
{
    protected $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function all()
    {
       
        return $this->invoiceRepository->all();
    }

    public function store(array $data)
    {
        $invoice = $this->invoiceRepository->store($data);
        event(new InvoiceCreated($invoice));
        return $invoice;

    }

    public function findById(int $id) 
    {
        return $this->invoiceRepository->findById($id);
    }
   
    public function update($data, $id)
    {
        return $this->invoiceRepository->update($data, $id);

    }
    public function delete($id)
    {
        return $this->invoiceRepository->delete($id);

    }
}
