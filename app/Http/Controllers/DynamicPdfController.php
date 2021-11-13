<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Item;;
use PDF;

class DynamicPDFController extends Controller
{
    function index(){
        $invoices = Invoice::whereRelation('client', 'user_id', '=', auth()->user()->id)->get();
        return view('pdf.index', [
            'invoices' => $invoices
        ]);
    }

    public function show($id){
        $invoices = Invoice::find($id);
        $items = Item::where('invoice_id', '=', $id)->get();
        
       if(auth()->user()->id === $invoices->client->user_id){
            return view('pdf.show', [
                'invoices' => $invoices,
                'items' => $items,
             ]);
        }else {
            return redirect('invoices');
        }
    }

   function pdf(Invoice $invoice, Client $client)
    {
    $clients = auth()->user();
    
    
    $items = $invoice->items;
    view()->share(['invoices' => $invoice, 'items'=>$items,  'user'=>$clients]);
     $pdf = app('dompdf.wrapper' );
     $pdf->loadView('pdf.show',['invoices' => $invoice, 'items'=>$items,  'user'=>$clients]);
     return $pdf->download('recipt.pdf');
    }

}