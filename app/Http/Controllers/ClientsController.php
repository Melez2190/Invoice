<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Item;



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
        $clients = $data->paginate(5);
    
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
    public function store(Request $request)
    {
        $client = Client::create([
            'user_id' => auth()->user()->id,
            'name'      => $request->input('name'),
            'city'      => $request->input('city'),
            'address'   => $request->input('address'),
            'account_number'  => $request->input('account_number'),
            'id_number'  => $request->input('id_number'),
            'tax_number'  => $request->input('tax_number'),
            'zip_code'  => $request->input('zip_code'),
            'email'     => $request->input('email'),
            'phone_number'=> $request->input('phone_number')
            
        ]);
        
        
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
        
        $items = Item::all()->where('invoice_id','=', $id);
        
        $client = Client::find($id);
        if(auth()->user()->id === $client->user_id){
        return view('clients.show', [
            'client' => $client,
            'items' => $items
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
