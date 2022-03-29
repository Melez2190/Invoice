<?php

namespace App\Services;

use App\Events\InvoiceCreated;
use App\Repositories\InvoiceRepository;


class InvoiceService
{
    protected $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

     /**
     * Display a listing of the resource. Returning all invoices from DB
     *
     */
    public function all($attributes)
    {
       
        return $this->invoiceRepository->all($attributes);
    }


    public function getInvoicesClient($data)
    {
        return $this->invoiceRepository->getInvoicesClient($data);

    }
    /**
     * Store a newly created resource in storage.
     * @param \Request\InvoiceStoreRequest $request - array $data
     */
    public function store(array $data)
    {
        $invoice = $this->invoiceRepository->store($data);
            event(new InvoiceCreated($invoice));
        return $invoice;
    }

     /**
     * Find specific Invoice with $id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findById(int $id) 
    {
        return $this->invoiceRepository->findById($id);
    }

     /**
     * Update status Invoice - paid/not paid
     *
     * @param  int  $id
     * @param int  $data - boolean (0,1)
     * @return \Illuminate\Http\Response
     */
    public function updatestatus($data, int $id) 
    {
        // dd($data);
        // dd($data['status']);
        return $this->invoiceRepository->updatestatus($data, $id);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request - array $data
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($data)
    {
        return $this->invoiceRepository->update($data);

    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        return $this->invoiceRepository->delete($id);

    }
}
