<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\Client;



class UserController extends Controller
{

    public function stats(Request $request) {
        $user = User::getUser();

        $datefrom = $request->input('date_of_issue');
        $dateto = $request->input('to_date_of_issue');

        $clients = Client::where('user_id', '=', auth()->user()->id)->count();
        $invoices = Invoice::where('status', '=', '1')->whereRelation('client', 'user_id', "=", $user->id);
    
    

        

        if (isset($datefrom)) {
            $invoices->where('date_of_issue', '>=',  $datefrom );
        }
        if (isset($dateto)) {
            $invoices->where('date_of_issue', '<=',  $dateto );
        }
        $totalpaid = $invoices->with('items')->get();
        $totalincome = 0;
        
        foreach($totalpaid as $paid){
            $totalincome += $paid->total();
        }

        $invoicesnotpaid = Invoice::where('status', '=', '0')->whereRelation('client', 'user_id', "=", $user->id);
        
        if (isset($datefrom)) {
            $invoicesnotpaid->where('date_of_issue', '>=',  $datefrom );
        }
        if (isset($dateto)) {
            $invoicesnotpaid->where('date_of_issue', '<=',  $dateto );
        }
        $notpaidtotal = 0;
        $notpaidInv = $invoicesnotpaid->with('items')->get();
       
        foreach($notpaidInv as $notpaid){
            $notpaidtotal += $notpaid->total();
        }
      
      
       
        return view('user.statistics', [
            'paid' => $totalincome,
            'notpaid' => $notpaidtotal,
            'countclient' => $clients,
            'totalpaidinv' => $invoices->count(),
            'totalnotpaid' => $invoicesnotpaid->count()
         
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
