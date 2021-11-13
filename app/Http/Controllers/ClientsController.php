<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Item;
use App\Http\Requests\ClientStoreRequest;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InvoiceStoreRequest;

use App\Models\User;
use Illuminate\Validation\Rules\In;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Support\Facades\Redirect;



class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Client::where('user_id', '=', auth()->user()->id);

        $clients = $data->filter(request([
            'client_name',
            'city',
            'email',
            'tax_number',
            'id_number'
        ]))->orderBy('name')->paginate(10);
    
         return view('clients.index', [
            'clients' => $clients->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
    public function store(ClientStoreRequest $request)
    {
        $validated = $request->validated();
        // dd(auth()->user()->id);
        $userId = auth()->user()->id;
        $validated = $request->validated();
        $validated['user_id'] = $userId;
        Client::create($validated);
       
        
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
        $client = Client::find($id);

        $data = Item::whereRelation('invoices', 'status', '=', false)->whereRelation('invoices', 'client_id', '=', $id)->get();
        
        $invoices = Invoice::where('client_id', '=', $id)->where('status', '=', false)->with('items')->get('id');
        

        if(auth()->user()->id === $client->user_id){
        return view('clients.show', [
            'client' => $client,
            'data' => $data,
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
        $client = Client::find($id);

        return view('clients.edit')->with('clients', $client);
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
        Client::where('id', $id)->update([
            'user_id' => auth()->user()->id,
            'name'      => $request->input('name'),
            'city'      => $request->input('city'),
            'address'   => $request->input('address'),
            'zip_code'  => $request->input('account_number'),
            'zip_code'  => $request->input('id_number'),
            'tax_number'  => $request->input('tax_number'),
            'zip_code'  => $request->input('zip_code'),
            'email'     => $request->input('email'),
            'phone_number'=> $request->input('phone_number')
            
        ]);
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
         return redirect("/clients");  
    }
}
