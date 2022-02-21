<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\ClientService;
use App\Models\Invoice;
use Clockwork\Request\Request;
use Illuminate\Notifications\Notifiable;

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


    public function index()
    {
        return view('clients.index' , [
            'clients' => $this->clientService->all()->withQueryString()
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
        dd(1);
        $userId = auth()->user()->id;
        $validated = $request->validated();
        $validated['user_id'] = $userId;

        $this->clientService->store($validated);

        return redirect('/clients');
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
        return view('clients.edit')->with('clients', $this->clientService->findById($id));
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
         $this->clientService->delete($id);
         return redirect("/clients");
    }
}
