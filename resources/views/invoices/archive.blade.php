@extends('layouts.app')
 
@section('content')

    <div class="ml-48">
        <div class="relative h-24">
            @foreach ($items as $item)
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
                                    Restore
                                </th>
                                <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                                    ForceDelete
                                </th>
                              
                               
                            </tr>
                        </thead>
                        <tbody class="bg-white">
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
                        <form action="{{ route('items.restore', $item->id) }}" method="POST">
                            
                            @csrf
                            
                                 <input type="hidden" name="_method" value="GET">
                            <a href=""><input type="submit" class="bg-white px-4 py-4 cursor-pointer color-green-500" value="&rarr; Restore" ></a>
                          
                        </form>
                        
                    </td>
                    <td>
                    <form action="{{ route('item.destroy', $item->id) }}" method="POST">
                            
                        @csrf
                        @method('DELETE')
                      
                        <a href=""><input type="submit" class="bg-white px-4 py-4 cursor-pointer color-green-900" value="&rarr; ForceDelete" ></a>
                      
                    </form>
                    </td>
            @endforeach

        </div>
    </div>
@endsection