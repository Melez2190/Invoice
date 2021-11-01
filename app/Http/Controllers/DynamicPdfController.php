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
   
    
   

    function get_invoices()
    {
     $invoices = Client::all();
        
     return $invoices;
    }

    function pdf(Invoice $invoice, Client $client)
    {
    $clients = auth()->user();
    
    
    $items = $invoice->items;
    view()->share(['invoices' => $invoice, 'items'=>$items,  'user'=>$clients]);
     $pdf = app('dompdf.wrapper');
     $pdf->loadView('pdf.show');
     return $pdf->download('recipt.pdf');
    }

    function convert_invoice_data_to_html()
    {
     $invoices = $this->get_invoices();
     $output = '
     <h3 align="center">Invoices</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Name</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Address</th>
    <th style="border: 1px solid; padding:12px;" width="15%">City</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Tax Number</th>
   </tr>
     ';  
     foreach($invoices as $invoice)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$invoice->name.'</td>
       <td style="border: 1px solid; padding:12px;">'.$invoice->address.'</td>
       <td style="border: 1px solid; padding:12px;">'.$invoice->city.'</td>
       <td style="border: 1px solid; padding:12px;">'.$invoice->tax_number.'</td>
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }
}