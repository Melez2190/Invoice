<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InvoiceStoreRequest;


class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Invoice::whereRelation('client', 'user_id', '=', auth()->user()->id);
        
        $invoices = $data->filter(request([
            'client_name',
            'date_of_issue',
            'to_date_of_issue',
            'valuta',
            'tovaluta',
            'status_true',
            'status_0'
        ]))->paginate(10);
            
        return view('invoices.index', [
                'invoices' =>$invoices->withQueryString()
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
       
        Invoice::create($validate);
        return redirect("/invoices");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices = Invoice::find($id);
        $items = Item::where('invoice_id', '=', $id)->get();
        
        if(auth()->user()->id === $invoices->client->user_id){
            return view('invoices.show', [
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
        $client = Client::find($id);
        $invoice = Invoice::find($id);
       
        return view('/invoices.edit',[
            'invoice' => $invoice,
            'client' => $client
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
            $invoice = Invoice::where('id', $id)->update([
                'status' => request()->input('status')
            ]);
        }elseif(isset($_POST['btn-ostalo'])){
            $invoice = Invoice::where('id', $id)->update([
                'date_of_issue' => request()->input('date_of_issue'),
                'valuta' => request()->input('valuta')
                
            ]);
        }
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
         Invoice::find($id)->delete();
         return redirect("/invoices");
    }
}