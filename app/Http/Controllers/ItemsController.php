<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemStoreRequest;
use Illuminate\Http\Request;
use App\Models\Item;



class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::whereRelation('invoice_id', '=', 'id')->get();

        return view('invoices.show', [
            'items' => $items
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemStoreRequest $request)
    {
        $validate = $request->validated();
       
        $item = Item::create($validate);
        return redirect("/invoices/$item->invoice_id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $invoice_id = Item::where('id', '=', $id)->first()->invoice_id;
        $item = Item::find($id);

        return view('/items.edit',[
            'invoice' => $invoice_id,
            'item' => $item
        ]);
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
        $items = Item::where('id', '=', $id)->first()->invoice_id;
       
        $item = Item::where('id', $id)->update([
            'invoice_id' => $request->input('invoice_id'),
           'description'      => $request->input('description'),
           'quantity'      => $request->input('quantity'),
           'price'   => $request->input('price'),
           'pdv'  => $request->input('pdv')
          
           
       ]);
       return redirect("/invoices/$items");


   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Item $item)
    {
        $items = Item::where('id', '=', $id)->first();
       
        Item::find($id)->delete();
        
        return redirect("/invoices/$items->invoice_id");
           
    }
}
