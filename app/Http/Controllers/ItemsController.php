<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemStoreRequest;
use Illuminate\Http\Request;
use App\Services\ItemService;
use App\Models\Item;



class ItemsController extends Controller
{

    private $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoices.show', [
            'items' => $this->itemService->all()
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
        $item = $this->itemService->store($validate);

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
    public function update( ItemStoreRequest $request, $id)
    {
        $invoice = $this->itemService->findRelationWithInvoice($id);
        
        $validated = $request->validated();
         $this->itemService->update($validated, $id);
        return redirect("/invoices/$invoice");
    }


    /**Trashed out the view, storage in deleted_at.
     *  Can restore.
     * Soft Deleted
     * 
     */

    public function delete($id)
    {
        $this->itemService->softDelete($id);
        
        return back();
    }

    public function restore($id)
    {
        Item::withTrashed()->find($id)->restore();
        $invoice = Item::where('id', $id)->first()->invoice_id;


        return redirect("invoices/$invoice");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->itemService->delete($id);
        return back();
           
    }
}
