<?php

namespace App\Http\Controllers;

use App\Events\InvoiceCreated;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Item;
use App\Services\InvoiceService;
use App\Http\Requests\InvoiceStoreRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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
            if(!empty($request->from_date))
            {
                $invoices = Invoice::with('client')->whereBetween('date_of_issue', [$request->from_date, $request->to_date])
                ->get();
               
            }else{
                $invoices = $this->invoiceService->all($request->all());


            }
            // $items = Item::with('invoices')->get();
            // foreach($items as $item) {
            //     dd($item);

            // }
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


    public function getInvoicesClient(Request $request){
        $search = $request->search;
  
        if($search == ''){
           $clients = Client::orderby('name','asc')->select('id','name')->limit(5)->get();
        }else{
           $clients = Client::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
        }
        $response = array();
        foreach($clients as $client){
           $response[] = array(
                "id"=>$client->id,
                "text"=>$client->name
           );
        }
        return response()->json($response); 
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
    public function store(Request $request)
    {      
        Invoice::create([
            'client_id' => $request->client,
            'date_of_issue' => $request->date_of_issue,
             'valuta' => $request->valuta
             
        ]);
       
        return response()->json(['success'=> "Invoice Added Success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
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
    public function edit($id, Request $request)
    {  
        $invoice = $this->invoiceService->findById($id);
        if($request->ajax()){
            return response()->json($invoice);
        }
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
        

        $data = Invoice::find($id);
        
        $data->update([
           'date_of_issue' => $request->date_of_issue,
           'valuta' => $request->valuta,
        
       ]);
       $this->invoiceService->update($data, $id);
     
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