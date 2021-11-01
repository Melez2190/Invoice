<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClientStoreRequest;



class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->input('client_name');
        $city = $request->input('city');
        $email = $request->input('email');
        $taxnumber = $request->input('tax_number');
        $idnumber = $request->input('id_number');

        $data = Client::where('user_id', '=', auth()->user()->id);

        if (isset($name)) {
            $data->where('name', 'like', "%" . $name . "%");
        }
        if (isset($city)) {
            $data->where('city', 'like', "%" . $city . "%");
        }
        if (isset($email)) {
            $data->where('email', 'like', "%" . $email . "%");
        }
        if (isset($taxnumber)) {
            $data->where('tax_number', 'like', "%" . $taxnumber . '%');
        }
        if (isset($idnumber)) {
            $data->where('id_number', 'like', "%" . $idnumber . '%');
        }
        $clients = $data->paginate(10);
    
         return view('clients.index', [
            'clients' => $clients
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
         $data = Item::whereRelation('invoices', 'status', '=', false)->whereRelation('invoices', 'client_id', '=', $id)->get();
         $total = 0;
        
        foreach ($data as $one){
            $total += (($one->quantity * $one->price) + (($one->quantity * $one->price)/100 * $one->pdv));

        }
         $client = Client::find($id);
        
        if(auth()->user()->id === $client->user_id){
        return view('clients.show', [
            'client' => $client,
            'data' => $data,
            'total' =>$total
          
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
         $client = Client::where('id', $id)->update([
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
        //
    }
}
