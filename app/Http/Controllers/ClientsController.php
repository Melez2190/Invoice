<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Services\ClientService;
use App\Models\Invoice;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class ClientsController extends Controller
{
    use Notifiable;
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */


    public function index(Request $request)
    {
     
      if($request->ajax()){
        $clients = $this->clientService->all($request->all());
        $search = $request->search['value'];
        $count_total = Client::count();
        $count_filter = Client::count();

        if($request->search['value'] != Null){
            $count_filter = Client::where('name' , 'LIKE' , '%'. $search.'%')
            ->orWhere( 'city' , 'LIKE' , '%'. $search.'%')
            ->orWhere( 'address' , 'LIKE' , '%'. $search.'%')
            ->orWhere( 'account_number' , 'LIKE' , '%'. $search.'%')
            ->orWhere( 'email' , 'LIKE' , '%'. $search.'%')->count();
        }
       
        return Datatables::of($clients)
            ->setOffset($request['start']) 
            ->with([
                "recordsTotal" => $count_total,
                "recordsFiltered" => $count_filter,
            ])
            ->addIndexColumn()
            ->addColumn('name', function($data){
               return '<a href="'.route('clients.show',$data->id).'">'.$data->name.'</a> ';
            })
            ->addColumn('action', function($row){
                $html = '<a href="javascript:void(0)" data-toogle="tooltip" data-id="'.$row->id.'"data-original-title="Edit" class="btn-edit bg-blue-500  text-white shadow-5xl mb-10 p-2 uppercase font-bold">Edit</a> ';
                $html .= '<a href="javascript:void(0)" data-toogle="tooltip" data-id="'.$row->id.'"data-original-title="Delete" class="btn-delete bg-red-500  text-white shadow-5xl mb-10 p-2 uppercase font-bold">Delete</a> ';
                return $html;
            })
            ->rawColumns(['action', 'name'])
            ->make(true);
      }

        return view('clients.index');
      
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // dd($request->client_id);
        $userId = auth()->user()->id;
        Client::create(
            [
            'user_id' => $userId,
            'name' => $request->name,
            'city' => $request->city,
            'address' => $request->address,
            'account_number' => $request->account_number,
            'id_number' => $request->id_number,
            'tax_number' => $request->tax_number,
            'zip_code' => $request->zip_code,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            ]

    );
    return response()->json(['success'=> "Client Added Success"]);
        // $userId = auth()->user()->id;
        // $validated = $request->validated();
        // $validated['user_id'] = $userId;

        // $this->clientService->store($validated);

        // return redirect('/clients');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $client = $this->clientService->findById($id);
        $invoices = Invoice::where('client_id', '=', $id)->where('status', '=', false)->with('items')->get('id');
        
        if(auth()->user()->id === $client->user_id){
            return view('clients.show', [
                'client' =>  $this->clientService->findById($id),
                'invoices' => $invoices
            ]);
        }else {
            return redirect('/clients');
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
        $clients = Client::find($id);
        return response()->json($clients);
        // return view('clients.edit')->with('clients', $this->clientService->findById($id));
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
        $userId = auth()->user()->id;

         $data = Client::find($id);
         
         $data->update([
            'user_id' => $userId,
            'name' => $request->name,
            'city' => $request->city,
            'address' => $request->address,
            'account_number' => $request->account_number,
            'id_number' => $request->id_number,
            'tax_number' => $request->tax_number,
            'zip_code' => $request->zip_code,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);
        $this->clientService->update($data, $id);
      
        return response()->json(['success'=> "Client Added Success"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->clientService->delete($id);
        return response()->json(['success'=> "Client Deleted Success"]);

    }
}
