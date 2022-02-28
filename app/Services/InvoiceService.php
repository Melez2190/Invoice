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
    public function all()
    {
       
        return $this->invoiceRepository->all();
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
    public function updatestatus(int $data, int $id) 
    {
        return $this->invoiceRepository->updatestatus($data, $id);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request - array $data
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $id)
    {
        return $this->invoiceRepository->update($data, $id);

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
