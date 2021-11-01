<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Quantox invoice') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
<body>
    

 


<div class="w-full">
    
<div class="w-full h-0.5 bg-indigo-500"></div>
<div class="flex justify-between p-4">
    <div>
        <h6 class="font-bold">ID invoice : <span class="text-sm font-medium">{{ $invoices->id}}</span></h6>
        <h6 class="font-bold">Date of issue : <span class="text-sm font-medium">{{ $invoices->date_of_issue}}</span></h6>
        <h6 class="font-bold">Valuta : <span class="text-sm font-medium">{{ $invoices->valuta }}</span></h6>
    </div>
    <div class="mt-36 ml-48 text-5xl">
        <h1>RECEIPT</h1>
    </div>
    <div class="w-96 float-right mr-12 ml-auto">
        
        <table class="border">
            
                <tr>
                    <th class="border">
                        Client
                    </th>
                    <td  class="border">
            <strong>{{ $invoices->client->name }} </strong>

                    </td>
                </tr>
                <tr class="border">
                    <th class="border">
                        City
                    </th>
                    <td class="border">
            <p>{{ $invoices->client->city }} </p>

                    </td>
                </tr>
                <tr>
                    <th class="border">
                        Address
                    </th>
                    <td class="border">
            <p>{{ $invoices->client->address }} </p>

                    </td>
                </tr>
                <tr>
                    <th class="border">
                        Email
                    </th>
                    <td class="border">
            <strong>{{ $invoices->client->email }} </strong>

                    </td>
                </tr>
                <tr>
                    <th class="border">
                        Phone Number
                    </th>
                    <td class="border">
            <p>{{ $invoices->client->phone_number }} </p>

                    </td>
                </tr>
                <tr>
                    <th class="border">
                        Tax Number
                    </th>
                    <td class="border">
            <p>{{ $invoices->client->tax_number }} </p>

                    </td>
                </tr>
                <tr>
                    <th class="border">
                        Id Number
                    </th>
                    <td class="border">
            <p>{{ $invoices->client->id_number }} </p>

                    </td>
                </tr>
                <tr>
                    <th class="border">
                        Account number
                    </th>
                    <td class="border">
            <strong>{{ $invoices->client->account_number }} </strong>

                    </td>
                </tr>
           
       
            </table>
    </div>
    <div></div>
</div>
<div class="flex justify-center p-4">
    <div class="border-b w-full mt-24 border-gray-200 shadow">

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
