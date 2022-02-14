<?php

namespace App\Services;

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
        return $this->invoiceRepository->store($data);
    }

    public function findById(int $id) 
    {
        return $this->invoiceRepository->findById($id);
    }
    public function updatestatus($data, $id) 
    {
        return $this->invoiceRepository->updatestatus($data, $id);
    }
    public function updaterest($data, $id)
    {
        return $this->invoiceRepository->updaterest($data, $id);

    }
    public function delete($id)
    {
        return $this->invoiceRepository->delete($id);

    }
}
