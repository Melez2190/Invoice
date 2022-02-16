<?php

namespace App\Http\Controllers;

use App\Events\InvoiceCreated;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Item;
use App\Services\InvoiceService;
use App\Http\Requests\InvoiceStoreRequest;


class InvoicesController extends Controller
{
    private $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('invoices.index', [
                'invoices' => $this->invoiceService->all()->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice)
    {
        $clients = Client::where('user_id', '=', auth()->user()->id)->get();
         return view('invoices.create', [
                'clients'  => $clients
            ]);
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceStoreRequest $request)
    {      
        $validate = $request->validated();
         $this->invoiceService->store($validate);
        return redirect("/invoices");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $items = Item::where('invoice_id', '=', $id)->get();

        if(auth()->user()->id === $this->invoiceService->findbyId($id)->client->user_id){
            return view('invoices.show', [
                'invoices' => $this->invoiceService->findbyId($id),
                'items' => $items,
            ]);
        }else {
            return redirect('invoices');
        }
    }

    public function archiveDeleted($id){
        $invoices = Invoice::find($id);

        $items = Item::where('invoice_id', '=', $id)->onlyTrashed()->get();
        if(auth()->user()->id === $invoices->client->user_id){
            return view('invoices.archive', [
                'invoices' => $invoices,
                'items' => $items,
            ]);
        }else {
            return redirect('invoices');
        }
    }
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        return view('/invoices.edit',[
            'invoice' => Invoice::find($id),
            'client' => Client::find($id)
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if(isset($_POST['btn-status'])){
            $this->invoiceService->updatestatus(request()->input('status'), $id);

        }
        if(isset($_POST['btn-ostalo'])){
            $this->invoiceService->updaterest([
                request()->input('date_of_issue'),
                request()->input('valuta')
            ], $id);

        }
        // $data = $request->validated();
      
       
        return redirect('/invoices');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $this->invoiceService->delete($id);
         return redirect("/invoices");
    }
}