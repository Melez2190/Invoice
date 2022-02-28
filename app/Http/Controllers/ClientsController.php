<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Services\ClientService;
use App\Models\Invoice;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
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
        $clients = $this->clientService->all();
        return Datatables::of($clients)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $html = '<a href="javascript:void(0)" data-toogle="tooltip" data-id="'.$row->id.'"data-original-title="Edit" class="btn-edit bg-blue-500  text-white shadow-5xl mb-10 p-2 uppercase font-bold">Edit</a> ';
                $html .= '<a href="javascript:void(0)" data-toogle="tooltip" data-id="'.$row->id.'"data-original-title="Delete" class="btn-delete bg-red-500  text-white shadow-5xl mb-10 p-2 uppercase font-bold">Delete</a> ';
                // $actionBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'"  data-bs-toggle="modal" data-bs-target="#editModal" class="edit  bg-blue-500  text-white shadow-5xl mb-10 p-2 uppercase font-bold  btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete  bg-red-500  text-white shadow-5xl mb-10 p-2 uppercase font-bold btn btn-danger btn-sm">Delete</a>';
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
      }
        return view('clients.index' , [
            'clients' => $this->clientService->all()
        ]);
      
        
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
        Client::updateOrCreate(['id' => $request->client_id],
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
    public function show($id)
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
    public function update(ClientStoreRequest $request, $id)
    {
        $data = $request->validated();
        if (Auth::user()->id === $this->clientService->findById($id)->user_id) {
            $this->clientService->update($data, $id);
        }
        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
        //  $this->clientService->delete($id);
        //  return redirect("/clients");
    return response()->json(['success'=> "Client Deleted Success"]);

    }
}
