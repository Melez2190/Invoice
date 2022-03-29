<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Item;
use App\Services\InvoiceService;
use Illuminate\Notifications\Notifiable;
use Yajra\DataTables\DataTables;


class InvoicesController extends Controller
{
    use Notifiable;
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
         if($request->ajax()){
            if(!empty($request->from_date)){
                $invoices = Invoice::with('client')->whereBetween('date_of_issue', [$request->from_date, $request->to_date])
                ->get();
            }else{
                $invoices = $this->invoiceService->all($request->all());
            }
            $count_total = Invoice::count();
            $count_filter = Invoice::count();
             return Datatables::of($invoices)
                ->setOffset($request['start']) 
                ->with([
                    "recordsTotal" => $count_total,
                    "recordsFiltered" => $count_filter,
                ])
                ->addIndexColumn()
                ->editColumn('client.name', function($invoice){
                    return '<td><a href="'.route('clients.show', $invoice->client->id).'">'.$invoice->client->name.'</a><td> ';
                 })
                ->addColumn('status', function($data){
                    if ($data->status == 0) return 'Not paid';
                    if ($data->status == 1) return 'Paid';
                })
                ->addColumn('action', function($row){
                    $html = '<a href="javascript:void(0)" data-toogle="tooltip"  data-id="'.$row->id.'"data-original-title="EditPaid" class="btn-paid bg-yellow-500  text-white shadow-5xl mb-10 w-12 p-1 uppercase font-bold">Status</a> ';
                    $html .= '<a href="javascript:void(0)" data-toogle="tooltip"  data-id="'.$row->id.'"data-original-title="" id="btn-view" class="btn-view bg-green-500  text-white shadow-5xl mb-10 p-1 uppercase font-bold">View</a> ';
                    $html .= '<a href="javascript:void(0)" data-toogle="tooltip" data-id="'.$row->id.'"data-original-title="Edit" class="btn-edit bg-blue-500  text-white shadow-5xl mb-10 p-1 uppercase font-bold">Edit</a> ';
                    $html .= '<a href="javascript:void(0)" data-toogle="tooltip" data-id="'.$row->id.'"data-original-title="Delete" class="btn-delete bg-red-500  text-white shadow-5xl mb-10 p-1 uppercase font-bold">Delete</a> ';
                    $html .= '<a href="/invoices/'.$row->id.'" data-toogle="tooltip"  data-id="'.$row->id.'"data-original-title="" class=" bg-purple-500  text-white shadow-5xl mb-10 p-1 uppercase font-bold">Detail</a> ';
                    return $html;
                })
                ->rawColumns(['action', 'client.name'])
                ->make(true);
        }
        return view('invoices.index', [
                'invoices' => Item::with('invoices')->get()
        ]);
    }

    /**
     * Get name of Client for invoices DataTable
     *
     * @return \Illuminate\Http\Response
     */
    public function getInvoicesClient(Request $request)
    { 
        return $this->invoiceService->getInvoicesClient($request); 
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        return view('invoices.create', [
                'clients'  => $client->get()
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
        $data = [
            'client_id' => $request->client,
            'date_of_issue' => $request->date_of_issue,
            'valuta' => $request->valuta,
            'user_id' => auth()->user()->id
        ];
        // dd($data);
        $this->invoiceService->store($data);

        if($request->ajax()){
            return response()->json(['success'=> "Invoice Added Success"]);
        } 
        return redirect('invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        if(auth()->user()->id === $invoice->client->user_id){
            return view('invoices.show', [
                'invoices' => $invoice,
                'items' => $invoice->with('items')->get(),
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
    public function edit(Invoice $invoice, Request $request)
    {  
        if($request->ajax()){
            return response()->json([$invoice, $invoice->client]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update([
            'date_of_issue' => $request->date_of_issue,
            'valuta' => $request->valuta
        ]);
        $this->invoiceService->update($invoice);
     
        return response()->json(['success'=> "Invoice Edited Success"]);
    }

    public function changeStatus(Request $request)
    {
        if($request->status == "Paid"){
            $request->status = 0;
        }else{
            $request->status = 1;
        }
        $this->invoiceService->updatestatus($request->status, $request->id);

        return response()->json(['success'=>'Status changed successfully.']);
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
         return response()->json(['success'=> "Client Deleted Success"]);
    }
}