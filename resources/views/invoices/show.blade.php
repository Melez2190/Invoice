@extends('layouts.app')
 
@section('content')

<div class="ml-48">
   <div class="relative h-24">
       {{-- @if () --}}
        <form action="/invoices/archive/{{ $invoices->id }}" method="POST">
            @csrf
            
        <input type="submit" class="bg-red-500 absolute cursor-pointer text-white shadow-5xl mb-10 p-2 w-48 uppercase font-bold"  value="View Deleted Items" name="soft">
            
      
      
           
      
    </form>
        <button class="bg-red-500 absolute right-4 text-white shadow-5xl mb-10 p-2 w-48 uppercase font-bold">
            <a href="/download-pdf/{{ $invoices->id }}">Download PDF</a>
        </button>
        <button class="bg-green-500 absolute right-48 mr-12 block text-white shadow-5xl mb-10 p-2 w-48 uppercase font-bold">
            <a href="/send-email/{{ $invoices->id }}">Send Email</a>
        </button>
   </div>
<div class="w-full h-0.5 bg-indigo-500"></div>
<div class="flex justify-between p-4">
    @if (session()->has('success'))
    <div class="alert alert-success" >
       {{ session()->get('success') }}
    </div>
@endif
    <div>
        <h6 class="font-bold">Date of issue : <span class="text-sm font-medium">{{ $invoices->date_of_issue}}</span></h6>
        <h6 class="font-bold">Valuta : <span class="text-sm font-medium">{{ $invoices->valuta }}</span></h6>
        <h6 class="font-bold">Status :  
             @if($invoices->status )
                <span class="text-green-700">Paid</span>
             @else
                <span class="text-red-700">Not paid</span>
            @endif
        </h6>
    </div>
    
    <div class="w-44 float-right ml-auto mr-12">
        <address class="text-sm">
            <span class="font-bold">Client:</span>
            <p>{{ $invoices->client->name }} </p>
            <p>{{ $invoices->client->city }} </p>
            <p>{{ $invoices->client->address }} </p>
            <p>{{ $invoices->client->email }}   </p>
            <p>{{ $invoices->client->phone_number }}</p>
            
        </address>
    </div>
    <div></div>
</div>

<div class="flex justify-center p-4">
    <div class="border-b w-full border-gray-200 shadow">

        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 text-left py-2 w-1/6 text-xs text-gray-500 ">
                        Order ID
                    </th>
                    <th class="px-4 py-2 text-left w-1/6 text-xs text-gray-500 ">
                        Description
                    </th>
                    <th class="px-4 py-2 text-left w-1/6 text-xs text-gray-500 ">
                        Quantity
                    </th>
                    <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                        Price
                    </th>
                    <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                        Tax
                    </th>
                    <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                        Total
                    </th>
                    <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                        Delete
                    </th>
                  
                    <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                        Edit
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
               
               
                   @foreach ($items as $item )
                       
                
                <tr class="whitespace-nowrap">
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $item->id }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                           {{ $item->description }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">
                           {{ $item->quantity }}
                            

                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                       
                        {{ number_format((float) $item->price, 2) }}

                    </td>
                    <td class="px-6 py-4">
                        
                        {{ $item->pdv }}

                    </td>
                    <td class="px-6 py-4">
                        {{ number_format((float) $ukupno = ($item->quantity * $item->price)+(($item->quantity * $item->price)/100)*$item->pdv, 2 ) }}

                      
                    </td>
                    <td class="px-6 py-4 text-red-500">
                        <form action="{{ route('item.delete', $item->id) }}" method="POST">
                            
                            @csrf
                                 <input type="hidden" name="_method" value="DELETE">
                            <a href=""><input type="submit" class="bg-white cursor-pointer" value="&rarr; Remove" ></a>
                          
                        </form>
                        
                    </td>
                    {{-- <td>
                        @if($invoices->status )
                        <span class="text-green-700">Paid</span>
                    @else
                        <span class="text-red-700">Not paid</span>
                    </td>
                    @endif --}}
                    <td class="text-l text-blue-900">
                       
                       
                        <a href="/items/{{ $item->id }}/edit" >&rarr; Edit</a>
                        
                        {{-- <a href="/invoices/{{ $invoices->id }}/edit">Change status</a> --}}
                        
                    </td>
                </tr>
                
                @endforeach
              
                
           
              
                
                <tr class="text-white bg-gray-800">
                    <th colspan="4"></th>
                    @if ($invoices->status === 1)
                    <td class="text-l font-bold"><b>Placeno</b></td>
                @elseif ($invoices->status === 0)
                <td class="text-l font-bold"><b>Za naplatu</b></td>
                @endif
                
                    
                    <td class="text-sm font-bold px-6 py-4"><b>{{ number_format((float) $invoices->total(), 2 ) }} rsd</b></td>
                </tr> 

               

                
               
            

            </tbody>
        </table>
    

    </div>
</div>
</div>



<div class="ml-44">
<div class="w-full h-0.5 bg-indigo-500"></div>

<div class="flex justify-center p-4">
    <div class="border-b border-gray-200 shadow">
        <form action="/items/store" method="POST">
            @csrf
            
        <table class="">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2  text-lefttext-xs text-gray-500 ">
                        <input type="hidden" name="invoice_id" value="{{ $invoices->id }}" >

                    </th>
                    <th class="px-4 py-2  text-left text-xs text-gray-500 ">
                        Description
                    </th>
                    <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                        Quantity
                    </th>
                    <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                        Price
                    </th>
                    <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                        Tax
                    </th>
                   
                </tr>
            </thead>
            <tbody class="bg-white">
               
               
                
                <tr class="whitespace-nowrap">
                    <td class="px-6 py-4 text-sm text-gray-500">
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                            <input type="text" name="description" placeholder="description">
                            @if($errors->has('description'))
                            <p class="text-xs text-red-500">{{ $errors->first('description') }}</div>
                         @endif

                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">
                            <input type="integer" name="quantity" placeholder="Quantity">
                            @if($errors->has('quantity'))
                            <p class="text-xs text-red-500">{{ $errors->first('quantity') }}</div>
                         @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <input type="integer" name="price" placeholder="Price">
                        @if($errors->has('price'))
                        <p class="text-xs text-red-500">{{ $errors->first('price') }}</div>
                     @endif
                    </td>
                    <td class="px-6 py-4">
                        <input type="number" name="pdv" placeholder="Tax" value="18">

                    </td>
                    <td class="px-6 py-4">
                    <button type="submit" class="bg-blue-900 mt-8 block text-white shadow-5xl mb-10 p-2 w-12 uppercase font-bold">
                        Add
                    </button>
                    </td>
                </tr>
                
               
            </tbody>
        </table>
    </form>

    </div>
    
</div>
</div>
</div>
@endsection
    

