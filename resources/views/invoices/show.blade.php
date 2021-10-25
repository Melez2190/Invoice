@extends('layouts.app')
 
@section('content')

<div class="ml-44">
    
<div class="w-full h-0.5 bg-indigo-500"></div>
<div class="flex justify-between p-4">
    <div>
        <h6 class="font-bold">Date of issue : <span class="text-sm font-medium">{{ $invoices->date_of_issue}}</span></h6>
        <h6 class="font-bold">Valuta : <span class="text-sm font-medium">{{ $invoices->valuta }}</span></h6>
    </div>
    
    <div class="w-40 float-right ml-auto">
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
                    <th class="px-4 py-2 text-left text-xs text-gray-500 " >
                        Status
                    </th>
                    <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                        Action
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
                    <td>
                        @if($invoices->status )
                        <span class="text-green-700">Paid</span>
                    @else
                        <span class="text-red-700">Not paid</span>
                    </td>
                    @endif
                    <td><div class="dropdown">
                        <button class="dropbtn">Actions</button>
                        <div class="dropdown-content">
                        <a href="/items/{{ $item->id }}/edit">Edit</a>
                        <a href="/invoices/{{ $invoices->id }}">View</a>
                        <a href="/invoices/{{ $invoices->id }}/edit">Change status</a>
                        </div>
                      </div>
                      
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
                
                    
                    <td class="text-sm font-bold px-6 py-4"><b>{{ number_format((float) $total, 2 ) }} rsd</b></td>
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
        <form action="/items" method="POST">
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

                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">
                            <input type="integer" name="quantity" placeholder="Quantity">

                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <input type="integer" name="price" placeholder="Price">

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
                
               
                {{-- <tr class="">
                    <td colspan="3"></td>
                    <td class="text-sm font-bold">Sub Total</td>
                    <td class="text-sm font-bold tracking-wider"><b>$950</b></td>
                </tr>
                <!--end tr-->
                <tr>
                    <th colspan="3"></th>
                    <td class="text-sm font-bold"><b>Tax Rate</b></td>
                    <td class="text-sm font-bold"><b>$1.50%</b></td>
                </tr>
                <!--end tr-->
                <tr class="text-white bg-gray-800">
                    <th colspan="3"></th>
                    <td class="text-sm font-bold"><b>Total</b></td>
                    <td class="text-sm font-bold"><b>$999.0</b></td>
                </tr> --}}
                <!--end tr-->

            </tbody>
        </table>
    </form>

    </div>
</div>
</div>
</div>
@endsection
    

