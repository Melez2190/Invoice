<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemStoreRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Services\ItemService;
use App\Models\Item;
use Yajra\DataTables\DataTables;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    // public function index(Request $request)
    // {
    //     // if($request->ajax()){
    //     //     $items = Item::all();
    //     //     return response($items);
    //     // }
    //     return view('invoices.show', [
    //         'items' => $this->itemService->all()
    //      ]);
    // }


    public function index(Request $request)
    {
        dd("index je");
    
            return view('items.index');
        
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
    public function store(Request $request)
    {
        Item::create([
            'invoice_id' => $request->invoice_id,
            'description' => $request->description,
             'quantity' => $request->quantity,
             'price' => $request->price,
             'pdv' => $request->pdv
             
        ]);
       
        return response()->json(['success'=> "Item Added Success"]);

        // $validate = $request->validated();
        // $item = $this->itemService->store($validate);

        // return redirect("/invoices/$item->invoice_id")->with('success', 'Item added Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
     {
        $items = Item::where('invoice_id', '=', $id)->get();


        if($request->ajax()){
            $items = Item::where('invoice_id', '=', $id)->get();
    
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('total', function($row){
                    $html =  (number_format((float)($row->quantity * $row->price)+(($row->quantity * $row->price)/100)*$row->pdv, 2 ));
                    return $html;
                })
                ->addColumn('action', function($row){
                   
                    $html = '<a href="javascript:void(0)" data-toogle="tooltip" data-id="'.$row->id.'"data-original-title="Edit" class="btn-edit-item bg-blue-500  text-white shadow-5xl mb-10 p-1 uppercase font-bold">Edit</a> ';
                    $html .= '<a href="javascript:void(0)" data-toogle="tooltip" data-id="'.$row->id.'"data-original-title="Delete" class="btn-delete-item bg-red-500  text-white shadow-5xl mb-10 p-1 uppercase font-bold">Delete</a> ';
                    return $html;
                })
                ->rawColumns(['action', 'total'])
                ->make(true);
          }
    

            return view('items.show');
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $item = $this->itemService->findById($id);
        if($request->ajax()){
            return response()->json($item);
        }
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id)
    {
        $data = Item::find($id);
        $data->update([
           'description' => $request->description,
           'quantity' => $request->quantity,
           'price' => $request->price,
           'pdv' => $request->pdv,
        
       ]);
      
         $this->itemService->update($data, $id);
       return response()->json(['success'=> "Item Edited Success"]);

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
        $this->itemService->restore($id);
        $invoice = $this->itemService->findById($id)->invoice_id;
    
        return redirect("invoices/$invoice");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $id) 
    {
       
            $this->itemService->destroy($id);
            return response()->json(['success'=> "Client Deleted Success"]);
        
       
       
       
    }
}
