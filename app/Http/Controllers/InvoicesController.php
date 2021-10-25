<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Item;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $invoices = Invoice::whereRelation('client', 'user_id', '=', auth()->user()->id)->get();
        
        
            return view('invoices.index', [
                'invoices' => $invoices
               
                
    
            ]);
        
       
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all()->where('user_id', '=', auth()->user()->id);
        
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
    public function store(Request $request)
    {
        $client = Invoice::create([
        
            
            'client_id' => $request->input('client_id'),
            'description'      => $request->input('description'),
            'quantity'      => $request->input('quantity'),
            'price'   => $request->input('price'),
            'pdv'  => $request->input('pdv'),
            'status'     => $request->input('status'),
            'date_of_issue' => $request->input('date_of_issue'),
            'valuta'=> $request->input('valuta')
            
        ]);
        
        
        return redirect('/invoices');
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
        $client = Client::find($id);
        
       
        $items = Item::where('invoice_id', '=', $id)->get();
        $items1 = Item::all();
        $total = 0;
        foreach($items1 as $item){
            $total += ($item->quantity * $item->price)+(($item->quantity * $item->price)/100)*$item->pdv;
            

        }
        
       
        if(auth()->user()->id === $client->user_id){
            return view('invoices.show', [
                'invoices' => $invoices,
                'items' => $items,
                'total' => $total

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

        // return view('invoices.edit')->with('invoices', $invoice);
       
       
        // $invoice = Invoice::find($id);
        // if($invoice->status === '1'){
        //     $invoice->update([
        //         'status' => '0'
        // ]);


        // }else {
        //     $invoice->update([
        //         'status' => '1'
        //     ]);

        // }
        
// dd($invoice);
        

      

       
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
        //
    }
}
