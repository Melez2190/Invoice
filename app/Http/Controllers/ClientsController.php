<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;



class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all()->where('user_id', '=', auth()->user()->id);

       
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
        
        $client = Client::find($id);
        if(auth()->user()->id === $client->user_id){
        return view('clients.show', [
            'client' => $client
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
