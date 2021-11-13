
@extends('layouts.app')

@section('content')


<div class="ml-44">
    
<div class="text-center w-full">
    <table class="w-full border ">
        <thead class="text-left border">
            <tr>
                <th>
                    Company name
                </th>
                <th>
                    <Address>
                        Address
                    </Address>
                </th>
                <th>
                    City
                </th>
               
                <th>
                    Email:
                </th>
                <th>
                   Not paid  Invoices
                </th>
                <th>
                    Total for paid
                </th>
                <th>
                    Total Paid
                </th>
            </tr>
        </thead>
        <tbody class="text-left h-12">
            <tr class="p-12">
                <td>
                    {{ $client->name }}
                </td>
                <td>
                    {{ $client->address }}
                </td>
                <td>
                    {{ $client->city }}
                </td>
              
                <td>
                    {{ $client->email }}
                </td>
                <td>
                    @foreach ($invoices as $invoice)
                      
                  
                            <a class="block text-red-500 " href="/invoices/{{ $invoice->id }}" >InvoiceID {{ $invoice->id }}  </a>

                            
                        
                    @endforeach
                </td>
                <td>
                  
                    <p class="text-red-500">{{ number_format((float) $client->totalSum(), 2 ) }} rsd </p>
                </td>
            </tr>
        </tbody>
  
    
</table>
</div>


@endsection